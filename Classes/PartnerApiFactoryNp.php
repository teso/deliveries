<?php
    class PartnerApiFactoryNp extends PartnerApiFactoryAbstract
    {
        public function createApi()
        {
            return new PartnerApiNp($this->createRecord(), $this->createSource(), $this->createCache(), $this->createLog());
        }

        public function createSource()
        {
            return new PartnerApiSourceNp;
        }

        public function createCache()
        {
            return new PartnerApiCacheNp;
        }

        public function createLog()
        {
            return PartnerApiLogNp::getInstance($this->record_id);
        }

        public function __construct($record_id)
        {
            $this->record_id = $record_id;
        }
    }