<?php /* Loop Name: Loop list-posts blog */ ?>
<?php 
$blog_list_special_post = buzzblogpro_getVariable('blog_list_special_post');

//if( ! empty( $buzzblogpro_options['do_not_dublicate'] ) && is_array( $buzzblogpro_options['do_not_dublicate'] )){
		//$args['post__not_in'] = $GLOBALS['buzzblogpro_do_not_duplicate'];
		//}
		
$counter = 1;


	 if (have_posts()) : 

	 while (have_posts()) : the_post();
	 
	 //if( ! empty( $GLOBALS['buzzblogpro_do_not_duplicate'] ) && is_array( $GLOBALS['buzzblogpro_do_not_duplicate'] )){
	// if (in_array($post->ID, $GLOBALS['buzzblogpro_do_not_duplicate'])) continue; 
	 //}
	 
$enable_overlay_mode = get_post_meta( get_the_ID(), '_buzzblogpro_post_enable_overlay_mode', 1 ) ? 'yes' : 'no';
?>
<?php if (($counter % 3 == 0 && $blog_list_special_post == 'yes') or ($enable_overlay_mode == 'yes') ) { ?>
<div class="block col-xs-12 col-md-12 ajax-post-wrapper" >

<?php get_template_part('content'); 
		if (buzzblogpro_getVariable('related_post')) {
		if (buzzblogpro_getVariable('related_post') !='no' and buzzblogpro_getVariable('related_post_single') !='yes') { get_template_part( 'post-template/related-posts' ); }	
		}

	if( $wp_query->current_post == 0 && is_active_sidebar( 'hs_under_first_post' ) && !is_paged() ) { ?>

	
	<?php 
	echo '<div class="row"><div class="col-md-12"><div class="under-first-post">';
	dynamic_sidebar("hs_under_first_post"); 
	echo '</div></div></div>';
	?>

	<?php } ?>		
	
<?php

	if( $wp_query->current_post == 1 && is_active_sidebar( 'hs_under_second_post' ) && !is_paged() ) { ?>

	
	<?php 
	echo '<div class="row"><div class="col-md-12"><div class="under-second-post">';
	dynamic_sidebar("hs_under_second_post"); 
	echo '</div></div></div>';
	?>

	<?php } ?>		
	
<?php

	if( $wp_query->current_post == 2 && is_active_sidebar( 'hs_under_third_post' ) && !is_paged() ) { ?>

	
	<?php 
	echo '<div class="row"><div class="col-md-12"><div class="under-third-post">';
	dynamic_sidebar("hs_under_third_post"); 
	echo '</div></div></div>';
	?>

	<?php } ?>	
	
<?php

	if( $wp_query->current_post == 3 && is_active_sidebar( 'hs_under_fourth_post' ) && !is_paged() ) { ?>

	
	<?php 
	echo '<div class="row"><div class="col-md-12"><div class="under-fourth-post">';
	dynamic_sidebar("hs_under_fourth_post"); 
	echo '</div></div></div>';
	?>

	<?php } ?>
	
<?php

	if( $wp_query->current_post == 4 && is_active_sidebar( 'hs_under_fifth_post' ) && !is_paged() ) { ?>

	
	<?php 
	echo '<div class="row"><div class="col-md-12"><div class="under-fifth-post">';
	dynamic_sidebar("hs_under_fifth_post"); 
	echo '</div></div></div>';
	?>

	<?php } ?>
</div>
<?php }else{ ?>
<div id="post-<?php the_ID(); ?>" class="block col-xs-12 col-md-12 ajax-post-wrapper list-post-container" > 
<?php 
   get_template_part('post-template/list-post-template'); 
?>
<?php

	if( $wp_query->current_post == 0 && is_active_sidebar( 'hs_under_first_post' ) && !is_paged() ) { ?>

	
	<?php 
	echo '<div class="spacer"></div><div class="row"><div class="col-md-12"><div class="under-first-post">';
	dynamic_sidebar("hs_under_first_post"); 
	echo '</div></div></div>';
	?>

	<?php } ?>		
	
<?php

	if( $wp_query->current_post == 1 && is_active_sidebar( 'hs_under_second_post' ) && !is_paged() ) { ?>

	
	<?php 
	echo '<div class="spacer"></div><div class="row"><div class="col-md-12"><div class="under-second-post">';
	dynamic_sidebar("hs_under_second_post"); 
	echo '</div></div></div>';
	?>

	<?php } ?>		
	
<?php

	if( $wp_query->current_post == 2 && is_active_sidebar( 'hs_under_third_post' ) && !is_paged() ) { ?>

	
	<?php 
	echo '<div class="spacer"></div><div class="row"><div class="col-md-12"><div class="under-third-post">';
	dynamic_sidebar("hs_under_third_post"); 
	echo '</div></div></div>';
	?>

	<?php } ?>	
</div>
<?php } ?>
<?php $counter ++ ; 
		endwhile; wp_reset_postdata();  
		
		?>

		<?php else: ?>
		
<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>