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
		<div class="main-footer-container">
			<?php //do_action( 'gm_footer' ); ?>
		</div>
	</footer>
<?php //</div><!-- #page -->?>
<script type="text/javascript">
	var theme_url = '<?php echo gm_get_context()['theme_url']; ?>';
</script>
<?php wp_footer(); ?>

</body>
</html>
