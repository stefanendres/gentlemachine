<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		<?php //</div><!-- .col-full -->?>
	</div><?php //<!-- #content -->?>
	<footer class="site-footer">
		<?php do_action( 'gm_footer' ); ?>
	</footer>
<?php //</div><!-- #page -->?>
		<script type="text/javascript">
			var theme_url = '<?php echo gm_get_context()['theme_url']; ?>';
		</script>
		<?php wp_footer(); ?>
		<?php cookie_notice(); ?>
	</body>
</html>
