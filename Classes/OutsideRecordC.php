<?php
    class OutsideRecordC extends OutsideRecordAbstract
    {
        public function save()
        {
            $is_cached = $this->_isCached( $this->record_id, $this->source );

            if( 'freight' == $this->section )
            {
                $has_records = OutsideUserAbstract::hasRecord( $this->owner_id );
            }

            if( ('freight' == $this->section && (empty( $this->owner_id ) || empty( $this->group_id ) || empty( $this->email_id ) || $has_records))
                || ('vehicle' == $this->section && !empty( $this->owner_id ))
                || !isMail( $this->email ) )
            {
                if( 'freight' == $this->section )
                {
                    if( empty( $this->owner_id ) )
                    {
                        $this->status = self::NO_OWNER_ID;
                    }
                    elseif( empty( $this->group_id ) )
                    {
                        $this->status = self::NO_GROUP_ID;
                    }
                    elseif( empty( $this->email_id ) )
                    {
                        $this->status = self::NO_EMAIL_ID;
                    }
                    elseif( $has_records )
                    {
                        $this->status = self::HAS_RECORD;
                    }
                }
                else
                {
                    if( !empty( $this->owner_id ) )
                    {
                        $this->status = self::REGISTERED;
                    }
                }

                if( !isMail( $this->email ) )
                {
                    $this->status = self::NO_EMAIL;
                }
            }
            else
            {
                if( 'freight' == $this->section )
                {
                    $values = $this->compact( $this->records_fields );

                    $values['adr'] = !empty( $values['adr'] ) ? 'Y' : 'N';
                    $values['cmr'] = !empty( $values['cmr'] ) ? 'Y' : 'N';
                    $values['tir'] = !empty( $values['tir'] ) ? 'Y' : 'N';

                    if( !empty( $is_cached ) )
                    {
                        $this->id = $is_cached;

                        $record_info = Db::i()->getRow( 'SELECT adddate, status FROM freight WHERE id = ' . $this->id );

                        if( 'won' == $record_info['status'] )
                        {
                            Db::i()->insert( $this->section, $values );

                            $this->id = Db::i()->insert_id;
                            $this->our_record_id = $this->id;
                        }
                        else
                        {
                            if( strtotime( $record_info['adddate'] ) > time() - 60*60*4 )
                            {
                                unset( $values['adddate'] );
                            }

                            Db::i()->update( $this->section, $values, array( 'id' => $this->id ) );
                        }
                    }
                    else
                    {
                        Db::i()->insert( $this->section, $values );

                        $this->id = Db::i()->insert_id;
                        $this->our_record_id = $this->id;
                    }

                    if( !empty( Db::i()->error ) )
                    {
                        @Tools::report( Db::i()->displayLastQuery(), 'CargoGeo Import Record Error' );
                    }
                }

                $values = $this->compact( $this->records_outside_fields );

                if( !empty( $is_cached ) )
                {
                    unset( $values['source'] );
                    unset( $values['record_id'] );

                    Db::i()->update( $this->section . '_outside', $values, array(
                        'source' => $this->source,
                        'record_id' => $this->record_id
                    ) );

                    if( 0 < Db::i()->affected_rows )
                    {
                        $this->status = self::UPDATED;
                    }
                    else
                    {
                        if( !empty( Db::i()->error ) )
                        {
                            $this->status = self::UPDATE_ERROR;

                            @Tools::report( Db::i()->displayLastQuery(), 'CargoGeo Import Record Error' );
                        }
                        else
                        {
                            $this->status = self::NOT_UPDATED;
                        }
                    }
                }
                else
                {
                    Db::i()->insert( $this->section . '_outside', $values );

                    $this->record_id = Db::i()->insert_id;

                    if( 0 < Db::i()->affected_rows )
                    {
                        $this->status = self::ADDED;
                    }
                    else
                    {
                        $this->status = self::ADD_ERROR;

                        @Tools::report( Db::i()->displayLastQuery(), 'CargoGeo Import Record Error' );
                    }
                }
            }
        }

        public function __construct( $section, $record_data )
        {
            parent::__construct( $section, $record_data );
        }
    }
    