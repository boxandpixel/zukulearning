<?php
    $alternating_cards = get_field('alternating_cards');
    $eyebrow = $alternating_cards['eyebrow'];
    $heading = $alternating_cards['heading'];
    $description = $alternating_cards['description'];
    $links = $alternating_cards['links'];
    $cards = $alternating_cards['cards'];
?>

<section class="alternating-cards">
    <div class="container">
        <div class="alternating-cards__header">
            <?php if ($eyebrow): ?>
                <span class="alternating-cards__eyebrow eyebrow"><?= $eyebrow ?></span>
            <?php endif; ?>
            <h2 class="alternating-cards__heading"><?= $heading; ?></h2>
            <?php if($description): ?>
            <div class="alternating-cards__description">
                <?= $description ?> 
            </div>
            <?php endif; ?>                

            <div class="alternating-cards__links">
                <?php foreach($links as $item): 
                    $link = $item['link'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    $button_style = $item['button_style'];
                ?>
                <a href="<?= $link['url']; ?>" target="<?= $link_target; ?>" 
                    class="button button--<?= $button_style; ?>"><?= $link['title']; ?></a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="alternating-cards__groups">
            <?php foreach($cards as $card): 
                $image = $card['image'];
                $heading = $card['heading'];
                $description = $card['description'];
            ?>
            <div class="alternating-cards__group">
                <div class="alternating-cards__image-card">
                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                </div>
                <div class="alternating-cards__text-card">
                    <h2><?= $heading; ?></h2>
                    <?= $description; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

