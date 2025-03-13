<?php
/**
 * Register theme-defined block style variations
 */
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function bb_enqueue_block_style_variations() {
    $block_style_variations = array(
        array(
            'handle' => 'core-details',
            'block_js' => 'core-details.js'
        ),
        array(
            'handle' => 'core-post-template',
            'block_js' => 'core-post-template.js'
        )
    );

    foreach( $block_style_variations as $block_style_variation ){
        wp_enqueue_script(
            $block_style_variation['handle'],
            get_template_directory_uri() . '/assets/js/style-variations/' .$block_style_variation['block_js'],
            array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' )
        );
    }
}
add_action( 'enqueue_block_editor_assets', 'bb_enqueue_block_style_variations' );

/**
 * Make sure block assets are only loaded if block rendered.
 */
wp_should_load_separate_core_block_assets(true);

/**
 * Enqueue custom block stylesheet(s).
 */
function bb_enqueue_block_styles()
{
    $block_styles = array(
        array(
            'block_name' => 'core/navigation',
            'args' => array(
                'handle' => 'bb-custom-navigation-styles',
                'src'    => get_template_directory_uri() . '/assets/css/blocks/core/navigation.css',
                'path'   => get_template_directory_uri() . '/assets/css/blocks/core/navigation.css',
            )
        ),
        array(
            'block_name' => 'core/categories-list',
            'args' => array(
                'handle' => 'bb-custom-categories-list-styles',
                'src'    => get_template_directory_uri() . '/assets/css/blocks/core/categories-list.css',
                'path'   => get_template_directory_uri() . '/assets/css/blocks/core/categories-list.css',
            )
        ),
        array(
            'block_name' => 'core/image',
            'args' => array(
                'handle' => 'bb-custom-image-styles',
                'src'    => get_template_directory_uri() . '/assets/css/blocks/core/image.css',
                'path'   => get_template_directory_uri() . '/assets/css/blocks/core/image.css',
            )
        ),
        array(
            'block_name' => 'core/search',
            'args' => array(
                'handle' => 'bb-custom-search-styles',
                'src'    => get_template_directory_uri() . '/assets/css/blocks/core/search.css',
                'path'   => get_template_directory_uri() . '/assets/css/blocks/core/search.css',
            )
        ),array(
            'block_name' => 'core/social-links',
            'args' => array(
                'handle' => 'bb-custom-social-styles',
                'src'    => get_template_directory_uri() . '/assets/css/blocks/core/social-links.css',
                'path'   => get_template_directory_uri() . '/assets/css/blocks/core/social-links.css',
            )
        ),
        array(
            'block_name' => 'core/details',
            'args' => array(
                'handle' => 'bb-custom-details-styles',
                'src'    => get_template_directory_uri() . '/assets/css/blocks/core/details.css',
                'path'   => get_template_directory_uri() . '/assets/css/blocks/core/details.css',
            )
        ),
        array(
            'block_name' => 'core/post-template',
            'args' => array(
                'handle' => 'bb-custom-post-template-styles',
                'src'    => get_template_directory_uri() . '/assets/css/blocks/core/post-template.css',
                'path'   => get_template_directory_uri() . '/assets/css/blocks/core/post-template.css',
            )
        ),
        array(
            'block_name' => 'core/site-logo',
            'args' => array(
                'handle' => 'bb-custom-site-logo-styles',
                'src'    => get_template_directory_uri() . '/assets/css/blocks/core/site-logo.css',
                'path'   => get_template_directory_uri() . '/assets/css/blocks/core/site-logo.css',
            )
        )
    );

    foreach ($block_styles as $block_style) {
        wp_enqueue_block_style($block_style['block_name'], $block_style['args']);
    }
}
add_action('after_setup_theme', 'bb_enqueue_block_styles');

function bb_sidebar_opacity_block() {
    // Get the current WordPress version
    $wp_version = get_bloginfo('version');
    
    // Check if the version is 6.6 or higher
    if (version_compare($wp_version, '6.6', '>=')) {
        
        // Enqueue the script if the version is 6.6 or higher due to issues with wp-scripts not correctly building the JSX for older versions
        wp_register_script(
            'bluebeefse-custom',
            get_template_directory_uri() . '/blocks/custom/sidebar-opacity/build/index.js',
            [ 'wp-blocks', 'wp-dom', 'wp-api', 'wp-core-data', 'wp-dom-ready', 'wp-edit-post' ]
        );
        wp_enqueue_script( 'bluebeefse-custom' );
    }
}
add_action('enqueue_block_editor_assets', 'bb_sidebar_opacity_block', 20);