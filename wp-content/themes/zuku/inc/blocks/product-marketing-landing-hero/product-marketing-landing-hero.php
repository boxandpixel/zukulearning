<?php
$product_marketing_landing_hero = get_field('product_marketing_landing_hero');
$logo = $product_marketing_landing_hero['logo'];
$headline = $product_marketing_landing_hero['headline'];
$description = $product_marketing_landing_hero['description'];
$list_items = $product_marketing_landing_hero['list_items'];
$image = $product_marketing_landing_hero['image'];
$overlay = $product_marketing_landing_hero['overlay'];
$overlay_heading = $overlay['heading'];
$overlay_list_items = $overlay['list_items'];
$product_category = $product_marketing_landing_hero['product_category'];
?>

<section class="product-marketing-landing-hero product-marketing-landing-hero--<?= $product_category; ?>">
    <div class="container">
        <div class="product-marketing-landing-hero__image-overlay">
            <div class="image-overlay-inner">
                <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_url($image['alt']); ?>">
                <div class="product-marketing-landing-hero__overlay">
                    <h6 class="product-marketing-landing-hero__overlay-heading overlay-heading"><?= $overlay_heading; ?></h6>
                    <?php if($overlay_list_items): ?>
                        <ul class="product-marketing-landing-hero__overlay-list">
                            <?php foreach($overlay_list_items as $item): ?>
                            <li class="overlay-list-items"><?= $item['list_item']; ?></li>
                            <?php endforeach; ?>    
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <div class="product-marketing-landing-hero__details">
            <div class="product-marketing-landing-hero__logo">
                <img src="<?= esc_url($logo['url']); ?>" alt="<?= esc_url($logo['alt']); ?>">
            </div>
            <div class="product-marketing-landing-hero__headline">
                <h1><?= $headline; ?></h1>
            </div>
            <div class="product-marketing-landing-hero__description">
                <?= $description; ?>
            </div>
            <?php if($list_items): ?>
                <ul class="product-marketing-landing-hero__list">
                    <?php foreach($list_items as $item): ?>
                    <li><?= $item['list_item']; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</section>
