<?php get_header(); ?>
<?php 
$deflayout = get_post_meta( get_the_ID(), '_buzzblogpro_standard_layout_format', true ) ? get_post_meta( get_the_ID(), '_buzzblogpro_standard_layout_format', true ) : 'layout1';
$layout = $deflayout =='inherit' ? buzzblogpro_getVariable('post_layout_options') : $deflayout;
$infinite = buzzblogpro_getVariable('single_pagination_type'); 
?>
<div class="content-holder clearfix">
<?php if ($infinite == 'infinite') { ?><div class="ajax-container"><?php } ?>
	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
	 <?php if ($infinite == 'infinite') { ?><div class="ajax-post-wrapper" ><?php } ?>
	 <?php buzzblogpro_set_post_views( $post->ID ); ?>
		<?php get_template_part( 'post-template/single/'.$layout); ?>
		<?php if ($infinite == 'infinite') { ?></div><?php } ?>
	<?php endwhile; else : endif; ?>	
	<?php if ($infinite == 'infinite') { ?>
	<div class="ajax-pagination-container">
	<?php $prev_post = get_previous_post(); ?>
	<?php if (!empty( $prev_post )): ?>
  <a href="<?php echo get_permalink($prev_post->ID); ?>" id="ajax-load-more-posts-button"></a>
  <?php endif ?>
</div>
</div><?php } ?>

</div>
<?php get_footer(); ?>
