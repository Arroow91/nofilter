<?php 
	 if (have_posts()) : ?>
	 <div class="grid js-masonry ajax-container row zoom-gallery">
	<?php while (have_posts()) : the_post();
	 ?>

<div id="post-<?php the_ID(); ?>" class="post-list_h ajax-post-wrapper block <?php echo esc_attr($cols); ?>" > 

<?php 
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full');
				$img_width = buzzblogpro_getVariable('gallery_image_width') ? buzzblogpro_getVariable('gallery_image_width') : 374;
				$img_height = buzzblogpro_getVariable('gallery_image_height') ? buzzblogpro_getVariable('gallery_image_height') : 320;
				$img = aq_resize( $img_url, $img_width, $img_height, true, true, true );
?>
		<div class="post_content grid-block">

<?php  if(has_post_thumbnail()) { ?>
<div class="thumb-container">
<figure class="featured-thumbnail thumbnail large">
<?php
$buzzblogpro_gal_url = get_post_meta( get_the_ID(), 'buzzblogpro_gallery_url', true );

$buzzblogpro_url_separate_window = get_post_meta( get_the_ID(), 'buzzblogpro_url_separate_window', true );
	 	
if ($buzzblogpro_url_separate_window != esc_html__('yes', 'buzzblogpro')) { ?>
<a class="gallery-ajax-popup archive-button image-wrap zoomer" data-source="<?php echo esc_url($img_url); ?>" href="<?php echo esc_url($img_url); ?>" title="<?php esc_attr(the_title()); ?>">
<?php }else{ ?>
<a class="archive-button image-wrap" href="<?php echo esc_url($buzzblogpro_gal_url); ?>" target="_blank" title="<?php esc_attr(the_title()); ?>">
<?php } ?> 
							
		<img src="<?php echo esc_url($img); ?>" width="<?php echo esc_attr($img_width); ?>" height="<?php echo esc_attr($img_height); ?>" alt="<?php esc_attr(the_title());?>" >

	<span class="zoom-icon"></span>
		</a></figure>
	<header class="post-header">
	<?php if (buzzblogpro_getVariable( 'gallery_title' )=='yes' || buzzblogpro_getVariable( 'gallery_category' )=='yes' || buzzblogpro_getVariable( 'gallery_description' )=='yes') { ?>
			<div class="meta-space-top">
<?php if (buzzblogpro_getVariable( 'gallery_category' )=='yes') { ?> 
<span class="post_category">
<?php
$terms = wp_get_object_terms($post->ID, 'gallery-categories');
if(is_array($terms)) : 

if(isset($terms[0])) : ?><?php echo esc_attr($terms[0]->name); ?>
 <?php endif;endif; ?>

</span>
 <?php } ?>
	</div>
<?php if (buzzblogpro_getVariable( 'gallery_title' )=='yes') { ?>
			<a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_attr(the_title()); ?>"><h3 class="gall-title"><?php esc_attr(the_title()); ?></h3></a>
	<?php } ?>
		

<?php if (buzzblogpro_getVariable('post_date')=='yes' or buzzblogpro_getVariable('post_date')=='') {buzzblogpro_post_meta(array('date'), false, 'meta-space-top'); } ?>
	


	 <?php if (buzzblogpro_getVariable( 'gallery_description' )=='yes') {
$gallery_excerpt = buzzblogpro_getVariable( 'gallery_excerpt_count' ); 	
$content = get_the_content(); 
if($gallery_excerpt != 0) {
?>

	<div class="post_content">	
		<?php echo buzzblogpro_limit_text($content,$gallery_excerpt); ?>
		<div class="clear"></div>
	</div>
	
			
		
	<?php }} ?>
	
<?php } ?>
			
</header></div>
<?php } ?>
</div>
	
</div>
<?php 
 endwhile; ?>
<?php wp_reset_postdata(); ?>
</div>
<?php else: ?>	
<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>

<?php get_template_part('post-template/post-nav'); ?>