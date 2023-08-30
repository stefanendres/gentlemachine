<?php

add_filter( 'acf/fields/wysiwyg/toolbars' , 'gm_verysimple_toolbar' );

add_action( 'wp_enqueue_scripts', 'gm_add_custom_scripts_and_styles' );
add_action( 'wp_enqueue_scripts', 'gm_remove_parent_scripts', 99 );
add_action( 'wp_enqueue_scripts', 'gm_remove_parent_styles', 100 );

add_action( 'init', 'gm_remove_emoji_scripts_and_styles' );

add_action( 'template_redirect', 'gm_get_context');

function gm_remove_parent_themes_actions() {
  remove_action( 'storefront_header', 'storefront_header_container', 0 );
  remove_action( 'storefront_header', 'storefront_skip_links', 5 );
	remove_action( 'storefront_header', 'storefront_site_branding', 20 );
	remove_action( 'storefront_header', 'storefront_product_search', 40 );
  remove_action( 'storefront_header', 'storefront_header_container_close', 41 );
	remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper', 42 );
	remove_action( 'storefront_header', 'storefront_primary_navigation', 50 );
  remove_action( 'storefront_header', 'storefront_header_cart', 60 );
	remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper_close', 68 );

	//remove_action( 'storefront_before_content', 'storefront_header_widget_region', 10 );
  remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
  //remove_action( 'storefront_page', 'storefront_page_header', 10 );

	remove_action( 'woocommerce_after_shop_loop', 'storefront_sorting_wrapper', 9 );
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 30 );
	remove_action( 'woocommerce_after_shop_loop', 'storefront_sorting_wrapper_close', 31 );

  // could be enabled for ajax sorting by default (check options!)
	remove_action( 'woocommerce_before_shop_loop', 'storefront_sorting_wrapper', 9 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'storefront_woocommerce_pagination', 30 );
	remove_action( 'woocommerce_before_shop_loop', 'storefront_sorting_wrapper_close', 31 );

  remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
  remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

  remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
  remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

  remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


  remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
  remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
  remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
  remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
  remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
  remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
  remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
  remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
  remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
  remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


	remove_action( 'storefront_footer', 'storefront_footer_widgets', 10 );
	remove_action( 'storefront_footer', 'storefront_credit', 20 );
	remove_action( 'storefront_footer', 'storefront_handheld_footer_bar', 999 );


  remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );

  remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
  remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

  remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
  //remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
  //remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
  // function woocommerce_template_single_add_to_cart() generates the following 4 actions
  //remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
  //remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
  //remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
  //remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
  //remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
  //remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
  //remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
  //remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
  remove_action( 'woocommerce_after_single_product_summary', 'storefront_upsell_display', 15 );
  remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	remove_action( 'woocommerce_after_single_product_summary', 'storefront_single_product_pagination', 30 );
	remove_action( 'storefront_after_footer', 'storefront_sticky_single_add_to_cart', 999 );


  //remove_action( 'storefront_page', 'storefront_page_content', 20 ); WARNING: Removes content on my-account, cart, checkout,....
};


add_action( 'init', 'gm_remove_parent_themes_actions');


function gm_remove_product_gallery() {
  remove_theme_support( 'wc-product-gallery-zoom' );
  remove_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'after_setup_theme', 'gm_remove_product_gallery', 100 );


function gm_add_custom_actions() {
  add_action( 'storefront_header', 'gm_header_container_open', 48 );
  add_action( 'storefront_header', 'gm_header_container_shop_link', 49 );
  add_action( 'storefront_header', 'storefront_header_cart', 50 );
  add_action( 'storefront_header', 'gm_header_container_logo', 51 );
  add_action( 'storefront_header', 'gm_header_container_myaccount_link', 52 );
  add_action( 'storefront_header', 'gm_header_container_menu_button', 55 );
  add_action( 'storefront_header', 'gm_header_container_close', 55 );

  add_action( 'gm_main_menu', 'gm_menu_container_open', 1 );
  add_action( 'gm_main_menu', 'gm_menu_link_list', 2 );
  add_action( 'gm_main_menu', 'gm_menu_container_close', 3 );
  
  //shop-archive
  add_action( 'woocommerce_before_shop_loop', 'gm_open_products_list_wrapper', 11 );
  add_action( 'woocommerce_before_shop_loop_item', 'gm_shop_loop_item', 10 );
  add_action( 'woocommerce_after_shop_loop', 'gm_close_products_list_wrapper', 10 );
  //single-product
  add_action( 'woocommerce_before_single_product_summary', 'gm_before_single_product_summary', 10 );
  add_action( 'woocommerce_single_product_summary', 'gm_single_product_summary', 10 );
  add_action( 'woocommerce_single_product_summary', 'gm_after_single_product_summary_form', 41 );
  //add_action( 'woocommerce_after_single_product_summary', 'gm_woocommerce_output_upsells', 5 );
  add_action( 'woocommerce_after_single_product_summary', 'gm_after_single_product_summary', 20 );

  add_action( 'storefront_page', 'gm_content_rows', 20 );

  // footer.php
  add_action( 'gm_footer', 'footer_content', 10);

};
add_action('init', 'gm_add_custom_actions');

// lazy-loading on pages
/*add_filter( 'the_content', 'gm_add_lazyload_placeholders' , 99 );
add_filter( 'post_thumbnail_html','gm_add_lazyload_placeholders' , 11 );
add_filter( 'get_avatar', 'gm_add_lazyload_placeholders' , 11 );*/


// disable sold out variations
add_filter( 'woocommerce_variation_is_active', 'gm_variation_is_active', 10, 2 );

// change text for single-product varations select options
add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'custom_dropdown_args', 10 );

/*
// custom cross-sells text
add_filter( 'gettext', 'gm_translate_may_also_like' );

// custom create account text
add_filter( 'gettext', 'gm_translate_create_account', 20, 3 );

// custom thank you text
add_filter( 'woocommerce_thankyou_order_received_text', 'gm_filter_woocommerce_thankyou_order_received_text', 10, 2 );

// background thank you
add_action( 'woocommerce_thankyou', 'gm_add_background_content_thankyou' );

// replace product-image with cover-image
add_filter( 'woocommerce_product_get_image', 'gm_get_image' , 10, 5);

// show 1000 products per shop page
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
*/