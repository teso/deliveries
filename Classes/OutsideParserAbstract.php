<?php
    abstract class OutsideParserAbstract extends EntityAbstract
    {
        private
            $type;
        protected
            $iteration_number,
            $section,
            $connection,
            $cookies,
            $process_locked;

        abstract protected function _getCookies( $host, $query );

        abstract protected function _getDirections();

        abstract protected function _getListData( $directions, $page_number );

        abstract protected function parseListData();

        abstract protected function _getPageData( $page_url );

        abstract protected function _parsePageData( OutsideUserAbstract $User, $page_url );

        abstract protected function _getCountryId( $outside_country_id );

        abstract protected function _getRegionId( $outside_region_id );

        abstract protected function _getVehicleId( $outside_vehicle_id );

        protected function _read( $url, $headers = array(), $writing_data = '' )
        {
            if( !empty( $headers ) )
            {
                curl_setopt( $this->connection, CURLOPT_HTTPHEADER, $headers );
            }

            if( !empty( $writing_data ) )
            {
                curl_setopt( $this->connection, CURLOPT_POSTFIELDS, $writing_data );
            }

            curl_setopt( $this->connection, CURLOPT_URL, $url );

            return curl_exec( $this->connection );
        }

        protected function _output( $text )
        {
            if( Tools::isConsoleMode() )
            {
                echo $text;
            }
        }

        public function __construct( $type, $section )
        {
            $this->type = $type;
            $this->section = $section;

            if( Tools::isConsoleMode() )
            {
                $this->process_locked = Routine::lockProcess( 'import_' . $this->section . '_' . $this->type ) ;
            }

            $this->iteration_number = (int)@file_get_contents( dirname( dirname( __FILE__ ) ) . '/system/cron/import_' . $this->section . '_' . $this->type . '.data' );

            if( empty( $this->iteration_number ) )
            {
                $this->iteration_number = 1;
            }

            $this->connection = curl_init();

            curl_setopt( $this->connection, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31' );
            curl_setopt( $this->connection, CURLOPT_COOKIE, $this->cookies );
            curl_setopt( $this->connection, CURLOPT_RETURNTRANSFER, true );
            //curl_setopt( $this->connection, CURLOPT_HEADER, true );
            //curl_setopt( $this->connection, CURLOPT_NOBODY, true );
            curl_setopt( $this->connection, CURLOPT_TIMEOUT, 60 );
            curl_setopt( $this->connection, CURLOPT_PROXY, '178.89.157.142:3128' ); //193.232.106.50:3128
            curl_setopt( $this->connection, CURLOPT_PROXYUSERPWD, 'proxyman:haproxy' );
            //curl_setopt( $this->connection, CURLOPT_PROXY, '94.137.239.19:81' ); //193.232.106.50:3128
        }

        public function __destruct()
        {
            if( !empty( $this->connection ) )
            {
                curl_close( $this->connection );
            }

            file_put_contents( dirname( dirname( __FILE__ ) ) . '/system/cron/import_' . $this->section . '_' . $this->type . '.data', $this->iteration_number + 1 );

            if( Tools::isConsoleMode() && !empty($this->process_locked) )
            {
                Routine::unlockProcess( 'import_' . $this->section . '_' . $this->type );
            }
        }
    }