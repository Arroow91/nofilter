<?php
if( ! class_exists( 'buzzblogpro_slideshowClass' ) ) {
class buzzblogpro_slideshowClass
{
public static function buzzblogpro_slideshow()
  {

if(!is_paged()) {
global $buzzblogpro_options;
if(buzzblogpro_getVariable('woocommerce_slideshow_enable') == 'yes') {
$ids = (isset($buzzblogpro_options['products_by_id']) ? $buzzblogpro_options['products_by_id'] : null);
}else{
$ids = (isset($buzzblogpro_options['posts_by_id']) ? $buzzblogpro_options['posts_by_id'] : null);
}

$categories = (isset($buzzblogpro_options['posts_by_cat']) ? $buzzblogpro_options['posts_by_cat'] : null);

if(buzzblogpro_getVariable('woocommerce_slideshow_enable') == 'yes') {
$post_type = 'product';
}else{
$post_type = 'post';
}
			$post_status = 'publish';
			
			$custom_class  = buzzblogpro_getVariable('slideshow_caption_type');
			$rtl_slide = '';
			//$do_not_dublicate = false;
			//$do_not_dublicate  = buzzblogpro_getVariable('do_not_dublicate') == 'yes' ? true : false;
			
		$random_ID          = uniqid();
		$number_of_posts        = intval(buzzblogpro_getVariable('howmany_slides'));
		$thumb              = 'true';
		$slideshow_width       = buzzblogpro_getVariable('slideshow_thumbwidth') ? buzzblogpro_getVariable('slideshow_thumbwidth') : '';
		$slideshow_height       = absint( buzzblogpro_getVariable('slideshow_thumbheight') );
		$number_of_words      = absint( buzzblogpro_getVariable('slideshow_excerpt_words') );
		$items_desktop   = absint( buzzblogpro_getVariable('howmany_desktop') );
		$items_tablet   = absint( buzzblogpro_getVariable('howmany_tablet') );
		$items_mobile   = absint( buzzblogpro_getVariable('howmany_mobile') );
		$margin   = absint( buzzblogpro_getVariable('slideshow_margin') );
		$autoplay             = buzzblogpro_getVariable('slideshow_autoplay')== 'yes' ? 'true' : 'false';
		$enable_parallax = buzzblogpro_getVariable('enable_parallax')== 'yes' ? 'parallax-enabled' : 'parallax-disabled';
		$enable_video = buzzblogpro_getVariable('enable_video')== 'yes' ? 'video-playback-on' : 'video-playback-off';
		$gridornot = buzzblogpro_getVariable('slideshow_layout') == 'grid' ? 'grid-slideshow' : 'normal-slideshow';
		$auto_play_timeout          = absint( buzzblogpro_getVariable('slideshow_pause') );
		$date               = buzzblogpro_getVariable('slideshow_date') == 'yes' ? true : false;
		$show_category             = buzzblogpro_getVariable('slideshow_cat_name')== 'yes' ? true : false;
		$view_post_button             = buzzblogpro_getVariable('slideshow_viewpost')== 'yes' ? true : false;
		$display_navs       = buzzblogpro_getVariable('slideshow_displaynavs')== 'yes' ? 'true' : 'false';
		
		$display_pagination = buzzblogpro_getVariable('slideshow_displaypagination')== 'yes' ? 'true' : 'false';
		$enable_center_mode = buzzblogpro_getVariable('enable_center_mode')== 'yes' ? 'true' : 'false';
		$center_mode_not = buzzblogpro_getVariable('enable_center_mode') == 'yes' ? 'center-mode-on' : 'center-mode-off';
		
		$video_start = buzzblogpro_getVariable('slide_video_start') ? buzzblogpro_getVariable('slide_video_start') : '0';
		$video_end = buzzblogpro_getVariable('slide_video_end') ? buzzblogpro_getVariable('slide_video_end') : '0';
		
		$itemcounter = 0;
if (is_rtl()) {$rtl_slide = 'true';}

		$suppress_filters = get_option('suppress_filters'); 

if (!empty($ids)) {

		$args = array(
            'post__in' => $ids,	
            'orderby'  => 'post__in',			
			'post_status'         => $post_status,
			'posts_per_page'      => $number_of_posts,
			'ignore_sticky_posts' => 1,
			'post_type'           => $post_type,
			'meta_key' => '_thumbnail_id',
			'suppress_filters'    => $suppress_filters
		);
}else{
		$args = array(	
'category__in' => $categories,
'orderby'  => 'category__in',
			'post_status'         => $post_status,
			'posts_per_page'      => $number_of_posts,
			'ignore_sticky_posts' => 1,
			'post_type'           => $post_type,
			'meta_key' => '_thumbnail_id',
			'suppress_filters'    => $suppress_filters
		);
		}
		// The Query
		$carousel_query = new WP_Query( $args );
		$output = '';
$i = 1;
		if ( $carousel_query->have_posts() ) :

			echo '<div class="'.esc_attr($gridornot).' carousel-wrap slideshow ' . esc_attr($custom_class) . ' top-slideshow '.esc_attr($center_mode_not).'">'; 
				echo '<div id="owl-carousel-' . esc_attr($random_ID) . '" class="owl-carousel-' . esc_attr($post_type) . ' owl-carousel" data-center="' . esc_attr($enable_center_mode) . '" data-howmany="' .esc_attr($number_of_posts). '" data-margin="' . esc_attr($margin) . '" data-items="' . esc_attr($items_desktop) . '" data-tablet="' . esc_attr($items_tablet) . '" data-mobile="' . esc_attr($items_mobile) . '"  data-auto-play="' . esc_attr($autoplay) . '" data-auto-play-timeout="' . esc_attr($auto_play_timeout) . '" data-nav="' . esc_attr($display_navs) . '" data-rtl="'.esc_attr($rtl_slide).'" data-pagination="' . esc_attr($display_pagination) . '">';

				while ( $carousel_query->have_posts() ) : $carousel_query->the_post();
$post_id         = $carousel_query->post->ID;
				$post_title_attr = esc_attr( strip_tags( get_the_title( $post_id ) ) );
				
				//if( $do_not_dublicate ){
                //buzzblogpro_do_not_dublicate( $post_id );
				//}		  
if ( has_excerpt( $post_id ) ) {
						$excerpt = get_the_excerpt();
					} else {
						$excerpt = get_the_content();
					}
          // Video Background

          $attr = '';
		  $class = '';
		  $embed =  '';
          $format = get_post_format();
          if ( in_array($format, array('video')) ) {
            $embed = get_post_meta(get_the_ID(), '_buzzblogpro_video_embed', true);
$vimeo = strpos($embed, "vimeo");
	    $youtube = strpos($embed, "youtu");
	if($youtube !== false){	
$video_id = str_replace( 'http://', '', $embed );
	    	$video_id = str_replace( 'https://', '', $video_id );
	        $video_id = str_replace( 'www.youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtu.be/', '', $video_id );
	        $video_id = str_replace( '&feature=channel', '', $video_id );
			$link = '//www.youtube.com/embed/'.esc_attr($video_id);
			}
if($vimeo !== false){

	        //Get ID from video url
	        $video_id = str_replace( 'http://vimeo.com/', '', $embed );
	        $video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );
			$video_id = str_replace( 'https://vimeo.com/', '', $video_id );
			$link = '//player.vimeo.com/video/'.esc_attr($video_id);
			}
            if ($embed !== '') {
              $class = ' slide-video';
            }
          } ?>
<?php if(buzzblogpro_getVariable('slideshow_layout') == 'grid'){ ?>
<?php $count = 1; if( $i%3 == 2 ){ $count = 2; $subitem = 'small middle'; } elseif( $i%3 == 0 ){ $count = 3; $subitem = 'small last'; } ?>
<?php if ($count == 1) {$subitem = 'large';} ?>
         <?php if( $count == 1 ): ?><div class="owl-slide slideitem-<?php echo esc_attr( $count ); ?>"><?php endif; ?>
            
<div class="cover-wrapper cover<?php echo esc_attr($class); ?> slide-sub-item-<?php echo esc_attr( $subitem ); ?>" <?php  if ($embed !== '') { echo ' data-video="'.esc_url($embed) . '"'; } ?><?php  echo ' data-parallax="'.esc_attr($enable_parallax).'"'; ?> <?php  echo ' data-videoplayback="'.esc_attr($enable_video).'"'; ?> <?php  echo ' data-videostart="'.esc_attr($video_start).'"'; ?> <?php  echo ' data-videoend="'.esc_attr($video_end).'"'; ?>>
<?php
								
								
					$settings = array(
					
					
					'width'          => $slideshow_width ? $slideshow_width : 1170,
					'height'         => $slideshow_height ? $slideshow_height : 600,
					'pinit' => false,
					'crop'  => true,
					'lazy' => true,
					'class' => 'jarallax-img',
					'simple' => true,
					'disablevideolink' => true,
				);
				
                     buzzblogpro_post_thumbnail( $settings );
					 
					 
								?>
              <div class="cover-content">

                <?php echo esc_attr( $show_category) ? buzzblogpro_post_category($post_id) : ''; ?>
                <a href="<?php the_permalink();?>"><h2><?php the_title(); ?></h2></a>
				<div class="slide-meta-bottom">
				<?php echo esc_attr( $date) ? buzzblogpro_post_meta(array('date'), false, 'meta-space-top meta-slide') : ''; ?>
					<?php // post excerpt
							if ( !empty($excerpt{0}) ) {
								echo esc_attr( $number_of_words) > 0 ? '<div class="excerpt">'.buzzblogpro_limit_text( $excerpt, $number_of_words ).'</div>' : '';
							} ?>
                <?php echo esc_attr( $view_post_button) ? '<a href="' . esc_url(get_permalink( $post_id )) . '" class="slideshow-btn" title="' . esc_attr($post_title_attr) . '">' . theme_locals("view_post") . '</a>' : ''; ?>
</div>
			  </div>

			  <a href="<?php the_permalink();?>" class="cover-link"></a>
			  
			  			  <?php if ( in_array($format, array('video')) ) { ?>
			  <a class="popup-youtube slide-play" href="<?php echo esc_attr($link); ?>" title="<?php esc_attr(the_title()); ?>"></a>
			   <?php } ?>
			   
            </div>
            
          
		  <?php if( $count == 3 || $i == $carousel_query->post_count ){ echo '</div>'; } ?>
		 
		<?php }else{ ?>
		 
		           <div class="owl-slide">
            <div class="cover-wrapper cover <?php echo esc_attr($class); ?>" <?php  if ($embed !== '') { echo ' data-video="'.esc_url($embed) . '"'; } ?><?php  echo ' data-parallax="'.esc_attr($enable_parallax).'"'; ?> <?php  echo ' data-videoplayback="'.esc_attr($enable_video).'"'; ?> <?php  echo ' data-videostart="'.esc_attr($video_start).'"'; ?> <?php  echo ' data-videoend="'.esc_attr($video_end).'"'; ?> >
			
			
			
			
								<?php
								
								
					$settings = array(
					
					
					'width'          => $slideshow_width ? $slideshow_width : 1170,
					'height'         => $slideshow_height ? $slideshow_height : 600,
					'pinit' => false,
					'crop'  => true,
					'lazy' => true,
					'class' => 'jarallax-img',
					'simple' => true,
					'disablevideolink' => true,
				);
				
                     buzzblogpro_post_thumbnail( $settings );
					 
					 
								?>
								
							
				<?php if($custom_class != 'underneath') {	 ?>		
              <div class="cover-content">

			  <?php echo esc_attr( $show_category) ? buzzblogpro_post_category($post_id) : ''; ?>
                <a href="<?php the_permalink();?>"><h2><?php the_title(); ?></h2></a>
				<div class="slide-meta-bottom">
				<?php echo esc_attr( $date) ? buzzblogpro_post_meta(array('date'), false, 'meta-space-top meta-slide') : ''; ?>
					<?php // post excerpt
							if ( !empty($excerpt{0}) ) {
								echo esc_attr( $number_of_words) > 0 ? '<div class="excerpt">'.buzzblogpro_limit_text( $excerpt, $number_of_words ).'</div>' : '';
							} ?>
                <?php echo esc_attr( $view_post_button) ? '<a href="' . esc_url(get_permalink( $post_id )) . '" class="slideshow-btn" title="' . esc_attr($post_title_attr) . '">' . theme_locals("view_post") . '</a>' : ''; ?>
				
			</div>
              </div>
			  <?php } ?>	
			  <a href="<?php the_permalink();?>" class="cover-link"></a>
			  
			  	<?php if ( in_array($format, array('video')) ) { ?>
			  <a class="popup-youtube slide-play" href="<?php echo esc_attr($link); ?>" title="<?php esc_attr(the_title()); ?>"></a>
			   <?php } ?>
            </div>
			
							<?php if($custom_class == 'underneath') {	 ?>		
              <div class="cover-content">

			  <?php echo esc_attr( $show_category) ? buzzblogpro_post_category($post_id) : ''; ?>
                <a href="<?php the_permalink();?>"><h2><?php the_title(); ?></h2></a>
				<?php echo esc_attr( $date) ? buzzblogpro_post_meta(array('date'), false, 'meta-space-top meta-slide') : ''; ?>
					<?php // post excerpt
							if ( !empty($excerpt{0}) ) {
								echo esc_attr( $number_of_words) > 0 ? '<div class="excerpt">'.buzzblogpro_limit_text( $excerpt, $number_of_words ).'</div>' : '';
							} ?>
                <?php echo esc_attr( $view_post_button) ? '<a href="' . esc_url(get_permalink( $post_id )) . '" class="slideshow-btn" title="' . esc_attr($post_title_attr) . '">' . theme_locals("view_post") . '</a>' : ''; ?>
				
			
              </div>
			  <?php } ?>
			  
          </div>
		  
		  <?php } ?>

<?php $i++;
				endwhile;
			echo '</div></div>';
					// Restore original Post Data
wp_reset_postdata();
		endif;

}
}
}
}
?>