<?php
/**
 *
 * HTML Shortcodes
 *
 */

// Frames
function frame_shortcode($atts, $content = null) {

    $output = '<figure class="thumbnail align' . $atts['align'] . ' clearfix">';
        $output .= do_shortcode($content);
    $output .= '</figure>';

    return $output;
}
add_shortcode('frame', 'frame_shortcode');

// Button
function button_shortcode($atts, $content = null) {
	extract(shortcode_atts(
        array(
            'link' => 'http://www.google.com',
            'text' => 'Button Text',
			'size' => 'normal',
			'style' => 'default',
			'target' => '_self',
            'display' => '',
            'class' => '',
            'icon' => 'no'
    ), $atts));
    
    $output =  '<a href="'.$link.'" title="'.$text.'" class="btn btn-'.$style.' btn-'.$size.' btn-'.$display.' '.$class.'" target="'.$target.'">';
    if ($icon != 'no') {
        $output .= '<i class="'.$icon.'"></i> ';
    }    
	$output .= $text;
	$output .= '</a>';

    return $output;
}
add_shortcode('button', 'button_shortcode');


// Dropcaps
function dropcap_shortcode($atts, $content = null) {
extract(shortcode_atts(
	        array(
					'custom_class' => ''
	    ), $atts));
    $output = '<p class="dropcap '. $custom_class .'">';
    $output .= do_shortcode($content);
    $output .= '</p>';

    return $output;
}
add_shortcode('dropcap', 'dropcap_shortcode');

// Big letter
function bigletter_shortcode($atts, $content = null) {
extract(shortcode_atts(
	        array(
					'custom_class' => ''
	    ), $atts));
    $firstCharacter = buzzblogpro_string_limit_char($content,1);
    $output = '<div class="bigletter '. $custom_class .'" data-first_letter="'.esc_attr($firstCharacter).'">';
    $output .= do_shortcode($content);
    $output .= '</div>';

    return $output;
}


add_shortcode('bigletter', 'bigletter_shortcode');

// Horizontal Rule
function hr_shortcode($atts, $content = null) {

    $output = '<div class="hr"></div>';

    return $output;
}
add_shortcode('hr', 'hr_shortcode');

// Intro text
function intro_shortcode($atts, $content = null) {

    $output = '<p class="intro">';
	$output .= do_shortcode($content);
    $output .= '</p>';

    return $output;
}
add_shortcode('intro', 'intro_shortcode');
// underline links
function underline_shortcode($atts, $content = null) {

    $output = '<span class="body-link">';
	$output .= do_shortcode($content);
    $output .= '</span>';

    return $output;
}
add_shortcode('underline', 'underline_shortcode');

// Small Horizontal Rule
function sm_hr_shortcode($atts, $content = null) {

    $output = '<div class="sm_hr"></div>';

    return $output;
}
add_shortcode('sm_hr', 'sm_hr_shortcode');


// Spacer
function spacer_shortcode($atts, $content = null) {

    $output = '<div class="spacer"></div>';

    return $output;
}
add_shortcode('spacer', 'spacer_shortcode');
// Spacer-small
function spacer_small_shortcode($atts, $content = null) {

    $output = '<div class="spacer-small"></div>';

    return $output;
}
add_shortcode('spacer-small', 'spacer_small_shortcode');

// Blockquote
function blockquote_shortcode($atts, $content = null) {
extract(shortcode_atts(
	        array(
					'custom_class' => '',
					'txt_color' => '',
					'size' => '',
					'line_height' => '',
	    ), $atts));
    
    $output = '<blockquote><p class="'. $custom_class .'" style="color: '.$txt_color.'; font-size: '.$size.'px; line-height: '.$line_height.'px;">';
    $output .= do_shortcode($content);
    $output .= '</p></blockquote>';

    return $output;
}
add_shortcode('blockquote', 'blockquote_shortcode');

/* Pullquote shortcode */

	function pullquote_shortcode( $atts, $content = false ) {
		extract( shortcode_atts(  array( 'align' => 'left', 'style' => 'default', 'width' => 300, 'size' => 24, 'line_height' => 26, 'bg_color' => '#000000', 'txt_color' => '#ffffff' ), $atts ) );
		$output = '<div class="buzzblogpro_pullquote buzzblogpro_pullquote_'.$align.' '.$style.'" style="width:'.absint( $width ).'px; font-size: '.$size.'px; line-height: '.$line_height.'px; color: '.$txt_color.'; background-color:'.$bg_color.';">' . do_shortcode( $content ) . '</div>';
		return $output;
		}
add_shortcode('pullquote', 'pullquote_shortcode');

// Fullwidthimage

function fullwidthimage_shortcode($atts, $content=null) {
	extract(shortcode_atts(
        array(
				'photourl' => ''				
    ), $atts));
	
$output = '<div class="post-thumb clearfix">
    <figure class="featured-thumbnail thumbnail large">
        <a class="image-wrap image-popup-no-margins"  href="'.$photourl.'" data-rel="Photo">
            <img src="'.$photourl.'" alt="photo" />
            <span class="zoom-icon"></span>
        </a>
    </figure>
    <div class="clear"></div>
</div>';

	return $output;
}
add_shortcode('fullwidthimage', 'fullwidthimage_shortcode');


// Clear
function clear_shortcode($atts, $content = null) {

    $output = '<div class="clear"></div>';

    return $output;
}
add_shortcode('clear', 'clear_shortcode');


// Address
function address_shortcode($atts, $content = null) {
	
	$output = '<address>';
	$output .= do_shortcode($content);
	$output .= '</address>';
   
	return $output;
}
add_shortcode('address', 'address_shortcode');


// Lists

// Unstyled
function list_un_shortcode($atts, $content = null) {
    $output = '<div class="list unstyled">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('list_un', 'list_un_shortcode');

// Check List
function check_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled check-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('check_list', 'check_list_shortcode');

// Check2 List
function check2_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled check2-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('check2_list', 'check2_list_shortcode');

// Arrow List
function arrow_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled arrow-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('arrow_list', 'arrow_list_shortcode');

// Arrow2 List
function arrow2_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled arrow2-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('arrow2_list', 'arrow2_list_shortcode');

// Circle List
function circle_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled circle-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('circle_list', 'circle_list_shortcode');

// Plus List
function plus_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled plus-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('plus_list', 'plus_list_shortcode');

// Minus List
function minus_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled minus-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('minus_list', 'minus_list_shortcode');

// Custom List
function custom_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled custom-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('custom_list', 'custom_list_shortcode');


// Vertical Rule
function vr_shortcode($atts, $content = null) {
	
	$output = '<div class="vertical-divider">';
	$output .= do_shortcode($content);
	$output .= '</div>';
   
	return $output;
}
add_shortcode('vr', 'vr_shortcode');


// Label
function label_shortcode($atts, $content = null) {

    extract(shortcode_atts(
        array(
            'style' => '',
            'icon' => ''
    ), $atts));

    $output = '<span class="label label-'.$style.'">';
    if ($icon != "") {
        $output .= '<i class="'.$icon.'"></i>';
    }
    $output .= $content .'</span>';

    return $output;
}
add_shortcode('label', 'label_shortcode');


// Text Highlight
function highlight_shortcode($atts, $content = null) {

    $output = '<span class="text-highlight">';
    $output .= do_shortcode($content);
    $output .= '</span>';

    return $output;
}
add_shortcode('highlight', 'highlight_shortcode');


// Icon
function icon_shortcode($atts, $content = null) {

    extract(shortcode_atts(
        array(
            'icons' => '',
            'align' => '',
			'size' => '',
			'color' => ''
    ), $atts));

    if ($icons != '') {
        $output = '<i style="color:'. $color .'" class="'. $icons .' align'. $align .' '. $size .'"></i>';
        return $output;
    }    
}
add_shortcode('icon', 'icon_shortcode');

// Template URL
function template_url_shortcode($atts, $content = null) {

    $template_url = home_url();
    return $template_url;
}
add_shortcode('template_url', 'template_url_shortcode');

// Extra Wrap
function extra_wrap_shortcode($atts, $content = null) {

    $output = '<div class="extra-wrap">';
        $output .= do_shortcode($content);
    $output .= '</div>';

    return $output;
}
add_shortcode('extra_wrap', 'extra_wrap_shortcode');
?>