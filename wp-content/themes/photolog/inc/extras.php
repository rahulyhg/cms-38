<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Photolog
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function photolog_body_classes( $classes ) {
	global $wp_query;

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if( get_header_image() ) {
		$classes[] = 'has-header-image';
	}

	$current_page = $wp_query->get( 'paged' );
	if ( ! is_single() && ( ! $current_page || $current_page == $wp_query->max_num_pages ) ) {
	    $classes[] = 'no-page';
	}

	return $classes;
}
add_filter( 'body_class', 'photolog_body_classes' );

/*
 * Header Image
 *
 */
function photolog_header_image() {
    // first, check for header image
    if ( get_header_image() ) {
        $header_image = get_header_image();

        $header_img = 'style="background-image: url(' . esc_url( $header_image ) . ');' . '"';
 
        echo $header_img;
    }
}

/*
 * Featured Image set as background
 *
 */
function photolog_featured_background( $post = NULL ) {
    // first, check for featured image and set to background for post
    if ( has_post_thumbnail( $post ) ) {
        // get the featured image source
        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post ), 'large' );

        //$ratio = 2;
        $bg_img = 'style="background-image: url(' . esc_url( $featured_image[0] ) . ');' . '"';
 
        echo $bg_img;
    }
}

/**
 * GPP Pro URL
 */
function photolog_get_pro_link() {
    $theme = wp_get_theme();
    return $theme->get( 'ThemeURI' ) . '#download';
}

/**
 * Determine if the companion plugin is installed.
 *
 * @since  1.0
 *
 * @return bool    Whether or not the companion plugin is installed.
 */
function photolog_is_pro() {
    /**
     * Allow for toggling of the GPP Pro status.
     * @param bool    $is_pro    Whether or not GPP Pro is installed.
     */
    return apply_filters( 'photolog_is_pro', defined( 'GPP_PRO' ) );
}
