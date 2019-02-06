<?php /* Loop Name: Loop list-posts blog */ ?>
<?php 
$blog_list_special_post = buzzblogpro_getVariable('blog_list_special_post');
$counter = 1;

	 if (have_posts()) : 
	 while (have_posts()) : the_post();
	 ?>
<?php 
$enable_overlay_mode = get_post_meta( get_the_ID(), '_buzzblogpro_post_enable_overlay_mode', 1 ) ? 'yes' : 'no';
if (($counter % 3 == 0 && $blog_list_special_post == 'yes') or ($enable_overlay_mode == 'yes')) { ?>
<div class="block col-xs-12 col-md-12 ajax-post-wrapper" >

<?php get_template_part('content'); ?>
	
</div>
<?php }else{ ?>
<div id="post-<?php the_ID(); ?>" class="block col-xs-12 col-md-12 ajax-post-wrapper list-post-container" > 
<?php 
   get_template_part('post-template/list-post-template'); 
?>
</div>
<?php } ?>
<?php $counter ++ ; 
		endwhile; ?>

		<?php else: ?>
		
<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>