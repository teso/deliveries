<?php
    abstract class OutsideAddingAbstract
    {
        protected
            $connector;

        abstract public function add( $data );

        public function __construct( OutsideConnectorInterface $connector )
        {
            $this->connector = $connector;

            $this->connector->connect();
        }

        public function __destruct()
        {
            $this->connector->disconnect();
        }
    }