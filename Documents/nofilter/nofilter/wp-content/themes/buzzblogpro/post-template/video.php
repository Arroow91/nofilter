<?php 
		$embed = get_post_meta(get_the_ID(), '_buzzblogpro_video_embed', true);
		//Check for video format
	    $vimeo = strpos($embed, "vimeo");
	    $youtube = strpos($embed, "youtu");
	?>

	
<?php
			if ($embed != '') {?>
			<div class="embed-responsive embed-responsive-16by9">
						<?php	if($vimeo !== false){

	        //Get ID from video url
	        $video_id = str_replace( 'http://vimeo.com/', '', $embed );
	        $video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );
			$video_id = str_replace( 'https://vimeo.com/', '', $video_id );
			

	        //Display Vimeo video
	        echo '<iframe class="embed-responsive-item" src="//player.vimeo.com/video/'.esc_attr($video_id).'?title=0&amp;byline=0&amp;portrait=0" allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen" width="1000" height="750"></iframe>';

	    	} elseif($youtube !== false){

	        //Get ID from video url
	    	$video_id = str_replace( 'http://', '', $embed );
	    	$video_id = str_replace( 'https://', '', $video_id );
	        $video_id = str_replace( 'www.youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtu.be/', '', $video_id );
	        $video_id = str_replace( '&feature=channel', '', $video_id );

	        echo '<iframe title="'.esc_html_e('YouTube video player', 'buzzblogpro').'" class="embed-responsive-item youtube-player" width="1000" height="750" src="//www.youtube.com/embed/'.esc_attr($video_id).'" allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen"></iframe>';

	    	} ?>
				</div>
				<?php } else { ?>

	<?php 
		if (has_post_thumbnail() ):
	?>

	<div class="post-thumb clearfix">		
			<figure class="featured-thumbnail thumbnail large">
				<?php the_post_thumbnail( 'buzzblogpro-standard-large' ); ?>
			</figure>
			<div class="clear"></div>			
	</div>
	<?php endif; ?>	
<?php }
		?>