<?php
/**
 * Template for displaying posts inside mega menus
 * @package buzzblogpro
 * @since 1.0.0
 */

?>
<article class="post">
<?php	
			            $args = array(
		'width'          => buzzblogpro_getVariable('megamenu_items_image_width') ? buzzblogpro_getVariable('megamenu_items_image_width') : 261,
		'height'         => buzzblogpro_getVariable('megamenu_items_image_height') ? buzzblogpro_getVariable('megamenu_items_image_height') : 360,
		'crop'           => true,
		'single'           => true,
		'gif'           => false,
		'pinit'           => false,
		'lazy'           => false,
		'reviewscore'           => true,
		'disablevideolink' => true,
		'disableimagelink' => true,
		'addclass' => 'megamenu-images',
);

			            if ( has_post_thumbnail() ) {
				            buzzblogpro_post_thumbnail( $args );   
			            } 
			            ?>
	<p class="post-title"><a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php the_title_attribute(); ?></a></p>
			 <?php if (buzzblogpro_getVariable('post_date')=='yes') { ?>
	<span class="post-date date"><?php  buzzblogpro_post_meta(array('date'), true, '');  ?></span>
<?php } ?>
</article>



