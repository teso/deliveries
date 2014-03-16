<?php
    class PartnerApiCacheMe implements PartnerApiCacheInterface
    {
        public function getBranches( $town_id, $address_id, $weight )
        {
            if( !empty( $town_id ) )
            {
                return Db::i()->getAll(
                    'SELECT *, CONCAT(\'' . l('street_short', 'el') . ' \', street_name_' . LANG . ', \', \', house_number) AS address '
                    . 'FROM branches_me '
                    . 'WHERE town_id = ' . $town_id . ' AND (weight_limit = 0 OR weight_limit >= ' . ($weight * 1000) . ') '
                    . 'ORDER BY address'
                );
            }
            elseif( !empty( $address_id ) )
            {
                return Db::i()->getAll(
                    'SELECT *, CONCAT(\'' . l('street_short', 'el') . ' \', street_name_' . LANG . ', \', \', house_number) AS address '
                    . 'FROM branches_me '
                    . 'WHERE address_id = ' . $address_id . ' AND (weight_limit = 0 OR weight_limit >= ' . ($weight * 1000) . ') '
                    . 'ORDER BY address'
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
                return Db::i()->getValue( 'SELECT branch_id FROM branches_me WHERE town_id = ' . $town_id . ' ORDER BY RAND()' );
            }
            elseif( !empty( $address_id ) )
            {
                return Db::i()->getValue( 'SELECT branch_id FROM branches_me WHERE address_id = ' . $address_id . ' ORDER BY RAND()' );
            }
            else
            {
                return false;
            }
        }

        public function getBranchData($shipment_data)
        {
            $result = array(
                'address' => '',
                'timetable' => ''
            );

            if (!empty($shipment_data['branch_from']))
            {
                $branch_data = Db::i()->getRow('SELECT * FROM branches_me WHERE branch_id = \'' . $shipment_data['branch_from'] . '\'');

                $result['address'] = l('street_short', 'el') . ' ' . $branch_data['street_name_' . LANG] . ', ' . $branch_data['house_number'];
                $result['timetable'] = 'пн-пт: 08:00-20:00; сб: 09:00-16:00';
            }

            return $result;
        }

        public function addBrach( $brach_data )
        {
            return Db::i()->insert( 'branches_me', $brach_data );
        }

        public function getLocationByCountry( $country_id )
        {
            return Db::i()->getValue( 'SELECT location_id FROM locations_me WHERE country_id = ' . $country_id );
        }

        public function getLocationByRegion( $region_id )
        {
            return Db::i()->getValue( 'SELECT location_id FROM locations_me WHERE region_id = ' . $region_id );
        }

        public function getLocationByTown( $town_id )
        {
            return Db::i()->getValue( 'SELECT location_id FROM locations_me WHERE town_id = ' . $town_id );
        }

        public function getLocationByAddress( $address_id )
        {
            return Db::i()->getValue( 'SELECT location_id FROM locations_me WHERE address_id = ' . $address_id );
        }

        public function getStreetByTown( $town_id )
        {
            return Db::i()->getValue( 'SELECT IF(last_update + INTERVAL 1 MONTH > NOW(), street_id, 0) FROM streets_me WHERE town_id = ' . $town_id );
        }

        public function getStreetByAddress( $address_id )
        {
            return Db::i()->getValue( 'SELECT IF(last_update + INTERVAL 1 MONTH > NOW(), street_id, 0) FROM streets_me WHERE address_id = ' . $address_id );
        }

        public function addLocationByCountry( $location_id, $country_id )
        {
            return Db::i()->insert( 'locations_me', array( 'location_id' => $location_id, 'country_id' => $country_id ) );
        }

        public function addLocationByRegion( $location_id, $region_id )
        {
            return Db::i()->insert( 'locations_me', array( 'location_id' => $location_id, 'region_id' => $region_id ) );
        }

        public function addLocationByTown( $location_id, $town_id )
        {
            return Db::i()->insert( 'locations_me', array( 'location_id' => $location_id, 'town_id' => $town_id ) );
        }

        public function addLocationByAddress( $location_id, $address_id )
        {
            return Db::i()->insert( 'locations_me', array( 'location_id' => $location_id, 'address_id' => $address_id ) );
        }

        public function addStreetByTown( $street_id, $town_id )
        {
            return Db::i()->insert( 'streets_me', array( 'street_id' => $street_id, 'town_id' => $town_id, 'last_update' => Db::i()->now() ), false, false, array('street_id', 'last_update') );
        }

        public function addStreetByAddress( $street_id, $address_id )
        {
            return Db::i()->insert( 'streets_me', array( 'street_id' => $street_id, 'address_id' => $address_id, 'last_update' => Db::i()->now() ), false, false, array('street_id', 'last_update') );
        }
    }
?>