<?php
function upg_list_tags($post)
{
	//Returns All Term Items for "my_taxonomy"
	$term_list = wp_get_post_terms($post->ID, 'upg_tag', array("fields" => "all"));
	//var_dump($term_list);
	
	if(count($term_list)>0)
	echo '<div class="meta-tags clearfix"><ul>';

	for($x = 0; $x < count($term_list); $x++) 
	{
		echo '<li><a href="'.upg_get_category_page_link( $term_list[$x], 'upg_tag' ) .'" rel="tag">'.$term_list[$x]->name.'</a></li>';
	}
	
	if(count($term_list)>0)
		echo '</ul></div>';
	
}


//adding album name at the end of the page
function upg_get_category_page_link( $term, $taxonomy ) 
{

	$page_settings = get_option( 'upg_settings' );
	
	$link = '/';
	
	if( $page_settings['main_page'] > 0 ) {
		$link = get_permalink( $page_settings['main_page'] );
	
		if( '' != get_option( 'permalink_structure' ) ) {
    		$link = user_trailingslashit( trailingslashit( $link ) . $term->slug );
  		} else {
    		$link = add_query_arg( $taxonomy, $term->slug, $link );
  		}
	}
  
	return $link;

}

function upg_sanitize_content($content) 
{
	$allowed_tags = wp_kses_allowed_html('post');
	return wp_kses(stripslashes($content), $allowed_tags);
}

function upg_prepare_post($title, $content) 
{
	$options = get_option('upg_settings');
	
	$postData = array();
	$postData['post_title']   = $title;
	$postData['post_content'] = $content;
	$postData['post_author']  = upg_get_author();
	$postData['post_type']  = 'upg';
	
	if(isset($options['publish']) && $options['publish']=='1' )
	$postData['post_status'] = 'publish';
	
	return apply_filters('upg_post_data', $postData);
}

function upg_get_author() 
{
	if ( is_user_logged_in() )
	{
		$author_id =get_current_user_id();
	} 
	else 
	{
		$options = get_option('upg_settings');
			if(!isset($options['guest_user']))
			$options['guest_user']="";
		$author_id =$options['guest_user'];
	}	
	
	
	return $author_id;
}

function upg_include_deps() 
{
	if (!function_exists('media_handle_upload')) {
		require_once (ABSPATH .'/wp-admin/includes/media.php');
		require_once (ABSPATH .'/wp-admin/includes/file.php');
		require_once (ABSPATH .'/wp-admin/includes/image.php');
	}
}
	
function upg_check_images($files) 
{
	global $upg_options;
	
	$temp = false; $errr = false; $error = array();
	
	if (isset($files['tmp_name'])) $temp = array_filter($files['tmp_name']);
	if (isset($files['error']))    $errr = array_filter($files['error']);
	
	$file_count = 0;
	if (!empty($temp)) 
	{
		foreach ($temp as $key => $value) if (is_uploaded_file($value)) $file_count++;
	}
	if (true) 
	{
		
		//if ($file_count > 1) $error[] = 'file-max';
		
		$i=0;
			
			$image = @getimagesize($temp[$i]);
			
			if (false === $image) 
			{
				$error[] = 'file-type';
				//break;
			} 
			else 
			{
				if (function_exists('exif_imagetype')) 
				if (isset($temp[$i]) && !exif_imagetype($temp[$i])) 
				{
					$error[] = 'exif_imagetype';
					//break;
				}
				/* $file = check_upload_size( $temp[$i] );
				if ( $file['error'] != '0' )
				{
					$error[] = 'max-filesize';
				} */
				
				
			}
		
	}
	else 
	{
		$files = false;
	}
	$file_data = array('error' => $error, 'file_count' => $file_count);
	return $file_data;
}		

function upg_submit_url($title, $url, $content, $category,$preview)
{
	$newPost = array('id' => false, 'error' => false);
	$newPost['error'][] ="";
	
	if (empty($title))    $newPost['error'][] = 'required-title';
	if (empty($category)) $newPost['error'][] = 'required-category';
	//if (empty($content))  $newPost['error'][] = 'required-description';
	if (empty($url))  $newPost['error'][] = 'required-url';
	if ($category=='-1') $newPost['error'][] = 'required-category';
	if(upg_getid_youtube($url)=='') $newPost['error'][] = 'wrong-video-url';
		
	$newPost['error'][]=apply_filters('upg_verify_submit', "");
		//var_dump($newPost);

		
		foreach ($newPost['error'] as $e) 
	{
		if (!empty($e)) 
		{
			unset($newPost['id']);
			return $newPost;
		}
	}
	
	$postData = upg_prepare_post($title, $content);
	
	do_action('upg_insert_before', $postData);
	$newPost['id'] = wp_insert_post($postData);
	do_action('upg_insert_after', $newPost);
	
	if ($newPost['id']) 
	{
		$post_id = $newPost['id'];
		//wp_set_post_categories($post_id, array($category));
		wp_set_object_terms($post_id, array($category),'upg_cate');
		
		add_post_meta($post_id, 'youtube_url', $url);
		
		//Assign preview layout
		add_post_meta($post_id, 'upg_layout', $preview);
		
	}
	
	return apply_filters('upg_new_post', $newPost);
	
	
}
	
function upg_submit($title, $files, $content, $category, $preview)
{
	$options = get_option('upg_settings');
	$newPost = array('id' => false, 'error' => false);
	$newPost['error'][] ="";
	$file_count=0;
	if (empty($title))    $newPost['error'][] = 'required-title';
	if (empty($category)) $newPost['error'][] = 'required-category';
	//if (empty($content))  $newPost['error'][] = 'required-description';
	
	$newPost['error'][]=apply_filters('upg_verify_submit', "");
	
	if(isset($files['tmp_name'][0]))
		$check_file_exist=$files['tmp_name'][0];
	else
		$check_file_exist="";
	
	if(!empty($check_file_exist) || $options['image_required']=='1')
	{
		$file_data = upg_check_images($files, $newPost);
		$file_count = $file_data['file_count'];
		
		//echo "<h1>$file_count</h1>";
		
		$newPost['error'] = array_unique(array_merge($file_data['error'], $newPost['error']));
	}
		
	if ($category=='-1') $newPost['error'][] = 'required-category';
	
	foreach ($newPost['error'] as $e) 
	{
		if (!empty($e)) 
		{
			unset($newPost['id']);
			return $newPost;
		}
	}
	
	$postData = upg_prepare_post($title, $content);
	do_action('upg_insert_before', $postData);
	upg_include_deps();
		$i=0;
		if($file_count==0)
			$file_count=1;
		
		for ($x = 1; $x <= $file_count; $x++) 
		{
			$newPost['id'] = wp_insert_post($postData);
			if ($newPost['id']) 
			{
				//echo "Successfully added $x <hr>";
				$post_id = $newPost['id'];
				wp_set_object_terms($post_id, array($category),'upg_cate');
				
				$attach_ids = array();
				if ($files && !empty($check_file_exist)) 
				{
					$key = apply_filters('upg_file_key', 'user-submitted-image-{$i}');
				
					$_FILES[$key] = array();
					$_FILES[$key]['name']     = $files['name'][$i];
					$_FILES[$key]['tmp_name'] = $files['tmp_name'][$i];
					$_FILES[$key]['type']     = $files['type'][$i];
					$_FILES[$key]['error']    = $files['error'][$i];
					$_FILES[$key]['size']     = $files['size'][$i];
					
					$attach_id = media_handle_upload($key, $post_id);
					if (!is_wp_error($attach_id) && wp_attachment_is_image($attach_id)) 
					{
						$attach_ids[] = $attach_id;
						add_post_meta($post_id, 'pic_name', $attach_id);
						
						//Assign preview layout
						add_post_meta($post_id, 'upg_layout', $preview);
						
					} 
					else 
					{
						wp_delete_attachment($attach_id);
						wp_delete_post($post_id, true);
						$newPost['error'][] = 'upload-error';
						unset($newPost['id']);
						return $newPost;
					}
				$i++;
					
				}
				else
				{
					//Checking in setting if image is compulsory during submission.
					if($options['image_required']=='1')
					{
						$newPost['error'][] = 'no-files';
						
					}
				}				
				
			}
			else 
			{
				$newPost['error'][] = 'post-fail';
				
			}
			
		}
		
	do_action('upg_insert_after', $newPost);
	return $newPost;

}




function upg_author($author)
{
	$options = get_option('upg_settings');
	if(isset($options['main_page']))
	{
		if ( get_option('permalink_structure') )
		$linku=esc_url( get_permalink($options['main_page'])."member/".$author->user_nicename );
		else
		$linku=esc_url( get_permalink($options['main_page'])."&user=".$author->user_nicename );
	}
	else
	{
		$linku="";
	}
	
	return  '<div class=""><a href="'.$linku.'" title='.$author->display_name.'>'.get_avatar( get_the_author_meta($author->email), $size = '50').'</a></div><div class="upg-profile-name">'.$author->display_name.'</div>';

	//return '<span class="">Submitted by: <a href="'.$linku.'">'.$author->display_name.'</a></span><br>';
	
	//return '<a href="'.$linku.'">'.get_avatar( $author->user_email,32 ).'</a><br>'.$author->display_name;
}

function upg_show_icon_grid()
{
	$icon = array();
	

	$list = '';
 
	if(has_filter('upg_add_icon_grid')) {
		$icon = apply_filters('upg_add_icon_grid', $icon);
	}
 
if(count($icon)>0)
	$list .= '<br>';

 for($r=0;$r<count($icon);$r++)
{
		$nonce = wp_create_nonce($icon[$r][3]);
	
		$list.= '<a class="pure-button '.$icon[$r][3].'" href="'.$icon[$r][2].'" title="'.$icon[$r][1].'" data-nonce="'. $nonce.'" data-post_id="' . $icon[$r][4] . '"><i class="'.$icon[$r][0].'"> </i> </a> ';;
		
}
 
 
	return $list;
}

function upg_add_extra_icon_grid_delete($icon)
{
	global $post; 
	
	$nonce = wp_create_nonce("upg_delete");
    $link = admin_url('admin-ajax.php?action=upg_delete&post_id='.$post->ID.'&nonce='.$nonce);

	
	if(get_the_author_meta('ID') == get_current_user_id())
	{
		$extra_icon = array
	  (
		array("fa fa-trash",'Delete',$link,'upg_delete',$post->ID),
		//array("fa fa-search-plus","Search",'#sss','class_name'),
		// array("fa fa-shopping-cart","imdb",'#eee',''),
		//array("fa fa-user","User",'#uuu','')
	  );
	}
	else
	{
		$extra_icon = array();
	}
 
	// combine the two arrays
	$icon = array_merge($extra_icon, $icon);
 
	return $icon;
}
add_filter('upg_add_icon_grid', 'upg_add_extra_icon_grid_delete');



add_action("wp_ajax_upg_delete", "upg_delete");
add_action("wp_ajax_nopriv_upg_delete", "my_must_login");

function upg_delete() 
{

   if ( !wp_verify_nonce( $_REQUEST['nonce'], "upg_delete")) {
      exit("No naughty business please");
   }   

   
	$post_id=$_REQUEST["post_id"];
	
	$post_author_id = get_post_field( 'post_author', $post_id );
   
   if(get_current_user_id() == $post_author_id)
		$data = wp_delete_post( $post_id, true );
	else
		$data=false;

   if($data === false) 
   {
      $result['type'] = "error";
      $result['data_count'] = "Fail";
   }
   else 
   {
      $result['type'] = "success";
      $result['data_count'] = "Pass";
   }

   if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $result = json_encode($result);
      echo $result;
   }
   else {
      header("Location: ".$_SERVER["HTTP_REFERER"]);
   }

   die();

}

function my_must_login() {
   echo "You must log in to delete.";
   die();
}



?>