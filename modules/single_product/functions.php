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
/*
 * https://stackoverflow.com/questions/42403821/detecting-if-the-current-user-has-an-active-subscription
 */
function has_active_subscription( $user_id='' ) {
    // When a $user_id is not specified, get the current user Id
    if( '' == $user_id && is_user_logged_in() ) 
        $user_id = get_current_user_id();
    // User not logged in we return false
    if( $user_id == 0 ) 
        return false;

    return wcs_user_has_subscription( $user_id, '', 'active' );
}

?>