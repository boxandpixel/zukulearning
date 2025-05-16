<?php
$product_testimonials = $args['product_testimonials'] ?? get_field("product_testimonials");
$heading = $product_testimonials['heading'];
$testimonials = $product_testimonials['testimonials'];
$stats = $product_testimonials['stats'];

?>

<section class="product-testimonials">
    <div class="container">
        <div class="product-testimonials__header">
            <h2><?= $heading; ?></h2>
        </div>

        <div class="product-testimonials__testimonials">
            <?php foreach($testimonials as $item): 
                $name = get_field("name", $item['testimonial']->ID);
                $testimonial = get_field("testimonial", $item['testimonial']->ID);
                $location = get_field("location", $item['testimonial']->ID);
                $image = get_field("image", $item['testimonial']->ID);
            ?>
            <div class="product-testimonial" style="background-image: url(<?= esc_url($image['url']) ?>)">
                <div class="product-testimonial__testimonial">
                    <?= esc_html($testimonial); ?>
                </div>
                <div class="product-testimonial__name">
                    <?= esc_html($name); ?>
                </div>
                <div class="product-testimonial__location">
                    <?= esc_html($location); ?>
                </div>
            </div>
                
            <?php endforeach; ?>
        </div>

        <div class="product-testimonials__stats">
            <?php foreach($stats as $item): 
                $heading = $item['heading'];
                $description = $item['description'];
            ?>
                <div class="product-stat">
                    <h1 class="product-stat__heading hero-headline"><?= $heading; ?></h1>
                    <span class="product-stat__description">
                        <?= $description; ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
