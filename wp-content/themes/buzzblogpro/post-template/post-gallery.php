<?php
	$post_gallery_photos = get_post_meta($post->ID, '_format_gallery_images', true);

    if ($post_gallery_photos) {
			
			$count = count($post_gallery_photos);
    }
	$i = 1;
?>
<div id="post-gallery-<?php the_ID(); ?>" class="mfp-hide">
	
	<?php if ($post_gallery_photos) {foreach ((array) $post_gallery_photos as $attachment => $attachment_url) {  ?>
	
		<div class="post-gallery-content">
		
		<div class="mfp-wrapper"><div class="mfp-counter"><?php echo esc_attr($i) . '/'. esc_attr($count); ?></div><div class="mfp-contain">
		
			 <div class="mfp-bottom-bar">
              <div class="mfp-title">
					<?php if (get_post($attachment)->post_title) { ?>
					<h6><?php echo get_post($attachment)->post_title; ?></h6>
					<?php } ?>
					<?php if (get_post($attachment)->post_excerpt) { ?>
					<p><?php echo get_post($attachment)->post_excerpt; ?></p>
					<?php } ?>
					<?php if (get_post($attachment)->post_content) { ?>
					<small><?php echo get_post($attachment)->post_content; ?></small>
					<?php } ?>
			  </div>
              
            </div>
			<div class="mfp-figure">
            <span title="Close (Esc)" class="mfp-close"><?php esc_html_e('Back to story', 'buzzblogpro'); ?></span>
            <?php echo wp_get_attachment_image( $attachment, 'full', false, array('class' => 'mfp-img') ); ?>
          </div>
		 </div></div> 
	</div>
	<?php $i++; } } ?>
</div>