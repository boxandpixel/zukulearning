<?php
    $faculty_group = get_field('faculty_group');
    $heading = $faculty_group['heading'];
    $faculty = $faculty_group['faculty'];
?>

<section class="faculty-group">
    <div class="container">
        <div class="faculty-group__header">
            <h2><?= esc_html($heading); ?></h2>
        </div>

        <div class="faculty-group__group">
            <?php foreach ($faculty as $item): 
                $post_object = $item['faculty_member'];
                if (!$post_object) continue;

                $image_url = get_the_post_thumbnail_url($post_object->ID, 'full');
                $image_alt = get_post_meta(get_post_thumbnail_id($post_object->ID), '_wp_attachment_image_alt', true);
                $name = get_the_title($post_object->ID);
                $title = get_field('title', $post_object->ID);
            ?>
            <div class="faculty-member" data-modal-id="faculty-modal-<?= esc_attr($post_object->ID); ?>">
                <button type="button" class="faculty-member__trigger" aria-haspopup="dialog" aria-controls="faculty-modal-<?= esc_attr($post_object->ID); ?>">
                    <div class="faculty-member__image">
                        <?php if ($image_url): ?>
                            <img src="<?= esc_url($image_url); ?>" alt="<?= esc_attr($image_alt); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="faculty-member__summary">
                        <h3 class="faculty-member__summary-name heading-sm-uniform"><?= esc_html($name); ?></h3>
                        <p class="faculty-member__summary-title"><?= esc_html($title ?? '') ?></p>
                    </div>
                </button>
            </div>
            <?php endforeach; ?>
        </div>

        <?php foreach ($faculty as $item): 
            $post_object = $item['faculty_member'];
            if (!$post_object) continue;

            $image_url = get_the_post_thumbnail_url($post_object->ID, 'full');
            $image_alt = get_post_meta(get_post_thumbnail_id($post_object->ID), '_wp_attachment_image_alt', true);
            $name = get_the_title($post_object->ID);
            $title = get_field('title', $post_object->ID);
            $education = get_field('education', $post_object->ID);
            $education_heading = $education['heading'] ?? '';
            $credentials = $education['credentials'] ?? [];
            $biography = get_field('biography', $post_object->ID);
            $biography_items = $biography['biography_items'];
        ?>
        <!-- Modal structure -->
        <div id="faculty-modal-<?= esc_attr($post_object->ID); ?>" class="faculty-modal" role="dialog" aria-modal="true" style="display: none;">
            <div class="faculty-modal__overlay" data-modal-close></div>
            <div class="faculty-modal__content">
                <div class="faculty-modal__utility">
                    <button class="faculty-modal__close" data-modal-close aria-label="Close">&times;</button>
                </div>
                
                <div class="faculty-modal__body">
                    <div class="faculty-modal__header">
                        <div class="faculty-modal__header-image">
                            <img src="<?= esc_url($image_url); ?>" alt="<?= esc_attr($image_alt); ?>">
                        </div>
                        <div class="faculty-modal__header-summary">
                            <h4><?= esc_html($name); ?></h4>
                            <p><?= esc_html($title); ?></p>
                        </div>

                    </div>
                    <?php if ($education_heading || !empty($credentials)): ?>
                    <div class="faculty-modal__education">
                        <div class="faculty-modal__education-header">
                            <h4 class="heading-sm-uniform"><?= esc_html($education_heading); ?></h4>
                        </div>
                        <div class="faculty-modal__education-credentials">
                            <?php if (is_array($credentials) && !empty($credentials)): ?>
                            <?php foreach($credentials as $item):
                                $credential = $item['credential'];
                                ?>
                            <p class="faculty-modal__education-credential">
                                <?= esc_html($credential) ?? '' ?>
                            </p>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($biography || !empty($biography_items)): ?>
                    <div class="faculty-modal__biography">
                        <div class="faculty-modal__biography-items">
                            <?php if (is_array($biography_items) && !empty($biography_items)): ?>
                            <?php foreach($biography_items as $item): 
                                $heading = $item['heading']; 
                                $description = $item['description'];
                                ?>
                                <div class="faculty-modal__biography-item">
                                    <h4 class="heading-sm-uniform faculty-modal__biography-details-heading"><?= wp_kses_post($heading); ?></h4>
                                    <div class="faculty-modal__biography-details-description"><?= wp_kses_post($description); ?></div>
                                </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
