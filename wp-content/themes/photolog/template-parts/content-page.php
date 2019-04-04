<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photolog
 */

$featured_class = '';
if ( ! has_post_thumbnail() ) {
	$featured_class = 'no-featured-image-single'; 
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="entry-header" <?php photolog_featured_background(); ?>></div>
	<?php } ?>
	<div class="entry-content <?php echo $featured_class; ?>">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'photolog' ),
				'after'  => '</div>',
			) );
		?>
			<div class="entry-meta">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'photolog' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</div><!-- .entry-footer -->
	</div><!-- .entry-content -->

</article><!-- #post-## -->

