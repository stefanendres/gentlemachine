<?php

function gm_add_custom_scripts_and_styles() {
  $files = new DirectoryIterator(get_stylesheet_directory());
  foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'css') {
      $filename = basename($file);
      wp_enqueue_style('gm-style', get_stylesheet_directory_uri().'/'.$filename);
    }
    if (pathinfo($file, PATHINFO_EXTENSION) === 'js' && strpos(basename($file), 'app') !== false) {
      $filename = basename($file);
      wp_enqueue_script('gm-script', get_stylesheet_directory_uri().'/'.$filename);
    }
    add_filter( 'script_loader_tag', function ( $tag, $handle ) {
        if ('gm-script' !== $handle) {
          return $tag;
        }
        return str_replace(' src', ' defer src', $tag); // defer the script
        //return str_replace( ' src', ' async src', $tag ); // OR async the script
        //return str_replace( ' src', ' async defer src', $tag ); // OR do both!
    }, 10, 2 );
  }
};

function gm_remove_parent_scripts() {
  wp_dequeue_script('storefront-header-cart');
  wp_dequeue_script('storefront-navigation');
  wp_dequeue_script('storefront-skip-link-focus-fix');
  wp_dequeue_script('storefront-handheld-footer-bar');
  wp_dequeue_script('flexslider');
  wp_dequeue_script('photoswipe-ui-default');
  wp_dequeue_script('zoom');
  wp_dequeue_script('comment-reply'); //single-product
};


function gm_remove_parent_styles() {
  /*$post_id = get_the_ID();
  if ($post_id === wc_get_page_id( 'cart' )) {
  } else if ( $post_id === wc_get_page_id( 'checkout' )) {
  } else {*/
    wp_dequeue_style('storefront-child-style');
    wp_dequeue_style('storefront-woocommerce-style');
    wp_dequeue_style('storefront-style');
    wp_dequeue_style('storefront-gutenberg-blocks-inline');
    wp_dequeue_style('storefront-gutenberg-blocks');
    wp_dequeue_style('storefront-fonts');
    wp_dequeue_style('storefront-icons');
    wp_dequeue_style('storefront-gutenberg-blocks');
  //}
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('wc-block-style');
  wp_dequeue_style('bodhi-svgs-attachment');

  wp_dequeue_style('trp-language-switcher-style');
  //2023
  wp_dequeue_style('font-awesome');
  wp_dequeue_style('berocket_aapf_widget-style');
  wp_dequeue_style('wc-blocks-style');
  wp_dequeue_style('wc-blocks-vendors-style');
  wp_dequeue_style('classic-theme-styles');
  //berocket_aapf_widget-style-css // we could need this for now

  wp_dequeue_style("font-awesome");
  wp_dequeue_style("wc-blocks-integration");
  wp_dequeue_style("wp-block-library");
  wp_dequeue_style("wp-block-library-theme");
  wp_dequeue_style("wc-blocks-style");
  wp_dequeue_style("wc-blocks-style-active-filters");
  wp_dequeue_style("wc-blocks-style-add-to-cart-form");
  wp_dequeue_style("wc-blocks-packages-style");
  wp_dequeue_style("wc-blocks-style-all-products");
  wp_dequeue_style("wc-blocks-style-all-reviews");
  wp_dequeue_style("wc-blocks-style-attribute-filter");
  wp_dequeue_style("wc-blocks-style-breadcrumbs");
  wp_dequeue_style("wc-blocks-style-catalog-sorting");
  wp_dequeue_style("wc-blocks-style-customer-account");
  wp_dequeue_style("wc-blocks-style-featured-category");
  wp_dequeue_style("wc-blocks-style-featured-product");
  wp_dequeue_style("wc-blocks-style-mini-cart");
  wp_dequeue_style("wc-blocks-style-price-filter");
  wp_dequeue_style("wc-blocks-style-product-add-to-cart");
  wp_dequeue_style("wc-blocks-style-product-button");
  wp_dequeue_style("wc-blocks-style-product-categories");
  wp_dequeue_style("wc-blocks-style-product-image");
  wp_dequeue_style("wc-blocks-style-product-image-gallery");
  wp_dequeue_style("wc-blocks-style-product-query");
  wp_dequeue_style("wc-blocks-style-product-results-count");
  wp_dequeue_style("wc-blocks-style-product-reviews");
  wp_dequeue_style("wc-blocks-style-product-sale-badge");
  wp_dequeue_style("wc-blocks-style-product-search");
  wp_dequeue_style("wc-blocks-style-product-sku");
  wp_dequeue_style("wc-blocks-style-product-stock-indicator");
  wp_dequeue_style("wc-blocks-style-product-summary");
  wp_dequeue_style("wc-blocks-style-product-title");
  wp_dequeue_style("wc-blocks-style-rating-filter");
  wp_dequeue_style("wc-blocks-style-reviews-by-category");
  wp_dequeue_style("wc-blocks-style-reviews-by-product");
  wp_dequeue_style("wc-blocks-style-product-details");
  wp_dequeue_style("wc-blocks-style-single-product");
  wp_dequeue_style("wc-blocks-style-stock-filter");
  wp_dequeue_style("wc-blocks-style-cart");
  wp_dequeue_style("wc-blocks-style-checkout");
  wp_dequeue_style("wc-blocks-style-mini-cart-contents");
  wp_dequeue_style("wc-blocks-vendors");
  wp_dequeue_style("wc-all-blocks");
  wp_dequeue_style("storefront-gutenberg-blocks");
  //wp_dequeue_style("xoo-el-style");
  //wp_dequeue_style("xoo-el-fonts");
  //wp_dequeue_style("xoo-aff-style");
  //wp_dequeue_style("xoo-aff-font-awesome5");

}

/**
 * Remove emoji's scripts and styles
 */
function gm_remove_emoji_scripts_and_styles() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}


/*
 * Remove further unnecessary code in head
 */
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
/*
 * Remove further unnecessary code in footer
 */
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );


/*
 * Remove buttons from tiny-mce-toolbar which should not be supported by the theme
 */
function gm_verysimple_toolbar( $toolbars )
{
	// Uncomment to view format of $toolbars
	/*
	echo '< pre >';
		print_r($toolbars);
	echo '< /pre >';
	die;
	*/

	// Add a new toolbar called "Very Simple"
	// - this toolbar has only 1 row of buttons
	$toolbars['Very Simple' ] = array();
	$toolbars['Very Simple' ][1] = array('bold', 'italic', 'link' , 'unlink', 'bullist', 'numlist', 'undo', 'redo' );

	// Edit the "Full" toolbar and remove 'code'
	// - delet from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
	if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
	{
	    unset( $toolbars['Full' ][2][$key] );
	}

	// remove the 'Basic' toolbar completely
	unset( $toolbars['Basic' ] );

	// return $toolbars - IMPORTANT!
	return $toolbars;
}

/**
 * Change number of products that are displayed per page (shop page)
 */
function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 1000;
  return $cols;
}
