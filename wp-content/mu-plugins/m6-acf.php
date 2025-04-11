<?php

/**
 * Plugin Name: m6 ACF
 */
defined('ABSPATH') || die;

/**
 * Alter the save point for ACF JSON.
 *
 * @param string $path The default save path
 *
 * @return string The overridden save path
 */
function m6_acf_json_save_point(string $path): string
{
    $path = __DIR__.'/acf-json';

    return $path;
}
add_filter('acf/settings/save_json', 'm6_acf_json_save_point');

/**
 * Alter the load point for ACF JSON.
 *
 * @param array $paths The default load paths
 *
 * @return array The load paths with the default removed
 *               and custom save path added
 */
function m6_acf_json_load_point(array $paths): array
{
    // remove original path (optional)
    unset($paths[0]);

    // append path
    $paths[] = m6_acf_json_save_point('');

    return $paths;
}
add_filter('acf/settings/load_json', 'm6_acf_json_load_point');

/**
 * Determine whether or not to show the ACF Admin Menu Items.
 *
 * @param bool $show The default show state
 *
 * @return bool The overridden show state
 */
function m6_acf_show_admin(bool $show): bool
{
    // Always show the menu in local and dev environments.
    if (getenv('M6_ENV') === 'loc'
        // || getenv('M6_ENV') === 'dev'
    ) {
        return $show;
    }

    // Get the current admin user.
    $user = wp_get_current_user();

    // Never show the menu to non admins.
    if ($user instanceof WP_User === false
        || current_user_can('manage_options') === false
    ) {
        return false;
    }

    // Only show the menu to mile6 people.
    // if (mb_strpos($user->user_email, '@mile6.com') !== false) {
    //     return $show;
    // }

    return $show;
}
add_filter('acf/settings/show_admin', 'm6_acf_show_admin');

/**
 * ACF Theme Options.
 */
function m6_acf_add_options_page(): void
{
    if (function_exists('acf_add_options_page') === false
        || function_exists('acf_add_options_sub_page') === false
    ) {
        return;
    }

    // Main Theme Settings Page
    $parent = acf_add_options_page([
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'redirect' => 'Theme Settings',
    ]);

    // Employer Settings Page
    $parent = acf_add_options_page([
        'page_title' => 'Employer Settings',
        'menu_title' => 'Employer Settings',
        'redirect' => 'Employer Settings',
    ]);
}
add_action('acf/init', 'm6_acf_add_options_page', 10, 3);

/**
 * Set the google maps api key ACF should use.
 */
function m6_acf_set_gmaps_key(): void
{
    if (function_exists('acf_update_setting') === false) {
        return;
    }

    $gmapsKey = '';

    if (function_exists('m6_get_gmaps_key') === true) {
        $gmapsKey = m6_get_gmaps_key();
    }

    if (is_string($gmapsKey) === false
        || $gmapsKey === ''
    ) {
        return;
    }

    acf_update_setting(
        'google_api_key',
        $gmapsKey
    );
}
add_action('acf/init', 'm6_acf_set_gmaps_key');
