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
	$image_full=upg_image_src('full',$post);
	
	$author = get_user_by('id', get_the_author_meta( 'ID' ));
	//echo $author->first_name;
	//echo $author->user_nicename;
	
	//create this file
	$filename=dirname(__FILE__)."/".get_current_blog_id()."_content.php";
	
	//IF file not exist
   if( ! file_exists( $filename ) )
	{
		
		$upload_dir = wp_upload_dir();
		$user_dirname = $upload_dir['basedir'].'/upg_media_personal.php';
		
		
		if( file_exists( $user_dirname ) )
		{
			//copy files from upload folder
			if (!copy($user_dirname, $filename)) 
			{
				echo "failed to copy $user_dirname...\n";
			}
			
			
		}
		else
		{
			//Get content from sample file and save the file
			$sample_filename=dirname(__FILE__)."/sample.txt";
			$sample_content =  file_get_contents($sample_filename);
		
			$file = fopen($filename,"w+");
			fwrite($file, $sample_content);
			
		}
		
		
	}
	else
	{
		include(get_current_blog_id()."_content.php");
	}
		


	$abc=ob_get_clean (); 
	return $abc;
}
?>