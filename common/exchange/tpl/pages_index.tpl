<style>
    h4
    {
        font-size: 1em;
        margin: 1em 0 0;
    }

    .description
    {
        margin: 1.5em 0;
    }

    .letter_filter
    {
        padding: 0.5em;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }

    .letter_filter a, .letter_filter strong
    {
        padding: 0 0.3em;
    }

    .service_list
    {
        padding: 0 1em 1em;
    }

    .service_list ul
    {
        padding-left: 2em;
        margin: 0.3em 0;
    }
</style>
<h1><?php echo l('our_services', 'el'); ?></h1>
<div>
    <p class="description">
        <?php echo l('services_description', 'el'); ?>
    </p>
    <div class="letter_filter">
        <span><?php echo l('letter_filter', 'el'); ?></span>
        <?php foreach ($aLetters as $sLetter): ?>
        <?php if ($sCurrentLetter == $sLetter): ?>
        <strong><?php echo $sLetter; ?></strong>
        <?php else: ?>
        <a href="?letter=<?php echo $sLetter; ?>"><?php echo $sLetter; ?></a>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php if ($sCurrentLetter == 'other'): ?>
        <strong><?php echo l('other_towns', 'el'); ?></strong>
        <?php else: ?>
        <a href="?letter=other"><?php echo l('other_towns', 'el'); ?></a>
        <?php endif; ?>
    </div>
    <div class="service_list">
        <?php foreach ($aTowns as $aTown): ?>
        <?php if ($sCurrentLetter == 'other'): ?>
        <h4><?php echo l('all_towns', 'el'); ?></h4>
        <?php else: ?>
        <h4><?php echo $aTown['name']; ?></h4>
        <?php endif; ?>
        <ul>
            <?php foreach ($aTown['pages'] as $aPage): ?>
            <li>
                <a href="/service/<?php echo $aPage['url']; ?>/"><?php echo $aPage['title']; ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endforeach; ?>
    </div>
</div>