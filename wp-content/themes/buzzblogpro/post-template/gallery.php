<?php 
$buzzblogpro_gallery_featured = get_post_meta(get_the_ID(), 'buzzblogpro_gallery_featured', true);

if (($buzzblogpro_gallery_featured=='true' && is_singular()) or ($buzzblogpro_gallery_featured=='false')) {
if (is_singular()) { 
$buzzblogpro_targetheight = get_post_meta(get_the_ID(), 'buzzblogpro_gallery_targetheight_single', true);
}else{
$buzzblogpro_targetheight = get_post_meta(get_the_ID(), 'buzzblogpro_gallery_targetheight', true);
}
$buzzblogpro_gallery_margins = get_post_meta(get_the_ID(), 'buzzblogpro_gallery_margins', true);
$buzzblogpro_gallery_captions = get_post_meta(get_the_ID(), 'buzzblogpro_gallery_captions', true);
$buzzblogpro_gallery_randomize = get_post_meta(get_the_ID(), 'buzzblogpro_gallery_randomize', true);
$buzzblogpro_gallery_type = get_post_meta(get_the_ID(), 'buzzblogpro_gallery_format', true);
$buzzblogpro_random = buzzblogpro_gener_random(10);
if ($buzzblogpro_gallery_type!='slideshow' && $buzzblogpro_gallery_type!='grid' && $buzzblogpro_gallery_type!='lightboxgallery') {echo esc_html__('Select the gallery type', 'buzzblogpro');}
	 if ($buzzblogpro_gallery_type=='slideshow') { 

		$attachments = get_post_meta( $post->ID, '_format_gallery_images', true );
		if ($attachments) {  
		$c = count ($attachments);
	 ?>
		
		<div class="carousel-wrap post-carousel">
			<div id="owl-carousel-<?php echo esc_attr( $buzzblogpro_random) ?>" class="owl-carousel" data-howmany="<?php echo esc_attr($c); ?>" data-margin="0" data-items="1" data-tablet="1" data-mobile="1"  data-auto-play="true" data-auto-play-timeout="5000" data-nav="true" data-rtl="<?php if (is_rtl()) { echo esc_attr('true'); }else{ echo esc_attr('false');} ?>" data-pagination="true">
					<?php
							
								foreach ((array) $attachments as $attachment => $attachment_url) {
								
									
									$args = array(
													
					
					'attachment_id'  => $attachment,
					'width'          => 1170,
					'height'         => 600,
					'pinit' => true,
					'crop'  => true,
					'lazy' => false,
					'addclass' => 'featured-thumbnail large',
					'caption' => get_post_field('post_excerpt', $attachment)
				);
				
                     buzzblogpro_post_thumbnail( $args );
                     } 
?>
			</div>
			</div>
			
			
			
	
		<?php }else{echo esc_html__('No images', 'buzzblogpro');}
		} ?>
		
		
		<?php if ($buzzblogpro_gallery_type=='grid') {

		$buzzblogpro_attachments = get_post_meta( $post->ID, '_format_gallery_images', true ); 
		if ($buzzblogpro_attachments) {
		?>

					<div id="justifiedgall_<?php echo esc_attr( $buzzblogpro_random) ?>" data-rtl="<?php if (is_rtl()) { echo esc_attr('true'); }else{ echo esc_attr('false');} ?>" data-captions="<?php if( ! empty( $buzzblogpro_gallery_captions ) ) {echo esc_attr( $buzzblogpro_gallery_captions);}else{echo 'true';} ?>" data-rowheight="<?php if( ! empty( $buzzblogpro_targetheight ) ) {echo esc_attr( $buzzblogpro_targetheight);}else{echo '150';} ?>" data-margins="<?php if( ! empty( $buzzblogpro_gallery_margins ) ) {echo esc_attr( $buzzblogpro_gallery_margins);}else{echo '10';} ?>" data-randomize="<?php if( ! empty( $buzzblogpro_gallery_randomize ) ) {echo esc_attr( $buzzblogpro_gallery_randomize);}else{echo 'false';} ?>">
		
					<?php 
					
					//$buzzblogpro_attachments = array_combine(array_slice(array_keys($buzzblogpro_attachments), 0, 3), array_slice($buzzblogpro_attachments, 0, 3));
					
					foreach ((array) $buzzblogpro_attachments as $attachment => $attachment_url) {

									$attachment_url = wp_get_attachment_image_src( $attachment, 'buzzblogpro-gallery-post' );
									$attachment_full = wp_get_attachment_image_src( $attachment, 'full' );
									$url            = $attachment_url[0];
							
			$caption = get_post_field('post_excerpt', $attachment);
					?>
					
					<div><a class="open" title="<?php echo esc_attr($caption); ?>" href="<?php echo esc_url($attachment_full['0']); ?>"><img src="<?php echo esc_url($url); ?>" width="<?php echo esc_attr($attachment_url[1]); ?>" height="<?php echo esc_attr($attachment_url[2]); ?>" alt="<?php echo esc_attr($caption); ?>"/></a></div>
					<?php 
					
						}
					?>
			</div>

		<?php }else{echo esc_html__('No images', 'buzzblogpro');} }?>
		
		
		
 <?php
	 if ($buzzblogpro_gallery_type=='lightboxgallery') {
	$post_gallery_photos = get_post_meta($post->ID, '_format_gallery_images', true);
	if ($post_gallery_photos) {
		$count = count($post_gallery_photos);
	}
?>
<?php if ( has_post_thumbnail() ) { ?>
	<figure class="lightbox-gallery featured-thumbnail thumbnail large">
		<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'buzzblogpro-gallery-post'); ?>
		<?php the_post_thumbnail('buzzblogpro-standard-large'); ?>
		<?php if ($post_gallery_photos) { ?>
		<a href="#post-gallery-<?php the_ID(); ?>" class="lightbox-gallery-link">
			<div class="view-gallery-button">
				<span><?php esc_html_e('VIEW GALLERY', 'buzzblogpro'); ?></span><br>
				<em><?php echo esc_attr($count); ?> <?php esc_html_e('Photos', 'buzzblogpro'); ?></em>
				<i class="fa fa-angle-right"></i>
			</div>
		</a>
		<?php } else { ?>
		<a href="#" class="gallery-link empty"><?php esc_html_e('Please Add Photos to your Gallery', 'buzzblogpro'); ?></a>
		<?php } ?>
	</figure>
<?php } else { ?>
	<p class="text-center"><strong><?php esc_html_e('Please select a featured image for your post', 'buzzblogpro'); ?></strong></p>
<?php } ?>
<?php get_template_part( 'post-template/post-gallery' );
}
 ?>
<?php }

 if ($buzzblogpro_gallery_featured=='true' && !is_singular()) {  get_template_part('post-template/post-thumb'); } ?>