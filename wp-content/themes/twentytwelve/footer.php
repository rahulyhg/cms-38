<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>


	<footer id="colophon" role="contentinfo">
		<div class="site-info">
		
		<?php
					if ( is_user_logged_in() ) {
					    echo '<a href="'.wp_logout_url( get_permalink() ).'" title="Logout" class="hunderline">Logout</a>';
					} else {
					    echo '<a href="'.wp_login_url( get_permalink() ).'" title="Login" class="hunderline">Login</a>';
					}
					?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>