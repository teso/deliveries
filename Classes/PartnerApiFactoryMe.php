<?php
    class PartnerApiFactoryMe extends PartnerApiFactoryAbstract
    {
        public function createApi()
        {
            return new PartnerApiMe($this->createRecord(), $this->createSource(), $this->createCache(), $this->createLog());
        }

        public function createSource()
        {
            return new PartnerApiSourceMe;
        }

        public function createCache()
        {
            return new PartnerApiCacheMe;
        }

        public function createLog()
        {
            return PartnerApiLogMe::getInstance($this->record_id);
        }

        public function __construct($record_id)
        {
            $this->record_id = $record_id;
        }
    }