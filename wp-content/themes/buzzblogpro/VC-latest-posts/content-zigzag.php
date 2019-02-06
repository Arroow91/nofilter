<div id="post-<?php the_ID(); ?>" class="block col-md-12 ajax-post-wrapper" >

<div class="post list_post_content zigazg">
		<div class="row"><div class="<?php if ($counter % 2 == 1){echo 'col-xs-12 col-sm-5 col-md-5 ';} else if ($counter % 2 == 0){echo 'col-xs-12 col-sm-5 col-md-5 col-sm-push-7 col-md-push-7';} ?>">
<?php  if(has_post_thumbnail()) { ?>
<div class="thumb-container">
<?php 	
if(has_post_format('video')){
$embed = get_post_meta(get_the_ID(), 'buzzblogpro_video_embed', true);
$vimeo = strpos($embed, "vimeo");
	    $youtube = strpos($embed, "youtu");
	if($youtube !== false){	
$video_id = str_replace( 'http://', '', $embed );
	    	$video_id = str_replace( 'https://', '', $video_id );
	        $video_id = str_replace( 'www.youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtu.be/', '', $video_id );
	        $video_id = str_replace( '&feature=channel', '', $video_id );
			$link = '//www.youtube.com/embed/'.esc_attr($video_id);
			}
if($vimeo !== false){

	        //Get ID from video url
	        $video_id = str_replace( 'http://vimeo.com/', '', $embed );
	        $video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );
			$link = '//player.vimeo.com/video/'.esc_attr($video_id);
			}
}
$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full');
				$img_width = buzzblogpro_getVariable('blog_zigzag_image_width') ? buzzblogpro_getVariable('blog_zigzag_image_width') : 470;
				$img_height = buzzblogpro_getVariable('blog_zigzag_image_height') ? buzzblogpro_getVariable('blog_zigzag_image_height') : 490;
				$img = aq_resize( $img_url, $img_width, $img_height, true, true, true );
				?>
							<figure class="featured-thumbnail thumbnail large">
							<?php buzzblogpro_pinterest_share(); ?>
							<?php if(has_post_format('video')){ ?>
								<a class="popup-youtube" href="<?php echo esc_attr($link); ?>" title="<?php the_title_attribute(); ?>">
																												<?php if(has_post_format('video')){
echo '<div class="cover-video"></div>';
 }  ?>
								<img src="<?php echo esc_url($img); ?>" width="<?php echo esc_attr($img_width); ?>" height="<?php echo esc_attr($img_height); ?>" alt="<?php the_title_attribute();?>" /></a>
								<?php }else{ ?>
								<a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>">
								<img src="<?php echo esc_url($img); ?>" width="<?php echo esc_attr($img_width); ?>" height="<?php echo esc_attr($img_height); ?>" alt="<?php the_title_attribute();?>" /></a>
								<?php } ?>
							</figure></div>
<?php } ?>	
		</div>
		<div class="<?php if ($counter % 2 == 1){echo 'col-xs-12 col-sm-7 col-md-7';} else if ($counter % 2 == 0){echo 'col-xs-12 col-sm-7 col-md-7 col-sm-pull-5 col-md-pull-5';} ?>">
	<header class="post-header">
	<?php buzzblogpro_post_category('',' '); ?>
			<h2 class="list-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	<div class="meta-space-top">

<?php if (buzzblogpro_getVariable('post_date')=='yes' or buzzblogpro_getVariable('post_date')=='') {buzzblogpro_post_meta(array('author', 'date', 'comments', 'reading_time', 'views'), false, 'meta-space-top');} ?>
	
</div>

	<div class="isopad_grid">
		<?php $post_excerpt = buzzblogpro_getVariable('post_excerpt'); ?>
		<?php if ($post_excerpt=='yes') { ?>		
			<div class="excerpt">			
<?php the_excerpt(); ?>			
			</div>
		<?php } ?>
						<?php $readmore_button = buzzblogpro_getVariable('readmore_button');
if ($readmore_button=='yes') { ?>
				<div class="clear"></div><div class="viewpost-button"><a class="button" href="<?php esc_url(the_permalink()) ?>"><span><?php echo theme_locals("continue_reading"); ?></span></a></div>
		<div class="clear"></div>
		<?php } ?>
	</div>
	<div class="meta-line">
	<?php get_template_part('post-template/comments-meta');	 ?>
	<?php get_template_part( 'post-template/share-buttons' ); ?>
	<?php get_template_part('post-template/post-meta');	 ?>
	</div>
	</header>
</div>
	</div>
</div>
	
</div>