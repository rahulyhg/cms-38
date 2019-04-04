<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
 
 # get post data
$temp_post = get_post($post_id);

# grab the author meta
$author_id = $temp_post->post_author;
$stream_name = get_the_author_meta('stream_2_name', $author_id);
$app_name = get_the_author_meta('app_2_name', $author_id);
$farm_name = get_the_author_meta ('farm_name', $author_id);
$contact = get_the_author_meta ('contact_number', $author_id);
?>

<div>
		<header class="entry-header">
			<?php if ( ! post_password_required() && ! is_attachment() ) :
				the_post_thumbnail();
			endif; ?>

			<?php if ( is_single() ) : ?>
			<h1 class="entry-title" align="center"><?php the_title(); ?></h1>
			<?php else : ?>
			<h1 class="entry-title" align="left">
			<?php echo $farm_name; ?>
			</h1>
			<h1>Contact Number: <?php echo $contact ?></h1>
</header><!-- .entry-header -->
			
 <div id="player" style="height:240px; width:320px; max-height: 480px; min-height: 120px; max-width: 640px; min-width: 160px;"></div>
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
 
			<?php endif; // is_single() ?>
			
		

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
