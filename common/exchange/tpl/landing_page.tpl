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

    .add_shipment_button
    {
        margin: 0.1em 0 0.4em 0;
    }
</style>
<h1><?php echo $aPage['title']; ?></h1>
<div>
    <p>
        <?php echo $aPage['text']; ?>
    </p>
    <h3><?php echo l('what_to_do', 'el'); ?></h3>
    <ol>
        <li><?php echo l('step1', 'el'); ?> <a class="add_shipment_button button" href="/loads/add.php?autocomplete=1&p=577003&item_id=<?php echo $aPage['page_id']; ?>&category_id=<?php echo $aPage['category_id']; ?>" target="_blank"><?php echo l('go_to_adding', 'el'); ?></a></li>
        <li><?php echo l('step2', 'el'); ?></li>
        <li><?php echo l('step3', 'el'); ?></li>
    </ol>
    <p>
        <?php echo l('about_support_service', 'el'); ?>
    </p>
    <h3><?php echo l('useful_pages', 'el'); ?></h3>
    <ul>
        <li>
            <a href="/loads/add.php" target="_blank"><?php echo l('add_cargo', 'el'); ?></a>
        </li>
        <li>
            <a href="/vehicles/" target="_blank"><?php echo l('vehicles_search', 'el'); ?></a>
        </li>
        <li>
            <a href="/loads/" target="_blank"><?php echo l('loads_search', 'el'); ?></a>
        </li>
        <li>
            <a href="/main/" target="_blank"><?php echo l('main_page', 'el'); ?></a>
        </li>
    </ul>
    <h3><?php echo l('cargo_example', 'el'); ?></h3>
    <ul>
        <?php foreach($aPage['similar_cargo'] as $aCargo): ?>
        <li>
            <a href="/loads/<?php echo $aCargo['id']; ?>" target="_blank"><?php echo $aCargo['freight']; ?></a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php if(!empty($aPage['other_service'])): ?>
    <h3><?php echo l('other_services', 'el'); ?></h3>
    <ul>
        <?php foreach($aPage['other_service'] as $aService): ?>
        <li>
            <a href="/service/<?php echo $aService['url']; ?>/" target="_blank"><?php echo $aService['title']; ?></a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
<br />
<div class="share42init" data-url="<?php echo constant('HTTP_ADDRESS'); ?>" data-title="<?php echo $aPage['title']; ?>" data-description="<?php echo $aPage['text']; ?>" data-path="/Lib/share42/"></div>
<script type="text/javascript" src="/Lib/share42/share42.js"></script>