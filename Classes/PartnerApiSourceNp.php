<?php
    class PartnerApiSourceNp implements PartnerApiSourceInterface
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

            curl_setopt( $this->connection, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $this->connection, CURLOPT_HTTPHEADER, array( 'Content-Type: text/xml' ) );
            curl_setopt( $this->connection, CURLOPT_HEADER, 0 );
            curl_setopt( $this->connection, CURLOPT_POST, 1 );
            curl_setopt( $this->connection, CURLOPT_SSL_VERIFYPEER, 0 );
        }

        public function read( $request )
        {
            curl_setopt($this->connection, CURLOPT_POSTFIELDS, $request);

            $response = curl_exec($this->connection);

            return $response;
        }

        public function disconnect()
        {
            curl_close($this->connection);
        }
    }
?>