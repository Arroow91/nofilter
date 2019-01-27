<?php 
/**
* Grid post template
*/
?>
		<?php 
		
		$buzzblogpro_affiliate_banner = get_post_meta(get_the_ID(), '_buzzblogpro_affiliate_banner', true);
$buzzblogpro_shopstyle_affiliate_banner = get_post_meta(get_the_ID(), '_buzzblogpro_shopstyle_affiliate_banner', true);
if ($buzzblogpro_affiliate_banner or $buzzblogpro_shopstyle_affiliate_banner) {
$posttype = 'affiliate-active'; 
}else{
$posttype = '';
}

$proportions = buzzblogpro_getVariable('blog_list_proportions') ? buzzblogpro_getVariable('blog_list_proportions') : '70';

if ($proportions == '70') {
$prop1 = '5';
$prop2 = '7';
}else{
$prop1 = '6';
$prop2 = '6';
 } 

		if(buzzblogpro_getVariable('blog_list_image_left') == 'yes'){
		$img_left_class = '';
		$txt_right_class = 'left-space';
		}else{
		$img_left_class = 'col-sm-push-'.$prop2.' col-md-push-'.$prop2.'';
		$txt_right_class = 'col-sm-pull-'.$prop1.' col-md-pull-'.$prop1.' left-space';
		}
		
		?> 
		<div class="post_content <?php echo esc_attr($posttype); ?>">
		<div class="row row-eq-height">
		
 
<div class="col-sm-<?php echo esc_attr($prop1); ?> col-md-<?php echo esc_attr($prop1); ?> <?php echo esc_attr($img_left_class); ?>">
			            <?php	
			            $args = array(
		'width'          => buzzblogpro_getVariable('blog_list_image_width') ? buzzblogpro_getVariable('blog_list_image_width') : 560,
		'height'         => buzzblogpro_getVariable('blog_list_image_height') ? buzzblogpro_getVariable('blog_list_image_height') : 300,
		'crop'           => true,
		'gif'          => buzzblogpro_getVariable('blog_list_gif_images') == 'yes' ? true : false, 
);

			            if ( has_post_thumbnail() ) {
				            buzzblogpro_post_thumbnail( $args );
			            } 
			            ?>

		</div>
		
		
		<div class="col-sm-<?php echo esc_attr($prop2); ?> col-md-<?php echo esc_attr($prop2); ?> <?php echo esc_attr($txt_right_class); ?>">
	<header class="post-header">
<?php buzzblogpro_post_category('',' '); ?>


			<h2 class="list-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<?php buzzblogpro_post_meta(array('date', 'location', 'comments', 'reading_time'), false, 'meta-space-top');  ?>

	<div class="isopad_grid">
		<?php $post_excerpt = buzzblogpro_getVariable('post_excerpt'); ?>
		<?php if ($post_excerpt=='yes') { ?>		
			<div class="excerpt">
		<?php	 if (buzzblogpro_getVariable( 'blog_list_skip_excerpt' )!='yes') {
 apply_filters('the_content', ''); 			
			 the_excerpt(); 
 }else{
$excerpt = get_the_content();  
$limittext = buzzblogpro_getVariable( 'blog_excerpt_count' ) ? buzzblogpro_getVariable( 'blog_excerpt_count' ) : 20;
echo buzzblogpro_limit_text($excerpt,$limittext);
} ?>		
			</div>
		<?php } ?>

<?php $readmore_button = buzzblogpro_getVariable( 'readmore_button' ); 
if ($readmore_button=='yes') { ?>

				<div class="viewpost-button"><a class="button" href="<?php esc_url(the_permalink()) ?>"><span><?php echo theme_locals("continue_reading"); ?></span></a></div>
		<div class="clear"></div>
		<?php } ?>


		<?php if ($buzzblogpro_affiliate_banner or $buzzblogpro_shopstyle_affiliate_banner) { ?>
		<div class="affiliate-banner">
		<span class="shop-the-post"><?php esc_html_e('Shop The Post','buzzblogpro'); ?></span>
		<?php if ($buzzblogpro_affiliate_banner && shortcode_exists('show_shopthepost_widget')) { 
		echo do_shortcode( '[show_shopthepost_widget id="'.$buzzblogpro_affiliate_banner.'"]' ); 
		}
		if ($buzzblogpro_shopstyle_affiliate_banner) {
		echo $buzzblogpro_shopstyle_affiliate_banner; 
		}
		?>
		</div>
		<?php } ?>
		
			</div>

	
	</header>
</div>

	</div>
</div>