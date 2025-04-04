<?php
/**
 * Enqueue static styles.
 */
add_action('enqueue_block_assets', function () {
    wp_enqueue_style('bluebeechild-static-styles', get_stylesheet_directory_uri() . '/assets/css/static-styles.css');
});

/**
 * Enqueue static styles.
 */
add_action('enqueue_block_assets', function () {
    wp_enqueue_style('bluebeechild-header', get_stylesheet_directory_uri() . '/assets/css/header.css');
});


/**
 * Enqueue static scripts.
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('bluebeechild-frontend-scripts', get_stylesheet_directory_uri() . '/assets/js/frontend-scripts.js');
});

/**
 * Enqueue Gravity Forms stylesheet.
 */
add_action('enqueue_block_assets', function () {
    wp_enqueue_style('bluebeechild-gravity-forms', get_stylesheet_directory_uri() . '/assets/css/vendor/gravity-forms.css');
});

/**
 * Enqueue Greenshift stylesheet.
 */
add_action('enqueue_block_assets', function () {
    wp_enqueue_style('bluebeechild-greenshift', get_stylesheet_directory_uri() . '/assets/css/vendor/greenshift.css');
});