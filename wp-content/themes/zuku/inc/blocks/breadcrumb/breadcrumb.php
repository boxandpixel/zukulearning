<?php
$breadcrumb = get_field('breadcrumb');
$link = $breadcrumb['link'];
$link_target = $link['target'] ? $link['target'] : '_self';
?>

<section class="breadcrumb">
    <div class="container">
        <div class="breadcrumb__link">
            <a href="<?= esc_url($link['url']); ?>" class="" target="<?= $link_target; ?>"><?= esc_html($link['title']); ?></a>
        </div>
    </div>
</section>
