<?php /* Loop Name: Loop blog */ ?>
<div class="ajax-container"> 
<?php 
	 if (have_posts()) : while (have_posts()) : the_post(); ?>

	 <div class="ajax-post-wrapper" >
	<?php 
get_template_part('content');  
		if (buzzblogpro_getVariable('related_post')) {
		if (buzzblogpro_getVariable('related_post') !='no' and buzzblogpro_getVariable('related_post_single') !='yes') { get_template_part( 'post-template/related-posts' ); }	
		} ?>
<?php

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
<?php
		endwhile; else:

		get_template_part( 'content', 'none' );
	 
	 endif; ?>
</div>