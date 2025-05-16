<?php
/**
 * zuku functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package zuku
 */

if ( ! defined( 'zuku_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'zuku_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function zuku_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on zuku, use a find and replace
		* to change 'zuku' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'zuku', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'main-menu' => esc_html__( 'Main Menu', 'zuku' ),
			'footer-utility-menu' => esc_html__( 'Footer Utility Menu', 'zuku' ),
			'footer-test-prep-menu' => esc_html__( 'Footer Test Prep Menu', 'zuku' ),
			'footer-continuing-education-menu' => esc_html__( 'Footer Continuing Education Menu', 'zuku' ),
			'footer-about-menu' => esc_html__( 'Footer About Menu', 'zuku' ),
			'footer-resources-menu' => esc_html__( 'Footer Resources Menu', 'zuku' ),
			'header-utility-menu' => esc_html__( 'Header Utility Menu', 'zuku' ),
			'account-controls-menu' => esc_html__( 'Account Controls Menu', 'zuku' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'zuku_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'zuku_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zuku_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zuku_content_width', 640 );
}
add_action( 'after_setup_theme', 'zuku_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zuku_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'zuku' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'zuku' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'zuku_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function zuku_scripts() {
	wp_enqueue_style( 'zuku-style', get_stylesheet_uri(), array(), zuku_VERSION );
	wp_style_add_data( 'zuku-style', 'rtl', 'replace' );

	// wp_enqueue_script( 'zuku-navigation', get_template_directory_uri() . '/js/navigation.js', array(), zuku_VERSION, true );
	// wp_enqueue_script( 'zuku-scripts', get_template_directory_uri() . '/scripts.min.js', array(), zuku_VERSION, true );
	wp_enqueue_script('zuku-scripts', get_template_directory_uri() . '/scripts.min.js', [], filemtime(get_template_directory() . '/scripts.min.js'), true);


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zuku_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/** 
 * Theme Options
 */


if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title'    => 'Theme Options',
		'menu_title'    => 'Theme Options',
		'menu_slug'     => 'theme-options',
		'capability'    => 'edit_posts',
		'redirect'      => false
	));
}

/** 
 * Allow SVG
 */

function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads'); 
 
/** 
 * Initialize Blocks
 */

 add_action('acf/init', function () {
	 if (!function_exists('acf_register_block_type')) return;
 
	 $blocks = [
		 'homepage-hero' => [
			 'title' => __('Homepage Hero'),
			 'description' => 'A large hero section with heading, subheading, and image.',
			 'icon' => 'format-image',
		 ],
		 'marketing-announcement' => [
			 'title' => __('Marketing Announcement'),
			 'description' => 'A custom block with text and a button.',
			 'icon' => 'megaphone',
		 ],
		 'testimonial' => [
			'title' => __('Testimonial'),
			'description' => 'A custom CTA block with with text.',
			'icon' => 'megaphone',
		],	
		'alternating-cards' => [
			'title' => __('Alternating Cards'),
			'description' => 'A custom CTA block with a section title and alternating cards.',
			'icon' => 'megaphone',
		],	
		'blog-posts' => [
			'title' => __('Blog Posts'),
			'description' => 'A custom CTA block with an image, title, and categories.',
			'icon' => 'megaphone',
		],	
		'featured-products-all-categories' => [
			'title' => __('Featured Products (All Categories)'),
			'description' => 'A custom CTA block with an heading, subheading, and products.',
			'icon' => 'megaphone',
		],	
		'product-marketing-landing-hero' => [
			'title' => __('Product Marketing Landing Hero'),
			'description' => 'A custom CTA block with an heading, subheading, and list items.',
			'icon' => 'megaphone',
		],	
		'featured-products-select-categories' => [
			'title' => __('Featured Products (Select Categories)'),
			'description' => 'A custom CTA block with an heading, subheading, and products.',
			'icon' => 'megaphone',
		],
		'helpful-links' => [
			'title' => __('Helpful Links'),
			'description' => 'A custom CTA block with an heading, subheading, links, and cards',
			'icon' => 'megaphone',
		],		
		'promo' => [
			'title' => __('Promo'),
			'description' => 'A custom CTA block with an heading, subheading, and image',
			'icon' => 'megaphone',
		],
		'resources' => [
			'title' => __('Resources'),
			'description' => 'A custom CTA block with an heading and cards',
			'icon' => 'megaphone',
		],	
		'question-of-the-day-teaser' => [
			'title' => __('Question of the Day Teaser'),
			'description' => 'A custom CTA block with an image, heading, description, and link',
			'icon' => 'megaphone',
		],	
		'faculty-hero' => [
			'title' => __('Faculty Hero'),
			'description' => 'A custom CTA block with an eyebrow, heading, description, and cards',
			'icon' => 'megaphone',
		],		
		'faculty-group' => [
			'title' => __('Faculty Group'),
			'description' => 'A custom CTA block with an image, heading, and description',
			'icon' => 'megaphone',
		],					
		'contact-cards' => [
			'title' => __('Contact Cards'),
			'description' => 'A custom CTA block with an image, heading, description, and cards',
			'icon' => 'megaphone',
		],	
		'product-features' => [
			'title' => __('Product Features'),
			'description' => 'A custom CTA block with a comparison table',
			'icon' => 'megaphone',
		],	
		'product-features-grid' => [
			'title' => __('Product Features Grid'),
			'description' => 'A custom CTA block with content blocks',
			'icon' => 'megaphone',
		],	
		'product-testimonials' => [
			'title' => __('Product Testimonials'),
			'description' => 'A custom block with posts and cards',
			'icon' => 'megaphone',
		],	
		'breadcrumb' => [
			'title' => __('Breadcrumb'),
			'description' => 'A custom block with site navigation',
			'icon' => 'megaphone',
		],	
		'form-group-hero' => [
			'title' => __('Form Group Hero'),
			'description' => 'A custom block with a title, description, cards, and form',
			'icon' => 'megaphone',
		],	
		'image-with-stats-hero' => [
			'title' => __('Image with Stats Hero'),
			'description' => 'A custom block with a title, description, cards, and form',
			'icon' => 'megaphone',
		],	
		'alternating-50-50-promo-sections' => [
			'title' => __('Alternating 50/50 Promo Sections'),
			'description' => 'A custom block with a title, description, cards, and form',
			'icon' => 'megaphone',
		],	
		'useful-tools-hero' => [
			'title' => __('Useful Tools Hero'),
			'description' => 'A custom block with a title, description, and cards',
			'icon' => 'megaphone',
		],			                						
	 ];
 
	 foreach ($blocks as $slug => $block) {
		 acf_register_block_type([
			 'name' => $slug,
			 'title' => $block['title'],
			 'description' => $block['description'],
			 'render_template' => get_template_directory() . "/inc/blocks/{$slug}/{$slug}.php",
			 'category' => 'formatting',
			 'icon' => $block['icon'],
			 'keywords' => [$slug],
			 'mode' => 'edit',
			 'supports' => [
				 'align' => ['full', 'wide'],
				 'mode' => true,
			 ],
		 ]);
	 }
 });

/** 
 * Initialize testimonial CPT
 */

//  function register_testimonials_cpt() {
//     $labels = array(
//         'name'               => _x('Testimonials', 'post type general name'),
//         'singular_name'      => _x('Testimonial', 'post type singular name'),
//         'menu_name'          => __('Testimonials'),
//         'name_admin_bar'     => __('Testimonial'),
//         'add_new'            => __('Add New'),
//         'add_new_item'       => __('Add New Testimonial'),
//         'new_item'           => __('New Testimonial'),
//         'edit_item'          => __('Edit Testimonial'),
//         'view_item'          => __('View Testimonial'),
//         'all_items'          => __('All Testimonials'),
//         'search_items'       => __('Search Testimonials'),
//         'parent_item_colon'  => __('Parent Testimonials:'),
//         'not_found'          => __('No testimonials found.'),
//         'not_found_in_trash' => __('No testimonials found in Trash.')
//     );

//     $args = array(
//         'labels'             => $labels,
//         'description'        => __('A custom post type for testimonials.'),
//         'public'             => true,
//         'publicly_queryable' => true,
//         'show_ui'            => true,
//         'show_in_rest'       => false, // Enable Gutenberg editor and REST API
//         'show_in_menu'       => true,
//         'query_var'          => true,
//         'rewrite'            => array('slug' => 'testimonials'),
//         'capability_type'    => 'post',
//         'has_archive'        => true,
//         'hierarchical'       => false,
//         'menu_position'      => 20,
//         'menu_icon'          => 'dashicons-format-quote', // Optional: choose an icon
//         'supports'           => array('title'),
//     );

//     register_post_type('testimonials', $args);
// }
// add_action('init', 'register_testimonials_cpt');

function register_custom_post_type($type, $singular, $plural, $slug, $icon = 'dashicons-admin-post') {
    $labels = array(
        'name'               => _x($plural, 'post type general name'),
        'singular_name'      => _x($singular, 'post type singular name'),
        'menu_name'          => __($plural),
        'name_admin_bar'     => __($singular),
        'add_new'            => __('Add New'),
        'add_new_item'       => __("Add New $singular"),
        'new_item'           => __("New $singular"),
        'edit_item'          => __("Edit $singular"),
        'view_item'          => __("View $singular"),
        'all_items'          => __("All $plural"),
        'search_items'       => __("Search $plural"),
        'parent_item_colon'  => __("Parent $plural:"),
        'not_found'          => __("No $plural found."),
        'not_found_in_trash' => __("No $plural found in Trash.")
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __("A custom post type for $plural."),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_rest'       => false,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => $slug),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => $icon,
        'supports'           => array('title', 'thumbnail'),
    );

    register_post_type($type, $args);
}

function register_my_custom_post_types() {
    register_custom_post_type('testimonials', 'Testimonial', 'Testimonials', 'testimonials', 'dashicons-format-quote');
    register_custom_post_type('faculty', 'Faculty Member', 'Faculty', 'faculty', 'dashicons-welcome-learn-more');
}
add_action('init', 'register_my_custom_post_types');


/** 
 * Add styles to WYSIWYG
 */
function my_acf_wysiwyg_toolbar( $toolbars ) {
    // Check if we are modifying the WYSIWYG toolbar for ACF
    if ( isset( $toolbars['Full'] ) ) {
        // Add the dropdown to the 'Full' toolbar
        $toolbars['Full'][1][] = 'styleselect';  // This adds the styles dropdown to the toolbar
    }
    
    return $toolbars;
}
add_filter( 'acf/fields/wysiwyg/toolbars', 'my_acf_wysiwyg_toolbar' );

function my_mce_before_init( $settings ) {
    // Add custom styles to the style_formats option
    $style_formats = array(
        array(
            'title'   => 'Black', // Dropdown title
            'inline'  => 'span',           // Tag type, e.g., 'span', 'div'
            'classes' => 'heading--black', // CSS class name
            'styles'  => array()           // You can also add inline styles here if needed
        ),
        // array(
        //     'title'   => 'Custom Class 2',
        //     'inline'  => 'span',
        //     'classes' => 'custom-class-2',
        //     'styles'  => array()
        // ),
    );

    // Merge the custom styles with the existing styles
    if (isset($settings['style_formats'])) {
        $settings['style_formats'] = json_encode(array_merge(json_decode($settings['style_formats'], true), $style_formats));
    } else {
        $settings['style_formats'] = json_encode($style_formats);
    }

    return $settings;
}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );

 /** 
  * WooCommerce Subscriptions: Every 45 days
  */

	// Add custom intervals for subscriptions (e.g., every 45 days)
	function custom_subscription_intervals( $intervals ) {
		$intervals['45days'] = __( 'Every 45 days', 'woocommerce' );
		return $intervals;
	}
	add_filter( 'woocommerce_subscription_periods', 'custom_subscription_intervals' );

	// Set custom interval for a specific product variation
	function custom_subscription_period_for_variation( $subscription_period, $product_id ) {
		// Example: change the subscription interval for a specific product (by ID)
		if ( $product_id == 91 ) { // Replace 123 with your product ID
			$subscription_period = '45days'; // Use the custom interval
		}
		return $subscription_period;
	}
	add_filter( 'woocommerce_subscriptions_product_subscription_period', 'custom_subscription_period_for_variation', 10, 2 );

/**
 * WooCommerce: Add product category to body class
 */

	function add_product_category_to_body_class( $classes ) {
		if ( is_singular( 'product' ) ) {
			global $post;
			$terms = get_the_terms( $post->ID, 'product_cat' );
			if ( $terms && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$classes[] = 'product-cat-' . sanitize_html_class( $term->slug );
				}
			}
		}
		return $classes;
	}
	add_filter( 'body_class', 'add_product_category_to_body_class' );

/**
 * WC: Display price as range
 */

 function custom_variable_subscription_price_range() {
    global $product;

    if ( $product->is_type( 'variable-subscription' ) ) {
        $prices = [];

        foreach ( $product->get_children() as $child_id ) {
            $variation = wc_get_product( $child_id );
            if ( $variation && $variation->is_purchasable() ) {
                $prices[] = $variation->get_price();
            }
        }

        if ( ! empty( $prices ) ) {
            $min_price = floor( min( $prices ) );
            $max_price = ceil( max( $prices ) );

            echo '<div class="price" id="custom-price-range">';
            echo wc_price( $min_price, [ 'decimals' => 0 ] );
            if ( $min_price != $max_price ) {
                echo ' – ' . wc_price( $max_price, [ 'decimals' => 0 ] );
            }
            echo '</div>';
        }
    }
}

add_action( 'woocommerce_single_product_summary', 'custom_variable_subscription_price_range', 10 );


/** 
 * WC: Remove short description from product summary
 */

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

/**
 * WC: Remove quantity
 */
function custom_remove_all_quantity_fields( $return, $product ) {
	return true;
}
add_filter ( 'woocommerce_is_sold_individually','custom_remove_all_quantity_fields', 10, 2 );


/**
 * WC: Remove product_meta from summary
 */

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


/** 
 * WC: Replace price range with selected price
 */
function custom_variable_subscription_price_update_script() {
    ?>
    <script type="text/javascript">
        jQuery(function($) {
            const $form = $('form.variations_form');
            const $priceRange = $('#custom-price-range');
            let originalPriceHTML = $priceRange.html();
            let userInteracted = false;

            // Track user interaction
            $form.on('change', '.variations select', function() {
                userInteracted = true;
            });

            $form.on('found_variation', function(event, variation) {
                if (userInteracted && variation && variation.price_html) {
                    // Remove "every X" part from variation price
                    const cleanedPrice = variation.price_html.replace(/(?:<[^>]+>)?every\s[\w\s]+/i, '').trim();
                    $priceRange.html(cleanedPrice);
                }
            });

            $form.on('reset_data', function() {
                $priceRange.html(originalPriceHTML);
                userInteracted = false;
            });
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'custom_variable_subscription_price_update_script', 20 );

/**
 * WC: Test custom HTML output
 */
function add_custom_html_to_product_summary() {
    echo '<div class="product__price-info">Price reflective of selections below</div>';
}
add_action( 'woocommerce_single_product_summary', 'add_custom_html_to_product_summary', 25 );

/**
 * WC: Remove additional information from single product template
 */

 add_filter( 'woocommerce_product_tabs', 'custom_remove_additional_information_tab', 98 );
 function custom_remove_additional_information_tab( $tabs ) {
	 unset( $tabs['additional_information'] ); // Remove the Additional Information tab
	 return $tabs;
 }


 /** 
  * WC: Remove related products
  */
 remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/**
 * WC: Remove description tab
 */
add_filter( 'woocommerce_product_tabs', 'custom_remove_description_tab', 98 );
function custom_remove_description_tab( $tabs ) {
    unset( $tabs['description'] ); // Removes the Description tab
    return $tabs;
}

/**
 * WC: Subscription add-to-cart from "Sign up now" to "Buy now"
 */
add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_change_subscription_button_text', 10, 2 );
function custom_change_subscription_button_text( $button_text, $product ) {
    if ( $product->is_type( 'variable-subscription' ) ) {
        return 'Buy Now';
    }
    return $button_text;
}

/**
 * WC: Replace product image gallery with product image
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

add_action( 'woocommerce_before_single_product_summary', 'custom_show_main_product_image_only', 20 );
function custom_show_main_product_image_only() {
    global $product;

    $main_image_id = $product->get_image_id();

    if ( $main_image_id ) {
		echo '<div class="product__image-container" style="background-image: url('. wp_get_attachment_url( $main_image_id, 'full' ) .');"></div>';
        // echo wp_get_attachment_image( $main_image_id, 'large' );
    }
}

/** 
 * WC: Product Features: Only allow text to be selected in first row
 */

 function custom_acf_admin_js() {
    ?>
    <script type="text/javascript">
        (function($){
            // Check if we're on the ACF edit page
            $(document).ready(function() {
                // Hide "custom text" option for all rows except the first one
                $('.acf-field-'.concat('feature_display_type')).each(function(index, field){
                    if (index > 0) { // Hide the option for all rows except the first one
                        $(field).find('select option[value="custom_text"]').hide();
                    }
                });

                // Trigger event when a new row is added (in case it is dynamically created)
                $(document).on('click', '.acf-row .acf-actions .add-row', function() {
                    // Check and hide "custom text" in new rows as well
                    setTimeout(function(){
                        $('.acf-field-'.concat('feature_display_type')).each(function(index, field){
                            if (index > 0) {
                                $(field).find('select option[value="custom_text"]').hide();
                            }
                        });
                    }, 200);
                });
            });
        })(jQuery);
    </script>
    <?php
}
add_action('acf/input/admin_footer', 'custom_acf_admin_js');

/** 
 * WC: Add product tags below title in single product title
 */

 add_action( 'woocommerce_single_product_summary', 'custom_display_product_tags_below_title', 6 );
 function custom_display_product_tags_below_title() {
	 global $product;
	 $tags = get_the_terms( $product->get_id(), 'product_tag' );
 
	 if ( $tags && ! is_wp_error( $tags ) ) {
		 echo '<div class="product-tags">';
		 foreach ( $tags as $tag ) {
			 $tag_link = get_term_link( $tag );
			 if ( ! is_wp_error( $tag_link ) ) {
				 echo '<a href="' . esc_url( $tag_link ) . '" class="pill">' . esc_html( $tag->name ) . '</a> ';
			 }
		 }
		 echo '</div>';
	 }
 }

/** 
 * WC: Remove breadcrumbs
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/** 
 * WC: Add new container inside single product pages
 */

function custom_single_product_division_open() {
    if ( is_product() ) {
        echo '<div class="product-container">'; // This will wrap around the image and summary
    }
}
add_action( 'woocommerce_before_single_product_summary', 'custom_single_product_division_open', 5 );

function custom_single_product_division_close() {
    if ( is_product() ) {
        echo '</div>'; // Closing the wrapper
    }
}
add_action( 'woocommerce_after_single_product_summary', 'custom_single_product_division_close', 15 );

/**
 * WC: Add container around product summary
 */

add_action( 'woocommerce_before_single_product_summary', 'custom_entry_summary_wrapper_open', 29 );
function custom_entry_summary_wrapper_open() {
    echo '<div class="product__summary">';
}

add_action( 'woocommerce_after_single_product_summary', 'custom_entry_summary_wrapper_close', 1 );
function custom_entry_summary_wrapper_close() {
    echo '</div>';
}

/** 
 * WC: Change duration select from "Choose an option" to "Select"
 */

 add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'custom_dropdown_option_text' );
 function custom_dropdown_option_text( $args ) {
	 $args['show_option_none'] = 'Select'; // Change this to your desired text
	 return $args;
 }
 
 /** 
  * Load gravity forms in ACF select
  */

  add_filter('acf/load_field/name=form_selector', function ($field) {
    if (class_exists('GFAPI')) {
        $forms = GFAPI::get_forms();
        $choices = [];

        foreach ($forms as $form) {
            $choices[$form['id']] = $form['title'];
        }

        $field['choices'] = $choices;
    }

    return $field;
});

/**
 * Gravity Forms: remove default styles.
 */
add_filter( 'gform_disable_css', '__return_true' );

/**
 * Gravity Forms: Custom select
 */

 add_action('wp_footer', function () {
    ?>
    <script>
// (function () {
//   function initCustomSelects() {
//     document.querySelectorAll('.gfield.custom-select').forEach(gfield => {
//       const select = gfield.querySelector('select');
//       if (!select || select.dataset.enhanced) return;

//       select.dataset.enhanced = 'true';
//       select.style.display = 'none';

//       const wrapper = document.createElement('div');
//       wrapper.className = 'gf-custom-select-wrapper';

//       const display = document.createElement('div');
//       display.className = 'gf-custom-select';
//       const placeholder = select.options[0]?.text || 'Select an option';
//       display.textContent = select.value ? select.options[select.selectedIndex]?.text : placeholder;

//       const optionsList = document.createElement('div');
//       optionsList.className = 'gf-custom-options';

//       // Start from index 1 to skip placeholder
//       Array.from(select.options).forEach((option, index) => {
//         if (index === 0) return; // Skip "Select one…" in dropdown

//         const opt = document.createElement('div');
//         opt.className = 'gf-custom-option';
//         opt.textContent = option.text;
//         opt.dataset.value = option.value;

//         if (select.value === option.value) {
//           opt.classList.add('selected');
//         }

//         opt.addEventListener('click', () => {
//           select.value = opt.dataset.value;
//           display.textContent = opt.textContent;

//           // Update selected class
//           optionsList.querySelectorAll('.gf-custom-option').forEach(o => o.classList.remove('selected'));
//           opt.classList.add('selected');

//           optionsList.classList.remove('open');
//           display.classList.remove('select--active');
//           select.dispatchEvent(new Event('change'));
//         });

//         optionsList.appendChild(opt);
//       });

//       display.addEventListener('click', () => {
//         const isOpen = optionsList.classList.toggle('open');
//         display.classList.toggle('select--active', isOpen);
//       });

//       document.addEventListener('click', (e) => {
//         if (!wrapper.contains(e.target)) {
//           optionsList.classList.remove('open');
//           display.classList.remove('select--active');
//         }
//       });

//       wrapper.appendChild(display);
//       wrapper.appendChild(optionsList);

//       const container = select.closest('.ginput_container');
//       if (container) {
//         container.appendChild(wrapper);
//       }
//     });
//   }

//   document.addEventListener('DOMContentLoaded', initCustomSelects);
//   if (window.gform) {
//     gform.addAction('gform_post_render', initCustomSelects);
//   }
// })();
(function () {
  function initCustomSelects() {
    document.querySelectorAll('.gfield.custom-select').forEach(gfield => {
      const select = gfield.querySelector('select');
      if (!select || select.dataset.enhanced) return;

      select.dataset.enhanced = 'true';
      select.style.display = 'none';

      const wrapper = document.createElement('div');
      wrapper.className = 'gf-custom-select-wrapper';

      const display = document.createElement('div');
      display.className = 'gf-custom-select';

      const optionsList = document.createElement('div');
      optionsList.className = 'gf-custom-options';

      // Helper: Update display text and classes
      function updateDisplay() {
        const selectedOption = select.options[select.selectedIndex];
        display.textContent = selectedOption?.text || 'Select an option';

        if (select.value) {
          display.classList.remove('placeholder');
          display.classList.add('selected');
        } else {
          display.classList.remove('selected');
          display.classList.add('placeholder');
        }
      }

      // Helper: Build options list
      function buildOptions() {
        optionsList.innerHTML = ''; // Clear previous

        Array.from(select.options).forEach(option => {
          const opt = document.createElement('div');
          opt.className = 'gf-custom-option';
          opt.textContent = option.text;
          opt.dataset.value = option.value;

          if (select.value === option.value) {
            opt.classList.add('selected');
          }

          opt.addEventListener('click', () => {
            select.value = opt.dataset.value;
            updateDisplay();
            buildOptions(); // Rebuild to update selected class
            select.dispatchEvent(new Event('change'));
            optionsList.classList.remove('open');
            display.classList.remove('select--active');
          });

          // Do not include the placeholder option in dropdown
          if (option.value !== '') {
            optionsList.appendChild(opt);
          }
        });
      }

      // Initial setup
      updateDisplay();
      buildOptions();

      // Toggle dropdown
      display.addEventListener('click', () => {
        const isOpen = optionsList.classList.toggle('open');
        display.classList.toggle('select--active', isOpen);
      });

      // Close on outside click
      document.addEventListener('click', (e) => {
        if (!wrapper.contains(e.target)) {
          optionsList.classList.remove('open');
          display.classList.remove('select--active');
        }
      });

      wrapper.appendChild(display);
      wrapper.appendChild(optionsList);

      const container = select.closest('.ginput_container');
      if (container) {
        container.appendChild(wrapper);
      }
    });
  }

  document.addEventListener('DOMContentLoaded', initCustomSelects);
  if (window.gform) {
    gform.addAction('gform_post_render', initCustomSelects);
  }
})();



    </script>
    <?php
});

/**
 * Add excerpts to pages
 */
function add_excerpt_support_to_pages() {
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'add_excerpt_support_to_pages');


/** 
 * Main Menu walker
 */

// class Zuku_Custom_Menu_Walker extends Walker_Nav_Menu {
//     public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
//         $classes = $item->classes;
//         $is_product_card = in_array( 'menu-item-product-card', $classes, true );
//         $is_page_card = in_array( 'menu-item-page-card', $classes, true );

//         if ( $is_product_card || $is_page_card ) {
//             $post = get_post( $item->object_id );
//             if ( $post ) {
//                 $title = esc_html( get_the_title( $post ) );
//                 $image = get_the_post_thumbnail( $post->ID, 'medium' );

//                 $output .= '<li class="' . esc_attr( implode( ' ', $classes ) ) . ' menu-item-card">' . "\n";
//                 $output .= '<div class="menu-card">' . "\n";

//                 // if ( $image ) {
//                 //     $output .= '<div class="menu-card-image">' . $image . '</div>' . "\n";
//                 // }

//             // Open image section
//             $output .= '<div class="menu-card-image">' . "\n";

//             if ( $image ) {
//                 $output .= $image . "\n";
//             }

//             // Add category/tag info inside .menu-card-image
//             if ( $is_product_card && function_exists( 'wc_get_product' ) ) {
//                 $product = wc_get_product( $post->ID );
//                 if ( $product ) {
//                     $categories = get_the_term_list( $post->ID, 'product_cat', '', ', ' );
//                     $tags = get_the_term_list( $post->ID, 'product_tag', '', ', ' );

//                     if ( $categories ) {
//                         $output .= '<div class="menu-card-categories">Categories: ' . $categories . '</div>' . "\n";
//                     }
//                     if ( $tags ) {
//                         $output .= '<div class="menu-card-tags">Tags: ' . $tags . '</div>' . "\n";
//                     }
//                 }
//             }

// 			$output .= '<div class="menu-item__card-arrow"></div>' . "\n";

//             // Close image section
//             $output .= '</div>' . "\n";				

//                 $output .= '<div class="menu-card-title">' . $title . '</div>' . "\n";

//                 // if ( $is_product_card && function_exists( 'wc_get_product' ) ) {
//                 //     $product = wc_get_product( $post->ID );
//                 //     if ( $product ) {
//                 //         $categories = get_the_term_list( $post->ID, 'product_cat', '', ', ' );
//                 //         $tags = get_the_term_list( $post->ID, 'product_tag', '', ', ' );

//                 //         if ( $categories ) {
//                 //             $output .= '<div class="menu-card-categories">Categories: ' . $categories . '</div>' . "\n";
//                 //         }
//                 //         if ( $tags ) {
//                 //             $output .= '<div class="menu-card-tags">Tags: ' . $tags . '</div>' . "\n";
//                 //         }
//                 //     }
//                 // }

//                 $output .= '</div></li>' . "\n";
//                 return; // Skip default output
//             }
//         }

//         // Fallback to default behavior for all other items
//         parent::start_el( $output, $item, $depth, $args, $id );
//     }
// }

/**
 * This one works but layout is whack.
 */
// class Zuku_Custom_Menu_Walker extends Walker_Nav_Menu {
//     private $current_parent_page = null;

//     public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
//         $classes = $item->classes;
//         $is_product_card = in_array( 'menu-item-product-card', $classes, true );
//         $is_page_card = in_array( 'menu-item-page-card', $classes, true );

//         // Capture the parent page if we're at depth 0 and this item has children
//         if ( $depth === 0 && in_array( 'menu-item-has-children', $classes, true ) ) {
//             $this->current_parent_page = null;

//             if ( $item->object === 'page' && $item->object_id ) {
//                 $page = get_post( $item->object_id );
//                 if ( $page ) {
//                     $this->current_parent_page = $page;
//                 }
//             }
//         }

//         // Handle product or page cards
//         if ( $is_product_card || $is_page_card ) {
//             $post = get_post( $item->object_id );
//             if ( $post ) {
//                 $title = esc_html( get_the_title( $post ) );
//                 $image = get_the_post_thumbnail( $post->ID, 'medium' );

//                 $output .= '<li class="' . esc_attr( implode( ' ', $classes ) ) . ' menu-item-card">' . "\n";
//                 $output .= '<div class="menu-card">' . "\n";

//                 if ( $image ) {
//                     $output .= '<div class="menu-card-image">' . $image . '</div>' . "\n";
//                 }

//                 $output .= '<div class="menu-card-title">' . $title . '</div>' . "\n";

//                 if ( $is_product_card && function_exists( 'wc_get_product' ) ) {
//                     $product = wc_get_product( $post->ID );
//                     if ( $product ) {
//                         $categories = get_the_term_list( $post->ID, 'product_cat', '', ', ' );
//                         $tags = get_the_term_list( $post->ID, 'product_tag', '', ', ' );

//                         if ( $categories ) {
//                             $output .= '<div class="menu-card-categories">Categories: ' . $categories . '</div>' . "\n";
//                         }
//                         if ( $tags ) {
//                             $output .= '<div class="menu-card-tags">Tags: ' . $tags . '</div>' . "\n";
//                         }
//                     }
//                 }

//                 $output .= '</div></li>' . "\n";
//                 return; // Skip default behavior
//             }
//         }

//         // Fallback to default rendering
//         parent::start_el( $output, $item, $depth, $args, $id );
//     }

//     public function start_lvl( &$output, $depth = 0, $args = null ) {
//         $indent = str_repeat( "\t", $depth );
//         $output .= "\n$indent<div class=\"sub-menu-wrapper\">\n";

//         // At depth 1 (child of root), add title/excerpt if we have a stored parent page
//         if ( $depth === 0 && $this->current_parent_page instanceof WP_Post ) {
//             $title   = esc_html( get_the_title( $this->current_parent_page ) );
//             $excerpt = esc_html( get_the_excerpt( $this->current_parent_page ) );

//             $output .= "$indent\t<div class=\"sub-menu-wrapper__header\">\n";
//             $output .= "$indent\t\t<h3 class=\"menu-prepend-item title-item\">$title</h3>\n";
//             $output .= "$indent\t\t<p class=\"menu-prepend-item excerpt-item\">$excerpt</p>\n";
//             $output .= "$indent\t</div>\n";
//         }

//         $output .= "$indent\t<ul class=\"sub-menu\">\n";
//     }

//     public function end_lvl( &$output, $depth = 0, $args = null ) {
//         $indent = str_repeat( "\t", $depth );
//         $output .= "$indent\t</ul>\n";
//         $output .= "$indent</div>\n";
//     }
// }


/** 
 * Pre-populate mega menu with page links
 */

 add_filter('acf/load_field/name=menu_item', function ($field) {
    $menu = wp_get_nav_menu_object('main-menu'); // Adjust as needed

    if (!$menu) {
        return $field;
    }

    $menu_items = wp_get_nav_menu_items($menu->term_id);

    if (empty($menu_items)) {
        return $field;
    }

    $field['choices'] = [];

    foreach ($menu_items as $item) {
        $field['choices'][$item->ID] = $item->title;
    }

    return $field;
});

/**
 * Customer nav walker for mega menu
 */

class Walker_Nav_Menu_MegaMenu extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        // Default menu item output
        $item_output = '';

        // Get mega menu config from options
        $mega_menus = get_field('mega_menus', 'option');
		
		
		// Add 'has-mega-menu' class if this item has a corresponding mega menu
		if ($mega_menus) {
			foreach ($mega_menus as $mega) {
				if ((int)$item->ID === (int)$mega['menu_item']) {
					$item->classes[] = 'has-mega-menu';
					break;
				}
			}
		}

        // Determine current URL
        $current_url = home_url(add_query_arg([], $_SERVER['REQUEST_URI']));
        $matched = false;

        // Collect all URLs from the mega menu to compare
        $child_urls = [];

        if (!empty($mega_menus)) {
            foreach ($mega_menus as $mega) {
                if ((int)$item->ID === (int)$mega['menu_item']) {

                    // Collect URLs from text_links
                    if (!empty($mega['text_links'])) {
                        foreach ($mega['text_links'] as $link_row) {
                            $link = $link_row['text_link'];
                            if ($link && isset($link['url'])) {
                                $child_urls[] = trailingslashit($link['url']);
                            }
                        }
                    }

                    // Collect URLs from card_links
                    if (!empty($mega['card_links'])) {
                        foreach ($mega['card_links'] as $card_row) {
                            $post = $card_row['card_link'];
                            if (!$post) continue;

                            $post_id = is_object($post) ? $post->ID : $post;
                            $permalink = get_permalink($post_id);
                            $child_urls[] = trailingslashit($permalink);
                        }
                    }

                    break;
                }
            }
        }

        // Check if current URL matches any child URL
        foreach ($child_urls as $url) {
            if (trailingslashit($current_url) === $url) {
                $item->classes[] = 'current-menu-ancestor';
                break;
            }
        }		

        $classes = implode(' ', $item->classes);
        $title = apply_filters('the_title', $item->title, $item->ID);
        $url = esc_url($item->url);

        $item_output .= '<li class="' . esc_attr($classes) . '">';
        $item_output .= '<a href="' . $url . '">' . esc_html($title) . '</a>';


	

        if ($mega_menus) {
            foreach ($mega_menus as $mega) {

                if ((int)$item->ID === (int)$mega['menu_item']) {
					$item->classes[] = 'has-mega-menu';

                    // Found matching mega menu row
                    // $page = $mega['top-level_page'];

					$menu_title = $mega['menu_title'];
					$menu_excerpt = $mega['menu_excerpt'];

                    // if ($page) {
					$item_output .= '<div class="mega-menu">';
					$item_output .= '<button class="mega-menu__breadcrumb">Menu</button>';
					$item_output .= '<div class="mega-menu__details">';
						$item_output .= '<div class="mega-menu__details-header">';
							$item_output .= '<h2 class="mega-menu__details-header-heading heading-mega-menu">' . esc_html($menu_title) . '</h2>';
							$item_output .= '<p class="mega-menu__details-header-description">' . esc_html($menu_excerpt) . '</p>';
						$item_output .= '</div>';

						// --- Text Links Repeater ---
						if (!empty($mega['text_links'])) {
							$item_output .= '<div class="mega-menu__details-text-links">';
							foreach ($mega['text_links'] as $link_row) {
								$link = $link_row['text_link'];
								if ($link && isset($link['url'], $link['title'])) {
									$item_output .= '<a href="' . esc_url($link['url']) . '" class="mega-menu__details-text-link">' . esc_html($link['title']) . '</a>';
								}
							}
							$item_output .= '</div>';
						}							

						
					$item_output .= '</div>';

						// --- Card Links Repeater (Pages or Products) ---
						if (!empty($mega['card_links'])) {
							$item_output .= '<div class="mega-menu__cards">';
							foreach ($mega['card_links'] as $card_row) {
								$post = $card_row['card_link'];

								if (!$post) continue;

								$post_id = is_object($post) ? $post->ID : $post;
								$post_type = get_post_type($post_id);
								$title = get_the_title($post_id);
								$permalink = get_permalink($post_id);
								$image_url = get_the_post_thumbnail_url($post_id, 'full');

								$term_slug_class = '';

								$product_cats = wp_get_post_terms($post_id, 'product_cat');

								if (!empty($product_cats) && !is_wp_error($product_cats)) {
									$first_cat = $product_cats[0];
									$term_slug_class = ' mega-menu__card--' . sanitize_html_class($first_cat->slug);
								}

								$item_output .= '<a href="' . esc_url($permalink) . '" class="mega-menu__card-group">';
									$item_output .= '<div class="mega-menu__card mega-menu__card--'. $post_type . '' . $term_slug_class . '">';

										$item_output .= '<div class="mega-menu__card-image" style="background-image: url(' . esc_url($image_url ?: '') . ');"></div>';
											// if ($image_url) {
											// 	$item_output .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '">';
											// }
											if ($post_type === 'product') {
												$terms = [];

												// Get product categories and tags
												$product_cats = wp_get_post_terms($post_id, 'product_cat');
												$product_tags = wp_get_post_terms($post_id, 'product_tag');

												if (!is_wp_error($product_cats)) {
													$terms = array_merge($terms, $product_cats);
												}

												if (!is_wp_error($product_tags)) {
													$terms = array_merge($terms, $product_tags);
												}

												if (!empty($terms)) {
													$item_output .= '<ul class="mega-menu-card__terms">';
													foreach ($terms as $term) {
														$term_link = get_term_link($term);
														if (!is_wp_error($term_link)) {
															$item_output .= '<li class="mega-menu__card-term"><span class="pill pill--product">' . esc_html($term->name) . '</span></li>';
														}
													}
													$item_output .= '</ul>';
												}
											}
											$item_output .= '<div class="mega-menu__card-arrow"></div>';		

									$item_output .= '</div>'; // mega-menu__card

									$item_output .= '<div class="mega-menu__card-title">';
										$item_output .= '<h3 class="large-card-subheading">' . esc_html($title) . '</h3>';
									$item_output .= '</div>'; // mega-menu__card-title

								$item_output .= '</a>'; // mega-menu__card-group
							}
							$item_output .= '</div>'; // end mega-menu__cards
						}

					$item_output .= '</div>'; // end mega menu
                    // }

                    break;
                }
            }
        }

        $item_output .= '</li>';

        $output .= $item_output;
    }
}

/**
 * Add class to body with page for page-specific styles
 */

 function add_slug_to_body_class( $classes ) {
	if ( is_singular() ) {
	  global $post;
	  if ( isset( $post->post_name ) ) {
		$classes[] = 'page-' . sanitize_html_class( $post->post_name );
	  }
	}
	return $classes;
  }
  add_filter( 'body_class', 'add_slug_to_body_class' );
  

/**
 * Add class to top-level menu item for current page
 */
add_filter('nav_menu_css_class', function ($classes, $item) {
    if (!is_singular() && !is_page()) {
        return $classes;
    }

    // Get current page ID
    global $post;
    if (!$post) return $classes;

    // Check if this menu item points to an ancestor of the current page
    if ($item->object === 'page') {
        $current_page_id = $post->ID;
        $menu_item_page_id = intval($item->object_id);

        // Check if current page is the same as the menu item
        if ($current_page_id === $menu_item_page_id) {
            $classes[] = 'current-menu-item';
        }
    }

    return $classes;
}, 10, 2);


/**
 * Add captions for media & text
 */

// add_filter('render_block', function ($block_content, $block) {
//     if (
//         $block['blockName'] === 'core/media-text' &&
//         isset($block['attrs']['mediaId'])
//     ) {
//         $attachment_id = $block['attrs']['mediaId'];
//         $caption = wp_get_attachment_caption($attachment_id);

//         if ($caption) {
//             // Wrap image and caption in <figure>
//             $pattern = '#(<div class="wp-block-media-text__media">)(.*?)(</div>)#s';
//             $block_content = preg_replace_callback($pattern, function ($matches) use ($caption) {
//                 return '<div class="wp-block-media-text__media"><figure>' .
//                        $matches[2] .
//                        '<figcaption>' . esc_html($caption) . '</figcaption></figure></div>';
//             }, $block_content);
//         }
//     }

//     return $block_content;
// }, 10, 2);

add_filter('render_block', function ($block_content, $block) {
    if (
        $block['blockName'] === 'core/media-text' &&
        isset($block['attrs']['mediaId'])
    ) {

        $attachment_id = $block['attrs']['mediaId'];
        $caption = wp_get_attachment_caption($attachment_id);

        $block_content = preg_replace(
            '#(<figure class="wp-block-media-text__media">.*?)(</figure>)#s',
            '$1<figcaption>' . esc_html($caption) . '</figcaption>$2',
            $block_content
        );

        return $block_content;
    }

    return $block_content;
}, 10, 2);


/** 
 * Users: Add author title
 */

 // Display the title field on user profile pages
 function custom_user_profile_fields($user) {
    ?>
    <h3>Extra Profile Information</h3>
    <table class="form-table">
        <tr>
            <th><label for="user_title">Title</label></th>
            <td>
                <input type="text" name="user_title" id="user_title" value="<?php echo esc_attr(get_the_author_meta('user_title', $user->ID)); ?>" class="regular-text" /><br />
                <span class="description">Enter the user's professional title (e.g., Editor, Project Manager).</span>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'custom_user_profile_fields');
add_action('edit_user_profile', 'custom_user_profile_fields');

// Save the title value when updated
function save_custom_user_profile_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    update_user_meta($user_id, 'user_title', sanitize_text_field($_POST['user_title']));
}
add_action('personal_options_update', 'save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'save_custom_user_profile_fields');

/**
 * Add author bio headshot in profile
 */

 // Enqueue the JS

 function enqueue_admin_headshot_script($hook) {
    if ($hook === 'profile.php' || $hook === 'user-edit.php') {
        wp_enqueue_media();
        wp_enqueue_script(
            'admin-author-headshot',
            get_template_directory_uri() . '/src/jquery/admin-author-headshot.js',
            ['jquery'],
            null,
            true
        );
    }
}
add_action('admin_enqueue_scripts', 'enqueue_admin_headshot_script');


 // Add a custom field to the user profile for the headshot
function custom_author_headshot_field($user) {
    ?>
    <h3>Author Headshot</h3>
    <table class="form-table">
        <tr>
            <th><label for="author_headshot">Upload Headshot</label></th>
            <td>
                <input type="text" name="author_headshot" id="author_headshot" value="<?php echo esc_url(get_the_author_meta('author_headshot', $user->ID)); ?>" class="regular-text" />
                <input type="button" class="button button-secondary" value="Upload Image" id="upload_headshot_button" />
                <br><small>Paste an image URL or upload a high-resolution headshot.</small>
                <?php if (get_the_author_meta('author_headshot', $user->ID)) : ?>
                    <br><img src="<?php echo esc_url(get_the_author_meta('author_headshot', $user->ID)); ?>" style="max-width:150px; margin-top:10px;">
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'custom_author_headshot_field');
add_action('edit_user_profile', 'custom_author_headshot_field');

// Save the uploaded headshot
function save_author_headshot_field($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'author_headshot', esc_url_raw($_POST['author_headshot']));
}
add_action('personal_options_update', 'save_author_headshot_field');
add_action('edit_user_profile_update', 'save_author_headshot_field');

// Enqueue media uploader for the upload button
function enqueue_admin_scripts($hook) {
    if ('profile.php' !== $hook && 'user-edit.php' !== $hook) {
        return;
    }
    wp_enqueue_media();
    ?>
    <script>
        jQuery(document).ready(function($){
            $('#upload_headshot_button').click(function(e) {
                e.preventDefault();
                var mediaUploader = wp.media({
                    title: 'Upload Author Headshot',
                    button: { text: 'Use this Image' },
                    multiple: false
                }).on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#author_headshot').val(attachment.url);
                }).open();
            });
        });
    </script>
    <?php
}
add_action('admin_enqueue_scripts', 'enqueue_admin_scripts');
