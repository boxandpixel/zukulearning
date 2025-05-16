<?php
    $featured_products_select_categories = get_field('featured_products_select_categories');
    $heading = $featured_products_select_categories['heading'];
    $products = $featured_products_select_categories['products'];
?>

<section class="featured-products-select-categories">
    <div class="container">
        <div class="featured-products-select-categories__header">
            <?= $heading; ?>
        </div>

            <div class="featured-products-select-categories__products">
                <?php foreach($products as $item): 
                    $product = $item['product'];  // $product is the WooCommerce product post object
                    $image = get_the_post_thumbnail_url($product->ID, 'full'); // Get the product image URL
                    $categories = get_the_terms($product->ID, 'product_cat'); // Get product categories
                    $tags = get_the_terms($product->ID, 'product_tag');
                    $title = get_the_title($product->ID); // Get product title
                    $link = get_permalink($product->ID); // Get the product link
                    $link_target = '_self'; // Default link target
                    $short_description = get_the_excerpt($product->ID);
                    $description = get_post_field('post_content', $product->ID);
                    $slug = $product->post_name;

                    // var_dump($item);
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
                    <div class="featured-product__image">
                        <div class="featured-product__image-inner" style="--bg-img: url(<?= esc_url($image); ?>);"></div>
                    </div>
                    <div class="featured-product__tab <?= $category_slug ? 'featured-product__tab--' . esc_attr($category_slug) : ''; ?>"></div>
                    <div class="featured-product__info">
                        <h4 class="featured-product__heading">
                            <?= esc_html($title); ?>
                        </h4>
                        <div class="featured-product__short-description large-card-subheading">
                            <?= $short_description; ?>
                        </div>                        
                        <div class="featured-product__description">
                            <?= $description; ?>
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
