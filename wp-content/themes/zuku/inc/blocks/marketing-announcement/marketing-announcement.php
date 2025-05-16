<?php
$marketing_announcement = get_field('marketing_announcement');
$heading = $marketing_announcement['heading'];
$description = $marketing_announcement['description'];
$link = $marketing_announcement['link'];
$link_target = $link['target'] ? $link['target'] : '_self';
?>

<section class="marketing-announcement">
    <div class="container">
        <div class="marketing-announcement__text-content">
            <h4><?= $heading; ?></h4>
            <?= $description; ?>
        </div>
        <div class="marketing-announcement__link">
            <a href="" class="button button--primary" target="<?= $link_target; ?>"><?= $link['title']; ?></a>
        </div>
    </div>
</section>
