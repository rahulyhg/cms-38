<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="stylesheet" href="http://www.showcasestreaming.com/player/skin/minimalist.css"/>
<script type="text/javascript" src="http://www.showcasestreaming.com/cam/flowplayer-3.2.12.min.js"></script>
<link rel="stylesheet" href="http://www.showcasestreaming.com/Scripts/jquery-ui-1.10.1.custom.css"/>
<script type="text/javascript" src="http://www.showcasestreaming.com/Scripts/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://www.showcasestreaming.com/Scripts/jquery-ui.js"></script>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<script type="text/javascript">
  $(function() {
    $( "#container" ).resizable({
      aspectRatio: 4 / 3,
	  maxHeight: 480,
      maxWidth: 640,
      minHeight: 180,
      minWidth: 240,
		})
		});
  </script>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php 
$user_info = get_userdata( $post -> post_author );
?>
<div id="page" class="hfeed site" style="background-color:<?php echo '' . $user_info->background_color . "\n" ?>; color:<?php echo '' . $user_info->font_color . "\n" ?>; background-image:url('<?php echo '' . $user_info->background_image ?>');">
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

		<nav id="site-navigation" class="main-navigation" role="navigation" style="margin-left: 20px; margin-right: 20px; background-color:#0000B7; color: #FF0">
			<button class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></button>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<div style="margin-left:10px"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );?>
			<p style="color:#FF0">Streaming Service provided by <a href="http://www.showcasestreaming.com" class="popup2" style="color:#FF0">ShowCase Streaming</a>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="main" class="wrapper">