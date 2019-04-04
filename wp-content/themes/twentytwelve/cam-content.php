<?php
       if ( post_password_required() ) {
              echo get_the_password_form();
       }
       else {
       
  /**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

$temp_post = get_post($post_id);
$author_id = $temp_post->post_author;
$farm_logo = get_field ('farm_logo', 'user_' . $author_id);
$stream_name = get_the_author_meta('stream_name', $author_id);
$app_name = get_the_author_meta('app_name', $author_id);
$farm_name = get_the_author_meta ('farm_name', $author_id);
$cam_updates = get_the_author_meta ('update_information', $author_id);
$contact = get_the_author_meta ('contact_number', $author_id);
$website = get_the_author_meta ('farm_website', $author_id);
$facebook = get_the_author_meta ('facebook_page', $author_id);
$android = get_the_author_meta ('android_link', $author_id);
$apple = get_the_author_meta ('apple_link', $author_id);
$standalone = get_the_author_meta ('standalone_link', $author_id);
}
?>
<div>
		<header class="entry-header">
			<h1 class="entry-title" align="center">
			<a href="<?php echo $website?>"><?php echo $farm_name; ?></a><br/>
			<a href="<?php echo $facebook ?>"><img src="http://cms.showcasestreaming.com/images/facebook.png" alt="Facebook" /></a>			</h1>
			
<div class="tg-wrap">
<table class="tg">
  <tr>
    <th class="tg-yw4l" rowspan="3">
 <div id="container" style="height: 250px; width: 330px; max-height: 480px; min-height: 180px; max-width: 640px; min-width: 240px; padding: 15px; position: relative; background: #000000 url(http://cms.showcasestreaming.com/images/camresize.png) no-repeat bottom; background-position:bottom right">
 <div id="player" style="height: 100%; max-height: 480px; min-height: 120px; max-width: 640px; min-width: 160px;"></div>
 <script type="text/javascript">
flowplayer("player", "http://cms.showcasestreaming.com/player/flowplayer.commercial-3.2.16.swf",
{
key:'#$d3e949f94210daa0a95',
clip: { bufferTime: 1.5, bufferTimeMax: 5.0, onBeforePause: function() {return false;} },
playlist: [
 {url: 'http://www.showcasestreaming.com/images/showcasecam.jpg', duration: 5, scaling: 'scale'  },
 {url: '<?php echo $stream_name ?>', provider: 'rtmp', autoPlay: true, live: true }
           ],
plugins: {
   rtmp: {
        url: 'http://cms.showcasestreaming.com/player/flowplayer.rtmp-3.2.12.swf',
        netConnectionUrl: 'rtmp://cs1.showcasestreaming.com/<?php echo $app_name ?>'
         },
   controls: {
             url: 'http://cms.showcasestreaming.com/player/flowplayer.controls-3.2.15.swf',
             play:true,
			 autoplay:true,
             stop:true,                                   
             fullscreen:true,
             scrubber: false,
             backgroundColor: '#003333',
             backgroundGradient: 'low',
               }
           },
play: {opacity:0},
onLoad: function() { // called when player has finished loading
          this.setHeight(240); // set height property
          this.setWidth(320); // set width property
      }
                         });
 </script>
 </div>
</th>
<th style="height:20px" class="tg-yw4l" rowspan="1">Contact Number: <?php echo $contact ?></th>
</tr>
<tr style="height:60px;">
<td class="tg-yw4l"rowspan="1" ><a href="<?php echo $android ?>"><img src="http://cms.showcasestreaming.com/images/android.png" width="60" height="60" /></a>&nbsp;&nbsp;<a href="<?php echo $apple ?>"><img src="http://cms.showcasestreaming.com/images/apple.png" width="40" height="40" /></a>&nbsp;&nbsp;<a href="<?php echo $standalone ?>">Standalone Link</a></td></tr>
 <tr><td class="tg-yw4l"rowspan="1" ><?php echo $cam_updates?></td></tr>
  </table>
  </div>
  <div align="center" style="margin:10px"><img src="<?php echo $farm_logo; ?>" alt=""></div>
			
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary" style="display:none">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content" style="display:none">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta" style="display:none">
			<?php twentytwelve_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info" style="display:none">
					<div class="author-avatar" style="display:none">
						<?php
						/** This filter is documented in author.php */
						$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 68 );
						echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div><!-- .author-avatar -->
					<div class="author-description" style="display:none">
						<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link" style="display:none">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
	</div>
	</div>
	</div>