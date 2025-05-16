<?php
    $helpful_links = get_field('helpful_links');
    $eyebrow = $helpful_links['eyebrow'];
    $heading = $helpful_links['heading'];
    $description = $helpful_links['description'];
    $links = $helpful_links['links'];
    $cards = $helpful_links['cards_group']['cards'];
    $image = $helpful_links['cards_group']['image'];
    $background_color = $helpful_links['background_color'];
?>

<section class="helpful-links helpful-links--<?= $background_color; ?>">
    <div class="container">
        <div class="helpful-links__header">
            <?php if ($eyebrow): ?>
                <span class="helpful-links__eyebrow eyebrow"><?= $eyebrow ?></span>
            <?php endif; ?>
            <h2 class="helpful-links__heading"><?= $heading; ?></h2>
            <?php if($description): ?>
            <div class="helpful-links__description">
                <?= $description ?> 
            </div>
            <?php endif; ?>                
            <?php if(!empty($links)): ?>
            <div class="helpful-links__links">
                <?php foreach($links as $item): 
                    $link = $item['link'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    $button_style = $item['button_style'];
                ?>
                <a href="<?= $link['url']; ?>" target="<?= $link_target; ?>" 
                    class="button button--<?= $button_style; ?>"><?= $link['title']; ?></a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>

        <div class="helpful-links__group">
            <div class="helpful-links__image">
                <img src="<?= esc_html($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>">
            </div>
            <div class="helpful-links__cards">
                <?php foreach($cards as $card): 
                    $heading = $card['heading'];
                    $description = $card['description'];
                    $link = $card['link'];
                ?>
                <a href="" class="helpful-links__text-card">
                    <h5><?= $heading; ?></h5>
                    <?= $description; ?>
                    <div class="helpful-links__arrow"></div>
                </a>
                <?php endforeach; ?>
            </div> 
        </div>

    </div>
</section>

