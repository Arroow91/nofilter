<?php
$numberof_related_posts = buzzblogpro_getVariable('numberof_related posts') ? buzzblogpro_getVariable('numberof_related posts') : 3 ;
if(is_singular()){
$how_many_posts = get_post_meta( get_the_ID(), '_buzzblogpro_content_width', true ) =="narrow" ? '2' : '3'; 
}else{
$how_many_posts = $numberof_related_posts;
}
        $post_type = 'post';
		$rtl_slide = '';
		if (is_rtl()) {$rtl_slide = 'true';}
		$random_ID          = uniqid();
		
		$items_desktop   = $how_many_posts;
		$items_tablet   = 2;
		$items_mobile   = 1;
		$margin   = 30;
		$autoplay           = 'true';
		$auto_play_timeout  = 5000;
		$display_navs       = 'true';
		$display_pagination = 'false';
$categories = get_the_category($post->ID);
if ($categories) {
$category_ids = array();
foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
$args=array(
'category__in' => $category_ids,
'post__not_in' => array($post->ID),
'orderby'        => 'rand',
'meta_key' => '_thumbnail_id',
'showposts' => 6
); 

	$related_query = new WP_Query($args);
	$count = $related_query->post_count;
$number_of_posts    = $count;
	if ($related_query->have_posts()) {	?>
	
	<div class="related-posts">
	<h5 class="related-posts_h"><span><?php echo theme_locals("blog_related"); ?></span></h5>
	<div class="related-content">

			<div class="row"><div class="col-md-12">
 <div class="carousel-wrap slideshows underneath">
 		<?php
          echo '<div id="owl-carousel-' . esc_attr($random_ID) . '" class="owl-carousel-' . esc_attr($post_type) . ' owl-carousel" data-center="false" data-howmany="' .esc_attr($number_of_posts). '" data-margin="' . esc_attr($margin) . '" data-items="' . esc_attr($items_desktop) . '" data-tablet="' . esc_attr($items_tablet) . '" data-mobile="' . esc_attr($items_mobile) . '"  data-auto-play="' . esc_attr($autoplay) . '" data-auto-play-timeout="' . esc_attr($auto_play_timeout) . '" data-nav="' . esc_attr($display_navs) . '" data-rtl="'.esc_attr($rtl_slide).'" data-pagination="' . esc_attr($display_pagination) . '">';
		  ?>
				<?php
				while ($related_query->have_posts()) : $related_query->the_post();
				?>
            <div class="owl-slide post-list_h">
             
				  			            <?php	
			            $arg = array(
		'width'          => 560,
		'height'         => 720,
		'crop'           => true,
		'gif'=> false,
		'pinit'           => false,
		'reviewscore'           => true,
		'addclass' => 'trending-default'
);

			            if ( has_post_thumbnail() ) {
				            buzzblogpro_post_thumbnail( $arg );
			            } 
			            ?>
				
				<div class="post-list-inner">
            
                <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
               <?php buzzblogpro_post_meta(array('date'), false, 'meta-space-top'); ?>
              </div>
            </div>
				<?php
				endwhile;
				?>
			</div></div></div>
	</div></div></div>
	<?php }
	wp_reset_postdata();
} ?>