<?php
$homepage_hero = get_field('homepage_hero');
$headline = $homepage_hero['headline'];
$subheadline = $homepage_hero['subheadline'];
$products = $homepage_hero['products'];
?>

<section class="homepage-hero">
    <div class="homepage-hero__text-content">
        <h1 class="hero-headline"><?= esc_html($headline); ?></h1>
        <?= $subheadline; ?>
    </div>
    <div class="homepage-hero__products">
        <?php foreach($products as $product): 
            $logo = $product['logo'];
            $description = $product['description'];
            $image = $product['image'];
            $category = $product['category'];
        ?>
        <a href="" class="homepage-hero-products__product homepage-hero-products__product--<?= $category ?>">
            <div class="homepage-hero-products__product-image"></div>
            <div class="homepage-hero-products__product-container" style="--bg-img: url(<?= $image['url']; ?>)">
                <img src="<?= $logo['url']; ?>" alt="<?= $logo['alt']; ?>" class="homepage-hero-products__product-logo">
                <div class="homepage-hero-products__product-description">
                    <?= $description ?>
                </div>
            </div>
            <div class="homepage-hero-products__product-arrow"></div>
        </a>
        <?php endforeach; ?>
    </div>
</section>
