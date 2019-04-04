<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Photolog
 */

get_header(); 

$featured_class = '';
if ( ! has_post_thumbnail() ) {
	$featured_class = 'no-featured-image'; 
}
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<article class="error-404 not-found hentry <?php echo $featured_class; ?>">
				<div class="entry-header"><p>404</p></div>

				<div class="entry-content">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'photolog' ); ?></h1>
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'photolog' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .entry-content -->
			</article><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
