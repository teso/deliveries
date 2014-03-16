<?php
    class PartnerApiCacheNp implements PartnerApiCacheInterface
    {
        public function getBranches( $town_id, $address_id, $weight )
        {
            if( !empty( $town_id ) )
            {
                return Db::i()->getAll(
                    'SELECT *, address_' . LANG . ' AS address '
                    . 'FROM branches_np '
                    . 'WHERE town_id = ' . $town_id . ' AND (weight_limit = 0 OR weight_limit >= ' . ($weight * 1000) . ') '
                    . 'ORDER BY number'
                );
            }
            elseif( !empty( $address_id ) )
            {
                return Db::i()->getAll(
                    'SELECT *, address_' . LANG . ' AS address '
                    . 'FROM branches_np '
                    . 'WHERE address_id = ' . $address_id . ' AND (weight_limit = 0 OR weight_limit >= ' . ($weight * 1000) . ') '
                    . 'ORDER BY number'
                );
            }
            else
            {
                return array();
            }
        }

        public function getRandomBranch( $town_id, $address_id )
        {
            if( !empty( $town_id ) )
            {
                return Db::i()->getValue( 'SELECT branch_id FROM branches_np WHERE town_id = ' . $town_id . ' ORDER BY RAND()' );
            }
            elseif( !empty( $address_id ) )
            {
                return Db::i()->getValue( 'SELECT branch_id FROM branches_np WHERE address_id = ' . $address_id . ' ORDER BY RAND()' );
            }
            else
            {
                return false;
            }
        }

        public function getBranchData($shipment_data)
        {
            $branch_data = array(
                'address' => '',
                'timetable' => ''
            );

            if (!empty($shipment_data['branch_from']))
            {
                if (!empty($shipment_data['town_id']))
                {
                    $data = Db::i()->getRow(
                        'SELECT *, address_' . LANG . ' AS address '
                        . 'FROM branches_np '
                        . 'WHERE town_id = ' . (int) $shipment_data['town_id'] . ' AND number = ' . (int) $shipment_data['branch_from']
                    );
                }
                elseif (!empty($shipment_data['address_id']))
                {
                    $data = Db::i()->getRow(
                        'SELECT *, address_' . LANG . ' AS address '
                        . 'FROM branches_np '
                        . 'WHERE address_id = ' . (int) $shipment_data['address_id'] . ' AND number = ' . (int) $shipment_data['branch_from']
                    );
                }
                else
                {
                    return $branch_data;
                }

                $branch_data['address'] = $data['address'];
                $branch_data['timetable'] = $data['timetable'];
            }

            return $branch_data;
        }

        public function addBrach( $brach_data )
        {
            return Db::i()->insert( 'branches_np', $brach_data );
        }
    }
?>