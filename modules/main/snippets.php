<?php

function cookie_notice() {
  $cookie_notice_text = get_field('cookie_notice_text', 'options');
  $cookie_button_text = get_field('cookie_button_text', 'options');
  $cookie_notice_link = get_field('cookie_notice_link', 'options');
  ?>
  <div class="cookie-notice-container">
    <p><?= $cookie_notice_text ?></p>
		<a href="<?= $cookie_notice_link['url'] ?>"><?= $cookie_notice_link['title'] ?></a>
    <button><?= $cookie_button_text ?></button>
	</div>
  <?php
}

/*
 * 404
 */
function content_404() {
  ?>
  <h1 class="page-title">Page not found</h1>
  <h2>The page you are looking for can not be found.</h2>
  <?php
}


?>
