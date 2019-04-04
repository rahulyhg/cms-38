<?php
/**
 * The footer containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photolog
 */
?>

<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
	<div class="footer-widgets clear">
		<?php if ( is_active_sidebar( 'footer-1' ) ): ?>
			<div class="widget-area footer-left">
				<?php dynamic_sidebar( 'footer-1' ); ?>
			</div><!-- .widget-area -->
		<?php endif; //is_active_sidebar ?>

		<?php if ( is_active_sidebar( 'footer-2' ) ): ?>
			<div class="widget-area footer-center">
				<?php dynamic_sidebar( 'footer-2' ); ?>
			</div><!-- .widget-area -->
		<?php endif; //is_active_sidebar ?>

		<?php if ( is_active_sidebar( 'footer-3' ) ): ?>
			<div class="widget-area footer-right">
				<?php dynamic_sidebar( 'footer-3' ); ?>
			</div><!-- .widget-area -->
		<?php endif; //is_active_sidebar ?>
	</div><!-- .footer-widgets -->
<?php endif; ?>
