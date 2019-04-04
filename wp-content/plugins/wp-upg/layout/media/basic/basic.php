<style>
.upg-desp{
	color:#999;
	font-size:1.2em;
	
	
}
.upg-profile-name{
	color:#999;
}

.avatar {
border-radius: 50%;
-moz-border-radius: 50%;
-webkit-border-radius: 50%;
}
</style>

							
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
	
	$author = get_user_by('id', get_the_author_meta( 'ID' ));
	//echo $author->first_name;
	//echo $author->user_nicename;
	
	
	
	?>
<div class="pure-g">
	
	 <div class="pure-u-1-1" style="text-align:center;"><?php echo upg_position1(); ?></div>
	
	<div class="pure-u-1-1" > 

	<div class="margin-box">
	<center>
	<?php
					 if(upg_isVideo($post))
					 {
						 $attr = array(
						'src'      => esc_url( upg_isVideo($post) ),
						'width'    => 560,
						'height'   => 315
						
						);
	
						echo wp_video_shortcode( $attr );
					 }
					else
					{
							 
						?>
					 <img src="<?php echo $image; ?>" class="pure-img">
					  <?php
					}
						 ?>
	
	</center>
	</div>


	</div>
	
	<div class="pure-u-1 pure-u-md-4-5">
		<div class="margin-box">
	
	
			<div class="upg-desp"> 	<?php echo $text; ?> </div>
	
		</div>
	</div>
	 <div class="pure-u-1 pure-u-md-1-5" style="text-align:right;"> 

		<?php 
	echo upg_author($author);
	?>

	</div>
	
	<div class="pure-u-1"><?php upg_list_tags($post); ?> <br><?php echo upg_position2(); ?></div>
	
</div>	
	
	<?php

	$abc=ob_get_clean (); 
	return $abc;
}
