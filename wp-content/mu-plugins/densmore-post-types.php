<?php

/**
 * Plugin Name: surgent Post Types and Taxonomies
 */
defined('ABSPATH') || die;

/**
 * Register Post Types and Taxonomies.
 */
function surgent_post_types_and_taxonomies(): void
{
    // Example Post Type.
    // -------------------------------------------------------------------------
    // register_post_type(
    //     'example',
    //     [
    //         'labels' => m6_get_post_type_labels(
    //             'Example',
    //             'Examples'
    //         ),
    //         'exclude_from_search' => false,
    //         'has_archive' => true,
    //         'hierarchical' => false,
    //         'menu_icon' => 'dashicons-text-page',
    //         'menu_position' => 20,
    //         'public' => true,
    //         'publicly_queryable' => true,
    //         'rewrite' => [
    //             'slug' => 'examples',
    //             'with_front' => false,
    //         ],
    //         'supports' => [
    //             'editor',
    //             'excerpt',
    //             'page-attributes',
    //             'thumbnail',
    //             'title',
    //         ],
    //     ]
    // );

    // Example Category Taxonomy.
    // -------------------------------------------------------------------------
    // register_taxonomy(
    //     'example-category',
    //     [
    //         'example',
    //     ],
    //     [
    //         'labels' => m6_get_taxonomy_labels(
    //             'Example Category',
    //             'Example Categories'
    //         ),
    //         'hierarchical' => false,
    //         'public' => true,
    //         'publicly_queryable' => true,
    //         'query_var' => true,
    //         'rewrite' => [
    //             'slug' => 'example-categories',
    //             'with_front' => false,
    //         ],
    //         'show_admin_column' => true,
    //     ]
    // );
}
add_action('init', 'surgent_post_types_and_taxonomies', 10, 0);
