<?php
if(buzzblogpro_getVariable('featured_images') =='featured3') {
}else{
if(!is_singular() && buzzblogpro_getVariable('featured_images') =='featured2' || !is_singular() && buzzblogpro_getVariable('featured_images') =='featured1' || !is_singular() && buzzblogpro_getVariable('featured_images') =='') { 
?>
		<?php if(has_post_thumbnail()) { ?>
<figure class="featured-thumbnail thumbnail large">
				<?php buzzblogpro_pinterest_share(); ?>
				<?php echo buzzblogpro_display_review_piechart( get_the_ID(), $size = 36, $bgcolor = 'rgba(0, 0, 0, .2)', $fgcolor = '#f7f3f0', $donutwidth = 3, $fontsize = '12px' );?>
		<?php if(has_post_format('image')) { 
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', false, '' );
		?>

				<a class="image-popup-no-margins" href="<?php echo esc_url($src[0]); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail( 'buzzblogpro-standard-post' ); ?> 
				</a>
				
		<?php }else{ ?>

				<a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>">
																								<?php if(has_post_format('video')){
echo '<div class="cover-video"></div>';
 }  ?>
				<?php the_post_thumbnail( 'buzzblogpro-standard-post' ); ?> 
				</a>
				
		<?php } ?>
</figure>
		<?php } ?>

<?php } ?>

<?php if((is_singular() && buzzblogpro_getVariable('featured_images') =='featured1') or (is_singular() && buzzblogpro_getVariable('featured_images') =='') ) { ?>

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

