<?php
/*
 * Setup Primary Header opening and closing tags
 */
function gm_header_container_open() {
  ?>
  <div class="main-header-container">
  <?php
}

function gm_header_container_close() {
  ?>
  </div>
  <?php
}

/*
 * Setup Primary Header Contents
 */

function gm_header_container_shop_link() {
  $page_id = wc_get_page_id('shop');
  $shop_icon_url = wp_get_attachment_image_src(get_field('shop_icon', 'options'))[0];
  ?>
  <div class="shop-link-container">
    <a class="header-link<?= (is_shop()) ? ' active' : '' ?>" href="<?= get_permalink($page_id); ?>">
      <span style="color:transparent;position:absolute;pointer-events:none;"><?= get_post($page_id)->post_title ?></span>
      <img class="shop-icon" src="<?= $shop_icon_url ?>" alt="View Shop"/>
    </a>
  </div>
  <?php
}

function storefront_cart_link() {
  $count_value = WC()->cart->get_cart_contents_count();
  $cart_icon_url = wp_get_attachment_image_src(get_field('cart_icon', 'options'))[0];
  ?>
    <a class="header-link cart-link cart-contents" href="<?= get_permalink( wc_get_page_id( 'cart' ) ); ?>">
      <span style="color:transparent;position:absolute;pointer-events:none;">Cart</span>
      <img class="cart-icon" src="<?= $cart_icon_url ?>" alt="View Cart"/>
      <div class="count"><?= $count_value ?></div>
    </a>
  <?php
}
/*
 * Setup Header Cart. Removes cart-widget (dropdown-menu). Storefront's function needs to be overwritten to keep ajax-update working
 */
function storefront_header_cart() {
	if ( storefront_is_woocommerce_activated() ) {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
  	<div class="cart-link-container<?= (is_cart()) ? ' active' : '' ?>" id="site-header-cart">
      <?= storefront_cart_link(); ?>
  	</div>
		<?php
	}
}

function gm_header_container_logo($class) {
  $site_logo_url = wp_get_attachment_image_src(get_field('site_logo', 'options'))[0];
  ?>
  <div class="logo-container<?=$class?>">
    <a class="header-link" href="<?= gm_get_context()['site_url'] ?>">
      <span style="color:transparent;position:absolute;pointer-events:none;">Home</span>
      <img class="logo-image" src="<?= $site_logo_url ?>" alt="Gentlemachine Logo"/>
    </a>
  </div>
  <?php
}

function gm_header_container_myaccount_link() {
  $page_id = wc_get_page_id('myaccount');
  $login_icon_url = wp_get_attachment_image_src(get_field('login_icon', 'options'))[0];
  //$myaccount_icon_url = wp_get_attachment_image_src(get_field('myaccount_icon', 'options'))[0];
  ?>
  <div class="myaccount-link-container">
    <a class="header-link<?= (gm_is_page_active($page_id)) ? ' active' : '' ?>" href="<?= get_permalink( $page_id); ?>">
      <span style="color:transparent;position:absolute;pointer-events:none;"><?= get_post($page_id)->post_title ?></span>
      <?php if (is_user_logged_in()) : ?>
        <div class="user-icon">
          <?= wp_get_current_user()->first_name[0] ?>
        </div>
        <div class="user-name">
          <?= wp_get_current_user()->display_name ?>
        </div>
      <?php else: ?>
        <img class="login-icon" src="<?= $login_icon_url ?>" alt="Log in / Sign in"/>
      <?php endif; ?>
    </a>
  </div>
  <?php
}

function gm_header_container_menu_button() {
  $open_icon_url = wp_get_attachment_image_src(get_field('menu_open_icon', 'options'))[0];
  $close_icon_url = wp_get_attachment_image_src(get_field('menu_close_icon', 'options'))[0];
  ?>
  <div class="menu-button-container">
    <button class="menu-button" name="Menu">
      <img class="menu-open-icon" src="<?= $open_icon_url ?>" alt="Open Menu"/>
      <img class="menu-close-icon" src="<?= $close_icon_url ?>" alt="Close Menu"/>
    </button>
  </div>
  <?php
}





/*
 * Setup Primary Menu
 */
function gm_menu_container_open() {
  ?>
  <nav class="main-menu-container">
  <?php
}

function gm_menu_container_close() {
  ?>
  <div class="menu-background" aria-hidden="true"></div>
  </nav>
 <?php
}

function gm_menu_link_list() {
  ?>
    <ul class="menu-list">
      <?php gm_menu_item('store'); ?>
      <?php gm_menu_item('community'); ?>
      <?php gm_menu_item('news'); ?>
      <?php gm_menu_item('care-repair'); ?>
      <li class="menu-item">
        <?php
          $slug = 'subscription';
        ?>
        <a class="menu-link<?= (gm_get_current_page_slug() === $slug) ? ' active' : '' ?>" href="<?= get_term_link(get_term_by('slug', $slug, 'product_cat')->term_id, 'product_cat') ?>">
          <span style="color:transparent;position:absolute;pointer-events:none;">Aboshop</span>
          <img class="menu-title" src="<?= wp_get_attachment_image_src(get_field('aboshop_name_svg', 'options'))[0]; ?>" alt="Aboshop"/>
        </a>
      </li>
      <?php gm_menu_item('faqs'); ?>
      <li class="menu-item">
        <?= do_shortcode('[language-switcher]'); ?>
      </li>
    </ul>
  <?php
}

function gm_menu_item($slug) {
  $page = get_page_by_path($slug);
  if ($page->post_status === "publish") : ?>
    <li class="menu-item">
      <a class="menu-link<?= (gm_get_current_page_slug() === $slug) ? ' active' : '' ?>" href="<?= get_permalink($page); ?>">
        <span style="color:transparent;position:absolute;pointer-events:none;"><?= $page->post_title; ?></span>
        <img class="menu-title" src="<?= wp_get_attachment_image_src(get_field('page_name_svg', $page->ID))[0]; ?>" alt="<?= $page->post_title; ?>"/>
      </a>
    </li>
  <?php endif;
}

/*function gm_menu_connect_link_list() {
  $social_links = get_field('header_link_list', 'options');
  ?>
    <div class="menu menu-connect-links">
      <h3 class="menu-heading">Connect</h3>
      <ul class="menu-list">
    <?php
    foreach ($social_links as $link) {
      $link = (object) $link['header_link'];
      $classname = ($link->target == '_blank') ? 'menu-link external' : 'menu-link';
      ?>
        <li class="menu-item">
          <a class="<?= $classname; ?>" href="<?= $link->url; ?>" target="<?= $link->target; ?>"><?= $link->title; ?></a>
        </li>
      <?php
    }
    ?>
        <li class="menu-item">
          <a class="menu-link contact-mail-link" href="mailto:<?= gm_get_mail_addresses('info')[0]['address']; ?>">Contact (Email)</a>
        </li>
      </ul>
    </div>
  </div><?php //closes menu-wrapper from gm_menu_info_link_list() ?>
  <?php
}*/


?>