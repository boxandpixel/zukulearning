<?php
    $contact_cards = get_field('contact_cards');
    $eyebrow = $contact_cards['eyebrow'];
    $heading = $contact_cards['heading'];
    $description = $contact_cards['description'];
    $cards = $contact_cards['cards'];
?>

<section class="contact-cards">
    <div class="container">
        <div class="contact-cards__header">
            <?php if ($eyebrow): ?>
                <span class="contact-cards__eyebrow eyebrow"><?= $eyebrow ?></span>
            <?php endif; ?>
            <h2 class="contact-cards__heading"><?= $heading; ?></h2>
            <?php if($description): ?>
            <div class="contact-cards__description">
                <?= $description ?> 
            </div>
            <?php endif; ?>                
        </div>

        <div class="contact-cards__group">
            <?php foreach($cards as $card): 
                $image = $card['image'];
                $heading = $card['heading'];
                $description = $card['description'];
                $link = $card['link'];
                $link_target = $link['target'] ? $link['target'] : '_self';


            ?>
            <a href="<?= esc_url($link['url']) ?>" target="<?= esc_html($link_target); ?>" class="contact-cards__card">

                <div class="contact-cards__card-image">
                    <div class="contact-cards__card-image-inner" style="--bg-img: url(<?= esc_url($image['url']); ?>);"></div>
                </div>

                <div class="contact-cards__card-heading">
                    <h4><?= $heading; ?></h4>
                </div>
                <div class="contact_cards__card-description">
                    <?= $description; ?>
                </div>

                <div class="contact-cards__card-arrow"></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

