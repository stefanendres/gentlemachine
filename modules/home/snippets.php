<?php

function home_content() {
  home_starter();
  home_featured_products();
  home_starter_text();
  home_community_teaser();
  home_news_teaser();
  home_carerepair_teaser();
  home_aboshop_teaser();
  home_faqs_teaser();
}

function home_starter() {
  $starter_images = get_field('starter_images');
  ?>
  <section class="starter observe-vp">
    <div class="starter-left-column swiper" data-slides-count="<?= count($starter_images['starter_left_column']) ?>">
      <div class="swiper-wrapper">
        <?php foreach ($starter_images['starter_left_column'] as $image_id): ?>
          <div class="swiper-slide">
            <img class="starter-image lazyload" data-src="<?= wp_get_attachment_url($image_id) ?>" alt="<?= gm_get_context()['site_title'] ?>"/>
          </div>
        <?php endforeach ?>
      </div>
    </div>
    <div class="starter-center-column swiper" data-slides-count="<?= count($starter_images['starter_center_column']) ?>">
      <div class="swiper-wrapper">
        <?php foreach ($starter_images['starter_center_column'] as $image_id): ?>
          <div class="swiper-slide">
            <img class="starter-image lazyload" data-src="<?= wp_get_attachment_url($image_id) ?>" alt="<?= gm_get_context()['site_title'] ?>"/>
          </div>
        <?php endforeach ?>
      </div>
    </div>
    <div class="starter-right-column swiper" data-slides-count="<?= count($starter_images['starter_right_column']) ?>">
      <div class="swiper-wrapper">
        <?php foreach ($starter_images['starter_right_column'] as $image_id): ?>
          <div class="swiper-slide">
            <img class="starter-image lazyload" data-src="<?= wp_get_attachment_url($image_id) ?>" alt="<?= gm_get_context()['site_title'] ?>"/>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </section>
  <?php
}

function home_starter_text() {
  ?>
    <section class="starter-text observe-vp">
      <p><?= get_field('starter_text') ?></p>
    </section>
  <?php
}

function home_featured_products() {
  $featured_products_ids = wc_get_featured_product_ids();
  ?>
  <section class="featured-products observe-vp">
    <div class="featured-products-container swiper" data-slides-count="<?= count($featured_products_ids) ?>">
      <div class="swiper-wrapper">
        <?php foreach ($featured_products_ids as $product_id) : ?>
          <div class="swiper-slide">
            <?php gm_shop_loop_item(wc_get_product( $product_id )); // gm_shop_loop_item() from modules/shop/snippets.php ?> 
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="swiper-button swiper-button-prev">
      <img class="swiper-arrow" src="<?= wp_get_attachment_url(get_field('arrow_left_icon', 'options')) ?>" alt="Previous"/>
    </div>
    <div class="swiper-button swiper-button-next">
      <img class="swiper-arrow" src="<?= wp_get_attachment_url(get_field('arrow_right_icon', 'options')) ?>" alt="Next"/>
    </div>
  </section>
  <?php
}

function home_community_teaser() {
  $community_teaser_images = get_field('community_teaser');
  $community_page_url = get_permalink(get_page_by_path('community'));
  ?>
  <section class="community-teaser observe-vp">
    <div class="community-teaser-images-container">
      <img class="community-teaser-image background observe-vp lazyload"
        data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_background']) ?>"
        alt="<?= gm_get_context()['site_title'] ?> Community"/>
      <a class="community-teaser-overlay overlay-a observe-vp" href="<?= $community_page_url ?>">
        <img class="community-teaser-image lazyload"
          data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_overlay_a']) ?>"
          alt="<?= gm_get_context()['site_title'] ?> Community"/>
      </a>
      <a class="community-teaser-overlay overlay-b observe-vp" href="<?= $community_page_url ?>">
        <img class="community-teaser-image lazyload"
          data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_overlay_b']) ?>"
          alt="<?= gm_get_context()['site_title'] ?> Community"/>
      </a>
      <a class="community-teaser-overlay overlay-c observe-vp" href="<?= $community_page_url ?>">
        <img class="community-teaser-image lazyload"
          data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_overlay_c']) ?>"
          alt="<?= gm_get_context()['site_title'] ?> Community"/>
      </a>
      <a class="community-teaser-overlay overlay-d observe-vp" href="<?= $community_page_url ?>">
        <img class="community-teaser-image lazyload"
          data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_overlay_d']) ?>"
          alt="<?= gm_get_context()['site_title'] ?> Community"/>
      </a>
      <a class="community-teaser-overlay overlay-e observe-vp" href="<?= $community_page_url ?>">
        <img class="community-teaser-image lazyload"
          data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_overlay_e']) ?>"
          alt="<?= gm_get_context()['site_title'] ?> Community"/>
      </a>
      <a class="community-teaser-overlay overlay-f observe-vp" href="<?= $community_page_url ?>">
        <img class="community-teaser-image lazyload"
          data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_overlay_f']) ?>"
          alt="<?= gm_get_context()['site_title'] ?> Community"/>
      </a>
    </div>
    <a class="link-community button-style" href="<?= $community_page_url ?>">learn more</a>
  </section>
  <?php
}

function home_news_teaser () {
  $news_teaser_content = get_field('news_teaser');
  $news_title_svg_url = wp_get_attachment_url($news_teaser_content['title_svg']);
  $featured_news_items = $news_teaser_content['news_selection'];
  $newsletter_link = $news_teaser_content['newsletter_link'];
  $news_page = get_page_by_path('news');
  ?>
  <section class="news-teaser observe-vp">
    <img class="news-teaser-title lazyload" data-src="<?= $news_title_svg_url ?>" alt="<?= get_the_title($news_page) ?>"/>
    <ul class="featured-news-container">
      <?php foreach($featured_news_items as $news_item) : ?>
        <?php news_thumb($news_item); ?>
      <?php endforeach ?>
    </ul>
    <div class="news-teaser-links-container">
      <?php if ($newsletter_link['target']): ?>
        <a class="link-newsletter-signup" target="<?= $newsletter_link['target'] ?>" rel="noreferrer noopener" href="<?= $newsletter_link['url'] ?>">
      <?php else: ?>
        <a class="link-newsletter-signup" href="<?= $newsletter_link['url'] ?>">
      <?php endif; ?>
        <?= $newsletter_link['title'] ?>
      </a>
      <a class="link-news button-style" href="<?= get_permalink($news_page) ?>">
        exlpore more
      </a>
    </div>
  </section>
  <?php
}

function home_carerepair_teaser() {
  $carerepair_teaser_content = get_field('carerepair_teaser');
  $carerepair_page = get_page_by_path('care-repair');
  ?>
    <section class="carerepair-teaser observe-vp">
      <div class="carerepair-teaser-container">
        <img class="carerepair-teaser-title lazyload" data-src="<?= wp_get_attachment_url($carerepair_teaser_content['title_svg']) ?>" alt="<?= get_the_title($carerepair_page) ?>"/>
        <div class="video-container">
          <p><?= $carerepair_teaser_content['teaser_text'] ?></p>
          <video autoplay muted loop playsinline preload="metadata"
            class="lazyload observe-vp"
            data-src="<?= wp_get_attachment_url($carerepair_teaser_content['video_file']) ?>"
            poster="<?= wp_get_attachment_url($carerepair_teaser_content['video_placeholder_image']) ?>"></video>
        </div>
      </div>
      <a class="link-carerepair button-style" href="<?= get_permalink($carerepair_page) ?>">
        learn more
      </a>
    </section>
  <?php
}

function home_aboshop_teaser() {
  $aboshop_teaser_content = get_field('abo_shop_teaser');
  $aboshop_title_svg_url = wp_get_attachment_url($aboshop_teaser_content['title_svg']);
  $featured_abo = wc_get_product($aboshop_teaser_content['abo_selection']);
  $featured_abo_id = $featured_abo->get_id();
  $featured_abo_name = $featured_abo->get_name();
  $featured_abo_image_file_id = $featured_abo->get_image_id();
  $aboshop_page = get_term_by('slug', 'subscription', 'product_cat');
  ?>
    <section class="aboshop-teaser observe-vp">
      <img class="aboshop-teaser-title lazyload" data-src="<?= $aboshop_title_svg_url ?>" alt="<?= $aboshop_page->name ?>"/>
      <div class="featured-abo-container">
        <div class="subscription-product-container observe-vp">
          <div class="subscription-product-content">
            <img class="subscription-title" src="<?= wp_get_attachment_url($featured_abo_image_file_id) ?>" alt="<?= $featured_abo_name ?>"/>
            <div class="subscription-description-wrapper">
              <?= get_field('gm_product_description', $featured_abo_id) ?>
              <div class="subscription-price">
                <?= WC_Subscriptions_Product::get_price( $featured_abo ) . ' € / ' . WC_Subscriptions_Product::get_period( $featured_abo ) ?>
              </div>
            </div>
          </div>
          <a class="subscription-product-link" href="<?= get_permalink($featured_abo_id); ?>">
            Zur Bestellung
          </a>
        </div>
        <a class="link-aboshop button-style" href="<?= get_term_link($aboshop_page->term_id, 'product_cat') ?>">
          Go to Aboshop
        </a>
      </div>
    </section>
  <?php
}

function home_faqs_teaser() {
  $faqs_teaser_content = get_field('faqs_teaser');
  $faqs_title_svg_url = wp_get_attachment_url($faqs_teaser_content['title_svg']);
  $faqs_page = get_page_by_path('faqs');
  ?>
  <section class="faqs-teaser observe-vp">
    <img class="faqs-teaser-title lazyload" data-src="<?= $faqs_title_svg_url ?>" alt="<?= get_the_title($faqs_page) ?>"/>
    <ul class="faqs-container">
      <?php foreach($faqs_teaser_content['content_expandable_posts'] as $faqs_item): ?>
        <li class="faqs-item expandable-item">
          <div class="title-wrapper">
            <h3><?= $faqs_item['content_exp_heading'] ?></h3>
          </div>
          <div class="content-wrapper">
            <div class="text-wrapper">
              <?= $faqs_item['content_exp_text'] ?>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    <a class="link-faqs button-style" href="<?= get_permalink($faqs_page) ?>">
      more Q's
    </a>
  </section>
  <?php
}


