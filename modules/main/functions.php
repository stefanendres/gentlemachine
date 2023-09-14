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
  /*$data = NULL;
  if (gm_is_product_page()) {
    $data = [
      'description' => get_field('gm_product_description', $product),
      'image' => NULL//var_dump($product)
    ];
  } else {
    $data = [
      'description' => get_field('meta_description', 'options'),
      'image' => get_field('meta_image', 'options')
    ];
  }
  return $data;*/
  return [
    'description' => get_field('meta_description', 'options'),
    'image' => get_field('meta_image', 'options')
  ];
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
    $current_page_slug = $_product->get_slug();
  } else {
    $current_page_slug = (strlen(get_queried_object()->slug) > 0) ? get_queried_object()->slug : get_post(get_the_ID())->post_name;
  }
  return $current_page_slug;
}

function gm_is_page_active($id) {
  return ($id == get_the_ID()) ? true : false;
}


?>
