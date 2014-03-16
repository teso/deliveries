<?php
    require(dirname(dirname(__FILE__)) . '/system/init.php');

    $page_settings['width'] = '40em';
    $title = 'Ключова фраза, г. Киев';

    include(PHP_ROOT . '/interface/indext.php');
?>
    <style>
        h3
        {
            font-size: 1.1em;
            margin-bottom: 0;
        }

        ul
        {
            margin: 0.5em 0 1em;
        }
    </style>
    <h1><span style="font-style:italic; border: 1px dashed red;">Ключова фраза</span>, г. Киев</h1>
    <div>
        <div style="font-style:italic; border: 1px dashed red; padding: 0.5em 1em;">
            Вступний рекламний <strong>текст</strong>, з вкрапленням ключової фрази. НЕ КОПІЮВАТИ з інтернету, пишем самі. Можна черпати надхнення там, але текст писати своїми словами, щоб він був унікальний. І не треба писати занадто довгих статей, щоб не відпугнути клієнта.
            <p style="margin:0.2em 0;">Приклад:</p>
            <div>
                Вам нужно перевезти холодильник? Тогда вы обратились по адресу. Только у нас вы быстро найдете себе перевозчика и существенно сэкономите на перевозке...
            </div>
        </div>
        <h3>Как перевезти свой груз? Все очень просто:</h3>
        <ol>
            <li>Вы добавляете свой запрос на перевозку: что нужно перевезти, откуда и куда. <a href="#" target="_blank">Перейти к добавлению</a></li>
            <li>Перевозчики предлагают вам цену, за которую готовы ехать. Мы оповещаем вас о новых предложениях по E-mail или SMS</li>
            <li>Вы выбираете конкретного перевозчика, принимаете его предложение и вам открываются его контакты. Остается только договорится о деталях.</li>
        </ol>
        <p>
            Если у вас возникнут дополнительные вопросы, обращайтесь в нашу Службу поддержки по телефону +380 97 8133895
        </p>
        <h3>Полезные страницы</h3>
        <ul>
            <li>
                <a href="/loads/add.php" target="_blank">Добавить собственный запрос на перевозку</a>
            </li>
            <li>
                <a href="/vehicles/" target="_blank">Попробовать найти перевозчика самостоятельно</a>
            </li>
            <li>
                <a href="/loads/" target="_blank">Посмотреть на уже размещенные запросы</a>
            </li>
            <li>
                <a href="/main/" target="_blank">На главную</a>
            </li>
        </ul>
        <h3>Примеры похожих грузов:</h3>
        <ul>
            <li>
                <a href="#" target="_blank">Груз</a>
            </li>
            <li>
                <a href="#" target="_blank">Груз</a>
            </li>
            <li>
                <a href="#" target="_blank">Груз</a>
            </li>
            <li>
                <a href="#" target="_blank">Груз</a>
            </li>
            <li>
                <a href="#" target="_blank">Груз</a>
            </li>
        </ul>
        <h3>Другие услуги в этом городе</h3>
        <ul>
            <li>
                <a href="#" target="_blank">Другой сервис</a>
            </li>
            <li>
                <a href="#" target="_blank">Другой сервис</a>
            </li>
            <li>
                <a href="#" target="_blank">Другой сервис</a>
            </li>
            <li>
                <a href="#" target="_blank">Другой сервис</a>
            </li>
            <li>
                <a href="#" target="_blank">Другой сервис</a>
            </li>
        </ul>
    </div>
<?php
    include(PHP_ROOT . '/interface/indexd.php');