<?php

function gm_structured_data($product) {
  if (gm_is_product_page()) {
  $_product = new WC_Product(get_page_by_path($product, OBJECT, 'product'));
  ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org/",
    "@type": "Product",
    "name": "<?= $_product->get_name(); ?>",
    "image": [
      "<?= wp_get_attachment_url($_product->get_gallery_image_ids()[0]); ?>"
     ],
    "description": "<?= $_product->get_name(); ?>",
    "sku": "<?= $_product->get_sku(); ?>",
    "offers": {
      "@type": "Offer",
      "url": "<?= $_product->get_permalink(); ?>",
      "priceCurrency": "EUR",
      "price": "<?= $_product->get_price(); ?>",
      "itemCondition": "https://schema.org/NewCondition",
      "availability": <?= ($_product->get_stock_status() === 'instock') ? '"https://schema.org/InStock"' : '"https://schema.org/SoldOut"'; ?>,
      "seller": {
        "@type": "Organization",
        "name": "GENTLEMACHINE GmbH"
      }
    }
  }
  </script>
  <?php
  }
  if (is_front_page()) {
  ?>
  <script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "url": "<?= get_bloginfo('url'); ?>",
    "logo": "<?= get_field('meta_image', 'options'); ?>"
  }
  </script>
  <?php
  }
}

/*
 * 404
 */
function content_404() {
  $args = array(
    'taxonomy' => "product_cat",
    'parent' => null
  );
  $product_categories = get_terms($args);
  $mail_addresses = gm_get_mail_addresses(false); ?>
  <h1 class="page-title">Page not found</h1>
  <h2>The page you are looking for can not be found.</h2>
  <section>
    <p>Feel free to have a look at our Collections: </p>
    <?php foreach ($product_categories as $product_category) { ?>
      <a class="button wc-backward" href="<?= get_category_link($product_category); ?>"><?= $product_category->name; ?></a>
    <?php } ?>
  </section>
  <section>
    <p>Or get in touch with us if you need anything else.</p>
    <?php foreach ($mail_addresses as $mail_address) { ?>
    <a href="mailto:<?= $mail_address['address']; ?>" class="contact-mail-button"><?= $mail_address['name']; ?></a>
    <?php } ?>
  </section

  <?php
}


?>
