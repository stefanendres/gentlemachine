<?php

/*
 * Setup Single-Product Content (before summary)
 */
function gm_before_single_product_summary() {
  global $product;
  $product_image_ids = $product->get_gallery_image_ids();
  $product_images_count = count($product_image_ids);
  $product_stock_status = $product->get_stock_status();
  $read_more_icon_url = wp_get_attachment_image_src(get_field('read_more_icon', 'options'))[0];

  if ($product_images_count > 0): ?>
  <div class="product-images-container slider-container">
    <div class="swiper" data-slide-count="<?= $product_images_count ?>">
      <div class="swiper-wrapper">
        <?php foreach ($product_image_ids as $id): ?>
          <?php
            $product_image_file_ratio = (getimagesize(wp_get_attachment_url($id))) ? (getimagesize(wp_get_attachment_url($id))[1] / getimagesize(wp_get_attachment_url($id))[0]) : 1;
          ?>
          <div class="single-product-image-wrapper swiper-slide" style="--ratio: <?= $product_image_file_ratio ?>;">
            <img class="single-product-image lazyload"
              data-srcset="<?= wp_get_attachment_image_srcset($id); ?>"
              sizes="<?= 'auto';//wp_get_attachment_image_sizes($id); ?>"
              data-src="<?= wp_get_attachment_url($id); ?>"
              alt="<?= gm_get_context()['site_title'] ?> – <?= $product->get_name() ?>"/>
          </div>
        <?php endforeach ?>
      </div>
      <div class="swiper-controls">
        <div class="swiper-button swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button swiper-button-next"></div>
      </div>
    </div>
  </div>
  <?php endif ?>
  <?php if ($product_stock_status === 'outofstock'): ?>
    <div class="product-stock-notice">
      Currently unavailable
    </div>
  <?php endif ?>
  <div class="product-description-container">
    <button class="product-description-button">
      <img class="product-button-icon" src="<?= $read_more_icon_url ?>" alt="Read More/Less"/>
    </button>
    <div class="product-description-wrapper">
      <h3><?= $product->get_name(); ?></h3>
      <?= get_field('gm_product_description') ?>
    </div>
  </div>
  <?php
}

/*
* Setup Single-Product Content (inside of summary)
*/
function gm_single_product_summary() {
  global $product;
  $product_id = $product->get_id();
  $product_tags = get_product_tags($product);
  ?>
  <div class="product-tags">
    <?php if (is_user_logged_in()): ?>
      <?php foreach ($product_tags as $product_tag): ?>
        <div class="product-tag product-tag-<?= $product_tag['slug'] ?>">
          <img class="product-tag-icon" src="<?= $product_tag['icon_url'] ?>" alt="<?= gm_get_context()['site_title'] ?> – <?= $product_tag['name']; ?> Icon"/>
          <span class="product-tag-name"><?= $product_tag['name']; ?></span>
        </div>
      <?php endforeach ?>
    <?php else: ?>
      <?php foreach ($product_tags as $product_tag): ?>
        <a class="product-tag product-tag-signup-link product-tag-<?= $product_tag['slug'] ?>" href="<?= get_permalink(get_option('woocommerce_myaccount_page_id')) ?>">
          <img class="product-tag-icon" src="<?= $product_tag['icon_url'] ?>" alt="<?= gm_get_context()['site_title'] ?> – <?= $product_tag['name']; ?> Icon"/>
          <span class="product-tag-name">Sign up to <?= $product_tag['name']; ?></span>
        </a>
      <?php endforeach ?>
    <?php endif ?>
  </div>
  <div class="product-prices">
    <?php if (has_term('buy', 'product_tag')): ?>
      <div class="product-price product-price-buy">
        <?= $product->get_price() ?> €
      </div>
    <?php endif ?>
    <?php if (has_term('change', 'product_tag')): ?>
      <div class="product-price product-price-change">
        <?= get_field('coin_price') ?> Coins
      </div>
    <?php endif ?>
  </div>
  <?php if (!is_user_logged_in()): ?>
    <div class="summary-lock" style="display:none;pointer-events:none;">
  <?php endif;
}

/*
 * Setup Single-Product after summary-form
 */
function gm_after_single_product_summary_form() {
  if (!is_user_logged_in()): ?>
    </div><?php // close <div class="summary-wrapper-lock">
  endif; ?>
  <a class="single-product-checkout-link" href="<?= gm_get_context()['site_url'];?>/checkout">Checkout</a>
  <?php
}


/*
 * Setup Single-Product Back-link, after summary closing-tag
 */
function gm_after_single_product_summary() {
  ?>
  <a class="single-product-back-link" href="<?= get_permalink(wc_get_page_id('shop')); ?>">Back</a>
  <?php
}

?>