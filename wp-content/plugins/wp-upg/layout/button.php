<?php
//Display post button at grid page
//add_action( 'upg_grip_top' , 'upg_show_button', 10 , 0 );

function upg_show_button()
{
	$options = get_option( 'upg_settings','' );
	$album_name="";
	
	$term_slug = get_query_var( 'upg_cate' );
	$term = get_term_by('slug', $term_slug, 'upg_cate');
	
	if($term_slug!="")
	$album_name=$term->name;
	
	//echo $album_name;
	
	
	if(isset($options['primary_show_image_button']))
	{
		
		$image_button=$options['primary_show_image_button'];
		
		
		if(isset($options['post_image_page']))
		{
			
					
			$post_7 = get_post($options['post_image_page'], ARRAY_A);
			$page_title = $post_7['post_title'];
			
			$arg=get_the_title();
			
			if($album_name=="")
			{
				$linku=esc_url( get_permalink($options['post_image_page']) );
			}
			else
			{
				$linku=esc_url( add_query_arg( 'album', $arg, get_permalink($options['post_image_page']) ) );
			}
			
			if($image_button=="1")
			echo "<a href='".$linku."' class='pure-button' id='upg_button' style='margin:5px'>   <i class='fa fa-upload fa-lg'></i> ".$page_title."</a> ";
		}
		
		
	}
	
		if(isset($options['primary_show_youtube_button']))
	{
		$image_button=$options['primary_show_youtube_button'];
		if(isset($options['post_youtube_page']))
		{
			
			//$linku=esc_url( get_permalink($options['post_youtube_page']) );
			
			$post_7 = get_post($options['post_youtube_page'], ARRAY_A);
			$page_title = $post_7['post_title'];
			
			$arg=get_the_title();
			
			if($album_name=="")
			{
				$linku=esc_url( get_permalink($options['post_youtube_page']) );
			}
			else
			{
			$linku=esc_url( add_query_arg( 'album', $arg, get_permalink($options['post_youtube_page']) ) );
			}
			
			
			if($image_button=="1")
			echo "<a href='".$linku."' class='pure-button' id='upg_button' style='margin:5px'>   <i class='fa fa-youtube fa-lg'></i> ".$page_title."</a>";
		}
		
	}
	
}
?>