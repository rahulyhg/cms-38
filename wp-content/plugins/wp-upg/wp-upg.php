<?php
/*
Plugin Name: User Post Gallery
Plugin URI: http://odude.com/
Description: UPG - User Post Gallery. User can post content/images from frontend.
Version: 1.48
Author: ODude Network
Author URI: http://odude.com/
License: GPLv2 or later
Text Domain: wp-upg
*/

	define('UPG_PLUGIN_VERSION', '1.48');
   
	define('upg_ROOT_URL', plugin_dir_url( __FILE__ ) );
	define('upg_FOLDER',dirname(plugin_basename( __FILE__ )));
	define('upg_BASE_DIR',WP_CONTENT_DIR.'/plugins/'.upg_FOLDER.'/');
	define('upg_PLUGIN_URL',content_url('/plugins/'.upg_FOLDER));
	

	
	
	 function upg_languages() 
	 {
        load_plugin_textdomain( 'wp-upg', false, dirname(plugin_basename( __FILE__ )).'/languages/' ); 
    }
	
	include(dirname(__FILE__)."/libs/functions.php");
	include(dirname(__FILE__)."/libs/lib.php");
	include(dirname(__FILE__)."/libs/install.php");
	include(dirname(__FILE__)."/libs/hooks.php");
    include(dirname(__FILE__)."/libs/custom_column.php");
	include(dirname(__FILE__)."/setting.php");
	include(dirname(__FILE__)."/help.php");
	include(dirname(__FILE__)."/addon.php");
	include(dirname(__FILE__)."/libs/metabox.php");
	include(dirname(__FILE__)."/layout/edit.php");
	include(dirname(__FILE__)."/layout/button.php");
	include(dirname(__FILE__)."/libs/taxonomy.php");
	include(dirname(__FILE__)."/widgets/categories.php");
	include(dirname(__FILE__)."/ultimatemember.php");
	  
	register_activation_hook(__FILE__,'upg_install');
	register_uninstall_hook(__FILE__,'upg_drop');

	
	function upg_plugin_check_version() 
	{
		if (UPG_PLUGIN_VERSION !== get_option('upg_plugin_version'))
			{
				
				//if(get_option('upg_plugin_version')=='1.12')
				//{
					//Update Permalinks
					flush_rewrite_rules();
					
					
				//}
				
			update_option('upg_plugin_version', UPG_PLUGIN_VERSION);
			
		}
		
			$file_personal_post_form=upg_BASE_DIR."layout/form/personal/".get_current_blog_id()."_personal_post_form.php";
			if( ! file_exists( $file_personal_post_form ) )
			{
					//Create personal layout files if lost or update
					upg_update_personal_layout();
					//echo "Updated personal layout file of UPG.";
			}
				
	}

	
	//Loading css files
	 function upg_enqueue_scripts()
	{
        global $upg_plugin,$current_screen;
		$options = get_option( 'upg_settings','' );
		
		 wp_enqueue_style('upg-style', plugins_url() .'/'. upg_FOLDER.'/css/style.css');
		 wp_enqueue_style('colorbox', plugins_url() .'/'. upg_FOLDER.'/css/colorbox.css','', '1', 'all');
         wp_enqueue_style('odude-pure', plugins_url() .'/'. upg_FOLDER.'/css/pure-min.css');
		 wp_enqueue_style('font-awesome-css','https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
		 wp_enqueue_style('odude-pure-grid', plugins_url().'/'. upg_FOLDER.'/css/grids-responsive-min.css');
		 

		 wp_enqueue_script( 'colorbox-min', plugins_url() .'/'. upg_FOLDER.'/js/jquery.colorbox-min.js' ,array( 'jquery' ), '1', true );
		 wp_enqueue_script( 'upg_common', plugins_url() .'/'. upg_FOLDER.'/js/common.js' );
		  wp_enqueue_script( 'upg_delete', plugins_url() .'/'. upg_FOLDER.'/js/upg_delete.js' );
		  
		  wp_localize_script( 'upg_delete', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
   
    }
	function upg_admin_enqueue_scripts()
	{
        global $upg_plugin,$current_screen;
		$screen = get_current_screen();
		//echo $screen->base;
		if ( $screen->base == 'upg_page_wp_upg')
		{
			wp_enqueue_style('odude-pure', plugins_url() .'/'. upg_FOLDER.'/css/pure-min.css');
		 //wp_enqueue_style('font-awesome-css','https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
		 wp_enqueue_style('odude-pure-grid', plugins_url().'/'. upg_FOLDER.'/css/grids-responsive-min.css');
		 
		}
		wp_enqueue_script('jquery');
       wp_enqueue_script('jquery-form');
       wp_enqueue_script('jquery-ui-core');
       wp_enqueue_script('jquery-ui-datepicker'); 
       wp_enqueue_script('jquery-ui-tabs');// enqueue jQuery UI Tabs
	   //wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_style( 'wp-color-picker');
		wp_enqueue_script( 'wp-color-picker');
		
		$options = get_option( 'upg_settings','' );
		wp_enqueue_style('upg-style', plugins_url() .'/'. upg_FOLDER.'/css/aristo.css');
		wp_enqueue_style('upg-admin', plugins_url() .'/'. upg_FOLDER.'/css/admin.css');
	}
	
	//Save data typed in post type
	function upg_save_meta_data( $post_id, $post ) 
	{

	
		if ( ! isset( $_POST['nonce_name'] ) ) //make sure our custom value is being sent
			return;
		if ( ! wp_verify_nonce( $_POST['nonce_name'], 'nonce_action' ) ) //verify intent
			return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) //no auto saving
			return;
		if ( ! current_user_can( 'edit_post', $post_id ) ) //verify permissions
			return;
		//session_start();
		
	
			if($_POST['meta-box-media']!="pic_name")
			{
			$new_value = array_map( 'intval', $_POST['meta-box-media'] ); //sanitize
			
			
				foreach ( $new_value as $k => $v ) 
				{
					
					if($v!='0')
					update_post_meta( $post_id, $k, $v ); //save
					//$_SESSION["favcolor"] .= "green_".$v."<hr>";
				}
			}
			
		update_post_meta($post->ID, "upg_layout", $_POST["upg_layout"]);
		update_post_meta($post->ID, "youtube_url", sanitize_text_field($_POST["youtube_url"]));
			
		
		
		for ($x = 1; $x <= 5; $x++) 
		{
			//if(isset($_POST["upg_custom_field_".$x]) && $_POST["upg_custom_field_".$x]!="")
			//{
			update_post_meta($post->ID, "upg_custom_field_".$x, sanitize_text_field($_POST["upg_custom_field_".$x]));
			//}
		}
		

	}

	//Move image meta box-media
function upg_admin_footer_hook() { global $post ;  if (get_post_type($post) == 'upg') { ?> <script type="text/javascript"> jQuery(document).ready(function($) { $('#normal-sortables').insertBefore('#postdivrich') ; }) ; </script>  <?php } }  /** Hook into the Admin Footer */ add_action('admin_footer','upg_admin_footer_hook');



//Generate auto media preview page
function upg_the_content($content)
	{
		
        global $post;      
        $settings = get_option('_upg_settings');    
       
	  // if(!is_single()||!isset($settings['generate_product_page_content']))
		//return $content;
        
		
		if($post->post_type!='upg')
			return $content;     
        
		    
		
		
       if( is_singular() && is_main_query() ) 
	   {
		   //Receiving all the custom post values
			$all_upg_fields= get_post_custom($post->ID);
	
			if(isset($all_upg_fields["upg_layout"][0]))
			$upg_layout=$all_upg_fields["upg_layout"][0];
			else
			$upg_layout="basic";
		   
		    require_once("layout/media/$upg_layout/$upg_layout.php");
			return upg_product_content($post);
	   }
	  
    }
	//Include youtube from url
	function upg_showyoutube($params)
	{
	  
    $abc=include(upg_BASE_DIR.'layout/youtube.php');
	return $abc;
	 
	}
	
	//List wordpress post
	function upg_wp_post($params)
	{
	  
    $abc=include(upg_BASE_DIR.'layout/wppost.php');
	return $abc;
	 
	}
	
	
	//Pick single upg-post
	function upg_pick($params)
	{
	  
    $abc=include(upg_BASE_DIR.'layout/pick.php');
	return $abc;
	 
	}
	
	//List Primary Images
	function upg_list($params)
	{
	  
    $abc=include(upg_BASE_DIR.'layout/catalog.php');
	return $abc;
	 
	}
	
	
	//Front end User Post
	function upg_user_post($params)
	{
	  if(isset($params['type']))
	$type = $params['type'];
	else
	$type="image";

	if(isset($params['preview']))
		$preview=$params['preview'];
	else
		$preview="basic";

	if($type=="youtube")
	$abc=include(upg_BASE_DIR.'layout/form/post_youtube.php');	
	else
    $abc=include(upg_BASE_DIR.'layout/form/post_image.php');
	return $abc;
	 
	}
	

	
	//Detail Layout List
	 function upg_meta_box_layout()
	{
        global $post;
        $all_upg_fields= get_post_custom($post->ID);
		if(isset($all_upg_fields["upg_layout"][0]))
			$upg_layout=$all_upg_fields["upg_layout"][0];
			else
			$upg_layout="basic";
		
		$dir    = upg_BASE_DIR.'layout/media/';
		$filelist ="";
		$files = array_map("htmlspecialchars", scandir($dir));       

		foreach ($files as $file) 
		{
			if($upg_layout==$file)
				$checked='checked=checked';
			else
				$checked="";
			
			if(!strpos($file, '.') && $file != "." && $file != "..")	
			$filelist .= sprintf('<input type="radio" '.$checked.' name="upg_layout" value="%s"/>%s layout<br>' . PHP_EOL, $file, $file );
		}
echo $filelist;
   
	}
	


//Delete image attached when post is deleted
add_action( 'before_delete_post', 'upg_before_delete_post' );
function upg_before_delete_post( $postid )
{

    // We check if the global post type isn't ours and just return
    global $post_type;   
    if ( $post_type != 'upg' ) return;

    // My custom stuff for deleting my custom post type here
	upg_log('Post Deleted with images-'.$postid);
	upg_delete_post_media($postid);
	//$ii=get_attached_media( 'image', $postid );
	//upg_log('Attached id.'.$ii);
	//wp_delete_attachment( 134 );
}

//taxonomy/album will be redirected when category is opened
add_action( 'template_redirect', 'upg_template_redirect' );
function upg_template_redirect() 
{
	$redirect_url = '';
	if( ! is_feed() ) 
	{
			// If Album Page
			if( is_tax( 'upg_cate' ) ) 
			{
			
				$term = get_queried_object();
				$redirect_url = upg_get_category_page_link( $term,  'upg_cate' );
				
			}
	}
		// Redirect
		if( ! empty( $redirect_url ) ) 
		{
		
			wp_redirect( $redirect_url );
        	exit();
			
		}
}



//Rewrite rules for user gallery
add_action('init', 'upg_user_url');
function upg_user_url()
{
	$options = get_option('upg_settings');
	
	if(isset($options['main_page']))
	{
		$main_page=basename(get_permalink($options['main_page']));
		
		add_rewrite_rule(
			'^'.$main_page.'/member/([^/]*)$',
			'index.php?user=$matches[1]&page_id='.$options['main_page'],
			'top'
		);
		
		//Rewrite rules to browse by user
		add_rewrite_rule(
			'^'.$main_page.'/member/([^/]+)/page/([0-9]+)?$',
			'index.php?user=$matches[1]&paged=$matches[2]&page_id='.$options['main_page'],
			'top'
		);
		
		//rewrite rules pagination to browse by album
	 add_rewrite_rule(
			'^'.$main_page.'/([^/]+)/page/([0-9]+)?$',
			'index.php?upg_cate=$matches[1]&paged=$matches[2]&page_id='.$options['main_page'],
			'top' 
			);
		
		
		
			add_rewrite_rule(
			'^'.$main_page.'/([^/]*)$',
			'index.php?upg_cate=$matches[1]&page_id='.$options['main_page'],
			'top'
		);
	}

}
function upg_query_vars($aVars) 
{
    $aVars[] = "user";    // represents the name of the variable as shown in the URL
	$aVars[] = "upg_cate";
	$aVars[] = "paged";
    return $aVars;
}
 
add_filter('query_vars', 'upg_query_vars');

//Changing page title dynamically. loop_start prevent from updating menu title
add_action( 'loop_start', 'upg_set_custom_title' );
function upg_set_custom_title() 
{
   
   add_filter( 'the_title', 'upg_filter_page_title', 10, 2 );
}

function upg_filter_page_title($title)
{
	
	$options = get_option('upg_settings');
	$current_page_id=get_the_ID();
	$album_name="";
	$main_page_id = $options['main_page'];
	if($main_page_id==$current_page_id && in_the_loop())
	{
		
		global $post; 
		global $wp_query;
		
		$term_slug = get_query_var( 'upg_cate' );
		
		
		$term = get_term_by('slug', $term_slug, 'upg_cate');
		
		if($term_slug!="")
		$album_name=$term->name;
	
		
		
		if(isset($wp_query->query_vars['user']))
		$user=sanitize_text_field($wp_query->query_vars['user']);
		else
		$user="";

		$author = get_user_by('slug', $user);
		
			if($album_name!="")
			{
				
				return $album_name;
				
			}
			
			if($user!="")
			{
				
				return $author->user_nicename;
			}
				
						
	}
	
	
	
	return $title;
}
//Include in archive page
if($options['archive']=='1')
{

	//Include UPG in archive page
	add_action( 'pre_get_posts', function ( $query ) 
	{
	  if (    !is_admin() 
		   && $query->is_main_query() 
		   && $query->is_archive()
	   )
		 $query->set( 'post_type', array( 'post', 'upg' ) );
	});
	//To display in Archive widget
	add_filter( 'getarchives_where', function ( $where )
	{
		$where = str_replace( "post_type = 'post'", "post_type IN ( 'post', 'upg' )", $where );
		return $where;
	});
}



?>