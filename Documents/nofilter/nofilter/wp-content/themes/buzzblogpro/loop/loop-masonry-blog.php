<?php /* Loop Name: Loop masonry blog */ ?>
<!-- displays the tag's description from the WordPress admin -->
<?php 
$blog_sidebar_pos = buzzblogpro_getVariable('blog_sidebar_pos');
$blog_grid_special_post = buzzblogpro_getVariable('blog_grid_special_post');
switch ($blog_sidebar_pos) {
		case 'masonry2':
			$blog_class = '6';
			$counter_set = '3';
		break;
		case 'masonry2sideleft':
			$blog_class = '6';
			$counter_set = '3';
		break;
		case 'masonry2sideright':
			$blog_class = '6';
			$counter_set = '3';
		break;
		case 'masonry3':
			$blog_class = '4';
			$counter_set = '4';
		break;
		case 'masonry4':
			$blog_class = '3';
			$counter_set = '5';
		break;
	}

$counter = 1;
	 if (have_posts()) : 
	 while (have_posts()) : the_post();
	 ?>

<?php if (($counter % $counter_set == 0 && $blog_grid_special_post == 'yes')) { ?>
<div class="ajax-post-wrapper block col-xs-12 col-sm-12 col-md-12" > 
<div class="grid-block-full">
<?php
get_template_part('content');
if (buzzblogpro_getVariable('related_post') !='no' and buzzblogpro_getVariable('related_post_single') !='yes') { get_template_part( 'post-template/related-posts' ); }
?>
</div>
</div>

<?php }else{ ?>
<div class="grid-item ajax-post-wrapper block col-xs-12 col-sm-<?php echo esc_attr( $blog_class); ?> col-md-<?php echo esc_attr( $blog_class); ?>" > 
<div class="grid-block">
		
<?php get_template_part('post-template/content', 'masonry'); ?>
	</div>
</div>
<?php } ?>
<?php $counter ++ ; 
endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php else: ?>	
<?php 
wp_deregister_script('masonry');
get_template_part( 'content', 'none' ); ?>
<?php endif; ?>