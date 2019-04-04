<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photolog
 */

$featured_class = '';
if ( ! has_post_thumbnail() ) {
	$featured_class = 'no-featured-image'; 
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $featured_class ); ?>>
	<div class="entry-header" <?php photolog_featured_background(); ?>></div>

	<div class="entry-content">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'photolog' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'photolog' ),
				'after'  => '</div>',
			) );
		?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php photolog_posted_on(); ?>
			<?php photolog_entry_footer(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		

	</div><!-- .entry-content -->

</article><!-- #post-## -->
