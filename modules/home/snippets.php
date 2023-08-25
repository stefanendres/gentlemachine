<?php

function home_content() {
  home_starter();
  home_starter_text();
  home_featured_products();
  home_community_teaser();
  home_news_teaser();
  home_carerepair_teaser();
  home_aboshop_teaser();
  home_faqs_teaser();
}

function home_starter() {
  $starter_images = get_field('starter_images');
  ?>
  <section class="starter">
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
    <section class="starter-text">
      <p><?= get_field('starter_text') ?></p>
    </section>
  <?php
}

function home_featured_products() {
  $featured_products_ids = wc_get_featured_product_ids();
  ?>
  <section class="featured-products swiper">
    <ul class="swiper-wrapper">
    <?php foreach ($featured_products_ids as $product_id) : ?>
      <li class="swiper-slide">
        <?php gm_shop_loop_item(wc_get_product( $product_id )); ?>
      </li>
    <?php endforeach; ?>
    </ul>
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
  ?>
  <section class="community-teaser">
    <div class="community-teaser-images-container">
      <img class="community-teaser-image background lazyload"
        data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_background']) ?>"
        alt="<?= gm_get_context()['site_title'] ?> Community"/>
      <img class="community-teaser-image overlay-a lazyload"
        data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_overlay_a']) ?>"
        alt="<?= gm_get_context()['site_title'] ?> Community"/>
      <img class="community-teaser-image overlay-b lazyload"
        data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_overlay_b']) ?>"
        alt="<?= gm_get_context()['site_title'] ?> Community"/>
      <img class="community-teaser-image overlay-c lazyload"
        data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_overlay_c']) ?>"
        alt="<?= gm_get_context()['site_title'] ?> Community"/>
      <img class="community-teaser-image overlay-d lazyload"
        data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_overlay_d']) ?>"
        alt="<?= gm_get_context()['site_title'] ?> Community"/>
      <img class="community-teaser-image overlay-e lazyload"
        data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_overlay_e']) ?>"
        alt="<?= gm_get_context()['site_title'] ?> Community"/>
      <img class="community-teaser-image overlay-f lazyload"
        data-src="<?= wp_get_attachment_url($community_teaser_images['community_teaser_overlay_f']) ?>"
        alt="<?= gm_get_context()['site_title'] ?> Community"/>
    </div>
    <a class="link-community button-style" href="<?= get_permalink(get_page_by_path('community')) ?>">learn more</a>
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
  <section class="news-teaser">
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
      <a class="link-news" href="<?= get_permalink($news_page) ?>">
        exlpore more
      </a>
    </div>
  </section>
  <?php
}

function home_carerepair_teaser() {
  $carerepair_teaser_content_left = get_field('carerepair_teaser')['carerepair_left_column'];
  $carerepair_teaser_content_center = get_field('carerepair_teaser')['carerepair_center_column'];
  $carerepair_teaser_content_right = get_field('carerepair_teaser')['carerepair_right_column'];
  $carerepair_page = get_page_by_path('care-repair');
  ?>
    <section class="carerepair-teaser">
      <div class="carerepair-teaser-columns">
        <div class="left-column">
          <img class="carerepair-teaser-title lazyload" data-src="<?= wp_get_attachment_url($carerepair_teaser_content_left['title_svg']) ?>" alt="<?= get_the_title($carerepair_page) ?>"/>
          <div class="video-container">
            <p><?= $carerepair_teaser_content_left['teaser_text'] ?></p>
            <video autoplay muted loop playsinline preload="metadata"
              data-src="<?= wp_get_attachment_url($carerepair_teaser_content_left['video_file']) ?>"
              poster="<?= wp_get_attachment_url($carerepair_teaser_content_left['video_placeholder_image']) ?>"></video>
          </div>
        </div>
        <div class="center-column">
          <img class="carerepair-teaser-title lazyload" data-src="<?= wp_get_attachment_url($carerepair_teaser_content_center['title_svg']) ?>" alt="<?= get_the_title($carerepair_page) ?>"/>
          <div class="video-container">
            <p><?= $carerepair_teaser_content_center['teaser_text'] ?></p>
            <video autoplay muted loop playsinline preload="metadata"
              data-src="<?= wp_get_attachment_url($carerepair_teaser_content_center['video_file']) ?>"
              poster="<?= wp_get_attachment_url($carerepair_teaser_content_center['video_placeholder_image']) ?>"></video>
          </div>
        </div>
        <div class="right-column">
          <img class="carerepair-teaser-title lazyload" data-src="<?= wp_get_attachment_url($carerepair_teaser_content_right['title_svg']) ?>" alt="<?= get_the_title($carerepair_page) ?>"/>
          <div class="video-container">
            <p><?= $carerepair_teaser_content_right['teaser_text'] ?></p>
            <video autoplay muted loop playsinline preload="metadata"
              data-src="<?= wp_get_attachment_url($carerepair_teaser_content_right['video_file']) ?>"
              poster="<?= wp_get_attachment_url($carerepair_teaser_content_right['video_placeholder_image']) ?>"></video>
          </div>
        </div>
      </div>
      <a class="link-carerepair" href="<?= get_permalink($carerepair_page) ?>">
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
    <section class="aboshop-teaser">
      <img class="aboshop-teaser-title lazyload" data-src="<?= $aboshop_title_svg_url ?>" alt="<?= $aboshop_page->name ?>"/>
      <?= get_term_link($aboshop_page->term_id, 'product_cat') ?>
      <div class="featured-abo-container">
        <div class="subscription-product-container">
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
        <a class="link-aboshop" href="<?= get_term_link($aboshop_page->term_id, 'product_cat') ?>">
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
  <section class="faqs-teaser">
    <img class="faqs-teaser-title lazyload" data-src="<?= $faqs_title_svg_url ?>" alt="<?= get_the_title($faqs_page) ?>"/>
    <ul class="faqs-container">
      <?php foreach($faqs_teaser_content['content_expandable_posts'] as $faqs_item): ?>
        <li class="faq-item">
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
    <a class="link-faqs" href="<?= get_permalink($faqs_page) ?>">
      more Q's
    </a>
  </section>
  <?php
}


