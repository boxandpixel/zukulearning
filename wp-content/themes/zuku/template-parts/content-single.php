<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zuku
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <div class="container">
            <section class="blog-breadcrumb">
                <div class="breadcrumb__link">
                    <a href="/blog" class="" target="_self">Go Back</a>
                </div>
            </section>   
            
            <div class="entry-header__group">
                <div class="entry-header__image">
                    <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="">
                </div>
                <div class="entry-header__details">
                    <div class="entry-header__details-eyebrow">
                        <span class="eyebrow">Blog/</span>
                    </div>
                    <div class="entry-header__details-meta">
                        <div class="entry-header__details-title">
                            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        </div>
                        <div class="entry-header__details-author">
                            <?php
                                $author_id = get_the_author_meta('ID');
                                $first_name = get_the_author_meta('first_name', $author_id);
                                $last_name = get_the_author_meta('last_name', $author_id);

                                echo '<span class="">by ' . esc_html($first_name . ' ' . $last_name) . '</span>';
                            ?>
                        </div>
                        <div class="entry-header__details-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</header><!-- .entry-header -->

	

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'zuku' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		// wp_link_pages(
		// 	array(
		// 		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zuku' ),
		// 		'after'  => '</div>',
		// 	)
		// );

        
        $author_id = get_the_author_meta('ID');
        $headshot = get_the_author_meta('author_headshot', $author_id);
        $name = get_the_author_meta('display_name', $author_id);
        $author_bio = get_the_author_meta('description');
        $title = get_the_author_meta('user_title', $author_id);
		?>
        <div class="entry-content__author">
            <div class="entry-content__author-image">
                <img src="<?php echo esc_url($headshot); ?>" alt="<?php echo esc_attr($name); ?>">
            </div>
            <div class="entry-content__author-details">
                <span class="eyebrow">About the Author</span>
                <div class="entry-content__author-meta">
                    <div class="entry-content__author-name"><?= esc_html($first_name . ' ' . $last_name) ?></div>
                    <div class="entry-content__author-title"><?= esc_html($title); ?></div>        
                </div>
                <div class="entry-content__author-bio"><?= esc_html($author_bio); ?></div>
            </div>
        </div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //zuku_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php //the_ID(); ?> -->
