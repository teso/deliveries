<?php
    abstract class PartnerApiAbstract
    {
        protected
            $record = null,
            $source = null,
            $cache = null,
            $log = null;

        abstract protected function getPrice($request_data);

        abstract protected function registerShipment( $shipment_data );

        abstract protected function getShipmentStatus( $record_id );

        /**
         * Set inside record object, source object for connecting to partner api and object for caching constant information
         *
         * @param ExchangeRecord            $record
         * @param PartnerApiSourceInterface $source
         * @param PartnerApiCacheInterface  $cache
         */
        public function __construct( ExchangeRecord $record, PartnerApiSourceInterface $source, PartnerApiCacheInterface $cache, PartnerApiLogAbstract $log )
        {
            $this->record = $record;
            $this->cache = $cache;
            $this->source = $source;
            $this->log = $log;

            $this->source->connect();
        }

        public function __destruct()
        {
            $this->log->save();
            $this->source->disconnect();
        }
    }
?>