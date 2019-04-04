<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Photolog
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function photolog_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'photolog_infinite_scroll_render',
		'footer'    => 'page',
		'wrapper'	=> false
	) );

	// Site logo
	$args = array(
		'header-text' => array(
			'site-title',
			'site-description',
		),
		'size' => 'qua-site-logo',
	);
	add_theme_support( 'site-logo', $args );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
} // end function photolog_jetpack_setup
add_action( 'after_setup_theme', 'photolog_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function photolog_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function photolog_infinite_scroll_render
