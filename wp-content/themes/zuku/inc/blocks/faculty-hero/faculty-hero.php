<?php
    $faculty_hero = get_field('faculty_hero');
    $eyebrow = $faculty_hero['eyebrow'];
    $headline = $faculty_hero['headline'];
    $description = $faculty_hero['description'];
    $cards = $faculty_hero['cards'];
?>

<section class="faculty-hero">
    <div class="container">
        <div class="faculty-hero__header">
            <?php if ($eyebrow): ?>
                <span class="faculty-hero__eyebrow eyebrow"><?= $eyebrow ?></span>
            <?php endif; ?>
            <h2 class="faculty-hero__heading"><?= $headline; ?></h2>
            <?php if($description): ?>
            <div class="faculty-hero__description">
                <?= $description ?> 
            </div>
            <?php endif; ?>                
        </div>

        <div class="faculty-hero__group">
            <?php foreach($cards as $card): 
                $image = $card['image'];
                $heading = $card['heading'];
                $description = $card['description'];
            ?>
            <div class="faculty-hero__card">
                <div class="faculty-hero__card-image">
                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">                    
                </div>
                <div class="faculty-hero__card-heading">
                    <h1><?= $heading; ?></h1>
                </div>
                <div class="faculty_hero__card-description">
                    <?= $description; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

