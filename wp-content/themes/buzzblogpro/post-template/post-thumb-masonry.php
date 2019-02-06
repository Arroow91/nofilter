<?php
if(buzzblogpro_getVariable('featured_images') =='featured3') {
}else{
if(!is_singular() && buzzblogpro_getVariable('featured_images') =='featured2' || !is_singular() && buzzblogpro_getVariable('featured_images') =='featured1' or is_page()) { 
?>
			            <?php	
			            $args = array(
		'width'          => buzzblogpro_getVariable('blog_grid_image_width') ? buzzblogpro_getVariable('blog_grid_image_width') : 405,
		'height'         => buzzblogpro_getVariable('blog_grid_image_height') ? buzzblogpro_getVariable('blog_grid_image_height') : 420,
		'crop'           => buzzblogpro_getVariable('blog_grid_crop_images') == 'no' ? false : true,
		'single'           => buzzblogpro_getVariable('blog_grid_crop_images') == 'no' ? false : true,
		'gif'          => buzzblogpro_getVariable('blog_grid_gif_images') == 'yes' ? true : false, 
);
 
			            if ( has_post_thumbnail() ) {
				            buzzblogpro_post_thumbnail( $args );   
			            } 
			            ?>

<?php } ?>

<?php if(is_singular() && buzzblogpro_getVariable('featured_images') =='featured1' && !is_page()) { ?>

	<?php if(has_post_thumbnail()) { ?>
<figure class="featured-thumbnail thumbnail large">
				<?php buzzblogpro_pinterest_share(); ?>
				<?php the_post_thumbnail( 'buzzblogpro-standard-large' ); ?> 
</figure>
<?php
   }
 } 
}
?>

