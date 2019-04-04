<?php
add_action('wp_head', 'upg_metatag_facebook_head');	
add_action('init', 'upg_post_types');
add_action('init', 'register_upg_taxonomies');
add_filter("the_content", "upg_the_content");
add_shortcode("upg-wp-post", "upg_wp_post");
add_shortcode("upg-pick", "upg_pick");
add_shortcode("upg-list", "upg_list");
add_shortcode("upg-post", "upg_user_post");
add_shortcode("upg-video", "upg_showyoutube");
add_action('wp_enqueue_scripts', 'upg_enqueue_scripts');
	add_action('admin_enqueue_scripts', 'upg_admin_enqueue_scripts');
	add_action('plugins_loaded', 'upg_languages');
	add_action('init', 'upg_languages');
	add_action('init', 'upg_plugin_check_version');
	if (is_admin()) 
{
	
	//wp_enqueue_script('post_img', upg_PLUGIN_URL.'/js/post_img.js');
	add_action('admin_init', 'upg_meta_boxes', 0);
	add_action('save_post', 'upg_save_meta_data', 10, 2);
	add_action( 'admin_menu', 'upg_add_admin_menu' );

add_action( 'admin_init', 'upg_settings_init' );

}
?>