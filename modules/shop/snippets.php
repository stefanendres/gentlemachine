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

function gm_shop_products_filter() {
  ?>
  <div class="product-filter">
    <div class="product-filter-container">
      <?= do_shortcode("[br_filters_group group_id=58]"); ?>
    </div>
    <button class="product-filter-button" name="Filter Products">Filter</button>
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
 * Show links shops, if return to shop
 */
function gm_cart_emtpy_shop_links() {
  ?>
  <div class="return-to-shop-container">
    <a class="return-to-shop-link link-shop" href="<?= get_permalink(wc_get_page_id('shop')); ?>">Weiter zu unseren Produkten</a>
    <a class="return-to-shop-link link-aboshop" href="<?= get_term_link(get_term_by('slug', 'subscription', 'product_cat')->term_id, 'product_cat') ?>">Weiter zu unseren Abos</a>
  </div>
  <?php
}

/*
 * Custom Thank You text
 */
function gm_filter_woocommerce_thankyou_order_received_text( $var, $order ) {
 return 'Thank you! Your Order has been received.';
}





/* 
 * My Account Coin balance
 */
function gm_member_fields($current_user) {
  $user_id = 'user_' . $current_user->ID;
  $user_coin_balance = (!get_field('coin_credit', $user_id)) ? 0 : get_field('coin_credit', $user_id);
  $user_qr_code_id = (!get_field('qr_code', $user_id)) ? NULL : get_field('qr_code', $user_id);
  $customer_flour_id = (!get_field('customer_flour_id', $user_id)) ? NULL : get_field('customer_flour_id', $user_id);
  ?>
  <div class="coin-balance-container">
    <h3><?= get_field('coin_summary_headline', 'options'); ?></h3>
    <div class="coin-balance">
      <div class="coin-balance-value"><?= $user_coin_balance; ?></div>
      <img class="coin-balance-icon" src="<?= wp_get_attachment_url(get_field('coin_icon', 'options')); ?>">
    </div>
  </div>
  <?php if ($customer_flour_id): ?>
  <div class="customer-flour-id-container">
    <h3>Kundennummer</h3>
    <div class="customer-flour-id-value"><?= $customer_flour_id; ?></div>
  </div>
  <?php endif ?>
  <?php if ($user_qr_code_id): ?>
  <div class="qr-code-container">
    <img class="qr-code" src="<?= wp_get_attachment_url($user_qr_code_id) ?>"/>
  </div>
  <?php endif ?>
  <?php
}


?>