<?php
    class OutsideParserL extends OutsideParserAbstract
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
                $gotSession = strpos( $r, 'JSESSIONID' );

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

            $this->cookies = 'mobile1=oktavia9397; mobile2=d3bb18e20b5b20d00d39606fd3f04698bd023aaa4646b374;';
            //$this->cookies = 'mobile1=alexsey1; mobile2=7b5c9effbaf28cc780df851270bfee3c702084beafd68bdf;';
        }

        protected function _getDirections()
        {
            if( 'freight' == $this->section )
            {
                return
                    array(
                        array( 'from' => 'UA', 'to' => 'UA', 'period' => 1, 'depth' => 1 ),       //Україна-Україна
                        /*array( 'from' => 'UA', 'to' => 'MD', 'period' => 3, 'depth' => 1 ),       //Україна-Україна
                        array( 'from' => 'UA', 'to' => 'GE', 'period' => 3, 'depth' => 1 ),       //Україна-Україна
                        array( 'from' => 'UA', 'to' => 'DE', 'period' => 3, 'depth' => 1 ),       //Україна-Україна
                        array( 'from' => 'DE', 'to' => 'UA', 'period' => 3, 'depth' => 1 ),       //Україна-Україна
                        array( 'from' => 'UA', 'to' => 'TR', 'period' => 2, 'depth' => 2 ),       //Україна-Україна
                        array( 'from' => 'TR', 'to' => 'UA', 'period' => 3, 'depth' => 1 ),       //Україна-Україна
                        array( 'from' => 'RU', 'to' => 'UA', 'period' => 2, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'UA', 'to' => 'RU', 'period' => 1, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'UA', 'to' => 'BY', 'period' => 2, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'BY', 'to' => 'UA', 'period' => 2, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'UA', 'to' => 'PL', 'period' => 2, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'PL', 'to' => 'UA', 'period' => 2, 'depth' => 1 ),
                        array( 'from' => 'BY', 'to' => 'RU', 'period' => 2, 'depth' => 1 ),
                        array( 'from' => 'RU', 'to' => 'BY', 'period' => 2, 'depth' => 2 ),
                        array( 'from' => 'RU', 'to' => 'KZ', 'period' => 3, 'depth' => 1 ),
                        array( 'from' => 'KZ', 'to' => 'RU', 'period' => 3, 'depth' => 1 ),
                        array( 'from' => 'UA', 'to' => 'KZ', 'period' => 3, 'depth' => 1 ),
                        array( 'from' => 'KZ', 'to' => 'KZ', 'period' => 3, 'depth' => 1 ),
                        array( 'from' => 'EU', 'to' => 'KZ', 'period' => 3, 'depth' => 3 ),
                        array( 'from' => 'KZ', 'to' => 'EU', 'period' => 3, 'depth' => 1 ),
                        array( 'from' => 'RU', 'to' => 'RU', 'period' => 2, 'depth' => 2 ),       //Росія-Росія
                        array( 'from' => 'RU', 'to' => 'PL', 'period' => 2, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'PL', 'to' => 'RU', 'period' => 3, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'BY', 'to' => 'BY', 'period' => 1, 'depth' => 2 ),       //Білорусія-Білорусія
                        array( 'from' => 'BY', 'to' => 'PL', 'period' => 3, 'depth' => 1 ),       //Білорусія-Білорусія
                        array( 'from' => 'PL', 'to' => 'BY', 'period' => 3, 'depth' => 1 ),       //Білорусія-Білорусія
                        array( 'from' => 'BY', 'to' => 'DE', 'period' => 3, 'depth' => 1 ),       //Білорусія-Білорусія
                        array( 'from' => 'DE', 'to' => 'BY', 'period' => 3, 'depth' => 1 ),       //Білорусія-Білорусія
                        array( 'from' => 'EU', 'to' => 'EU', 'period' => 3, 'depth' => 2 ),       //Європа-Європа
                        array( 'from' => 'UA', 'to' => '', 'period' => 3, 'depth' => 4 ),       //Україна-Всі
                        array( 'from' => '', 'to' => 'UA', 'period' => 3, 'depth' => 4 ),       //Всі-Україна
                        array( 'from' => 'EU', 'to' => '', 'period' => 3, 'depth' => 4 ),       //Європа-Всі
                        array( 'from' => '', 'to' => 'EU', 'period' => 3, 'depth' => 4 ),       //Всі-Європа
                        array( 'from' => 'RU', 'to' => '', 'period' => 3, 'depth' => 4 ),       //Росія-Всі
                        array( 'from' => '', 'to' => 'RU', 'period' => 3, 'depth' => 4 ),       //Всі-Росія
                        array( 'from' => 'BY', 'to' => '', 'period' => 3, 'depth' => 4 ),       //Білорусія-Всі
                        array( 'from' => '', 'to' => 'BY', 'period' => 3, 'depth' => 4 ),       //Всі-Білорусія*/
                    );
            }
            else
            {
                return
                    array(
                        array( 'from' => 'UA', 'to' => 'UA', 'period' => 1, 'depth' => 7 ),       //Україна-Україна
                        array( 'from' => 'UA', 'to' => 'MD', 'period' => 3, 'depth' => 1 ),       //Україна-Україна
                        array( 'from' => 'UA', 'to' => 'GE', 'period' => 3, 'depth' => 1 ),       //Україна-Україна
                        array( 'from' => 'UA', 'to' => 'DE', 'period' => 3, 'depth' => 1 ),       //Україна-Україна
                        array( 'from' => 'DE', 'to' => 'UA', 'period' => 3, 'depth' => 1 ),       //Україна-Україна
                        array( 'from' => 'UA', 'to' => 'TR', 'period' => 2, 'depth' => 2 ),       //Україна-Україна
                        array( 'from' => 'TR', 'to' => 'UA', 'period' => 3, 'depth' => 1 ),       //Україна-Україна
                        array( 'from' => 'RU', 'to' => 'UA', 'period' => 2, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'UA', 'to' => 'RU', 'period' => 1, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'UA', 'to' => 'BY', 'period' => 2, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'BY', 'to' => 'UA', 'period' => 2, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'UA', 'to' => 'PL', 'period' => 2, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'PL', 'to' => 'UA', 'period' => 2, 'depth' => 1 ),
                        array( 'from' => 'BY', 'to' => 'RU', 'period' => 2, 'depth' => 1 ),
                        array( 'from' => 'RU', 'to' => 'BY', 'period' => 2, 'depth' => 2 ),
                        array( 'from' => 'RU', 'to' => 'KZ', 'period' => 3, 'depth' => 1 ),
                        array( 'from' => 'KZ', 'to' => 'RU', 'period' => 3, 'depth' => 1 ),
                        array( 'from' => 'UA', 'to' => 'KZ', 'period' => 3, 'depth' => 1 ),
                        array( 'from' => 'KZ', 'to' => 'KZ', 'period' => 3, 'depth' => 1 ),
                        array( 'from' => 'EU', 'to' => 'KZ', 'period' => 3, 'depth' => 3 ),
                        array( 'from' => 'KZ', 'to' => 'EU', 'period' => 3, 'depth' => 1 ),
                        array( 'from' => 'RU', 'to' => 'RU', 'period' => 2, 'depth' => 2 ),       //Росія-Росія
                        array( 'from' => 'RU', 'to' => 'PL', 'period' => 2, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'PL', 'to' => 'RU', 'period' => 3, 'depth' => 1 ),       //Росія-Росія
                        array( 'from' => 'BY', 'to' => 'BY', 'period' => 1, 'depth' => 2 ),       //Білорусія-Білорусія
                        array( 'from' => 'BY', 'to' => 'PL', 'period' => 3, 'depth' => 1 ),       //Білорусія-Білорусія
                        array( 'from' => 'PL', 'to' => 'BY', 'period' => 3, 'depth' => 1 ),       //Білорусія-Білорусія
                        array( 'from' => 'BY', 'to' => 'DE', 'period' => 3, 'depth' => 1 ),       //Білорусія-Білорусія
                        array( 'from' => 'DE', 'to' => 'BY', 'period' => 3, 'depth' => 1 ),       //Білорусія-Білорусія
                        array( 'from' => 'EU', 'to' => 'EU', 'period' => 3, 'depth' => 2 ),       //Європа-Європа
                        array( 'from' => 'UA', 'to' => '', 'period' => 3, 'depth' => 4 ),       //Україна-Всі
                        array( 'from' => '', 'to' => 'UA', 'period' => 3, 'depth' => 4 ),       //Всі-Україна
                        array( 'from' => 'EU', 'to' => '', 'period' => 3, 'depth' => 4 ),       //Європа-Всі
                        array( 'from' => '', 'to' => 'EU', 'period' => 3, 'depth' => 4 ),       //Всі-Європа
                        array( 'from' => 'RU', 'to' => '', 'period' => 3, 'depth' => 4 ),       //Росія-Всі
                        array( 'from' => '', 'to' => 'RU', 'period' => 3, 'depth' => 4 ),       //Всі-Росія
                        array( 'from' => 'BY', 'to' => '', 'period' => 3, 'depth' => 4 ),       //Білорусія-Всі
                        array( 'from' => '', 'to' => 'BY', 'period' => 3, 'depth' => 4 ),       //Всі-Білорусія
                    );
            }
        }

        protected function _getDirectionsTest()
        {
            return
                array(
                    array( 'from' => 'UA', 'to' => 'UA', 'period' => 1, 'depth' => 1 ),       //СНГ-СНГ
                );
        }

        protected function _getListData( $direction, $page_number )
        {
            if( 'freight' == $this->section )
            {
                $url = 'http://lardi-trans.com/gruz/?countryfrom=' . $direction['from'] . '&countryto=' . $direction['to'] . '&areafrom=0&areato=0&cityFrom=&cityTo=&truck=0&tir=-1&custom_control=-1&dayfrom=-1&monthfrom=-1&yearfrom=-1&dayto=-1&monthto=-1&yearto=-1&mass=0.0&mass2=0.0&value=0.0&value2=0.0&showType=all&refresh_time=&startSearch=Сделать выборку&page=' . $page_number;
            }
            else
            {
                $url = 'http://lardi-trans.com/trans/?countryfrom=' . $direction['from'] . '&countryto=' . $direction['to'] . '&areafrom=0&areato=0&cityFrom=&truck=0&adr=-1&dayfrom=-1&monthfrom=-1&yearfrom=-1&dayto=-1&monthto=-1&yearto=-1&mass=0.0&mass2=0.0&value=0.0&value2=0.0&refresh_time=&startSearch=Сделать выборку&page=' . $page_number;
            }

            return $this->_read( $url );
        }

        protected function _getListDataTest()
        {
            if( 'freight' == $this->section )
            {
                return file_get_contents( dirname( dirname( __FILE__ ) ) . '/system/cron/list2.htm' );
            }
            else
            {
                return file_get_contents( dirname( dirname( __FILE__ ) ) . '/system/cron/list4.htm' );
            }
        }

        public function parseListData()
        {
            if ('vehicle' == $this->section)
            {
                sleep( rand( 5, 10 ) );
            }

            //$directions = $this->_getDirectionsTest();
            $directions = $this->_getDirections();

            for( $direction_index = 0; $direction_index < count( $directions ); $direction_index++ )
            {
                if( 0 != $this->iteration_number % $directions[$direction_index]['period'] )
                {
                    continue;
                }

                $this->_output( 'Direction: ' . $directions[$direction_index]['from'] . ' -> ' . $directions[$direction_index]['to'] . chr( 10 ) );

                for( $page_index = 0; $page_index < $directions[$direction_index]['depth']; $page_index++ )
                {
                    $this->_output( '> Page #: ' . ($page_index + 1) . ' - ' );

                    //$list_data = $this->_getListDataTest();
                    $list_data = $this->_getListData( $directions[$direction_index], $page_index + 1 );

                    if( false === $list_data )
                    {
                        $this->_output( $this->statuses_explanation[self::NO_CONNECTION] . chr( 10 ) );
                    }
                    elseif( false === strpos( $list_data, 'ui_table_lardi' ) )
                    {
                        $this->_output( $this->statuses_explanation[self::NO_PAGE] . chr( 10 ) );
                    }
                    else
                    {
                        $this->_output( $this->statuses_explanation[self::PROCESSED] . chr( 10 ) );

                        $list_rows = explode( 'ui_table_lardi', $list_data );

                        for( $row_index = 1; $row_index < count( $list_rows ); $row_index++ )
                        {
                            preg_match( '#<td[^>]*><input[^>]*value="(\d+)"[^>]*></td><td[^>]*><span[^>]*>(\w+)–(\w+)</span><br><span class="t"[^>]*>(.+)</span><br><span class="t sm"[^>]*>(.+)(?:<br>.*)?</span></td><td[^>]*><span class="t"[^>]*>(\d{2}\.\d{2}(?:–\d{2}\.\d{2})?)</span></td><td[^>]*><span class="zag"[^>]*>(.+)\s+–\s+(.*)</span><br><span class="sm1"[^>]*>(.+)\s+–\s+(.+)</span>(?:<br><a[^>]*>маршрут</a>)?</td><td[^>]*><span class="t"[^>]*>(.*)</span></td><td[^>]*><span class="t"[^>]*>(.*)</span></td><td[^>]*>(?:<div[^>]*>.*</div>)?<a[^>]*refid="(\d+)"[^>]*>.*<span class="t"[^>]*><br>(.*)<br>(.*)<br><a[^>]*>#Us', $list_rows[$row_index], $data_list );

                            if( !empty( $data_list ) )
                            {
                                if( !empty( $data_list[13] ) )   // ID компанії
                                {
                                    $this->_output( '>> Company ID: ' . $data_list[13] . ' - ' );

                                    $phones = explode( '<br>', trim( $data_list[15] ) );
                                    $phones = array_map( 'strip_tags', $phones );
                                    $phones = array_map( 'trim', $phones );

                                    if ('vehicle' == $this->section)
                                    {
                                        $phones = array_filter( $phones, 'isPhone' );
                                    }

                                    if( in_array( $data_list[13], array() ) )     // Не обробляти дані компаній у списку
                                    {
                                        $this->_output( $this->statuses_explanation[self::IGNORED] . chr( 10 ) );
                                        continue;
                                    }
                                    elseif( empty( $phones ) )
                                    {
                                        $this->_output( $this->statuses_explanation[self::NO_PHONE] . chr( 10 ) );
                                        continue;
                                    }

                                    $user_data = array();

                                    $user_data['company_id'] = $data_list[13];
                                    $user_data['section'] = $this->section;
                                    $user_data['source'] = 'l';
                                    $user_data['lang'] = 'ru';
                                    $user_data['forwarder'] =  1;
                                    $user_data['type_activity'] = '4';
                                    $user_data['outside'] = 1;
                                    $user_data['contact_person'] = trim( $data_list[14] );
                                    $user_data['email'] = $this->_getContactPersonEmail( $data_list[13], $user_data['contact_person'] );
                                    $user_data['tel1'] = $phones[0];
                                    $user_data['phones'] = implode( ',', $phones );

                                    $User = new OutsideUserL( $this->section, $user_data );

                                    if ('vehicle' == $this->section)
                                    {
                                        $this->_parsePageData( $User, 'http://lardi-trans.com/user/' . $data_list[13] );

                                        $this->_output( $this->statuses_explanation[$User->status] . chr( 10 ) );
                                    }

                                    $record_data = array();

                                    $this->_output( '>>> Record ID: ' . $data_list[1] . ' - ' );

                                    $record_data['record_id'] = $data_list[1];
                                    $record_data['source'] = 'l';

                                    //$record_data['adddate'] = $this->_convertDate( $data_list[5] );
                                    $record_data['adddate'] = date( 'Y-m-d H:i:s', time() );
                                    $record_data['date_add'] = $record_data['adddate'];
                                    $record_data['outside_owner_id'] = $data_list[13];

                                    $dates = explode( '–', $data_list[6] );

                                    $record_data['datef'] = date( 'Y-m-d', strtotime( $dates[0] . '.' . date( 'Y' ) ) );
                                    $record_data['datet'] = !empty( $dates[1] ) ? date( 'Y-m-d', strtotime( $dates[1] . '.' . date( 'Y' ) ) ) : $record_data['datef'];

                                    $location_array = array();
                                    $record_data['pathlen'] = 0;
                                    $record_data['distance_prov'] = '';
                                    $record_data['gmaps_path'] = 0;

                                    foreach( array( 'f', 't' ) as $way )
                                    {
                                        $base_index = 'f' == $way ? 2 : 3;
                                        $full_way = 'f' == $way ? 'from' : 'to';

                                        $record_data['country' . $way] = $this->_getCountryId( $data_list[$base_index] );
                                        $record_data['reg' . $way] = $this->_getRegionId( $data_list[$base_index + 7] );
                                        $record_data['town' . $way] = $this->_decodeEntity( $data_list[$base_index + 5] );

                                        if( 'vehicle' == $this->section && !empty( $record_data['town' . $way] ) )
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
                                        $Direction = Directions::get( $location_array );

                                        if( is_object( $Direction ) )
                                        {
                                            $record_data['pathlen'] = floatval( $Direction -> distance / 100 );
                                            $record_data['distance_prov'] = $Direction -> provider;
                                            $record_data['gmaps_path'] = 1;
                                        }
                                    }

                                    $record_data['vehicle_id'] = $this->_getVehicleId( $data_list[4] );
                                    $record_data['email'] = $User->email;

                                    if( 'freight' == $this->section )
                                    {
                                        preg_match( '#^(.+)(?:,|\s(?:(?:до|от)\s)?[–\d.,]+(?:т|м3))#Us', $data_list[11], $data_freight_info );

                                        if( !empty( $data_freight_info ) )
                                        {
                                            $record_data['freight'] = trim( trim( $data_freight_info[1] ), ',' );
                                        }
                                        else
                                        {
                                            @Tools::report( 'No cargo name in load:' . chr( 10 ) . 'http://lardi-trans.com/gruz/view/' . $data_list[1], 'Lardi Import Error' );
                                            continue;
                                        }
                                    }

                                    preg_match( '#^(?:([\d,.]+)(грн|руб|$|€)(?:/(км))?)?(?:\s(ф/о\sлюбая|запрос|договор\.|комб\.|нал\.|нал\.\sна\sзагр\.|нал\.\sна\sвыгр\.|перевод\sпо\sоригиналам|перевод\sпо\sзагрузке|перевод\sпо\sвыгрузке|б/н|б/н\sбыстр\.|б/н\sс\sНДС|б/н\sбез\sНДС|50%\sпредоплата|100%\sпредоплата|ед\.\sналог))?()$#Us', $data_list[12], $data_price_info );

                                    if( !empty( $data_price_info ) )
                                    {
                                        if( !empty( $data_price_info[1] ) )
                                        {
                                            $record_data['price'] = (float)str_replace( ',', '.', $data_price_info[1] );

                                            switch( $data_price_info[2] )
                                            {
                                                case 'грн':
                                                    $record_data['currencyid'] = 1;
                                                    break;
                                                case '$':
                                                    $record_data['currencyid'] = 2;
                                                    break;
                                                case '€':
                                                    $record_data['currencyid'] = 3;
                                                    break;
                                                case 'руб':
                                                    $record_data['currencyid'] = 4;
                                                    break;
                                                default :
                                                    break;
                                            }

                                            switch( $data_price_info[3] )
                                            {
                                                case 'км':
                                                    $record_data['for'] = 1;
                                                    break;
                                                default :
                                                    $record_data['for'] = 2;
                                                    break;
                                            }
                                        }

                                        switch( $data_price_info[4] )
                                        {
                                            case 'нал.':
                                                $record_data['pay_form'] = 11;
                                                break;
                                            case 'нал. на загр.':
                                                $record_data['pay_form'] = 1;
                                                break;
                                            case 'нал. на выгр.':
                                                $record_data['pay_form'] = 2;
                                                break;
                                            case 'перевод по оригиналам':
                                                $record_data['pay_form'] = 3;
                                                break;
                                            case 'перевод по загрузке':
                                                $record_data['pay_form'] = 4;
                                                break;
                                            case 'перевод по выгрузке':
                                                $record_data['pay_form'] = 5;
                                                break;
                                            case 'б/н':
                                                $record_data['pay_form'] = 6;
                                                break;
                                            case 'б/н с НДС':
                                                $record_data['pay_form'] = 8;
                                                break;
                                            case 'ед. налог':
                                                $record_data['pay_form'] = 7;
                                                break;
                                            default :
                                                break;
                                        }
                                    }

                                    $loadtypes = array();

                                    if( false !== strpos( $data_list[11], 'боковая' ) )
                                    {
                                        $loadtypes[] = 1;
                                    }

                                    if( false !== strpos( $data_list[11], 'верхняя' ) )
                                    {
                                        $loadtypes[] = 4;
                                    }

                                    if( false !== strpos( $data_list[11], 'задняя' ) )
                                    {
                                        $loadtypes[] = 6;
                                    }

                                    $record_data['loadtype'] = implode( ',', $loadtypes );

                                    if( false !== strpos( $data_list[11], 'CMR' ) || false !== strpos( $data_list[11], 'ЦМР' ) )
                                    {
                                        $record_data['cmr'] = 1;
                                    }

                                    if( false !== strpos( $data_list[11], 'TiR' ) )
                                    {
                                        $record_data['tir'] = 1;
                                    }

                                    if( false !== strpos( $data_list[11], 'ADR' ) )
                                    {
                                        $record_data['adr'] = 1;
                                    }

                                    preg_match( '#(?:(?:от\s|до\s)?([\d.,]+)(?:–[\d.,]+)?т)(?:\s(?:от\s|до\s)?([\d.,]+)(?:–[\d.,]+)?м3)?()#s', $data_list[11], $data_other_info );

                                    if( !empty( $data_other_info[0] ) )
                                    {
                                        $record_data['weight'] = (float)str_replace( ',', '.', $data_other_info[1] );
                                        $record_data['space'] = (float)str_replace( ',', '.', $data_other_info[2] );
                                    }

                                    $record_data['number'] = 1;
                                    $record_data['category_id'] = '1';
                                    $record_data['user'] = 'Y';
                                    $record_data['owner_id'] = $User->id;
                                    $record_data['group_id'] = $User->group_id;
                                    $record_data['email_id'] = $User->email_id;
                                    $record_data['actual_before'] = $record_data['datet'] . ' 23:59';
                                    $record_data['phones'] = $user_data['phones'];

                                    $Record = new OutsideRecordL( $this->section, $record_data );

                                    $Record->save();

                                    $this->_output( $this->statuses_explanation[$Record->status] . chr( 10 ) );

                                    if( 'vehicle' == $this->section )
                                    {
                                        $cached_id = $User->cached_id;

                                        if( !empty( $cached_id ) )
                                        {
                                            if( empty( $record_data['email'] ) && !empty( $record_data['owner_id'] ) )
                                            {
                                                $record_data['email'] = $this->_getOurCompanyEmail( $record_data['owner_id'] );
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
                                if (strpos($list_rows[$row_index], 'banner.lardi-trans.com') === false)
                                {
                                    $this->_output( $this->statuses_explanation[self::NO_RECORD_DATA] . chr( 10 ) );
                                    //if (empty( $data_list )) echo $list_rows[$row_index];
                                }
                            }
                        }
                    }

                    if ('vehicle' == $this->section)
                    {
                        sleep( rand( 10, 20 ) );
                    }
                }
            }
        }

        protected function _getPageData( $page_url )
        {
            return $this->_read( $page_url );
        }

        protected function _getPageDataTest( $page_url )
        {
            return file_get_contents( dirname( dirname( __FILE__ ) ) . '/system/cron/page2.htm' );
        }

        protected function _parsePageData( OutsideUserAbstract $User, $page_url )
        {
            if( false === $User->is_cached )     // Завантажувати сторінку тільки якщо компанія не додана в кеш
            {
                sleep( rand( 5, 10 ) );

                $emails = $this->_getCompanyEmails( $User->company_id );
                $emails = array_filter( $emails, 'isMail' );

                //$page_data = $this->_getPageDataTest( $page_url );
                $page_data = $this->_getPageData( $page_url );

                preg_match( '#Наименование.*user_name_div.*<span>(.+)</span>.*Страна.*<td[^>]+>(.+)</td>#Us', $page_data, $data_page );

                $user_data = array();

                if( !empty( $data_page ) )
                {
                    $user_data['name'] = trim( $data_page[1] );
                    $user_data['location'] = trim( $data_page[2] );
                    $user_data['emails'] = implode( ',', $emails );
                }
                else
                {
                    $User->status = self::NO_PAGE_DATA;
                }
            }
            else
            {
                $user_data = Db::i()->getRow( 'SELECT name, location, emails FROM users_outside WHERE company_id = "' . $User->company_id . '"' );

                $emails = explode( ',', $user_data['emails'] );
            }

            if( !empty( $user_data ) )
            {
                $email = $User->email;

                if( !empty( $email ) )
                {
                    if( !in_array( $User->email, $emails ) )
                    {
                        $emails[] = $User->email;
                    }
                }
                elseif( !empty( $emails[0] ) )
                {
                    $User->email = $emails[0];
                }

                $User->extract( $user_data );

                $User->save();

                for( $m = 0; $m < count( $emails ); $m++ )
                {
                    if( isMail( $emails[$m] ) )
                    {
                        @Distribution::addEmail( $emails[$m], $user_data['lang'] );
                    }
                }
            }
        }

        protected function _getCountryId( $outside_country_id )
        {
            if( 'GB' == $outside_country_id ) $outside_country_id = 'UK';
            if( 'AR' == $outside_country_id ) $outside_country_id = 'AM';
            if( 'AB' == $outside_country_id ) $outside_country_id = 'GE';

            $country_id = Db::i()->getValue( 'SELECT id FROM country WHERE domen = "' . $outside_country_id . '"' );

            if( !empty( $country_id ) )
            {
                return  $country_id;
            }
            else
            {
                if( !in_array( $outside_country_id, array( 'EU' ) ) )
                {
                    @Tools::report( 'No country for mark "' . $outside_country_id . '"', 'Lardi Import Error' );
                }

                return  0;
            }
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
                case 'Днепроп. обл.':
                    return 3;       //Дніпропетровська область
                    break;
                case 'Донецкая обл.':
                    return 4;       //Донецька область
                    break;
                case 'Житомир. обл.':
                    return 5;       //Житомирська область
                    break;
                case 'Закарп. обл.':
                    return 6;       //Закарпатська область
                    break;
                case 'Запорож. обл.':
                    return 7;       //Запорізька область
                    break;
                case 'Ив.Франк. обл.':
                    return 8;       //Івано-Франківська область
                    break;
                case 'Киевская обл.':
                    return 9;       //Київська область
                    break;
                case 'Кировогр. обл.':
                    return 10;      //Кіровоградська область
                    break;
                case 'Крым':
                    return 25;      //Крим, Автономна Республіка
                    break;
                case 'Луганская обл.':
                    return 11;      //Луганська область
                    break;
                case 'Львовская обл.':
                    return 12;      //Львівська область
                    break;
                case 'Николаев. обл.':
                    return 13;      //Миколаївська область
                    break;
                case 'Одесская обл.':
                    return 14;      //Одеська область
                    break;
                case 'Полтавск. обл.':
                    return 15;      //Полтавська область
                    break;
                case 'Ровенская обл.':
                    return 16;      //Рівенська область
                    break;
                case 'Сумская обл.':
                    return 17;      //Сумська область
                    break;
                case 'Терноп. обл.':
                    return 18;      //Тернопільська область
                    break;
                case 'Харьков. обл.':
                    return 19;      //Харківська область
                    break;
                case 'Херсон. обл.':
                    return 20;      //Херсонська область
                    break;
                case 'Хмельниц. обл.':
                    return 21;      //Хмельницька область
                    break;
                case 'Черкас. обл.':
                    return 22;      //Черкаська область
                    break;
                case 'Чернигов. обл.':
                    return 23;      //Чернігівська область
                    break;
                case 'Черновиц. обл.':
                    return 24;      //Чернівецька область
                    break;
                //Росія
                case 'Адыгея Р.':
                    return 694;     //Адигея
                    break;
                case 'Алтай Р.':
                    return 693;     //Алтай
                    break;
                case 'Алтайский край':
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
                case 'Башкортостан Р.':
                    return 692;       //Башкортостан
                    break;
                case 'Белгородская обл.':
                    return 657;       //Бєлгородська область
                    break;
                case 'Брянская обл.':
                    return 29;       //Брянська область
                    break;
                case 'Бурятия Р.':
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
                case 'Дагестан Р.':
                    return 690;       //Дагестан
                    break;
                case 'Еврейская авт. обл.':
                    return 661;       //Єврейська автономна область
                    break;
                case 'Агинский Бурят. окр.':
                    return 672;       //Забайкальський край
                    break;
                case 'Ивановская обл.':
                    return 33;       //Іванівська область
                    break;
                case 'Ингушская Р.':
                    return 689;       //Інгушетія
                    break;
                case 'Иркутская обл.': case 'Усть-Ордын. Бурят. окр':
                return 34;       //Іркутська область
                break;
                case 'Кабардино-Балкар. Р.':
                    return 688;       //Кабардино-Балкарська республіка
                    break;
                case 'Калининградская обл.':
                    return 35;       //Калинінградська область
                    break;
                case 'Калмыкия Р.':
                    return 687;       //Калмикія
                    break;
                case 'Калужская обл.':
                    return 36;       //Калужська область
                    break;
                case 'Камчатская обл.':
                    return 37;       //Камчатська область
                    break;
                case 'Карачаево-Черкес. Р.':
                    return 686;       //Карачаєво-Черкесія
                    break;
                case 'Карелия Р.':
                    return 685;       //Карелія
                    break;
                case 'Кемеровская обл.':
                    return 38;       //Кемерівська область
                    break;
                case 'Кировская обл.':
                    return 39;       //Кіровська область
                    break;
                case 'Коми Р.':
                    return 684;       //Комі
                    break;
                case 'Корякский окр.':
                    return 671;       //Камчатський край
                    break;
                case 'Костромская обл.':
                    return 40;       //Костромська область
                    break;
                case 'Краснодарский край':
                    return 670;       //Краснодарський край
                    break;
                case 'Красноярский край': case 'Таймырский окр.': case 'Эвенкийский окр.':
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
                case 'Марий Эл Р.':
                    return 683;       //Марій Ел
                    break;
                case 'Мордовия Р.':
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
                case 'Коми-Пермяцкий окр.': case 'Пермская обл.':
                return 660;       //Пермський край
                break;
                case 'Приморский край':
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
                case 'Саха (Якутия) Р.':
                    return 681;       //Саха (Якутія)
                    break;
                case 'Сахалинская обл.':
                    return 57;       //Сахалінська область
                    break;
                case 'Свердловская обл.':
                    return 58;       //Свердловська область
                    break;
                case 'Северная Осетия Р.':
                    return 680;       //Північна Осетія
                    break;
                case 'Смоленская обл.':
                    return 789;       //Смоленська область
                    break;
                case 'Ставропольский край':
                    return 667;       //Ставропольський край
                    break;
                case 'Тамбовская обл.':
                    return 778;       //Тамбовська область
                    break;
                case 'Татарстан Р.':
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
                case 'Тува Р.':
                    return 678;       //Тива
                    break;
                case 'Тюменская обл.':
                    return 61;       //Тюменська область
                    break;
                case 'Удмуртская Р.':
                    return 677;       //Удмуртія
                    break;
                case 'Ульяновская обл.':
                    return 62;       //Ул'янівська область
                    break;
                case 'Хабаровский край':
                    return 666;       //Хабаровський край
                    break;
                case 'Хакасия Р.':
                    return 676;       //Хакасія
                    break;
                case 'Ханты-Мансийский окр.':
                    return 664;       //Ханти-Мансійський автономний округ
                    break;
                case 'Челябинская обл.':
                    return 63;       //Челябінська область
                    break;
                case 'Чеченская Р.':
                    return 675;       //Чеченська республіка
                    break;
                case 'Читинская обл.':
                    return 64;       //Чітинська область
                    break;
                case 'Чувашская Р.':
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
                case 'Восточно-Казахстан. обл.':
                    return 76;       //Східно-Казахстанська область
                    break;
                case 'Джамбульская обл.':
                    return 77;       //Жамбильська область
                    break;
                case 'Западно-Казахстан. обл.':
                    return 78;       //Західно-Кахастанська область
                    break;
                case 'Карагандинская обл.':
                    return 79;       //Карагандинська область
                    break;
                case 'Кустанайская обл.':
                    return 81;       //Костанайська область
                    break;
                case 'Кызыл-Ординская обл.':
                    return 80;       //Кизилординська область
                    break;
                case 'Мангистауская обл.':
                    return 82;       //Мангистауська область
                    break;
                case 'Павлодарская обл.':
                    return 83;       //Павлодарська область
                    break;
                case 'Северо-Казахстан. обл.':
                    return 84;       //Північно-Казахстанська область
                    break;
                case 'Южно-Казахстан. обл.':
                    return 85;       //Південно-Казахстанська область
                    break;
                default:
                    //Tools::report( 'No REGION_ID for name "' . $outside_region_id . '"', 'Lardi Import Error' );
                    return 0;
                    break;
            }
        }

        protected function _getVehicleId( $outside_vehicle_id )
        {
            switch( $outside_vehicle_id )
            {
                case 'тент':
                    return 4;
                    break;
                case 'изотерм':
                    return 7;
                    break;
                case 'крытая':
                    return 2;
                    break;
                case 'реф.':
                    return 5;
                    break;
                case 'цельномет.':
                    return 6;
                    break;
                case 'автовоз':
                    return 9;
                    break;
                case 'автобус':
                    return 8;
                    break;
                case 'бензовоз':
                    return 32;
                    break;
                case 'бус':
                    return 18;
                    break;
                case 'газовоз':
                    return 33;
                    break;
                case 'зерновоз':
                    return 12;
                    break;
                case 'контейнер':
                    return 13;
                    break;
                case 'контейнеровоз':
                    return 14;
                    break;
                case 'лесовоз':
                    return 16;
                    break;
                case 'мебелевоз':
                    return 17;
                    break;
                case 'муковоз':
                    return 40;
                    break;
                case 'негабарит':
                    return 19;
                    break;
                case 'контейнер-зерновоз': case 'одеждовоз': case 'плитовоз': case 'яхтовоз':
                return 36;      //Інший
                break;
                case 'открытая':
                    return 3;
                    break;
                case 'самосвал':
                    return 21;
                    break;
                case 'скотовоз':
                    return 22;
                    break;
                case 'спецтехника':
                    return 36;
                    break;
                case 'трал':
                    return 37;
                    break;
                case 'трубовоз':
                    return 24;
                    break;
                case 'любая':
                    return 0;
                    break;
                case 'эвакуатор':
                    return 39;
                    break;
                case 'цистерна':
                    return 38;
                    break;
                default :
                    Tools::report( 'No VEHICLE_ID for name "' . $outside_vehicle_id . '"', 'Lardi Import Error' );
                    return 0;
                    break;
            }
        }

        private function _convertDate( $date_string )
        {
            $date_parts = explode( " ", $date_string );

            if ( count( $date_parts ) > 1 )
            {
                $time = $date_parts[2];
                $day = $date_parts[0];

                switch( $date_parts[1] )
                {
                    case 'янв':
                        $month = 1;
                        break;
                    case 'фев':
                        $month = 2;
                        break;
                    case 'мар':
                        $month = 3;
                        break;
                    case 'апр':
                        $month = 4;
                        break;
                    case 'май': case 'мая':
                    $month = 5;
                    break;
                    case 'июн':
                        $month = 6;
                        break;
                    case 'июл':
                        $month = 7;
                        break;
                    case 'авг':
                        $month = 8;
                        break;
                    case 'сен':
                        $month = 9;
                        break;
                    case 'окт':
                        $month = 10;
                        break;
                    case 'ноя':
                        $month = 11;
                        break;
                    case 'дек':
                        $month = 12;
                        break;
                    default :
                        @Tools::report( 'No MONTH_ID for name "' . $date_parts[1] . '"', 'Lardi Import Error' );
                        break;
                }

                $year = date( 'Y' );
            }
            else
            {
                $time = $date_parts[0];
                $day = date( 'd' );
                $month = date( 'm' );
                $year = date( 'Y' );
            }

            list( $hour, $minute ) = explode( ':', $time );

            return date( 'Y-m-d H:i:s', mktime( $hour, $minute, 0, $month, $day, $year ) );
        }

        private function _decodeEntity( $string )
        {
            $string = str_replace( '&nbsp;', ' ', $string );

            if ( preg_match_all( '[&#(\d+);]i', $string, $match ) )
            {
                for( $i = 0; $i < count( $match[0] ); $i++ )
                {
                    $string = str_replace( "&#" . $match[1][$i] . ";", chr( $match[1][$i] ), $string );
                }
            }

            return $string;
        }

        private function _getContactPersonEmail( $company_id, $contact_person )
        {
            $email = Db::i()->getValue( 'SELECT email FROM companies_l WHERE company_id = ' . $company_id . ' AND agent = "' . $contact_person . '"' );

            return !empty( $email ) ? $email : '';
        }

        private function _getCompanyEmails( $company_id )
        {
            $emails = Db::i()->getCol( 'SELECT email FROM companies_l WHERE company_id = ' . $company_id );

            return !empty( $emails ) ? $emails : array();
        }

        private function _getOurCompanyEmail( $our_company_id )
        {
            $email = Db::i()->getValue( 'SELECT email FROM users WHERE id = ' . $our_company_id );

            return !empty( $email ) ? $email : '';
        }

        public function __construct( $section )
        {
            $this->_getCookies( 'lardi-trans.com/log/login.jsp', 'log=tov_esg29&passwd=esg2013ubr' );

            parent::__construct( 'l', $section );
        }

        public function __destruct()
        {
            parent::__destruct();
        }
    }
