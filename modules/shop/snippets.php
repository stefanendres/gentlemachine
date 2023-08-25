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
function gm_shop_loop_item($product) {
  if (!$product) {
    global $product;
  }
  $product_id = $product->get_id();
  $product_name = $product->get_name();
  $product_stock_status = $product->get_stock_status();
  $product_image_file_id = $product->get_image_id();
  $product_image_file_ratio = (getimagesize(wp_get_attachment_url($product_image_file_id))) ? (getimagesize(wp_get_attachment_url($product_image_file_id))[1] / getimagesize(wp_get_attachment_url($product_image_file_id))[0]) : 'auto';
  $product_tags = get_product_tags($product_id);

  if(!has_term(array('subscription'), 'product_cat', $product_id)) : ?>
  <a class="product-thumb-container product-link" href="<?= get_permalink($product_id); ?>">
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
        Nicht verfügbar
      </div>
    <?php endif ?>
  </a>
  <?php else : ?>
    <div class="subscription-product-container">
      <div class="subscription-product-content">
        <img class="subscription-title" src="<?= wp_get_attachment_url($product_image_file_id) ?>" alt="<?= $product_name ?>"/>
        <div class="subscription-description-wrapper">
          <?= get_field('gm_product_description', $product_id) ?>
          <div class="subscription-price">
            <?= WC_Subscriptions_Product::get_price( $product ) . ' € / ' . WC_Subscriptions_Product::get_period( $product ) ?>
          </div>
        </div>
      </div>
      <a class="subscription-product-link" href="<?= get_permalink($product_id); ?>">
        Zur Bestellung
      </a>
    </div>
  <?php endif;
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
    <h2 class="return-to-shop-heading">Weiter einkaufen</h2>
    <!-- link -->
  </div>
  <?php
}

/*
 * Custom Up-Sells text
 
function gm_translate_may_also_like( $translated ) {
 $translated = str_ireplace( 'You may also like&hellip;', 'Other Colors:', $translated );
 return $translated;
}
*/

/*
 * Custom Create Account? text
 
 function gm_translate_create_account( $translated_text, $text, $domain ) {
  switch ( $translated_text ) {
    case 'Create an account?' :
      $translated_text = __( 'Subscribe if you want to receive promotional discounts and special offers from PCG', 'woocommerce' );
      break;
  }
  return $translated_text;
}
*/
/*
 * Custom Thank You text
 */
function gm_filter_woocommerce_thankyou_order_received_text( $var, $order ) {
 return 'Thank you.<br>Your Order has been received.';
}

/*
* Custom Thank You background

function gm_add_background_content_thankyou() {
  ?>
  <div class="thankyou-background" style="background-image: url(<?= gm_get_context()['theme_url'].'/svg/thankyou-seed.svg'; ?>);"></div>
  <?php
}
*/


/* 
 * My Account Coin balance
 */
function gm_coin_balance($current_user) {
  $user_id = 'user_' . $current_user->ID;
  $user_coin_balance = (!get_field('coin_credit', $user_id)) ? 0 : get_field('coin_credit', $user_id);
  ?>
  <div class="coin-balance-container">
    <h3><?= get_field('coin_summary_headline', 'options'); ?></h3>
    <div class="coin-balance">
      <div class="coin-balance-value"><?= $user_coin_balance; ?></div>
      <img class="coin-balance-icon" src="<?= wp_get_attachment_url(get_field('coin_icon', 'options')); ?>">
    </div>
  </div>
  <?php
}
?>
