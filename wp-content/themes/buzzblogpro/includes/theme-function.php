<?php
/*-----------------------------------------------------------------------------------*/
# Remove Query Strings From Static Resources
/*-----------------------------------------------------------------------------------*/
if( ! function_exists( 'buzzblogpro_remove_query_strings_1' )){

	function buzzblogpro_remove_query_strings_1( $src ){
		$rqs = explode( '?ver', $src );
		return $rqs[0];
	}

}

if( ! function_exists( 'buzzblogpro_remove_query_strings_2' )){

	function buzzblogpro_remove_query_strings_2( $src ){
		$rqs = explode( '&ver', $src );
		return $rqs[0];
	}

}
/**
* Set posts IDs for the do not dublicate posts option
*/
if( ! function_exists( 'buzzblogpro_do_not_dublicate' )){

	function buzzblogpro_do_not_dublicate( $post_id = false ){
		if( empty( $post_id )) return;

		if( empty( $GLOBALS['buzzblogpro_do_not_duplicate'] ) ){
			$GLOBALS['buzzblogpro_do_not_duplicate'] = array();
		}

		$GLOBALS['buzzblogpro_do_not_duplicate'][ $post_id ] = $post_id;
	}

}



/**
 * Row Class
 */
function buzzblogpro_gridable_row_class() {
	return array( 'row gridable' );
}
add_filter( 'gridable_row_class',  'buzzblogpro_gridable_row_class' );

/**
 * Column Class
 */
function buzzblogpro_gridable_column_class( $classes, $size, $atts, $content ) {

	$classes = array( 'col-md-' . $size );

	return $classes;
}
add_filter( 'gridable_column_class',  'buzzblogpro_gridable_column_class', 10, 4 );
/**
 * Remove Gridable Styles
 */
add_filter( 'gridable_load_public_style', '__return_false' );
/**
 * Remove Gridable Scripts
 */
function buzzblogpro_gridable_scripts() {
	wp_dequeue_script( 'gridable' );
}
add_action( 'wp_print_scripts', 'buzzblogpro_gridable_scripts' );

//review
function buzzblogpro_display_review_piechart( $post_id, $size = 34, $bgcolor = 'rgba(0, 0, 0, .2)', $fgcolor = '#f7f3f0', $donutwidth = 2, $fontsize = '12px' ){
$entries = get_post_meta( $post_id, '_buzzblogpro_review_box', true );
if($entries) {
$overall_score = 0;
$total_num = count($entries);

foreach ( (array) $entries as $key => $entry ) {

	$number = $output = '';
	$value = 0;
					
	if ( isset( $entry['_buzzblogpro_review_number'] ) ) {
		$number = esc_html( $entry['_buzzblogpro_review_number'] );
	}
	
$overall_score+= $number;
}

$total_review = $overall_score / $total_num;

$format = number_format( $total_review, 1, '.', '' );
$percent =	$format * 10;

$title = '';
$font = '';
$fontstyle = '';
$points = $format;
$custom_class = '';
if($total_review == 0) {
return;
}
/**
 * 
if($points) {$values = $points; }else{$values = $percent; }
		$lineheight = $size - 2;
		$output = '<div class="skills '. $custom_class .'" style="text-align:center; font-family:'. $font .'; font-style:'. $fontstyle .'; font-size:'. $fontsize .'">
            <div class="chart" data-bgcolor="'. $bgcolor .'" data-fgcolor="'. $fgcolor .'" data-donutwidth="'. $donutwidth .'" data-size="'. $size .'" data-percent="'. $percent .'"><span style="line-height: '. $lineheight .'px;" class="percent">'. $values .'</span></div>';
			
			if(!$points) {
			$output .= '<p style="color:#000000;">'. $title .'</p>';
			}
 */
 $output = '<div class="review"><span><a class="reviewscore" href="'.get_permalink().'#review">'.$format.'</a></span></div>';
 
			return $output;
} 
}

/**
 * Get the list of registered sidebars
 */

if ( !function_exists( 'buzzblogpro_get_sidebars_list' ) ):
	function buzzblogpro_get_sidebars_list() {

		$sidebars = array();

		$sidebars['none'] = esc_html__( 'None', 'buzzblogpro' );

		global $wp_registered_sidebars;

		if ( !empty( $wp_registered_sidebars ) ) {

			foreach ( $wp_registered_sidebars as $sidebar ) {
				$sidebars[$sidebar['id']] = $sidebar['name'];
			}

		}

		unset( $sidebars['hs_before_blog'] );
		unset( $sidebars['hs_top_instagram'] );
		unset( $sidebars['hs_top_0'] );
		unset( $sidebars['hs_top_1'] );
		unset( $sidebars['hs_top_2'] );
		unset( $sidebars['hs_bottom_1'] );
		unset( $sidebars['hs_bottom_2'] );
		unset( $sidebars['hs_bottom_3'] );
		unset( $sidebars['hs_instagram_area'] );
		unset( $sidebars['hs_bottom_4'] );
        unset( $sidebars['hs_under_header'] );
		unset( $sidebars['hs_under_header_logo'] );
		unset( $sidebars['hs_under_footer_logo'] );
		unset( $sidebars['hs_side_panel'] );
		unset( $sidebars['hs_newsletter_popup'] );
		unset( $sidebars['hs_ads'] );
		return $sidebars;
	}
endif;

function buzzblogpro_formaticons() {
 $postid = get_the_ID();
 $formaticons = get_post_format( $postid );
if(is_sticky()){
	echo "<div class=\"ribbon-wrapper-featured hidden-phone\"><div class=\"ribbon-featured\">".theme_locals('featured')."</div></div>";
	}else{ 
 switch ($formaticons) {
    case "link":
        echo "<div class=\"post-formats hidden-phone\"><i class=\"hs hs-link\"></i></div>";
        break;
	case "quote":
        echo "<div class=\"post-formats hidden-phone\"><i class=\"icon-quote\"></i></div>";
        break;		
}
}
}
function buzzblogpro_pinterest_share() {
if (buzzblogpro_getVariable('enable_pinit_button') !='no') {
$permalink = get_permalink(get_the_ID());
$titleget = wp_strip_all_tags(get_the_title());

$pinterest_share = buzzblogpro_getVariable('pinterest_share');
if ($pinterest_share=='yes') { $pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
if(buzzblogpro_getVariable('pinit_image','url') == ''){
echo '<a target="_blank" class="hs hs-pinterest pinterest-share-icon" href="http://pinterest.com/pin/create/button/?url='.esc_url( $permalink).'&amp;media='.esc_attr($pinterestimage[0]).'&amp;description='.str_replace(" ", "%20", $titleget).'" data-pin-do="buttonPin" data-pin-custom="true"></a>';
}else{
echo '<a target="_blank" class="pinterest-share-icon pinimage" href="http://pinterest.com/pin/create/button/?url='.esc_url( $permalink).'&amp;media='.esc_attr($pinterestimage[0]).'&amp;description='.str_replace(" ", "%20", $titleget).'" data-pin-do="buttonPin" data-pin-custom="true"><img src="'.esc_url( buzzblogpro_getVariable('pinit_image','url')).'" width="'.esc_attr( buzzblogpro_getVariable('pinit_image','width')).'" height="'.esc_attr( buzzblogpro_getVariable('pinit_image','height')).'" alt="'.str_replace(" ", "%20", $titleget).'" title="'.str_replace(" ", "%20", $titleget).'" /></a>';
}
 } 
 }
}
 

function buzzblogpro_author_posts( $link )
{
return str_replace( 'rel="author"', 'rel="author" class="url"', $link );
}
add_filter( 'the_author_posts_link', 'buzzblogpro_author_posts' );

if ( !function_exists( 'buzzblogpro_getVariable' ) ) :

function buzzblogpro_getVariable( $name = '', $key = '' ) {
  global $buzzblogpro_options;
  $hs_options = $buzzblogpro_options;
  $hs_var = '';
  if ( empty( $name ) && !empty( $hs_options ) ) {
	$hs_var = $hs_options;
  } else {
      if ( $key ) {
	  if ( !empty( $hs_options[$name][$key] ) ) {
        $hs_var = $hs_options[$name][$key];
      }else {
        $hs_var = '';
      }
	  }else {
    if ( !empty( $hs_options[$name] ) ) {
	$hs_var = $hs_options[$name];
 } else {
$hs_var = '';
}
}
}
return $hs_var;
}
endif;
/**
 * Post view
 */
if ( ! function_exists( 'buzzblogpro_get_post_views' ) ) {
	function buzzblogpro_get_post_views( $postID ) {
		$count_key = 'buzzblogpro_post_views_count';
		$count     = get_post_meta( $postID, $count_key, true );
		if ( $count == '' ) {
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '0' );

			return "0";
		}

		return $count;
	}
}

if ( ! function_exists( 'buzzblogpro_set_post_views' ) ) {
	function buzzblogpro_set_post_views( $postID ) {
		$count_key = 'buzzblogpro_post_views_count';
		$count_wkey = 'buzzblogpro_post_week_views_count';
		$count_mkey = 'buzzblogpro_post_month_views_count';
		$count     = get_post_meta( $postID, $count_key, true );
		$count_w     = get_post_meta( $postID, $count_wkey, true );
		$count_m     = get_post_meta( $postID, $count_mkey, true );

		/* Update views count all time */
		if ( $count == '' ) {
			$count = 0;
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, $count );
		}
		else {
			$count ++;
			update_post_meta( $postID, $count_key, $count );
		}

		/* Update views count week */
		if ( $count_w == '' ) {
			$count_w = 0;
			delete_post_meta( $postID, $count_wkey );
			add_post_meta( $postID, $count_wkey, $count_w );
		}
		else {
			$count_w ++;
			update_post_meta( $postID, $count_wkey, $count_w );
		}

		/* Update views count month */
		if ( $count_m == '' ) {
			$count_m = 0;
			delete_post_meta( $postID, $count_mkey );
			add_post_meta( $postID, $count_mkey, $count_m );
		}
		else {
			$count_m ++;
			update_post_meta( $postID, $count_mkey, $count_m );
		}
	}
}

/**
 * Add schedules intervals
 */
add_filter( 'cron_schedules', 'buzzblogpro_add_schedules_intervals' );
if ( ! function_exists( 'buzzblogpro_add_schedules_intervals' ) ) {
	function buzzblogpro_add_schedules_intervals( $schedules ) {
		$schedules['weekly'] = array(
			'interval' => 604800,
			'display'  => esc_html__( 'Weekly', 'buzzblogpro' )
		);

		$schedules['monthly'] = array(
			'interval' => 2635200,
			'display'  => esc_html__( 'Monthly', 'buzzblogpro' )
		);

		return $schedules;
	}
}

/**
 * Add scheduled event during theme activation
 */
add_action( 'after_switch_theme', 'buzzblogpro_add_schedule_events' );
if ( ! function_exists( 'buzzblogpro_add_schedule_events' ) ) {
	function buzzblogpro_add_schedule_events() {
		if ( ! wp_next_scheduled( 'buzzblogpro_reset_track_data_weekly' ) )
			wp_schedule_event( time(), 'weekly', 'buzzblogpro_reset_track_data_weekly' );

		if ( ! wp_next_scheduled( 'buzzblogpro_reset_track_data_monthly' ) )
			wp_schedule_event( time(), 'monthly', 'buzzblogpro_reset_track_data_monthly' );
	}
}

/**
 * Remove scheduled events when theme deactived
 */
add_action( 'switch_theme', 'buzzblogpro_remove_schedule_events' );
if ( ! function_exists( 'buzzblogpro_remove_schedule_events' ) ) {
	function buzzblogpro_remove_schedule_events() {
		wp_clear_scheduled_hook( 'buzzblogpro_reset_track_data_weekly' );
		wp_clear_scheduled_hook( 'buzzblogpro_reset_track_data_monthly' );
	}
}


/**
 * Reset view counter of week
 */
add_action( 'buzzblogpro_reset_track_data_weekly', 'buzzblogpro_reset_week_view' );
if ( ! function_exists( 'buzzblogpro_reset_week_view' ) ) {
	function buzzblogpro_reset_week_view() {
		global $wpdb;

		$meta_key = 'buzzblogpro_post_week_views_count';
		$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_value = '0' WHERE meta_key = %s", $meta_key ) );
	}
}

/**
 * Reset view counter of month
 */
add_action( 'buzzblogpro_reset_track_data_monthly', 'buzzblogpro_reset_month_view' );
if ( ! function_exists( 'buzzblogpro_reset_month_view' ) ) {
	function buzzblogpro_reset_month_view() {
		global $wpdb;

		$meta_key = 'buzzblogpro_post_month_views_count';
		$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_value = '0' WHERE meta_key = %s", $meta_key ) );
	}
}

/**-------------------------------------------------------------------------------------------------------------------------
 * remove pages from search
 */
if ( ! function_exists( 'buzzblogpro_filter_search' ) ) {
	function buzzblogpro_filter_search() {

		if ( is_admin() ) {
			return false;
		}
		if ( is_tax() ) {
		global $wp_post_types;
		$wp_post_types['page']->exclude_from_search = true;
		return false;
		}
	}

	add_action( 'init', 'buzzblogpro_filter_search', 99 );
}

//hook into the init action and call create_topics_nonhierarchical_taxonomy when it fires

add_action( 'init', 'buzzblogpro_create_locations_nonhierarchical_taxonomy', 0 );

function buzzblogpro_create_locations_nonhierarchical_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => esc_html__( 'Locations', 'buzzblogpro' ),
    'singular_name' => esc_html__( 'location', 'buzzblogpro' ),
    'search_items' =>  esc_html__( 'Search Locations', 'buzzblogpro' ),
    'popular_items' => esc_html__( 'Popular Locations', 'buzzblogpro' ),
    'all_items' => esc_html__( 'All Locations', 'buzzblogpro' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => esc_html__( 'Edit Location', 'buzzblogpro' ), 
    'update_item' => esc_html__( 'Update Location', 'buzzblogpro' ),
    'add_new_item' => esc_html__( 'Add New Location', 'buzzblogpro' ),
    'new_item_name' => esc_html__( 'New Location Name', 'buzzblogpro' ),
    'separate_items_with_commas' => esc_html__( 'Separate locations with commas', 'buzzblogpro' ),
    'add_or_remove_items' => esc_html__( 'Add or remove locations', 'buzzblogpro' ),
    'choose_from_most_used' => esc_html__( 'Choose from the most used locations', 'buzzblogpro' ),
	'not_found'  => esc_html__( 'No Locations found', 'buzzblogpro' ),
    'menu_name' => esc_html__( 'Locations', 'buzzblogpro' ),
  ); 

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('location','post',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'location' ),
  ));
  
}

/*-----------------------------------------------------------------------------------*/
# Lazyload images
/*-----------------------------------------------------------------------------------*/
if( ! function_exists( 'buzzblogpro_lazyload_image_attributes' )){

	add_filter( 'wp_get_attachment_image_attributes', 'buzzblogpro_lazyload_image_attributes', 8, 3 );
	function buzzblogpro_lazyload_image_attributes( $attr, $attachment, $size ) {

		if( class_exists( 'Jetpack' ) && in_array( 'photon', Jetpack::get_active_modules() ) && in_array( 'the_content', $GLOBALS['wp_current_filter'] ) ){

			return $attr;
		}
		if(!is_admin()) {
        $content = get_the_content();
		if(has_shortcode( $content, 'hercules-gallery') ){
		return $attr;
		}
		}
		if( buzzblogpro_getVariable('lazyload_images') == 'yes' && ! is_admin() && ! is_feed() && !is_singular( 'product' ) && function_exists( 'is_cart' ) && !is_cart() ){

			$attr['class'] .= ' lazyload';

			$blank_image = get_template_directory_uri() . '/images/empty.png';

			$attr['data-src'] = $attr['src'];
			$attr['src']      = $blank_image;

			unset( $attr['srcset'] );
			unset( $attr['sizes'] );
		}

		return $attr;
	}

}


/**
 * get post thumbnail
 */
function buzzblogpro_get_post_thumbnail( $args=array() ) {
    global $post;
	$link_class = '';
	$overlay_icon = '';
	$link = '';
	$args = wp_parse_args( $args, array(
		'alt'            => wp_strip_all_tags(get_the_title()),
		'post_id' => '',
		'attachment_id'  => get_post_thumbnail_id(),
		'width'          => '',
		'height'         => '',
		'crop'           => true,
		'single'         => true,
		'class'          => '',
		'gif'          => true,
		'pinit'          => true,
		'addclass' => '',
		'addstyle' => '',
		'lazy' => true,
		'reviewscore' => true,
		'upscale'  => true,
		'caption' => '',
		'no-icon' => false,
		'simple' => false,
		'disablevideolink' => false,
		'disableimagelink' => false,
		
	) );

	$class                        = array( 'attachment' );
	if ( $args['class'] ) {
		$class[] = $args['class'];
	}
	$bool = buzzblogpro_getVariable('lazyload_images');
    $blank_image = get_template_directory_uri() . '/images/empty.png';

	$original_image               = wp_get_attachment_image_src( $args['attachment_id'], 'full' );
	$original_image_width         = $original_image[1];
	$original_image_height        = $original_image[2];
	$image_url                    = wp_get_attachment_image_url( $args['attachment_id'], 'full' );

	// CHECK THE WIDTH AND HEIGHT
	if ( $image_url  && $args['width'] && $args['height'] ) {
        $file_type = wp_check_filetype( $image_url );
		// DO CROP
		if ( $args['crop'] == true && $args['upscale'] == false ) {
			$args['width']  =  $args['width'] < $original_image_width? $args['width']:$original_image_width;
			$args['height'] =  $args['height'] < $original_image_height? $args['height']:$original_image_height;
		} else {
			if ( $args['width'] === '9999' ) {
				$args['height'] =  $args['height'] < $original_image_height? $height:$original_image_height;
			}
			if ( $args['height'] === '9999' ) {
				$args['width']  =  $args['width'] < $original_image_width? $args['width']:$original_image_width;
			}
		}

		// Fixed for Jetpack
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) && function_exists( 'jetpack_photon_url' ) ) {
			$type = ( $args['crop'] ) ? 'resize' : 'fit';
			$image_args = array(
				$type => $args['width'] . ',' . $args['height']
			);
			$image_url = jetpack_photon_url( $image_url, $image_args );
		} elseif( ! empty( $file_type ) && $file_type['ext'] == 'gif' && $args['gif']==true ) {
            $image_url = $original_image[0];
		}else{
			
			$image_url = aq_resize( $original_image[0], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );
			
			if($args['single']==false) {
			$args['width'] = $image_url[1];
			$args['height'] = $image_url[2];
			$image_url = $image_url[0];
			}
		}

	}
	
	if(has_post_format('video') && $args['no-icon'] == false){
$link_class = 'popup-youtube';
$overlay_icon = '<div class="cover-video"></div>';
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
			if($args['disablevideolink'] == false) {
			$link = '//www.youtube.com/embed/'.esc_attr($video_id);
			}else{
			$link = get_permalink($args['post_id']); 
			}
			}
if($vimeo !== false){

	        //Get ID from video url
	        $video_id = str_replace( 'http://vimeo.com/', '', $embed );
	        $video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );
			$video_id = str_replace( 'https://vimeo.com/', '', $video_id );
			if($args['disablevideolink'] == false) {
			$link = '//player.vimeo.com/video/'.esc_attr($video_id);
			}else{
			$link = get_permalink($args['post_id']); 
			}
			}
}elseif(has_post_format('image') && $args['disableimagelink'] == false ){
$link = $original_image[0];
$link_class = 'image-popup-no-margins';
}else{
$link = get_permalink($args['post_id']); 
}

		if ( $bool == 'yes' && $args['lazy'] == true ) {
            $class[] = 'lazyload';
            $src = 'data-sizes="auto" src="'. esc_url( $blank_image ) .'" data-src="'. esc_url( $image_url ) .'"';

        } else {

            $src = 'src="'. esc_url($image_url) .'"';

        }
		
// pinit
if (buzzblogpro_getVariable('enable_pinit_button')=='yes' && $args['pinit']==true) {
if(buzzblogpro_getVariable('pinit_image','url') == ''){
$pinit = '<a target="_blank" class="hs hs-pinterest pinterest-share-icon" href="http://pinterest.com/pin/create/button/?url='.esc_url( $link).'&amp;media='.esc_attr($original_image[0]).'&amp;description='.str_replace(" ", "%20", $args['alt']).'" data-pin-do="buttonPin" data-pin-custom="true"></a>';
}else{
$pinit = '<a target="_blank" class="pinterest-share-icon pinimage" href="http://pinterest.com/pin/create/button/?url='.esc_url( $link).'&amp;media='.esc_attr($original_image[0]).'&amp;description='.str_replace(" ", "%20", $args['alt']).'" data-pin-do="buttonPin" data-pin-custom="true"><img src="'.esc_url( buzzblogpro_getVariable('pinit_image','url')).'" width="'.esc_attr( buzzblogpro_getVariable('pinit_image','width')).'" height="'.esc_attr( buzzblogpro_getVariable('pinit_image','height')).'" alt="'.str_replace(" ", "%20", $args['alt']).'" title="'.str_replace(" ", "%20", $args['alt']).'" /></a>';
}
 }else{
$pinit = '';
 }
 
if ($args['caption']) { 
$caption = '<div class="slideshow-cap">'.esc_attr($args['caption']).'</div>';
$args['alt'] = $args['caption'];
}else{
$caption = '';
}
 
 if (buzzblogpro_getVariable('enable_score')=='yes' && $args['reviewscore'] == true) {
	$review_score = buzzblogpro_display_review_piechart( get_the_ID(), $size = 36, $bgcolor = 'rgba(0, 0, 0, .2)', $fgcolor = '#f7f3f0', $donutwidth = 3, $fontsize = '12px' );	
	}else{
	$review_score = '';
	}
	$image_attributes = array(
		'width="'. $args['width'] .'"',
		'height="'. $args['height'] .'"',
		'class="' . trim( implode( ' ', $class ) ) . '"',
		'alt="' . $args['alt'] . '"'
	);
	
	if ( $args['simple'] == false ) {
	return '<figure style="'.$args['addstyle'].'" class="thumbnail '.$args['addclass'].'">'.$review_score.$pinit.'<a href="'.$link.'" class="hover-thumbnail '.$link_class.'">'.$overlay_icon.'<img '.$src.' ' . implode( ' ', $image_attributes ) . ' /></a>'.$caption.'</figure>';
}else{
return '<img '.$src.' ' . implode( ' ', $image_attributes ) . ' />';
}
}


/**
 * post thumbnail
 * @version 1.0.0
 */
function buzzblogpro_post_thumbnail( $args=array() ) {
	echo buzzblogpro_get_post_thumbnail( $args );
}


// Gif images

if( ! function_exists( 'buzzblogpro_gif_full_image' )){

	add_filter( 'wp_get_attachment_image_src', 'buzzblogpro_gif_full_image', 10, 4 );
	function buzzblogpro_gif_full_image( $image, $attachment_id, $size, $icon ){


			$file_type = wp_check_filetype( $image[0] );

			if( ! empty( $file_type ) && $file_type['ext'] == 'gif' && $size != 'full' ){

				return wp_get_attachment_image_src( $attachment_id, $size = 'full', $icon );
			}

		return $image;
	}

}


if( ! function_exists( 'buzzblogpro_filter_lazyload' )){
	add_filter( 'the_content', 'buzzblogpro_filter_lazyload', 15 );
	function buzzblogpro_filter_lazyload( $content ){

if ( buzzblogpro_getVariable('lazyload_images') != 'yes' && !is_admin() && !is_feed()) {
return $content;
}
	if ( !is_singular(array( 'post', 'page' )) && is_singular( 'product' )) {
		return $content;
	}

	    $contents = get_the_content();
		if(has_shortcode( $contents, 'hercules-gallery') or has_shortcode( $contents, 'posts_grid') ){
		return $content;
		}
		
		$placeholder_url = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
		

		$matches = array();
		preg_match_all( '/<img[\s\r\n]+.*?>/is', $content, $matches );
		
		$search = array();
		$replace = array();

		foreach ( $matches[0] as $imgHTML => $img_value ) {
			
			// don't do the replacement if the image is a data-uri
			if ( ! preg_match( "/src=['\"]data:image/is", $img_value ) ) {

				$placeholder_url_used = $placeholder_url;
				// use low res preview image as placeholder if applicable
				$low_res_preview = 'no';
				if ( 'yes' == $low_res_preview ) {
					if( preg_match( '/class=["\'].*?wp-image-([0-9]*)/is', $img_value, $id_matches ) ) {
						$img_id = intval($id_matches[1]);
						$tiny_img_data  = wp_get_attachment_image_src( $img_id, 'buzzblogpro-nextprev-thumb' );
						$tiny_url = $tiny_img_data[0];
						$placeholder_url_used = $tiny_url;
					}
				} 

				if ( buzzblogpro_getVariable('lazyload_images') == 'yes'){

				
				// replace the src and add the data-src attribute
				$replaceHTML = preg_replace( '/<img(.*?)src=/is', '<img$1src="' . esc_attr( $placeholder_url_used ) . '" data-lazy-type="image" data-src=', $img_value );
				
				// also replace the srcset (responsive images)
				$replaceHTML = str_replace( 'srcset', 'data-srcset', $replaceHTML );
				// replace sizes to avoid w3c errors for missing srcset
				$replaceHTML = str_replace( 'sizes', 'data-srcset', $replaceHTML );
				
				// add the lazy class to the img element
				if ( preg_match( '/class=["\']/i', $replaceHTML ) ) {
					$replaceHTML = preg_replace( '/class=(["\'])(.*?)["\']/is', 'class=$1lazyload lazy-hidden $2$1', $replaceHTML );
				} else {
					$replaceHTML = preg_replace( '/<img/is', '<img class="lazyload lazy-hidden"', $replaceHTML );
				}
				
				}else{
				$replaceHTML = $img_value;
				}

				//$replaceHTML .= '<noscript>' . $img_value . '</noscript>';
				array_push( $search, $img_value );
				array_push( $replace, $replaceHTML );
			}
		}

		$content = str_replace( $search, $replace, $content );
        
		return $content;
}
	

}

add_filter( 'the_content' , 'buzzblogpro_filter_pinit' , 15 );

function buzzblogpro_filter_pinit( $content ) {
if ( buzzblogpro_getVariable('enable_pinit_button') !='yes' && !is_admin() && !is_feed()) {
return $content;
}
	if ( !is_singular(array( 'post', 'page' )) && is_singular( 'product' )) {
		return $content;
	}

	    $contents = get_the_content();
		if(has_shortcode( $contents, 'hercules-gallery') or has_shortcode( $contents, 'posts_grid') ){
		return $content;
		}
 if (buzzblogpro_getVariable('enable_pinit_button')=='yes' ) {
 
 if(buzzblogpro_getVariable('pinit_image','url') == ''){
							$icon = '<i class="hs hs-pinterest pinterest-share-icon"></i>';
							$iconclass = 'pinitsvg';
							}else{
							$icon = '<img src="'.esc_url( buzzblogpro_getVariable('pinit_image','url')).'" width="'.esc_attr( buzzblogpro_getVariable('pinit_image','width')).'" height="'.esc_attr( buzzblogpro_getVariable('pinit_image','height')).'" alt="'.esc_html__('Pinit','buzzblogpro').'" title="'.esc_html__('Pinit','buzzblogpro').'" />';
							$iconclass = 'pinimage';
							}
// Regex to find all <img ... > tags
$mh_img_regex1 = "/\<img [^>]*src=\"([^\"]+)\"[^>]*>/";

// Regex to find all <a href"..."><img ... ></a> tags
$mh_img_regex2 = "/<a href=.*><img [^>]*src=\"([^\"]+)\"[^>]*><\/a>/"; 

// Populate the results into 2 arrays
preg_match_all( $mh_img_regex1 , $content, $mh_img );
preg_match_all( $mh_img_regex2 , $content, $mh_matches );

// The second array will be a subset of the first so go through 
// each element and delete the duplicates in the first.
$i=0;
foreach ( $mh_img[0] as $mh_img_count ) {
  $i2=0;
  foreach ( $mh_matches[0] as $mh_matches_count ) {
    if ( strpos($mh_matches_count, $mh_img_count ) ){
      unset( $mh_img[0][$i] );
      unset( $mh_img[1][$i] );
            $i2++;
      break;
    }
          $i2++;
          }
  $i++;
  }

$i=0;
$mh_start = count( $mh_matches[0] );
foreach ( $mh_img[0] as $mh_img_count ) {
  $mh_matches[0][ $mh_start + $i ] = $mh_img_count;
  $i++;
}
$i=0;
foreach ( $mh_img[1] as $mh_img_count ) {
  $mh_matches[1][ $mh_start + $i ] = $mh_img_count;
  $i++;
}

// If we get any hits then put the code before and after the img tags
if ( $mh_matches ) {;
  for ( $mh_count = 0; $mh_count < count( $mh_matches[0] ); $mh_count++ )
    {
    // Old img tag
    $mh_old = $mh_matches[0][$mh_count];

    // Get the img URL, it's needed for the button code
    $mh_img_url = $mh_matches[1][$mh_count];

    // Put together the pinterest code to place before the img tag
    $mh_pinterest_code = '<div class="wrap-pin"><a target="_blank" href="https://pinterest.com/';
    $mh_pinterest_code .= 'pin/create/button/?url=' . urlencode( get_permalink() );
    $mh_pinterest_code .= '&media=' . $mh_img_url . '&description=';
    $mh_pinterest_code .= urlencode( get_the_title() ) . '" class="pinterest-share-icon '.$iconclass.'">'.$icon.'</a>';

    // Replace before the img tag in the new string
    $mh_new = preg_replace( '/^/' , $mh_pinterest_code , $mh_old );
    // After the img tag
    $mh_new = preg_replace( '/$/' , '</div>' , $mh_new );

    // make the substitution
    $content = str_replace( $mh_old, $mh_new , $content );
    }
  }
  }
return $content;
}
// Gravatar Lazyload

if( ! function_exists( 'buzzblogpro_lazyload_avatar' )){

	add_filter( 'get_avatar', 'buzzblogpro_lazyload_avatar', 10, 6 );
	function buzzblogpro_lazyload_avatar( $avatar, $user, $size, $default, $alt, $args ){

		if( buzzblogpro_getVariable('lazyload_images') == 'yes' && ! is_admin() && ! is_feed() && ! in_array( 'the_content', $GLOBALS['wp_current_filter'] ) ){

			# Class ----------
			$class = array( 'avatar', 'avatar-' . (int) $args['size'], 'photo' );

			$class[] = 'lazyload';

			if ( ! $args['found_avatar'] || $args['force_default'] ) {
				$class[] = 'avatar-default';
			}

			if ( $args['class'] ) {
				if ( is_array( $args['class'] ) ) {
	        $class = array_merge( $class, $args['class'] );
				} else {
	        $class[] = $args['class'];
				}
			}

			# prepare the image
			$avatar = sprintf(
				"<img alt='%s' src='%s' data-src='%s' class='%s' height='%d' width='%d' %s/>",
				esc_attr( $args['alt'] ),
				get_template_directory_uri() . '/images/empty.png',
				esc_url( $args['url'] ),
				esc_attr( join( ' ', $class ) ),
				(int) $args['height'],
				(int) $args['width'],
				$args['extra_attr']
			);

		}

		return $avatar;
	}

}

if ( ! function_exists( 'buzzblogpro_is_touch' ) ) {

	function buzzblogpro_is_touch( $check = 'all' ) {
		static $buzzblogpro_mobile_detect;

		if ( ! isset( $buzzblogpro_mobile_detect ) ) {
			if ( ! class_exists( 'Buzzblogpro_Mobile_Detect' ) ) {
				require_once 'main-menu/class-buzzblogpro-mobile-detect.php';
			}
			$detect = new buzzblogpro_Mobile_Detect;
			$is_tablet = $detect->isTablet();
			$is_mobile = $detect->isMobile();
			$buzzblogpro_mobile_detect = array(
				'phone' => $is_mobile && ! $is_tablet,
				'tablet' =>  $is_tablet,
				'all' => $is_mobile,
			);
		}

		return $buzzblogpro_mobile_detect[$check];
	}
}

if ( ! function_exists( 'buzzblogpro_allowedtags' ) ) :
function buzzblogpro_allowedtags() {
$excerpt_allowed_tags = buzzblogpro_getVariable( 'blog_excerpt_allowed_tags' ) ? buzzblogpro_getVariable( 'blog_excerpt_allowed_tags' ) : '';
        return $excerpt_allowed_tags; 
    }
endif;
if ( ! function_exists( 'buzzblogpro_custom_wp_trim_excerpt' ) ) : 

    function buzzblogpro_custom_wp_trim_excerpt($buzzblogpro_excerpt) {
    $raw_excerpt = $buzzblogpro_excerpt;
        if ( '' == $buzzblogpro_excerpt ) {

            $buzzblogpro_excerpt = get_the_content('');
            $buzzblogpro_excerpt = apply_filters('the_content', $buzzblogpro_excerpt);
            $buzzblogpro_excerpt = str_replace(']]>', ']]&gt;', $buzzblogpro_excerpt);
            $buzzblogpro_excerpt = strip_tags($buzzblogpro_excerpt, buzzblogpro_allowedtags()); 

			$blog_excerpt = buzzblogpro_getVariable( 'blog_excerpt_count' );
			
                $excerpt_word_count = $blog_excerpt;
                $excerpt_length = apply_filters('excerpt_length', intval($excerpt_word_count)); 
                $tokens = array();
                $excerptOutput = '';
                $count = 0;

                preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $buzzblogpro_excerpt, $tokens);

                foreach ($tokens[0] as $token) { 

                    if ($count >= $excerpt_length) { 
                        $excerptOutput .= trim($token);
                        break;
                    }

                    $count++;

                    $excerptOutput .= $token;
                }
            if(buzzblogpro_getVariable( 'blog_excerpt_allowed_tags' ) == '') {
			remove_filter( 'the_excerpt', 'wpautop' );
			$buzzblogpro_excerpt = '<p>'.$excerptOutput.' ...</p>';
			}else{
            $buzzblogpro_excerpt = trim(force_balance_tags($excerptOutput.' ...'));
}
            return $buzzblogpro_excerpt;   

        }
        return apply_filters('buzzblogpro_custom_wp_trim_excerpt', $buzzblogpro_excerpt, $raw_excerpt);
    }

endif; 

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'buzzblogpro_custom_wp_trim_excerpt'); 

function buzzblogpro_string_limit_char($hs_excerpt, $hs_substr=0)
{
$hs_excerpt = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $hs_excerpt);
	$hs_string = strip_tags(str_replace('...', '...', $hs_excerpt));
	if ($hs_substr>0) {
		$hs_string = substr($hs_string, 0, $hs_substr);
	}
	return $hs_string;
		}

function buzzblogpro_limit_text($content = false, $length) {
 
if($content == false)
return false;
 
$content = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $content);
$content = strip_tags($content);
$excerpt_length = $length;
$words = explode(' ', $content, $excerpt_length + 1);
 
if(count($words) > $excerpt_length) :
array_pop($words);
array_push($words, '...', '');
endif;
$content = implode(' ', $words);
$content = '<p>' . esc_html($content) . '</p>';
 
return $content;
}
if(!function_exists('buzzblogpro_next_page')) {
  function buzzblogpro_next_page($max_num_pages = 0) {
$paged_get = 'paged';
		if( is_front_page() && ! is_home() ):
			$paged_get = 'page';
		endif;
    if ($max_num_pages === false) { 
      global $wp_query;
      $max_num_pages = $wp_query->max_num_pages;
    }

    if ($max_num_pages > max(1, get_query_var($paged_get))) {

      return get_pagenum_link(max(1, get_query_var($paged_get)) + 1);
    }
    return false;
  }
}

function buzzblogpro_remove_invalid_tags($hs_str, $tags) 
{
    foreach($tags as $tag)
    {
    	$hs_str = preg_replace('#^<\/'.$tag.'>|<'.$tag.'>$#', '', trim($hs_str));
    }

    return $hs_str;
}

function buzzblogpro_gener_random($length){

	srand((double)microtime()*1000000 );
	
	$hs_random_id = "";
	
	$char_list = "abcdefghijklmnopqrstuvwxyz";
	
	for($i = 0; $i < $length; $i++) {
		$hs_random_id .= substr($char_list,(rand()%(strlen($char_list))), 1);
	}
	
	return $hs_random_id;
}


if ( !function_exists('buzzblogpro_fb_AddThumbColumn') && function_exists('add_theme_support') ) {

	add_theme_support('post-thumbnails', array( 'post', 'page' ) );
	function buzzblogpro_fb_AddThumbColumn($cols) {
	$cols['thumbnail'] = esc_html__('Thumbnail', 'buzzblogpro');
	return $cols;
}
function buzzblogpro_fb_AddThumbValue($column_name, $post_id) {
	$hs_width = (int) 55;
	$hs_height = (int) 55;
	if ( 'thumbnail' == $column_name ) {
		
		$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
	
		$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
		if ($thumbnail_id)
			$thumb = wp_get_attachment_image( $thumbnail_id, array($hs_width, $hs_height), true, array( "style" => "width:55px;height:auto;" ) );
		elseif ($attachments) {
			foreach ( $attachments as $attachment_id => $attachment ) {
				$thumb = wp_get_attachment_image( $attachment_id, array($hs_width, $hs_height), true, array( "style" => "width:55px;height:auto;" ) );
			}
		}
		if ( isset($thumb) && $thumb ) {
			print $thumb;
		} else {
			echo esc_html__('None', 'buzzblogpro');
		}
	}
}
// for posts
add_filter( 'manage_posts_columns', 'buzzblogpro_fb_AddThumbColumn' );
add_action( 'manage_posts_custom_column', 'buzzblogpro_fb_AddThumbValue', 10, 2 );
// for pages
add_filter( 'manage_pages_columns', 'buzzblogpro_fb_AddThumbColumn' );
add_action( 'manage_pages_custom_column', 'buzzblogpro_fb_AddThumbValue', 10, 2 );
}


/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'buzzblogpro_hs_pagination' ) ) {
	function buzzblogpro_hs_pagination( $pages = '', $range = 1 ) {
		$showitems = ($range * 2) + 1;

		global $wp_query;
			 global $paged;
		if ( get_query_var('paged') ) {
     $paged = get_query_var('paged'); 
     }
    elseif ( get_query_var('page') ) { 
	
    $paged = get_query_var('page'); 
    }
    else { $paged = 1; }

		if ( $pages == '' ) {
			$pages = $wp_query->max_num_pages;
			if( !$pages ) {
				$pages = 1;
			}
		}
		if ( 1 != $pages ) {
			echo "<nav class=\"navigation pagination\" role=\"navigation\"><div class=\"nav-links\"><ul class=\"page-numbers\">";
			if ( $paged > 1 ) echo "<li class='first'><a href='".get_pagenum_link(1)."'>".theme_locals("first")."</a></li>";
			if ( $paged > 1 ) echo "<li class='prev'><a href='".get_pagenum_link($paged - 1)."'>".theme_locals("prev")."</a></li>";

			for ( $i = 1; $i <= $pages; $i++ ) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					echo ($paged == $i)? "<li ><span class=\"current\">".intval($i)."</span></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".intval($i)."</a></li>";
				}
			}

			if ( $paged < $pages ) echo "<li class='next'><a href=\"".get_pagenum_link($paged + 1)."\">".theme_locals("next")."</a></li>"; 
			if ( $paged < $pages ) echo "<li class='last'><a href='".get_pagenum_link($pages)."'>".theme_locals("last")."</a></li>";
			echo "</ul></div></nav>\n";
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/* Custom Comments Structure
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'buzzblogpro_comment' ) ) {
	function buzzblogpro_comment($comment, $args, $depth) {
	     $GLOBALS['comment'] = $comment;
		 extract( $args, EXTR_SKIP );
$GLOBALS['depth'] = $depth;
?>
	   <li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">

	     	<div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
			<?php edit_comment_link(esc_html__('Edit', 'buzzblogpro')); ?>
	      		<div class="wrapper">

	  		      	<?php if ($comment->comment_approved == '0') : ?>
	  		        	<em><?php echo theme_locals("your_comment") ?></em>
	  		      	<?php endif; ?>	      	
	  		     	<div class="extra-wrap">
					
					<div class="comment-author vcard">
	  	         		<?php echo get_avatar( $comment->comment_author_email, $args['avatar_size'] ); ?>
	  	      		
					<?php printf(wp_kses_post('<h6 class="author">%1$s</h6>'), get_comment_author_link()); ?>
					<?php printf(wp_kses_post('<span class="date">%1$s</span>'), get_comment_date($args['comment_date'])); ?>
					<div class="clear"></div>
					</div>
	  		     		<?php comment_text() ?>	     	
	  		     	</div>
	  		    </div>
		     	<div class="wrapper">
				  	<div class="reply">
						
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => theme_locals("reply"), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				   	</div>
			 	</div>
	    	</div>
	<?php 
	}
}
if ( !function_exists( 'buzzblogpro_pings' ) ) {
function buzzblogpro_pings( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );
	?>
	<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID(); ?>">
		<div class="ping-body" id="div-ping-<?php comment_ID(); ?>">

			<div class="ping-author vcard">
				<div class="ping-meta-wrapper">
					<div class="ping-meta">
						<?php 
						printf( wp_kses_post( '<h6 class="fn">%1$s %2$s</h6>'), get_comment_author_link(), edit_comment_link(esc_html__('Edit', 'buzzblogpro')) );
						printf( wp_kses_post( '<span class="date">%1$s</span>'), get_comment_date($args['comment_date']) );
						?>
					</div><!-- .ping-meta -->
				</div><!-- .ping-meta-wrapper -->
			</div><!-- .ping-author -->

			<div class="ping-text">
				<?php 
				
				comment_text(); ?>
			</div><!-- .ping-text -->

		</div><!-- .ping-body -->
	
	<?php
} 
}

/**
 * Edit link
 */

if ( ! function_exists( 'buzzblogpro_post_editlink' ) ) {
  function buzzblogpro_post_editlink() {
      echo edit_post_link( esc_html__( 'EDIT THIS POST', 'buzzblogpro' ), '<span class="edit-link">', '</span>' );
  }
}
/**
 * Post Category
 */

if ( ! function_exists( 'buzzblogpro_post_category' ) ) {
  function buzzblogpro_post_category( $post_id = '', $separator = ', ' ) {
  $categories = get_the_category();
    if (buzzblogpro_getVariable('post_category') != 'no') {
	echo '<div class="meta-space-top post_category">';
	
	foreach ($categories as $category){
	$style = '';
	$withbg = '';
	$category_color = get_term_meta( $category->cat_ID, '_buzzblogpro_category_color', true ) ? 'color:'.get_term_meta( $category->cat_ID, '_buzzblogpro_category_color', true ).';' : '';
	$category_bg_color = get_term_meta( $category->cat_ID, '_buzzblogpro_category_bg_color', true ) ? 'background-color:'.get_term_meta( $category->cat_ID, '_buzzblogpro_category_bg_color', true ).';' : '';
	
	if($category_color or $category_bg_color) {
	$style = 'style="'.$category_color.''.$category_bg_color.'"';
	}
	
	if($category_bg_color) {
	$withbg = 'cat-withbg';
	}
	
echo '<a class="'.$withbg.' category-style-' . $category->slug . '" href="' . get_category_link($category->term_id) . '" '.$style.'>' . $category->cat_name . '</a>';
}

	  echo '</div>';
    }
  }
}

/**
 * Post Reading Time
 */

if ( ! function_exists( 'buzzblogpro_post_reading_time' ) ) {
  function buzzblogpro_post_reading_time($tag = 'span', $compact = false) {
    if ( buzzblogpro_getVariable('reading_time') != 'no') {
      $post_content = get_post_field('post_content', get_the_ID());
      $strip_shortcodes = strip_shortcodes($post_content);
      $strip_tags = strip_tags($strip_shortcodes);
      $word_count = str_word_count($strip_tags);
      $reading_time = ceil($word_count / 250); ?>
      <<?php echo esc_attr($tag); ?> class="meta-reading-time">
        <?php if ( $compact == true ) { ?><i class="fa fa-clock-o"></i><?php } ?>
        <?php echo esc_attr($reading_time);?>
        <?php if ($compact == false ) { ?><?php echo theme_locals("min_read"); ?><?php } ?>
      </<?php echo esc_attr($tag); ?>>
    <?php }
  }
}
/**
 * Post Views 
 */

if ( ! function_exists( 'buzzblogpro_post_views' ) ) {
  function buzzblogpro_post_views($tag = 'span', $compact = false) {
    if ( buzzblogpro_getVariable('post_views') != 'no') { ?>
      <<?php echo esc_attr($tag); ?> class="meta-views">
        <?php if ( $compact == true ) { ?><i class="fa fa-eye"></i><?php } ?>
        <?php $postviews = intval( get_post_meta( get_the_ID(), 'buzzblogpro_post_views_count', true ) ); ?>
        <?php echo esc_attr($postviews); ?>
        <?php if ( $compact == false ) { ?> <?php echo theme_locals("views"); ?><?php } ?>
      </<?php echo esc_attr($tag); ?>>
    <?php }
  }
}
/**
 * Post Author
 */

if ( ! function_exists( 'buzzblogpro_post_author' ) ) {
  function buzzblogpro_post_author($tag = 'span', $compact = false) {
    if (buzzblogpro_getVariable('post_author') != 'no') { ?>
      <<?php echo esc_attr($tag); ?> class="vcard author <?php get_the_author(); ?>">	
		<?php if ( $compact == false ) {echo get_avatar( get_the_author_meta('email'), '14' );} ?>
		<?php echo theme_locals("text_before_author"); ?>
		<em class="fn"><?php the_author_posts_link(); ?></em>
      </<?php echo esc_attr($tag); ?>> 
    <?php }
  }
}
/**
 * Post Author Bottom Meta
 */

if ( ! function_exists( 'buzzblogpro_post_author_bottom' ) ) {
  function buzzblogpro_post_author_bottom($tag = 'span', $compact = false) {
    if (buzzblogpro_getVariable('post_author_share') != 'no') { ?>
      <<?php echo esc_attr($tag); ?> class="vcard author <?php get_the_author(); ?>">	
		<?php if ( $compact == false ) {echo get_avatar( get_the_author_meta('email'), '14' );} ?>
		<?php echo theme_locals("text_before_author"); ?>
		<em class="fn"><?php the_author_posts_link(); ?></em>
      </<?php echo esc_attr($tag); ?>> 
    <?php }
  }
}

/**
 * Location
 */

if ( ! function_exists( 'buzzblogpro_post_location' ) ) {
  function buzzblogpro_post_location() {
if (buzzblogpro_getVariable('locations') != 'no') {
  global $post;
$terms = get_the_terms( $post->ID, 'location' );
if ( ! empty( $terms ) ) { ?>
<span>
<?php the_terms( $post->ID, 'location', '<i class="fa fa-map-marker" aria-hidden="true"></i> '.theme_locals('location').' ', ', ', ' ' ); ?>
</span>
<?php }
}
}
}

/**
 * Post Comments
 */
if ( ! function_exists( 'buzzblogpro_post_comments' ) ) {
  function buzzblogpro_post_comments($tag = 'span', $compact = false ) {
    if (buzzblogpro_getVariable('post_comment') != 'no' && comments_open()) { ?>
      <<?php echo esc_attr($tag); ?> class="post-comments">
<i class="fa fa-comment-o"></i> <?php comments_popup_link(theme_locals('no_comments'), theme_locals('comment'), theme_locals('comments'), theme_locals('comments_link'), theme_locals('comments_closed')); ?>
      </<?php echo esc_attr($tag); ?>>
    <?php }
  }
}

/**
 * Post Comments Bottom
 */
if ( ! function_exists( 'buzzblogpro_post_comments_bottom' ) ) {
  function buzzblogpro_post_comments_bottom($tag = 'span', $compact = false ) {
    if (buzzblogpro_getVariable('post_comments_share') != 'no' && comments_open()) { ?>
      <<?php echo esc_attr($tag); ?> class="post-comments">
<i class="fa fa-comment-o"></i> <?php comments_popup_link(theme_locals('no_comments'), theme_locals('comment'), theme_locals('comments'), theme_locals('comments_link'), theme_locals('comments_closed')); ?>
      </<?php echo esc_attr($tag); ?>>
    <?php }
  }
}

/**
 * Post Date
 */
if ( ! function_exists( 'buzzblogpro_post_date' ) ) :
function buzzblogpro_post_date($tag = '', $compact = false) {
if (buzzblogpro_getVariable('post_date')=='yes' or buzzblogpro_getVariable('post_date')=='') {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    $timeformat = buzzblogpro_getVariable('date_format') ? buzzblogpro_getVariable('date_format') : 'U';
	if ( get_the_time( $timeformat ) !== get_the_modified_time( $timeformat ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}
    $time_format = buzzblogpro_getVariable('date_format') ? buzzblogpro_getVariable('date_format') : '';
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date($time_format),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date($time_format)
	);
if ( $compact == false ) {
	printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		esc_html_x( 'Posted on', 'Used before publish date.', 'buzzblogpro' ),
		esc_url( get_permalink() ),
		$time_string
	);
	}else{
		printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span>%3$s</span>',
		esc_html_x( 'Posted on', 'Used before publish date.', 'buzzblogpro' ),
		esc_url( get_permalink() ),
		$time_string
	);
	}
	}
}
endif;
/**
 * Post Meta
 */

if ( ! function_exists( 'buzzblogpro_post_meta' ) ) {
  function buzzblogpro_post_meta( $meta, $compact = false, $class = '' ) {
    if ( !empty($meta) ) {
      echo '<div class=" '. $class .'">'; 
      foreach ( $meta as $meta_function ) {
        $meta_function = "buzzblogpro_post_$meta_function";
        $meta_function( 'span', $compact );
      }
      echo '</div>';
    }
  }
}
/**
 * buzzblogpro_is_subcategory()
 */

if ( ! function_exists( 'buzzblogpro_is_subcategory' ) ) {
  function buzzblogpro_is_subcategory( $cat_id = null ) {

    if ( !$cat_id ) {
      $cat_id = get_query_var( 'cat' );
    }

    if ( $cat_id ) {

      $cat = get_category( $cat_id );
      if ( $cat->category_parent > 0 ) {
        return true;
      }
    }

    return false;
  }
}
/**
 * The Category Title
 */

if ( ! function_exists( 'buzzblogpro_category_title' ) ) {
  function buzzblogpro_category_title() {
    if ( is_category() ) {
	$current = get_category( get_query_var('cat') );
        $current_id = $current->term_id;
      $count = count( get_categories( array('child_of' =>  $current_id) ) );
      if ( $count > 0 && !buzzblogpro_is_subcategory() ) {
         ?>
<div class="container"><div class="row">
                    <div class="col-md-12">
					<?php get_template_part('title'); ?>
				<?php	if ( buzzblogpro_getVariable('folio_filter') != 'none') { ?>
        <ul class="category-filter">
          <?php wp_list_categories(array('echo' => true, 'show_option_none' => '', 'hierarchical' => true, 'child_of' => $current_id, 'orderby'  => 'id', 'current_category' => $current_id, 'title_li' => '', 'order' => 'DESC' )); ?>
        </ul>
		<?php } ?>
</div></div></div>
      <?php } else { ?>
        <div class="container"><div class="row">
                    <div class="col-md-12">
<?php get_template_part('title'); ?></div></div></div>
     <?php }
    }
  }
}

//Time ago
function buzzblogpro_get_buzzblogpro_time_ago() {

	$diff = buzzblogpro_time_ago_difference( get_the_time('U') );

	if ( 15 * MINUTE_IN_SECONDS > $diff ) {
		$ago_string = esc_html__( 'Just posted', 'buzzblogpro' );

	} elseif ( $isYesterday = date('Ymd', get_the_time('U')) == date('Ymd', strtotime('yesterday')) ) {
		$ago_string = esc_html__( 'Posted yesterday', 'buzzblogpro' );
	
	} elseif ( $diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS ) {
		

			$ago_string = sprintf( esc_html__( 'Posted on %1$s', 'buzzblogpro' ),	esc_attr( get_the_time('l') )	);
		

	} else {
		$ago_string = sprintf( esc_html__( '%1$s ago', 'buzzblogpro' ), esc_attr( human_time_diff( get_the_time('U') ) )	);
	}

	$buzzblogpro_get_buzzblogpro_time_ago = '<time datetime="' . get_the_date( 'c' ) . '" title="' . get_the_date() . '" class="long-timestamp-ago">' . $ago_string . '</time>';

	return $buzzblogpro_get_buzzblogpro_time_ago.' '.theme_locals("text_before_author").' '.get_the_author();
}


/*
 *	Echo Timestamp
 */
function buzzblogpro_time_ago(){
	echo buzzblogpro_get_buzzblogpro_time_ago();
}

function buzzblogpro_time_ago_difference( $from, $to = '' ) {
	if ( empty( $to ) )
		$to = time();

	return $diff = (int) abs( $to - $from );
}

//fixed social networks
if ( ! function_exists( 'buzzblogpro_fixed_social_networks' ) && !buzzblogpro_is_touch()  ) { 
  function buzzblogpro_fixed_social_networks() {
if (buzzblogpro_getVariable('fixed_social_share')=='yes' && !is_singular( 'post' )) {
echo '<div class="social-side-fixed"><ul>';

if (buzzblogpro_getVariable('fixed_facebook_url')) { 
echo '<li><a target="_blank" class="social-side-link" href="'.buzzblogpro_getVariable('fixed_facebook_url').'"><i class="hs hs-facebook"></i></a></li>';
}
if (buzzblogpro_getVariable('fixed_twitter_url')) { 
echo '<li><a target="_blank" class="social-side-link" href="'.buzzblogpro_getVariable('fixed_twitter_url').'"><i class="hs hs-twitter"></i></a></li>';
}
if (buzzblogpro_getVariable('fixed_pinterest_url')) { 
echo '<li><a target="_blank" class="social-side-link" href="'.buzzblogpro_getVariable('fixed_pinterest_url').'"><i class="hs hs-pinterest"></i></a></li>';
}
if (buzzblogpro_getVariable('fixed_instagram_url')) { 
echo '<li><a target="_blank" class="social-side-link" href="'.buzzblogpro_getVariable('fixed_instagram_url').'"><i class="hs hs-instagram"></i></a></li>';
}
if (buzzblogpro_getVariable('fixed_bloglovin_url')) { 
echo '<li><a target="_blank" class="social-side-link" href="'.buzzblogpro_getVariable('fixed_bloglovin_url').'"><i class="fa fa-heart-o"></i></a></li>';
}
if (buzzblogpro_getVariable('fixed_youtube_url')) { 
echo '<li><a target="_blank" class="social-side-link" href="'.buzzblogpro_getVariable('fixed_youtube_url').'"><i class="fa fa-youtube"></i></a></li>';
}
if (buzzblogpro_getVariable('fixed_liketoknow_url')) { 
echo '<li><a target="_blank" class="social-side-link" href="'.buzzblogpro_getVariable('fixed_liketoknow_url').'"><i class="fa fa-envelope-open-o"></i></a></li>';
}
if (buzzblogpro_getVariable('fixed_rss_url')) { 
echo '<li><a target="_blank" class="social-side-link" href="'.buzzblogpro_getVariable('fixed_rss_url').'"><i class="hs hs-rss"></i></a></li>';
}
echo '</ul></div>';
}
 
 }
}

if( ! function_exists( 'buzzblogpro_is_woocommerce_active' ) ) {
	/**
	 * Checks if Woocommerce plugin is active and returns the proper value
	 */
	function buzzblogpro_is_woocommerce_active() {
		static $is_active = null;
		if(is_null($is_active)){
			$plugin = 'woocommerce/woocommerce.php';
			$network_active = false;
			if ( is_multisite() ) {
				$plugins = get_site_option( 'active_sitewide_plugins' );
			if ( isset( $plugins[$plugin] ) )
				$network_active = true;
			}
			$active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
			$is_active = in_array( $plugin, (array) $active_plugins ) || $network_active;
		}
		return $is_active;
	}
}

/**
 * Setup menu icon functionality
 */
add_action( 'init', 'buzzblogpro_setup_menu_icons' );
function buzzblogpro_setup_menu_icons() {
	if( is_admin() ) {
		add_filter( 'wp_edit_nav_menu_walker', 'buzzblogpro_custom_edit_nav_menu_walker' );
		add_action( 'wp_nav_menu_item_custom_fields', 'buzzblogpro_add_menu_icon_option', 12, 4 );
		add_action( 'wp_update_nav_menu_item', 'buzzblogpro_update_menu_icon_option', 10, 3 );
		add_action( 'delete_post', 'buzzblogpro_remove_menu_icon_meta', 1, 3 );
	} else {
		add_filter( 'wp_nav_menu_args', 'buzzblogpro_add_menu_item_title_filter' );
		add_filter( 'wp_nav_menu', 'buzzblogpro_remove_menu_item_title_filter' );
	}
}

/**
 * Start looking for menu icons
 */
function buzzblogpro_add_menu_item_title_filter( $args ) {
	add_filter( 'the_title', 'buzzblogpro_add_menu_icon', 10, 2 );
	return $args;
}

/**
 * The menu is rendered, we longer need to look for menu icons
 */
function buzzblogpro_remove_menu_item_title_filter( $nav_menu ) {
	remove_filter( 'the_title', 'buzzblogpro_add_menu_icon', 10, 2 );
	return $nav_menu;
}

/**
 * Setup custom walker for Nav_Menu_Edit
 */
function buzzblogpro_custom_edit_nav_menu_walker( $walker ) {
	if( ! class_exists( 'Buzzblogpro_Walker_Nav_Menu_Edit' ) ) {
		include_once get_template_directory() . '/includes/class-hercules-walker-menu-edit.php';
	}

	return 'Buzzblogpro_Walker_Nav_Menu_Edit';
}

/**
 * Save the icon meta for a menu item. Also removes the meta entirely if the field is cleared.
 */
function buzzblogpro_update_menu_icon_option( $menu_id, $menu_item_db_id, $args ) {
	if( isset( $_POST['menu-item-icon'] ) && isset( $_POST['menu-item-icon'][$menu_item_db_id] ) ) {
		$meta_key = '_menu_item_icon';
		$meta_value = buzzblogpro_get_menu_icon( $menu_item_db_id );
		$menu_item_icon =  $_POST['menu-item-icon'][$menu_item_db_id];
		$new_meta_value = sanitize_text_field( $menu_item_icon );

		if ( $new_meta_value && '' == $meta_value )
			add_post_meta( $menu_item_db_id, $meta_key, $new_meta_value, true );
		elseif ( $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $menu_item_db_id, $meta_key, $new_meta_value );
		elseif ( '' == $new_meta_value && $meta_value )
			delete_post_meta( $menu_item_db_id, $meta_key, $meta_value );
	}
}

/**
 * Clean up the icon meta field when a menu item is deleted
 */
function buzzblogpro_remove_menu_icon_meta( $post_id ) {
	if( is_nav_menu_item( $post_id ) ) {
		delete_post_meta( $post_id, '_menu_item_icon' );
	}
}

/**
 * Display the icon picker for menu items in the backend
 */
function buzzblogpro_add_menu_icon_option( $item_id, $item, $depth, $args ) {
	$saved_meta = buzzblogpro_get_menu_icon( $item_id );
?>
	<p class="field-icon description description-thin">
		<label for="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Enter Icon Code', 'buzzblogpro' ) ?><br/>
			<input type="text" name="menu-item-icon[<?php echo esc_attr( $item_id ); ?>]" id="edit-menu-item-icon-<?php echo esc_attr( $item_id ) ?>" size="8" class="edit-menu-item-icon buzzblogpro_field_icon" value="<?php echo esc_attr( $saved_meta ); ?>">
		</label>
	</p>
<?php }

/**
 * Returns the icon name chosen for a given menu item
 */
function buzzblogpro_get_menu_icon( $item_id ) {
	return get_post_meta( $item_id, '_menu_item_icon', true );
}

/**
 * Append icon to a menu item
 */
function buzzblogpro_add_menu_icon( $title, $id = '' ) {
	if ( '' != $id ) {
		if ( $icon = buzzblogpro_get_menu_icon( $id ) ) {
			$title = '<i class="fa ' . esc_attr( buzzblogpro_get_fa_icon_classname( $icon ) ) . '"></i> ' . $title;
		}
	}
	return $title;
}
function buzzblogpro_get_fa_icon_classname( $icon ) {
	if( ! ( substr( $icon, 0, 3 ) == 'fa-' ) ) {
		$icon = 'fa-' . $icon;
	}

	return $icon;
}


if(!function_exists('buzzblogpro_promo_areaslides')) {
function buzzblogpro_promo_areaslides() {
global $buzzblogpro_options;
if (isset($buzzblogpro_options['promo-areaslides']) && !empty($buzzblogpro_options['promo-areaslides'])) {
	
$number_of_posts = count($buzzblogpro_options['promo-areaslides']);
if($number_of_posts > 5) {$autoplay = 'true';}else{$autoplay = 'false';}
        $post_type = 'promo';
		$rtl_slide = '';
		$random_ID          = uniqid();
		$items_desktop   = 3;
		$items_tablet   = 3;
		$items_mobile   = 2;
		$margin   = $buzzblogpro_options['promotion_slideshow_margin_items'];
		$auto_play_timeout  = 5000;
		$display_navs       = 'false';
		$display_pagination = 'false';
		$img_width = buzzblogpro_getVariable('promo_image_width') ? buzzblogpro_getVariable('promo_image_width') : 270;
		$img_height = buzzblogpro_getVariable('promo_image_height') ? buzzblogpro_getVariable('promo_image_height') : 350;

echo '<div class="carousel-wrap slideshow promo">';
echo '<div id="owl-carousel-' . esc_attr($random_ID) . '" class="owl-carousel-' . esc_attr($post_type) . ' owl-carousel" data-center="false" data-howmany="' .esc_attr($number_of_posts). '" data-margin="' . esc_attr($margin) . '" data-items="' . esc_attr($items_desktop) . '" data-tablet="' . esc_attr($items_tablet) . '" data-mobile="' . esc_attr($items_mobile) . '"  data-auto-play="' . esc_attr($autoplay) . '" data-auto-play-timeout="' . esc_attr($auto_play_timeout) . '" data-nav="' . esc_attr($display_navs) . '" data-rtl="'.esc_attr($rtl_slide).'" data-pagination="' . esc_attr($display_pagination) . '">';
 
foreach($buzzblogpro_options['promo-areaslides'] as $slide) {
$img = aq_resize( $slide['image'], $img_width, $img_height, true, true, true ); 
				
echo '<div class="owl-slide cover">';
echo '<img class="lazyload" data-src="'.esc_url($img).'" width="'.esc_attr($img_width).'" height="'.esc_attr($img_height).'" alt="'.esc_attr($slide['title']).'" />';
echo '<div class="cover-wrapper"><div class="cover-content">';
echo '<h4>'.$slide['title'].'</h4>';

echo '</div></div><a href="'.esc_url($slide['url']).'" class="cover-link"></a>';
echo '</div>';
}
echo '</div></div>';
 } 
}
}


//link type post bg

function buzzblogpro_link_format_post_bg() {
global $post;
$thumb = get_post_thumbnail_id();
$img_url = wp_get_attachment_url( $thumb,'buzzblogpro-standard-large'); //get img URL
if($img_url){
echo 'style="background-image: url('.esc_url($img_url).');"';
}}
?>