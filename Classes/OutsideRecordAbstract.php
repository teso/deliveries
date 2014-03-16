<?php
    abstract class OutsideRecordAbstract extends EntityAbstract
    {
        protected
            $section,
            $records_fields = array(
                'category_id',
                'user',
                'date_add',
                'owner_id',
                'group_id',
                'email_id',
                'forwarder',
                'actual_before',
                'adddate',
                'datef',
                'datet',
                'countryf',
                'countryt',
                'regf',
                'regt',
                'townf',
                'townt',
                'townidf',
                'townidt',
                'address_id_from',
                'address_id_to',
                'lat_from',
                'lng_from',
                'lat_to',
                'lng_to',
                'pathlen',
                'distance_prov',
                'gmaps_path',
                'price',
                'currencyid',
                'for',
                'pay_form',
                'freight',
                'vehicle_id',
                'loadtype',
                'weight',
                'space',
                'length',
                'width',
                'height',
                'number',
                'adr',
                'cmr',
                'tir',
                'add_load',
                'info',
                'source',
            ),
            $records_outside_fields = array(
                'record_id',
                'our_record_id',
                'source',
                'adddate',
                'outside_owner_id',
                'forwarder',
                'datef',
                'datet',
                'countryf',
                'countryt',
                'regf',
                'regt',
                'townf',
                'townt',
                'townidf',
                'townidt',
                'address_id_from',
                'address_id_to',
                'lat_from',
                'lng_from',
                'lat_to',
                'lng_to',
                'price',
                'currencyid',
                'for',
                'pay_form',
                'freight',
                'vehicle_id',
                'loadtype',
                'weight',
                'space',
                'length',
                'width',
                'height',
                'number',
                'adr',
                'cmr',
                'tir',
                'add_load',
                'info',
                'email',
                'deleted',
            ),
                $id,
                $record_id,
                $our_record_id,
                $source,
                $outside_owner_id,
                $category_id,
                $forwarder,
                $user,
                $date_add,
                $owner_id,
                $group_id,
                $email_id,
                $actual_before,
                $adddate,
                $datef,
                $datet,
                $countryf,
                $countryt,
                $regf,
                $regt,
                $townf,
                $townt,
                $townidf,
                $townidt,
                $address_id_from,
                $address_id_to,
                $lat_from,
                $lng_from,
                $lat_to,
                $lng_to,
                $pathlen,
                $distance_prov,
                $gmaps_path,
                $price,
                $currencyid,
                $for,
                $pay_form,
                $freight,
                $vehicle_id,
                $loadtype,
                $weight,
                $space,
                $length,
                $width,
                $height,
                $number,
                $adr,
                $cmr,
                $tir,
                $add_load,
                $info,
                $email,
                $deleted,
                $phones,
                $is_closed;

        abstract public function save();

        protected function _isCached( $outside_record_id, $outside_source )
        {
            $is_cached = Db::i()->getValue(
                'SELECT ' . ('freight' == $this->section ? 'our_record_id' : '1') . ' '
                    . 'FROM ' . $this->section . '_outside '
                    . 'WHERE source = "' . $outside_source . '" AND record_id = "' . $outside_record_id . '"' );

            return isset( $is_cached ) ? $is_cached : false;
        }

        protected function _isCachedStats( $outside_record_id, $outside_source )
        {
            $is_cached = Db::i()->getValue(
                'SELECT 1 '
                    . 'FROM ' . $this->section . '_outside_stats '
                    . 'WHERE source = "' . $outside_source . '" AND record_id = "' . $outside_record_id . '"' );

            return isset( $is_cached ) ? $is_cached : false;
        }

        public function __construct( $section, $record_data )
        {
            $this->section = $section;

            $this->extract( $record_data );
        }
    }