<?php
    class OutsideUserC extends OutsideUserAbstract
    {
        public function save()
        {
            if( false === $this->is_cached )
            {
                $values = $this->compact( $this->users_outside_fields );

                if( !empty( $values ) )
                {
                    Db::i()->insert( 'users_outside', $values );

                    if( 0 < Db::i()->affected_rows )
                    {
                        $this->cached_id = Db::i()->insert_id;
                        $this->status = self::ADDED;
                    }
                    else
                    {
                        $this->status = self::ADD_ERROR;

                        @Tools::report( Db::i()->displayLastQuery(), 'CargoGeo Import User Error' );
                    }
                }
            }
            elseif( 0 == $this->is_cached )
            {
                if( 'vehicle' == $this->section )
                {
                    $this->status = self::EXISTS;
                }
            }
            elseif( 0 < $this->is_cached )
            {
                $this->status = self::EXISTS;
            }

            if( 'freight' == $this->section )
            {
                if( !isMail( $this->email ) )
                {
                    $this->status = self::NO_EMAIL;
                }
                elseif( empty( $this->cached_id ) )
                {
                    $this->status = self::NO_CACHED_ID;
                }
                else
                {
                    $phones = explode( ',', $this->phones );

                    if( empty( $this->id ) )
                    {
                        $values = $this->compact( $this->users_fields );
                        $new_user_data = User::addUserSimple( $values, array( 'no_notify' => true, 'lang' => $values['lang'] ) );

                        $this->id = $new_user_data['user_id'];
                        $this->group_id = $new_user_data['group_id'];
                        $this->email_id = $new_user_data['email_id'];

                        if( 1 < count( $phones ) )
                        {
                            array_shift( $phones );

                            User::addContactData( $this->id, array(
                                'contact_person' => $this->contact_person,
                                'phone' => $phones,
                            ), $this->lang );
                        }
                    }
                    else
                    {
                        $existing_user_data = User::addContactData( $this->id, array(
                            'contact_person' => $this->contact_person,
                            'email' => $this->email,
                            'icq' => $this->icq,
                            'skype' => $this->skype,
                            'phone' => $phones,
                        ), $this->lang );

                        $this->group_id = $existing_user_data['group_id'];
                        $this->email_id = $existing_user_data['email_id'];
                    }
                }
            }

            if( !empty( $this->id ) )
            {
                Db::i()->update( 'users_outside', array( 'our_company_id' => $this->id ), array(
                    'source' => $this->source,
                    'company_id' => $this->company_id
                ) );

                if( false !== $this->is_cached && 0 == $this->is_cached )
                {
                    if( 0 < Db::i()->affected_rows )
                    {
                        $this->status = self::UPDATED;
                    }
                    else
                    {
                        if( !empty( Db::i()->error ) )
                        {
                            $this->status = self::UPDATE_ERROR;

                            @Tools::report( Db::i()->displayLastQuery(), 'CargoGeo Import User Error' );
                        }
                        else
                        {
                            $this->status = self::NOT_UPDATED;
                        }
                    }
                }
            }
        }

        public function __construct( $section, $user_data )
        {
            parent::__construct( $section, $user_data );
        }
    }