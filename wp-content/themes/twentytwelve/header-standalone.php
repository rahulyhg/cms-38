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
<meta name="description" content="ShowCase Streaming: The Possibilities are Endless! Complete service live cam hosting." />
<meta name="keywords" content="show, case, showcase, streaming, live, cam, camera, animals, life, event, horse, dog, cat, bird, lifecasting" />
<meta name="author" content="Leslie McCullough"/>

<link rel="stylesheet" href="http://cms.showcasestreaming.com/player/skin/minimalist.css"/>
<script type="text/javascript" src="http://cms.showcasestreaming.com/player/flowplayer-3.2.12.min.js"></script>
<script type="text/javascript" src="http://www.showcasestreaming.com/Scripts/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://www.showcasestreaming.com/Scripts/jquery-ui.js"></script>

<link rel="stylesheet" href="http://www.showcasestreaming.com/Scripts/jquery-ui-1.10.1.custom.css"/>
<link rel="profile" href="http://gmpg.org/xfn/11" />

<script type="text/javascript">
$(window).resize(function(){
	aspectRatio: 4 / 3,
    $("#player").width($(window).width(),
	 $("#player").height($(window).height()))
});
  </script>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
# get post data
$temp_post = get_post($post_id);

# grab the author meta
$author_id = $temp_post->post_author;

# grab the field you're looking for
$font_color = get_the_author_meta('font_color', $author_id);
$background_color = get_the_author_meta('background_color', $author_id);
$panel_color = get_the_author_meta ('panel_background_color', $author_id);
$background_panel = get_field('panel_background_image', 'user_' . $author_id);
$background_main = get_field('background_image', 'user_' . $author_id);

?>

<?php wp_head(); ?>
<style type="text/css">
a {
	outline: none;
	color:<?php echo $font_color ?>; ;
}
a:hover {
	color: #0f3647;
}
</style>

</head>

<body style="background-color:<?php echo $panel_color; ?>; color:<?php echo $font_color ?>;">

<div id="page" style="background-color:<?php echo $panel_color; ?>; color: <?php echo $font_color ?>; ">

<p style="color:<?php echo $font_color ?>">Streaming Service provided by <a href="http://www.showcasestreaming.com">ShowCase Streaming</a>
			</div>
	<div id="main" class="wrapper">