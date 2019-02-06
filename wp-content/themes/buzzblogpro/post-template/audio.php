<?php
// get audio attribute
$embed = get_post_meta(get_the_ID(), '_buzzblogpro_audio_embed', true);

$hercules_audio_url = get_post_meta(get_the_ID(), '_buzzblogpro_audio_url', true);
$hercules_file = $hercules_audio_url; 
$hercules_random = buzzblogpro_gener_random(10);
?>
<div id="audio_<?php echo esc_attr($hercules_random); ?>" class="audio-wraper active">
<?php
			if ($embed != '') {
				echo stripslashes(htmlspecialchars_decode($embed));

			} else if($hercules_file !='') { 
			$hercules_audio_title = get_post_meta(get_the_ID(), '_buzzblogpro_audio_title', true);
$hercules_audio_artist = get_post_meta(get_the_ID(), '_buzzblogpro_audio_artist', true);		
			?>
			
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
			<div class="audio-wrap">
		
<div class="audio-meta">
<div class="audio-title"><?php echo esc_attr( $hercules_audio_title); ?></div>
<div class="audio-artist"><?php echo esc_attr( $hercules_audio_artist); ?></div>
</div>
  <audio class="audio" preload="auto" controls>
				<source src="<?php echo stripslashes(htmlspecialchars_decode($hercules_file)); ?>">
			</audio>
	</div>
	<?php }else{} ?>
	</div>