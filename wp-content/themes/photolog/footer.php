<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photolog
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php get_sidebar(); ?>

		<?php if ( ( has_nav_menu( 'social' ) || 'show' == get_theme_mod( 'default_credits' ) ) || ( 'hide' == get_theme_mod( 'default_credits' ) && '' != get_theme_mod( 'custom_credits' ) ) ) { ?>
		<div class="site-info">
			<?php if ( has_nav_menu( 'social' ) ) { ?>
			<div class="social-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'social', 'container' => 'false', 'menu_class' => 'menu-social', 'depth' => -1 )); ?>
			</div><!-- .social-menu -->
			<?php } ?>

			<?php if ( 'hide' == get_theme_mod( 'default_credits' ) ) {
				echo esc_html( get_theme_mod( 'custom_credits' ) );
			} else {
				echo sprintf( esc_html__( 'Proudly powered by %1$s. Theme: %2$s by %3$s.', 'photolog' ), '<a href="https://wordpress.org/">WordPress</a>', '<a href="http://graphpaperpress.com/themes/photolog">Photolog</a>', '<a href="http://graphpaperpress.com/">Graph Paper Press</a>' );
			} ?>
			
		</div><!-- .site-info -->
		<?php }?>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
