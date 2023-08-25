<?php

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}


require_once('modules/main/functions.php');
//require_once('modules/main/snippets.php');

require_once('modules/header/functions.php');
require_once('modules/header/snippets.php');

//require_once('modules/page/functions.php');
//require_once('modules/page/snippets.php');

require_once('modules/home/functions.php');
require_once('modules/home/snippets.php');

require_once('modules/news/functions.php');
require_once('modules/news/snippets.php');

require_once('modules/shop/functions.php');
require_once('modules/shop/snippets.php');

require_once('modules/single_product/functions.php');
require_once('modules/single_product/snippets.php');

require_once('modules/footer/functions.php');
require_once('modules/footer/snippets.php');

require_once('theme-custom-functions.php');
require_once('theme-hooks.php');


/*
 * DEV HELPERS
 */

 show_admin_bar(false);

// Echoes all script handles
function wpa54064_inspect_scripts() {
    global $wp_scripts;
    foreach( $wp_scripts->queue as $handle ) :
        echo $handle.', ';
    endforeach;
}
//add_action( 'wp_print_scripts', 'wpa54064_inspect_scripts' );

function cyb_list_styles() {
    global $wp_styles;
    global $enqueued_styles;
    $enqueued_styles = array();
    foreach( $wp_styles->queue as $handle ) {
        var_dump($enqueued_styles[] = $wp_styles->registered[$handle]->handle);
    }
}
//add_action( 'wp_print_styles', 'cyb_list_styles' );

function gm_check_page() {
    var_dump(is_product());
    var_dump(is_archive());
}
//add_action( 'template_redirect', 'gm_check_page');


//add SVG Support (https://wpengine.com/resources/enable-svg-wordpress/)
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

// resolve WARNING when svg are resized https://wordpress.org/support/topic/i-am-getting-this-warning/
add_filter('woocommerce_resize_images', static function() {
    return false;
});

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );
