<?php
    abstract class OutsideUserAbstract extends EntityAbstract
    {
        protected
            $section,
            $is_cached,
            $users_fields = array(
                'login',
                'name',
                'countryid',
                'regid',
                'town',
                'address',
                'contact_person',
                'type_activity',
                'site',
                'email',
                'icq',
                'tel1',
                'tel2',
                'fax',
                'skype',
                'lang',
                'addition',
                'outside',
            ),
            $users_outside_fields = array(
                'company_id',
                'source',
                'section',
                'our_company_id',
                'name',
                'forwarder',
                'location',
                'phones',
                'emails',
            ),
            $id,
            $group_id,
            $email_id,
            $login,
            $name,
            $countryid,
            $regid,
            $town,
            $address,
            $contact_person,
            $type_activity,
            $site,
            $email,
            $icq,
            $tel1,
            $tel2,
            $fax,
            $skype,
            $lang,
            $addition,
            $outside,
            $company_id,
            $source,
            $our_company_id,
            $cached_id,
            $forwarder,
            $location,
            $phones,
            $emails;

        abstract public function save();

        private function _isCached( $outside_company_id, $outside_source )
        {
            $cached_info = Db::i()->getRow(
                'SELECT id, our_company_id FROM users_outside '
                    . 'WHERE source = "' . $outside_source . '" AND company_id = "' . $outside_company_id . '"'
            );

            if( !empty( $cached_info ) )
            {
                $this->cached_id = (int)$cached_info['id'];
            }

            return isset( $cached_info['our_company_id'] ) ? $cached_info['our_company_id'] : false;
        }

        public static function isRegistered( $emails, $phones = '' )
        {
            if( !empty( $emails ) )
            {
                $emails = explode( ',', $emails );

                $company_id = Db::i()->getValue(
                    'SELECT id FROM users WHERE email IN ( "' . implode( '", "', (array)$emails ) . '" )'
                );

                if( !empty( $company_id ) )
                {
                    return $company_id;
                }
            }

            if( !empty( $phones ) )
            {
                $phones = explode( ',', $phones );

                $clean_function =  function( $value ){ return preg_replace( '#[^\d]#', '', $value ); };

                $phones = array_map( $clean_function, $phones );

                $company_id = Db::i()->getValue(
                    'SELECT u.id FROM users u LEFT OUTER JOIN users_contact_data c ON u.id = c.user_id AND c.type_id = 1 WHERE c.processed_value IN ( "' . implode( '", "', (array)$phones ) . '" )'
                );

                if( !empty( $company_id ) )
                {
                    return $company_id;
                }
            }

            return 0;
        }

        public static function hasRecord( $user_id )
        {
            if( !empty( $user_id ) )
            {
                $record_count = Db::i()->getValue(
                    'SELECT COUNT(*) FROM freight '
                    . 'WHERE owner_id = "' . $user_id . '" AND source IN ( "form", "excel" )'
                );

                return !empty( $record_count ) ? true : false;
            }
            else
            {
                return false;
            }
        }

        public function getId()
        {
            return $this->id;
        }

        public function getGroupId()
        {
            return $this->group_id;
        }

        public function getEmailId()
        {
            return $this->email_id;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getPhones()
        {
            return $this->phones;
        }

        public function getIsCached()
        {
            return $this->is_cached;
        }

        public function getCompanyId()
        {
            return $this->company_id;
        }

        public function getCachedId()
        {
            return $this->cached_id;
        }

        public function setEmail( $value )
        {
            $this->email = $value;
        }

        public function setStatus( $value )
        {
            $this->status = $value;
        }

        public function __construct( $section, $user_data )
        {
            $this->section = $section;

            $this->extract( $user_data );

            if( !empty( $this->company_id ) && !empty( $this->source ) )
            {
                $this->is_cached = $this->_isCached( $this->company_id, $this->source );
                $this->id = (int)$this->is_cached;
            }

            if( empty( $this->id ) )
            {
                $this->id = OutsideUserAbstract::isRegistered( $this->emails, $this->phones );
            }
        }
    }