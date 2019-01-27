<?php /* Loop Name: Loop single */ ?>
<?php if (have_posts()) : while (have_posts()) : the_post();         
      
get_template_part('content-gallery');

?>
					
				<div class="row paging">
				
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		
		<?php 
		
		$prev_post = get_adjacent_post(false, '', true);
		
		if ( $prev_post ) {
		
		$thumb_width = 110; $thumb_height = 90;
		$prevthumb = wp_get_attachment_url( get_post_thumbnail_id($prev_post->ID));
				$url            = $prevthumb;

		$file_type = wp_check_filetype( $url );

			if( ! empty( $file_type ) && $file_type['ext'] == 'gif' ){
		 $image_prev = $url;
		}else{
		 $image_prev          = aq_resize($url, $thumb_width, $thumb_height, true, true, true);
        }	
		
		

				
if(!empty($prev_post)) {
echo '<a href="' . get_permalink($prev_post->ID) . '" title="' . $prev_post->post_title . '">'; 
if ( $prev_post &&  has_post_thumbnail( $prev_post->ID ) ) {
echo '<figure class="thumbnail left"><img alt="'. theme_locals("prev_post") . '" class="nopin" width="' . esc_attr( $thumb_width ) . '" height="' . esc_attr( $thumb_height ) . '" src="' . esc_url( $image_prev ) . '" /></figure>';
}
echo '<div class="direct-link-left"><p class="nav-subtitle"><i class="fa fa-angle-left"></i> '. theme_locals("prev_post") . '</p><span class="nav-title">' . $prev_post->post_title . '</span></div></a>'; 
} 
}
?>
		
		</div>
	
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<?php 
		
		$next_post = get_adjacent_post(false, '', false);
		
		if ( $next_post ) {
		
		$thumb_width = 110; $thumb_height = 90;
		$nextthumb = wp_get_attachment_url( get_post_thumbnail_id($next_post->ID));
				$url            = $nextthumb;
				
	$file_type = wp_check_filetype( $url );

			if( ! empty( $file_type ) && $file_type['ext'] == 'gif' ){
		$image_next = $url;
		}else{
		 $image_next          = aq_resize($url, $thumb_width, $thumb_height, true, true, true);
        }

				
		
if(!empty($next_post)) {
echo '<a href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '">'; 
if ( has_post_thumbnail( $next_post->ID ) ) {
echo '<figure class="thumbnail right"><img alt="' . theme_locals("next_post") . '" class="nopin" width="' . esc_attr( $thumb_width ) . '" height="' . esc_attr( $thumb_height ) . '" src="' . esc_url( $image_next ) . '" /></figure>'; 
}
echo '<div class="direct-link-right"><p class="nav-subtitle">' . theme_locals("next_post") . ' <i class="fa fa-angle-right"></i></p><span class="nav-title">'  . $next_post->post_title . '</span></div></a>'; 
} 
}
?>
	</div>
	
	<div class="clear"></div>
</div>

			<?php comments_template('', true); ?>
<?php
	endwhile; endif; 
?>