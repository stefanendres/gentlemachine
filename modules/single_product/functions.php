<?php 

/*
 * Disable sold out Variations in select
 */
function gm_variation_is_active( $active, $variation ) {
 if (!$variation->is_in_stock()) {
   return false;
 }
 return $active;
}

/*
 * Change text for single-product varations select options
 */
function custom_dropdown_args( $args ) {
    $var_tax = get_taxonomy( $args['attribute'] );
    $args['show_option_none'] = apply_filters( 'the_title', $var_tax->labels->singular_name );
    return $args;
}

?>