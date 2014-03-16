<?php
    abstract class PartnerApiLogAbstract
    {
        protected
            $record_id,
            $last_request = '',
            $last_response = '',
            $errors = array(),
            $requests = array();

        abstract public function save();

        public function setLastRequest($request)
        {
            $this->last_request = $request;
        }

        public function setLastResponse($response)
        {
            $this->last_response = $response;
        }

        public function getLastRequest()
        {
            return $this->last_request;
        }

        public function getLastResponse()
        {
            return $this->last_response;
        }

        public function addError($error)
        {
            $this->errors[] = $error;
        }

        public function addRequest($request)
        {
            $this->requests[] = $request;
        }

        final public static function getInstance($record_id)
        {
            static $instance = null;

            if ($instance === null)
            {
                $instance = new static($record_id);
            }

            return $instance;
        }

        private function __construct($record_id)
        {
            $this->record_id = $record_id;
        }

        final private function __clone(){}
        final private function __sleep(){}
        final private function __wakeup(){}
    }
?>