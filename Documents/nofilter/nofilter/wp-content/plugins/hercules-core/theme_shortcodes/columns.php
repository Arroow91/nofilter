<?php
// Grid Columns
function grid_column($atts, $content=null, $shortcodename ="")
{		
	//remove wrong nested <p>
	$content = buzzblogpro_remove_invalid_tags($content, array('p'));

	// add divs to the content
	$return = '<div class="'.$shortcodename.'">';
	$return .= do_shortcode($content);
	$return .= '</div>';

	return $return;
}
add_shortcode('col-md-1', 'grid_column');
add_shortcode('col-md-2', 'grid_column');
add_shortcode('col-md-3', 'grid_column');
add_shortcode('col-md-4', 'grid_column');
add_shortcode('col-md-5', 'grid_column');
add_shortcode('col-md-6', 'grid_column');
add_shortcode('col-md-7', 'grid_column');
add_shortcode('col-md-8', 'grid_column');
add_shortcode('col-md-9', 'grid_column');
add_shortcode('col-md-10', 'grid_column');
add_shortcode('col-md-11', 'grid_column');
add_shortcode('col-md-12', 'grid_column');

// Row
function row_shortcode($atts, $content=null) {
extract(shortcode_atts(
	        array(
					'custom_class' => ''
	    ), $atts));
	// add divs to the content	
	$output = '<div class="row '. $custom_class .'">';
	$output .= do_shortcode($content);
	$output .= '</div>';
   
	return $output;
}
add_shortcode('row-b', 'row_shortcode');

// Container
function container_shortcode($atts, $content=null) {
extract(shortcode_atts(
	        array(
					'custom_class' => '',
					'fluid' => 'false'
	    ), $atts));
	// add divs to the content	
	if ($fluid!="true") {
	$output = '<div class="container '. $custom_class .'">';
	}else {
	$output = '<div class="container-fluid '. $custom_class .'">';
	}
	$output .= do_shortcode($content);
	$output .= '</div>';
   
	return $output;
}
add_shortcode('container', 'container_shortcode');
?>