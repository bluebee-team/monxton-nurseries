<?php
require get_stylesheet_directory() . '/inc/assets.php';
require get_stylesheet_directory() . '/inc/blocks.php';

/**
 * Filters the next, previous and submit buttons.
 * Replaces the form's <input> buttons with <button> while maintaining attributes from original <input>.
 *
 * @param string $button Contains the <input> tag to be filtered.
 * @param object $form Contains all the properties of the current form.
 *
 * @return string The filtered button.
 */
add_filter( 'gform_next_button', 'input_to_button', 10, 2 );
add_filter( 'gform_previous_button', 'input_to_button', 10, 2 );
add_filter( 'gform_submit_button', 'input_to_button', 10, 2 );
function input_to_button( $button, $form ) {

    $dom = new DOMDocument();
    $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
    $input = $dom->getElementsByTagName( 'input' )->item(0);
    $new_button = $dom->createElement( 'button' );
    $new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
    $input->removeAttribute( 'value' );
    foreach( $input->attributes as $attribute ) {
        $new_button->setAttribute( $attribute->name, $attribute->value );
    }
    $input->parentNode->replaceChild( $new_button, $input );

    return $dom->saveHtml( $new_button );
}



// Add tab to product page
/**
 * @snippet       New Product Tab @ WooCommerce Single Product
 * @how-to        businessbloomer.com/woocommerce-customization
 * @author        Rodolfo Melogli, Business Bloomer
 * @compatible    WooCommerce 8
 * @community     https://businessbloomer.com/club/
 */
 
add_filter( 'woocommerce_product_tabs', 'soil_add_product_tab', 9999 );
   
function soil_add_product_tab( $tabs ) {
   $tabs['docs'] = array(
      'title' => __( 'Soil Preferences', 'woocommerce' ), // TAB TITLE
      'priority' => 50, // TAB SORTING (DESC 10, ADD INFO 20, REVIEWS 30)
      'callback' => 'soil_add_product_tab_content', // TAB CONTENT CALLBACK
   );
   return $tabs;
}
 
function soil_add_product_tab_content() {
   global $product;
   echo '<h2>Soil Preferences</h2>';
   if( get_field('soil_preferences')):
    echo the_field('soil_preferences');
endif;
}


