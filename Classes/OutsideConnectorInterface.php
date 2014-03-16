<?php
    interface OutsideConnectorInterface
    {
        public function connect();

        public function read( $request );

        public function disconnect();
    }