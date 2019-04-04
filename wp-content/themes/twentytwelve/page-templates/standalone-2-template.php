<?php
/**
 * Template Name: Standalone 2 Template
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(standalone); ?>

<div id="primary" class="site-content" style="border:none; width:100%;">
		<div id="content" role="main" style="border:none">
		    <?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'standalone-2-content', 'page' ); ?>
							  
				<?php comments_template( '', false ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>