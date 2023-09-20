<?php

function news_thumb($news_item) {
  $arrow_ne_svg_url = wp_get_attachment_url(get_field('arrow_ne_icon', 'options'));
  $news_item_type = get_field('news_post_type', $news_item);
  $news_item_title = get_the_title($news_item);
  $news_item_color = get_field('news_post_color', $news_item);
  ?>
  <li class="news-thumb-container">
    <?php if ($news_item_type === 'no_page'): ?>
      <div class="news-thumb-wrapper observe-vp" style="background-color: <?= $news_item_color ?>">
        <h3 class="news-thumb-title no-interaction"><?= $news_item_title ?></h3>
        <?php news_thumb_content($news_item) ?>
      </div>
    <?php elseif ($news_item_type === 'external'): ?>
      <a class="news-thumb-wrapper observe-vp" style="background-color: <?= $news_item_color ?>" target="_blank" rel="noreferrer noopener" href="<?= get_field('new_post_url', $news_item) ?>">  
        <h3 class="news-thumb-title"><?= $news_item_title ?></h3>
        <img class="news-thumb-link-icon" src="<?= $arrow_ne_svg_url ?>" alt="<?= $news_item_title ?>"/>
        <?php news_thumb_content($news_item) ?>
      </a>
    <?php elseif ($news_item_type === 'internal'): ?>
      <a class="news-thumb-wrapper observe-vp" style="background-color: <?= $news_item_color ?>" href="<?= get_permalink($news_item->ID) ?>">
        <h3 class="news-thumb-title"><?= $news_item_title ?></h3>
        <img class="news-thumb-link-icon" src="<?= $arrow_ne_svg_url ?>" alt="<?= $news_item_title ?>"/>
        <img class="news-thumb-star-icon" src="<?= wp_get_attachment_url(get_field('star_icon', 'options')) ?>" alt="<?= $news_item_title ?>"/>
        <?php news_thumb_content($news_item) ?>
      </a>
    <?php endif; ?>
  </li>
  <?php
}

function news_thumb_content($news_item) {
  $news_item_slider = get_field('news_post_slides', $news_item);
  $news_item_title = get_the_title($news_item);
  ?>
  <?php if(count($news_item_slider) > 1): ?>
    <div class="news-thumb-slider-container swiper" data-slides-count="<?= count($news_item_slider) ?>">
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


function news_content() {
  $news_page = $post;
  $news_title_svg_url = wp_get_attachment_url(get_field('page_name_svg'));
  ?>
  <section>
    <div class="news-title-container observe-vp">
      <img class="news-title lazyload" data-src="<?= $news_title_svg_url ?>" alt="<?= get_the_title($news_page) ?>"/>
    </div>
    <ul class="news-container observe-vp">
      <?php foreach(get_posts() as $news_item): ?>
        <?php news_thumb($news_item); ?>
      <?php endforeach ?>
    </ul>
  </section>
  <?php
}