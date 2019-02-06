<?php
if ( is_active_sidebar( 'hs_single_post_widget' ) ) { 
dynamic_sidebar("hs_single_post_widget");
}
?>

<div class="single-next-trigger"></div>
<?php 
$pagination_type = buzzblogpro_getVariable('single_pagination_type');
?>			

<?php if($pagination_type=='paglinkimages' or $pagination_type=='bothnav') { ?>				
				<div class="paginaton-container"><div class="row paging">
				
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		
		<?php 
		$prev_post = get_previous_post();
if ( $prev_post ) {
		
		
				$args = array(
					'post_id'        => $prev_post->ID,
					'attachment_id'  => get_post_thumbnail_id( $prev_post->ID ),
					'width'          => 110,
					'height'         => 90,
					'pinit' => false,
					'no-icon' => true,
					'crop' => true,
					'gif' => false,
					'addclass' => 'left',
					'disablevideolink' => true,
		'disableimagelink' => true,
				);
				if ( has_post_thumbnail( $prev_post->ID ) ) {
					buzzblogpro_post_thumbnail( $args );   
				} 
				
echo '<a href="'. get_permalink( $prev_post->ID ).'"><div class="direct-link-left"><p class="nav-subtitle"><i class="fa fa-angle-left"></i> '. theme_locals("prev_post") . '</p><span class="nav-title">'. get_the_title( $prev_post->ID ).'</span></div></a>'; 
} 

?>
		
		</div>
	
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<?php 
		
		$next_post = get_next_post();
		
		if ( $next_post ) {
		
				$args = array(
					'post_id'        => $next_post->ID,
					'attachment_id'  => get_post_thumbnail_id( $next_post->ID ),
					'width'          => 110,
					'height'         => 90,
					'pinit' => false,
					'crop' => true,
					'gif' => false,
					'no-icon' => true,
					'addclass' => 'right',
					'disablevideolink' => true,
		'disableimagelink' => true,
				);
				if ( has_post_thumbnail( $next_post->ID ) ) {
					buzzblogpro_post_thumbnail( $args );   
				} 
echo '<a href="'. get_permalink( $next_post->ID ).'"><div class="direct-link-right"><p class="nav-subtitle">' . theme_locals("next_post") . ' <i class="fa fa-angle-right"></i></p><span class="nav-title">'. get_the_title( $next_post->ID ).'</span></div></a>'; 
} 

?>
	</div>
	
	<div class="clear"></div>
</div></div>
<?php } ?>