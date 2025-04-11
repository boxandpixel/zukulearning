<?php

/**
 * Plugin Name: m6 Post Types and Taxonomies
 */
defined('ABSPATH') || die;

/**
 * Register Post Types and Taxonomies.
 */
function m6_post_types_and_taxonomies(): void
{
}
add_action('init', 'm6_post_types_and_taxonomies', 10, 0);

/**
 * Get the default labels for a post type based on the supplied
 * singular and plural names.
 *
 * @param string $singularName The singular name of the post type
 * @param string $pluralName   The plural name of the post type
 *
 * @return array The labels for the post type
 */
function m6_get_post_type_labels(
    string $singularName,
    string $pluralName
): array {
    $lowerPluralName = mb_strtolower($pluralName);

    return [
        'name' => $pluralName,
        'singular_name' => $singularName,
        'menu_name' => $pluralName,
        'name_admin_bar' => $singularName,
        'add_new' => 'Add New',
        'add_new_item' => 'Add New '.$singularName,
        'new_item' => 'New '.$singularName,
        'edit_item' => 'Edit '.$singularName,
        'view_item' => 'View '.$singularName,
        'all_items' => 'All '.$pluralName,
        'search_items' => 'Search '.$pluralName,
        'parent_item_colon' => 'Parent '.$pluralName.':',
        'not_found' => 'No '.$lowerPluralName.' found.',
        'not_found_in_trash' => 'No '.$lowerPluralName.' found in Trash.',
    ];
}

/**
 * Get the default labels for a taxonomy based on the supplied
 * singular and plural names.
 *
 * @param string $singularName The singular name of the taxonomy
 * @param string $pluralName   The plural name of the taxonomy
 *
 * @return array The labels for the taxonomy
 */
function m6_get_taxonomy_labels(
    string $singularName,
    string $pluralName
): array {
    return [
        'name' => $pluralName,
        'singular_name' => $singularName,
        'search_items' => 'Search '.$pluralName,
        'all_items' => 'All '.$pluralName,
        'parent_item' => 'Parent '.$singularName,
        'parent_item_colon' => 'Parent '.$singularName.':',
        'edit_item' => 'Edit '.$singularName,
        'update_item' => 'Update '.$singularName,
        'add_new_item' => 'Add New '.$singularName,
        'new_item_name' => 'New '.$singularName.' Name',
        'menu_name' => $pluralName,
    ];
}
