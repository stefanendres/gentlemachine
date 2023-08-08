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

?>