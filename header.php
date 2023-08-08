<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */
?><!doctype html>
<?php
	if (!isset($product)) {
		$product = null;
	}
?>
<html lang="en">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php // gm_structured_data($product); ?>

		<meta name="description" content="<?php //echo gm_get_meta()['description']; ?>">
		<meta name="copyright" content="<?= get_bloginfo('name'); ?>">
		<meta property="og:type" content="website">
		<meta property="og:title" content="<?= wp_title('–', true, 'right').''.get_bloginfo('name'); ?>">
		<meta property="og:site_name" content="<?= get_bloginfo('name'); ?>">
		<meta property="og:url" content="<?= get_bloginfo('url'); ?>">
		<meta name="og:description" content="<?php //echo gm_get_meta()['description']; ?>">
		<meta name="og:image" content="<?php //echo gm_get_meta()['image']; ?>">
		<meta property="og:image:type" content="<?php //echo getimagesize(gm_get_meta()['image'])['mime']; ?>" />
		<meta property="og:image:width" content="<?php //echo getimagesize(gm_get_meta()['image'])[0]; ?>" />
		<meta property="og:image:height" content="<?php //echo getimagesize(gm_get_meta()['image'])[1]; ?>" />

		<?php wp_head(); ?>
		<script type="text/javascript" src="<?= gm_get_context()['theme_url']; ?>/modernizr.js"></script>
	</head>

	<body <?php body_class(); ?>>

	<?php do_action( 'storefront_before_site' ); ?>

	<?php //<div id="page" class="hfeed site"> ?>
		<?php do_action( 'storefront_before_header' ); ?>

		<header class="site-header">

			<?php
			/**
			 * Functions hooked into storefront_header action
			 *
			 * @hooked storefront_header_container                 - 0
			 * @hooked storefront_skip_links                       - 5
			 * @hooked storefront_social_icons                     - 10
			 * @hooked storefront_site_branding                    - 20
			 * @hooked storefront_secondary_navigation             - 30
			 * @hooked storefront_product_search                   - 40
			 * @hooked storefront_header_container_close           - 41
			 * @hooked storefront_primary_navigation_wrapper       - 42
			 * @hooked storefront_primary_navigation               - 50
			 * @hooked storefront_header_cart                      - 60
			 * @hooked storefront_primary_navigation_wrapper_close - 68
			 */
			do_action( 'storefront_header' );
			?>

		</header>
		
		<?php do_action( 'gm_main_menu' ); ?>
		
		<?php if (gm_is_shop_page()): ?>
			<div class="product-filter is-visible">
				<button class="product-filter-button" name="Filter Products">Filter</button>
				<div class="product-filter-container">
					<?= do_shortcode("[br_filters_group group_id=58]"); ?>
				</div>
			</div>
		<?php endif ?>

		<?php
		/**
		 * Functions hooked in to storefront_before_content
		 *
		 * @hooked storefront_header_widget_region - 10
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'storefront_before_content' );
		?>
		<div id="content" class="site-content">
			<?php //<div class="col-full"> ?>

			<?php
			do_action( 'storefront_content_top' );
