<?php $url =  get_post_meta(get_the_ID(), 'buzzblogpro_post_link', true);
	
if ($url): ?>
			<div class="link-image clearfix">
			<a target="_blank" href="<?php echo esc_url($url); ?>" title="<?php echo esc_url($url); ?>">
		<div class="image-link">	
	<div class="image-background" <?php buzzblogpro_link_format_post_bg(); ?>></div>
	</div>
	<div class="link-wrapper">
	<span class="responsive wtext">
       <?php echo esc_url($url); ?>
    </span>
	</div>
	</a>
	</div>
	<div class="clear"></div>
<?php endif; ?>