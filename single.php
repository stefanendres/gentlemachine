<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		/*
		while ( have_posts() ) :
			the_post();

			do_action( 'storefront_single_post_before' );

			get_template_part( 'content', 'single' );

			do_action( 'storefront_single_post_after' );

		endwhile; // End of the loop.*/
		
		//var_dump($post->ID);

		do_action( 'storefront_page' );
		$news_page = get_page_by_path('news');
		?>
		<div class="row observe-vp">
        	<div class="row-content width-100">
				<a class="link-news-back button-style" href="<?= get_permalink($news_page) ?>">
					more news
      			</a>
    		</div>
        </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//do_action( 'storefront_sidebar' );
get_footer();
