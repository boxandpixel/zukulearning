<?php
    $form_group_hero = get_field('form_group_hero');
    $eyebrow = $form_group_hero['eyebrow'];
    $description = $form_group_hero['description'];
    // $content_card = $form_group_hero['content_card'];
    // $content_card_heading = $content_card['heading'];
    // $content_card_list_items = $content_card['list_items'];
    // $content_card_list_style_type = $content_card['list_style_type'];
    $content_card = $form_group_hero['content_card'] ?? [];
    $content_card_heading = trim($content_card['heading'] ?? '');
    $content_card_list_items = $content_card['list_items'] ?? [];
    $content_card_list_style_type = trim($content_card['list_style_type'] ?? '');    
    $form_selector = $form_group_hero['form_selector'];
    $fun_fact = $form_group_hero['fun_fact'];
    $fun_fact_eyebrow = $fun_fact['eyebrow'];
    $fun_fact_description = $fun_fact['description'];
    $fun_fact_image = $fun_fact['image'];

    // Logic for Content Card 
    // Handle false or empty repeater field
    $list_items = is_array($content_card_list_items) ? array_filter($content_card_list_items, function($item) {
        return !empty($item['list_item']);
    }) : [];

    // Detect placeholder in select
    $is_placeholder_style = $content_card_list_style_type === '– Select a list style –';    
?>

<section class="form-group-hero">
    <div class="container<?php if ($content_card_heading || !empty($list_items)): echo ' form-group-hero__content-card-active'; endif; ?>">

            <div class="form-group-hero__header">
                <?php if ($eyebrow): ?>
                    <span class="form-group-hero__eyebrow eyebrow"><?= $eyebrow ?></span>
                <?php endif; ?>
                <h2 class="form-group-hero__headline"><?= the_title(); ?></h2>
                <?php if($description): ?>
                <div class="form-group-hero__description">
                    <?= $description ?> 
                </div>
                <?php endif; ?>  
            </div>
            <?php


            // Only render if there's meaningful content
            if ($content_card_heading || !empty($list_items)):
                $tag = ($content_card_list_style_type === 'Ordered') ? 'ol' : 'ul';
            ?>
            <div class="form-group-hero__content-card">
                <?php if ($content_card_heading): ?>
                    <div class="content-card__heading">
                        <h4><?= esc_html($content_card_heading); ?></h4>
                    </div>
                <?php endif; ?>

                <?php if (!empty($content_card_list_items)): ?>
                    <<?= $tag ?> class="content-card__list-items">
                        <?php foreach($content_card_list_items as $item): 
                            $list_item = $item['list_item'] ?? '';
                            if (!$list_item) continue;
                        ?>
                            <li><?= esc_html($list_item); ?></li>
                        <?php endforeach; ?>
                    </<?= $tag ?>>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="form-group-hero__form">
                <?php if($form_selector): ?>
                    <?php echo do_shortcode('[gravityform id="' . intval($form_selector) . '" title="false" description="false" ajax="true"]'); ?>
                <?php endif; ?>
            </div>  
            <div class="form-group-hero__fun-fact" style="background-image: url(<?= $fun_fact_image['url'] ?>);">
                <span class="eyebrow"><?= esc_html($fun_fact_eyebrow); ?></span>
                <h5><?= esc_html($fun_fact_description); ?></h5>
            </div>   



    </div>
</section>

