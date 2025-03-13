<?php

/**
 * Blue Bee FSE: Restricting Core
 *
 * This file contains functions that work to limit some of the defaults from Core.
 * This is done to provide a more streamlined experience for Blue Bee clients by
 * making this theme easier to edit within the confines of the design language.
 *
 * @since Blue Bee FSE 1.0
 */

/**
 * Remove WordPress Core patterns
 */
add_action('after_setup_theme', 'themeslug_remove_core_patterns');

function themeslug_remove_core_patterns()
{
    remove_theme_support('core-block-patterns');
}

/**
 * Prevent loading Patterns Directory in UI (https://wordpress.org/patterns/)
 */
add_filter('should_load_remote_block_patterns', '__return_false');

/**
 * Prevent loading Open Verse media
 */
add_filter('block_editor_settings_all', function ($settings) { $settings['enableOpenverseMediaCategory'] = false; return $settings;}, 10);

/**
 * Remove "Really Simple Discover" (used for integrations such as Flickr)
 */
remove_action('wp_head', 'rsd_link');

/**
 * Remove "Windows Live Writer"
 */
remove_action('wp_head', 'wlwmanifest_link');

/**
 * Remove WP version number
 */
remove_action('wp_head', 'wp_generator');

/**
 * Set max srcset image width to the width of the image added
 */
add_filter('max_srcset_image_width', 'bb_set_max_srcset_image_width', 10, 2);
function bb_set_max_srcset_image_width($max_width, $size_array)
{
    $width = $size_array[0];

    $max_width = $width;

    return $max_width;
}

/**
 * Redirect attachment url to parent or home
 */
add_action('template_redirect', 'bb_redirect_attachment_page');
function bb_redirect_attachment_page()
{
    if (is_attachment()) {
        global $post;
        if ($post && $post->post_parent) {
            wp_redirect(esc_url(get_permalink($post->post_parent)), 301);
            exit;
        } else {
            wp_redirect(esc_url(home_url('/')), 301);
            exit;
        }
    }
}

/**
 * Remove comments
 */
// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);
// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});
// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});