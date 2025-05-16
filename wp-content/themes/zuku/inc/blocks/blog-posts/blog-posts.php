<?php
    $blog_posts = get_field('blog_posts');
    $heading = $blog_posts['heading'];
    $posts = $blog_posts['posts'];
?>

<section class="blog-posts">
    <div class="container">
        <div class="blog-posts__header">
            <h2><?= esc_html($heading); ?></h2>
        </div>

        <div class="blog-posts__group">
            <?php foreach($posts as $item): 
                $post_object = $item['post']; // actual WP_Post object
                if (!$post_object) continue;

                $image_url = get_the_post_thumbnail_url($post_object->ID, 'full');
                $image_alt = get_post_meta(get_post_thumbnail_id($post_object->ID), '_wp_attachment_image_alt', true);
                $title = get_the_title($post_object->ID);
                $categories = get_the_category($post_object->ID);
            ?>
            <a href="<?php the_permalink(); ?>" class="blog-posts__post">
                <div class="blog-posts__post-image">
                    <?php if ($image_url): ?>
                        <img src="<?= esc_url($image_url); ?>" alt="<?= esc_attr($image_alt); ?>">
                    <?php endif; ?>
                </div>
                <div class="blog-posts__post-categories">
                <?php if ($categories || $tags): ?>
                    <ul class="post-meta">
                        <!-- Categories -->
                        <?php foreach ($categories as $cat): ?>
                            <li class="post-meta__item pill pill--<?= $cat->slug ?>">
                                <?= esc_html($cat->name); ?>
                            </li>
                        <?php endforeach; ?>

                        <!-- Tags -->
                        <?php 
                        $tags = get_the_tags($post_object->ID); // Get tags for the current post
                        if ($tags): 
                            foreach ($tags as $tag): ?>
                                <li class="post-meta__item post-meta__item--tag pill pill--tag">
                                    <?= esc_html($tag->name); ?>
                                </li>
                            <?php endforeach; 
                        endif; ?>
                    </ul>
                <?php endif; ?>
                </div>
                <div class="blog-posts__post-title">
                    <h3 class="large-card-subheading"><?= esc_html($title); ?></h3>
                </div>
                <div class="blog-posts__card-arrow"></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
