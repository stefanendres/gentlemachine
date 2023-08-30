<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package storefront
 */

/**
 * Functions hooked in to storefront_page add_action
 *
 * @hooked storefront_page_header          - 10
 * @hooked storefront_page_content         - 20
 */
    if (is_front_page()) {
        home_content();
    } else if (gm_get_current_page_slug() === 'news') {
        news_content();
    } else {
        do_action( 'storefront_page' );
    }
?>
