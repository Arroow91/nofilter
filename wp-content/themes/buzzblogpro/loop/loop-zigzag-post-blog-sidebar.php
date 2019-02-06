<?php /* Loop Name: Loop zigzag blog */ ?>
<?php 
$counter = 1;

	 if (have_posts()) : 
	 while (have_posts()) : the_post();
	 ?>
<?php 
$enable_overlay_mode = get_post_meta( get_the_ID(), '_buzzblogpro_post_enable_overlay_mode', 1 ) ? 'yes' : 'no';
if ($enable_overlay_mode == 'yes') { ?>
<div class="ajax-post-wrapper block col-md-12" > 
<div class="row"><div class="col-md-12">
<?php
get_template_part('content');
if (buzzblogpro_getVariable('related_post') !='no' and buzzblogpro_getVariable('related_post_single') !='yes') { get_template_part( 'post-template/related-posts' ); }
?>
</div></div>
</div>

<?php }else{ ?>
<div id="post-<?php the_ID(); ?>" class="block col-md-12 ajax-post-wrapper" >
					            <?php
								$secondimage = '';
								$secondfeaturedimage = get_post_meta( get_the_ID(), '_buzzblogpro_second_featured_image_id', 1 );
								 if ( $secondfeaturedimage ) {
								$secondimage = ' second-featured-image';
			            $argsy = array(
	    'width'          => get_post_meta( get_the_ID(), '_buzzblogpro_second_featured_image_width', 1 ) ? get_post_meta( get_the_ID(), '_buzzblogpro_second_featured_image_width', 1 ) : 1200,
		'height'         => get_post_meta( get_the_ID(), '_buzzblogpro_second_featured_image_height', 1 ) ? get_post_meta( get_the_ID(), '_buzzblogpro_second_featured_image_height', 1 ) : 500,
		'crop'           => get_post_meta( get_the_ID(), '_buzzblogpro_second_featured_image_crop', 1 ) ? true : false, 
		'attachment_id'  => get_post_meta( get_the_ID(), '_buzzblogpro_second_featured_image_id', 1 ),
		'reviewscore' => false,
);
				            buzzblogpro_post_thumbnail( $argsy );
			            } 
			            ?>
<div class="post list_post_content zigazg <?php echo esc_attr($secondimage); ?>">
		<div class="row row-eq-height">
		<div class="<?php if ($counter % 2 == 1){echo 'col-xs-12 col-sm-6 col-md-6 ';} else if ($counter % 2 == 0){echo 'col-xs-12 col-sm-6 col-md-6 col-sm-push-6 col-md-push-6';} ?>">


			            <?php	
			            $args = array(
		'width'          => buzzblogpro_getVariable('blog_zigzag_image_width') ? buzzblogpro_getVariable('blog_zigzag_image_width') : 470,
		'height'         => buzzblogpro_getVariable('blog_zigzag_image_height') ? buzzblogpro_getVariable('blog_zigzag_image_height') : 490,
		'crop'           => true
);

			            if ( has_post_thumbnail() ) {
				            buzzblogpro_post_thumbnail( $args );
			            } 
			            ?>
		</div>
		<div class="left-space <?php if ($counter % 2 == 1){echo 'col-xs-12 col-sm-6 col-md-6';} else if ($counter % 2 == 0){echo 'col-xs-12 col-sm-6 col-md-6 col-sm-pull-6 col-md-pull-6';} ?>">
	<header class="post-header">
	<?php buzzblogpro_post_category('',' '); ?>
			<h2 class="list-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	
<?php buzzblogpro_post_meta(array('author', 'date', 'location', 'comments', 'reading_time', 'views'), false, 'meta-space-top'); ?>
	

	<div class="isopad_grid">
		<?php $post_excerpt = buzzblogpro_getVariable('post_excerpt'); ?>
		<?php if ($post_excerpt=='yes') { ?>		
			<div class="excerpt">			
<?php the_excerpt(); ?>			
			</div>
		<?php } ?>
						<?php $readmore_button = buzzblogpro_getVariable('readmore_button');
if ($readmore_button=='yes') { ?>
				<div class="clear"></div><div class="viewpost-button"><a class="button" href="<?php esc_url(the_permalink()) ?>"><span><?php echo theme_locals("continue_reading"); ?></span></a></div>
		<div class="clear"></div>
		<?php } ?>
	</div>
<?php get_template_part( 'post-template/post-meta-bottom' ); ?>
	</header>
</div>
	</div>
</div>
<?php

	if( $wp_query->current_post == 0 && is_active_sidebar( 'hs_under_first_post' ) && !is_paged() ) { ?>

	
	<?php 
	echo '<div class="spacer"></div><div class="row"><div class="col-md-12"><div class="under-first-post">';
	dynamic_sidebar("hs_under_first_post"); 
	echo '</div></div></div><div class="spacer"></div>';
	?>

	<?php } ?>		
	
<?php

	if( $wp_query->current_post == 1 && is_active_sidebar( 'hs_under_second_post' ) && !is_paged() ) { ?>

	
	<?php 
	echo '<div class="spacer"></div><div class="row"><div class="col-md-12"><div class="under-second-post">';
	dynamic_sidebar("hs_under_second_post"); 
	echo '</div></div></div><div class="spacer"></div>';
	?>

	<?php } ?>		
	
<?php

	if( $wp_query->current_post == 2 && is_active_sidebar( 'hs_under_third_post' ) && !is_paged() ) { ?>

	
	<?php 
	echo '<div class="spacer"></div><div class="row"><div class="col-md-12"><div class="under-third-post">';
	dynamic_sidebar("hs_under_third_post"); 
	echo '</div></div></div><div class="spacer"></div>';
	?>

	<?php } ?>	
	
<?php

	if( $wp_query->current_post == 3 && is_active_sidebar( 'hs_under_fourth_post' ) && !is_paged() ) { ?>

	
	<?php 
	echo '<div class="spacer"></div><div class="row"><div class="col-md-12"><div class="under-fourth-post">';
	dynamic_sidebar("hs_under_fourth_post"); 
	echo '</div></div></div><div class="spacer"></div>';
	?>

	<?php } ?>
	
<?php

	if( $wp_query->current_post == 4 && is_active_sidebar( 'hs_under_fifth_post' ) && !is_paged() ) { ?>

	
	<?php 
	echo '<div class="spacer"></div><div class="row"><div class="col-md-12"><div class="under-fifth-post">';
	dynamic_sidebar("hs_under_fifth_post"); 
	echo '</div></div></div><div class="spacer"></div>';
	?>

	<?php } ?>
</div>
<?php } ?>
<?php $counter ++ ;
		endwhile;
wp_reset_postdata();
		else: ?>

<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>