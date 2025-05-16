<?php
    $useful_tools_hero = get_field('useful_tools_hero');
    $eyebrow = $useful_tools_hero['eyebrow'];
    $headline = $useful_tools_hero['headline'];
    $description = $useful_tools_hero['description'];
    $tools = $useful_tools_hero['tools'];
?>

<section class="useful-tools-hero">
    <div class="container">
        <div class="useful-tools-hero__header">
            <?php if ($eyebrow): ?>
                <span class="useful-tools-hero__eyebrow eyebrow"><?= $eyebrow ?></span>
            <?php endif; ?>
            <h2 class="useful-tools-hero__headline"><?= $headline; ?></h2>
            <?php if($description): ?>
            <div class="useful-tools-hero__description">
                <?= $description ?> 
            </div>
            <?php endif; ?>                

            <?php if(!empty($tools)): ?>
            <div class="useful-tools-hero__group">
                <?php foreach($tools as $tool): 
                    $image = $tool['image'];
                    $heading = $tool['heading'];
                    $links = $tool['links'];


                    ?>
                <div class="useful-tools-hero__card" style="background-image: url(<?= $image['url']; ?>);">
                    <h4 class="useful-tools-hero__heading"><?= esc_html($heading); ?></h4>
                    <?php if(!empty($links)): ?>
                        <ul class="useful-tools-hero__links">
                            <?php foreach($links as $item): 
                                $link = $item['link'];
                            ?>
                            <li class="useful-tools-hero__links-item"><a href="<?= esc_url($link['url']) ?>" class="useful-tools-hero__links-item-link"><?= esc_html($link['title']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

