<?php
/*
location /service/ {
    rewrite ^/service/([-_a-z0-9]*)[/]?$  /service/index.php?page_url=$1;
}
*/
    require(dirname(dirname(__FILE__)) . '/system/init.php');

    loadlang('el', PHP_ROOT . '/common/exchange/lang/');

    if (!empty($_GET['page_url']))
    {
        $aPage = Db::i()->getRow(
            'SELECT lp.*, kw.word, kw.category_id, t.name_' . LANG . ' AS town_name '
            . 'FROM landing_pages AS lp '
            . 'LEFT OUTER JOIN key_words AS kw ON lp.word_id = kw.word_id '
            . 'LEFT OUTER JOIN towns AS t ON t.id = lp.town_id '
            . 'WHERE lp.url = \'' . Db::i()->escape($_GET['page_url']) . '\' AND lp.lang = \'' . LANG . '\''
        );

        if (empty($aPage))
        {
            $aPage = Db::i()->getRow(
                'SELECT * FROM landing_pages WHERE url = \'' . Db::i()->escape($_GET['page_url']) . '\' AND lang != \'' . LANG . '\''
            );

            if (!empty($aPage))
            {
                $aRightPage = Db::i()->getRow(
                    'SELECT url FROM landing_pages WHERE word_id = ' . $aPage['word_id'] . ' AND town_id = ' . $aPage['town_id'] . ' AND lang = \'' . LANG . '\''
                );

                if (!empty($aRightPage))
                {
                    header('Location: /' . LANG . '/service/' . $aRightPage['url'] . '/', true, 301);
                    exit;
                }
                else
                {
                    header( 'HTTP/1.0 404 Not Found' );

                    include('../main/404.php');
                }
            }
        }

        if (!empty($aPage))
        {
            Db::i()->insert('landing_pages_stats', array(
                'page_id' => $aPage['page_id'],
                'ip' => (string) Tools::ip(),
                'referer' => (!empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''),
                'user_agent' => (!empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ''),
                'date' => Db::i()->now()
            ));

            $aPage['similar_cargo'] = Db::i()->getAll(
                'SELECT * FROM freight WHERE category_id = ' . (int) $aPage['category_id'] . ' ORDER BY adddate DESC LIMIT 5',
                true
            );

            $aPage['other_service'] = Db::i()->getAll(
                'SELECT url, title FROM landing_pages WHERE town_id = ' . (int) $aPage['town_id'] . ' AND word_id != ' . (int) $aPage['word_id'] . ' AND lang = \'' . $aPage['lang'] . '\' ORDER BY title',
                true
            );

            $aPageLocalizations = Db::i()->getAll('SELECT lang, url FROM landing_pages WHERE word_id = ' . (int) $aPage['word_id'] . ' AND town_id = ' . (int) $aPage['town_id']);
            $aLangAlternate = array();

            foreach($aPageLocalizations as $aPageLocalization)
            {
                $aLangAlternate[$aPageLocalization['lang']] = '/service/' . $aPageLocalization['url'] . '/';
            }

            PageSettings::setLangAlternate($aLangAlternate);
            PageSettings::setMeta(array(
                'description' => $aPage['meta_description'],
                'keywords' => $aPage['meta_keywords'],
                'revisit-after' => '1 week',
            ));

            $page_settings['width'] = '40em';
            $title = $aPage['title'];

            include(PHP_ROOT . '/interface/indext.php');

            echo parseTemplate(PHP_ROOT . '/common/exchange/tpl/landing_page.tpl', array(
                        'aPage' => $aPage
                    ));

            include(PHP_ROOT . '/interface/indexd.php');
        }
        else
        {
            header( 'HTTP/1.0 404 Not Found' );

            include('../main/404.php');
        }
    }
    else
    {
        $aLetters = Db::i()->getCol(
            'SELECT DISTINCT UPPER(SUBSTR(name_' . LANG . ', 1, 1)) AS letter FROM towns HAVING letter RLIKE "[A-ZА-Я]" ORDER BY letter;'
        );

        if (!isset($_GET['letter']) || ($_GET['letter'] != 'other' && !in_array($_GET['letter'], $aLetters)))
        {
            header('Location: ?letter=' . $aLetters[0], true, 301);
            exit;
        }

        if ($_GET['letter'] == 'other')
        {
            $aTowns = array(
                array('id' => 0, 'name' => '')
            );
        }
        else
        {
            $aTowns = Db::i()->getAll(
                'SELECT id, name_' . LANG . ' AS name FROM towns WHERE name_' . LANG . ' LIKE \'' . $_GET['letter'] . '%\' ORDER BY name',
                true
            );
        }

        foreach ($aTowns as $iIndex => $aTown)
        {
            $aTowns[$iIndex]['pages'] = Db::i()->getAll(
                'SELECT url, title FROM landing_pages WHERE town_id = ' . $aTown['id'] . ' AND lang = \'' . LANG . '\' ORDER BY title',
                true
            );

            if (empty($aTowns[$iIndex]['pages']))
            {
                unset($aTowns[$iIndex]);
            }
        }

        include(PHP_ROOT . '/interface/indext.php');

        echo parseTemplate(PHP_ROOT . '/common/exchange/tpl/pages_index.tpl', array(
            'aLetters' => $aLetters,
            'sCurrentLetter' => $_GET['letter'],
            'aTowns' => $aTowns
        ));

        include(PHP_ROOT . '/interface/indexd.php');
    }