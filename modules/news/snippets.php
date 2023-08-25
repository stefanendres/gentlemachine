<?php

function news_thumb($news_item) {
  $arrow_ne_svg_url = wp_get_attachment_url(get_field('arrow_ne_icon', 'options'));
  $news_item_type = get_field('news_post_type', $news_item);
  $news_item_title = get_the_title($news_item);
  ?>
  <li class="news-thumb-container">
    <h3><?= $news_item_title ?></h3>
    <?php if ($news_item_type === 'no_page'): ?>
      <?php news_thumb_content($news_item) ?>
    <?php elseif ($news_item_type === 'external'): ?>
      <a class="news-thumb-link" target="_blank" rel="noreferrer noopener" href="<?= get_field('new_post_url', $news_item) ?>">
        <img class="news-thumb-link-icon" src="<?= $arrow_ne_svg_url ?>" alt="<?= $news_item_title ?>"/>
      </a>
      <?php news_thumb_content($news_item) ?>
    <?php elseif ($news_item_type === 'internal'): ?>
      <a class="news-thumb-link" href="<?= get_permalink($news_item->ID) ?>">
        <img class="news-thumb-link-icon" src="<?= $arrow_ne_svg_url ?>" alt="<?= $news_item_title ?>"/>
      </a>
      <img class="news-thumb-star-icon" src="<?= wp_get_attachment_url(get_field('star_icon', 'options')) ?>" alt="<?= $news_item_title ?>"/>
      <?php news_thumb_content($news_item) ?>
    <?php endif; ?>
  </li>
  <?php
}

function news_thumb_content($news_item) {
  $news_item_slider = get_field('news_post_slides', $news_item);
  $news_item_title = get_the_title($news_item);
  ?>
  <?php if(count($news_item_slider) > 1): ?>
    <div class="news-thumb-slider-container swiper">
      <div class="swiper-wrapper">
        <?php foreach($news_item_slider as $slider_item): ?>
          <div class="swiper-slide">
            <?php news_thumb_slide_item($slider_item, $news_item_title) ?>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  <?php else: ?>
    <div class="news-thumb-single-container">
      <?php news_thumb_slide_item($news_item_slider[0], $news_item_title) ?>
    </div>
  <?php endif; ?>
  <?php
}

function news_thumb_slide_item($item, $title) {
  if ($item['acf_fc_layout'] === 'news_post_slide_item_text'): ?>
    <div class="slide-item-text-wrapper">
      <?= $item['news_post_slide_text'] ?>
    </div>
  <?php elseif ($item['acf_fc_layout'] === 'news_post_slide_item_image'):
    $slide_image_id = $item['news_post_slide_image'];
    $slide_image_url = wp_get_attachment_url($slide_image_id);
    $slide_image_file_ratio = (getimagesize($slide_image_url)) ? (getimagesize($slide_image_url)[1] / getimagesize($slide_image_url)[0]) : 'auto';
  ?>
    <div class="slide-item-image-wrapper" style="--ratio: <?= $slide_image_file_ratio ?>;">
      <img class="slide-item-image lazyload"
        data-srcset="<?= wp_get_attachment_image_srcset($slide_image_id); ?>"
        sizes="<?= 'auto';//wp_get_attachment_image_sizes($slide_image_id); ?>"
        data-src="<?= $slide_image_url; ?>"
        alt="<?= $title ?>"/>
    </div>
  <?php endif;
}