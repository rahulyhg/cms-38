<?php
global $post; 
global $wp_query;

$options = get_option('upg_settings');

$postsperpage = $options['global_perpage'];
$perrow = $options['global_perrow'];
$album=$options['global_album'];
$orderby=$options['global_order'];

if(isset($params['perpage'])&&$params['perpage']>0) $postsperpage = $params['perpage'];
if(isset($params['perrow'])&&$params['perrow']>0) $perrow = $params['perrow'];
if(isset($params['album'])) $album = trim($params['album']);
if(isset($params['orderby'])) $orderby = $params['orderby'];

if(isset($params['layout']))
	$layout=trim($params['layout']);
else
	$layout=$options['global_layout'];

if(isset($params['charlimit']))
	$charlimit=trim($params['charlimit']);
else
	$charlimit=55;

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;


if($album!='')
{
$args = array(
	'paged' => $paged,
	'posts_per_page' => $postsperpage,
	'orderby' => $orderby,
	'order'   => 'DESC',
	'author_name' => $user,
	'tax_query' => array(
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => explode(',',$album),
			//'terms'    => array( 'mobile', 'sports' ),
		),
		
	),
);
}
else
	
{
	$args = array(
	'paged' => $paged,
	'posts_per_page' => $postsperpage,
	'author_name' => $user,
);

}


$query = new WP_Query($args); 
	

$put="";
ob_start ();
if(file_exists(upg_BASE_DIR."/layout/grid/".$layout."/".$layout."_config.php"))
	include(upg_BASE_DIR."/layout/grid/".$layout."/".$layout."_config.php");

if(file_exists(upg_BASE_DIR."/layout/grid/".$layout."/".$layout."_wppost_up.php"))
	include(upg_BASE_DIR."/layout/grid/".$layout."/".$layout."_wppost_up.php");
	else
	echo __('Layout Not Found. Check Settings and save update again.','wp-upg').": ".$layout."_wppost";

while($query->have_posts()) : $query->the_post();
$permalink=get_permalink();
$thetitle=get_the_title();
$image=get_the_post_thumbnail_url($post->ID);

$the_content = get_the_excerpt();
$excerpt_removed_shortcode = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', strip_shortcodes($the_content));
			
$the_content= apply_filters('post_grid_filter_grid_item_excerpt',wp_trim_words($excerpt_removed_shortcode, $charlimit ,' ...'));



if($image=="")
	$image=plugins_url( '../images/noimg.png', __FILE__ );

$image_large=get_the_post_thumbnail_url($post->ID, 'full');

if(!$image_large)
	$image_large=plugins_url( '../images/noimg.png', __FILE__ );

if(file_exists(upg_BASE_DIR."/layout/grid/".$layout."/".$layout."_wppost.php"))
	include(upg_BASE_DIR."/layout/grid/".$layout."/".$layout."_wppost.php"); 


endwhile;


if(file_exists(upg_BASE_DIR."/layout/grid/".$layout."/".$layout."_wppost_down.php"))
	include(upg_BASE_DIR."/layout/grid/".$layout."/".$layout."_wppost_down.php");


if(function_exists('wp_pagenavi'))
{
	if($page=="on")
	echo "<br>".wp_pagenavi( array( 'query' => $query ) );
}

$put=ob_get_clean (); 
return $put;

?>