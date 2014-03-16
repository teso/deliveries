<?php
    $noEcho = true;

    include_once( "../../settings.add.php" );
    include_once( PHP_ROOT . "/system/config.add.php" );
    include_once( PHP_ROOT . "/system/systemUpdate.php" );
    include_once( PHP_ROOT . '/system/standart.add.php' );

    loadlang( 'el', PHP_ROOT . '/common/exchange/lang/' );

    $record_id = (int)$_POST['record_id'];
    $alias = $_POST['alias'];

    if ($alias == 'me')
    {
        $Factory = new PartnerApiFactoryMe($record_id);
    }
    elseif($alias == 'np')
    {
        $Factory = new PartnerApiFactoryNp($record_id);
    }
    else
    {
        echo Tools::json_encode(array('result' => 2));
    }

    $PartnerApi = $Factory->createApi();
    $Log = $Factory->createLog();

    switch( $_POST['action'] )
    {
        case 'make_bid' :
            $has_bids = Db::i()->getValue(
                'SELECT 1 '
                . 'FROM partners pa '
                . 'INNER JOIN exchange_bids bi '
                . 'ON bi.user_id = pa.user_id AND bi.record_id = ' . $record_id . ' '
                . 'WHERE pa.alias = \'' . $alias . '\''
            );

            if( !$has_bids )
            {
                try
                {
                    $price = $PartnerApi->getPrice( array( 'insurance' => 300 ) );

                    $data = Db::i()->getRow(
                        'SELECT pa.id AS partner_id, pa.user_id, co.group_id, co.id AS email_id '
                            . 'FROM partners pa '
                            . 'INNER JOIN users_contact_data co '
                            . 'ON co.user_id = pa.user_id AND type_id = 3 WHERE pa.alias = \'' . $alias . '\''
                    );

                    $data['amount'] = $price['actual'];
                    $data['currency_id'] = 1;
                    $data['vehicle_type_id'] = 2;
                    $data['parent_id'] = 0;
                    $data['new_email'] = '';
                    $data['details'] = '';

                    $Bid = new ExchangeBid( $record_id );

                    if( $Bid->save( $data, true ) )
                    {
                        echo Tools::json_encode(array(
                            'result' => 1,
                            'html' => $Bid->displayBidsList(array(
                                'owner_id' => ExchangeRecord::getOwner( $record_id )
                            ))
                        ));
                    }
                    else
                    {
                        echo Tools::json_encode( array( 'result' => 2 ) );
                    }
                }
                catch (Exception $e)
                {
                    $Log->addError($e->getMessage());

                    echo Tools::json_encode( array( 'result' => 2 ) );
                }
            }
            else
            {
                echo Tools::json_encode( array( 'result' => 2 ) );
            }
            break;
        case 'register_shipment':
            $shipment_data = Db::i()->getRow(
                'SELECT * '
                . 'FROM partner_shipments '
                . 'WHERE record_id = ' . $record_id . ' AND alias = \'' . $alias . '\''
            );

            if (!empty($shipment_data))
            {
                $data = Tools::json_decode($shipment_data['shipment_data']);
                $shipment_number = $shipment_data['shipment_number'];
            }
            else
            {
                try
                {
                    $data = $_POST['data'];
                    $shipment_number = $PartnerApi->registerShipment( $_POST['data'] );
                }
                catch (Exception $e)
                {
                    $Log->addError($e->getMessage());
                }
            }

            if (!empty($shipment_number))
            {
                if (!empty($data['price']))
                {
                    Db::i()->query(
                        'UPDATE partners pa '
                        . 'INNER JOIN exchange_bids bi '
                        . 'ON bi.user_id = pa.user_id AND bi.record_id = ' . $record_id . ' '
                        . 'SET bi.amount = ' . $data['price'] . ' '
                        . 'WHERE pa.alias = \'' . $alias . '\''
                    );
                }

                $bid_data = Db::i()->getRow(
                    'SELECT bi.*, bi.id AS bid_id '
                    . 'FROM partners pa '
                    . 'INNER JOIN exchange_bids bi '
                    . 'ON bi.user_id = pa.user_id AND bi.record_id = ' . $record_id . ' '
                    . 'WHERE pa.alias = \'' . $alias . '\''
                );

                $Record = $Factory->createRecord();
                $Cache = $Factory->createCache();
                $Bid = new ExchangeBid( $record_id );

                $Bid->accept($bid_data);
                $Bid->approve($bid_data);

                $record_data = $Record->getViewData();

                $data['town_id'] = $record_data['townidf'];
                $data['address_id'] = $record_data['address_id_from'];
                $data['shipment_number'] = $shipment_number;
                $data['branch_data'] = $Cache->getBranchData($data);

                $PartnerApi->sendReport($data);

                echo Tools::json_encode(array(
                    'result' => 1,
                    'number' => $shipment_number,
                    'branch_data' => $data['branch_data'],
                    'html' => $Bid->displayBidsList(array(
                        'owner_id' => ExchangeRecord::getOwner( $record_id )
                    ))
                ));
            }
            else
            {
                echo Tools::json_encode( array( 'result' => 2 ) );
            }
            break;
        case 'get_price':
            try
            {
                $price = $PartnerApi->getPrice( $_POST['data'] );

                echo Tools::json_encode(array('result' => 1, 'price' => $price));
            }
            catch (Exception $e)
            {
                $Log->addError($e->getMessage());

                echo Tools::json_encode( array( 'result' => 2 ) );
            }
            break;
        default :
            break;
    }