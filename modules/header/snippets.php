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
  ?>
  <div class="shop-link-container">
    <a class="header-link<?= (is_shop()) ? ' active' : '' ?>" href="<?= get_permalink($page_id); ?>">
      <?= get_post($page_id)->post_title ?>
    </a>
  </div>
  <?php
}

function storefront_cart_link() {
  $count_value = (WC()->cart->get_cart_contents_count() > 0) ? WC()->cart->get_cart_contents_count() : '&ensp;';
  $cart_icon_url = wp_get_attachment_image_src(get_field('cart_icon', 'options'))[0];
  ?>
    <a class="header-link cart-link cart-contents" href="<?= get_permalink( wc_get_page_id( 'cart' ) ); ?>">
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

function gm_header_container_logo() {
  $site_logo_url = wp_get_attachment_image_src(get_field('site_logo', 'options'))[0];
  ?>
  <div class="logo-container">
    <a class="header-link" href="<?= gm_get_context()['site_url'] ?>">
      <span style="color:transparent;position:absolute;pointer-events:none;">Home</span>
      <img class="logo-image" src="<?= $site_logo_url ?>" alt="Gentlemachine Logo"/>
    </a>
  </div>
  <?php
}

function gm_header_container_myaccount_link() {
  $page_id = wc_get_page_id('myaccount');
  ?>
  <div class="myaccount-link-container">
    <a class="header-link<?= (gm_is_page_active($page_id)) ? ' active' : '' ?>" href="<?= get_permalink( $page_id); ?>">
      <?= (is_user_logged_in()) ? get_post($page_id)->post_title : 'Sign in' ?>
    </a>
  </div>
  <?php
}

function gm_header_container_language_switch() {
  ?>
  <div class="lang-switch-container">
    <?= do_shortcode('[language-switcher]'); ?>
  </div>
  <?php
}

function gm_header_container_menu_button() {
  ?>
  <div class="menu-button-container">
    <button class="menu-button" name="Menu">
      <div></div>
      <div></div>
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
  </nav>
 <?php
}

/*function gm_menu_shop_link_list() {
  $args = array(
    'taxonomy' => "product_cat",
    'parent' => null
  );
  $product_categories = get_terms($args);
  ?>
  <div class="menu menu-shop-links">
    <h3 class="menu-heading">Shop</h3>
    <ul class="menu-list">
  <?php
  foreach ($product_categories as $product_category) {
    ?>
      <li class="menu-item">
        <a class="menu-link<?= (gm_get_current_page_slug() === $product_category->slug) ? ' active' : '' ?>" href="<?= get_category_link($product_category); ?>"><?= $product_category->name; ?></a>
      </li>
    <?php
  }
  ?>
    </ul>
  </div>
  <?php
}*/

function gm_menu_info_link_list() {
  $page_slugs = array();
  $pages = get_pages(['post_status' => 'publish', 'sort_column' => 'menu_order']);
  foreach ($pages as $page) {
    if (!$page->post_content && $page->post_name !== 'shop') {
      $page_slugs[] = $page->post_name;
    }
  }
  ?>
  <div class="menu-wrapper">
    <div class="menu menu-info-links">
      <ul class="menu-list">
    <?php
    foreach ($page_slugs as $slug) {
      $page = get_page_by_path($slug);
      if ($page->post_status === "publish") {
        ?>
          <li class="menu-item">
            <a class="menu-link<?= (gm_get_current_page_slug() === $slug) ? ' active' : '' ?>" href="<?= get_permalink($page); ?>"><?= $page->post_title; ?></a>
          </li>
        <?php
      }
    }
    ?>
      </ul>
    </div>
  <?php
}

function gm_menu_connect_link_list() {
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
}


?>