<?php
class OutsideParserC extends OutsideParserAbstract
{
    protected function _getCookies( $host, $query, $others = '' )
    {
        $this->cookies = '';
    }

    protected function _getDirections()
    {
        return
            array(
                array( 'from' => 'All', 'to' => 'All', 'period' => 1, 'depth' => 10 ),       //Всі-Всі
                //array( 'from' => 'UA', 'to' => 'UA', 'period' => 1, 'depth' => 3 ),       //Україна-Україна
                //array( 'from' => 'UA', 'to' => 'RU', 'period' => 1, 'depth' => 3 ),       //Україна-Росія
                //array( 'from' => 'RU', 'to' => 'UA', 'period' => 2, 'depth' => 2 ),       //Росія-Україна
            );
    }

    protected function _getListData( $direction, $page_number )
    {
        if( 'freight' == $this->section )
        {
            $url = 'http://cargogeo.com/Services/CargoService.asmx/CargoSearch';

            $data = array(
                'DateFrom' => null,
                'DateTo' => null,
                'FromAddress' => null,
                'ToAddress' => null,
                /*'FromAddress' => array(
                    'IdCity' => null,
                    'Country' => $direction['from'],
                    'Region' => null
                ),
                'ToAddress' => array(
                    'IdCity' => null,
                    'Country' => $direction['to'],
                    'Region' => null
                ),*/
                'FromRadius' => null,
                'ToRadius' => null,
                'MinDistance' => null,
                'MinDistanceInPercents' => true,
                'MaxRadius' => null,
                'PassageWidth' => null,
                'Polygon' => null,
                'AddPeriod' => 0,
                'MinQuantity' => null,
                'MaxQuantity' => null,
                'MinVolume' => null,
                'MaxVolume' => null,
                'IdTruckTypes' => null,
                'AllowBackLoading' => true,
                'AllowUpperLoading' => true,
                'AllowSideLoading' => true,
                'CanAddLoading' => '3',
                'TIR' => false,
                'ADR' => '0',
                'MinRating' => 0,
                'GoodReferences' => false,
                'Filter' => null,
                'PartnerLevel' => '0',
                'BlackListLevel' => '0',
                'SortOrder' => 'ChangeDate',
                'RowsPerPage' => 100,
                'PageNumber' => $page_number,
                'Source' => 0,
                'IdTruck' => null,
                'IdCompany' => null
            );
        }
        else
        {
            $url = 'http://cargogeo.com/Services/TruckService.asmx/TruckSearch';

            $data = array(
                'dateFrom' => null,
                'dateTo' => null,
                'AddPeriod' => 0,
                'truckTypes' => null,
                'allowBackLoading' => true,
                'allowBackUnloading' => true,
                'allowUpperLoading' => true,
                'allowUpperUnloading' => true,
                'allowSideLoading' => true,
                'allowSideUnloading' => true,
                'FromAddress' => null,
                'ToAddress' => null,
                /*'FromAddress' => array(
                    'IdCity' => null,
                    'Country' => $direction['from'],
                    'Region' => null
                ),
                'ToAddress' => array(
                    'IdCity' => null,
                    'Country' => $direction['to'],
                    'Region' => null
                ),*/
                'fromRadius' => null,
                'toRadius' => null,
                'canAddLoading' => null,
                'minQuantity' => null,
                'maxQuantity' => null,
                'minVolume' => null,
                'maxVolume' => null,
                'minRating' => 0,
                'goodReferences' => false,
                'partnerLevel' => '0',
                'blackListLevel' => '0',
                'filter' => null,
                'truckSource' => 0,
                'orderBy' => 'ChangeDate DESC',
                'rowsPerPage' => 100,
                'pageNumber' => $page_number,
                'TIR' => false,
                'ADR' => '0',
                'IdCargo' => null,
                'IdCompany' => null
            );
        }

        $headers = array(
            'Content-Type:application/json; charset=UTF-8'
        );

        return $this->_read( $url, $headers, Tools::json_encode( $data ) );
    }

    protected function _getListDataTest()
    {
        if( 'freight' == $this->section )
        {
            return '{"d":{"__type":"CargoServiceWS.RouteData","Id":0,"Points":[],"Legs":[],"PolygonPoints":[],"FromPoint":null,"FromRadius":null,"ToPoint":null,"ToRadius":null,"MaxRadius":null,"CargoDirections":[{"Id":8035,"Name":"Краснодар - Пятигорск","Start":{"IdCity":265,"City":"Краснодар","Address":null,"Country":"RU","Lat":45.0349,"Lon":38.976,"NumItems":1},"Finish":{"IdCity":45,"City":"Пятигорск","Address":null,"Country":"RU","Lat":44.0528,"Lon":43.026,"NumItems":2},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":null,"TIR":false,"CargoDef":"напитки","Quantity":20,"Volume":82,"ToPoint":{"IdCity":45,"Lat":44.0528,"Lon":43.026,"Address":"Пятигорск, Ставропольский край, RU","Region":null,"CityName":"Пятигорск","Country":"RU"},"AddPoints":[],"Distance":428.548,"IsCargoOwner":false,"Id":18761568,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"Изот;Реф;Тент; зад.-зад.-бок.-верх.","FromPoint":{"IdCity":265,"Lat":45.0349,"Lon":38.976,"Address":"Краснодар, Краснодарский край, RU","Region":null,"CityName":"Краснодар","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":9567,"IdSourceSystem":1,"ExternalSystem":"CargoGeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":12000.0000,"PriceDef":"RUB","Company":"ИП Куликов Д.Ю.","Contact":"Екатерина","Phone":"78792260118","MobilePhone":"79054477411","ICQ":null,"Skype":null,"Email":"kulikov-den@yandex.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"наличка","CreateDate":"\/Date(1363374840000)\/","ChangeDate":"\/Date(1363375020000)\/","IdRouteCache":8035,"ContextPrice":0.0000,"IsContext":false,"Shows":144,"NumRegs":1}]},{"Id":69456,"Name":"Чехов - Чехов","Start":{"IdCity":61,"City":"Чехов","Address":null,"Country":"RU","Lat":55.1474,"Lon":37.4561,"NumItems":3},"Finish":{"IdCity":61,"City":"Чехов","Address":null,"Country":"RU","Lat":55.1474,"Lon":37.4561,"NumItems":2},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"стройматериалы","Quantity":1,"Volume":1,"ToPoint":{"IdCity":61,"Lat":55.1474,"Lon":37.4561,"Address":"Чехов , RU","Region":null,"CityName":"Чехов","Country":"RU"},"AddPoints":[],"Distance":0,"IsCargoOwner":false,"Id":18473872,"DateFrom":"\/Date(1363291200000)\/","DateTo":"\/Date(1363896000000)\/","TruckDef":"Кран; зад.-зад.бок.-бок.верх.-верх.","FromPoint":{"IdCity":61,"Lat":55.1474,"Lon":37.4561,"Address":"Чехов, RU","Region":null,"CityName":"Чехов","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":224914,"ExternalFirmAddId":null,"Price":null,"PriceDef":null,"Company":"Интегра-Запад, ООО","Contact":"Алексей","Phone":"74963825634","MobilePhone":"79295257477","ICQ":null,"Skype":null,"Email":"kira.toporina@rambler.ru","SIPNumber":null,"Rating":5,"GodReferences":68,"BadReferences":0,"Description":"Заключаем договоры с владельцами кранов по всей МО, звонить с 9-18запаллечен","CreateDate":"\/Date(1362427200000)\/","ChangeDate":"\/Date(1363373880000)\/","IdRouteCache":69456,"ContextPrice":null,"IsContext":false,"Shows":180,"NumRegs":1}]},{"Id":69211,"Name":"Раменское - Раменское","Start":{"IdCity":1561,"City":"Раменское","Address":null,"Country":"RU","Lat":55.5643,"Lon":38.2385,"NumItems":1},"Finish":{"IdCity":1561,"City":"Раменское","Address":null,"Country":"RU","Lat":55.5643,"Lon":38.2385,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"стройматериалы","Quantity":1,"Volume":1,"ToPoint":{"IdCity":1561,"Lat":55.5643,"Lon":38.2385,"Address":"Раменское , RU","Region":null,"CityName":"Раменское","Country":"RU"},"AddPoints":[],"Distance":0,"IsCargoOwner":false,"Id":18473876,"DateFrom":"\/Date(1363291200000)\/","DateTo":"\/Date(1363896000000)\/","TruckDef":"Кран; зад.-зад.бок.-бок.верх.-верх.","FromPoint":{"IdCity":1561,"Lat":55.5643,"Lon":38.2385,"Address":"Раменское, RU","Region":null,"CityName":"Раменское","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":224914,"ExternalFirmAddId":null,"Price":null,"PriceDef":null,"Company":"Интегра-Запад, ООО","Contact":"Алексей","Phone":"74963825634","MobilePhone":"79295257477","ICQ":null,"Skype":null,"Email":"kira.toporina@rambler.ru","SIPNumber":null,"Rating":5,"GodReferences":68,"BadReferences":0,"Description":"Заключаем договоры с владельцами кранов до 10 тонн  по всей МО, звонить с 9-18запаллечен","CreateDate":"\/Date(1362427200000)\/","ChangeDate":"\/Date(1363373880000)\/","IdRouteCache":69211,"ContextPrice":null,"IsContext":false,"Shows":180,"NumRegs":1}]},{"Id":310770,"Name":"Клинцы - Калуга","Start":{"IdCity":2386,"City":"Клинцы","Address":null,"Country":"RU","Lat":52.7555,"Lon":32.2476,"NumItems":1},"Finish":{"IdCity":219,"City":"Калуга","Address":null,"Country":"RU","Lat":54.5351,"Lon":36.2477,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"Пеноблоки","Quantity":20,"Volume":0,"ToPoint":{"IdCity":219,"Lat":54.5351,"Lon":36.2477,"Address":"Калуга, Калужская область, Россия","Region":null,"CityName":"Калуга","Country":"RU"},"AddPoints":[],"Distance":394.887,"IsCargoOwner":false,"Id":18749305,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"Борт;Тент; зад.-зад.верх.-верх.","FromPoint":{"IdCity":2386,"Lat":52.7555,"Lon":32.2476,"Address":"Клинцы, Брянская область, Россия","Region":null,"CityName":"Клинцы","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":224914,"ExternalFirmAddId":null,"Price":17500.0000,"PriceDef":"RUB","Company":"Интегра-Запад, ООО","Contact":"Дмитрий","Phone":"74999404474","MobilePhone":"79299797327","ICQ":null,"Skype":null,"Email":"mandrag.avto@gmail.com","SIPNumber":null,"Rating":5,"GodReferences":68,"BadReferences":0,"Description":"НА КАРТУ ИЛИ БЫСТРЫЙ БЕЗНАЛ ПО ФАКСОВОМУ СЧЕТУ, ЗАГРУЗКА ДО 17.00!запаллечен 16500 нал.; 17500 с НДС  17500 без НДС","CreateDate":"\/Date(1363345560000)\/","ChangeDate":"\/Date(1363373880000)\/","IdRouteCache":310770,"ContextPrice":null,"IsContext":false,"Shows":175,"NumRegs":1}]},{"Id":65844,"Name":"Можайск - Чехов","Start":{"IdCity":1575,"City":"Можайск","Address":null,"Country":"RU","Lat":55.5047,"Lon":36.0125,"NumItems":1},"Finish":{"IdCity":61,"City":"Чехов","Address":null,"Country":"RU","Lat":55.1474,"Lon":37.4561,"NumItems":2},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"Пеноблоки","Quantity":20,"Volume":0,"ToPoint":{"IdCity":61,"Lat":55.1474,"Lon":37.4561,"Address":"Чехов, Московская область, Россия","Region":null,"CityName":"Чехов","Country":"RU"},"AddPoints":[],"Distance":143.5,"IsCargoOwner":false,"Id":18751956,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"Борт;Тент; бок.-бок.верх.-верх.","FromPoint":{"IdCity":1575,"Lat":55.5047,"Lon":36.0125,"Address":"Можайск, Московская область, Россия","Region":null,"CityName":"Можайск","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":224914,"ExternalFirmAddId":null,"Price":8500.0000,"PriceDef":"RUB","Company":"Интегра-Запад, ООО","Contact":"Дмитрий","Phone":"74999404474","MobilePhone":"79299797327","ICQ":null,"Skype":null,"Email":"mandrag.avto@gmail.com","SIPNumber":null,"Rating":5,"GodReferences":68,"BadReferences":0,"Description":"НА КАРТУ ИЛИ БЫСТРЫЙ БЕЗНАЛ ПО ФАКСОВОМУ СЧЕТУ, ЗАГРУЗКА ДО 22.00, ВЫГРУЗКА 19.03.13!запаллечен 8000 нал.; 8500 с НДС  8500 без НДС","CreateDate":"\/Date(1363348620000)\/","ChangeDate":"\/Date(1363373880000)\/","IdRouteCache":65844,"ContextPrice":null,"IsContext":false,"Shows":176,"NumRegs":1}]},{"Id":1056881,"Name":"поселок Малаховка - Химки","Start":{"IdCity":2062,"City":"поселок Малаховка","Address":null,"Country":"RU","Lat":55.6437,"Lon":38.009,"NumItems":2},"Finish":{"IdCity":218,"City":"Химки","Address":null,"Country":"RU","Lat":55.9668,"Lon":37.4158,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"Стройматериалы","Quantity":20,"Volume":0,"ToPoint":{"IdCity":218,"Lat":55.9668,"Lon":37.4158,"Address":"Химки, Московская область, Россия","Region":null,"CityName":"Химки","Country":"RU"},"AddPoints":[],"Distance":72.11,"IsCargoOwner":false,"Id":18751689,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"Борт;Тент; бок.-бок.верх.-верх.","FromPoint":{"IdCity":2062,"Lat":55.6437,"Lon":38.009,"Address":"Малаховка, Московская область, Россия","Region":null,"CityName":"поселок Малаховка","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":224914,"ExternalFirmAddId":null,"Price":14000.0000,"PriceDef":"RUB","Company":"Интегра-Запад, ООО","Contact":"Илья","Phone":"74999404474","MobilePhone":"79269944464","ICQ":null,"Skype":null,"Email":"t9944464@gmail.com","SIPNumber":null,"Rating":5,"GodReferences":68,"BadReferences":0,"Description":"КРУГОРЕЙС: МАЛАХОВКА - МОЖАЙСК - ХИМКИ! НАЛ ИЛИ Б/Н!Д,м:12 13000 нал.; 14000 с НДС  14000 без НДС","CreateDate":"\/Date(1363348260000)\/","ChangeDate":"\/Date(1363373880000)\/","IdRouteCache":1056881,"ContextPrice":null,"IsContext":false,"Shows":176,"NumRegs":1}]},{"Id":3407844,"Name":"поселок Малаховка - Руза","Start":{"IdCity":2062,"City":"поселок Малаховка","Address":null,"Country":"RU","Lat":55.6437,"Lon":38.009,"NumItems":2},"Finish":{"IdCity":1812,"City":"Руза","Address":null,"Country":"RU","Lat":55.7024,"Lon":36.1917,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"Стройматериалы","Quantity":20,"Volume":0,"ToPoint":{"IdCity":1812,"Lat":55.7024,"Lon":36.1917,"Address":"Руза, Московская область, Россия","Region":null,"CityName":"Руза","Country":"RU"},"AddPoints":[],"Distance":160.343,"IsCargoOwner":false,"Id":18752739,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"Борт;Тент; верх.-верх.","FromPoint":{"IdCity":2062,"Lat":55.6437,"Lon":38.009,"Address":"Малаховка, Московская область, Россия","Region":null,"CityName":"поселок Малаховка","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":224914,"ExternalFirmAddId":null,"Price":8500.0000,"PriceDef":"RUB","Company":"Интегра-Запад, ООО","Contact":"Илья","Phone":"74999404474","MobilePhone":"79269944464","ICQ":null,"Skype":null,"Email":"t9944464@gmail.com","SIPNumber":null,"Rating":5,"GodReferences":68,"BadReferences":0,"Description":"ВОЗМОЖНА ОБРАТКА НА ХИМКИ!Д,м:12 8000 нал.; 8500 с НДС  8500 без НДС","CreateDate":"\/Date(1363349520000)\/","ChangeDate":"\/Date(1363373880000)\/","IdRouteCache":3407844,"ContextPrice":null,"IsContext":false,"Shows":177,"NumRegs":1}]},{"Id":4576232,"Name":"Чехов - поселок Павловская Слобода","Start":{"IdCity":61,"City":"Чехов","Address":null,"Country":"RU","Lat":55.1474,"Lon":37.4561,"NumItems":3},"Finish":{"IdCity":2306,"City":"поселок Павловская Слобода","Address":null,"Country":"RU","Lat":55.8072,"Lon":37.0806,"NumItems":2},"NumItems":2,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"УТЕПЛИТЕЛЬ","Quantity":20,"Volume":90,"ToPoint":{"IdCity":2306,"Lat":55.8072,"Lon":37.0806,"Address":"Павловская Слобода, Московская область, Россия","Region":null,"CityName":"поселок Павловская Слобода","Country":"RU"},"AddPoints":[],"Distance":106.219,"IsCargoOwner":false,"Id":18745739,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"Тент; зад.-зад.","FromPoint":{"IdCity":61,"Lat":55.1474,"Lon":37.4561,"Address":"Чехов, Московская область, Россия","Region":null,"CityName":"Чехов","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":224914,"ExternalFirmAddId":null,"Price":9500.0000,"PriceDef":"RUB","Company":"Интегра-Запад, ООО","Contact":"Илья","Phone":"74999404474","MobilePhone":"79269944464","ICQ":null,"Skype":null,"Email":"t9944464@gmail.com","SIPNumber":null,"Rating":5,"GodReferences":68,"BadReferences":0,"Description":"ЕВРО МАШИНА! 2 МАШИНЫ! ЗАГРУЗКА ПОСЛЕ ОБЕДА, ВЫГРУЗКА ВО ВТОРНИК УТРОМ!в пачках 9000 нал.; 9500 с НДС  9500 без НДС","CreateDate":"\/Date(1363341840000)\/","ChangeDate":"\/Date(1363373880000)\/","IdRouteCache":4576232,"ContextPrice":null,"IsContext":false,"Shows":176,"NumRegs":1},{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"УТЕПЛИТЕЛЬ","Quantity":3,"Volume":90,"ToPoint":{"IdCity":2306,"Lat":55.8072,"Lon":37.0806,"Address":"Павловская Слобода, Московская область, Россия","Region":null,"CityName":"поселок Павловская Слобода","Country":"RU"},"AddPoints":[],"Distance":106.219,"IsCargoOwner":false,"Id":18745536,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"Тент; зад.-зад.","FromPoint":{"IdCity":61,"Lat":55.1474,"Lon":37.4561,"Address":"Чехов, Московская область, Россия","Region":null,"CityName":"Чехов","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":224914,"ExternalFirmAddId":null,"Price":9500.0000,"PriceDef":"RUB","Company":"Интегра-Запад, ООО","Contact":"Илья","Phone":"74999404474","MobilePhone":"79269944464","ICQ":null,"Skype":null,"Email":"t9944464@gmail.com","SIPNumber":null,"Rating":5,"GodReferences":68,"BadReferences":0,"Description":"ЕВРО МАШИНА! 2 МАШИНЫ! ЗАГРУЗКА ПОСЛЕ ОБЕДА, ВЫГРУЗКА ВО ВТОРНИК УТРОМ!в пачках 9000 нал.; 9500 с НДС  9500 без НДС","CreateDate":"\/Date(1363341840000)\/","ChangeDate":"\/Date(1363373880000)\/","IdRouteCache":4576232,"ContextPrice":null,"IsContext":false,"Shows":176,"NumRegs":1}]},{"Id":591,"Name":"Санкт-Петербург - Воронеж","Start":{"IdCity":15,"City":"Санкт-Петербург","Address":null,"Country":"RU","Lat":59.9385,"Lon":30.3135,"NumItems":2},"Finish":{"IdCity":57,"City":"Воронеж","Address":null,"Country":"RU","Lat":51.6625,"Lon":39.2041,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"ТНП","Quantity":1.5,"Volume":12,"ToPoint":{"IdCity":57,"Lat":51.6625,"Lon":39.2041,"Address":"Воронеж, Воронежская область, Россия","Region":null,"CityName":"Воронеж","Country":"RU"},"AddPoints":[],"Distance":1233.233,"IsCargoOwner":false,"Id":18761566,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"Тент;Фург; зад.-зад.","FromPoint":{"IdCity":15,"Lat":59.9385,"Lon":30.3135,"Address":"Санкт-Петербург, Ленинградская область, Россия","Region":null,"CityName":"Санкт-Петербург","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":301108,"ExternalFirmAddId":null,"Price":15000.0000,"PriceDef":"RUB","Company":"Другой Берег, ООО","Contact":"Андрей","Phone":"78124452772","MobilePhone":"79112353773","ICQ":null,"Skype":null,"Email":"lakizenko@drygoibereg.ru","SIPNumber":null,"Rating":4.5,"GodReferences":41,"BadReferences":0,"Description":"отдельный авто, 4м по полуД,м:4 15000 с НДС  15000 без НДС","CreateDate":"\/Date(1363373700000)\/","ChangeDate":"\/Date(1363373700000)\/","IdRouteCache":591,"ContextPrice":null,"IsContext":false,"Shows":184,"NumRegs":1}]},{"Id":421,"Name":"Ижевск - Нижний Новгород","Start":{"IdCity":289,"City":"Ижевск","Address":null,"Country":"RU","Lat":56.8567,"Lon":53.1741,"NumItems":1},"Finish":{"IdCity":20,"City":"Нижний Новгород","Address":null,"Country":"RU","Lat":56.3245,"Lon":44.0019,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"ТНП","Quantity":5,"Volume":40,"ToPoint":{"IdCity":20,"Lat":56.3245,"Lon":44.0019,"Address":"Нижний Новгород, Нижегородская область, Россия","Region":null,"CityName":"Нижний Новгород","Country":"RU"},"AddPoints":[],"Distance":784.92,"IsCargoOwner":false,"Id":18740940,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"Тент; зад.-зад.","FromPoint":{"IdCity":289,"Lat":56.8567,"Lon":53.1741,"Address":"Ижевск, республика Удмуртская, Россия","Region":null,"CityName":"Ижевск","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":460147,"ExternalFirmAddId":null,"Price":6000.0000,"PriceDef":"RUB","Company":"Меркурий, ООО","Contact":"Дарья","Phone":"78312400186","MobilePhone":"79527676761","ICQ":null,"Skype":null,"Email":"mercuritrans@bk.ru","SIPNumber":null,"Rating":2.6,"GodReferences":20,"BadReferences":0,"Description":"6000","CreateDate":"\/Date(1363333680000)\/","ChangeDate":"\/Date(1363373700000)\/","IdRouteCache":421,"ContextPrice":null,"IsContext":false,"Shows":177,"NumRegs":1}]},{"Id":264,"Name":"Москва - Ростов-на-Дону","Start":{"IdCity":4,"City":"Москва","Address":null,"Country":"RU","Lat":55.7536,"Lon":37.6092,"NumItems":4},"Finish":{"IdCity":203,"City":"Ростов-на-Дону","Address":null,"Country":"RU","Lat":47.2272,"Lon":39.7449,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"Оборудование и запчасти","Quantity":3,"Volume":10,"ToPoint":{"IdCity":203,"Lat":47.2272,"Lon":39.7449,"Address":"Ростов-на-Дону, Ростовская область, Россия","Region":null,"CityName":"Ростов-на-Дону","Country":"RU"},"AddPoints":[],"Distance":1075,"IsCargoOwner":false,"Id":18761567,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"(Закр); зад.-зад.","FromPoint":{"IdCity":4,"Lat":55.7536,"Lon":37.6092,"Address":"Москва, Московская область, Россия","Region":null,"CityName":"Москва","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":314142,"ExternalFirmAddId":null,"Price":null,"PriceDef":null,"Company":"ЛС-транс, ООО","Contact":"Антон","Phone":"78632184758","MobilePhone":"79289030032","ICQ":null,"Skype":null,"Email":"elasto21@mail.ru","SIPNumber":null,"Rating":4.65,"GodReferences":60,"BadReferences":0,"Description":"","CreateDate":"\/Date(1363373700000)\/","ChangeDate":"\/Date(1363373700000)\/","IdRouteCache":264,"ContextPrice":null,"IsContext":false,"Shows":179,"NumRegs":1}]},{"Id":156955,"Name":"Тимашевск - Пятигорск","Start":{"IdCity":253,"City":"Тимашевск","Address":null,"Country":"RU","Lat":45.6025,"Lon":38.9598,"NumItems":1},"Finish":{"IdCity":45,"City":"Пятигорск","Address":null,"Country":"RU","Lat":44.0528,"Lon":43.026,"NumItems":2},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":null,"TIR":false,"CargoDef":"напитки","Quantity":20,"Volume":82,"ToPoint":{"IdCity":45,"Lat":44.0528,"Lon":43.026,"Address":"Пятигорск, Ставропольский край, RU","Region":null,"CityName":"Пятигорск","Country":"RU"},"AddPoints":[],"Distance":451.434,"IsCargoOwner":false,"Id":18761564,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"Изот;Реф;Тент; зад.-зад.","FromPoint":{"IdCity":253,"Lat":45.6025,"Lon":38.9598,"Address":"Тимашевск, Краснодарский край, RU","Region":null,"CityName":"Тимашевск","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":9567,"IdSourceSystem":1,"ExternalSystem":"CargoGeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":12500.0000,"PriceDef":"RUB","Company":"ИП Куликов Д.Ю.","Contact":"Екатерина","Phone":"78792260118","MobilePhone":"79054477411","ICQ":null,"Skype":null,"Email":"kulikov-den@yandex.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"наличка на выгрузке","CreateDate":"\/Date(1363373520000)\/","ChangeDate":"\/Date(1363373640000)\/","IdRouteCache":156955,"ContextPrice":0.0000,"IsContext":false,"Shows":184,"NumRegs":1}]},{"Id":600169,"Name":"Баксан - поселок Горшечное","Start":{"IdCity":1696,"City":"Баксан","Address":null,"Country":"RU","Lat":43.6856,"Lon":43.5419,"NumItems":1},"Finish":{"IdCity":3761,"City":"поселок Горшечное","Address":null,"Country":"RU","Lat":51.5255,"Lon":38.0362,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"Зерно и семена (в упаковке)","Quantity":20,"Volume":30,"ToPoint":{"IdCity":3761,"Lat":51.5255,"Lon":38.0362,"Address":"Горшечное, Курская область, Россия","Region":null,"CityName":"поселок Горшечное","Country":"RU"},"AddPoints":[],"Distance":1203.185,"IsCargoOwner":false,"Id":18761565,"DateFrom":"\/Date(1363723200000)\/","DateTo":"\/Date(1364155200000)\/","TruckDef":"(Закр);(Откр);Изот;Реф; зад.-зад.бок.-бок.верх.-верх.","FromPoint":{"IdCity":1696,"Lat":43.6856,"Lon":43.5419,"Address":"Баксан, республика Кабардино-Балкарская, Россия","Region":null,"CityName":"Баксан","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":33461,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":268823,"ExternalFirmAddId":null,"Price":15000.0000,"PriceDef":"RUB","Company":"Терра-Хим, ООО","Contact":"АСЛАН","Phone":"79034972595","MobilePhone":"79034972595","ICQ":null,"Skype":null,"Email":"tertsh.a@gmail.com","SIPNumber":null,"Rating":3,"GodReferences":0,"BadReferences":0,"Description":"800 палет. 15000","CreateDate":"\/Date(1363373640000)\/","ChangeDate":"\/Date(1363373640000)\/","IdRouteCache":600169,"ContextPrice":null,"IsContext":false,"Shows":180,"NumRegs":1}]},{"Id":331,"Name":"Санкт-Петербург - Санкт-Петербург","Start":{"IdCity":15,"City":"Санкт-Петербург","Address":null,"Country":"RU","Lat":59.9385,"Lon":30.3135,"NumItems":2},"Finish":{"IdCity":15,"City":"Санкт-Петербург","Address":null,"Country":"RU","Lat":59.9385,"Lon":30.3135,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"Оборудование и запчасти","Quantity":3,"Volume":0,"ToPoint":{"IdCity":15,"Lat":59.9385,"Lon":30.3135,"Address":"Санкт-Петербург, Ленинградская область, Россия","Region":null,"CityName":"Санкт-Петербург","Country":"RU"},"AddPoints":[],"Distance":0,"IsCargoOwner":false,"Id":18761563,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"(Откр); верх.-верх.","FromPoint":{"IdCity":15,"Lat":59.9385,"Lon":30.3135,"Address":"Санкт-Петербург, Ленинградская область, Россия","Region":null,"CityName":"Санкт-Петербург","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":411307,"ExternalFirmAddId":null,"Price":null,"PriceDef":null,"Company":"AC-логистик, ООО","Contact":"Анна","Phone":"78124382643","MobilePhone":"79633214751","ICQ":null,"Skype":null,"Email":"anna.kotova@ac-logistic.ru","SIPNumber":null,"Rating":3,"GodReferences":49,"BadReferences":0,"Description":"рулоны","CreateDate":"\/Date(1363373400000)\/","ChangeDate":"\/Date(1363373400000)\/","IdRouteCache":331,"ContextPrice":null,"IsContext":false,"Shows":188,"NumRegs":1}]},{"Id":6532,"Name":"Москва - Дзержинск","Start":{"IdCity":4,"City":"Москва","Address":null,"Country":"RU","Lat":55.7536,"Lon":37.6092,"NumItems":4},"Finish":{"IdCity":1642,"City":"Дзержинск","Address":null,"Country":"RU","Lat":56.2386,"Lon":43.4616,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"Пластик","Quantity":0.1,"Volume":0.1,"ToPoint":{"IdCity":1642,"Lat":56.2386,"Lon":43.4616,"Address":"Дзержинск, Нижегородская область, Россия","Region":null,"CityName":"Дзержинск","Country":"RU"},"AddPoints":[],"Distance":395.031,"IsCargoOwner":false,"Id":18742282,"DateFrom":"\/Date(1363636800000)\/","DateTo":"\/Date(1363636800000)\/","TruckDef":"(Закр); зад.-зад.","FromPoint":{"IdCity":4,"Lat":55.7536,"Lon":37.6092,"Address":"Москва, Московская область, Россия","Region":null,"CityName":"Москва","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":29565,"ExternalFirmAddId":null,"Price":null,"PriceDef":null,"Company":"ВедаТранс, ООО","Contact":"Леушкина Наталья","Phone":"78313260615","MobilePhone":"79601941171","ICQ":null,"Skype":null,"Email":"natalia30.08@yandex.ru","SIPNumber":null,"Rating":5,"GodReferences":13,"BadReferences":0,"Description":"нал на выгрузке!   панель длина 4 м ширина 1,5м толщина 3мм  ( возможна установка вдоль борта )","CreateDate":"\/Date(1363334040000)\/","ChangeDate":"\/Date(1363373340000)\/","IdRouteCache":6532,"ContextPrice":null,"IsContext":false,"Shows":195,"NumRegs":1}]},{"Id":39006,"Name":"Киров - Курган","Start":{"IdCity":257,"City":"Киров","Address":null,"Country":"RU","Lat":58.6034,"Lon":49.6672,"NumItems":1},"Finish":{"IdCity":385,"City":"Курган","Address":null,"Country":"RU","Lat":55.4537,"Lon":65.3423,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"Продукты питания","Quantity":18,"Volume":86,"ToPoint":{"IdCity":385,"Lat":55.4537,"Lon":65.3423,"Address":"Курган, Курганская область, Россия","Region":null,"CityName":"Курган","Country":"RU"},"AddPoints":[],"Distance":1215.089,"IsCargoOwner":false,"Id":18749021,"DateFrom":"\/Date(1363291200000)\/","DateTo":"\/Date(1363377600000)\/","TruckDef":"Изот;Реф;Тент;Фург;Ц/Мет;  зад.-зад.-бок.-верх.","FromPoint":{"IdCity":257,"Lat":58.6034,"Lon":49.6672,"Address":"Киров, Кировская область, Россия","Region":null,"CityName":"Киров","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":6829,"ExternalFirmAddId":null,"Price":46000.0000,"PriceDef":"RUB","Company":"Вяттранспорт-Логистик, ООО","Contact":"Александр Сергеевич Домрачев","Phone":"78332522464","MobilePhone":"79229932823","ICQ":null,"Skype":null,"Email":"adomrachev@freelogistic.ru","SIPNumber":null,"Rating":5,"GodReferences":45,"BadReferences":0,"Description":"СРОЧНО ДАННЫЕ! ПОГРУЗКА 16.03. СУББОТА!! Адрес загрузки: 2 места рядом;запаллечен 46000 без НДС","CreateDate":"\/Date(1363345320000)\/","ChangeDate":"\/Date(1363373280000)\/","IdRouteCache":39006,"ContextPrice":null,"IsContext":false,"Shows":186,"NumRegs":1}]},{"Id":72057,"Name":"Ярославль - Кстово","Start":{"IdCity":297,"City":"Ярославль","Address":null,"Country":"RU","Lat":57.6225,"Lon":39.8877,"NumItems":1},"Finish":{"IdCity":1828,"City":"Кстово","Address":null,"Country":"RU","Lat":56.1469,"Lon":44.1686,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"Оборудование и запчасти","Quantity":20,"Volume":42,"ToPoint":{"IdCity":1828,"Lat":56.1469,"Lon":44.1686,"Address":"Кстово, Нижегородская область, Россия","Region":null,"CityName":"Кстово","Country":"RU"},"AddPoints":[],"Distance":430.699,"IsCargoOwner":false,"Id":18743881,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"Тент; верх.-верх.","FromPoint":{"IdCity":297,"Lat":57.6225,"Lon":39.8877,"Address":"Ярославль, Ярославская область, Россия","Region":null,"CityName":"Ярославль","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":159176,"ExternalFirmAddId":null,"Price":15000.0000,"PriceDef":"RUB","Company":"Инвестпродукт, ООО","Contact":"Моисеев Алексей","Phone":"74852726493","MobilePhone":"79622087001","ICQ":null,"Skype":null,"Email":"alexmoiseev1988@mail.ru","SIPNumber":null,"Rating":4.5,"GodReferences":53,"BadReferences":0,"Description":"тент с кониками или ремнями 14000 15000 с НДС  15000 без НДС","CreateDate":"\/Date(1363329060000)\/","ChangeDate":"\/Date(1363373280000)\/","IdRouteCache":72057,"ContextPrice":null,"IsContext":false,"Shows":187,"NumRegs":1}]},{"Id":79,"Name":"Москва - Самара","Start":{"IdCity":4,"City":"Москва","Address":null,"Country":"RU","Lat":55.7536,"Lon":37.6092,"NumItems":4},"Finish":{"IdCity":59,"City":"Самара","Address":null,"Country":"RU","Lat":53.2444,"Lon":50.1991,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"ТНП","Quantity":18,"Volume":82,"ToPoint":{"IdCity":59,"Lat":53.2444,"Lon":50.1991,"Address":"Самара, Самарская область, Россия","Region":null,"CityName":"Самара","Country":"RU"},"AddPoints":[],"Distance":1047.955,"IsCargoOwner":false,"Id":18761561,"DateFrom":"\/Date(1363291200000)\/","DateTo":"\/Date(1363896000000)\/","TruckDef":"Изот;Ц/Мет; зад.-зад.","FromPoint":{"IdCity":4,"Lat":55.7536,"Lon":37.6092,"Address":"Москва, Московская область, Россия","Region":null,"CityName":"Москва","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":34607,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":435313,"ExternalFirmAddId":null,"Price":null,"PriceDef":null,"Company":"ЭКСТЭС-ТРАНСПОРТ, ЗАО","Contact":"Дмитрий","Phone":"79260454555","MobilePhone":null,"ICQ":null,"Skype":null,"Email":"ddemashin@mail.ru","SIPNumber":null,"Rating":2.65,"GodReferences":4,"BadReferences":0,"Description":"Изотерма или цельномет, оплата без НДС. через ИП.запаллечен","CreateDate":"\/Date(1363373160000)\/","ChangeDate":"\/Date(1363373280000)\/","IdRouteCache":79,"ContextPrice":null,"IsContext":false,"Shows":191,"NumRegs":1}]},{"Id":120,"Name":"Москва - Екатеринбург","Start":{"IdCity":4,"City":"Москва","Address":null,"Country":"RU","Lat":55.7536,"Lon":37.6092,"NumItems":4},"Finish":{"IdCity":131,"City":"Екатеринбург","Address":null,"Country":"RU","Lat":56.8381,"Lon":60.5973,"NumItems":1},"NumItems":1,"Cargos":[{"IdDirection":0,"ADR":0,"TIR":false,"CargoDef":"ТНП","Quantity":18,"Volume":82,"ToPoint":{"IdCity":131,"Lat":56.8381,"Lon":60.5973,"Address":"Екатеринбург, Свердловская область, Россия","Region":null,"CityName":"Екатеринбург","Country":"RU"},"AddPoints":[],"Distance":1787.713,"IsCargoOwner":false,"Id":18761562,"DateFrom":"\/Date(1363291200000)\/","DateTo":"\/Date(1363896000000)\/","TruckDef":"Изот;Ц/Мет; зад.-зад.","FromPoint":{"IdCity":4,"Lat":55.7536,"Lon":37.6092,"Address":"Москва, Московская область, Россия","Region":null,"CityName":"Москва","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":34607,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":0,"ExternalFirmId":435313,"ExternalFirmAddId":null,"Price":null,"PriceDef":null,"Company":"ЭКСТЭС-ТРАНСПОРТ, ЗАО","Contact":"Дмитрий","Phone":"79260454555","MobilePhone":null,"ICQ":null,"Skype":null,"Email":"ddemashin@mail.ru","SIPNumber":null,"Rating":2.65,"GodReferences":4,"BadReferences":0,"Description":"Изотерма или цельномет, оплата без НДС через ИП.запаллечен","CreateDate":"\/Date(1363373160000)\/","ChangeDate":"\/Date(1363373280000)\/","IdRouteCache":120,"ContextPrice":null,"IsContext":false,"Shows":190,"NumRegs":1}]}],"MaxCargo":32178.834,"TotalCargoCount":32304,"TruckPoints":[],"TotalTrucksCount":0,"TimeInSeconds":0,"Distance":0,"NorthEst":{"Lat":59.9385,"Lon":30.3135},"SouthWest":{"Lat":43.6856,"Lon":65.3423},"QueryTime":598,"Balance":0.1}}';
        }
        else
        {
            return '{"d":{"__type":"TruckServiceWS.RouteData","Id":0,"Points":[],"Legs":[],"PolygonPoints":[],"FromPoint":null,"FromRadius":null,"ToPoint":null,"ToRadius":null,"MaxRadius":null,"CargoDirections":[],"MaxCargo":0,"TotalCargoCount":0,"TruckPoints":[{"Id":237,"Trucks":[{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821661,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":20,"MaxVolume":88,"ToPoint":{"IdCity":73,"Lat":43.13409,"Lon":131.928482,"Address":"Владивосток, Приморский край, RU","Region":"Приморский край","CityName":"Владивосток","Country":"RU"},"Distance":5021.956,"IsTruckOwner":false,"Id":4528676,"DateFrom":"\/Date(1363377600000)\/","DateTo":"\/Date(1364673600000)\/","TruckDef":"Сед (полупр.)","FromPoint":{"IdCity":237,"Lat":56.0087128,"Lon":92.8704147,"Address":"Красноярск, Красноярский край, RU","Region":"Красноярский край","CityName":"Красноярск","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":51251,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"морозов сергей николаевич","Contact":"сергей","Phone":null,"MobilePhone":"+79147276729","ICQ":null,"Skype":null,"Email":"morozov_slv1967@mail.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"\u003cbr/\u003e","CreateDate":"\/Date(1363384800000)\/","ChangeDate":"\/Date(1363384920000)\/","IdRouteCache":7077,"ContextPrice":0.3000,"IsContext":false,"Shows":10,"NumRegs":0}]},{"Id":4,"Trucks":[{"__type":"TruckServiceWS.TruckInfo","IdDirection":null,"MaxRadius":null,"FromRadius":250,"ToRadius":null,"PassageWidth":null,"AllowUpperLoad":true,"AllowSideLoad":true,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":2,"MaxVolume":16,"ToPoint":null,"Distance":null,"IsTruckOwner":false,"Id":4146446,"DateFrom":"\/Date(1363377600000)\/","DateTo":"\/Date(1363464000000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":4,"Lat":55.75356,"Lon":37.60922,"Address":"Москва, Московская область, RU","Region":"Московская область","CityName":"Москва","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":45499,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":10.0000,"PriceDef":"RUB/km","Company":"Андрей","Contact":"zakxadarvampir@mail.ru","Phone":null,"MobilePhone":"89280083523","ICQ":null,"Skype":null,"Email":"zakxadarvampir@mail.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"\u003cbr/\u003e","CreateDate":"\/Date(1356775740000)\/","ChangeDate":"\/Date(1363384020000)\/","IdRouteCache":null,"ContextPrice":0.3000,"IsContext":false,"Shows":13,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":29351144,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":1,"MinVolume":1,"MaxQuantity":5,"MaxVolume":12,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"Вологодская область, RU","Region":"Вологодская область","CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":4278715,"DateFrom":"\/Date(1363377600000)\/","DateTo":"\/Date(1363464000000)\/","TruckDef":"Фург (полупр.)","FromPoint":{"IdCity":4,"Lat":55.75356,"Lon":37.60922,"Address":"Москва, Московская область, RU","Region":"Московская область","CityName":"Москва","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":47986,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"предприниматель","Contact":"89115323645","Phone":"79115323645","MobilePhone":"79115323645","ICQ":null,"Skype":null,"Email":"ira.filinskaya@yandex.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"фургон ворота\u003cbr/\u003e","CreateDate":"\/Date(1359490140000)\/","ChangeDate":"\/Date(1363382340000)\/","IdRouteCache":null,"ContextPrice":0.3000,"IsContext":false,"Shows":17,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":29505446,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":1,"MinVolume":1,"MaxQuantity":5,"MaxVolume":12,"ToPoint":{"IdCity":306,"Lat":59.22304,"Lon":39.88387,"Address":"Вологда, Вологодская область, RU","Region":"Вологодская область","CityName":"Вологда","Country":"RU"},"Distance":461.797,"IsTruckOwner":false,"Id":4293465,"DateFrom":"\/Date(1363377600000)\/","DateTo":"\/Date(1363464000000)\/","TruckDef":"Фург (полупр.)","FromPoint":{"IdCity":4,"Lat":55.75356,"Lon":37.60922,"Address":"Москва, Московская область, RU","Region":"Московская область","CityName":"Москва","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":47986,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"предприниматель","Contact":"89115323645","Phone":"79115323645","MobilePhone":"79115323645","ICQ":null,"Skype":null,"Email":"ira.filinskaya@yandex.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"фургон ворота\u003cbr/\u003e","CreateDate":"\/Date(1359662400000)\/","ChangeDate":"\/Date(1363382280000)\/","IdRouteCache":270,"ContextPrice":0.3000,"IsContext":false,"Shows":17,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":29350304,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":1,"MinVolume":1,"MaxQuantity":5,"MaxVolume":12,"ToPoint":{"IdCity":306,"Lat":59.22304,"Lon":39.88387,"Address":"вологда","Region":"Вологодская область","CityName":"Вологда","Country":"RU"},"Distance":461.797,"IsTruckOwner":false,"Id":4278697,"DateFrom":"\/Date(1363377600000)\/","DateTo":"\/Date(1363464000000)\/","TruckDef":"Фург (полупр.)","FromPoint":{"IdCity":4,"Lat":55.75356,"Lon":37.60922,"Address":"Москва, Московская область, RU","Region":"Московская область","CityName":"Москва","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":47986,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"предприниматель","Contact":"89115323645","Phone":"79115323645","MobilePhone":"79115323645","ICQ":null,"Skype":null,"Email":"ira.filinskaya@yandex.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"кунг ворота\u003cbr/\u003e","CreateDate":"\/Date(1359484320000)\/","ChangeDate":"\/Date(1363382280000)\/","IdRouteCache":270,"ContextPrice":0.3000,"IsContext":false,"Shows":17,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":29262747,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":1,"MinVolume":1,"MaxQuantity":5,"MaxVolume":12,"ToPoint":{"IdCity":306,"Lat":59.22304,"Lon":39.88387,"Address":"Вологда, Вологодская область, RU","Region":"Вологодская область","CityName":"Вологда","Country":"RU"},"Distance":461.797,"IsTruckOwner":false,"Id":4270737,"DateFrom":"\/Date(1363377600000)\/","DateTo":"\/Date(1363464000000)\/","TruckDef":"Фург (полупр.)","FromPoint":{"IdCity":4,"Lat":55.75356,"Lon":37.60922,"Address":"Москва, Московская область, RU","Region":"Московская область","CityName":"Москва","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":47986,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"предприниматель","Contact":"89115323645","Phone":"79115323645","MobilePhone":"79115323645","ICQ":null,"Skype":null,"Email":"ira.filinskaya@yandex.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"ворота\u003cbr/\u003e","CreateDate":"\/Date(1359402180000)\/","ChangeDate":"\/Date(1363382280000)\/","IdRouteCache":270,"ContextPrice":0.3000,"IsContext":false,"Shows":17,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821646,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":3,"MaxVolume":21,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"Россия","Region":null,"CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":2863167,"DateFrom":"\/Date(1363291200000)\/","DateTo":"\/Date(1363896000000)\/","TruckDef":"Фург (грузов.)","FromPoint":{"IdCity":4,"Lat":55.75356,"Lon":37.60922,"Address":"Москва,Россия","Region":"Московская область","CityName":"Москва","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":null,"ExternalFirmId":107641,"ExternalFirmAddId":null,"Price":15.0000,"PriceDef":"RUB/km","Company":"Маркин Геннадий Алексеевич, ИП","Contact":"Виктор до 3 тонн","Phone":"+7(916)1687174","MobilePhone":"+7(965)3995043","ICQ":null,"Skype":null,"Email":"senator_55@mail.ru","SIPNumber":null,"Rating":2.5,"GodReferences":5,"BadReferences":0,"Description":"8 евро-паллет звонить Виктору8 евро-паллет звонить Виктору Оплата: Б/Нал.\u003cbr/\u003e","CreateDate":"\/Date(1357416000000)\/","ChangeDate":"\/Date(1363374120000)\/","IdRouteCache":null,"ContextPrice":null,"IsContext":false,"Shows":42,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":null,"MaxRadius":null,"FromRadius":50,"ToRadius":null,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":true,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":6,"MinVolume":6,"MaxQuantity":6,"MaxVolume":60,"ToPoint":null,"Distance":null,"IsTruckOwner":false,"Id":4202694,"DateFrom":"\/Date(1358366400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":4,"Lat":55.75356,"Lon":37.60922,"Address":"Москва, Московская область, RU","Region":"Московская область","CityName":"Москва","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":18520,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":30.0000,"PriceDef":"RUB/km","Company":"майкл","Contact":"Забелин М.А.","Phone":"+7(926)2030377","MobilePhone":"+7(909)9664883","ICQ":"562136752","Skype":null,"Email":"mzabelin@yahoo.com","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"догрузы не берем,только отдельной машиной,оплата наличными при загрузке или выгрузке!!!!!!!!!\u003cbr/\u003e","CreateDate":"\/Date(1358435760000)\/","ChangeDate":"\/Date(1363241040000)\/","IdRouteCache":null,"ContextPrice":0.5000,"IsContext":true,"Shows":668,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":null,"MaxRadius":null,"FromRadius":50,"ToRadius":null,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":5,"MinVolume":5,"MaxQuantity":5,"MaxVolume":36,"ToPoint":null,"Distance":null,"IsTruckOwner":false,"Id":4501956,"DateFrom":"\/Date(1362945600000)\/","DateTo":"\/Date(1367352000000)\/","TruckDef":"Фург (грузов.)","FromPoint":{"IdCity":4,"Lat":55.75356,"Lon":37.60922,"Address":"Москва, Московская область, RU","Region":"Московская область","CityName":"Москва","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":18520,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":25.0000,"PriceDef":"RUB/km","Company":"майкл","Contact":"Забелин М.А.","Phone":"+7(926)2030377","MobilePhone":"+7(909)9664883","ICQ":"562136752","Skype":null,"Email":"mzabelin@yahoo.com","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"мебельный фургон,гидроборт\u003cbr/\u003e","CreateDate":"\/Date(1363009860000)\/","ChangeDate":"\/Date(1363240980000)\/","IdRouteCache":null,"ContextPrice":0.5000,"IsContext":true,"Shows":669,"NumRegs":0}]},{"Id":203,"Trucks":[{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821659,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":10,"MaxVolume":40,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"Ставропольский край, RU","Region":"Ставропольский край","CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":4446452,"DateFrom":"\/Date(1363464000000)\/","DateTo":"\/Date(1364068800000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":203,"Lat":47.22716,"Lon":39.74492,"Address":"Ростов-на-Дону, Ростовская область, RU","Region":"Ростовская область","CityName":"Ростов-на-Дону","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":45787,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"ИП Фролов А.А.","Contact":"Андрей","Phone":null,"MobilePhone":"89054313532","ICQ":null,"Skype":null,"Email":"andrey_frolov75@bk.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"\u003cbr/\u003e","CreateDate":"\/Date(1362054120000)\/","ChangeDate":"\/Date(1363380180000)\/","IdRouteCache":null,"ContextPrice":0.3000,"IsContext":false,"Shows":23,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821655,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":10,"MaxVolume":40,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"Волгоградская область, RU","Region":"Волгоградская область","CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":4174695,"DateFrom":"\/Date(1363464000000)\/","DateTo":"\/Date(1364068800000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":203,"Lat":47.22716,"Lon":39.74492,"Address":"Ростов-на-Дону, Ростовская область, RU","Region":"Ростовская область","CityName":"Ростов-на-Дону","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":45787,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"ИП Фролов А.А.","Contact":"Андрей","Phone":"9054313532","MobilePhone":"89054313532","ICQ":null,"Skype":null,"Email":"andrey_frolov75@bk.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"\u003cbr/\u003e","CreateDate":"\/Date(1357898940000)\/","ChangeDate":"\/Date(1363380180000)\/","IdRouteCache":null,"ContextPrice":0.5000,"IsContext":false,"Shows":23,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821656,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":10,"MaxVolume":40,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"Воронежская область, RU","Region":"Воронежская область","CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":4174687,"DateFrom":"\/Date(1363464000000)\/","DateTo":"\/Date(1364068800000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":203,"Lat":47.22716,"Lon":39.74492,"Address":"Ростов-на-Дону, Ростовская область, RU","Region":"Ростовская область","CityName":"Ростов-на-Дону","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":45787,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"ИП Фролов А.А.","Contact":"Андрей","Phone":"9054313532","MobilePhone":"89054313532","ICQ":null,"Skype":null,"Email":"andrey_frolov75@bk.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"\u003cbr/\u003e","CreateDate":"\/Date(1357898760000)\/","ChangeDate":"\/Date(1363380180000)\/","IdRouteCache":null,"ContextPrice":0.5000,"IsContext":false,"Shows":23,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821657,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":10,"MaxVolume":40,"ToPoint":{"IdCity":7,"Lat":43.5827942,"Lon":39.72227,"Address":"Сочи, Краснодарский край, RU","Region":"Краснодарский край","CityName":"Сочи","Country":"RU"},"Distance":554.22,"IsTruckOwner":false,"Id":4174682,"DateFrom":"\/Date(1363464000000)\/","DateTo":"\/Date(1364068800000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":203,"Lat":47.22716,"Lon":39.74492,"Address":"Ростов-на-Дону, Ростовская область, RU","Region":"Ростовская область","CityName":"Ростов-на-Дону","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":45787,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"ИП Фролов А.А.","Contact":"Андрей","Phone":"88632784036","MobilePhone":"89054313532","ICQ":null,"Skype":null,"Email":"andrey_frolov75@bk.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"Чистый,сухой кузов.Стяжки.\u003cbr/\u003e","CreateDate":"\/Date(1357898640000)\/","ChangeDate":"\/Date(1363380180000)\/","IdRouteCache":216,"ContextPrice":0.5000,"IsContext":false,"Shows":23,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821658,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":10,"MaxVolume":40,"ToPoint":{"IdCity":4,"Lat":55.75356,"Lon":37.60922,"Address":"Москва, Московская область, RU","Region":"Московская область","CityName":"Москва","Country":"RU"},"Distance":1071.533,"IsTruckOwner":false,"Id":4174654,"DateFrom":"\/Date(1363464000000)\/","DateTo":"\/Date(1364068800000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":203,"Lat":47.22716,"Lon":39.74492,"Address":"Ростов-на-Дону, Ростовская область, RU","Region":"Ростовская область","CityName":"Ростов-на-Дону","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":45787,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"ИП Фролов А.А.","Contact":"Андрей","Phone":null,"MobilePhone":"89054313532","ICQ":null,"Skype":null,"Email":"andrey_frolov75@bk.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"\u003cbr/\u003e","CreateDate":"\/Date(1357898280000)\/","ChangeDate":"\/Date(1363380180000)\/","IdRouteCache":427,"ContextPrice":0.5000,"IsContext":false,"Shows":23,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821660,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":10,"MaxVolume":40,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"RU","Region":null,"CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":4073553,"DateFrom":"\/Date(1363464000000)\/","DateTo":"\/Date(1364068800000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":203,"Lat":47.22716,"Lon":39.74492,"Address":"Ростов-на-Дону, Ростовская область, RU","Region":"Ростовская область","CityName":"Ростов-на-Дону","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":45787,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"ИП Фролов А.А.","Contact":"Андрей","Phone":null,"MobilePhone":"89054313532","ICQ":null,"Skype":null,"Email":"andrey_frolov75@bk.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"Из Ростова-на-Дону и Области на Россию.Чистый,сухой кузов.Стяжки. Можно безнал.ИП без НДС.\u003cbr/\u003e","CreateDate":"\/Date(1355683440000)\/","ChangeDate":"\/Date(1363380180000)\/","IdRouteCache":null,"ContextPrice":0.5000,"IsContext":false,"Shows":23,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821651,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":10,"MaxVolume":40,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"Липецкая область, RU","Region":"Липецкая область","CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":4300482,"DateFrom":"\/Date(1363464000000)\/","DateTo":"\/Date(1364068800000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":203,"Lat":47.22716,"Lon":39.74492,"Address":"Ростов-на-Дону, Ростовская область, RU","Region":"Ростовская область","CityName":"Ростов-на-Дону","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":45787,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"ИП Фролов А.А.","Contact":"Андрей","Phone":"88632784036","MobilePhone":"89054313532","ICQ":null,"Skype":null,"Email":"andrey_frolov75@bk.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"\u003cbr/\u003e","CreateDate":"\/Date(1359885780000)\/","ChangeDate":"\/Date(1363380120000)\/","IdRouteCache":null,"ContextPrice":0.3000,"IsContext":false,"Shows":23,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821652,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":10,"MaxVolume":40,"ToPoint":{"IdCity":265,"Lat":45.0349426,"Lon":38.9760323,"Address":"Краснодар, Краснодарский край, RU","Region":"Краснодарский край","CityName":"Краснодар","Country":"RU"},"Distance":274.737,"IsTruckOwner":false,"Id":4230501,"DateFrom":"\/Date(1363464000000)\/","DateTo":"\/Date(1364068800000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":203,"Lat":47.22716,"Lon":39.74492,"Address":"Ростов-на-Дону, Ростовская область, RU","Region":"Ростовская область","CityName":"Ростов-на-Дону","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":45787,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"ИП Фролов А.А.","Contact":"Андрей","Phone":"89054313532","MobilePhone":"89054313532","ICQ":null,"Skype":null,"Email":"andrey_frolov75@bk.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"\u003cbr/\u003e","CreateDate":"\/Date(1358881560000)\/","ChangeDate":"\/Date(1363380120000)\/","IdRouteCache":416,"ContextPrice":0.5000,"IsContext":false,"Shows":23,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821653,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":10,"MaxVolume":40,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"Ленинградская область, RU","Region":"Ленинградская область","CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":4213813,"DateFrom":"\/Date(1363464000000)\/","DateTo":"\/Date(1364068800000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":203,"Lat":47.22716,"Lon":39.74492,"Address":"Ростов-на-Дону, Ростовская область, RU","Region":"Ростовская область","CityName":"Ростов-на-Дону","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":45787,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"ИП Фролов А.А.","Contact":"Андрей","Phone":null,"MobilePhone":"89054313532","ICQ":null,"Skype":null,"Email":"andrey_frolov75@bk.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"\u003cbr/\u003e","CreateDate":"\/Date(1358696700000)\/","ChangeDate":"\/Date(1363380120000)\/","IdRouteCache":null,"ContextPrice":0.5000,"IsContext":false,"Shows":23,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821654,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":10,"MaxVolume":40,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"Тамбовская область, RU","Region":"Тамбовская область","CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":4174707,"DateFrom":"\/Date(1363464000000)\/","DateTo":"\/Date(1364068800000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":203,"Lat":47.22716,"Lon":39.74492,"Address":"Ростов-на-Дону, Ростовская область, RU","Region":"Ростовская область","CityName":"Ростов-на-Дону","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":45787,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"ИП Фролов А.А.","Contact":"Андрей","Phone":"9054313532","MobilePhone":"89054313532","ICQ":null,"Skype":null,"Email":"andrey_frolov75@bk.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"\u003cbr/\u003e","CreateDate":"\/Date(1357899060000)\/","ChangeDate":"\/Date(1363380120000)\/","IdRouteCache":null,"ContextPrice":0.5000,"IsContext":false,"Shows":23,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821628,"MaxRadius":null,"FromRadius":100,"ToRadius":130,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":10,"MaxVolume":40,"ToPoint":{"IdCity":252,"Lat":57.1826324,"Lon":65.55841,"Address":"Тюмень,Россия","Region":"Тюменская область","CityName":"Тюмень","Country":"RU"},"Distance":2607.895,"IsTruckOwner":false,"Id":4510351,"DateFrom":"\/Date(1363291200000)\/","DateTo":"\/Date(1363377600000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":203,"Lat":47.22716,"Lon":39.74492,"Address":"Ростов-на-Дону,Россия","Region":"Ростовская область","CityName":"Ростов-на-Дону","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":45787,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":null,"ExternalFirmId":586986,"ExternalFirmAddId":null,"Price":45.0000,"PriceDef":"RUB/km","Company":"Фролов А.А., ИП","Contact":"Андрей","Phone":"+7(863)2784036","MobilePhone":"+7(905)4313532","ICQ":null,"Skype":null,"Email":"don61-161@mail.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"Без догруза.Без НДС.Предоплата на выгрузке 30%.Кругорейс или с обратной загрузкой будет дешевле.\u003cbr/\u003e","CreateDate":"\/Date(1363032000000)\/","ChangeDate":"\/Date(1363374060000)\/","IdRouteCache":12688,"ContextPrice":null,"IsContext":false,"Shows":41,"NumRegs":0}]},{"Id":212,"Trucks":[{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821650,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":9,"MaxVolume":55,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"RU","Region":null,"CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":4203380,"DateFrom":"\/Date(1363377600000)\/","DateTo":"\/Date(1363636800000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":212,"Lat":58.00849,"Lon":56.2410774,"Address":"Пермь, Пермский край, RU","Region":"Пермский край","CityName":"Пермь","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":47527,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":25.0000,"PriceDef":"RUB/km","Company":"Физ.лицо","Contact":"Данил","Phone":null,"MobilePhone":"8908-24-12-953","ICQ":null,"Skype":null,"Email":"2danil24@mail.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"\u003cbr/\u003e","CreateDate":"\/Date(1358442900000)\/","ChangeDate":"\/Date(1363378440000)\/","IdRouteCache":null,"ContextPrice":0.3000,"IsContext":false,"Shows":28,"NumRegs":0}]},{"Id":265,"Trucks":[{"__type":"TruckServiceWS.TruckInfo","IdDirection":32821639,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":true,"AllowSideLoad":true,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":20,"MaxVolume":82,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"Волгоградская область,Россия","Region":"Волгоградская область","CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":4528657,"DateFrom":"\/Date(1363550400000)\/","DateTo":"\/Date(1363550400000)\/","TruckDef":"Тент (полупр.)","FromPoint":{"IdCity":265,"Lat":45.0349426,"Lon":38.9760323,"Address":"Краснодар,Россия","Region":"Краснодарский край","CityName":"Краснодар","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":null,"IdSourceSystem":2,"ExternalSystem":"ati.su","ExternalId":null,"ExternalFirmId":541510,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"КАУСТИК, ОАО","Contact":"Украинченко Екатерина Александровна","Phone":"+7(8442)406111","MobilePhone":"+7(961)6650501","ICQ":"639373515","Skype":null,"Email":"transport@kaustik.ru","SIPNumber":null,"Rating":1.5,"GodReferences":0,"BadReferences":0,"Description":"\u003cbr/\u003e","CreateDate":"\/Date(1363372260000)\/","ChangeDate":"\/Date(1363374060000)\/","IdRouteCache":null,"ContextPrice":null,"IsContext":false,"Shows":41,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32679657,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":true,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":7,"MaxVolume":26,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"Московская область, RU","Region":"Московская область","CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":2933703,"DateFrom":"\/Date(1363291200000)\/","DateTo":"\/Date(1363809600000)\/","TruckDef":"Изот (грузов.)","FromPoint":{"IdCity":265,"Lat":45.0349426,"Lon":38.9760323,"Address":"Краснодар, Краснодарский край, RU","Region":"Краснодарский край","CityName":"Краснодар","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":25416,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"ИП Аспоян","Contact":"Эдик","Phone":"918-33-33-053","MobilePhone":"918-33-33-053","ICQ":null,"Skype":null,"Email":"edo-alaverdi@yandex.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"Термобудка +4*С,10 европоллет, форма оплаты любая, цена договорная.\u003cbr/\u003e","CreateDate":"\/Date(1333336740000)\/","ChangeDate":"\/Date(1363263300000)\/","IdRouteCache":null,"ContextPrice":0.3500,"IsContext":true,"Shows":153,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32679496,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":true,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":7,"MaxVolume":26,"ToPoint":{"IdCity":4,"Lat":55.75356,"Lon":37.60922,"Address":"Москва, Московская область, RU","Region":"Московская область","CityName":"Москва","Country":"RU"},"Distance":1344.072,"IsTruckOwner":false,"Id":2427415,"DateFrom":"\/Date(1363291200000)\/","DateTo":"\/Date(1363809600000)\/","TruckDef":"Изот (грузов.)","FromPoint":{"IdCity":265,"Lat":45.0349426,"Lon":38.9760323,"Address":"Краснодар, Краснодарский край, RU","Region":"Краснодарский край","CityName":"Краснодар","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":25416,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"ИП Аспоян","Contact":"Эдик","Phone":"918-33-33-053","MobilePhone":"918-33-33-053","ICQ":null,"Skype":null,"Email":"edo-alaverdi@yandex.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"Термо +4*С, 10 европоллет\u003cbr/\u003e","CreateDate":"\/Date(1317483780000)\/","ChangeDate":"\/Date(1363263180000)\/","IdRouteCache":164,"ContextPrice":0.3500,"IsContext":true,"Shows":154,"NumRegs":0},{"__type":"TruckServiceWS.TruckInfo","IdDirection":32679488,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":true,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":7,"MaxVolume":26,"ToPoint":{"IdCity":265,"Lat":45.0349426,"Lon":38.9760323,"Address":"Краснодар, Краснодарский край, RU","Region":"Краснодарский край","CityName":"Краснодар","Country":"RU"},"Distance":0,"IsTruckOwner":false,"Id":3172472,"DateFrom":"\/Date(1363291200000)\/","DateTo":"\/Date(1363809600000)\/","TruckDef":"Изот (грузов.)","FromPoint":{"IdCity":265,"Lat":45.0349426,"Lon":38.9760323,"Address":"Краснодар, Краснодарский край, RU","Region":"Краснодарский край","CityName":"Краснодар","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":25416,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"ИП Аспоян","Contact":"Эдик","Phone":"918-33-33-053","MobilePhone":"918-33-33-053","ICQ":null,"Skype":null,"Email":"edo-alaverdi@yandex.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"термобудка +4*С, 10 европоллет, сан. паспорт\u003cbr/\u003e","CreateDate":"\/Date(1340942220000)\/","ChangeDate":"\/Date(1363263180000)\/","IdRouteCache":9619,"ContextPrice":0.3500,"IsContext":true,"Shows":143,"NumRegs":0}]},{"Id":131,"Trucks":[{"__type":"TruckServiceWS.TruckInfo","IdDirection":32687286,"MaxRadius":null,"FromRadius":100,"ToRadius":500,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":1,"MinVolume":1,"MaxQuantity":10,"MaxVolume":33,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"Челябинская область, RU","Region":"Челябинская область","CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":4174990,"DateFrom":"\/Date(1362945600000)\/","DateTo":"\/Date(1364500800000)\/","TruckDef":"Фург (полупр.)","FromPoint":{"IdCity":131,"Lat":56.8380547,"Lon":60.59726,"Address":"Екатеринбург, Свердловская область, RU","Region":"Свердловская область","CityName":"Екатеринбург","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":47031,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":20.0000,"PriceDef":"RUB/km","Company":"ИП. Еганов А.А.","Contact":"Андрей","Phone":"89122288298","MobilePhone":"89122288298","ICQ":null,"Skype":null,"Email":"an.eganov@yandex.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"\u003cbr/\u003e","CreateDate":"\/Date(1357902360000)\/","ChangeDate":"\/Date(1363266240000)\/","IdRouteCache":null,"ContextPrice":0.4000,"IsContext":true,"Shows":505,"NumRegs":0}]},{"Id":9,"Trucks":[{"__type":"TruckServiceWS.TruckInfo","IdDirection":null,"MaxRadius":null,"FromRadius":0,"ToRadius":null,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":2,"MinVolume":2,"MaxQuantity":3.5,"MaxVolume":16,"ToPoint":null,"Distance":null,"IsTruckOwner":false,"Id":4441845,"DateFrom":"\/Date(1362340800000)\/","DateTo":"\/Date(1364673600000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":9,"Lat":51.5377731,"Lon":46.00446,"Address":"Саратов, Саратовская область, RU","Region":"Саратовская область","CityName":"Саратов","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":32862,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":15.0000,"PriceDef":"RUB/km","Company":"И П Михайлов С Н","Contact":"89279165200","Phone":"88456768220","MobilePhone":"89270538081","ICQ":null,"Skype":null,"Email":"olga_mihailova_1965@mail.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"Добросовестный ответственный водитель без вредных привычек доставит ваш груз в любой регион России.  \u003cbr/\u003e","CreateDate":"\/Date(1361967840000)\/","ChangeDate":"\/Date(1361968440000)\/","IdRouteCache":null,"ContextPrice":0.3500,"IsContext":true,"Shows":1077,"NumRegs":0}]},{"Id":1756,"Trucks":[{"__type":"TruckServiceWS.TruckInfo","IdDirection":null,"MaxRadius":null,"FromRadius":0,"ToRadius":null,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":6,"MaxVolume":50,"ToPoint":null,"Distance":null,"IsTruckOwner":false,"Id":4476390,"DateFrom":"\/Date(1363377600000)\/","DateTo":"\/Date(1364760000000)\/","TruckDef":"Фург (грузов.)","FromPoint":{"IdCity":1756,"Lat":55.42608,"Lon":38.26118,"Address":"Бронницы, Московская область, RU","Region":"Московская область","CityName":"Бронницы","Country":"RU"},"CanAddLoading":true,"IdCompanyProfile":5434,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"паровоз","Contact":" Евгений","Phone":"+7(925)8904339","MobilePhone":"+7(925)8904339","ICQ":null,"Skype":null,"Email":"ark79757274@yandex.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"Догруз не возим.Оплата позже не интересна.\u003cbr/\u003e","CreateDate":"\/Date(1362485520000)\/","ChangeDate":"\/Date(1363321560000)\/","IdRouteCache":null,"ContextPrice":0.3500,"IsContext":true,"Shows":102,"NumRegs":0}]},{"Id":2717,"Trucks":[{"__type":"TruckServiceWS.TruckInfo","IdDirection":32341553,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":0,"MinVolume":0,"MaxQuantity":1.5,"MaxVolume":9,"ToPoint":{"IdCity":null,"Lat":null,"Lon":null,"Address":"RU","Region":null,"CityName":null,"Country":"RU"},"Distance":null,"IsTruckOwner":false,"Id":4501807,"DateFrom":"\/Date(1363291200000)\/","DateTo":"\/Date(1368475200000)\/","TruckDef":"Тент (грузов.)","FromPoint":{"IdCity":2717,"Lat":56.2687569,"Lon":54.9197,"Address":"Янаул, республика Башкортостан, RU","Region":"республика Башкортостан","CityName":"Янаул","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":50944,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":11.0000,"PriceDef":"RUB/km","Company":"ИП Тарисов Д.Х.","Contact":"Дамир","Phone":null,"MobilePhone":"9174679701","ICQ":null,"Skype":null,"Email":"damirtarisov@yandex.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"Новый ГАЗ-330232,5 мест,борт 3м\u003cbr/\u003e","CreateDate":"\/Date(1363008120000)\/","ChangeDate":"\/Date(1363008120000)\/","IdRouteCache":null,"ContextPrice":0.3500,"IsContext":true,"Shows":684,"NumRegs":0}]},{"Id":15,"Trucks":[{"__type":"TruckServiceWS.TruckInfo","IdDirection":32700045,"MaxRadius":null,"FromRadius":0,"ToRadius":0,"PassageWidth":null,"AllowUpperLoad":false,"AllowSideLoad":false,"AllowBackLoad":true,"ADR":null,"TIR":false,"MinQuantity":1,"MinVolume":1,"MaxQuantity":5,"MaxVolume":25,"ToPoint":{"IdCity":15,"Lat":59.93853,"Lon":30.3134975,"Address":"Санкт-Петербург, Ленинградская область, RU","Region":"Ленинградская область","CityName":"Санкт-Петербург","Country":"RU"},"Distance":0,"IsTruckOwner":false,"Id":4269326,"DateFrom":"\/Date(1359316800000)\/","DateTo":"\/Date(1364500800000)\/","TruckDef":"Фург (грузов.)","FromPoint":{"IdCity":15,"Lat":59.93853,"Lon":30.3134975,"Address":"Санкт-Петербург, Ленинградская область, RU","Region":"Ленинградская область","CityName":"Санкт-Петербург","Country":"RU"},"CanAddLoading":false,"IdCompanyProfile":42157,"IdSourceSystem":1,"ExternalSystem":"cargogeo.com","ExternalId":null,"ExternalFirmId":null,"ExternalFirmAddId":null,"Price":null,"PriceDef":"RUB/km","Company":"перевозчик","Contact":"89533515094","Phone":null,"MobilePhone":"89533515094","ICQ":null,"Skype":null,"Email":"alecs.alecsey5@mail.ru","SIPNumber":null,"Rating":0,"GodReferences":0,"BadReferences":0,"Description":"10евр палет 550нал 4+1 \u003cbr/\u003e","CreateDate":"\/Date(1359383760000)\/","ChangeDate":"\/Date(1363275360000)\/","IdRouteCache":331,"ContextPrice":0.3500,"IsContext":true,"Shows":130,"NumRegs":0}]}],"TotalTrucksCount":66252,"TimeInSeconds":0,"Distance":0,"NorthEst":null,"SouthWest":null,"QueryTime":428,"Balance":0.1}}';
        }
    }

    public function parseListData()
    {
        sleep( rand( 5, 10 ) );

        $directions = $this->_getDirections();

        //for( $direction_index = 0; $direction_index < 1; $direction_index++ )
        for( $direction_index = 0; $direction_index < count( $directions ); $direction_index++ )
        {
            if( 0 != $this->iteration_number % $directions[$direction_index]['period'] )
            {
                continue;
            }

            $this->_output( 'Direction: ' . $directions[$direction_index]['from'] . '-' . $directions[$direction_index]['to'] . chr( 10 ) );

            //for( $page_index = 0; $page_index < 1; $page_index++ )
            for( $page_index = 0; $page_index < $directions[$direction_index]['depth']; $page_index++ )
            {
                $this->_output( '> Page #: ' . ($page_index + 1) . ' - ' );

                //$list_data = $this->_getListDataTest();
                $list_data = $this->_getListData( $directions[$direction_index], $page_index + 1 );

                $routes = json_decode( $list_data );

                if( false === $list_data )
                {
                    $this->_output( $this->statuses_explanation[self::NO_CONNECTION] . chr( 10 ) );
                }
                elseif( empty( $routes->d ) )
                {
                    $this->_output( $this->statuses_explanation[self::NO_PAGE] . chr( 10 ) );
                }
                else
                {
                    $this->_output( $this->statuses_explanation[self::PROCESSED] . chr( 10 ) );

                    $routes = $routes->d->{'freight' == $this->section ? 'CargoDirections' : 'TruckPoints'};

                    //for( $route_index = 0; $route_index < 1; $route_index++ )
                    for( $route_index = 0; $route_index < count( $routes ); $route_index++ )
                    {
                        $route_item = $routes[$route_index]->{'freight' == $this->section ? 'Cargos' : 'Trucks'};

                        //for( $item_index = 0; $item_index < 1; $item_index++ )
                        for( $item_index = 0; $item_index < count( $route_item ); $item_index++ )
                        {
                            $list_item = $route_item[$item_index];

                            $user_data = array();

                            if( 1 == $list_item->IdSourceSystem || 3 == $list_item->IdSourceSystem )
                            {
                                $user_data['company_id'] = $list_item->IdCompanyProfile;
                            }
                            else
                            {
                                $user_data['company_id'] = $list_item->ExternalFirmId;
                            }

                            $this->_output( '>> Company ID: ' . $user_data['company_id'] . ' - ' );

                            if( 1 == $list_item->IdSourceSystem )
                            {
                                $user_data['source'] = 'c';
                            }
                            elseif( 2 == $list_item->IdSourceSystem )
                            {
                                $user_data['source'] = 'a';
                            }
                            elseif( 3 == $list_item->IdSourceSystem )
                            {
                                $user_data['source'] = 'l';
                            }

                            $user_data['section'] = $this->section;
                            $user_data['name'] = $list_item->Company;

                            if( !empty( $list_item->{'freight' == $this->section ? 'IsCargoOwner' : 'IsTruckOwner'} ) )
                            {
                                $user_data['forwarder'] =  0;
                            }
                            else
                            {
                                $user_data['forwarder'] = 1;
                            }

                            $control_phone = !empty( $list_item->Phone ) ? $list_item->Phone : $list_item->MobilePhone;
                            $country_data = $this->_getCountryByPhone( $control_phone );

                            if( !empty( $country_data ) )
                            {
                                $user_data['location'] = $country_data['domen'];
                                $user_data['countryid'] = $country_data['id'];
                            }
                            elseif( !empty( $list_item->FromPoint->Country ) && !empty( $list_item->ToPoint->Country )
                                && $list_item->FromPoint->Country == $list_item->ToPoint->Country )
                            {
                                $user_data['location'] = $list_item->FromPoint->Country;
                                $user_data['countryid'] = $this->_getCountryId( $list_item->FromPoint->Country );
                            }
                            else
                            {
                                $user_data['location'] = 'RU';
                                $user_data['countryid'] = 2;
                            }

                            $phones = array();

                            if( !empty( $list_item->Phone ) )
                            {
                                $phones[] = $list_item->Phone;
                            }

                            if( !empty( $list_item->MobilePhone ) && $list_item->Phone == $list_item->MobilePhone )
                            {
                                $phones[] = $list_item->MobilePhone;
                            }

                            $user_data['phones'] = implode( ',', $phones );

                            $user_data['emails'] = $list_item->Email;
                            $user_data['email'] = $list_item->Email;

                            if( 2 == $list_item->IdSourceSystem )
                            {
                                if( empty( $list_item->Email ) )
                                {
                                    $emails = $this->_getCompanyEmails( $list_item->ExternalFirmId );

                                    $user_data['emails'] = implode( ',', $emails );
                                    $user_data['email']  = $this->_getContactPersonEmail( $list_item->ExternalFirmId, $list_item->Contact );

                                    if( empty( $user_data['email'] ) && !empty( $emails ) )
                                    {
                                        $user_data['email'] = $emails[0];
                                    }
                                }
                            }

                            if( !empty( $phones[0] ) )
                            {
                                $user_data['tel1'] = $phones[0];
                            }

                            $user_data['icq'] = $list_item->ICQ;
                            $user_data['skype'] = $list_item->Skype;
                            $user_data['lang'] = 'ru';

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

                            $user_data['contact_person'] = $list_item->Contact;
                            $user_data['outside'] = 1;

                            @Distribution::addEmail( $user_data['email'], $user_data['lang'] );

                            $User = new OutsideUserC( $this->section, $user_data );

                            $this->_parsePageData( $User, '' );

                            $this->_output( $this->statuses_explanation[$User->status] . chr( 10 ) );

                            $record_data = array();

                            if( 1 == $list_item->IdSourceSystem || 2 == $list_item->IdSourceSystem )
                            {
                                $record_data['record_id'] = $list_item->Id;
                            }
                            else
                            {
                                $record_data['record_id'] = $list_item->ExternalId;
                            }

                            $this->_output( '>>> Record ID: ' . $record_data['record_id'] . ' - ' );

                            if( 1 == $list_item->IdSourceSystem )
                            {
                                $record_data['source'] = 'c';
                                $record_data['outside_owner_id'] = $list_item->IdCompanyProfile;
                            }
                            elseif( 2 == $list_item->IdSourceSystem )
                            {
                                $record_data['source'] = 'a';
                                $record_data['outside_owner_id'] = $list_item->ExternalFirmId;
                            }
                            elseif( 3 == $list_item->IdSourceSystem )
                            {
                                $record_data['source'] = 'l';
                                $record_data['outside_owner_id'] = $list_item->ExternalFirmId;
                            }

                            //$record_data['adddate'] = date( 'Y-m-d H:i:s', $this->_parseStamp( $list_item->ChangeDate ) );
                            $record_data['adddate'] = date( 'Y-m-d H:i:s', time() );
                            $record_data['date_add'] = $record_data['adddate'];
                            $record_data['datef'] =  date( 'Y-m-d', $this->_parseStamp( $list_item->DateFrom ) );
                            $record_data['datet'] =  date( 'Y-m-d', $this->_parseStamp( $list_item->DateTo ) );

                            $location_array = array();
                            $record_data['pathlen'] = 0;
                            $record_data['distance_prov'] = '';
                            $record_data['gmaps_path'] = 0;

                            foreach( array( 'f', 't' ) as $way )
                            {
                                $full_way = 'f' == $way ? 'from' : 'to';

                                $Point = $list_item->{'f' == $way ? 'FromPoint' : 'ToPoint'};

                                if( !empty( $Point ) )
                                {
                                    $record_data['country' . $way] = $this->_getCountryId( $Point->Country );

                                    $record_data['town' . $way] = $Point->CityName;

                                    if( !empty( $Point->Address ) )
                                    {
                                        $temp_name = explode( ',', $Point->Address );
                                        $temp_name = trim( $temp_name[0] );

                                        if( $temp_name != $record_data['town' . $way]
                                            && false !== strpos( $record_data['town' . $way], $temp_name ) )
                                        {
                                            $record_data['town' . $way] = $temp_name;
                                        }
                                    }

                                    $coordinates = $Point->Lat . ',' . $Point->Lon;

                                    $Location = @Location::getByParams( $record_data['town' . $way], null, $record_data['country' . $way], $coordinates );

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
                                        $record_data['reg' . $way] = $Location->region_id;
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

                            $record_data['vehicle_id'] = $this->_getVehicleId( $list_item->TruckDef );
                            $record_data['number'] = 1;
                            $record_data['weight'] = $list_item->{'freight' == $this->section ? 'Quantity' : 'MaxQuantity'};
                            $record_data['space'] = $list_item->{'freight' == $this->section ? 'Volume' : 'MaxVolume'};
                            $record_data['email'] = $User->email;

                            if( 'freight' == $this->section )
                            {
                                $record_data['freight'] = $list_item->CargoDef;
                            }

                            $record_data['adr'] = !empty( $list_item->ADR ) ? 1 : 0;
                            $record_data['tir'] = !empty( $list_item->TIR ) ? 1 : 0;
                            $record_data['add_load'] = !empty( $list_item->CanAddLoading ) ? 1 : 0;

                            if( !empty( $list_item->{'freight' == $this->section ? 'IsCargoOwner' : 'IsTruckOwner'} ) )
                            {
                                $record_data['forwarder'] = 0;
                            }
                            else
                            {
                                $record_data['forwarder'] = 1;
                            }

                            $load_types = array();

                            if( 'freight' == $this->section )
                            {
                                if( false !== strpos( $list_item->TruckDef, 'бок.-' ) )
                                {
                                    $loadtypes[] = 1;
                                }

                                if( false !== strpos( $list_item->TruckDef, 'верх.-' ) )
                                {
                                    $loadtypes[] = 4;
                                }

                                if( false !== strpos( $list_item->TruckDef, 'зад.-' ) )
                                {
                                    $loadtypes[] = 6;
                                }
                            }
                            else
                            {
                                if( !empty( $list_item->AllowSideLoad ) )
                                {
                                    $load_types[] = 1;
                                }

                                if( !empty( $list_item->AllowUpperLoad ) )
                                {
                                    $load_types[] = 4;
                                }

                                if( !empty( $list_item->AllowBackLoad ) )
                                {
                                    $load_types[] = 6;
                                }
                            }

                            $record_data['loadtype'] = implode( ',', $load_types );

                            if( !empty( $list_item->Price ) )
                            {
                                $record_data['price'] = $list_item->Price;

                                preg_match( '#^(RUB|UAH|BYR|KZT|USD|EUR)(/km)?()$#Us', $list_item->PriceDef, $price_data );

                                if( !empty( $price_data ) )
                                {
                                    switch( $price_data[1] )
                                    {
                                        case 'UAH':
                                            $record_data['currencyid'] = 1;
                                            break;
                                        case 'USD':
                                            $record_data['currencyid'] = 2;
                                            break;
                                        case 'EUR':
                                            $record_data['currencyid'] = 3;
                                            break;
                                        case 'RUB':
                                            $record_data['currencyid'] = 4;
                                            break;
                                        case 'BYR':
                                            $record_data['currencyid'] = 5;
                                            break;
                                        default :
                                            $record_data['currencyid'] = 0;
                                            break;
                                    }

                                    if( !empty( $price_data[2] ) )
                                    {
                                        $record_data['for'] = 1;
                                    }
                                    else
                                    {
                                        $record_data['for'] = 2;
                                    }
                                }
                            }

                            $record_data['category_id'] = '1';
                            $record_data['user'] = 'Y';
                            $record_data['owner_id'] = $User->id;
                            $record_data['group_id'] = $User->group_id;
                            $record_data['email_id'] = $User->email_id;
                            $record_data['actual_before'] = $record_data['datet'] . ' 23:59';

                            $Record = new OutsideRecordC( $this->section, $record_data );

                            $Record->save();

                            $this->_output( $this->statuses_explanation[$Record->status] . chr( 10 ) );

                            if( 'vehicle' == $this->section )
                            {
                                $cached_id = $User->cached_id;

                                if( !empty( $cached_id ) )
                                {
                                    $Eirg = new ExchangeInterestRecordGuest();

                                    $Eirg->add(
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
                }

                sleep( rand( 10, 20 ) );
            }
        }
    }

    protected function _getPageData( $page_url ){}

    protected function _parsePageData( OutsideUserAbstract $User, $page_url )
    {
        //sleep( rand( 5, 10 ) );

        $User->save();
    }

    protected function _getCountryId( $outside_country_id )
    {
        if( 'GB' == $outside_country_id )
        {
            $outside_country_id = 'UK';
        }

        $country_id = Db::i()->getValue( 'SELECT id FROM country WHERE domen = "' . $outside_country_id . '"' );

        if( !empty( $country_id ) )
        {
            return $country_id;
        }
        else
        {
            @Tools::report( 'No COUNTRY_ID for mark "' . $outside_country_id . '"', 'CargoGeo Import Error' );
            return 0;
        }
    }

    protected function _getRegionId( $outside_region_id ){}     // В даному парсері неможливо визначити регіон напряму

    protected function _getVehicleId( $outside_vehicle_id )
    {
        if( preg_match( '#^(.+)\s?(;|\(полупр\.\)|\(сцеп\.\)|\(грузов\.\))#Us', $outside_vehicle_id, $result ) )
        {
            $outside_vehicle_id = $result[1];
        }

        switch( $outside_vehicle_id )
        {
            case '(Откр)':
                return 3;
                break;
            case 'Трал':
                return 20;
                break;
            case 'П/Приц':
                return 41;
                break;
            case 'Манип': case 'Пан': case 'Стекл': case 'Бет': case 'ав.вы': case 'корм.': case 'щеп.': case 'Телеск': case 'Битум':
            return 36;
            break;
            case 'Борт':
                return 11;
                break;
            case '(Закр)':
                return 2;
                break;
            case 'Фург':
                return 6;
                break;
            case 'Тент':
                return 4;
                break;
            case 'Ц/Мет':
                return 6;
                break;
            case 'Зерн':
                return 12;
                break;
            case 'Бенз':
                return 32;
                break;
            case 'М/авто':
                return 18;
                break;
            case 'Автоб':
                return 8;
                break;
            case 'Труб':
                return 24;
                break;
            case 'Лес':
                return 16;
                break;
            case 'Авто':
                return 9;
                break;
            case 'Сед':
                return 44;
                break;
            case 'Самос':
                return 21;
                break;
            case 'Кран':
                return 10;
                break;
            case 'А/тран':
                return 9;
                break;
            case 'Цем':
                return 25;
                break;
            case 'Мук':
                return 40;
                break;
            case 'Скот': case 'конев.':
            return 22;
            break;
            case 'Эвак.':
                return 39;
                break;
            case 'Мол':
                return 29;
                break;
            case 'ГСМ/св': case 'ГСМ/т':
            return 27;
            break;
            case 'Паток':
                return 38;
                break;
            case 'Газ':
                return 33;
                break;
            case 'Ц.Пищ':
                return 29;
                break;
            case 'Реф': case 'туше-в':
            return 5;
            break;
            case 'Изот':
                return 7;
                break;
            case 'ДРУГОЙ':
                return 43;
                break;
            case 'К/Площ': case 'Конт':
            return 14;
            break;
            case 'От.Кон': case 'О/конт':
            return 13;
            break;
            case 'Негаб.':
                return 19;
                break;
            default:
                @Tools::report( 'No VEHICLE_ID for name "' . $outside_vehicle_id . '"', 'CargoGeo Import Error' );
                return 0;
                break;
        }
    }

    private function _parseStamp( $date_string )
    {
        return preg_match( '#/Date\((\d+)\d{3}\)/#Us', $date_string, $result ) ? $result[1] : time();
    }

    private function _getCountryByPhone( $phone )
    {
        if( !empty( $phone ) )
        {
            $phone = preg_replace( '#[^\d]#', '', $phone );

            $data = Db::i()->getAll( 'SELECT id, domen, phone_code FROM country WHERE phone_code IS NOT NULL' );

            for( $i = 0; $i < count( $data ); $i++ )
            {
                $code = preg_replace( '#[^\d]#', '', $data[$i]['phone_code'] );
                $position = strpos( $phone, $code );

                if( false !== $position && 0 == $position )
                {
                    return $data[$i];
                }
            }

            return false;
        }
        else
        {
            return false;
        }
    }

    private function _getContactPersonEmail( $company_id, $contact_person )
    {
        $email = Db::i()->getValue( 'SELECT email FROM ati_contacts WHERE company_id = ' . $company_id . ' AND agent = "' . $contact_person . '"' );

        return !empty( $email ) ? $email : '';
    }

    private function _getCompanyEmails( $company_id )
    {
        $emails = Db::i()->getCol( 'SELECT email FROM ati_contacts WHERE company_id = ' . $company_id );

        return !empty( $emails ) ? $emails : array();
    }

    public function __construct( $section )
    {
        $this->_getCookies( 'cargogeo.com', '' );

        parent::__construct( 'c', $section );
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}