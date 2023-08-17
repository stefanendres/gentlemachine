<?php
/*
 * Setup Content Rows
 */
function gm_content_rows($id) {
  if ($id) {
    $rows = get_field('gm_layout', $id);
  } else {
    $rows = get_field('gm_layout');
  }

  if ($rows): 
    foreach ($rows as $row): ?>
      <div class="row <?= str_replace('_', '-', $row['acf_fc_layout']); ?> <?= ($row['keep_mobile_layout'] == true) ? 'keep-grid' : 'break-grid'; ?>">
        <?php gm_content_columns($row); ?>
      </div>
    <?php endforeach; ?>
  <?php else: 
    the_content();
  endif;
}

/*
 * Setup Content Columns
 */
function gm_content_columns($content) {
  $columns = $content['columns'];
  foreach ($columns as $column): ?>
    <div class="col width-<?= $column['column_width']; ?>">
    <?php
    foreach ($column['column_content'] as $column_content): ?>
      <div
        class="col-content col-<?= str_replace('_', '-', $column_content['acf_fc_layout']); ?><?= ' width-1_'.$column_content['content_width']; ?>" 
        style="--content-width:<?= 100/$content_width.'%;'; ?><?= (array_key_exists('content_height', $column_content)) ? ' --content-height:'.$column_content['content_height'].';' : ' '; ?>">
        <?php gm_content($column_content); ?>
      </div>
    <?php endforeach ?>
    </div>
  <?php endforeach;
}

/*
 * Setup Contents
 */
function gm_content($content) {
  if ($content['acf_fc_layout'] === 'content_image') {
    gm_content_image($content);
  } else if ($content['acf_fc_layout'] === 'content_image_slider') {
    gm_content_image_slider($content);
  } else if ($content['acf_fc_layout'] === 'content_textarea') {
    gm_content_textarea($content);
  } else if ($content['acf_fc_layout'] === 'content_spacer') {
    gm_content_spacer($content);
  }
}
/*
 * Setup Image
 */
function gm_content_image($content) {
  $content_image_file_id = $content['content_image_file'];
  $content_image_file_ratio = (getimagesize(wp_get_attachment_url($content_image_file_id))) ? (getimagesize(wp_get_attachment_url($content_image_file_id))[1] / getimagesize(wp_get_attachment_url($content_image_file_id))[0]) : 'auto';
  if (array_key_exists('content_link', $content) && $content['content_link']['link_array']): ?>
    <a class="content-image-wrapper"
      href="<?= $content['content_link']['link_array']['url']; ?>"
      <?= ($content['content_link']['link_array']['target']) ? ' target="'.$content['content_link']['link_array']['target'].'"' : ''; ?>
      style="--ratio: <?= $content_image_file_ratio ?>">
      <img class="content-image lazyload"
        srcset="<?= wp_get_attachment_image_srcset($content_image_file_id); ?>"
        data-sizes="auto"
        data-src="<?= wp_get_attachment_url($content_image_file_id); ?>">
    </a>
  <?php else: ?>
    <div class="content-image-wrapper"
      style="--ratio: <?= $content_image_file_ratio ?>">
      <img class="content-image lazyload"
        srcset="<?= wp_get_attachment_image_srcset($content_image_file_id); ?>"
        data-sizes="auto"
        data-src="<?= wp_get_attachment_url($content_image_file_id); ?>">
    </div>
  <?php endif;
}
/*
 * Setup Image-Slider
 */
function gm_content_image_slider($content) {
  $content_images_count = count($content['content_slider_files']); ?>
  <div class="content-slider-container">
    <div class="swiper" data-slide-count="<?= $content_images_count ?>">
      <div class="swiper-wrapper">
        <?php foreach ($content['content_slider_files'] as $content_image_file_id): ?>
          <?php $content_image_file_ratio = (getimagesize(wp_get_attachment_url($content_image_file_id))) ? (getimagesize(wp_get_attachment_url($content_image_file_id))[1] / getimagesize(wp_get_attachment_url($content_image_file_id))[0]) : 'auto'; ?>
          <div class="swiper-slide">
            <div class="content-slider-image-wrapper"
              style="--ratio: <?= $content_image_file_ratio ?>">
              <img class="content-slider-image lazyload"
                data-srcset="<?= wp_get_attachment_image_srcset($content_image_file_id); ?>"
                sizes="<?= wp_get_attachment_image_sizes($content_image_file_id); ?>"
                data-src="<?= wp_get_attachment_url($content_image_file_id); ?>"
                alt="<?= gm_get_context()['site_title'] ?>"/>
            </div>
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
  <?php
}

/*
 * Setup Expandables
 */
function gm_content_expandables($content) {
  ?>
  <div class="content-expandables-container">
    <?php foreach ($content['content_expandable_posts'] as $item): ?>
      <div class="content-expandables-item-container">
        <h3><?= $item['content_exp_heading'] ?></h3> <?php // add toggle button? ?>
        <div class="text-content-wrapper collapsed">
          <?= $item['content_exp_text'] ?>
        </div>
      </div>
    <?php endforeach ?>
  </div>
  <?php
}

/*
 * Setup Textarea
 */
function gm_content_textarea($content) {
  ?>
  <div class="content-textarea-container">
    <?php if (count($content['content_textarea_headline']) > 0): ?>
      <h3><?= $content['content_textarea_headline']; ?></h3>
    <?php endif ?>
    <?php if (count($content['content_textarea_text']) > 0): ?>
      <?= $content['content_textarea_text']; ?>
    <?php endif ?>
  </div>
  <?php
}
/*
 * Setup Spacer
 */
function gm_content_spacer($content) {
  // could add <hr>
}








/* NOT IN USE */



/*
 * Setup Video
 */
function gm_content_video($content) {
  $video_ratio = $content['content_video_file']['height'] / $content['content_video_file']['width'];
if (array_key_exists('content_link', $content) && $content['content_link']['link_array']/* && is_shop()*/) { ?>
    <a class="content-video-container" style="--ratio:<?= $video_ratio; ?>" href="<?= $content['content_link']['link_array']['url']; ?>"<?= ($content['content_link']['link_array']['target']) ? ' target="'.$content['content_link']['link_array']['target'].'"' : ''; ?>>
      <video class="content-video" poster="<?= wp_get_attachment_url($content['content_video_placeholder']); ?>" data-src="<?= $content['content_video_file']['url']; ?>" autoplay loop muted playsinline></video>
    </a>
  <?php } else { ?>
    <div class="content-video-container" style="--ratio:<?= $video_ratio; ?>">
      <video class="content-video" poster="<?= wp_get_attachment_url($content['content_video_placeholder']); ?>" data-src="<?= $content['content_video_file']['url']; ?>" autoplay loop muted playsinline></video>
    </div>
  <?php }
}