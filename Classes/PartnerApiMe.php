<?php
    //TODO написати крон-скрипт, який буде оновлювати статус
    //TODO написати крон-скрипт, який буде подавати запит на забір посилки (CreatePickUp), якщо при першій спробі сталась помилка

    /**
     * extended PartnerApiAbstract class for "MeestExpress" delivery
     */
    class PartnerApiMe extends PartnerApiAbstract
    {
        const
            DISCONT = 10,       //MT Discount in Meest-Express
            LOGIN = 'MyTrans',
            PASSWORD = 'JNFn63H@#vbl',
            CLIENT_CODE = 'APItest',
            CLIENT_UID = '8458f0b0-930f-11e2-a91e-003048d2b473', // Working: ClientUUID: 62f66c7c-cd19-11df-bb67-00215aee3ebe  | Test: 8458f0b0-930f-11e2-a91e-003048d2b473
            AGENT_UID = '4a430ffc-6b7d-11e2-a79e-003048d2b473';

        private
            $lang = 'ua',
            $lang_suffix = array(
                'ua' => 'UA',
                'ru' => 'RU',
                //'uk' => 'EN'
            );

        public function sendReport($data)
        {
            global $customer;

            $service_temp = explode('-', $data['service'][0]);

            send_tpl(
                LANG,
                ($service_temp[0] == 1 ? 'shipment_home_me' : 'shipment_branch_me'),
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

            $this->source->setUrl('http://api1c.meest-group.com/services/1C_Document.php');

            $response = $this->source->read(
                $this->getRegisterRequest(
                    array(
                        'function' => 'CalculateShipments',
                        'request' => $this->getPriceSubrequest($record_data),
                        'request_id' => '',
                        'wait' => '1'
                    )
                )
            );

            $results = $this->getResults($response, 'CalculateShipments');

            if (!empty($results) && 0 < count($results))
            {
                $price = (float) $results[0]->PriceOfDelivery;

                if (empty($price))
                {
                    throw new Exception('No price calculated in function \'CalculateShipments\'');
                }

                return array(
                    'discont' => self::DISCONT,
                    'actual' => $price,
                    'old' => round($price / (1 - self::DISCONT / 100)),
                );
            }
            else
            {
                throw new Exception('No results in function \'CalculateShipments\'');
            }
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

            $this->addLocationData($record_data, 'f');
            $this->addLocationData($record_data, 't');

            $this->source->setUrl('http://api1c.meest-group.com/services/1C_Document.php');

            $response = $this->source->read(
                $this->getRegisterRequest(
                    array(
                        'function' => 'CreateShipments',
                        'request' => $this->getShipmentSubrequest($record_data, $shipment_data),
                        'request_id' => '',
                        'wait' => '1'
                    )
                )
            );

            $results = $this->getResults($response, 'CreateShipments');

            if (!empty($results) && 0 < count($results))
            {
                if ('000' == $results[0]->Error)
                {
                    $shipment_number = (string) $results[0]->ClientsShipmentRef;

                    if (!empty($shipment_number))
                    {
                        Db::i()->insert('partner_shipments',
                            array(
                                'record_id' => $record_data['id'],
                                'alias' => 'me',
                                'shipment_number' => $shipment_number,
                                'date' => Db::i()->now(),
                                'shipment_data' => Tools::json_encode($shipment_data)
                            )
                        );

                        $service_temp = explode('-', $shipment_data['service'][0]);

                        if ($service_temp[0] == 1)
                        {
                            $this->source->setUrl('http://api1c.meest-group.com/services/1C_Document.php');

                            $response = $this->source->read(
                                $this->getRegisterRequest(
                                    array(
                                        'function' => 'CreatePickUp',
                                        'request' => $this->getPickupSubrequest($record_data, $shipment_data),
                                        'request_id' => '',
                                        'wait' => '1'
                                    )
                                )
                            );

                            $results = $this->getResults($response, 'CreatePickUp', true);

                            if (!empty($results) && 0 < count($results))
                            {
                                $pickup_number = (string) $results->PickUpNumber;

                                if (!empty($pickup_number))
                                {
                                    Db::i()->update('partner_shipments',
                                        array(
                                            'pickup_number' => $pickup_number
                                        ),
                                        array(
                                            'record_id' => $record_data['id']
                                        )
                                    );
                                }
                                else
                                {
                                    $this->log->addError('No PICKUP_NUMBER in function \'CreatePickUp\'');
                                }
                            }
                            else
                            {
                                $this->log->addError('No results in function \'CreatePickUp\'');
                            }
                        }

                        return $shipment_number;
                    }
                    else
                    {
                        throw new Exception('No SHIPMENT_NUMBER in function \'CreateShipments\'');
                    }
                }
                else
                {
                    throw new Exception('Error in function \'CreateShipments\': ' . (string) $results[0]->Error);
                }
            }
            else
            {
                throw new Exception('No results in function \'CreateShipments\'');
            }
        }

        /**
         * Get current status of sent goods
         *
         * @param int $record_id
         *
         * @return bool|string
         */
        public function getShipmentStatus($record_id)
        {
            $this->source->setUrl('http://api1c.meest-group.com/services/1C_Document.php');

            $response = $this->source->read(
                $this->getSearchRequest(
                    array(
                        'function' => 'ShipmentTracking',
                        'where' => 'ClientCode= \'' . self::CLIENT_CODE . '\' AND ClientsShipmentRef = \'MT' . $record_id . '\'',
                        'order' => ''
                    )
                )
            );

            $results = $this->getResults($response, 'ShipmentTracking');

            if (!empty($results) && 0 < count($results))
            {
                return (string) $results[0]->StatusCode;
            }
            else
            {
                return false;
            }
        }

        private function checkShipmentData($shipment_data)
        {
            $errors = array();

            if (!empty($shipment_data['service'][0]))
            {
                $service_temp = explode('-', $shipment_data['service'][0]);
            }

            foreach ($shipment_data as $name => $value)
            {
                switch ($name)
                {
                    case 'branch_from':
                        if (!empty($service_temp) && $service_temp[0] == '0' && empty($value))
                        {
                            $errors[] = $name;
                        }
                        break;
                    case 'address_from':
                        if (!empty($service_temp) && $service_temp[0] == '1' && empty($value))
                        {
                            $errors[] = $name;
                        }
                        break;
                    case 'branch_to':
                        if (!empty($service_temp) && $service_temp[1] == '0' && empty($value))
                        {
                            $errors[] = $name;
                        }
                        break;
                    case 'address_to':
                        if (!empty($service_temp) && $service_temp[1] == '1' && empty($value))
                        {
                            $errors[] = $name;
                        }
                        break;
                    case 'pickup_date': case 'pickup_time_from': case 'pickup_time_to':
                        if (!empty($service_temp) && $service_temp[0] == '1' && empty($value))
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
         * Fill xml template with request data for search case
         *
         * @param array $data
         *
         * @return string
         */
        private function getSearchRequest($data)
        {
            $this->source->setUrl('http://api1c.meest-group.com/services/1C_Query.php');

            $sign = md5(self::LOGIN . self::PASSWORD . $data['function'] . $data['where'] . $data['order']);

             $request =
                '<?xml version="1.0" encoding="UTF-8"?>'
                . '<param>'
                . '<login>' . self::LOGIN . '</login>'
                . '<function>' . $data['function'] . '</function>'
                . '<where>' . $data['where'] . '</where>'
                . '<order>' . $data['order'] . '</order>'
                . '<sign>' . $sign . '</sign>'
                . '</param>';

            $this->log->setLastRequest($request);

            return $request;
        }

        /**
         * Fill xml template with request data for register case
         *
         * @param array $data
         *
         * @return string
         */
        private function getRegisterRequest($data)
        {
            $this->source->setUrl('http://api1c.meest-group.com/services/1C_Document.php');

            $sign = md5(self::LOGIN . self::PASSWORD . $data['function'] . $data['request'] . $data['request_id'] . $data['wait']);

            $request =
                '<?xml version="1.0" encoding="UTF-8"?>'
                . '<param>'
                . '<login>' . self::LOGIN . '</login>'
                . '<function>' . $data['function'] . '</function>'
                . '<request>' . $data['request'] . '</request>'
                . '<request_id>' . $data['request_id'] . '</request_id>'
                . '<wait>' . $data['wait'] . '</wait>'
                . '<sign>' . $sign . '</sign>'
                . '</param>';

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
            if (!empty($record_data['service']))
            {
                $service_temp = explode('-', $record_data['service'][0]);
            }

            $request =
                '<CalculateShipment>'
                . '<ClientUID>' . self::CLIENT_UID . '</ClientUID>';

            if (empty($service_temp[0]) && !empty($record_data['branch_from']))
            {
                $request .=
                    '<SenderBranch_UID>' . $record_data['branch_from'] . '</SenderBranch_UID>'
                    . '<SenderService>0</SenderService>';
            }
            else
            {
                $request .=
                    '<SenderCity_UID>' . $record_data['partner_town_from'] . '</SenderCity_UID>'
                    . '<SenderService>1</SenderService>';
            }

            if (empty($service_temp[1]) && !empty($record_data['branch_to']))
            {
                $request .=
                    '<ReceiverBranch_UID>' . $record_data['branch_to'] . '</ReceiverBranch_UID>'
                    . '<ReceiverService>0</ReceiverService>';
            }
            elseif (!empty($record_data['partner_town_to']))
            {
                $request .=
                    '<ReceiverCity_UID>' . $record_data['partner_town_to'] . '</ReceiverCity_UID>'
                    . '<ReceiverService>1</ReceiverService>';
            }

            $request .=
                '<COD/>'
                . '<Conditions_items/>'
                . '<Places_items>'
                . '<SendingFormat>PAX</SendingFormat>'
                . '<Quantity>1</Quantity>'
                . '<Weight>' . ($record_data['weight'] * 1000) . '</Weight>'
                . '<Length>' . ($record_data['length'] * 100) . '</Length>'
                . '<Width>' . ($record_data['width'] * 100) . '</Width>'
                . '<Height>' . ($record_data['height'] * 100) . '</Height>'
                . '<Packaging/>'
                . '<Insurance>' . $record_data['insurance'] . '</Insurance>'
                . '</Places_items>'
                . '</CalculateShipment>';

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

            $service_temp = explode('-', $shipment_data['service'][0]);

            $notation = '';

            if (!empty($shipment_data['address_from']))
            {
                $notation .= 'Адреса відправлення: ' . $shipment_data['address_from'];

                if (!empty($shipment_data['flat_from']))
                {
                    $notation .= ', кв. ' . $shipment_data['flat_from'];
                }
            }

            if (!empty($shipment_data['address_from']) && !empty($shipment_data['address_to']))
            {
                $notation .= ' | ';
            }

            if (!empty($shipment_data['address_to']))
            {
                $notation .= 'Адреса отримання: ' . $shipment_data['address_to'];

                if (!empty($shipment_data['flat_to']))
                {
                    $notation .= ', кв. ' . $shipment_data['flat_to'];
                }
            }

            $request =
                '<Shipments>'
                . '<CreateShipment>'
                . '<ClientsShipmentRef>MT' . $record_data['id'] . '</ClientsShipmentRef>'
                . '<ClientUID>' . self::CLIENT_UID . '</ClientUID>'
                . '<Sender>' . $record_data['contact_person'] . '</Sender>'
                . '<SenderService>' . $service_temp[0] . '</SenderService>';

            if ($service_temp[0] == 0)
            {
                $request .=
                    '<SenderBranch_UID>' . $shipment_data['branch_from'] . '</SenderBranch_UID>';
            }
            else
            {
                $request .=
                    '<SenderStreet_UID>' . $record_data['partner_street_from'] . '</SenderStreet_UID>'
                    . '<SenderHouse>0</SenderHouse>'
                    . '<SenderFlat>' . $shipment_data['flat_from'] . '</SenderFlat>';
            }

            $request .=
                '<SenderTel>' . $phone . '</SenderTel>'
				. '<Receiver>' . $shipment_data['receiver_name'] . '</Receiver>'
                . '<ReceiverService>' . $service_temp[1] . '</ReceiverService>';

            if ($service_temp[1] == 0)
            {
                $request .=
                    '<ReceiverBranch_UID>' . $shipment_data['branch_to'] . '</ReceiverBranch_UID>';
            }
            else
            {
                $request .=
                    '<ReceiverStreet_UID>' . $record_data['partner_street_to'] . '</ReceiverStreet_UID>'
                    . '<ReceiverHouse>0</ReceiverHouse>'
                    . '<ReceiverFlat>' . $shipment_data['flat_to'] . '</ReceiverFlat>';
            }

            $request .=
                '<ReceiverTel>' . $shipment_data['receiver_phone'] . '</ReceiverTel>'
				. '<COD/>'
				. '<Notation>' . $notation . '</Notation>'
				. '<Receiver_Pay>' . $shipment_data['receiver_pay'][0] . '</Receiver_Pay>'
				. '<TypePay>1</TypePay>'
				. '<Conditions_items/>'
				. '<Places_items>'
				. '<SendingFormat>PAX</SendingFormat>'
				. '<Quantity>1</Quantity>'
				. '<Volume>' . ($record_data['length'] * $record_data['width'] * $record_data['height']) . '</Volume>'
				. '<Weight>' . ($record_data['weight'] * 1000) . '</Weight>'
				. '<Packaging/>'
				. '<Insurance>' . $shipment_data['insurance'] . '</Insurance>'
				. '</Places_items>'
				. '</CreateShipment>'
				. '</Shipments>';

            return $request;
        }

        /**
         * Fill xml template with pickup subrequest data
         *
         * @param array $record_data
         * @param array $shipment_data
         *
         * @return string
         * @throws Exception
         */
        private function getPickupSubrequest($record_data, $shipment_data)
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

            $notation = '';

            if (!empty($shipment_data['address_from']))
            {
                $notation .= 'Адреса відправлення: ' . $shipment_data['address_from'];

                if (!empty($shipment_data['flat_from']))
                {
                    $notation .= ', кв. ' . $shipment_data['flat_from'];
                }
            }

            if (!empty($shipment_data['address_from']) && !empty($shipment_data['address_to']))
            {
                $notation .= ' | ';
            }

            if (!empty($shipment_data['address_to']))
            {
                $notation .= 'Адреса отримання: ' . $shipment_data['address_to'];

                if (!empty($shipment_data['flat_to']))
                {
                    $notation .= ', кв. ' . $shipment_data['flat_to'];
                }
            }

            $date_temp = explode('.', $shipment_data['pickup_date']);

            $request =
                '<PickUps>'
                    . '<CreatePickUp>'
                    . '<ClientUID>' . self::CLIENT_UID . '</ClientUID>'
                    . '<TypePay>1</TypePay>'
                    . '<Sender>' . $record_data['contact_person'] . '</Sender>'
                    . '<SenderStreet_UID>' . $record_data['partner_street_from'] . '</SenderStreet_UID>'
                    . '<SenderHouse>0</SenderHouse>'
                    . '<SenderFlat>' . $shipment_data['flat_from'] . '</SenderFlat>'
                    . '<SenderTel>' . $phone . '</SenderTel>'
                    . '<PickUpDate>' . ($date_temp[2] . '.' . $date_temp[1] . '.' . $date_temp[0]) . '</PickUpDate>'
                    . '<PickUpTimeFrom>' . $shipment_data['pickup_time_from'] . '</PickUpTimeFrom>'
                    . '<PickUpTimeTo>' . $shipment_data['pickup_time_to'] . '</PickUpTimeTo>'
                    . '<Notes>' . $notation . '</Notes>'
                    . '<Shipments_Items>'
                    . '<ClientsShipmentRef>MT' . $record_data['id'] . '</ClientsShipmentRef>'
                    . '</Shipments_Items>'
                    . '</CreatePickUp>'
                    . '</PickUps>';

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

            $record_data['partner_country_' . $full_way] = $this->cache->getLocationByCountry($record_data['country' . $way]);

            if (empty($record_data['partner_country_' . $full_way]))
            {
                $response = $this->source->read(
                    $this->getSearchRequest(
                        array(
                            'function' => 'Country',
                            'where' => 'Description' . $this->lang_suffix[$this->lang] . ' = \'' . $record_data['country_' . $full_way] . '\'',
                            'order' => ''
                        )
                    )
                );

                $results = $this->getResults($response, 'Country');
                $results_count = count($results);

                if (!empty($results) && 0 < $results_count)
                {
                    if (1 == $results_count)
                    {
                        $record_data['partner_country_' . $full_way] = (string) $results[0]->uuid;

                        $this->cache->addLocationByCountry($record_data['partner_country_' . $full_way], $record_data['country' . $way]);
                    }
                    else
                    {
                        throw new Exception('Too much results in function \'Country\' with condition {Description' . $this->lang_suffix[$this->lang] . ' = \'' . $record_data['country_' . $full_way] . '\'}');
                    }
                }
                else
                {
                    throw new Exception('No results in function \'Country\' with condition {Description' . $this->lang_suffix[$this->lang] . ' = \'' . $record_data['country_' . $full_way] . '\'}');
                }
            }

            $record_data['partner_region_' . $full_way] = $this->cache->getLocationByRegion($record_data['reg' . $way]);

            if (empty($record_data['partner_region_' . $full_way]))
            {
                $region_temp = explode(' ', $record_data['region_' . $full_way]);

                $response = $this->source->read(
                    $this->getSearchRequest(
                        array(
                            'function' => 'Region',
                            'where' => 'Description' . $this->lang_suffix[$this->lang] . ' LIKE \'%' . trim($region_temp[0], ',') . '%\'',
                            'order' => ''
                        )
                    )
                );

                $results = $this->getResults($response, 'Region');
                $results_count = count($results);

                if (!empty($results) && 0 < $results_count)
                {
                    if (1 == $results_count)
                    {
                        $record_data['partner_region_' . $full_way] = (string) $results[0]->uuid;

                        $this->cache->addLocationByRegion($record_data['partner_region_' . $full_way], $record_data['reg' . $way]);
                    }
                    else
                    {
                        throw new Exception('Too much results in function \'Region\' with condition {Description' . $this->lang_suffix[$this->lang] . ' LIKE \'' . $region_temp[0] . '%\'}');
                    }
                }
                else
                {
                    throw new Exception('No results in function \'Region\' with condition {Description' . $this->lang_suffix[$this->lang] . ' LIKE \'' . $region_temp[0] . '%\'}');
                }
            }

            $town_conditions = array();

            foreach ($this->lang_suffix as $inside_code => $outside_code)
            {
                $town_conditions[] = 'Description' . $outside_code . ' = \'' . $record_data['town' . $way] . '\'';
            }

            if (!empty($record_data['townid' . $way]))
            {
                $record_data['partner_town_' . $full_way] = $this->cache->getLocationByTown($record_data['townid' . $way]);

                if (empty($record_data['partner_town_' . $full_way]))
                {
                    $response = $this->source->read(
                        $this->getSearchRequest(
                            array(
                                'function' => 'City',
                                'where' => 'Regionuuid = \'' . $record_data['partner_region_' . $full_way] . '\' AND (' . (implode(' OR ', $town_conditions)) . ')',
                                'order' => ''
                            )
                        )
                    );

                    $results = $this->getResults($response, 'City');
                    $results_count = count($results);

                    if (!empty($results) && 0 < $results_count)
                    {
                        if (1 == $results_count)
                        {
                            $record_data['partner_town_' . $full_way] = (string) $results[0]->uuid;
                            $town_has_branch = (int) $results[0]->IsBranchInCity;

                            $this->cache->addLocationByTown($record_data['partner_town_' . $full_way], $record_data['townid' . $way]);
                        }
                        else
                        {
                            throw new Exception('Too much results in function \'City\' with condition {Regionuuid = \'' . $record_data['partner_region_' . $full_way] . '\' AND (' . (implode(' OR ', $town_conditions)) . ')}');
                        }
                    }
                    else
                    {
                        throw new Exception('No results in function \'City\' with condition {Regionuuid = \'' . $record_data['partner_region_' . $full_way] . '\' AND (' . (implode(' OR ', $town_conditions)) . ')}');
                    }
                }
            }
            elseif (!empty($record_data['address_id_' . $full_way]))
            {
                $record_data['partner_town_' . $full_way] = $this->cache->getLocationByAddress($record_data['address_id_' . $full_way]);

                if (empty($record_data['partner_town_' . $full_way]))
                {
                    $response = $this->source->read(
                        $this->getSearchRequest(
                            array(
                                'function' => 'City',
                                'where' => 'Regionuuid = \'' . $record_data['partner_region_' . $full_way] . '\' AND (' . (implode(' OR ', $town_conditions)) . ')',
                                'order' => ''
                            )
                        )
                    );

                    $results = $this->getResults($response, 'City');
                    $results_count = count($results);

                    if (!empty($results) && 0 < $results_count)
                    {
                        if (1 == $results_count)
                        {
                            $record_data['partner_town_' . $full_way] = (string) $results[0]->uuid;
                            $town_has_branch = (int) $results[0]->IsBranchInCity;

                            $this->cache->addLocationByAddress($record_data['partner_town_' . $full_way], $record_data['address_id_' . $full_way]);
                        }
                        else
                        {
                            throw new Exception('Too much results in function \'City\' with condition {Regionuuid = \'' . $record_data['partner_region_' . $full_way] . '\' AND (' . (implode(' OR ', $town_conditions)) . ')}');
                        }
                    }
                    else
                    {
                        throw new Exception('No results in function \'City\' with condition {Regionuuid = \'' . $record_data['partner_region_' . $full_way] . '\' AND (' . (implode(' OR ', $town_conditions)) . ')}');
                    }
                }
            }

            if (!empty($record_data['partner_town_' . $full_way]))
            {
                if (!empty($record_data['townid' . $way]))
                {
                    $record_data['partner_street_' . $full_way] = $this->cache->getStreetByTown($record_data['townid' . $way]);
                }
                elseif (!empty($record_data['address_id_' . $full_way]))
                {
                    $record_data['partner_street_' . $full_way] = $this->cache->getStreetByAddress($record_data['address_id_' . $full_way]);
                }

                if (empty($record_data['partner_street_' . $full_way]))
                {
                    $response = $this->source->read(
                        $this->getSearchRequest(
                            array(
                                'function' => 'Address',
                                'where' => 'Cityuuid = \'' . $record_data['partner_town_' . $full_way] . '\' AND Description' . $this->lang_suffix[$this->lang] . ' = \'***\'',
                                'order' => ''
                            )
                        )
                    );

                    $results = $this->getResults($response, 'Address');
                    $results_count = count($results);

                    if (!empty($results) && 0 < $results_count)
                    {
                        $record_data['partner_street_' . $full_way] = (string) $results[0]->uuid;

                        if (!empty($record_data['townid' . $way]))
                        {
                            $this->cache->addStreetByTown($record_data['partner_street_' . $full_way], $record_data['townid' . $way]);
                        }
                        elseif (!empty($record_data['address_id_' . $full_way]))
                        {
                            $this->cache->addStreetByAddress($record_data['partner_street_' . $full_way], $record_data['address_id_' . $full_way]);
                        }
                    }
                    else
                    {
                        throw new Exception('No results in function \'Address\' with condition {Cityuuid = \'' . $record_data['partner_town_' . $full_way] . '\' AND Description' . $this->lang_suffix[$this->lang] . ' = \'***\'' . '}');
                    }
                }
            }

            if (empty($record_data['service']))  // Шукати відділення тільки, якщо не задано умови відправки-прийому (перший запит на обрахування ціни)
            {
                $record_data['branch_' . $full_way] = $this->cache->getRandomBranch($record_data['townid' . $way], $record_data['address_id_' . $full_way]);

                if (!empty($town_has_branch) && empty($record_data['branch_' . $full_way])) // Робити запит по відділенням тільки при додаванні міста до кешу, коли у нього стоїть мітка, що воно має відділення
                {
                    if (!empty($record_data['partner_town_' . $full_way]))
                    {
                        $where = 'Cityuuid = \'' . $record_data['partner_town_' . $full_way] . '\'';
                    }
                    else
                    {
                        $where = 'Description' . $this->lang_suffix[$this->lang] . ' LIKE \'%' . $record_data['town' . $way] . '%\'';
                    }

                    $response = $this->source->read(
                        $this->getSearchRequest(
                            array(
                                'function' => 'Branch',
                                'where' => $where,
                                'order' => ''
                            )
                        )
                    );

                    $results = $this->getResults($response, 'Branch');

                    if (!empty($results) && 0 < count($results))
                    {
                        $record_data['branch_' . $full_way] = (string) $results[0]->UUID;

                        for($i = 0, $count = count($results); $i < $count; $i++)
                        {
                            $branch_data = array();

                            $branch_data['branch_id'] = (string) $results[$i]->UUID;
                            $branch_data['town_id'] = $record_data['townid' . $way];
                            $branch_data['address_id'] = $record_data['address_id_' . $full_way];
                            $branch_data['street_id'] = (string) $results[$i]->StreetUUID;
                            $branch_data['street_name_ua'] = (string) $results[$i]->StreetDescriptionUA;
                            $branch_data['street_name_ru'] = (string) $results[$i]->StreetDescriptionRU;
                            $branch_data['street_name_uk'] = $branch_data['street_name_ru'];
                            $branch_data['house_number'] = (string) $results[$i]->House;
                            $branch_data['lat'] = (float) $results[$i]->Latitude;
                            $branch_data['lng'] = (float) $results[$i]->Longitude;
                            $branch_data['weight_limited'] = (float) $results[$i]->Limitweight;

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

                if ('000' == $responseXML->errors->code)
                {
                    $this->log->addRequest(array(
                        'request' => $this->log->getLastRequest(),
                        'response' => $response,
                        'function' => $function
                    ));

                    return $responseXML->result_table->items;
                }
                else
                {
                    if (!empty($no_exception))
                    {
                        $this->log->addError('Error #' . (string) $responseXML->errors->code . ' in function \'' . $function . '\'');
                    }
                    else
                    {
                        throw new Exception('Error #' . (string) $responseXML->errors->code . ' in function \'' . $function . '\'');
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
