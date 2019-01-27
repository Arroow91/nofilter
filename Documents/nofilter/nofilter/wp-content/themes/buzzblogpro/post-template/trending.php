  <?php
        $post_type = 'post';
		$rtl_slide = '';
		$random_ID          = uniqid();
		$number_of_posts        = intval(buzzblogpro_getVariable('trending_howmany_slides'));
		$items_desktop   = absint( buzzblogpro_getVariable('trending_howmany_desktop') );
		$items_tablet   = absint( buzzblogpro_getVariable('trending_howmany_tablet') );
		$items_mobile   = absint( buzzblogpro_getVariable('trending_howmany_mobile') );
		$margin   = absint( buzzblogpro_getVariable('trending_slideshow_margin_items') );
		$autoplay             = buzzblogpro_getVariable('trending_slideshow_autoplay')== 'yes' ? 'true' : 'false';
		$auto_play_timeout  = 5000;
		$display_navs       = 'true';
		$display_pagination = 'false';
		$thumb_width = buzzblogpro_getVariable('trending_slideshow_image_width');
		$thumb_height = buzzblogpro_getVariable('trending_slideshow_image_height');
		$popular_type = buzzblogpro_getVariable('trending_slideshow_type');
if( $popular_type == 'onceweekly' ) {
		$poptype = 'buzzblogpro_post_week_views_count';
		} elseif ( $popular_type == 'oncemonth' ) {
		$poptype = 'buzzblogpro_post_month_views_count';
		}else{
		$poptype = 'buzzblogpro_post_views_count';
		}
if (is_rtl()) {$rtl_slide = 'true';}
  $args = array(
  'ignore_sticky_posts' => 1,
    'posts_per_page' => $number_of_posts,
    'post_type'   => 'post',
    'orderby' => 'meta_value_num',
    'meta_key' => $poptype,
    'order' => 'DESC'
  ); 

  $trending = new WP_Query( $args ); ?>


 
      <div class="trending-posts">

        <h6 class="trending-title"><span><?php echo theme_locals("trending");?></span></h6> 

        <div class="carousel-wrap trending-posts-slideshow">
		<?php
          echo '<div id="owl-carousel-' . esc_attr($random_ID) . '" class="owl-carousel-' . esc_attr($post_type) . ' owl-carousel" data-center="false" data-howmany="' .esc_attr($number_of_posts). '" data-margin="' . esc_attr($margin) . '" data-items="' . esc_attr($items_desktop) . '" data-tablet="' . esc_attr($items_tablet) . '" data-mobile="' . esc_attr($items_mobile) . '"  data-auto-play="' . esc_attr($autoplay) . '" data-auto-play-timeout="' . esc_attr($auto_play_timeout) . '" data-nav="' . esc_attr($display_navs) . '" data-rtl="'.esc_attr($rtl_slide).'" data-pagination="' . esc_attr($display_pagination) . '">';
		  ?>
          <?php while ( $trending->have_posts() ) : $trending->the_post(); 
		  ?>
            <div class="owl-slide post-list_h">
             
				  			            <?php	
			            $args = array(
		'width'          => $thumb_width ? $thumb_width : 270,
		'height'         => $thumb_height ? $thumb_height : 370,
		'crop'           => true,
		'addclass' => 'trending-default',
		'addstyle' => 'max-height:'.$thumb_height.'px;',
		'pinit'           => false
);

			            if ( has_post_thumbnail() ) {
				            buzzblogpro_post_thumbnail( $args );
			            } 
			            ?>
				
				<div class="post-list-inner">
                <?php buzzblogpro_post_category(); ?>
                <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
               <?php buzzblogpro_post_meta(array('date'), false, 'meta-space-top'); ?>
              </div>
            </div>
          <?php endwhile; ?>
          </div>
        </div>

        <?php wp_reset_postdata(); ?>
      </div>
 