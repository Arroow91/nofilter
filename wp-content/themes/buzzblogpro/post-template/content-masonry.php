<?php 
$class = $attr = $posttype = '';
$enable_overlay_mode = get_post_meta( get_the_ID(), '_buzzblogpro_post_enable_overlay_mode', 1 ) ? 'yes' : 'no';
$buzzblogpro_affiliate_banner = get_post_meta(get_the_ID(), '_buzzblogpro_affiliate_banner', true);
$buzzblogpro_shopstyle_affiliate_banner = get_post_meta(get_the_ID(), '_buzzblogpro_shopstyle_affiliate_banner', true);

if (buzzblogpro_getVariable( 'shop_the_post' ) == 'yes') {
if ($buzzblogpro_affiliate_banner or $buzzblogpro_shopstyle_affiliate_banner) {
$posttype = 'affiliate-active'; 
}}

if($enable_overlay_mode == 'yes') {
$enable_parallax = get_post_meta( get_the_ID(), '_buzzblogpro_post_enable_parallax', 1 ) ? 'scaled' : 'cover'; 
$buzzblogpro_feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'buzzblogpro-standard-large');

$video_url = get_post_meta($post->ID, '_buzzblogpro_video_embed', true); 
if ( $video_url ) {
		$class = 'parallax-image modern-layout overlay-mode parallax-video';
		$attr = ' data-video="' . esc_url( $video_url ) . '" data-start="' . intval( buzzblogpro_getVariable('header_video_start') ) . '" data-end="' . intval( buzzblogpro_getVariable('header_video_end') ) . '"';
	}else{
	$class = 'parallax-image modern-layout overlay-mode';
	$attr = 'data-herculesdesign-parallax=\'{"backgroundUrl":"'. esc_attr($buzzblogpro_feat_image[0]).'","backgroundSize":['. esc_attr($buzzblogpro_feat_image[1]).','. esc_attr($buzzblogpro_feat_image[2]).'],"backgroundSizing":"'.esc_attr($enable_parallax).'","limitMotion":"0.7"}\'';
	}
	
	
?>



	
	
<div style="background-image: url(<?php echo esc_attr($buzzblogpro_feat_image[0]);?>);" class="<?php echo esc_attr($class);?>" <?php echo strip_tags($attr);?>  >
<div class="post-header-overlay"></div>
<div class="container"><div class="row">
                    <div class="col-md-12">
					<section class="single-title-section">
<?php get_template_part('post-template/post-meta-top'); ?>
</section></div></div></div></div>
	
	<?php }else{
if(has_post_format( array('quote'))){
}elseif(has_post_format( array('link'))){
get_template_part('post-template/link');
}else{
get_template_part('post-template/post-thumb-masonry');
} 
} ?>
	<?php 
	if($enable_overlay_mode != 'yes' ) { ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array('masonry-posts',$posttype)); ?>>
	<?php if(!has_post_format( array('quote'))){ 
	get_template_part('post-template/post-meta-top');
	} ?>
						
	<!-- Post Content -->
	<?php 
	$full_content = buzzblogpro_getVariable( 'full_content' );  
	if(!is_singular() && $full_content!='yes' or is_page()) : ?>
	<?php if(!has_post_format( array('quote'))){ ?>
	<div class="isopad">
		<?php $post_excerpt = buzzblogpro_getVariable( 'post_excerpt' ); 
		 if ($post_excerpt=='yes') { ?>		
			<div class="excerpt">
		<?php	 if (buzzblogpro_getVariable( 'blog_grid_skip_excerpt' )!='yes') {
 apply_filters('the_content', ''); 			
			 the_excerpt(); 
 }else{
$excerpt = get_the_content();  
$limittext = buzzblogpro_getVariable( 'blog_excerpt_count' ) ? buzzblogpro_getVariable( 'blog_excerpt_count' ) : 20;
echo buzzblogpro_limit_text($excerpt,$limittext);
} ?>	
			</div>
		<?php } else if ($post_excerpt=='') {
				the_content();
		         wp_link_pages( array(
				'before'      => '<div class="pagelink"><span class="page-links-title">' . esc_html__( 'Pages:', 'buzzblogpro' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'buzzblogpro' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) ); ?>
		
		<?php } ?>
				<?php $readmore_button = buzzblogpro_getVariable( 'readmore_button' ); 
if ($readmore_button=='yes') { ?>
<div class="clear"></div>
				<div class="viewpost-button"><a class="button" href="<?php esc_url(the_permalink()) ?>"><span><?php echo theme_locals("continue_reading"); ?></span></a></div>
		<div class="clear"></div>
		<?php } ?>
		<?php if (buzzblogpro_getVariable( 'shop_the_post' ) == 'yes') { ?>
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
		<?php }} ?>
		
<?php get_template_part( 'post-template/post-meta-bottom-masonry' ); ?>
	</div>
		<?php } ?>	
		<?php if(has_post_format('quote')){ 
		get_template_part('post-template/quote');
		 } ?>
 		 
	<?php else : ?>	
	<!-- Post Content -->
			<?php if(has_post_format('quote')){ 
		get_template_part('post-template/quote');
		 }else{ ?>
	<div class="isopad">
		<?php the_content(); ?>
		<?php       wp_link_pages( array(
				'before'      => '<div class="pagelink"><span class="page-links-title">' . esc_html__( 'Pages:', 'buzzblogpro' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'buzzblogpro' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) ); ?>
		<div class="clear"></div>
		
		
		
		<?php if (buzzblogpro_getVariable( 'shop_the_post' ) == 'yes') { ?>
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
		<?php }} ?>
		
<?php get_template_part( 'post-template/post-meta-bottom-masonry' ); ?>
	</div>
	<?php } ?>
	<!-- //Post Content -->	
	<?php endif; ?>
<?php /* content */ ?>
</article>
<?php 
}
?>