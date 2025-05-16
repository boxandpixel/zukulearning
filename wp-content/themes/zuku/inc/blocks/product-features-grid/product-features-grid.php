<?php
$product_features_grid = $args['product_features_grid'] ?? get_field("product_features_grid");
$heading = $product_features_grid['heading'];
$cards = $product_features_grid['cards'];
$cards_color = $product_features_grid['cards_color'];


?>



<section class="product-features-grid">
    <div class="container">

        <div class="product-features-grid__header">
            <?= wp_kses_post($heading) ?>
        </div>

        <div class="product-features-grid__cards product-features-grid__cards-color--<?= esc_html($cards_color); ?>">
            <?php foreach($cards as $card): 
                $image = $card['image'];
                $heading = $card['heading'];
                $description = $card['description'];
                
                ?>
                <div class="grid-item<?php if(!empty($image)): ?> grid-item--image<?php endif; ?>" <?php if(!empty($image)): ?> style="background-image: url(<?= esc_url($image['url']); ?>);"<?php endif; ?>>
                    <h5 class="product-features-grid-item__heading"><?= esc_html($heading); ?></h5>
                    <div class="product-features-grid-item__description">
                        <?= wp_kses_post($description); ?>
                    </div>
                </div>
            <?php endforeach; ?>  
            <!-- <div class="grid-item large-image" id="real-exam">Like the real exam</div>
            <div class="grid-item">Highly visual</div>
            <div class="grid-item">Proven Pass Rates</div>
            <div class="grid-item">Build confidence</div>
            <div class="grid-item large-image" id="multi-language">Multiple languages</div>
            <div class="grid-item">Measure progress</div>
            <div class="grid-item">Learn from the best</div> -->
        </div>
    </div>
</section>
