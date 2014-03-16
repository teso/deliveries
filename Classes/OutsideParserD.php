<?php
    class OutsideParserD extends OutsideParserAbstract
    {
        protected function _getCookies( $host, $query, $others = '' )
        {/*
            $EOL = chr( 13 ) . chr( 10 );

            $path = explode( '/', $host );

            $host = $path[ 0 ];

            unset( $path[ 0 ] );

            $path = '/' . ( implode( '/', $path ) );

            $post = '';
            $post .= 'POST ' . $path . ' HTTP/1.1' . $EOL;
            $post .= 'Host: ' . $host . $EOL;
            $post .= 'Content-type: application/x-www-form-urlencoded' . $EOL;
            $post .= $others;
            $post .= 'User-Agent: Mozilla/5.0 (Windows NT 5.2; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11' . $EOL;
            $post .= 'Content-length: ' . strlen( $query ) . $EOL;
            $post .= 'Connection: close' . $EOL . $EOL;
            $post .= $query;

            $h = fsockopen( $host, 80 );

            fwrite( $h, $post );

            $r = '';

            for( $a = 0 ; !$a ; )
            {
                $b = fread( $h, 512 );

                $r .= $b;
                $gotSession = strpos( $r, 'dasc' );

                if( $gotSession && 0 < strpos( $r, $EOL . $EOL, $gotSession ) )
                {
                    break;
                }

                $a = ( ( $b == '' ) ? 1 : 0 );
            }

            fclose( $h );

            $arr = preg_split( '/Set-Cookie:/', $r );

            $this->cookies = '';
            $count = 1;

            while( $count < count( $arr ) )
            {
                $this->cookies .= substr( $arr[ $count ] . ';', 0, strpos( $arr[ $count ] . ';', ';' ) + 1 );

                $count++;
            }
            */
            $this->cookies = 'della_request_v2=YToxOntzOjM6IkNJRCI7czoxOToiMTM4MDAyMTQzNDUwODA3MTQ0OCI7fQ%3D%3D; dasc=YTo4OntzOjc6InRpbWVfdXAiO3M6MTk6IjIwMTMtMDEtMDkgMjE6NDM6NDUiO3M6NzoidXNlcl9pZCI7czoxODoiMTEwODEyMTcwOTM5MDg3MzU4IjtzOjU6ImxvZ2luIjtzOjc6InByb3N0aXIiO3M6MzoicHdkIjtzOjMyOiJiOWQwOTY1NmZiMWU4MTg5NGQxYzViZjcwMmUyZjQ1MSI7czoxMDoiZGF0ZV92aXNpdCI7czoxOToiMjAxMy0wMS0wOSAyMTo0Mzo0NSI7czoxNjoibGFzdF9vbmxpbmVfdGltZSI7aToxMzU3NzYwNjI1O3M6MTM6ImlzX2Jsb2NrX3VzZXIiO3M6MToiMCI7czozOiJvY2MiO3M6MToiMCI7fQ%3D%3D;';
        }

        protected function _getDirections()
        {
            if( 'freight' == $this->section )
            {
                return
                    array(
                        array( 'from' => 'wsng', 'to' => 'wsng', 'period' => 1, 'depth' => 3 ),       //СНГ-СНГ
                        array( 'from' => 'wsng', 'to' => 'w1',    'period' => 2, 'depth' => 1 ),         //СНГ-Європа
                        array( 'from' => 'wsng', 'to' => 'w2',    'period' => 2, 'depth' => 2 ),         //СНГ-Азія
                        array( 'from' => 'w2',    'to' => 'w2',    'period' => 2, 'depth' => 1 ),         //Азія-Азія
                        array( 'from' => 'w2',    'to' => 'wsng', 'period' => 2, 'depth' => 2 ),        //Азія-СНГ
                        array( 'from' => 'w2',    'to' => 'w1',     'period' => 6, 'depth' => 1 ),        //Азія-Європа
                        array( 'from' => 'w1',    'to' => 'w1',     'period' => 7, 'depth' => 1 ),        //Європа-Європа
                        array( 'from' => 'w1',    'to' => 'wsng', 'period' => 2, 'depth' => 2 ),        //Європа-СНГ
                        array( 'from' => 'w1',    'to' => 'w2',     'period' => 5, 'depth' => 1 ),        //Європа-Азія
                    );
            }
            else
            {
                return
                    array(
                        array( 'from' => 'wsng', 'to' => 'wsng', 'period' => 1, 'depth' => 3 ),       //СНГ-СНГ
                        array( 'from' => 'wsng', 'to' => 'w1',    'period' => 2, 'depth' => 1 ),         //СНГ-Європа
                        array( 'from' => 'wsng', 'to' => 'w2',    'period' => 2, 'depth' => 2 ),         //СНГ-Азія
                        array( 'from' => 'w2',    'to' => 'w2',    'period' => 2, 'depth' => 1 ),         //Азія-Азія
                        array( 'from' => 'w2',    'to' => 'wsng', 'period' => 2, 'depth' => 2 ),        //Азія-СНГ
                        array( 'from' => 'w2',    'to' => 'w1',     'period' => 6, 'depth' => 1 ),        //Азія-Європа
                        array( 'from' => 'w1',    'to' => 'w1',     'period' => 7, 'depth' => 1 ),        //Європа-Європа
                        array( 'from' => 'w1',    'to' => 'wsng', 'period' => 2, 'depth' => 2 ),        //Європа-СНГ
                        array( 'from' => 'w1',    'to' => 'w2',     'period' => 5, 'depth' => 1 ),        //Європа-Азія
                    );
            }
        }

        protected function _getDirectionsTest()
        {
            return
                array(
                    array( 'from' => 'wsng', 'to' => 'wsng', 'period' => 1, 'depth' => 1 ),       //СНГ-СНГ
                );
        }

        protected function _getListData( $direction, $page_number )
        {
            $url = 'http://della.ua/search/'
                . 'a'
                . (is_array( $direction['from'] ) ? $this->_getOutsideCountryId( $direction['from']['country'] ) : $direction['from'])
                . 'b'
                . (is_array( $direction['from'] ) ? $this->_getOutsideRegionId( $direction['from']['region'] ) : '')
                . 'd'
                . (is_array( $direction['to'] ) ? $this->_getOutsideCountryId( $direction['to']['country'] ) : $direction['to'])
                . 'e'
                . (is_array( $direction['to'] ) ? $this->_getOutsideRegionId( $direction['to']['region'] ) : '')
                . 'f'
                . 'l'
                . 'o'
                . 'l'
                . 'h'
                . '0'
                . 'i'
                . 'l'
                . 'k'
                . ('freight' == $this->section ? '0' : '1')
                . 'm'
                . '1';

            if( 1 < $page_number )
            {
                $url .= 'r' . (25 * ($page_number - 1)) . 'l25';
            }

            $url .= '.html';

            return $this->_read( $url );
        }

        protected function _getListDataTest()
        {
            if( 'freight' == $this->section )
            {
                return file_get_contents( dirname( dirname( __FILE__ ) ) . '/system/cron/list3.htm' );
            }
            else
            {
                return file_get_contents( dirname( dirname( __FILE__ ) ) . '/system/cron/list.htm' );
            }
        }

        public function parseListData()
        {
            sleep( rand( 5, 10 ) );

            //$directions = $this->_getDirectionsTest();
            $directions = $this->_getDirections();

            for( $direction_index = 0; $direction_index < count( $directions ); $direction_index++ )
            {
                if( 0 != $this->iteration_number % $directions[$direction_index]['period'] )
                {
                    continue;
                }

                $this->_output( 'Direction: ' . $this->_getFullName( $directions[$direction_index]['from'] ) . '-' . $this->_getFullName( $directions[$direction_index]['to'] ) . chr( 10 ) );

                for( $page_index = 0; $page_index < $directions[$direction_index]['depth']; $page_index++ )
                {
                    $this->_output( '> Page #: ' . ($page_index + 1) . ' - ' );

                    //$list_data = $this->_getListDataTest();
                    $list_data = $this->_getListData( $directions[$direction_index], $page_index + 1 );

                    if( false === $list_data )
                    {
                        $this->_output( $this->statuses_explanation[self::NO_CONNECTION] . chr( 10 ) );
                    }
                    elseif( false === strpos( $list_data, 'request_id' ) )
                    {
                        $this->_output( $this->statuses_explanation[self::NO_PAGE] . chr( 10 ) );
                    }
                    else
                    {
                        $this->_output( $this->statuses_explanation[self::PROCESSED] . chr( 10 ) );

                        $list_rows = explode( 'request_id', $list_data );

                        for( $row_index = 1; $row_index < count( $list_rows ); $row_index++ )
                        {
                            preg_match( '#multi_date.*<b>(\d{2}\.\d{2}(?:&ndash;\d{2}\.\d{2})?)</b>.*route.*<span title="(.*)"><b>(.+)</b>\s\((\w+)\)</span>.*&mdash;\s+<span title="(.*)"><b>(.+)</b>\s\((\w+)\)</span>.*truck.*<b>(.+)</b>.*weight.*<b>(.*)</b>.*cube.*<b>(.*)</b>.*price.*>(.*)</td>.*(?:(Прямой\sзаказчик\sгрузоперевозки).*)?m_txt_gr.*<b>(.*)</b>.*<span.*>(.*)</span>.*m_comment.*>(.*)</td>.*изм\.\s(.*)<br>.*(?:(заявка\sзакрыта).*)?div_phone_.*>(.*)<div class="fl_l nobr">&nbsp;&nbsp;</div>.*<div class="fl_l m_blue_phone">(.*)</div>.*(?:mailto:(.+)".*)?comp_inf.*href="(.*)"#Us', $list_rows[$row_index], $data_list );

                            if( !empty( $data_list ) )
                            {
                                preg_match( '#company/(\d+)/(\d+)/#', $data_list[21], $data_link );

                                if( !empty( $data_link[1] ) )   // ID компанії
                                {
                                    $this->_output( '>> Company ID: ' . $data_link[1] . ' - ' );

                                    if( in_array( $data_link[1], array() ) || preg_match( '#@.*della#Usi', $data_list[20] ) )     // Не обробляти дані компаній у списку
                                    {
                                        $this->_output( $this->statuses_explanation[self::IGNORED] . chr( 10 ) );
                                        continue;
                                    }

                                    $user_data = array();

                                    $user_data['company_id'] = $data_link[1];
                                    $user_data['section'] = $this->section;
                                    $user_data['source'] = 'd';
                                    $user_data['lang'] = 'ru';
                                    $user_data['forwarder'] =  !empty( $data_list[12] ) ? 0 : 1;

                                    if( !empty( $user_data['forwarder'] ) )
                                    {
                                        $user_data['type_activity'] =  '4';
                                    }
                                    else
                                    {
                                        if( 'freight' == $this->section )
                                        {
                                            $user_data['type_activity'] =  '2';
                                        }
                                        else
                                        {
                                            $user_data['type_activity'] =  '1';
                                        }
                                    }

                                    $user_data['outside'] = 1;
                                    $user_data['contact_person'] = trim( trim( strip_tags( str_replace( '&nbsp;', '', $data_list[19] ), ',' ) ) );

                                    if( !empty( $data_list[20] ) )
                                    {
                                        $user_data['email'] = trim( strip_tags( $data_list[20] ) );
                                    }

                                    $phones = explode( chr( 13 ), trim( str_replace( '&nbsp;', chr( 13 ), strip_tags( $data_list[18] ) ) ) );
                                    $phones = array_map( 'trim', $phones );
                                    $phones = array_filter( $phones, 'isPhone' );

                                    $user_data['phones'] = implode( ',', $phones );

                                    $that = $this;
                                    array_walk( $user_data, function( &$value, $key ) use ( $that, $data_list )
                                    {
                                        $value = strip_tags( $value );
                                        $value = $that->_filterValue( $value, $key, 'http://della.ua' . $data_list[21] );

                                        return $value;
                                    } );

                                    $User = new OutsideUserD( $this->section, $user_data );

                                    $this->_parsePageData( $User, 'http://della.ua' . $data_list[21] );

                                    $this->_output( $this->statuses_explanation[$User->status] . chr( 10 ) );

                                    $record_data = array();

                                    $this->_output( '>>> Record ID: ' . $data_link[2] . ' - ' );

                                    $record_data['record_id'] = $data_link[2];
                                    $record_data['is_closed'] = !empty( $data_list[17] ) ? true : false;
                                    $record_data['source'] = 'd';

                                    $times = explode( '&nbsp;&nbsp;', $data_list[16] );

                                    //$record_data['adddate'] = date( 'Y-m-d H:i:s', strtotime( $times[0] . '.' . date( 'Y' ) . ' ' . $times[1]  ) );
                                    $record_data['adddate'] = date( 'Y-m-d H:i:s', time() );
                                    $record_data['date_add'] = $record_data['adddate'];
                                    $record_data['outside_owner_id'] = $data_link[1];

                                    $dates = explode( '&#x2015;', $data_list[1] );

                                    $record_data['datef'] = date( 'Y-m-d', strtotime( $dates[0] . '.' . date( 'Y' ) ) );
                                    $record_data['datet'] = !empty( $dates[1] ) ? date( 'Y-m-d', strtotime( $dates[1] . '.' . date( 'Y' ) ) ) : $record_data['datef'];

                                    $location_array = array();
                                    $record_data['pathlen'] = 0;
                                    $record_data['distance_prov'] = '';
                                    $record_data['gmaps_path'] = 0;

                                    foreach( array( 'f', 't' ) as $way )
                                    {
                                        $base_index = 'f' == $way ? 2 : 5;
                                        $full_way = 'f' == $way ? 'from' : 'to';

                                        $record_data['country' . $way] = $this->_getCountryId( $data_list[$base_index + 2] );

                                        if( !empty( $data_list[$base_index] ) )
                                        {
                                            $record_data['reg' . $way] = $this->_getRegionId( $data_list[$base_index] );

                                            if( $data_list[$base_index] != $data_list[$base_index + 1] )
                                            {
                                                $record_data['town' . $way] = $data_list[$base_index + 1];
                                            }
                                        }
                                        else
                                        {
                                            if( !$this->_isCountry( $data_list[$base_index + 1] ) )
                                            {
                                                $record_data['town' . $way] = $data_list[$base_index + 1];
                                            }
                                        }

                                        if( !empty( $record_data['town' . $way] ) )
                                        {
                                            $Location = @Location::getByParams( $record_data['town' . $way], $record_data['reg' . $way], $record_data['country' . $way], false, false, true);

                                            if( is_object( $Location ) )
                                            {
                                                $location_array[] = $Location;

                                                if( $Location instanceof Town )
                                                {
                                                    $record_data['townid' . $way] = $Location->id;
                                                }
                                                else
                                                {
                                                    $record_data['address_id_' . $full_way] = $Location->id;
                                                }

                                                $record_data['lat_' . $full_way] = $Location->lat;
                                                $record_data['lng_' . $full_way] = $Location->lng;
                                            }
                                        }
                                    }

                                    if( empty( $record_data['countryt'] ) )
                                    {
                                        $record_data['countryt'] = $record_data['countryf'];
                                    }

                                    if( 'freight' == $this->section && 2 == count( $location_array ) )
                                    {
                                        $Direction = @Directions::get( $location_array );

                                        if( is_object( $Direction ) )
                                        {
                                            $record_data['pathlen'] = floatval( $Direction -> distance / 100 );
                                            $record_data['distance_prov'] = $Direction -> provider;
                                            $record_data['gmaps_path'] = 1;
                                        }
                                    }

                                    $record_data['vehicle_id'] = $this->_getVehicleId( $data_list[8] );

                                    $weights = explode( '-', $data_list[9] );

                                    $record_data['weight'] = (float)str_replace( ',', '.', $weights[0] );

                                    $spaces = explode( '-', $data_list[10] );

                                    $record_data['space'] = (float)str_replace( ',', '.', $spaces[0] );
                                    $record_data['email'] = $User->email;

                                    if( 'freight' == $this->section )
                                    {
                                        $record_data['freight'] = trim( $data_list[13] );
                                    }

                                    $price_info = trim( str_replace( '&nbsp;', ' ', strip_tags( $data_list[15] ) ) );

                                    preg_match( '#^(?:([\d,.\s]*\d)\s(грн|EUR|USD|рос\.руб|бел\.руб|лит|лат|эст\.крн|лей|тнг|тад\.сом|лари|AZN|AMD|кыр\.сом|TMT|сум|PLN|ROL))?[\s]?(б/н|нал\.|комбинир\.|софт|удобная)?()#s', $price_info, $data_price_info );

                                    if( !empty( $data_price_info ) )
                                    {
                                        if( !empty( $data_price_info[1] ) )
                                        {
                                            $record_data['price'] = (float)str_replace( ',', '.', str_replace( ' ', '', $data_price_info[1] ) );

                                            switch( $data_price_info[2] )
                                            {
                                                case 'грн':
                                                    $record_data['currencyid'] = 1;
                                                    break;
                                                case 'USD':
                                                    $record_data['currencyid'] = 2;
                                                    break;
                                                case 'EUR':
                                                    $record_data['currencyid'] = 3;
                                                    break;
                                                case 'рос.руб':
                                                    $record_data['currencyid'] = 4;
                                                    break;
                                                case 'бел.руб':
                                                    $record_data['currencyid'] = 5;
                                                    break;
                                                case 'тнг':
                                                    $record_data['currencyid'] = 6;
                                                    break;
                                                default :
                                                    break;
                                            }

                                            $record_data['for'] = 2;
                                        }

                                        $with_nds = false !== strpos( $price_info, 'НДС' ) ? true : false;
                                        $on_load = false !== strpos( $price_info, 'при погрузке' ) ? true : false;
                                        $on_unload = false !== strpos( $price_info, 'на выгрузке' ) ? true : false;

                                        switch( $data_price_info[3] )
                                        {
                                            case 'б/н':
                                                if( $with_nds )
                                                {
                                                    $record_data['pay_form'] = 8;
                                                }
                                                else
                                                {
                                                    $record_data['pay_form'] = 6;
                                                }
                                                break;
                                            case 'нал.':
                                                if( $on_load )
                                                {
                                                    $record_data['pay_form'] = 1;
                                                }
                                                elseif( $on_unload )
                                                {
                                                    $record_data['pay_form'] = 2;
                                                }
                                                else
                                                {
                                                    $record_data['pay_form'] = 11;
                                                }
                                                break;
                                            case 'софт':
                                                if( $on_load )
                                                {
                                                    $record_data['pay_form'] = 4;
                                                }
                                                elseif( $on_unload )
                                                {
                                                    $record_data['pay_form'] = 5;
                                                }
                                                else
                                                {
                                                    $record_data['pay_form'] = 3;
                                                }
                                                break;
                                            default :
                                                break;
                                        }
                                    }

                                    $other_info = trim( str_replace( '&nbsp;', ' ', $data_list[14] ) );

                                    $loadtypes = array();

                                    if( false !== strpos( $other_info, 'боковая' ) )
                                    {
                                        $loadtypes[] = 1;
                                    }

                                    if( false !== strpos( $other_info, 'верхняя' ) )
                                    {
                                        $loadtypes[] = 4;
                                    }

                                    if( false !== strpos( $other_info, 'задняя' ) )
                                    {
                                        $loadtypes[] = 6;
                                    }

                                    $record_data['loadtype'] = implode( ',', $loadtypes );

                                    if( false !== strpos( $other_info, 'CMR' ) )
                                    {
                                        $record_data['cmr'] = 1;
                                    }

                                    if( false !== strpos( $other_info, 'TIR' ) )
                                    {
                                        $record_data['tir'] = 1;
                                    }

                                    if( false !== strpos( $other_info, 'ADR' ) )
                                    {
                                        $record_data['adr'] = 1;
                                    }

                                    if( false !== strpos( $other_info, 'догруз' ) )
                                    {
                                        $record_data['add_load'] = 1;
                                    }

                                    preg_match( '#(?:кол.\sмашин:\s(\d+))?(?:.*длн=([\d,]+)м)?(?:.*шир=([\d,]+)м)?(?:.*выс=([\d,]+)м)?()#s', $other_info, $data_other_info );

                                    $record_data['number'] = !empty( $data_other_info[1] ) ? (int)$data_other_info[1] : 1;
                                    $record_data['length'] = (float)str_replace( ',', '.', $data_other_info[2] );
                                    $record_data['width'] = (float)str_replace( ',', '.', $data_other_info[3] );
                                    $record_data['height'] = (float)str_replace( ',', '.', $data_other_info[4] );
                                    $record_data['category_id'] = '1';
                                    $record_data['user'] = 'Y';
                                    $record_data['owner_id'] = $User->id;
                                    $record_data['group_id'] = $User->group_id;
                                    $record_data['email_id'] = $User->email_id;
                                    $record_data['actual_before'] = $record_data['datet'] . ' 23:59';

                                    $that = $this;
                                    array_walk( $record_data, function( &$value, $key ) use ( $that, $data_list )
                                    {
                                        $value = strip_tags( $value );
                                        $value = $that->_filterValue( $value, $key, 'http://della.ua' . $data_list[21] );

                                        return $value;
                                    } );

                                    $Record = new OutsideRecordD( $this->section, $record_data );

                                    $Record->save();

                                    $this->_output( $this->statuses_explanation[$Record->status] . chr( 10 ) );

                                    if( 'vehicle' == $this->section )
                                    {
                                        $cached_id = $User->cached_id;

                                        if( !empty( $cached_id ) )
                                        {
                                            if( empty( $data_list[20] ) )
                                            {
                                                unset( $record_data['email'] );
                                            }

                                            $Eirg = new ExchangeInterestRecordGuest();

                                            @$Eirg->add(
                                                array_merge($record_data,
                                                    array(
                                                        'townf' => $record_data['townf'],
                                                        'townt' => $record_data['townt'],
                                                        'guest_id'=> $cached_id,
                                                    )
                                                )
                                            );
                                        }
                                    }
                                }
                            }
                            else
                            {
                                $this->_output( $this->statuses_explanation[self::NO_RECORD_DATA] . chr( 10 ) );
                            }
                        }
                    }

                    sleep( rand( 10, 20 ) );
                }
            }
        }

        protected function _getPageData( $page_url )
        {
            //return $this->_read( $page_url );
        }

        protected function _getPageDataTest( $page_url )
        {
            return file_get_contents( dirname( dirname( __FILE__ ) ) . '/system/cron/page3.htm' );
        }

        protected function _parsePageData( OutsideUserAbstract $User, $page_url )
        {
            $phones = $User->phones;
            $phones = explode( ',', $phones );

            if( false === $User->is_cached )     // Завантажувати сторінку тільки якщо компанія не додана в кеш
            {
                //sleep( rand( 5, 10 ) );

                //$page_data = $this->_getPageDataTest( $page_url );
                $page_data = $this->_getPageData( $page_url );

                preg_match( '#Компания.*<strong>(.+)</strong>.*Расположение.*<td.*>(.+)</td>.*Телефоны\sкомпании.*<div style="float:left;">(.+)</div>.*Электронная\sпочта.*<div style="float:left;">(.+)</div>#Us', $page_data, $data_page );

                $user_data = array();

                if( !empty( $data_page ) )
                {
                    $user_data['name'] = trim( str_replace( '?', '', $data_page[1] ) );
                    $user_data['location'] = trim( str_replace( '&nbsp;', ' ', strip_tags( $data_page[2] ) ) );

                    if( empty( $phones[0] ) )
                    {
                        $phones = explode( '&nbsp;', str_replace( chr( 10 ), '', trim( strip_tags( $data_page[3] ) ) ) );
                        $phones = array_map( 'trim', $phones );
                        $phones = array_filter( $phones, 'isPhone' );

                        $user_data['phones'] = implode( ',', $phones );
                    }

                    $emails = explode( '&nbsp;', str_replace( chr( 10 ), '', trim( strip_tags( $data_page[4] ) ) ) );
                    $emails = array_map( 'trim', $emails );
                    $emails = array_filter( $emails, 'isMail' );
                }
                else
                {
                    if( !empty( $page_data ) && false === strpos( $page_data, 'Электронная почта' ) )
                    {
                        $User->status = self::NO_EMAIL;
                    }
                    else
                    {
                        $User->status = self::NO_PAGE_DATA;
                    }
                }
            }
            else
            {
                $user_data = Db::i()->getRow( 'SELECT name, location, phones, emails FROM users_outside WHERE company_id = "' . $User->company_id . '"' );

                if( empty( $phones[0] ) )
                {
                    $phones = explode( ',', $user_data['phones'] );
                }
                else
                {
                    unset( $user_data['phones'] );
                }

                $emails = explode( ',', $user_data['emails'] );
            }

            if( !empty( $user_data ) )
            {
                $user_data['tel1'] = $phones[0];

                $this->_parseLocation( $user_data['location'], $user_data );

                $email = $User->email;

                if( !empty( $email ) )
                {
                    if( !in_array( $User->email, $emails ) )
                    {
                        $emails[] = $User->email;
                    }
                }
                else
                {
                    if( !empty( $emails[0] ) )
                    {
                        $User->email = $emails[0];
                    }
                }

                $user_data['emails'] = implode( ',', $emails );

                $User->extract( $user_data );

                $User->save();

                for( $m = 0; $m < count( $emails ); $m++ )
                {
                    @Distribution::addEmail( $emails[$m], $user_data['lang'] );
                }
            }
        }

        public function fixPhones()
        {
            $company_ids = Db::i()->getCol( 'SELECT company_id FROM users_outside WHERE phones = ""' );

            $this->_output( 'Empty phones found: ' . count( $company_ids ) . chr( 10 ) );

            $fixed_count = 0;

            for( $i = 0; $i < count( $company_ids ); $i++ )
            {
                sleep( rand( 5, 10 ) );

                //$page_data = $this->_getPageDataTest( $page_url );
                $page_data = $this->_getPageData( 'http://della.ua/company/' . $company_ids[$i] . '/' );

                preg_match( '#Компания.*<strong>(.+)</strong>.*Расположение.*<td.*>(.+)</td>.*Телефоны\sкомпании.*<div style="float:left;">(.+)</div>.*Электронная\sпочта.*<div style="float:left;">(.+)</div>#Us', $page_data, $data_page );

                if( !empty( $data_page ) )
                {
                    $phones = explode( '&nbsp;', str_replace( chr( 10 ), '', trim( strip_tags( $data_page[3] ) ) ) );
                    $phones = array_map( 'trim', $phones );
                    $phones = array_filter( $phones, 'isPhone' );

                    if( !empty( $phones ) )
                    {
                        Db::i()->update( 'users_outside', array( 'phones' => implode( ',', $phones ) ), array( 'company_id' => $company_ids[$i] ) );

                        if( 0 < Db::i()->affected_rows )
                        {
                            $fixed_count++;
                        }
                    }
                }
            }

            $this->_output( 'Empty phones fixed: ' . $fixed_count . chr( 10 ) );
        }

        protected function _getCountryId( $outside_country_id )
        {
            switch( $outside_country_id )
            {
                case 'A': case 'AU': case 'AUT': case 'AT':
                    return 4;       //Австрія
                    break;
                case 'AZ':
                    return 39;      //Азербайджан
                    break;
                case 'ALB':
                    return 5;       //Албанія
                    break;
                case 'AND':
                    return 60;      //Андорра
                    break;
                case 'AR': case 'AM':
                    return 40;      //Вірменія
                    break;
                case 'AFG': case 'AF':
                    return 41;      //Афганістан
                    break;
                case 'BY':
                    return 3;       //Білорусь
                    break;
                case 'B': case 'BE':
                    return 6;       //Бельгія
                    break;
                case 'BG':
                    return 7;       //Болгарія
                    break;
                case 'BIH': case 'BA':
                    return 8;       //Боснія і Герцеговина
                    break;
                case 'GB':
                    return 9;       //Великобританія
                    break;
                case 'H': case 'HU':
                    return 10;      //Угорщина
                    break;
                case 'D': case 'DE':
                    return 11;      //Німеччина
                    break;
                case 'NL':
                    return 12;      //Нідерланди
                    break;
                case 'GR':
                    return 13;      //Греція
                    break;
                case 'GE':
                    return 14;      //Грузія
                    break;
                case 'DK':
                    return 15;       //Данія
                    break;
                case 'ISR':
                    return 51;      //Ізраїль
                    break;
                case 'IND':
                    return 54;      //Індія
                    break;
                case 'IRQ': case 'IQ':
                    return 42;      //Ірак
                    break;
                case 'IR':
                    return 43;      //Іран
                    break;
                case 'IRL': case 'IE':
                    return 16;      //Ірландія
                    break;
                case 'E': case 'ES':
                    return 17;      //Іспанія
                    break;
                case 'I': case 'IT':
                    return 18;      //Італія
                    break;
                case 'KZ':
                    return 44;      //Казахстан
                    break;
                case 'CHI': case 'CN':
                    return 45;      //Китай
                    break;
                case 'KG': case 'KRG':
                    return 55;      //Киргизстан
                    break;
                case 'LAT': case 'LV':
                    return 19;      //Латвія
                    break;
                case 'LBN':
                    return 56;      //Ліван
                    break;
                case 'LIT': case 'LTV': case 'LT':
                    return 20;      //Литва
                    break;
                case 'L': case 'LU':
                    return 21;      //Люксембург
                    break;
                case 'MK':
                    return 57;      //Македонія
                    break;
                case 'MAR':
                    return 58;      //Марокко
                    break;
                case 'MD':
                    return 22;      //Молдова
                    break;
                case 'MNG':
                    return 52;      //Монголія
                    break;
                case 'N': case 'NO':
                    return 23;      //Норвегія
                    break;
                case 'ARE':
                    return 61;      //ОАЕ
                    break;
                case 'PAK':
                    return 62;      //Пакістан
                    break;
                case 'PL':
                    return 24;      //Польща
                    break;
                case 'P': case 'PT':
                    return 25;      //Португалія
                    break;
                case 'RUS': case 'RU':
                    return 2;       //Росія
                    break;
                case 'RO':
                    return 26;      //Румунія
                    break;
                case 'SRB': case 'RS':
                    return 27;      //Сербія
                    break;
                case 'SYR':
                    return 59;      //Сирія
                    break;
                case 'SK':
                    return 28;      //Словаччина
                    break;
                case 'SLO': case 'SI':
                    return 29;      //Словенія
                    break;
                case 'TJ':
                    return 46;      //Таджикистан
                    break;
                case 'TM':
                    return 47;      //Туркменістан
                    break;
                case 'TR':
                    return 30;      //Туреччина
                    break;
                case 'UZ':
                    return 53;      //Узбекистан
                    break;
                case 'UA':
                    return 1;       //Україна
                    break;
                case 'FIN': case 'FI':
                    return 31;      //Фінляндія
                    break;
                case 'F': case 'FR':
                    return 32;      //Франція
                    break;
                case 'HR':
                    return 33;      //Хорватія
                    break;
                case 'MN': case 'ME':
                    return 34;      //Чорногорія
                    break;
                case 'CZ':
                    return 35;      //Чехія
                    break;
                case 'CH':
                    return 36;      //Швейцарія
                    break;
                case 'S': case 'SE':
                    return 37;      //Швеція
                    break;
                case 'EST': case 'EE':
                    return 38;      //Естонія
                    break;
                default:
                    if( !in_array( $outside_country_id, array( 'CIS', 'EU', 'ASIA' ) ) )
                    {
                        @Tools::report( 'No country for mark "' . $outside_country_id . '"', 'Della Import Error' );
                    }
                    return 0;
                    break;
            }
        }

        private function _isCountry( $country_name )
        {
            $is_country = Db::i()->getValue( 'SELECT 1 FROM country WHERE nameru = "' . $country_name . '"' );

            return !empty( $is_country ) ? true : false;
        }

        private function _parseLocation( $location, &$result )
        {
            $temp = explode( ',', $location );

            if( !empty( $temp[1] ) )
            {
                $result['regid'] = $this->_getRegionId( trim( $temp[1] ) );
            }

            $temp = explode( ' ', $temp[0] );

            if( !empty( $temp[1] ) )
            {
                $result['town'] = trim( $temp[1] );
            }

            $result['countryid'] = $this->_getCountryId( trim( $temp[0] ) );
        }

        protected function _getRegionId( $outside_region_id )
        {
            switch( $outside_region_id )
            {
                //Україна
                case 'Винницкая обл.':
                    return 1;       //Вінницька область
                    break;
                case 'Волынская обл.':
                    return 2;       //Волинська область
                    break;
                case 'Днепропетровская обл.':
                    return 3;       //Дніпропетровська область
                    break;
                case 'Донецкая обл.':
                    return 4;       //Донецька область
                    break;
                case 'Житомирская обл.':
                    return 5;       //Житомирська область
                    break;
                case 'Закарпатская обл.':
                    return 6;       //Закарпатська область
                    break;
                case 'Запорожская обл.':
                    return 7;       //Запорізька область
                    break;
                case 'Ивано-Франковская обл.':
                    return 8;       //Івано-Франківська область
                    break;
                case 'Киевская обл.':
                    return 9;       //Київська область
                    break;
                case 'Кировоградская обл.':
                    return 10;      //Кіровоградська область
                    break;
                case 'Крым ар.':
                    return 25;      //Крим, Автономна Республіка
                    break;
                case 'Луганская обл.':
                    return 11;      //Луганська область
                    break;
                case 'Львовская обл.':
                    return 12;      //Львівська область
                    break;
                case 'Николаевская обл.':
                    return 13;      //Миколаївська область
                    break;
                case 'Одесская обл.':
                    return 14;      //Одеська область
                    break;
                case 'Полтавская обл.':
                    return 15;      //Полтавська область
                    break;
                case 'Ровенская обл.':
                    return 16;      //Рівенська область
                    break;
                case 'Сумская обл.':
                    return 17;      //Сумська область
                    break;
                case 'Тернопольская обл.':
                    return 18;      //Тернопільська область
                    break;
                case 'Харьковская обл.':
                    return 19;      //Харківська область
                    break;
                case 'Херсонская обл.':
                    return 20;      //Херсонська область
                    break;
                case 'Хмельницкая обл.':
                    return 21;      //Хмельницька область
                    break;
                case 'Черкасская обл.':
                    return 22;      //Черкаська область
                    break;
                case 'Черниговская обл.':
                    return 23;      //Чернігівська область
                    break;
                case 'Черновицкая обл.':
                    return 24;      //Чернівецька область
                    break;
                //Росія
                case 'Адыгея р.':
                    return 694;     //Адигея
                    break;
                case 'Алтайский кр.':
                    return 673;       //Алтайський край
                    break;
                case 'Амурская обл.':
                    return 26;       //Амурська область
                    break;
                case 'Архангельская обл.':
                    return 27;       //Архангельська область
                    break;
                case 'Астраханская обл.':
                    return 28;       //Астраханська область
                    break;
                case 'Башкортостан р.':
                    return 692;       //Башкортостан
                    break;
                case 'Белгородская обл.':
                    return 657;       //Бєлгородська область
                    break;
                case 'Брянская обл.':
                    return 29;       //Брянська область
                    break;
                case 'Бурятия р.':
                    return 691;       //Бурятія
                    break;
                case 'Владимирская обл.':
                    return 30;       //Володимирська область
                    break;
                case 'Волгоградская обл.':
                    return 31;       //Волгоградська область
                    break;
                case 'Вологодская обл.':
                    return 32;       //Вологодська область
                    break;
                case 'Воронежская обл.':
                    return 658;       //Воронезька область
                    break;
                case 'Дагестан р.':
                    return 690;       //Дагестан
                    break;
                case 'Еврейская автономная обл.':
                    return 661;       //Єврейська автономна область
                    break;
                case 'Забайкальский кр.':
                    return 672;       //Забайкальський край
                    break;
                case 'Ивановская обл.':
                    return 33;       //Іванівська область
                    break;
                case 'Ингушетия р.':
                    return 689;       //Інгушетія
                    break;
                case 'Иркутская обл.':
                    return 34;       //Іркутська область
                    break;
                case 'Кабардино-Балкарская р.':
                    return 688;       //Кабардино-Балкарська республіка
                    break;
                case 'Калининградская обл.':
                    return 35;       //Калинінградська область
                    break;
                case 'Калмыкия р.':
                    return 687;       //Калмикія
                    break;
                case 'Калужская обл.':
                    return 36;       //Калужська область
                    break;
                case 'Камчатский кр.':
                    return 37;       //Камчатська область
                    break;
                case 'Карачаево-Черкесская р.':
                    return 686;       //Карачаєво-Черкесія
                    break;
                case 'Карелия р.':
                    return 685;       //Карелія
                    break;
                case 'Кемеровская обл.':
                    return 38;       //Кемерівська область
                    break;
                case 'Кировская обл.':
                    return 39;       //Кіровська область
                    break;
                case 'Коми р.':
                    return 684;       //Комі
                    break;
                case 'Костромская обл.':
                    return 40;       //Костромська область
                    break;
                case 'Краснодарский кр.':
                    return 670;       //Краснодарський край
                    break;
                case 'Красноярский кр.':
                    return 669;       //Красноярський край
                    break;
                case 'Курганская обл.':
                    return 41;       //Курганська область
                    break;
                case 'Курская обл.':
                    return 656;       //Курська область
                    break;
                case 'Ленинградская обл.':
                    return 42;       //Ленінградська область
                    break;
                case 'Липецкая обл.':
                    return 659;       //Липецька область
                    break;
                case 'Магаданская обл.':
                    return 43;       //Магаданська область
                    break;
                case 'Марий Эл р.':
                    return 683;       //Марій Ел
                    break;
                case 'Мордовия р.':
                    return 682;       //Мордовія
                    break;
                case 'Московская обл.':
                    return 44;       //Московська область
                    break;
                case 'Мурманская обл.':
                    return 45;       //Мурманська область
                    break;
                case 'Ненецкий окр.':
                    return 665;       //Ненецький автономний округ
                    break;
                case 'Нижегородская обл.':
                    return 46;       //Нижегородська область
                    break;
                case 'Новгородская обл.':
                    return 47;       //Новгородська область
                    break;
                case 'Новосибирская обл.':
                    return 48;       //Новосибірська область
                    break;
                case 'Омская обл.':
                    return 49;       //Омська область
                    break;
                case 'Оренбургская обл.':
                    return 50;       //Оренбургська область
                    break;
                case 'Орловская обл.':
                    return 51;       //Орловська область
                    break;
                case 'Пензенская обл.':
                    return 52;       //Пензенська область
                    break;
                case 'Пермский кр.':
                    return 660;       //Пермський край
                    break;
                case 'Приморский кр.':
                    return 668;       //Приморський край
                    break;
                case 'Псковская обл.':
                    return 53;       //Псковська область
                    break;
                case 'Ростовская обл.':
                    return 54;       //Ростовська область
                    break;
                case 'Рязанская обл.':
                    return 790;       //Рязанська область
                    break;
                case 'Самарская обл.':
                    return 55;       //Самарська область
                    break;
                case 'Саратовская обл.':
                    return 56;       //Саратовська область
                    break;
                case 'Саха (Якутия) р.':
                    return 681;       //Саха (Якутія)
                    break;
                case 'Сахалинская обл.':
                    return 57;       //Сахалінська область
                    break;
                case 'Свердловская обл.':
                    return 58;       //Свердловська область
                    break;
                case 'Северная Осетия-Алания р.':
                    return 680;       //Північна Осетія
                    break;
                case 'Смоленская обл.':
                    return 789;       //Смоленська область
                    break;
                case 'Ставропольский кр.':
                    return 667;       //Ставропольський край
                    break;
                case 'Тамбовская обл.':
                    return 778;       //Тамбовська область
                    break;
                case 'Татарстан р.':
                    return 679;       //Татарстан
                    break;
                case 'Тверская обл.':
                    return 59;       //Тверська область
                    break;
                case 'Томская обл.':
                    return 60;       //Томська область
                    break;
                case 'Тульская обл.':
                    return 787;       //Тульська область
                    break;
                case 'Тыва р.':
                    return 678;       //Тива
                    break;
                case 'Тюменская обл.':
                    return 61;       //Тюменська область
                    break;
                case 'Удмуртская р.':
                    return 677;       //Удмуртія
                    break;
                case 'Ульяновская обл.':
                    return 62;       //Ул'янівська область
                    break;
                case 'Хабаровский кр.':
                    return 666;       //Хабаровський край
                    break;
                case 'Хакасия р.':
                    return 676;       //Хакасія
                    break;
                case 'Ханты-Мансийский окр.':
                    return 664;       //Ханти-Мансійський автономний округ
                    break;
                case 'Челябинская обл.':
                    return 63;       //Челябінська область
                    break;
                case 'Чеченская р.':
                    return 675;       //Чеченська республіка
                    break;
                case 'Чувашская р.':
                    return 674;       //Чуваська республіка
                    break;
                case 'Чукотский окр.':
                    return 663;       //Чукотський автономний округ
                    break;
                case 'Ямало-Ненецкий окр.':
                    return 662;       //Ямало-Ненецький автономний округ
                    break;
                case 'Ярославская обл.':
                    return 65;       //Ярославська область
                    break;
                //Білорусія
                case 'Брестская обл.':
                    return 66;       //Брестська область
                    break;
                case 'Витебская обл.':
                    return 67;       //Вітебська область
                    break;
                case 'Гомельская обл.':
                    return 68;       //Гомельська область
                    break;
                case 'Гродненская обл.':
                    return 69;       //Гродненська область
                    break;
                case 'Минская обл.':
                    return 70;       //Мінська область
                    break;
                case 'Могилевская обл.':
                    return 71;       //Могилівська область
                    break;
                //Казахстан
                case 'Акмолинская обл.':
                    return 72;       //Акмолінська область
                    break;
                case 'Актюбинская обл.':
                    return 73;       //Актюбінська область
                    break;
                case 'Алматинская обл.':
                    return 74;       //Алматинська область
                    break;
                case 'Атырауская обл.':
                    return 75;       //Атирауська область
                    break;
                case 'Восточно-Казахстанская обл.':
                    return 76;       //Східно-Казахстанська область
                    break;
                case 'Жамбылская обл.':
                    return 77;       //Жамбильська область
                    break;
                case 'Западно-Казахстанская обл.':
                    return 78;       //Західно-Кахастанська область
                    break;
                case 'Карагандинская обл.':
                    return 79;       //Карагандинська область
                    break;
                case 'Костанайская обл.':
                    return 81;       //Костанайська область
                    break;
                case 'Кызылординская обл.':
                    return 80;       //Кизилординська область
                    break;
                case 'Мангистауская обл.':
                    return 82;       //Мангистауська область
                    break;
                case 'Павлодарская обл.':
                    return 83;       //Павлодарська область
                    break;
                case 'Северо-Казахстанская обл.':
                    return 84;       //Північно-Казахстанська область
                    break;
                case 'Южно-Казахстанская обл.':
                    return 85;       //Південно-Казахстанська область
                    break;
                //Польща
                case 'Варминско-Мазурское воеводство':
                    return 177;       //Вармансько-Мазурське воєводство
                    break;
                case 'Великопольское воеводство':
                    return 178;       //Великопольське воєводство
                    break;
                case 'Западнопоморское воеводство':
                    return 179;       //Західнопоморське воєводство
                    break;
                case 'Куявско-Поморское воеводство':
                    return 180;       //Куявсько-Поморське воєводство
                    break;
                case 'Лодзинское воеводство':
                    return 181;       //Лодзинське воєводство
                    break;
                case 'Люблинское воеводство':
                    return 182;       //Люблінське воєводство
                    break;
                case 'Любушское воеводство':
                    return 183;       //Любушське воєводство
                    break;
                case 'Мазовецкое воеводство':
                    return 184;       //Мазовецьке воєводство
                    break;
                case 'Малопольское воеводство':
                    return 185;       //Малопольське воєводство
                    break;
                case 'Нижнесилезское воеводство':
                    return 186;       //Нижньосилезське воєводство
                    break;
                case 'Опольское воеводство':
                    return 187;       //Опольське воєводство
                    break;
                case 'Подкарпатское воеводство':
                    return 188;       //Подкарпатське воєводство
                    break;
                case 'Подляское воеводство':
                    return 189;       //Подляське воєводство
                    break;
                case 'Поморское воеводство':
                    return 190;       //Поморське воєводство
                    break;
                case 'Свентокшиское воеводство':
                    return 191;       //Свентокширське воєводство
                    break;
                case 'Силезское воеводство':
                    return 192;       //Силезське воєводство
                    break;
                default:
                    //@Tools::report( 'No REGION_ID for name "' . $outside_region_id . '"', 'Della Import Error' );
                    return 0;
                    break;
            }
        }

        private function _getOutsideCountryId( $inside_country_id )
        {
            switch( $inside_country_id )
            {
                case 4:
                    return 13;       //Австрія
                    break;
                case 39:
                    return 14;      //Азербайджан
                    break;
                case 5:
                    return 2;       //Албанія
                    break;
                case 60:
                    return 5;      //Андорра
                    break;
                case 40:
                    return 10;      //Вірменія
                    break;
                case 41:
                    return 1;      //Афганістан
                    break;
                case 3:
                    return 16;       //Білорусь
                    break;
                case 6:
                    return 17;       //Бельгія
                    break;
                case 7:
                    return 28;       //Болгарія
                    break;
                case 8:
                    return 23;       //Боснія і Герцеговина
                    break;
                case 9:
                    return 206;       //Великобританія
                    break;
                case 10:
                    return 86;      //Угорщина
                    break;
                case 11:
                    return 71;      //Німеччина
                    break;
                case 12:
                    return 138;      //Нідерланди
                    break;
                case 13:
                    return 74;      //Греція
                    break;
                case 14:
                    return 70;      //Грузія
                    break;
                case 15:
                    return 51;       //Данія
                    break;
                case 51:
                    return 93;      //Ізраїль
                    break;
                case 54:
                    return 88;      //Індія
                    break;
                case 42:
                    return 91;      //Ірак
                    break;
                case 43:
                    return 90;      //Іран
                    break;
                case 16:
                    return 92;      //Ірландія
                    break;
                case 17:
                    return 221;      //Іспанія
                    break;
                case 18:
                    return 94;      //Італія
                    break;
                case 44:
                    return 98;      //Казахстан
                    break;
                case 45:
                    return 38;      //Китай
                    break;
                case 55:
                    return 104;      //Киргизстан
                    break;
                case 19:
                    return 106;      //Латвія
                    break;
                case 56:
                    return 107;      //Ліван
                    break;
                case 20:
                    return 112;      //Литва
                    break;
                case 21:
                    return 113;      //Люксембург
                    break;
                case 57:
                    return 115;      //Македонія
                    break;
                case 58:
                    return 133;      //Марокко
                    break;
                case 22:
                    return 129;      //Молдова
                    break;
                case 52:
                    return 131;      //Монголія
                    break;
                case 23:
                    return 148;      //Норвегія
                    break;
                case 61:
                    return 205;      //ОАЕ
                    break;
                case 62:
                    return 150;      //Пакістан
                    break;
                case 24:
                    return 158;      //Польща
                    break;
                case 25:
                    return 159;      //Португалія
                    break;
                case 2:
                    return 164;       //Росія
                    break;
                case 26:
                    return 163;      //Румунія
                    break;
                case 27:
                    return 173;      //Сербія
                    break;
                case 59:
                    return 189;      //Сирія
                    break;
                case 28:
                    return 177;      //Словаччина
                    break;
                case 29:
                    return 178;      //Словенія
                    break;
                case 46:
                    return 191;      //Таджикистан
                    break;
                case 47:
                    return 200;      //Туркменістан
                    break;
                case 30:
                    return 199;      //Туреччина
                    break;
                case 53:
                    return 209;      //Узбекистан
                    break;
                case 1:
                    return 204;       //Україна
                    break;
                case 31:
                    return 65;      //Фінляндія
                    break;
                case 32:
                    return 66;      //Франція
                    break;
                case 33:
                    return 47;      //Хорватія
                    break;
                case 34:
                    return 225;      //Чорногорія
                    break;
                case 35:
                    return 50;      //Чехія
                    break;
                case 36:
                    return 188;      //Швейцарія
                    break;
                case 37:
                    return 187;      //Швеція
                    break;
                case 38:
                    return 60;      //Естонія
                    break;
                default:
                    return '';
                    break;
            }
        }

        private function _getOutsideRegionId( $inside_region_id )
        {
            switch( $inside_region_id )
            {
                //Україна
                case 1:
                    return 10;       //Вінницька область
                    break;
                case 2:
                    return 4;       //Волинська область
                    break;
                case 3:
                    return 19;       //Дніпропетровська область
                    break;
                case 4:
                    return 23;       //Донецька область
                    break;
                case 5:
                    return 9;       //Житомирська область
                    break;
                case 6:
                    return 1;       //Закарпатська область
                    break;
                case 7:
                    return 22;       //Запорізька область
                    break;
                case 8:
                    return 3;       //Івано-Франківська область
                    break;
                case 9:
                    return 15;       //Київська область
                    break;
                case 10:
                    return 12;      //Кіровоградська область
                    break;
                case 25:
                    return 21;      //Крим, Автономна Республіка
                    break;
                case 11:
                    return 25;      //Луганська область
                    break;
                case 12:
                    return 2;      //Львівська область
                    break;
                case 13:
                    return 13;      //Миколаївська область
                    break;
                case 14:
                    return 11;      //Одеська область
                    break;
                case 15:
                    return 18;      //Полтавська область
                    break;
                case 16:
                    return 5;      //Рівенська область
                    break;
                case 17:
                    return 17;      //Сумська область
                    break;
                case 18:
                    return 6;      //Тернопільська область
                    break;
                case 19:
                    return 24;      //Харківська область
                    break;
                case 20:
                    return 20;      //Херсонська область
                    break;
                case 21:
                    return 8;      //Хмельницька область
                    break;
                case 22:
                    return 14;      //Черкаська область
                    break;
                case 23:
                    return 16;      //Чернігівська область
                    break;
                case 24:
                    return 7;      //Чернівецька область
                    break;
                //Росія
                case 694:
                    return 34;     //Адигея
                    break;
                case 673:
                    return 36;       //Алтайський край
                    break;
                case 26:
                    return 37;       //Амурська область
                    break;
                case 27:
                    return 38;       //Архангельська область
                    break;
                case 28:
                    return 39;       //Астраханська область
                    break;
                case 692:
                    return 40;       //Башкортостан
                    break;
                case 657:
                    return 41;       //Бєлгородська область
                    break;
                case 29:
                    return 42;       //Брянська область
                    break;
                case 691:
                    return 43;       //Бурятія
                    break;
                case 30:
                    return 44;       //Володимирська область
                    break;
                case 31:
                    return 45;       //Волгоградська область
                    break;
                case 32:
                    return 46;       //Вологодська область
                    break;
                case 658:
                    return 47;       //Воронезька область
                    break;
                case 690:
                    return 48;       //Дагестан
                    break;
                case 661:
                    return 49;       //Єврейська автономна область
                    break;
                case 672:
                    return 114;       //Забайкальський край
                    break;
                case 33:
                    return 50;       //Іванівська область
                    break;
                case 689:
                    return 51;       //Інгушетія
                    break;
                case 34:
                    return 52;       //Іркутська область
                    break;
                case 688:
                    return 53;       //Кабардино-Балкарська республіка
                    break;
                case 35:
                    return 54;       //Калинінградська область
                    break;
                case 687:
                    return 55;       //Калмикія
                    break;
                case 36:
                    return 56;       //Калужська область
                    break;
                case 37:
                    return 57;       //Камчатська область
                    break;
                case 686:
                    return 58;       //Карачаєво-Черкесія
                    break;
                case 685:
                    return 59;       //Карелія
                    break;
                case 38:
                    return 60;       //Кемерівська область
                    break;
                case 39:
                    return 61;       //Кіровська область
                    break;
                case 684:
                    return 62;       //Комі
                    break;
                case 40:
                    return 65;       //Костромська область
                    break;
                case 670:
                    return 66;       //Краснодарський край
                    break;
                case 669:
                    return 67;       //Красноярський край
                    break;
                case 41:
                    return 68;       //Курганська область
                    break;
                case 656:
                    return 69;       //Курська область
                    break;
                case 42:
                    return 70;       //Ленінградська область
                    break;
                case 659:
                    return 71;       //Липецька область
                    break;
                case 43:
                    return 72;       //Магаданська область
                    break;
                case 683:
                    return 73;       //Марій Ел
                    break;
                case 682:
                    return 74;       //Мордовія
                    break;
                case 44:
                    return 75;       //Московська область
                    break;
                case 45:
                    return 76;       //Мурманська область
                    break;
                case 665:
                    return 77;       //Ненецький автономний округ
                    break;
                case 46:
                    return 78;       //Нижегородська область
                    break;
                case 47:
                    return 79;       //Новгородська область
                    break;
                case 48:
                    return 80;       //Новосибірська область
                    break;
                case 49:
                    return 81;       //Омська область
                    break;
                case 50:
                    return 82;       //Оренбургська область
                    break;
                case 51:
                    return 83;       //Орловська область
                    break;
                case 52:
                    return 84;       //Пензенська область
                    break;
                case 660:
                    return 85;       //Пермський край
                    break;
                case 668:
                    return 86;       //Приморський край
                    break;
                case 53:
                    return 87;       //Псковська область
                    break;
                case 54:
                    return 88;       //Ростовська область
                    break;
                case 790:
                    return 89;       //Рязанська область
                    break;
                case 55:
                    return 90;       //Самарська область
                    break;
                case 56:
                    return 91;       //Саратовська область
                    break;
                case 681:
                    return 92;       //Саха (Якутія)
                    break;
                case 57:
                    return 93;       //Сахалінська область
                    break;
                case 58:
                    return 94;       //Свердловська область
                    break;
                case 680:
                    return 95;       //Північна Осетія
                    break;
                case 789:
                    return 96;       //Смоленська область
                    break;
                case 667:
                    return 97;       //Ставропольський край
                    break;
                case 778:
                    return 99;       //Тамбовська область
                    break;
                case 679:
                    return 100;       //Татарстан
                    break;
                case 59:
                    return 101;       //Тверська область
                    break;
                case 60:
                    return 102;       //Томська область
                    break;
                case 787:
                    return 104;       //Тульська область
                    break;
                case 678:
                    return 103;       //Тива
                    break;
                case 61:
                    return 105;       //Тюменська область
                    break;
                case 677:
                    return 106;       //Удмуртія
                    break;
                case 62:
                    return 107;       //Ул'янівська область
                    break;
                case 666:
                    return 109;       //Хабаровський край
                    break;
                case 676:
                    return 110;       //Хакасія
                    break;
                case 664:
                    return 111;       //Ханти-Мансійський автономний округ
                    break;
                case 63:
                    return 112;       //Челябінська область
                    break;
                case 675:
                    return 113;       //Чеченська республіка
                    break;
                case 674:
                    return 115;       //Чуваська республіка
                    break;
                case 663:
                    return 116;       //Чукотський автономний округ
                    break;
                case 662:
                    return 118;       //Ямало-Ненецький автономний округ
                    break;
                case 65:
                    return 119;       //Ярославська область
                    break;
                //Білорусія
                case 66:
                    return 143;       //Брестська область
                    break;
                case 67:
                    return 29;       //Вітебська область
                    break;
                case 68:
                    return 30;       //Гомельська область
                    break;
                case 69:
                    return 121;       //Гродненська область
                    break;
                case 70:
                    return 142;       //Мінська область
                    break;
                case 71:
                    return 144;       //Могилівська область
                    break;
                //Казахстан
                case 72:
                    return 200;       //Акмолінська область
                    break;
                case 73:
                    return 201;       //Актюбінська область
                    break;
                case 74:
                    return 202;       //Алматинська область
                    break;
                case 75:
                    return 203;       //Атирауська область
                    break;
                case 76:
                    return 204;       //Східно-Казахстанська область
                    break;
                case 77:
                    return 205;       //Жамбильська область
                    break;
                case 78:
                    return 206;       //Західно-Кахастанська область
                    break;
                case 79:
                    return 207;       //Карагандинська область
                    break;
                case 81:
                    return 208;       //Костанайська область
                    break;
                case 80:
                    return 209;       //Кизилординська область
                    break;
                case 82:
                    return 210;       //Мангистауська область
                    break;
                case 83:
                    return 211;       //Павлодарська область
                    break;
                case 84:
                    return 212;       //Північно-Казахстанська область
                    break;
                case 85:
                    return 147;       //Південно-Казахстанська область
                    break;
                //Польща
                case 177:
                    return 122;       //Вармансько-Мазурське воєводство
                    break;
                case 178:
                    return 123;       //Великопольське воєводство
                    break;
                case 179:
                    return 124;       //Західнопоморське воєводство
                    break;
                case 180:
                    return 125;       //Куявсько-Поморське воєводство
                    break;
                case 181:
                    return 126;       //Лодзинське воєводство
                    break;
                case 182:
                    return 127;       //Люблінське воєводство
                    break;
                case 183:
                    return 28;       //Любушське воєводство
                    break;
                case 184:
                    return 128;       //Мазовецьке воєводство
                    break;
                case 185:
                    return 129;       //Малопольське воєводство
                    break;
                case 186:
                    return 130;       //Нижньосилезське воєводство
                    break;
                case 187:
                    return 131;       //Опольське воєводство
                    break;
                case 188:
                    return 132;       //Подкарпатське воєводство
                    break;
                case 189:
                    return 133;       //Подляське воєводство
                    break;
                case 190:
                    return 134;       //Поморське воєводство
                    break;
                case 191:
                    return 135;       //Свентокширське воєводство
                    break;
                case 192:
                    return 136;       //Силезське воєводство
                    break;
                default:
                    return '';
                    break;
            }
        }

        protected function _getVehicleId( $outside_vehicle_id )
        {
            switch( $outside_vehicle_id )
            {
                case 'автобус':
                    return 8;
                    break;
                case 'автобус грузопас.':
                    return 8;
                    break;
                case 'автобус люкс':
                    return 8;
                    break;
                case 'автовоз':
                    return 9;
                    break;
                case 'автокран':
                    return 10;
                    break;
                case 'бензовоз':
                    return 32;
                    break;
                case 'бортовая':
                    return 11;
                    break;
                case 'зерновоз':
                    return 12;
                    break;
                case 'изотерм':
                    return 7;
                    break;
                case 'контейнер':
                    return 13;
                    break;
                case 'контейнеровоз':
                    return 14;
                    break;
                case 'крытая':
                    return 2;
                    break;
                case 'лесовоз':
                    return 16;
                    break;
                case 'любой':
                    return 0;
                    break;
                case 'меблевоз':
                    return 17;
                    break;
                case 'микроавтобус':
                    return 18;
                    break;
                case 'муковоз':
                    return 40;
                    break;
                case 'негабарит':
                    return 19;
                    break;
                case 'открытая':
                    return 3;
                    break;
                case 'платформа':
                    return 20;
                    break;
                case 'рефрижератор':
                    return 5;
                    break;
                case 'самосвал':
                    return 21;
                    break;
                case 'скотовоз':
                    return 22;
                    break;
                case 'спецмашина': case 'экскаватор':
                return 36;
                break;
                case 'тент':
                    return 4;
                    break;
                case 'трал':
                    return 37;
                    break;
                case 'трубовоз':
                    return 24;
                    break;
                case 'тягач':
                    return 44;
                    break;
                case 'цельномет.': case 'цельнопластик':
                return 6;
                break;
                case 'цементовоз':
                    return 25;
                    break;
                case 'цистерна':
                    return 38;
                    break;
                case 'цистерна пищ.': case 'масловоз':
                return 29;
                break;
                case 'цистерна хим.':
                    return 28;
                    break;
                case 'эвакуатор':
                    return 39;
                    break;
                default :
                    @Tools::report( 'No VEHICLE_ID for name "' . $outside_vehicle_id . '"', 'Della Import Error' );
                    return 0;
                    break;
            }
        }

        private function _getFullName( $short_name )
        {
            switch( $short_name )
            {
                case 'wsng':
                    return 'CIS';
                    break;
                case 'w1':
                    return 'Europe';
                    break;
                case 'w2':
                    return 'Asia';
                    break;
            }
        }

        public function _filterValue( $value, $key, $record_link )
        {
            /*$exceptions = array( 'section', 'lang', 'source', 'distance_prov', 'user', 'email' );

            if( !in_array( $key, $exceptions ) && preg_match( '#[a-z]+|110812170939087358|\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#i', $value ) )
            {
                @Tools::report( 'SUSPECT DATA: ' . $value . chr( 10 ) . 'PAGE: ' . $record_link, 'Della Import Error' );

                $value = preg_replace( '#prostir|110812170939087358|\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#i', '', $value );
                $value = trim( $value );
            }*/

            return $value;
        }

        public function __construct( $section )
        {
            $this->_getCookies( 'della.ua', 'login_mode=enter&location_url=della.ua&login=prostir&password=1ea2efcf' );

            parent::__construct( 'd', $section );
        }

        public function __destruct()
        {
            parent::__destruct();
        }
    }