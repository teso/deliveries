<?php
    class OutsideConnectorL implements OutsideConnectorInterface
    {
        private
            $connection = null;

        public function setUrl( $url )
        {
            curl_setopt( $this->connection, CURLOPT_URL, $url );
        }

        public function connect()
        {
            $this->connection = curl_init();

            curl_setopt( $this->connection, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31' );
            curl_setopt( $this->connection, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $this->connection, CURLOPT_HEADER, false );
            curl_setopt( $this->connection, CURLOPT_TIMEOUT, 30 );
            curl_setopt( $this->connection, CURLOPT_POST, true );
            curl_setopt( $this->connection, CURLOPT_PROXY, '178.89.157.142:3128' );
            curl_setopt( $this->connection, CURLOPT_PROXYUSERPWD, 'proxyman:haproxy' );
        }

        public function read( $request )
        {
            curl_setopt( $this->connection, CURLOPT_POSTFIELDS, http_build_query( $request ) );

            $response = curl_exec( $this->connection );

            return $response;
        }

        public function disconnect()
        {
            if (!empty( $this->connection ))
            {
                curl_close( $this->connection );
            }
        }
    }