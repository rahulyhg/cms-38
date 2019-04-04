<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
<?php
function upg_product_content($post)
{
	$options = get_option('upg_settings');
	
	
	$text=wpautop( stripslashes ($post->post_content));
	
	require_once(upg_BASE_DIR."layout/media/header.php");
	$abc="";
	 $home = home_url('/');
	ob_start ();
	$image=upg_image_src('large',$post);
	$image_medium=upg_image_src('medium',$post);
	
	$author = get_user_by('id', get_the_author_meta( 'ID' ));
	//echo $author->first_name;
	//echo $author->user_nicename;
	
	$ecardactive=false;
 
	if ( is_plugin_active( 'odude-ecard/odude-ecard.php' ) ) 
	{
		 $ecardactive=true;
	} 
	
	if($ecardactive)
	{
		$ecard_layout=upg_get_value('ecard_layout');
		if($ecard_layout)
		require_once(odudecard_BASE_DIR."/layout/media/".$ecard_layout."/".$ecard_layout.".php");
		else
		require_once(odudecard_BASE_DIR."/layout/media/basic/basic.php");
	}
	else
	{
	?>
	This features only available if you install <a href="https://wordpress.org/plugins/odude-ecard/">ODude Ecard</a> Free Plugin.
	<br>Don't forget to activate and set required settings at ODude Ecard.
	
	<?php
	}


	$abc=ob_get_clean (); 
	return $abc;
}