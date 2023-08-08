<?php

function gm_get_context() {
  $data = [
    'site_title' => get_bloginfo(),
    'site_description' => get_bloginfo('description'),
    'site_url' => get_site_url(),
    'theme_url' => get_stylesheet_directory_uri(), // if not child-theme, use get_template_directory_uri()
    'is_shop' => gm_is_shop_page(),
    'is_product' => gm_is_product_page()
  ];
  return $data;
};

function gm_get_meta() {
  $data = NULL;
  if (gm_is_product_page()) {
    $data = [
      'description' => get_field('gm_product_description'),
      'image' => wp_get_attachment_url($product->get_image_id())
    ];
  } else {
    $data = [
      'description' => get_field('meta_description', 'options'),
      'image' => get_field('meta_image', 'options')
    ];
  }
  return $data;
}

function gm_get_mail_addresses($type) {
  $mail_addresses = get_field('mail_addresses', 'options');
  $mail_addresses_array = [];
  if ($mail_addresses) {
    foreach ($mail_addresses as $mail_address) {
      if ($mail_address['mail_address']['type'] === $type || !$type) {
        array_push($mail_addresses_array, array('name' => $mail_address['mail_address']['name'], 'address' => $mail_address['mail_address']['address']));
      }
    }
    return $mail_addresses_array;
  }
}

function gm_is_product_page() {
  return is_product();
}

function gm_is_shop_page() {
  if (is_shop()) {
    return is_shop();
  }
}

function gm_get_current_page_slug() {
  if (is_shop()) {
    $current_page_slug = 'shop';
  } else if (gm_is_product_page()) {
    global $product;
    $_product = new WC_Product(get_page_by_path($product, OBJECT, 'product'));
    $current_page_slug = gm_get_tlc_single_product($_product)->slug;
  } else {
    $current_page_slug = (strlen(get_queried_object()->slug) > 0) ? get_queried_object()->slug : get_post(get_the_ID())->post_name;
  }
  return $current_page_slug;
}

function gm_is_page_active($id) {
  return ($id == get_the_ID()) ? true : false;
}



/*

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function gm_get_random_color() {

	$r = random_color_part();
	$g = random_color_part();
	$b = random_color_part();

	$rc = dechex(255 - hexdec($r));
	$rc = (strlen($rc) > 1) ? $rc : '0' . $rc;
	$gc = dechex(255 - hexdec($g));
	$gc = (strlen($gc) > 1) ? $gc : '0' . $gc;
	$bc = dechex(255 - hexdec($b));
	$bc = (strlen($bc) > 1) ? $bc : '0' . $bc;

	return [
		'#'.$r.$g.$b,
		'#'.$rc.$gc.$bc
	];
}

}

function gm_get_random_color() {
	$r = mt_rand(0, 255);
	$b = mt_rand(0, 255);
	$g = mt_rand(0, 255);
	return 'rgb('.$r.','.$g.','.$b.')';
}

function gm_set_gradient() {
  // 'linear-gradient(90deg, '.gm_get_random_color().','.gm_get_random_color().')';
  return 'radial-gradient('.gm_get_random_color().','.gm_get_random_color().')';
}

function gm_set_line_dots() {
  //return '<div>. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</div>';
  return '<div>....................................................................................................................................................................................................................................................................................................................................................................................</div>';
}
*/

/*function gm_loading_spinner() {
  $loading_spinner_collection = get_field('loading_spinner_collection', 'options');
  $random_loading_spinner = $loading_spinner_collection[rand(0, (count($loading_spinner_collection)-1))]['loading_spinner_file'];
  return $random_loading_spinner;
}*/


?>
