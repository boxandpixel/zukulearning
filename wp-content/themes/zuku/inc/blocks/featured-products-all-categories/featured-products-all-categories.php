<?php
    $featured_products_all_categories = get_field('featured_products_all_categories');
    $eyebrow = $featured_products_all_categories['eyebrow'];
    $heading = $featured_products_all_categories['heading'];
    $description = $featured_products_all_categories['description'];
    $products = $featured_products_all_categories['products'];
?>

<section class="featured-products-all-categories">
    <div class="container">
        <div class="featured-products-all-categories__header">
            <?php if ($eyebrow): ?>
                <span class="featured-products-all-categories__eyebrow eyebrow"><?= $eyebrow ?></span>
            <?php endif; ?>
            <h2 class="featured-products-all-categories__heading"><?= $heading; ?></h2>
            <?php if($description): ?>
            <div class="featured-products-all-categories__description">
                <?= $description ?> 
            </div>
            <?php endif; ?>
        </div>               

        <div class="featured-products-all-categories__products">
            <?php foreach($products as $item): 
                $product = $item['product'];  // $product is the WooCommerce product post object
                $image = get_the_post_thumbnail_url($product->ID, 'full'); // Get the product image URL
                $categories = get_the_terms($product->ID, 'product_cat'); // Get product categories
                $tags = get_the_terms($product->ID, 'product_tag');
                $title = get_the_title($product->ID); // Get product title
                $link = get_permalink($product->ID); // Get the product link
                $link_target = '_self'; // Default link target
                $short_description = get_the_excerpt($product->ID);
                $slug = $product->post_name;

                // var_dump($tags);
            ?>
            <?php 
                // Get the first category slug to be used in the parent class
                $category_slug = '';
                if ($categories && !is_wp_error($categories)) {
                    $category_slug = sanitize_title($categories[0]->slug); // Get the slug of the first category
                }
            ?>

            <a href="<?= $link; ?>" target="<?= $link_target; ?>" 
            class="featured-product <?= $category_slug ? 'featured-product--' . esc_attr($category_slug) : ''; ?> featured-product--<?= $slug; ?>">
                <div class="featured-product__image" style="--bg-img: url(<?= esc_url($image); ?>);"></div>
                <div class="featured-product__tab <?= $category_slug ? 'featured-product__tab--' . esc_attr($category_slug) : ''; ?>"></div>
                <div class="featured-product__info">
                    <h4 class="featured-product__title">
                        <?= esc_html($title); ?>
                    </h4>
                    <div class="featured-product__short-description">
                        <?= $short_description; ?>
                    </div>
                </div>
                <?php if ($categories || $tags): ?>
                    <ul class="featured-product__categories">
                        <?php foreach ($categories as $category): ?>
                            <li class="pill pill--product">
                                <?= esc_html($category->name); ?>
                            </li>
                        <?php endforeach; ?>

                        <?php if($tags): ?>
                        <?php foreach ($tags as $tag) : ?>
                            <li class="pill pill--product">
                                <?= esc_html($tag->name); ?>
                            </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            </a>

            <?php endforeach; ?>
        </div>
    </div>
</section>
