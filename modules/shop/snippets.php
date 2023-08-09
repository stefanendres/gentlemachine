<?php
/*
 * Product Archive
 */

function gm_open_products_list_wrapper() {
  ?>
  <div class="shop-products-wrapper">
  <?php
}

// sub-header and procust-list wrapper, for sticky scroll
function gm_close_products_list_wrapper() {
  ?>
  </div>
  <?php
}

/*
 * Setup Single-Product in loop
 */
function gm_shop_loop_item() {
  global $product;
  $product_name = $product->get_name();
  $product_stock_status = $product->get_stock_status();
  $product_image_file_id = $product->get_image_id();
  $product_image_file_ratio = (getimagesize(wp_get_attachment_url($product_image_file_id))) ? (getimagesize(wp_get_attachment_url($product_image_file_id))[1] / getimagesize(wp_get_attachment_url($product_image_file_id))[0]) : 1;
  $product_tags = get_product_tags($product);
  ?>
  <a class="product-thumb-container product-link" href="<?= get_permalink( $product->get_id() ); ?>">
    <div class="product-image-wrapper" style="--ratio: <?= $product_image_file_ratio ?>;">
    <?php if ($product_image_file_id): ?>
      <img class="product-image lazyload" srcset="<?= wp_get_attachment_image_srcset($product_image_file_id); ?>" data-sizes="auto" data-src="<?= wp_get_attachment_url($product_image_file_id); ?>" alt="<?= gm_get_context()['site_title'] ?> – <?= $product_name; ?>"/>
    <?php endif?>
    </div>
    <div class="product-info-container">
      <div class="product-tags">
        <?php foreach ($product_tags as $product_tag): ?>
          <div class="product-tag product-tag-<?= $product_tag['slug'] ?>">
            <img class="product-tag-icon" src="<?= $product_tag['icon_url'] ?>" alt="<?= gm_get_context()['site_title'] ?> – <?= $product_tag['name']; ?> Icon"/>
            <span class="product-tag-name"><?= $product_tag['name']; ?></span>
          </div>
        <?php endforeach ?>
      </div>
    </div>
    <?php if ($product_stock_status === 'outofstock'): ?>
      <div class="product-stock-notice">
        Currently unavailable
      </div>
    <?php endif ?>
  </a>
  <?php
}


/*
 * Show links to all categories, if return to shop
 */
function gm_cart_emtpy_shop_links() {
  $args = array(
    'taxonomy' => "product_cat",
    'parent' => null
  );
  $product_categories = get_terms($args); ?>
  <div class="return-to-shop-container">
    <h2 class="return-to-shop-heading">Continue Shopping</h2>
    <!-- link -->
  </div>
  <?php
}

/*
 * Custom Up-Sells text
 */
function gm_translate_may_also_like( $translated ) {
 $translated = str_ireplace( 'You may also like&hellip;', 'Other Colors:', $translated );
 return $translated;
}


/*
 * Custom Create Account? text
 */
 function gm_translate_create_account( $translated_text, $text, $domain ) {
  switch ( $translated_text ) {
    case 'Create an account?' :
      $translated_text = __( 'Subscribe if you want to receive promotional discounts and special offers from PCG', 'woocommerce' );
      break;
  }
  return $translated_text;
}

/*
 * Custom Thank You text
 */
function gm_filter_woocommerce_thankyou_order_received_text( $var, $order ) {
 return 'Thank you.<br>Your Order has been received.';
}

/*
* Custom Thank You background
*/
function gm_add_background_content_thankyou() {
  ?>
  <div class="thankyou-background" style="background-image: url(<?= gm_get_context()['theme_url'].'/svg/thankyou-seed.svg'; ?>);"></div>
  <?php
}

?>
