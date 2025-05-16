<?php
    $alternating_50_50_promo_sections = get_field('alternating_50_50_promo_sections');
    $promo_sections = $alternating_50_50_promo_sections['promo_sections'];
?>

<section class="alternating-50-50-promo-sections">
    <div class="container">
        <div class="alternating-50-50-promo-sections__groups">
            <?php foreach($promo_sections as $item): 
                $image = $item['image'];
                $heading = $item['heading'];
                $description = $item['description'];
                $links = $item['links'];
            ?>
            <div class="alternating-50-50-promo-sections__group">
                <div class="alternating-50-50-promo-sections__image">
                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>" class="alternating-50-50-promo-sections__image-image">
                </div>
                <div class="alternating-50-50-promo-sections__content">
                    <div class="alternating-50-50-promo-sections__header">
                        <h2><?= $heading; ?></h2>
                    </div>
                    <div class="alternating-50-50-promo-sections__details">
                        <p class="alternating-50-50-promo-sections__description">
                            <?= $description; ?>
                        </p>
                        

                        <?php if(!empty($links)): ?>
                            <div class="alternating-50-50-promo-sections__links">    
                                <?php foreach($links as $link): 
                                    $link_title = $link['link']['title'];
                                    $link_url = $link['link']['url'];
                                    $button_style = $link['button_style'];
                                ?>
                                    <a href="<?= esc_url($link_url); ?>" class="button button--<?= $button_style; ?>"><?= esc_html($link_title); ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


