<?php
/**
 * Template for displaying posts inside mega menus
 * @package buzzblogpro
 * @since 1.0.0
 */
global $post, $product;
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
		'reviewscore'           => false,
		'disablevideolink' => true,
		'disableimagelink' => true,
		'addclass' => 'megamenu-images',
);

			            if ( has_post_thumbnail() ) {
				            buzzblogpro_post_thumbnail( $args );   
			            } 
			            ?>
	<p class="post-title"><a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_attr(the_title()); ?>"><?php esc_attr(the_title()); ?></a></p>
	
			 <?php if (buzzblogpro_getVariable('post_date')=='yes') { ?>
	<span class="post-date date"><?php  buzzblogpro_time_ago(); ?></span>
<?php } ?>
<?php echo wp_kses_post($product->get_price_html()); ?>
</article>
