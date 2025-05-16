<?php
    $testimonial = get_field('testimonial'); 
    if ($testimonial):
        $testimonial_content = get_field('testimonial', $testimonial->ID); 
        $testimonial_name = get_field('name', $testimonial->ID);
        $testimonial_images = get_field('images', $testimonial->ID);
?>

<section class="testimonial">
    <div class="container">
        <?php if ($testimonial_content): ?>
            <div class="testimonial__content">
                <h4><?php echo esc_html($testimonial_content); ?></h4>
            </div>
        <?php endif; ?>
        
        <?php if ($testimonial_name): ?>
            <div class="testimonial__name">
                <span class="eyebrow"><?php echo esc_html($testimonial_name); ?></span>
            </div>
        <?php endif; ?>

        <?php if ($testimonial_images): ?>
        <div class="testimonial__images-clip">
            <div class="testimonial__images">
                <?php foreach ($testimonial_images as $image): ?>
                    
                    <div class="testimonial-images__image">
                        <img src="<?php echo esc_url($image['image']['url']); ?>" alt="<?php echo esc_attr($image['image']['alt']); ?>" />
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php endif; ?>


