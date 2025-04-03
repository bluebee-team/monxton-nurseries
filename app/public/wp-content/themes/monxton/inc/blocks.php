<?php
/**
 * Make sure block assets are only loaded if block is rendered.
 */
wp_should_load_separate_core_block_assets(true);

/**
 * Enqueue custom block stylesheets
 */
function bluebeechild_enqueue_block_styles()
{
    $block_styles_dir = get_stylesheet_directory() . '/assets/css/blocks';

    $block_styles = array();

    // Check if the directory exists
    if (is_dir($block_styles_dir)) {
        // Iterate over files in the directory
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($block_styles_dir));

        foreach ($iterator as $file) {
            // Ensure we're adding only .css files
            if ($file->isFile() && pathinfo($file->getFilename(), PATHINFO_EXTENSION) === 'css') {
                // Get the directory name immediately enclosing the .css file
                $relative_path = str_replace($block_styles_dir . DIRECTORY_SEPARATOR, '', $file->getPath());
                $parent_dir = basename($relative_path);

                // Add to $block_styles if the directory is not 'blocks'
                if ($parent_dir !== 'blocks') {
                    $block_styles[] = $parent_dir . '/' . $file->getFilename();
                }
            }
        }
    }

    // Enqueue block styles
    foreach ($block_styles as $block_style) {
        // Extract handle and source from $block_style
        $path_parts = explode('/', $block_style);
        $parent_dir = $path_parts[0];
        $filename = $path_parts[1];
        $handle = 'bluebeechild-custom-' . pathinfo($filename, PATHINFO_FILENAME); // Create a handle without the .css extension
        $src = get_stylesheet_directory_uri() . '/assets/css/blocks/' . $parent_dir . '/' . $filename;

        wp_enqueue_block_style($parent_dir . '/' . pathinfo($filename, PATHINFO_FILENAME), array(
            'handle' => $handle,
            'src' => $src,
        ));
    }
}
add_action('after_setup_theme', 'bluebeechild_enqueue_block_styles');

/**
 * Register block style variations
 */
function bluebeechild_register_block_style_variations() {
    wp_enqueue_script(
        'bluebeechild-register-styles',
        get_stylesheet_directory_uri() . '/assets/js/register-style-variations.js',
        array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
        null,
        true
    );
}
add_action( 'enqueue_block_editor_assets', 'bluebeechild_register_block_style_variations' );

/**
 * Unregister block style variations
 */
function bluebeechild_unregister_block_style_variations() {
    wp_enqueue_script(
        'bluebeechild-unregister-styles',
        get_stylesheet_directory_uri() . '/assets/js/unregister-style-variations.js',
        array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
        null,
        true
    );
}
add_action( 'enqueue_block_editor_assets', 'bluebeechild_unregister_block_style_variations' );

/**
 * Register theme-defined blocks
 *
 * This function scans through the {theme}/blocks directory and registers each block based on its subdirectory name
 */
function bluebeechild_register_acf_blocks(): void
{
    $blocks_dir = get_stylesheet_directory() . '/blocks';

    if (!is_dir($blocks_dir)) {
        return;
    }

    $scan = scandir($blocks_dir);
    foreach ($scan as $file) {
        if (is_dir($blocks_dir . "/" . $file) && strpos($file, '.') === false) {
            register_block_type($blocks_dir . "/" . $file);
        }
    }
}
add_action('init', 'bluebeechild_register_acf_blocks');

/**
 * Remove ACF InnerBlocks container (front-end only)
 */
add_filter( 'acf/blocks/wrap_frontend_innerblocks', 'acf_should_wrap_innerblocks', 10, 2 );
function acf_should_wrap_innerblocks( $wrap, $name ) {
// if ( $name == 'acf/tab-buttons' ) {
// return true;
// }
    return false;
}