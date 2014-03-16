<?php
    abstract class EntityAbstract
    {
        const
            UNDEFINED = 0,
            ADDED = 1,
            NOT_ADDED = 2,
            UPDATED = 3,
            NOT_UPDATED = 4,
            REGISTERED = 5,
            EXISTS = 6,
            NO_PAGE = 7,
            NO_EMAIL = 8,
            PROCESSED = 9,
            HAS_RECORD = 10,
            NO_CONNECTION = 11,
            CLOSED = 12,
            DELETED = 13,
            NOT_DELETED = 14,
            NO_OWNER_ID = 15,
            NO_GROUP_ID = 16,
            NO_EMAIL_ID = 17,
            UPDATE_ERROR = 18,
            ADD_ERROR = 19,
            DELETE_ERROR = 20,
            IGNORED = 21,
            NO_RECORD_DATA = 22,
            NO_PAGE_DATA = 23,
            NO_CACHED_ID = 24,
            NO_PHONE = 25;

        private
            $status = self::UNDEFINED;

        protected
            $statuses_explanation= array(
                0 => 'UNDEFINED',
                1 => 'ADDED',
                2 => 'NOT ADDED',
                3 => 'UPDATED',
                4 => 'NOT UPDATED',
                5 => 'REGISTERED',
                6 => 'EXISTS',
                7 => 'NO PAGE',
                8 => 'NO EMAIL',
                9 => 'PROCESSED',
                10 => 'HAS RECORDS',
                11 => 'NO CONNECTION',
                12 => 'CLOSED',
                13 => 'DELETED',
                14 => 'NOT DELETED',
                15 => 'NO OWNER_ID',
                16 => 'NO GROUP_ID',
                17 => 'NO EMAIL_ID',
                18 => 'UPDATE ERROR',
                19 => 'ADD ERROR',
                20 => 'DELETE ERROR',
                21 => 'IGNORED',
                22 => 'NO RECORD DATA',
                23 => 'NO PAGE DATA',
                24 => 'NO CACHED ID',
                25 => 'NO PHONE',
            );

        public function getStatus()
        {
            return $this->status;
        }

        public function setStatus( $status )
        {
            $this->status = $status;
        }

        public function extract( $properties_data )
        {
            try
            {
                foreach( $properties_data as $property_name => $property_value )
                {
                    if( property_exists( $this, $property_name ) )
                    {
                        $this->{$property_name} = $property_value;
                    }
                    else
                    {
                        throw new Exception( 'Unknown property "' . $property_name . '" of "' . get_class( $this ) . '" class'  );
                    }
                }
            }
            catch( Exception $e )
            {
                echo 'Error: ' . $e->getMessage() . chr( 10 );
            }
        }

        public function compact( $filter_array )
        {
            $values = array();

            foreach( $filter_array as $property_name )
            {
                if( isset( $this->{$property_name} ) )
                {
                    $values[$property_name] = $this->{$property_name};
                }
            }

            return $values;
        }

        public function __get( $property_name )
        {
            try
            {
                if( property_exists( $this, $property_name ) )
                {
                    $method_name =  'get' . str_replace( ' ', '', ucwords( str_replace( '_', ' ', $property_name ) ) );

                    if( method_exists( $this, $method_name ) )
                    {
                        return $this->{$method_name}();
                    }
                    else
                    {
                        throw new Exception( 'Property "' . $property_name . '" has not getter method' );

                        return null;
                    }
                }
                else
                {
                    throw new Exception( 'Unknown property "' . $property_name . '" of "' . get_class( $this ) . '" class'  );

                    return null;
                }
            }
            catch( Exception $e )
            {
                echo 'Error: ' . $e->getMessage() . chr( 10 );
            }
        }

        public function __set( $property_name, $property_value )
        {
            try
            {
                if( property_exists( $this, $property_name ) )
                {
                    $method_name =  'set' . str_replace( ' ', '', ucwords( str_replace( '_', ' ', $property_name ) ) );

                    if( method_exists( $this, $method_name ) )
                    {
                        $this->{$method_name}( $property_value );
                    }
                    else
                    {
                        throw new Exception( 'Property "' . $property_name . '" has not setter method' );
                    }
                }
                else
                {
                    throw new Exception( 'Unknown property "' . $property_name . '" of "' . get_class( $this ) . '" class'  );
                }
            }
            catch( Exception $e )
            {
                echo 'Error: ' . $e->getMessage() . chr( 10 );
            }
        }

        public function __isset( $property_name )
        {
            isset( $this->$property_name );
        }

        public function __unset( $property_name )
        {
            unset( $this->$property_name );
        }
    }