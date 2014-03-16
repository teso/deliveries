<?php
    abstract class PartnerApiFactoryAbstract
    {
        protected
            $record_id;

        abstract public function createApi();

        abstract public function createSource();

        abstract public function createCache();

        abstract public function createLog();

        public function createRecord()
        {
            return new ExchangeRecord('freight', $this->record_id);
        }
    }