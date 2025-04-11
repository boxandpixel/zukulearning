<?php

/**
 * Plugin Name: m6 Maps
 */
defined('ABSPATH') || die;

/**
 * Get the site's google maps key.
 *
 * @return string The site's google maps key
 */
function m6_get_gmaps_key(): string
{
    // phpcs:disable Generic.Files.LineLength.TooLong

    // Use the M6 company key in local and dev environments.
    if (getenv('M6_ENV') === 'loc'
        || getenv('M6_ENV') === 'dev'
    ) {
        return 'AIzaSyA2zFoyh-2zNhspbZ1B_E4tfDYYTRkM-GQ';
    }

    // If a key is set in the theme config use it.
    if (function_exists('get_field')) {
        $optionKey = get_field('google_maps_api_key', 'options');

        if (is_string($optionKey)
            && $optionKey !== ''
        ) {
            return $optionKey;
        }
    }

    return '';
}

/**
 * Enqueue the google maps api include with the site's key.
 */
function m6_register_maps_api(): void
{
    // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
    wp_register_script(
        'm6-googlemaps',
        'https://maps.googleapis.com/maps/api/js?key='.m6_get_gmaps_key(),
        false,
        null,
        false
    );
}
add_action('wp_enqueue_scripts', 'm6_register_maps_api', 0);

/**
 * Get the site's map box key.
 *
 * @return string The site's map box key
 */
function m6_get_mapbox_key(): string
{
    // phpcs:disable Generic.Files.LineLength.TooLong

    // Use the M6 company key in local and dev environments.
    if (getenv('M6_ENV') === 'loc'
        || getenv('M6_ENV') === 'dev'
    ) {
        return 'pk.eyJ1IjoiYWxhbm1pbGU2IiwiYSI6ImNqdm80dDh5dTF2M2M0OG9qdWI1OHpjbXQifQ.-05Th746mebRVGesXaZy3g';
    }

    // If a key is set in the theme config use it.
    if (function_exists('get_field')) {
        $optionKey = get_field('mapbox_api_key', 'options');

        if (is_string($optionKey)
            && $optionKey !== ''
        ) {
            return $optionKey;
        }
    }

    return '';
}

/**
 * Takes an ACF Location field and a zoom level and
 * eturns a google maps embed url.
 *
 * @param array $location The map ACF location data
 * @param int   $zoom     The map zoom level
 *
 * @return string The google maps embed url
 */
function m6_get_gmap_embed_url(
    ?array $location,
    ?int $zoom = 15
): string {
    if (empty($location)) {
        return '';
    }

    if (empty($zoom)) {
        $zoom = 15;
    }

    $address = '';
    if (!empty($location['address'])) {
        $address = $location['address'];
    } elseif (!empty($location['lat']) && !empty($location['lng'])) {
        $address = $location['lat'].','.$location['lng'];
    }

    if ($address === '') {
        return '';
    }

    $qsVars = [
        'q' => $address,
        'zoom' => $zoom,
        'key' => m6_get_gmaps_key(),
    ];

    $qs = http_build_query($qsVars, null, '&', PHP_QUERY_RFC3986);

    $url = 'https://www.google.com/maps/embed/v1/place?'.$qs;

    return $url;
}

/**
 * Get the latitude and longitude coordinates of a zip code.
 *
 * @param wpdb   $wpdb The WordPress database object
 * @param string $zip  The zip to get coordinates for
 *
 * @return stdClass The coordinates of the supplied zip code
 */
function m6_get_zip_coords(
    wpdb $wpdb, // phpcs:ignore WordPress.DB.DirectDatabaseQuery
    string $zip
): ?stdClass {
    $results = $wpdb->get_results($wpdb->prepare(
        '
        SELECT
            wp_m6_zip_codes.latitude,
            wp_m6_zip_codes.longitude
        FROM wp_m6_zip_codes
        WHERE wp_m6_zip_codes.zip = %s
        LIMIT 1
        ',
        $zip
    ));

    if (is_array($results) === false || !$results) {
        return null;
    }

    return $results[0];
}

/**
 * Get the latitude and longitude coordinates of a zip code.
 *
 * @param wpdb     $wpdb   The WordPress database object
 * @param stdClass $coords The zip to get coordinates for
 * @param float    $radius The radius to search
 *
 * @return array The found locations
 */
function m6_get_zips_within_radius(
    wpdb $wpdb, // phpcs:ignore WordPress.DB.DirectDatabaseQuery
    stdClass $coords,
    float $radius
): ?array {
    $results = $wpdb->get_results($wpdb->prepare(
        '
        SELECT wp_m6_zip_codes.zip
        FROM wp_m6_zip_codes
        WHERE
            CAST((SELECT
                IFNULL(
                    3959 *
                    ACOS(
                        COS(RADIANS(CAST(%s as DECIMAL(10,7)))) *
                        COS(RADIANS(`wp_m6_zip_codes`.`latitude`)) *
                        COS(RADIANS(`wp_m6_zip_codes`.`longitude`) -
                        RADIANS(CAST(%s as DECIMAL(10,7)))) +
                        SIN(RADIANS(CAST(%s as DECIMAL(10,7)))) *
                        SIN(RADIANS(`wp_m6_zip_codes`.`latitude`))
                    ),0
                )
            ) AS DECIMAL(10,7)) <= CAST(%s as DECIMAL(10,7))
        ',
        (string) $coords->latitude,
        (string) $coords->longitude,
        (string) $coords->latitude,
        (string) $radius
    ));

    if (is_array($results) === false || !$results) {
        return [];
    }

    $zipCodes = [];
    foreach ($results as $result) {
        $zipCodes[] = $result->zip;
    }

    $zipCodes = array_unique($zipCodes);

    return $zipCodes;
}
