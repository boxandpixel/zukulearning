<?php
// $promo = get_field('promo');
$promo = $args['promo'] ?? get_field('promo');
$heading = $promo['heading'];
$description = $promo['description'];
$link = $promo['link'];
$link_target = $link['target'] ? $link['target'] : '_self';
$background_color = $promo['background_color'];
$image = $promo['image'];
?>

<section class="promo">
    <div class="container">
        <div class="promo__text-content promo__text-content--<?= $background_color; ?>">
            <div class="promo__heading">
                <h2><?= $heading; ?></h2>
            </div>
            
            <div class="promo__details">

                <?= $description; ?>
                <a href="" class="button button--primary-fill" target="<?= $link_target; ?>"><?= $link['title']; ?></a>
            </div>
        </div>
        <div class="promo__image" style="background-image: url(<?= esc_html($image['url']) ?>">
        </div>
    </div>
</section>
