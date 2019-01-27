<?php
/**
 * Block type3
 */
?>
<?php
				$attachment_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())); 
				$url            = $attachment_url;
														if (function_exists('exif_imagetype') && @exif_imagetype($url) == IMAGETYPE_GIF) {
		 $image = $url;
		}else{
          $image          = aq_resize($url, $thumb_width, $thumb_height, true, true, true);
        }
		

?>
<?php if ( $counter == 1 ): ?><div class="col-xs-12 col-sm-6 col-md-6"><?php endif; ?>

<?php if ( $counter > 1 ): ?><div class="row small-post"><div class="col-md-12"><?php endif; ?>
<div class="post-grid-block post<?php if ( $counter == 1 ) { echo ' big-post'; } ?>">
	<div class="thumb-container"><div class="thumbnail">

		<div class="thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
							<img src="<?php echo esc_url($image); ?>" width="<?php echo esc_attr($img_width); ?>" height="<?php echo esc_attr($img_height); ?>" alt="<?php the_title_attribute();?>" > 
							</a></div></div>

	</div>
	<header class="post-header">
		
		<h2 class="grid-post-title"><a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()); ?>"><?php esc_attr(the_title()); ?></a></h2>
			<?php 
			if ($meta == 'yes'){ 
			if ( $counter == 1  ) {
			buzzblogpro_post_meta(array('author', 'date', 'comments'), false, 'meta-space-top'); 
					}else{
			buzzblogpro_post_meta(array('date'), false, 'meta-space-top');
					} }
			 ?>
		<?php if($excerpt_count >= 1 ) { ?>
		<?php if ( $counter == 1 ): ?>
			<p class="excerpt">
						<?php 
						$content = get_the_content();
				echo buzzblogpro_limit_text($content,$excerpt_count); ?>
						</p>
					
		<?php endif; ?>
		<?php } ?>
	</header>
</div>
<?php if ( $counter > 1 ): ?></div></div><?php endif; ?>
<?php if ( $counter == 1 ): ?></div><div class="col-xs-12 col-sm-6 col-md-6"><?php endif; ?>
<?php if ( $counter == $numers_results ): ?></div><?php endif; ?>