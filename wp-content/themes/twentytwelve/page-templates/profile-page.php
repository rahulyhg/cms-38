<?php
/**
 *Template Name: Profile Page Template
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
  acf_form_head();
  get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php 

 if ( !is_user_logged_in() ){ 
 echo 'You are not logged in. <br /> <a href="'.wp_login_url( get_permalink() ).'</a>';

 } else {

 $options = array(
 'post_id' => 'user_'.$current_user->ID, // $user_profile,
 'field_groups' => array(67),
 'submit_value' => 'Update Profile'
 );

 echo '<p>Your username is <b>'.$current_user->user_login.'</b>. This cannot be changed.</p>';

 acf_form( $options ); 
 }

 ?>
 <?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>