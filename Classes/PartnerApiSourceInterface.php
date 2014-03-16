<?php
    interface PartnerApiSourceInterface
    {
        public function connect();

        public function read( $request );

        public function disconnect();
    }
?>