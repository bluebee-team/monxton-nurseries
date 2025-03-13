<?php
require get_template_directory() . '/inc/wp-admin.php';
require get_template_directory() . '/inc/restricting-core.php';
require get_template_directory() . '/inc/patterns.php';
require get_template_directory() . '/inc/blocks.php';
require get_template_directory() . '/inc/helper-functions.php';

require 'vendor/plugin-update-checker/plugin-update-checker.php';

// Automatic update mechanism
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/bluebee-team/bluebeefse',
	__FILE__,
	'bluebeefse'
);

// Set the branch that contains the stable release
$myUpdateChecker->setBranch('main');

// Set the access token
$myUpdateChecker->setAuthentication('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');

/**
 * Allow SVG and WEBP uploads
 */
function bb_additional_upload_mimes($mimes)
{
    $mimes['webp'] = 'image/webp';
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'bb_additional_upload_mimes');

/**
 * Apply scripts from CMS
 * 
 * Defined in Settings > Scripts
 */
function bb_add_to_head()
{
    if( !function_exists( 'get_field' ) ){
        return false;
    }

    $head_scripts = get_field('head', 'custom-scripts');

    if( !$head_scripts ) {
        return false;
    }

    echo $head_scripts;
}
add_action('wp_head', 'bb_add_to_head', PHP_INT_MIN);

function bb_add_to_body()
{
    if( !function_exists( 'get_field' ) ){
        return false;
    }

    $body_scripts = get_field('body', 'custom-scripts');

    if( !$body_scripts ) {
        return false;
    }

    echo $body_scripts;
}
add_action('wp_body_open', 'bb_add_to_body');

function bb_add_to_footer()
{
    if( !function_exists( 'get_field' ) ){
        return false;
    }

    $footer_scripts = get_field('footer', 'custom-scripts');

    if( !$footer_scripts ) {
        return false;
    }

    echo $footer_scripts;
}
add_action('wp_footer', 'bb_add_to_footer');

/**
 * Remove Admin Bar from front end
 */
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
    if (!is_admin()) {
        show_admin_bar(false);
    }
}

/**
 * Enqueue Icomoon stylesheet.
 */
add_action('enqueue_block_assets', function () {
    wp_enqueue_style('bb-icomoon', get_template_directory_uri() . '/assets/css/blocks/vendor/icomoon.css');
});

/**
 * Enqueue Gravity Forms stylesheet.
 */
add_action('enqueue_block_assets', function () {
    wp_enqueue_style('bb-gravity-forms', get_template_directory_uri() . '/assets/css/blocks/vendor/gravity-forms.css');
});

function enqueue_gform_basic_style() {
    // Temporary fix until Gravity Forms supports FSE fully.
    wp_enqueue_style('gform_basic');
}
add_action('enqueue_block_assets', 'enqueue_gform_basic_style');

/**
 * Enqueue general helper classes stylesheet.
 */
add_action('enqueue_block_assets', function () {
    wp_enqueue_style('bb-helper-classes', get_template_directory_uri() . '/assets/css/helper-classes.css');
});

/**
 * Enqueue static styles stylesheet.
 */
add_action('enqueue_block_assets', function () {
    wp_enqueue_style('bb-static-styles', get_template_directory_uri() . '/assets/css/static-styles.css');
});

/**
 * Usage: 
 * <!-- wp:image {"id":129,"aspectRatio":"1","scale":"cover","style":{"color":[]}} -->
 * <figure class="wp-block-image"><img src="<?php bb_theme_asset("file.svg"); ?>" alt="" class="wp-image-129" style="aspect-ratio:1;object-fit:cover"/></figure>
 * <!-- /wp:image -->
 * Note: please make sure the filename is in the assets/images directory for either the base or child theme.
 */
function bb_theme_asset($asset) {
    // Define the paths
    $child_theme_directory = get_stylesheet_directory() . '/assets/' . $asset;
    $parent_theme_directory = get_template_directory() . '/assets/' . $asset;

    // Check if the file exists in the child theme directory
    if (file_exists($child_theme_directory)) {
        // If it exists, return the URL from the child theme directory
        echo get_stylesheet_directory_uri() . '/assets/' . $asset;
    } 
    // Check if the file exists in the parent theme directory
    elseif (file_exists($parent_theme_directory)) {
        // If it exists, return the URL from the parent theme directory
        echo get_template_directory_uri() . '/assets/' . $asset;
    } 
    // If the image is not found in either directory, handle the error
    else {
        // Echo a default image URL or a placeholder
        echo '';
    }
}