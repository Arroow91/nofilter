<?php
$args=array(
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
			'meta_key' => 'buzzblogpro_post_views_count',
			'showposts' => 4, // these are the number of most commented posts we want to display
			'ignore_sticky_posts' => 1 // to exclude the sticky post
		);
$counter = 1;
	$most_commented = new WP_Query($args);

	if ($most_commented->have_posts()) {	?>
	<div class="most-commented-section"><div class="most-commented-content">

			<h5 class="most-commented-posts"><span><?php echo theme_locals("most_popular"); ?></span></h5>
		
			<div class="row">

				<?php
				while ($most_commented->have_posts()) : $most_commented->the_post();
				?>
				
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
					<header class="post-header">
						<?php
			            $args = array(
		'width'          => 340,
		'height'         => 320,
		'crop'           => true,
		'single'           => true,
		'gif'           => false,
		'pinit'           => false,
		'lazy'           => false,
		'reviewscore'           => false
);

			            if ( has_post_thumbnail() ) {
				            buzzblogpro_post_thumbnail( $args );   
			            }  ?>
											<div class="most-commented-text-container">
<h5 class="post-title"><a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php esc_attr(the_title()); ?></a></h5>
		<?php if (buzzblogpro_getVariable('post_date')=='yes' or buzzblogpro_getVariable('post_date')=='') {buzzblogpro_post_meta(array('date'), false, 'meta-space-top');} ?>
</div>
		
			</header>
					</div>

				<?php
				$counter ++ ;
				endwhile;
				?>
			</div>
	</div></div>
	<?php 
	wp_reset_postdata();
	}
 ?>