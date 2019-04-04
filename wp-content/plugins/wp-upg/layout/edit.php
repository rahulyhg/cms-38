<?php
function upg_layout_page()
{
	$upload_dir = wp_upload_dir();
	$user_dirname = $upload_dir['basedir'].'/upg_media_personal.php';
	
	$filename=dirname(__FILE__)."/media/personal/".get_current_blog_id()."_content.php";
	
	if(isset($_POST['newcontent']))
	{
		echo "<h2>File Update</h2>";
		if ( is_writeable($filename) ) 
		{
			//Save inside plugin path
		$file = fopen($filename,"w+");
		fwrite($file, wp_unslash($_POST['newcontent']));
		
		//save inside upload path
		$file = fopen($user_dirname,"w+");
		fwrite($file, wp_unslash($_POST['newcontent']));
		
		}
		else
		{
			echo "<h2>File is not writeable. Try again or refresh the page.</h2>";
			//Save inside plugin path
			$file = fopen($filename,"w+");
			fwrite($file, wp_unslash($_POST['newcontent']));
			
		}
	}
	
		
	//IF file not exist
    if( ! file_exists( $user_dirname ) )
	{
		
		$sample_filename=dirname(__FILE__)."/media/personal/sample.txt";
		$sample_content =  file_get_contents($sample_filename);
		
		$file = fopen($user_dirname,"w+");
		fwrite($file, $sample_content);
	}
	

	
	
	//$content =  file_get_contents($filename);
	$content =  file_get_contents($user_dirname);
	
	$settings = array(
				    'wpautop'          => false,  // enable rich text editor
				    'media_buttons'    => false,  // enable add media button
				    'textarea_rows'    => '20',  // number of textarea rows
				    'tabindex'         => '',    // tabindex
				    'editor_css'       => '',    // extra CSS
				    'editor_class'     => 'usp-rich-textarea', // class
				    'teeny'            => false, // output minimal editor config
				    'dfw'              => false, // replace fullscreen with DFW
				    'tinymce'          => false,  // enable TinyMCE
				    'quicktags'        => true,  // enable quicktags
				    'drag_drop_upload' => false, // enable drag-drop
				);	
	
	?>
<div class="wrap">
	<h2>[Personal Layout] Editor</h2>
	<b>Notes:</b><br>
	# This is your personal Layout which is designed only for you. Use it only if you are good at html/php script. <br>
	
	# The codes typed here will be directly saved into personal layout file. <br>	
	
	# Even after plugin updated, the created file will not be updated. You need to update it manually if required. <br>
	
	# The [Get Sample Code] links below script is always updated, you can get latest code from there if it crashes or want to get updated.
<br><br>

	<script>
jQuery(document).ready(function($){
       $("#tabs").tabs();
});
  </script>
  	<div id="tabs">
	<ul>
		
       
		
		<li><a href="#tab-2"><?php echo __("Grid File","wp-upg");?></a></li>
		 <li><a href="#tab-1"><?php echo '<img src="'.upg_PLUGIN_URL.'/images/new.png"> '; ?> <?php echo __("Preview File","wp-upg");?></a></li>
		<li><a href="#tab-3"><?php echo __("Pick File","wp-upg");?></a></li>
		<li><a href="#tab-4"><?php echo __("Post Form File","wp-upg");?></a></li>
		<li><a href="#tab-5"><?php echo __("Post YouTube File","wp-upg");?></a></li>
       </ul>
	 <div id="tab-1">
	 
	 
	
	<br>
	<b>Post Preview Layout: </b> Personal Layout (\layout\media\personal\<?php echo get_current_blog_id(); ?>_content.php)<br>
	

	<br>
	This layout is used when layout is set as [personal layout] for individual post.
	
	<br>
	<form class="pure-form" method="post" action="">
	<table border='1' width='99%'>
	<tr><td valign="top" width="70%">
	
		<?php
			wp_editor( $content, 'newcontent', $settings );
	?>
	
	
	<br>
	<b> Personal Layout : </b>  <a href="<?php echo plugins_url( '/wp-upg/layout/media/personal/sample.txt'); ?>" target="_blank">Get sample code</a>
	<hr>
	<b> Basic Layout : </b>  <a href="<?php echo plugins_url( '/wp-upg/layout/media/basic/basic.txt'); ?>" target="_blank">Get sample code</a>
	</td>
	<td valign='top' style="background-color:#eeeeee ;">
	<b>Below are the php variables/fields you can use between PHP tag.</b><hr>
	<b>$image</b> = URL of the large image<br>
	<b>$text </b>= Description of image <br>
	<br>
	<br>
	<b>upg_get_filed_label('upg_custom_field_2')</b> = <br>Get (Label Field Name) saved for extra custom fields inside UPG Settings.<br> 
	Syntax : echo upg_get_filed_label('Internal field name');
	<br>
	<b>upg_get_value('upg_custom_field_2')</b> = <br>Get value saved for extra custom fields inside UPG Posts.<br> 
	Syntax : echo upg_get_value('Internal field name');
	<br>
	<br>
	<b>$author->user_nicename</b> = Author's Nice name. $author is array.
	<b>upg_author($author)</b> = Author image icon/avatar <br>
	<br>
	<b>upg_isVideo($post)</b> = Check if media is video or image (true/false)<br>


	<b>upg_position1()</b> = Shortcode area for Position 1st<br>
	<b>upg_position2()</b> = Shortcode area for Position 2nd<br>
	<br>
	<?php echo '<img src="'.upg_PLUGIN_URL.'/images/new.png"> '; ?> <br><b>upg_list_tags($post);</b> = Print tags with link associated with post.
	<br><br>
	<b>upg_get_album($post->ID,'name')</b>= Returns album name <br>
	<b>upg_get_album($post->ID,'url')</b>= Returns album link url <br>
	<b>upg_get_album($post->ID,'slug')</b>= Returns album slug <br>
	
	<hr>
	<b>Tips</b>:
	<br>
	* You can copy paste css code for your own style between style tag.<br>
	* You can use UPG built in grid system https://purecss.io/ <br>
	* For better css style http://fontawesome.io/ is included by default. <br>
	* Even after plugin update, your changes will not be lost.
	
	
	
	</td></tr></table>
	<br>
	<input type="submit" name="submit" id="submit" class="button button-primary" value="Update Personal Post Preview File">
	</form>
	</div>
	
	<?php
	
	$upload_dir = wp_upload_dir();
	$user_dirname_up = $upload_dir['basedir'].'/upg_grid_personal_up.php';
	$user_dirname_down = $upload_dir['basedir'].'/upg_grid_personal_down.php';
	$user_dirname_main = $upload_dir['basedir'].'/upg_grid_personal_main.php';
	
	$file_personal_up=dirname(__FILE__)."/grid/personal/".get_current_blog_id()."_personal_up.php";
	$file_personal_down=dirname(__FILE__)."/grid/personal/".get_current_blog_id()."_personal_down.php";
	$file_personal_main=dirname(__FILE__)."/grid/personal/".get_current_blog_id()."_personal.php";
	
	if(isset($_POST['personal_up']))
	{
		echo "<h2>Updating File...</h2>";
		
		if ( is_writeable($file_personal_up) ) 
		{
		$file = fopen($file_personal_up,"w+");
		fwrite($file, wp_unslash($_POST['personal_up']));
		
		//save inside upload path
		$file = fopen($user_dirname_up,"w+");
		fwrite($file, wp_unslash($_POST['personal_up']));
		
		}
		else
		{
			echo $file_personal_up."<h2>: is not writeable</h2>";
		}
		
		if ( is_writeable($file_personal_down) ) 
		{
		$file = fopen($file_personal_down,"w+");
		fwrite($file, wp_unslash($_POST['personal_down']));
		
		//save inside upload path
		$file = fopen($user_dirname_down,"w+");
		fwrite($file, wp_unslash($_POST['personal_down']));
		
		}
		else
		{
			echo "<h2>".get_current_blog_id()."_personal_down.php is not writeable</h2>";
		}
		
		if ( is_writeable($file_personal_main) ) 
		{
		$file = fopen($file_personal_main,"w+");
		fwrite($file, wp_unslash($_POST['personal_main']));
		
		//save inside upload path
		$file = fopen($user_dirname_main,"w+");
		fwrite($file, wp_unslash($_POST['personal_main']));
		
		}
		else
		{
			echo "<h2>".get_current_blog_id()."_personal.php is not writeable</h2>";
		}
	}
	
	//IF file not exist
    if( ! file_exists( $user_dirname_main ) )
	{
		
		$sample_filename=dirname(__FILE__)."/grid/personal/personal.txt";
		$sample_content =  file_get_contents($sample_filename);
		$file = fopen($user_dirname_main,"w+");
		fwrite($file, $sample_content);
		
		$sample_filename=dirname(__FILE__)."/grid/personal/personal_up.txt";
		$sample_content =  file_get_contents($sample_filename);
		$file = fopen($user_dirname_up,"w+");
		fwrite($file, $sample_content);
		
		$sample_filename=dirname(__FILE__)."/grid/personal/personal_down.txt";
		$sample_content =  file_get_contents($sample_filename);
		$file = fopen($user_dirname_down,"w+");
		fwrite($file, $sample_content);
	}
	
	
	$content_up =  file_get_contents($user_dirname_up);
	$content_down =  file_get_contents($user_dirname_down);
	$content_main =  file_get_contents($user_dirname_main);
	?>
	
	
	 <div id="tab-2">
	
	<br>
	<b>Gallery Grid Layout Name: Personal Layout </b> <br>
	Shortcode: [upg-list]
	
	<br>
	<form class="pure-form" method="post" action="">
	<table border='1' width='99%'>
	<tr><td>
	<b>Personal Layout Header</b>(\layout\grid\personal\<?php echo get_current_blog_id(); ?>_personal_up.php)<br>
	It is used as a grid's container starting code. <br>
	Style tag can be included here.
	<textarea cols="90" rows="5" name="personal_up" id="personal_up" style="background-color:#ffefbf;"><?php echo $content_up; ?></textarea>
	<br>
	<a href="<?php echo plugins_url( '/wp-upg/layout/grid/personal/personal_up.txt'); ?>" target="_blank">Get sample code</a>
	<hr>
	<b>Personal Layout Main</b>(\layout\grid\personal\<?php echo get_current_blog_id(); ?>_personal.php)<br>
	It is used as a thumbnail body which is repeated inside loop.
	<textarea cols="90" rows="10" name="personal_main" id="personal_main" style="background-color:#eeeeee ;"><?php echo $content_main; ?></textarea>
	<br>
	<a href="<?php echo plugins_url( '/wp-upg/layout/grid/personal/personal.txt'); ?>" target="_blank">Get sample code</a>
	<hr>
	<b>Personal Layout Footer </b>(\layout\grid\personal\<?php echo get_current_blog_id(); ?>_personal_down.php)<br>
	It is used as a grid's container ending code. 
	<textarea cols="90" rows="5" name="personal_down" id="personal_down" style="background-color:#ffffbf;"><?php echo $content_down; ?></textarea>
	<br>
	<b> Personal Layout : </b> <a href="<?php echo plugins_url( '/wp-upg/layout/grid/personal/personal_up.txt'); ?>" target="_blank">Get sample code Up</a> | 
	<a href="<?php echo plugins_url( '/wp-upg/layout/grid/personal/personal.txt'); ?>" target="_blank">Get sample code Middle</a> |
	
	<a href="<?php echo plugins_url( '/wp-upg/layout/grid/personal/personal_down.txt'); ?>" target="_blank">Get sample code Down</a>
	
	
	<hr>
	<b> Basic Layout : </b> <a href="<?php echo plugins_url( '/wp-upg/layout/grid/basic/basic_up.txt'); ?>" target="_blank">Get sample code Up</a> | 
	<a href="<?php echo plugins_url( '/wp-upg/layout/grid/basic/basic.txt'); ?>" target="_blank">Get sample code Middle</a> |
	
	<a href="<?php echo plugins_url( '/wp-upg/layout/grid/basic/basic_down.txt'); ?>" target="_blank">Get sample code Down</a>
	<hr>
	
	<b> Flat Layout : </b> <a href="<?php echo plugins_url( '/wp-upg/layout/grid/flat/flat_up.txt'); ?>" target="_blank">Get sample code Up</a> | 
	<a href="<?php echo plugins_url( '/wp-upg/layout/grid/flat/flat.txt'); ?>" target="_blank">Get sample code Middle</a> |
	
	<a href="<?php echo plugins_url( '/wp-upg/layout/grid/flat/flat_down.txt'); ?>" target="_blank">Get sample code Down</a>
	
	
	<hr>
	<b> List Layout : </b> <a href="<?php echo plugins_url( '/wp-upg/layout/grid/list/list_up.txt'); ?>" target="_blank">Get sample code Up</a> | 
	<a href="<?php echo plugins_url( '/wp-upg/layout/grid/list/list.txt'); ?>" target="_blank">Get sample code Middle</a> |
	
	<a href="<?php echo plugins_url( '/wp-upg/layout/grid/list/list_down.txt'); ?>" target="_blank">Get sample code Down</a>
	
	
	<hr>
	
	
	</td>
	<td valign='top' style="background-color:#eeeeee;">
	<b>Below are the php variables/fields you can use between PHP tag.</b><hr>
	<b>$image</b> = URL of the thumbnail image<br>
	<b>$preview_large</b> = URL of the large image <br>
	<b>$permalink</b> = URL to the image post content <br>
	<b>$thetitle</b> = Title of the image <br>
	
	<b>$popup </b>= Returns popup is on/off<br>
	<b>$preview_type</b> = Returns preview as image/youtube <br>
	<b>$perrow </b>= Returns number of row to display. Used in loops.<br>
	
	<b>$count</b> = Displays total number of post found.
	<br><br>
	<?php echo '<img src="'.upg_PLUGIN_URL.'/images/new.png"> '; ?><br> 
	<b>upg_get_album($post->ID,'name')</b>= Returns album name <br>
	<b>upg_get_album($post->ID,'url')</b>= Returns album link url <br>
	<b>upg_get_album($post->ID,'slug')</b>= Returns album slug <br>
	<br>
	<hr>
	<b>upg_get_value('upg_custom_field_2')</b> = <br>Get value saved for extra custom fields inside primary-image gallery.<br> Syntax : upg_get_value('Internal field name');
	<br>

	
	<hr>
	<b>Tips</b>:
	<br>

	* You can use UPG built in grid system https://purecss.io/ <br>
	* For better css style http://fontawesome.io/ is included by default. <br>
	* Even after plugin update, your changes will not be lost.
	
	
	
	</td></tr></table>
	<br>
	<input type="submit" name="submit" id="submit" class="button button-primary" value="Update Personal Grid Layout File">
	</form>
	
	
	
	 </div>
	 
	 <?php
	$upload_dir = wp_upload_dir();
	$user_dirname_pick = $upload_dir['basedir'].'/upg_grid_personal_pick.php';
	
	$file_personal_pick=dirname(__FILE__)."/grid/personal/".get_current_blog_id()."_personal_pick.php";
	if(isset($_POST['personal_pick']))
	{
		echo "<h2>Updating Personal Pick File</h2>";
		
		
		if ( is_writeable($file_personal_pick) ) 
		{
		$file = fopen($file_personal_pick,"w+");
		fwrite($file, wp_unslash($_POST['personal_pick']));
		
		//save inside upload path
		$file = fopen($user_dirname_pick,"w+");
		fwrite($file, wp_unslash($_POST['personal_pick']));
		
		}
		else
		{
			echo "<h2>personal_pick.php is not writeable</h2>";
		}
		
		
	}
	//IF file not exist
    if( ! file_exists( $user_dirname_pick ) )
	{
		
		$sample_filename=dirname(__FILE__)."/grid/personal/personal_pick.txt";
		$sample_content =  file_get_contents($sample_filename);
		$file = fopen($user_dirname_pick,"w+");
		fwrite($file, $sample_content);
		
		
	}
	
	
	$content_pick =  file_get_contents($user_dirname_pick);
	 
	 ?>
	 
	 
	 
	 <div  id="tab-3" >
	  
	   
	<b>Pick Layout: </b> Personal Layout (\layout\media\personal\<?php echo get_current_blog_id(); ?>_personal_pick.php)<br>
	
	<br>
	This layout is used if you want to display selected UPG Post into pages or WP-Posts.
	<br>
	<br>
	Shortcode: Eg.	[upg-pick id='xxx' notice='Your Choice' layout='personal']<br>
	id='xxx' should be replaced by ID of UPG Gallery. Eg. id='11'<br>
	notice='Your Choice' should be replced by a text of your wish. Eg. SALE<br>
	layout='personal' is the layout used.
	
	<br>
	<form class="pure-form" method="post" action="">
	<table border='1' width='99%'>
	<tr><td valign="top" width="70%">
	
	<?php
			wp_editor( $content_pick, 'personal_pick', $settings );
	?>
	
	
	<br>
	<b> Personal Layout : </b>  <a href="<?php echo plugins_url( '/wp-upg/layout/grid/personal/personal_pick.txt'); ?>" target="_blank">Get sample code</a>
	<hr>
	<b> Basic Layout : </b>  <a href="<?php echo plugins_url( '/wp-upg/layout/grid/basic/basic_pick.txt'); ?>" target="_blank">Get sample code</a>
	<hr>
	<b> Flat Layout : </b>  <a href="<?php echo plugins_url( '/wp-upg/layout/grid/flat/flat_pick.txt'); ?>" target="_blank">Get sample code</a>
	<hr>
	<b> List Layout : </b>  <a href="<?php echo plugins_url( '/wp-upg/layout/grid/list/list_pick.txt'); ?>" target="_blank">Get sample code</a>
	</td>
	<td valign='top' style="background-color:#eeeeee ;">
	
	<b>Below are the php variables/fields you can use between PHP tag.</b><hr>
	
	<b>$image</b> = URL of the thumbnail image<br>
	<b>$preview_large</b> = URL of the large image <br>
	<b>$permalink</b> = URL to the image post content <br>
	<b>$thetitle</b> = Title of the image <br>
	<br>
	<b>$popup </b>= Returns popup is on/off<br>
	<b>$preview_type</b> = Returns preview as image/youtube <br>
	
	
	<br>
	
	
	
	<hr>
	<b>Tips</b>:
	<br>

	* You can use UPG built in grid system https://purecss.io/ <br>
	* For better css style http://fontawesome.io/ is included by default. <br>
	* Even after plugin update, your changes will not be lost.
	
	</td></tr></table>
	<br>
	<input type="submit" name="submit" id="submit" class="button button-primary" value="Update Personal Pick Layout File">
	</form>
	  
	  
	  
	  
	 </div>
	 
	 <?php
	 //Personal Post form update
	 
	$upload_dir = wp_upload_dir();
	$user_dirname_post_form = $upload_dir['basedir'].'/upg_form_personal_post_form.php';
	
	$file_personal_post_form=dirname(__FILE__)."/form/personal/".get_current_blog_id()."_personal_post_form.php";
	if(isset($_POST['personal_form_post']))
	{
		echo "<h2>Updating Personal Post Form File</h2>";
		
		
		if ( is_writeable($file_personal_post_form) ) 
		{
		$file = fopen($file_personal_post_form,"w+");
		fwrite($file, wp_unslash($_POST['personal_form_post']));
		
		//save inside upload path
		$file = fopen($user_dirname_post_form,"w+");
		fwrite($file, wp_unslash($_POST['personal_form_post']));
		
		}
		else
		{
			echo "<h2>personal_post_form.php is not writeable</h2>";
		}
		
		
	}
	//IF file not exist
    if( ! file_exists( $user_dirname_post_form ) )
	{
		
		$sample_filename=dirname(__FILE__)."/form/personal/personal_post_form.txt";
		$sample_content =  file_get_contents($sample_filename);
		$file = fopen($user_dirname_post_form,"w+");
		fwrite($file, $sample_content);
		
		
	}
	
	
	$content_post_form =  file_get_contents($user_dirname_post_form);
	 
	 ?>
	 
	 
	 
	 
	  <div  id="tab-4" >
	  

	  
	  
	 <b>UPG Post Form: </b> Personal Layout (\layout\form\personal\<?php echo get_current_blog_id(); ?>_personal_post_form.php)<br>
	
	<br>
	This layout is used to show submission form. All the input fields must be between html <b>form</b> tag.
	<br>
	<br>
	
		<form class="pure-form" method="post" action="">
	<table border='1' width='99%'>
	<tr><td width="70%" valign="top">
	
		  	<?php
			
				
	wp_editor( $content_post_form, 'personal_form_post', $settings );
	?>
	

	<b> Personal Layout : </b>  <a href="<?php echo plugins_url( '/wp-upg/layout/form/personal/personal_post_form.txt'); ?>" target="_blank">Get sample code</a>
	<hr>
	<b> Basic Layout : </b>  <a href="<?php echo plugins_url( '/wp-upg/layout/form/basic/basic_post_form.txt'); ?>" target="_blank">Get sample code</a>
	</td>
	<td valign='top' style="background-color:#eeeeee ;">
	
	<b>HTML id & name parameters are important part in form creation. Some name are reserved by default.</b><hr>
	
	<b>Title Field </b>: id="name" name="user-submitted-title" <br><br>
	<b>Description Field</b>: name="user-submitted-content" <br><br>
	
	<b>Category/Album Field</b>: name='cat' value='2' <br>
	The value field will have a ID of album. To generate dynamic category selection use php function as upg_droplist_category();<br><br>
	
	<b>For File field </b>: id="file" name="user-submitted-image[]" type="file"<br>
	<br>
	<b>Custom Fields</b>: name="upg_custom_field_1" <br>
	There are 5 custom fields (i.e. upg_custom_field_1, upg_custom_field_2, upg_custom_field_3, upg_custom_field_4, upg_custom_field_5)<br>
	You can assign any label name and type but form name should be equals to above. 
	<br><br>
	<b>Submit Button</b>: type="submit" name="SN"<br><br>
	

	<hr>
	<b>Tips</b>:
	<br>

	* You can use UPG built in grid system https://purecss.io/ <br>
	* For better css style http://fontawesome.io/ is included by default. <br>
	* Even after plugin update, your changes will not be lost.
	
	</td></tr></table>
	<br>
	<input type="submit" name="submit" id="submit" class="button button-primary" value="Update Personal Post Form File">
	</form>
	
	
	
	
	  </div>
	  
	   <?php
	 //Personal Post form update
	 
	$upload_dir = wp_upload_dir();
	$user_dirname_post_youtube = $upload_dir['basedir'].'/upg_form_personal_post_youtube.php';
	
	$file_personal_post_youtube=dirname(__FILE__)."/form/personal/".get_current_blog_id()."_personal_post_youtube.php";
	if(isset($_POST['personal_post_youtube']))
	{
		echo "<h2>Updating Personal Youtube Form File</h2>";
		
		
		if ( is_writeable($file_personal_post_youtube) ) 
		{
		$file = fopen($file_personal_post_youtube,"w+");
		fwrite($file, wp_unslash($_POST['personal_post_youtube']));
		
		//save inside upload path
		$file = fopen($user_dirname_post_youtube,"w+");
		fwrite($file, wp_unslash($_POST['personal_post_youtube']));
		
		}
		else
		{
			echo "<h2>personal_post_youtube.php is not writeable</h2>";
		}
		
		
	}
	//IF file not exist
    if( ! file_exists( $user_dirname_post_youtube ) )
	{
		
		$sample_filename=dirname(__FILE__)."/form/personal/personal_post_youtube.txt";
		$sample_content =  file_get_contents($sample_filename);
		$file = fopen($user_dirname_post_youtube,"w+");
		fwrite($file, $sample_content);
		
		
	}
	
	
	$content_post_youtube =  file_get_contents($user_dirname_post_youtube);
	 
	 ?>
	 
	  
	  
	   <div  id="tab-5" >
	   	 <b>UPG Post Youtube Form: </b> Personal Layout (\layout\form\personal\<?php echo get_current_blog_id(); ?>_personal_post_youtube.php)<br>
	
	<br>
	This layout is used to show submission form for the youtube video only. It cannot be combined with file upload.
	<br>
	<br>
	
		<form class="pure-form" method="post" action="">
	<table border='1' width='99%'>
	<tr><td width="70%" valign="top">
	<?php
	wp_editor( $content_post_youtube, 'personal_post_youtube', $settings );
	?>

	<br>
	<b> Personal Layout : </b>  <a href="<?php echo plugins_url( '/wp-upg/layout/form/personal/personal_post_youtube.txt'); ?>" target="_blank">Get sample code</a>
	<hr>
	<b> Basic Layout : </b>  <a href="<?php echo plugins_url( '/wp-upg/layout/form/basic/basic_post_youtube.txt'); ?>" target="_blank">Get sample code</a>
	</td>
	<td valign='top' style="background-color:#eeeeee ;">
	
	<b>HTML id & name parameters are important part in form creation. Some name are reserved by default.</b><hr>
	
	<b>Title Field </b>: id="name" name="user-submitted-title" <br><br>
	<b>Description Field</b>: name="user-submitted-content" <br><br>
	
	<b>Category/Album Field</b>: name='cat' value='2' <br>
	The value field will have a ID of album. To generate dynamic category selection use php function as upg_droplist_category();<br><br>
	
	<b>File field </b>:File upload is not available at this form.<br>
	<br>
	<b>For Youtube URL Field</b>: id="url" name="user-submitted-url" type="url" <br><br>
	<b>Custom Fields</b>: name="upg_custom_field_1" <br>
	There are 5 custom fields (i.e. upg_custom_field_1, upg_custom_field_2, upg_custom_field_3, upg_custom_field_4, upg_custom_field_5)<br>
	You can assign any label name and type but form name should be equals to above. 
	<br><br>
	<b>Submit Button</b>: type="submit" name="SN"<br><br>
	
	<hr>
	<b>Tips</b>:
	<br>

	* You can use UPG built in grid system https://purecss.io/ <br>
	* For better css style http://fontawesome.io/ is included by default. <br>
	* Even after plugin update, your changes will not be lost.
	
	</td></tr></table>
	<br>
	<input type="submit" name="submit" id="submit" class="button button-primary" value="Update Personal Form Youtube File">
	</form>
	
	
	   </div>
	 
	 
	 
	 
	
	</div>
	 </div>
<?php
}
?>