<?php
    $image_with_stats_hero = get_field('image_with_stats_hero');
    $eyebrow = $image_with_stats_hero['eyebrow'];
    $heading = $image_with_stats_hero['heading'];
    $description = $image_with_stats_hero['description'];
    $image = $image_with_stats_hero['image'];
    $stats = $image_with_stats_hero['stats'];
?>

<section class="image-with-stats-hero">
    <div class="container">
        <div class="image-with-stats-hero__header">
            <?php if ($eyebrow): ?>
                <span class="image-with-stats-hero__eyebrow eyebrow"><?= $eyebrow ?></span>
            <?php endif; ?>
            <h2 class="image-with-stats-hero__heading"><?= $heading; ?></h2>
            <?php if($description): ?>
            <div class="image-with-stats-hero__description">
                <?= $description ?> 
            </div>
            <?php endif; ?>                

            <div class="image-with-stats-hero__group">
                <div class="image-with-stats-hero__stats-image" style="background-image: url(<?= $image['url']; ?>);">
                </div>
                <?php if(!empty($stats)): ?>
                <div class="image-with-stats-hero__stats-group">
                    <?php foreach($stats as $stat): 
                        $heading = $stat['heading'];
                        $description = $stat['description'];
                    ?>
                    <div class="image-with-stats-hero__stat">
                        <h1 class="image-with-stats-hero__stat-heading"><?= esc_html($heading); ?></h1>
                        <p class="image-with-stats-hero__stat-description"><?= esc_html($description); ?></p>
                    </div>
                    <?php endforeach; ?>                    
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

