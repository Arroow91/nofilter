<?php
/**
 * Progressbar
 *
 */
if (!function_exists('shortcode_progressbar')) {

	function shortcode_progressbar($atts, $content = null) {
		extract(shortcode_atts(
	        array(
					'value' => '50',
					'label' => '',
					'points' => '',
					'custom_class' => ''
	    ), $atts));
		if($points) {$values = $points; }else{$values = $value; }
$output = '<div class="bars"><div class="progress-heading"><div class="progress-label">'.$label.'</div><div class="progress-value">'.$values.'</div></div>';
		$output .= '<div id="max'.$value.'" class="progress active '.$custom_class.'">';
		$output .= '<div class="bar" data-progress="'.$value.'" ></div>';
		$output .= '</div>';
$output .= '</div><div class="clearfix"></div>';
	    return $output;

	}
	add_shortcode('progressbar', 'shortcode_progressbar');

}?>