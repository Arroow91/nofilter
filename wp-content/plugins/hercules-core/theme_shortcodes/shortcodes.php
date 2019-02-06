<?php
// justifiedgall shortcode
if (!function_exists('justifiedgall_shortcode')) {
add_shortcode('hercules-gallery', 'justifiedgall_shortcode');
function justifiedgall_shortcode( $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {

		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	$output = apply_filters( 'post_justifiedgall', '', $attr, $instance );
	if ( $output != '' ) {
		return $output;
	}

	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'size'       => 'buzzblogpro-standard-post',
		'include'    => '',
		'captions'    => 'true',
		'opengallerylink'    => 'true',
		'opengallerytext'    => 'Open gallery',
		'backtostory'    => 'Back to story',
		'pinit'    => 'true',
		'lastrow'    => 'justify',
		'visibleitems'    => 0, 
		'rowheight'    => '129',
		'thumbwidth'    => '220',
		'thumbheight'    => '200',
		'margins'    => '20',
		'randomize'    => 'false'
	), $attr, 'justifiedgall' );

	$id = intval( $atts['id'] ); 

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	$selector = "justifiedgall_{$instance}";


	$size_class = sanitize_html_class( $atts['size'] );
	$justifiedgall_div = "<div id='$selector' class='justifiedgall justifiedgallid-{$id} justifiedgall-size-{$size_class}' data-selector='$selector' data-lastrow='{$atts['lastrow']}' data-captions='{$atts['captions']}' data-pinit='{$atts['pinit']}' data-rowheight='{$atts['rowheight']}' data-margins='{$atts['margins']}' data-randomize='{$atts['randomize']}' data-backtostory='{$atts['backtostory']}' >";

	$output = $justifiedgall_div;

	$i = 1;
	$numItemsbefore = count($attachments);
	
	//$attachmentsless = array_combine(array_slice(array_keys($attachments), 0, 3), array_slice($attachments, 0, 3));
	//$numItems = count($attachmentsless);
	$visibleitems = intval( $atts['visibleitems']);
	$howmany = $numItemsbefore - $visibleitems;
	
	foreach ( $attachments as $id => $attachment ) {

		
		$attr = array( 'alt' => $attachment->post_title, 'data-title' => $attachment->post_title, 'data-excerpt' => $attachment->post_excerpt, 'data-excerpt' => $attachment->post_content );
		$image_output = wp_get_attachment_link( $id, array($atts['thumbwidth'],$atts['thumbheight']), false, false, false, $attr );
		
		 if(0 === $visibleitems ) {
		  $output .= '<div class="jg-entry">'.$image_output.'</div>';
		  }else{
 if($i === $visibleitems ) {
   $output .= '<div class="gallery-lastelement-link">'.$image_output.'<h3 class="gallery-lastelement">+'.$howmany.'</h3></div>';
  }elseif($i > $visibleitems) {
  $output .= '<div class="jg-entry hiddenimages spinner">'.$image_output.'</div>';
  }else {
  $output .= '<div class="jg-entry">'.$image_output.'</div>';
  }
  }
++$i;
	}

 
	$output .= "
		</div>\n";
		if($atts['opengallerylink'] == 'true') {
$output .= '<a class="opengallery-link '.$selector.' justify-'.$atts['lastrow'].'" href="#gallery"><span>'.$atts['opengallerytext'].'</span></a>';
}
	return $output;
}
}
// Recent Comments
if (!function_exists('shortcode_recentcomments')) {

	function shortcode_recentcomments($atts, $content = null) {
	    extract(shortcode_atts(array(
	        'num' => '5',
			'custom_class' => ''
	    ), $atts));

	    global $wpdb;
	    $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
	    comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
	    comment_type,comment_author_url,
	    SUBSTRING(comment_content,1,50) AS com_excerpt
	    FROM $wpdb->comments
	    LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
	    $wpdb->posts.ID)
	    WHERE comment_approved = '1' AND comment_type = '' AND
	    post_password = ''
	    ORDER BY comment_date_gmt DESC LIMIT $num";

	    $comments = $wpdb->get_results($sql);

	    $output = '<ul class="recent-comments unstyled">';

	    foreach ($comments as $comment) {

	        $output .= '<li>';
	            $output .= '<a href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'" title="on '.$comment->post_title.'">';
	                 $output .= strip_tags($comment->comment_author).' : '.strip_tags($comment->com_excerpt).'...';
	            $output .= '</a>';
	        $output .= '</li>';

	    }

	    $output .= '</ul>';
	    return $output;
	}
	add_shortcode('recentcomments', 'shortcode_recentcomments');

}
	
	
//Tag Cloud
if (!function_exists('shortcode_tags')) {

	function shortcode_tags($atts, $content = null) {
		$output = '<div class="tags-cloud clearfix">';
		$tags = wp_tag_cloud('smallest=8&largest=8&format=array');

		foreach($tags as $tag){
				$output .= $tag.' ';
		}

		$output .= '</div><!-- .tags-cloud (end) -->';
		return $output;
	}
	add_shortcode('tags', 'shortcode_tags');

}
// Video Player
if (!function_exists('shortcode_video')) {

	function shortcode_video($atts, $content = null) {
wp_enqueue_script('buzzblogpro-swfobject');
wp_enqueue_script('buzzblogpro-playlist');
wp_enqueue_script('buzzblogpro-jplayer');
	    extract(shortcode_atts(array(
	        'file' => '',
	        'm4v' => '',
	        'ogv' => '',
	    ), $atts));

	    $template_url = get_template_directory_uri();
	    $id = rand();

	    $video_url = $file;
	    $m4v_url = $m4v;
	    $ogv_url = $ogv;

	    // get site URL
		$home_url = home_url();

		$pos1 = strpos($m4v_url, 'wp-content');
		$m4v_new = substr($m4v_url, $pos1, strlen($m4v_url) - $pos1);
		$file1 = $home_url.'/'.$m4v_new;

		$pos2 = strpos($ogv_url, 'wp-content');
		$ogv_new = substr($ogv_url, $pos2, strlen($ogv_url) - $pos2);
		$file2 = $home_url.'/'.$ogv_new;

	    //Check for video format
	    $vimeo = strpos($video_url, "vimeo");
	    $youtube = strpos($video_url, "youtu");

	    $output = '<div class="embed-responsive embed-responsive-16by9">';

	    //Display video
	    if ($file) {
	    	if($vimeo !== false){

	        //Get ID from video url
	        $video_id = str_replace( 'http://vimeo.com/', '', $video_url );
	        $video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );

	        //Display Vimeo video
	        $output .= '<iframe class="embed-responsive-item" src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0"></iframe>';

	    	} elseif($youtube !== false){

	        //Get ID from video url
	    	$video_id = str_replace( 'http://', '', $video_url );
	    	$video_id = str_replace( 'https://', '', $video_id );
	        $video_id = str_replace( 'www.youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtu.be/', '', $video_id );
	        $video_id = str_replace( '&feature=channel', '', $video_id );

	        $output .= '<iframe title="YouTube video player" class="embed-responsive-item youtube-player" src="http://www.youtube.com/embed/'.$video_id.'?wmode=opaque"></iframe>';

	    	}
	    } else {

	        $output .= '<script type="text/javascript">
						jQuery(document).ready(function(){
							if(jQuery().jPlayer) {
								jQuery("#jquery_jplayer_'. $id .'").jPlayer( {
									ready: function () {
										jQuery(this).jPlayer("setMedia", {
											m4v: "'. $file1 .'",
											ogv: "'. $file2 .'"
										});
									},
									play: function() {
										jQuery(this).jPlayer("pauseOthers");
									},
									swfPath: "'. $template_url .'/flash",
									wmode: "window",
									cssSelectorAncestor: "#jp_container_'. $id .'",
									solution: "html, flash",
									supplied: "m4v, ogv",
									size: {width: "100%", height: "100%"}
								});
							}
						});
					</script>';
			$output .= '<div id="jp_container_'. $id .'" class="jp-video fullwidth">';
			$output .= '<div class="jp-type-single">';
			$output .= '<div id="jquery_jplayer_'. $id .'" class="jp-jplayer"></div>';
			$output .= '<div class="jp-gui">';
			$output .= '<div class="jp-video-play">';
			$output .= '<a href="javascript:;" class="jp-video-play-icon" tabindex="1" title="Play">Play</a></div>';
			$output .= '<div class="jp-interface">';
			$output .= '<div class="jp-progress">';
			$output .= '<div class="jp-seek-bar">';
			$output .= '<div class="jp-play-bar">';
			$output .= '</div></div></div>';
			$output .= '<div class="jp-duration"></div>';
			$output .= '<div class="jp-time-sep">/</div>';
			$output .= '<div class="jp-current-time"></div>';
			$output .= '<div class="jp-controls-holder">';
			$output .= '<ul class="jp-controls">';
			$output .= '<li><a href="javascript:;" class="jp-play" tabindex="1" title="Play"><span>Play</span></a></li>';
			$output .= '<li><a href="javascript:;" class="jp-pause" tabindex="1" title="Pause"><span>Pause</span></a></li>';
			$output .= '<li class="li-jp-stop"><a href="javascript:;" class="jp-stop" tabindex="1" title="Stop"><span>Stop</span></a></li>';
			$output .= '</ul>';
			$output .= '<div class="jp-volume-bar">';
			$output .= '<div class="jp-volume-bar-value">';
			$output .= '</div></div>';
			$output .= '<ul class="jp-toggles">';
			$output .= '<li><a href="javascript:;" class="jp-mute" tabindex="1" title="Mute"><span>Mute</span></a></li>';
			$output .= '<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="Unmute"><span>Unmute</span></a></li>';
			$output .= '</ul>';
			$output .= '<div class="jp-title">';
			$output .= '<ul><li>'. $title .'</li></ul>';
			$output .= '</div></div></div>';
			$output .= '<div class="jp-no-solution">';
			$output .= '<span>Update Required</span>';
			$output .= 'To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.';
			$output .= '</div></div></div></div>'; 

	    }
	    $output .= '</div><!-- .video-wrap (end) -->';
	    return $output;
	}
	add_shortcode('videos', 'shortcode_video');

}
?>