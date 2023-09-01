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
      <div class="row observe-vp">
        <?php gm_content_columns($row); ?>
      </div>
    <?php endforeach;
  endif;// else: the_content(); endif;
}

/*
 * Setup Content Columns
 */
function gm_content_columns($content) {
  $row_width = $content['row_width'];
  $row_content = $content['row_content'][0];
  ?>
  <div class="row-content <?= str_replace('_', '-', $row_content['acf_fc_layout']); ?><?= ' width-'.$row_width ?>">
    <?php gm_content($row_content); ?>
  </div>
  <?php
}

/*
 * Setup Contents
 */
function gm_content($content) {
  //var_dump($content);
  
  if ($content['acf_fc_layout'] === 'content_image') {
    gm_content_image($content);
  } else if ($content['acf_fc_layout'] === 'content_textarea') {
    gm_content_textarea($content);
  } else if ($content['acf_fc_layout'] === 'content_text_small') {
    gm_content_textsmall($content);
  } else if ($content['acf_fc_layout'] === 'content_text_large') {
    gm_content_textlarge($content);
  } else if ($content['acf_fc_layout'] === 'content_links') {
    gm_content_linklist($content);
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
  ?>
    <div class="content-image-wrapper"
      style="--ratio: <?= $content_image_file_ratio ?>">
      <img class="content-image lazyload"
        srcset="<?= wp_get_attachment_image_srcset($content_image_file_id); ?>"
        data-sizes="auto"
        data-src="<?= wp_get_attachment_url($content_image_file_id); ?>"
        alt="TOOOOOOOOOODOOOOOOOOOOOO">
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
    <?php if (strlen($content['content_textarea_text']) > 0): ?>
      <?= $content['content_textarea_text']; ?>
    <?php endif ?>
  </div>
  <?php
}

/*
 * Setup Text Small
 */
function gm_content_textsmall($content) {
  ?>
  <small class="content-textsmall-container">
    <?php if (strlen($content['content_text_small_text']) > 0): ?>
      <?= $content['content_text_small_text']; ?>
    <?php endif ?>
    </small>
  <?php
}

/*
 * Setup Text Small
 */
function gm_content_textlarge($content) {
  ?>
  <h3 class="content-textlarge-container">
    <?php if (strlen($content['content_text_large_text']) > 0): ?>
      <?= $content['content_text_large_text']; ?>
    <?php endif ?>
  </h3>
  <?php
}

/*
 * Setup Link-List
 */
function gm_content_linklist($content) {
  ?>
  <ul class="content-linklist-container">
    <?php foreach ($content['content_links_list'] as $item): ?>
      <?php $item = $item['content_links_list_link']; ?>
      <li class="content-linklist-item">
        <?php if ($item['target']): ?>
          <a class="content-linklist-link" target="<?= $item['target'] ?>" rel="noreferrer noopener" href="<?= $item['url'] ?>">
        <?php else: ?>
          <a class="content-linklist-link" href="<?= $item['url'] ?>">
        <?php endif; ?>
          <?= $item['title'] ?>
        </a>
      </li>
    <?php endforeach ?>
    </ul>
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