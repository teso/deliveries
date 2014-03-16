<?php
    //TODO написати крон-скрипт, який буде оновлювати статус

    /**
     * extended PartnerApiAbstract class for "Nova Poshta" delivery
     */
    class PartnerApiNp extends PartnerApiAbstract
    {
        const
            DISCONT = 0,       //MT Discount in Nova Poshta
            LOGIN = 'mytrans',
            PASSWORD = '1234567',
            KEY = '89deb0193e07f26c397abfe09d4b49ab';

        private
            $lang = 'ua';

        public function sendReport($data)
        {
            global $customer;

            send_tpl(
                LANG,
                (in_array($data['service'][0], array(1, 2)) ? 'shipment_home_np' : 'shipment_branch_np'),
                array(
                    'shipment_number' => $data['shipment_number'],
                    'branch_address' => $data['branch_data']['address'],
                    'branch_timetable' => $data['branch_data']['timetable'],
                    'site_link' => SITE_ADDRESS,
                ),
                $customer->email,
                array(
                    'from' => 'noreply',
                    'imagesPath' => PHP_ROOT . '/img/',
                    'debug' => false,
                    'headers' => array('Precedence: bulk'),
                    'wrapper_template' => 'general',
                    //'unsubscribe_type' => 'exchange',
                )
            );
        }

        /**
         * Get avarage delivery price for defined conditions
         *
         * @param array $request_data
         *
         * @return float
         * @throws Exception
         */
        public function getPrice($request_data)
        {
            $record_data = $this->record->getViewData($this->lang);

            $record_data = array_merge($request_data, $record_data);

            $this->addLocationData($record_data, 'f');
            $this->addLocationData($record_data, 't');

            $this->source->setUrl('http://orders.novaposhta.ua/xml.php');

            $response = $this->source->read(
                $this->getRegisterRequest($this->getPriceSubrequest($record_data))
            );

            $results = $this->getResults($response, 'countPrice');

            $price = (float) $results->cost;

            if (empty($price))
            {
                throw new Exception('No price calculated in function \'countPrice\'');
            }

            return array(
                'discont' => self::DISCONT,
                'actual' => $price,
                'old' => round($price / (1 - self::DISCONT / 100)),
            );
        }

        /**
         * Register shipment and send pickup request if client want to send his goods from home
         *
         * @param array $shipment_data
         *
         * @return string
         * @throws Exception
         */
        public function registerShipment($shipment_data)
        {
            $this->checkShipmentData($shipment_data);

            $record_data = $this->record->getViewData($this->lang);

            //$this->addLocationData($record_data, 'f');
            //$this->addLocationData($record_data, 't');

            $this->source->setUrl('http://orders.novaposhta.ua/xml.php');

            $response = $this->source->read(
                $this->getRegisterRequest($this->getShipmentSubrequest($record_data, $shipment_data))
            );

            $results = $this->getResults($response, 'order');
            $order = $results->order;

            if (!empty($order))
            {
                $attributes = $results->order->attributes();
                $shipment_number = (string) $attributes['np_id'];

                if (!empty($shipment_number))
                {
                    Db::i()->insert('partner_shipments',
                        array(
                            'record_id' => $record_data['id'],
                            'alias' => 'np',
                            'shipment_number' => $shipment_number,
                            'date' => Db::i()->now(),
                            'shipment_data' => Tools::json_encode($shipment_data)
                        )
                    );

                    return $shipment_number;
                }
                else
                {
                    throw new Exception('No SHIPMENT_NUMBER in function \'order\'');
                }
            }
            else
            {
                throw new Exception('No results in function \'order\'');
            }
        }

        /**
         * Get current status of sent goods
         *
         * @param int $record_id
         *
         * @return bool|string
         */
        public function getShipmentStatus($shipment_number)
        {
            $this->source->setUrl('http://orders.novaposhta.ua/xml.php');

            $response = $this->source->read(
                $this->getRegisterRequest('<track><en>' . $shipment_number . '</en></track> ')
            );

            $results = $this->getResults($response, 'track');

            if (!empty($results->status))
            {
                return (string) $results->status;
            }
            else
            {
                return false;
            }
        }

        private function checkShipmentData($shipment_data)
        {
            $errors = array();

            foreach ($shipment_data as $name => $value)
            {
                switch ($name)
                {
                    case 'branch_from':
                        if (in_array($shipment_data['service'][0], array(3, 4)) && empty($value))
                        {
                            $errors[] = $name;
                        }
                        break;
                    case 'address_from':
                        if (in_array($shipment_data['service'][0], array(1, 2)) && empty($value))
                        {
                            $errors[] = $name;
                        }
                        break;
                    case 'branch_to':
                        if (in_array($shipment_data['service'][0], array(2, 4)) && empty($value))
                        {
                            $errors[] = $name;
                        }
                        break;
                    case 'address_to':
                        if (in_array($shipment_data['service'][0], array(1, 3)) && empty($value))
                        {
                            $errors[] = $name;
                        }
                        break;
                    case 'price': case 'flat_from': case 'flat_to':   // Необов'язкові поля
                        break;
                    default:
                        if( empty($value) )
                        {
                            $errors[] = $name;
                        }
                        break;
                }
            }

            if (count($errors) > 0)
            {
                throw new Exception('Not enough data for register shipment. Following fields are empty: ' . implode(', ', $errors) . '.');
            }
            else
            {
                return true;
            }
        }

        /**
         * Fill xml template with request data for register case
         *
         * @param array $data
         *
         * @return string
         */
        private function getRegisterRequest($subrequest)
        {
            $this->source->setUrl('http://orders.novaposhta.ua/xml.php');

            $request =
                '<?xml version="1.0" encoding="UTF-8"?>'
                . '<file>'
                . '<auth>' . self::KEY . '</auth>'
                . $subrequest
                . '</file>';

            $this->log->setLastRequest($request);

            return $request;
        }

        /**
         * Fill xml template with price subrequest data
         *
         * @param array $record_data
         *
         * @return string
         */
        private function getPriceSubrequest($record_data)
        {
            $request =
                '<countPrice>'
                . '<senderCity>' . $record_data['townf'] . '</senderCity>'
                . '<recipientCity>' . $record_data['townt'] . '</recipientCity>'
                . '<mass>' . ($record_data['weight'] * 1000) . '</mass>'
                . '<height>' . ($record_data['height'] * 100) . '</height>'
                . '<width>' . ($record_data['width'] * 100) . '</width>'
                . '<depth>' . ($record_data['length'] * 100) . '</depth>'
                . '<publicPrice>' . $record_data['insurance'] . '</publicPrice>'
                //. '<loadType_id>1</loadType_id>'
                . '<deliveryType_id>4</deliveryType_id>'
                . '<floor_count>1</floor_count>'
                . '<date>' . date('d.m.Y', strtotime($record_data['datef'])) . '</date>'
                . '</countPrice>';

            return $request;
        }

        /**
         * Fill xml template with shipment subrequest data
         *
         * @param array $record_data
         * @param array $shipment_data
         *
         * @return string
         * @throws Exception
         */
        private function getShipmentSubrequest($record_data, $shipment_data)
        {
            $phone = '';

            foreach($record_data['contacts'] as $contact)
            {
                if ('telephone' == $contact['name'])
                {
                    $phone = $contact['value'];

                    break;
                }
            }

            if (empty($phone))
            {
                throw new Exception('No phone number in record #' . $record_data['id']);
            }

            $request =
                '<order'
                . ' order_id="MT' . $record_data['id'] . '"'
                . ' date="' . date('Y-m-d', strtotime($record_data['datef'])) . '"'
                . ' sender_city="' . $record_data['townf'] . '"'
                . ' sender_company="' . $record_data['org_name'] . '"';

            if (in_array($shipment_data['service'][0], array(1, 2)))
            {
                $request .= ' sender_address="' . $shipment_data['address_from'] . ', кв. ' . $shipment_data['flat_from'] . '"';
            }
            else
            {
                $request .= ' sender_address="' . $record_data['number'] . '"';
            }

            $request .=
                ' sender_contact="' . $record_data['contact_person'] . '"'
                . ' sender_phone="' . $phone . '"'
                . ' rcpt_city_name="' . $record_data['townt'] . '"'
                . ' rcpt_name="Приватна особа"';

            if (in_array($shipment_data['service'][0], array(2, 4)))
            {
                $request .= ' rcpt_warehouse="' . $shipment_data['branch_to'] . '"';
            }
            else
            {
                $request .= ' rcpt_street_name="' . $shipment_data['address_to'] . ', кв. ' . $shipment_data['flat_from'] . '"';
            }

            $request .=
                ' rcpt_contact="' . $shipment_data['receiver_name'] . '"'
                . ' rcpt_phone_num="' . $shipment_data['receiver_phone'] . '"'
                . ' pack_type="Коробка"'
                . ' description="' . $record_data['freight'] . '"'
                . ' pay_type="1"'
                . ' payer="' . $shipment_data['payer'][0] . '"'
                . ' cost="' . $shipment_data['insurance'] . '"'
                . ' height="' . ($record_data['height'] * 100) . '"'
                . ' width="' . ($record_data['width'] * 100) . '"'
                . ' length="' . ($record_data['length'] * 100) . '"'
                . ' weight="' . ($record_data['weight'] * 1000) . '">'
                . '<order_cont />' //TODO додати атрибут cont_description
                . '</order>';

            return $request;
        }

        /**
         * Try to find partner identifiers for inside country, region and city identifiers and cache they.
         * Also get branches and streets by city and cache they.
         *
         * @param array $record_data
         * @param string $way
         *
         * @throws Exception
         */
        private function addLocationData(&$record_data, $way)
        {
            if ($way == 'f')
            {
                $full_way = 'from';
            }
            else
            {
                $full_way = 'to';
            }

            // TODO: cache location data

            if (empty($record_data['service']))  // Шукати відділення тільки, якщо не задано умови відправки-прийому (перший запит на обрахування ціни)
            {
                $record_data['branch_' . $full_way] = $this->cache->getRandomBranch($record_data['townid' . $way], $record_data['address_id_' . $full_way]);

                if (empty($record_data['branch_' . $full_way])) // Робити запит по відділенням тільки при додаванні міста до кешу, коли у нього стоїть мітка, що воно має відділення
                {
                    $response = $this->source->read(
                        $this->getRegisterRequest('<warenhouse/><filter>' . $record_data['town' . $way] . '</filter>')
                    );

                    $results = $this->getResults($response, 'warenhouse');
                    $branches = $results->result->whs->warenhouse;

                    if (!empty($branches) && count($branches) > 0)
                    {
                        $record_data['branch_' . $full_way] = (int) $branches[0]->number;

                        for($i = 0, $count = count($branches); $i < $count; $i++)
                        {
                            $branch_data = array();

                            $branch_data['branch_id'] = (int) $branches[$i]->wareId;
                            $branch_data['branch_ref'] = (string) $branches[$i]->ref;
                            $branch_data['town_id'] = $record_data['townid' . $way];
                            $branch_data['address_id'] = $record_data['address_id_' . $full_way];
                            $branch_data['number'] = (int) $branches[$i]->number;
                            $branch_data['outside_town_id'] = (int) $branches[$i]->city_id;
                            $branch_data['outside_town_ref'] = (string) $branches[$i]->city_ref;
                            $branch_data['town_name_ua'] = (string) $branches[$i]->city;
                            $branch_data['town_name_ru'] = (string) $branches[$i]->cityRu;
                            $branch_data['town_name_uk'] = $branch_data['town_name_ru'];
                            $branch_data['address_ua'] = (string) $branches[$i]->address;
                            $branch_data['address_ru'] = (string) $branches[$i]->addressRu;
                            $branch_data['address_uk'] = $branch_data['address_ru'];
                            $branch_data['phone'] = (string) $branches[$i]->phone;
                            $branch_data['lat'] = (float) $branches[$i]->y;
                            $branch_data['lng'] = (float) $branches[$i]->x;
                            $branch_data['weight_limit'] = (float) $branches[$i]->max_weight_allowed;
                            $branch_data['timetable'] = 'пн-пт: ' . $branches[$i]->weekday_work_hours . '; сб: ' . $branches[$i]->saturday_work_hours;

                            $this->cache->addBrach($branch_data);
                        }
                    }
                }
            }
        }

        /**
         * Check response and return results of request
         *
         * @param string $response
         * @param string $function
         *
         * @return array
         * @throws Exception
         */
        private function getResults($response, $function, $no_exception = false)
        {
            if (!empty($response))
            {
                $this->log->setLastResponse($response);

                $responseXML = new SimpleXMLElement($response);

                if (empty($responseXML->error))
                {
                    $this->log->addRequest(array(
                        'request' => $this->log->getLastRequest(),
                        'response' => $response,
                        'function' => $function
                    ));

                    return $responseXML;
                }
                else
                {
                    if (!empty($no_exception))
                    {
                        $this->log->addError('Error in function \'' . $function . '\'');
                    }
                    else
                    {
                        throw new Exception('Error in function \'' . $function . '\'');
                    }
                }
            }
            else
            {
                if (!empty($no_exception))
                {
                    $this->log->addError('No response in function \'' . $function . '\'');
                }
                else
                {
                    throw new Exception('No response in function \'' . $function . '\'');
                }
            }
        }
    }
?>
