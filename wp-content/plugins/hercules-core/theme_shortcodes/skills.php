<?php
/**
 * Skills
 *
 */
if (!function_exists('shortcode_skills')) {

	function shortcode_skills($atts, $content = null) {
	wp_enqueue_script( 'easy-pie-chart', get_theme_file_uri( '/js/jquery.easy-pie-chart.js' ), array( 'jquery' ), '1.0', true );
		extract(shortcode_atts(
	        array(
					'value' => '0',
					'size' => '180',
					'bgcolor' => '#f2f2f2',
					'fgcolor' => '#000000',
					'donutwidth' => '27',
					'title' => '',
					'font' => '',
					'fontsize' => '',
					'fontstyle' => '',
					'points' => '',
					'showpercent' => 'no',
					'custom_class' => ''
	    ), $atts));

		if($points) {$values = $points; }else{$values = $value; }
		if($showpercent == 'yes') {$percent = 'showpercent'; }else{$percent = '';  }
		$lineheight = $size - 2;
		$output = '<div class="skills '. $custom_class .'" style="text-align:center; font-family:'. $font .'; font-style:'. $fontstyle .'; font-size:'. $fontsize .'">
            <div class="chart" data-bgcolor="'. $bgcolor .'" data-fgcolor="'. $fgcolor .'" data-donutwidth="'. $donutwidth .'" data-size="'. $size .'" data-percent="'. $value .'"><span style="line-height: '. $lineheight .'px;" class="percent '.$percent.'">'. $values .'</span></div>';
			
			if(!$points) {
			$output .= '<p style="color:#000000;">'. $title .'</p>';
			}
			$output .= '</div>';
	    return $output;

	}
	add_shortcode('skills', 'shortcode_skills');

}?>