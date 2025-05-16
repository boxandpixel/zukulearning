<?php
$resources = get_field('resources');
$heading = $resources['heading'];
$cards = $resources['cards'];
?>

<section class="resources">
    <div class="container">
        <div class="resources__header">
            <h2><?= $heading; ?></h2>
        </div>
        <div class="resources__group">
            <?php foreach($cards as $card): 
                $heading = $card['heading'];
                $image = $card['image'];
                $link = $card['link'];
                $link_target = $link['target'] ? $link['target'] : '_self';

                ?>
                <a href="" class="resource" style="background-image: url(<?= esc_html($image['url']) ?>);">
                    <h5 class="heading-sm-uniform"><?= $heading; ?></h5>
                    <div class="resource__arrow"></div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
