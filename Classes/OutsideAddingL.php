<?php
class OutsideAddingL extends OutsideAddingAbstract
{
    private
        $login = 'alexsey1',
        $password = '0971021064',
        $file = 'sig.txt',
        $sig = '',
        $uid = '';

    private function getCountryId($our_country_id)
    {
        switch ($our_country_id)
        {
            case 1:
                return 1;	// Украина
                break;
            case 39:
                return 8;	// Азербайджан
                break;
            case 2:
                return 2;	// Россия
                break;
            case 3:
                return 6;	// Беларусь
                break;
            case 14:
                return 66;	// Грузия
                break;
            case 4:
                return 7;	// Австрия
                break;
            case 5:
                return 9;	// Албания
                break;
            case 40:
                return 10;	// Армения
                break;
            case 41:
                return 54;	// Афганистан
                break;
            case 6:
                return 11;	// Бельгия
                break;
            case 7:
                return 12;	// Болгария
                break;
            case 8:
                return 13;	// Босния и Герцеговина
                break;
            case 9:
                return 14;	// Великобритания
                break;
            case 10:
                return 15;	// Венгрия
                break;
            case 11:
                return 16;	// Германия
                break;
            case 12:
                return 17;	// Голландия
                break;
            case 13:
                return 18;	// Греция
                break;
            case 14:
                return 19;	// Грузия
                break;
            case 15:
                return 20;	// Дания
                break;
            case 51:
                return 21;	// Израиль
                break;
            case 54:
                return 60;	// Индия
                break;
            case 42:
                return 63;	// Ирак
                break;
            case 43:
                return 22;	// Иран
                break;
            case 16:
                return 23;	// Ирландия
                break;
            case 17:
                return 24;	// Испания
                break;
            case 18:
                return 25;	// Италия
                break;
            case 44:
                return 26;	// Казахстан
                break;
            case 45:
                return 27;	// Китай
                break;
            case 55:
                return 28;	// Кыргызстан
                break;
            case 19:
                return 29;	// Латвия
                break;
            case 56:
                return 61;	// Ливан
                break;
            case 20:
                return 30;	// Литва
                break;
            case 21:
                return 31;	// Люксембург
                break;
            case 57:
                return 32;	// Македония
                break;
            case 58:
                return 33;	// Марокко
                break;
            case 22:
                return 34;	// Молдова
                break;
            case 52:
                return 58;	// Монголия
                break;
            case 23:
                return 35;	// Норвегия
                break;
            case 24:
                return 36;	// Польша
                break;
            case 25:
                return 37;	// Португалия
                break;
            case 26:
                return 38;	// Румыния
                break;
            case 27:
                return 57;	// Сербия
                break;
            case 59:
                return 55;	// Сирия
                break;
            case 28:
                return 39;	// Словакия
                break;
            case 29:
                return 40;	// Словения
                break;
            case 49:
                return 59;	// США
                break;
            case 46:
                return 42;	// Таджикистан
                break;
            case 47:
                return 43;	// Туркменистан
                break;
            case 30:
                return 44;	// Турция
                break;
            case 53:
                return 45;	// Узбекистан
                break;
            case 31:
                return 46;	// Финляндия
                break;
            case 32:
                return 47;	// Франция
                break;
            case 33:
                return 48;	// Хорватия
                break;
            case 34:
                return 64;	// Черногория
                break;
            case 35:
                return 49;	// Чехия
                break;
            case 36:
                return 50;	// Швейцария
                break;
            case 37:
                return 51;	// Швеция
                break;
            case 38:
                return 52;	// Эстония
                break;
            default:
                Tools::report( 'No COUNTRY_ID for our ID "' . $our_country_id . '"', 'Lardi Export Error' );
                return 0;
                break;
        }
    }

    private function getRegionId($our_region_id)
    {
        switch ($our_region_id)
        {
            // Украина
            case 1:
                return 15;	// Винницкая область
                break;
            case 2:
                return 16;	// Волынская область
                break;
            case 3:
                return 17;	// Днепропетровская область
                break;
            case 4:
                return 18;	// Донецкая область
                break;
            case 5:
                return 19;	// Житомирская область
                break;
            case 6:
                return 20;	// Закарпатская область
                break;
            case 7:
                return 21;	// Запорожская область
                break;
            case 8:
                return 22;	// Ив.Франк. обл.
                break;
            case 9:
                return 23;	// Киевская область
                break;
            case 10:
                return 24;	// Кировоградская область
                break;
            case 25:
                return 25;	// Крым, Автономная Республика
                break;
            case 11:
                return 26;	// Луганская область
                break;
            case 12:
                return 27;	// Львовская область
                break;
            case 13:
                return 28;	// Николаевская область
                break;
            case 14:
                return 29;	// Одесская область
                break;
            case 15:
                return 30;	// Полтавская область
                break;
            case 16:
                return 31;	// Ровенская область
                break;
            case 17:
                return 32;	// Сумская область
                break;
            case 18:
                return 33;	// Тернопольская область
                break;
            case 19:
                return 34;	// Харьковская область
                break;
            case 20:
                return 35;	// Херсонская область
                break;
            case 21:
                return 36;	// Хмельницкая область
                break;
            case 22:
                return 37;	// Черкасская область
                break;
            case 23:
                return 38;	// Черниговская область
                break;
            case 24:
                return 39;	// Черновицкая область
                break;
            // Россия
            case 672:
                return 40;	// Агинский Бурят. окр.
                break;
            case 694:
                return 41;	// Адыгея
                break;
            case 673:
                return 42;	// Алтайский край
                break;
            case 673:
                return 43;	// Алтайский край
                break;
            case 26:
                return 44;	// Амурская область
                break;
            case 27:
                return 45;	// Архангельская область
                break;
            case 28:
                return 46;	// Астраханская область
                break;
            case 692:
                return 47;	// Башкортостан
                break;
            case 657:
                return 48;	// Белгородская область
                break;
            case 29:
                return 49;	// Брянская область
                break;
            case 691:
                return 50;	// Бурятия
                break;
            case 30:
                return 51;	// Владимирская область
                break;
            case 31:
                return 52;	// Волгоградская область
                break;
            case 32:
                return 53;	// Вологодская область
                break;
            case 658:
                return 54;	// Воронежская область
                break;
            case 690:
                return 55;	// Дагестан
                break;
            case 661:
                return 56;	// Еврейская автономная область
                break;
            case 33:
                return 57;	// Ивановская область
                break;
            case 689:
                return 58;	// Ингушская Р.
                break;
            case 34:
                return 59;	// Иркутская область
                break;
            case 688:
                return 60;	// Кабардино-Балкарская республика
                break;
            case 35:
                return 61;	// Калининградская область
                break;
            case 687:
                return 62;	// Калмыкия
                break;
            case 36:
                return 63;	// Калужская область
                break;
            case 37:
                return 64;	// Камчатская область
                break;
            case 686:
                return 65;	// Карачаево-Черкесия
                break;
            case 685:
                return 66;	// Карелия
                break;
            case 38:
                return 67;	// Кемеровская область
                break;
            case 39:
                return 68;	// Кировская область
                break;
            case 684:
                return 69;	// Коми
                break;
            case 660:
                return 70;	// Коми-Пермяцкий окр.
                break;
            case 671:
                return 71;	// Корякский окр.
                break;
            case 40:
                return 72;	// Костромская область
                break;
            case 670:
                return 73;	// Краснодарский край
                break;
            case 669:
                return 74;	// Красноярский край
                break;
            case 41:
                return 75;	// Курганская область
                break;
            case 656:
                return 76;	// Курская область
                break;
            case 42:
                return 77;	// Ленинградская область
                break;
            case 659:
                return 78;	// Липецкая область
                break;
            case 43:
                return 79;	// Магаданская область
                break;
            case 683:
                return 80;	// Марий Эл
                break;
            case 682:
                return 81;	// Мордовия
                break;
            case 44:
                return 82;	// Московская область
                break;
            case 45:
                return 83;	// Мурманская область
                break;
            case 662:
                return 84;	// Ямало-Ненецкий автономный округ
                break;
            case 46:
                return 85;	// Нижегородская область
                break;
            case 47:
                return 86;	// Новгородская область
                break;
            case 48:
                return 87;	// Новосибирская область
                break;
            case 40:
                return 88;	// Костромская область
                break;
            case 50:
                return 89;	// Оренбургская область
                break;
            case 51:
                return 90;	// Орловская область
                break;
            case 52:
                return 91;	// Пензенская область
                break;
            case 660:
                return 92;	// Пермская обл.
                break;
            case 668:
                return 93;	// Приморский край
                break;
            case 53:
                return 94;	// Псковская область
                break;
            case 54:
                return 95;	// Ростовская область
                break;
            case 790:
                return 96;	// Рязанская область
                break;
            case 55:
                return 97;	// Самарская область
                break;
            case 56:
                return 98;	// Саратовская область
                break;
            case 57:
                return 99;	// Сахалинская область
                break;
            case 57:
                return 100;	// Сахалинская область
                break;
            case 58:
                return 101;	// Свердловская область
                break;
            case 133:
                return 102;	// Северная Ютландия
                break;
            case 789:
                return 103;	// Смоленская область
                break;
            case 667:
                return 104;	// Ставропольский край
                break;
            case 669:
                return 105;	// Таймырский окр.
                break;
            case 788:
                return 106;	// Тамбовская область
                break;
            case 679:
                return 107;	// Татарстан
                break;
            case 59:
                return 108;	// Тверская область
                break;
            case 60:
                return 109;	// Томская область
                break;
            case 678:
                return 110;	// Тува Р.
                break;
            case 787:
                return 111;	// Тульская область
                break;
            case 61:
                return 112;	// Тюменская область
                break;
            case 677:
                return 113;	// Удмуртская Р.
                break;
            case 62:
                return 114;	// Ульяновская область
                break;
            case 34:
                return 115;	// Усть-Ордын. Бурят. окр
                break;
            case 666:
                return 116;	// Хабаровский край
                break;
            case 676:
                return 117;	// Хакасия
                break;
            case 664:
                return 118;	// Ханты-Мансийский автономный округ
                break;
            case 63:
                return 119;	// Челябинская область
                break;
            case 675:
                return 120;	// Чеченская республика
                break;
            case 64:
                return 121;	// Читинская область
                break;
            case 674:
                return 122;	// Чувашская республика
                break;
            case 663:
                return 123;	// Чукотский автономный округ
                break;
            case 669:
                return 124;	// Эвенкийский окр.
                break;
            case 662:
                return 125;	// Ямало-Ненецкий автономный округ
                break;
            case 65:
                return 126;	// Ярославская область
                break;
            // Беларусь
            case 66:
                return 127;	// Брестская область
                break;
            case 67:
                return 128;	// Витебская область
                break;
            case 68:
                return 129;	// Гомельская область
                break;
            case 69:
                return 130;	// Гродненская область
                break;
            case 70:
                return 131;	// Минская область
                break;
            case 71:
                return 132;	// Могилевская область
                break;
            // Казахстан
            case 72:
                return 133;	// Акмолинская область
                break;
            case 73:
                return 134;	// Актюбинская область
                break;
            case 74:
                return 135;	// Алматинская область
                break;
            case 75:
                return 136;	// Атырауская область
                break;
            case 76:
                return 137;	// Восточно-Казахстанская область
                break;
            case 77:
                return 138;	// Джамбульская обл.
                break;
            case 78:
                return 139;	// Западно-Казахстанска область
                break;
            case 79:
                return 140;	// Карагандинская область
                break;
            case 81:
                return 142;	// Кустанайская обл.
                break;
            case 80:
                return 141;	// Кызыл-Ординская обл.
                break;
            case 82:
                return 143;	// Мангистауская область
                break;
            case 83:
                return 144;	// Павлодарская область
                break;
            case 84:
                return 145;	// Северо-Казахстанская область
                break;
            case 85:
                return 146;	// Южно-Казахстанская область
                break;
            default:
                //Tools::report( 'No REGION_ID for our ID "' . $our_region_id . '"', 'Lardi Export Error' );
                return 0;
                break;
        }
    }

    private function getVehicleId($our_vehicle_id)
    {
        switch ($our_vehicle_id)
        {
            case 4:
                return 34;	// тент
                break;
            case 7:
                return 25;	// изотерм
                break;
            case 2:
                return 29;	// крытая
                break;
            case 5:
                return 32;	// реф.
                break;
            case 6:
                return 36;	// цельномет.
                break;
            case 9:
                return 20;	// автовоз
                break;
            case 8:
                return 21;	// автобус
                break;
            case 32:
                return 22;	// бензовоз
                break;
            case 18:
                return 23;	// бус
                break;
            case 33:
                return 24;	// газовоз
                break;
            case 12:
                return 26;	// зерновоз
                break;
            case 13:
                return 27;	// контейнер
                break;
            case 14:
                return 28;	// контейнеровоз
                break;
            case 16:
                return 42;	// лесовоз
                break;
            case 17:
                return 45;	// мебелевоз
                break;
            case 40:
                return 44;	// муковоз
                break;
            case 19:
                return 30;	// негабарит
                break;
            case 3:
                return 31;	// открытая
                break;
            case 21:
                return 33;	// самосвал
                break;
            case 22:
                return 48;	// скотовоз
                break;
            case 36:
                return 41;	// спецтехника
                break;
            case 37:
                return 47;	// трал
                break;
            case 24:
                return 35;	// трубовоз
                break;
            case 38:
                return 37;	// цистерна
                break;
            case 39:
                return 46;	// эвакуатор
                break;
            case 0:
                return 38;	// любая
                break;
            default:
                Tools::report( 'No VEHICLE_ID for our ID "' . $our_vehicle_id . '"', 'Lardi Export Error' );
                return 0;
                break;
        }
    }

    private function getPayformId($our_payform_id)
    {
        switch ($our_payform_id)
        {
            case 11:
                return 141;	// нал.
                break;
            case 1:
                return 142;	// нал. на загр.
                break;
            case 2:
                return 143;	// нал. на выгр.
                break;
            case 3:
                return 154;	// перевод по оригиналам
                break;
            case 4:
                return 155;	// перевод по загрузке
                break;
            case 5:
                return 156;	// перевод по выгрузке
                break;
            case 6:
                return 144;	// б/н
                break;
            case 8:
                return 145;	// б/н с НДС
                break;
            case 7:
                return 152;	// ед. налог
                break;
            default:
                //Tools::report( 'No PAYFORM_ID for our ID "' . $our_payform_id . '"', 'Lardi Export Error' );
                return 0;
                break;
        }
    }

    private function getCurrencyId($our_currency_id, $our_for_mark)
    {
        switch ($our_currency_id)
        {
            case 1:
                return 1 == $our_for_mark ? 5 : 1; // гривна
                break;
            case 4:
                return 1 == $our_for_mark ? 6 : 4;	// русские рубли
                break;
            case 5:
                return 1 == $our_for_mark ? 6 : 9;	// белорусский рубль
                break;
            case 2:
                return 1 == $our_for_mark ? 8 : 2;	// доллар
                break;
            case 3:
                return 1 == $our_for_mark ? 7 : 3;	// евро
                break;
            default:
                //Tools::report( 'No CURRENCY_ID for our ID "' . $our_currency_id . '"', 'Lardi Export Error' );
                return 0;
                break;
        }
    }

    private function getLoadTypes($our_load_types)
    {
        $our_load_types = explode(',', $our_load_types);

        $load_types = array();

        foreach ($our_load_types as $load_type)
        {
            switch ($load_type)
            {
                case 1:
                    $load_types[] = 'side'; // боковая
                    break;
                case 4:
                    $load_types[] = 'top'; // верхняя
                    break;
                case 6:
                    $load_types[] = 'back'; // задняя
                    break;
                default:
                    break;
            }
        }

        return implode(',', $load_types);
    }

    private function getDate($our_date)
    {
        $temp = explode('-', $our_date);

        return $temp[2] . '.' . $temp[1] . '.' . $temp[0];
    }

    private function authorize()
    {
        $data = array(
            'method' => 'auth',
            'login' => $this->login,
            'password' => md5( $this->password )
        );

        $result = $this->connector->read( $data );
        $resultXML = new SimpleXMLElement( $result );

        if (!empty($resultXML->sig))
        {
            $this->sig = (string) $resultXML->sig;
            $this->uid = (string) $resultXML->uid;

            return true;
        }
        else
        {
            return false;
        }
    }

    private function checkAuthorize()
    {
        $data = array(
            'method' => 'test.sig',
            'sig' => $this->sig
        );

        $result = $this->connector->read( $data );
        $resultXML = new SimpleXMLElement( $result );

        if ('ok' == $resultXML->status)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function add( $data )
    {
        $export_data = array();
        $export_data['method'] = 'my.gruz.add';
        $export_data['sig'] = $this->sig;
        $export_data['country_from_id'] = $this->getCountryId($data['countryf']);
        $export_data['country_to_id'] = $this->getCountryId($data['countryt']);
        $export_data['area_from_id'] = $this->getRegionId($data['regf']);
        $export_data['area_to_id'] = $this->getRegionId($data['regt']);
        $export_data['city_from'] = $data['townf'];
        $export_data['city_to'] = $data['townt'];
        $export_data['date_from'] = $this->getDate($data['datef']);
        $export_data['date_to'] = $this->getDate($data['datet']);
        $export_data['gruz'] = $data['freight'];
        $export_data['tir'] = 'Y' == $data['tir'] ? 'true' : 'false';
        $export_data['stavka'] = $data['price'];
        $export_data['truck_id'] = $this->getVehicleId($data['vehicle_id']);
        $export_data['mass'] = $data['weight'];
        $export_data['value'] = $data['space'];
        $export_data['forma_id'] = $this->getPayFormId($data['pay_form']);
        $export_data['valuta_id'] = $this->getCurrencyId($data['currencyid'], $data['for']);
        $export_data['zagruz_set'] = $this->getLoadTypes($data['loadtype']);
        $export_data['auto_col'] = $data['number'];
        $export_data['user_contact'] = '0';
        $export_data['gab_dl'] = $data['length'];
        $export_data['gab_sh'] = $data['width'];
        $export_data['gab_v'] = $data['height'];
        $export_data['add_info'] = $data['info'];

        $result = $this->connector->read( $export_data );
        $resultXML = new SimpleXMLElement( $result );

        if (!empty( $resultXML->id ))
        {
            return (string) $resultXML->id;
        }
        else
        {
            throw new Exception(trim(strip_tags($result)));
        }
    }

    public function __construct( OutsideConnectorInterface $connector )
    {
        parent::__construct( $connector );

        $this->connector->setUrl( 'http://api.lardi-trans.com/api/' );

        $this->sig = file_get_contents( PHP_ROOT . '/common/exchange/' . $this->file );

        if (empty( $this->sig ) || !$this->checkAuthorize())
        {
            $this->authorize();
        }

        if (empty( $this->sig ))
        {
            throw new Exception('No SIG');
        }
    }

    public function __destruct()
    {
        parent::__destruct();

        file_put_contents( PHP_ROOT . '/common/exchange/' . $this->file, $this->sig );
    }
}