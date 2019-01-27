<?php
/*
// =============================== My Recent News ======================================*/
class buzzblogpro_RecentNewsWidget extends WP_Widget {

	public function __construct() {

		$widget_ops = array(
			'classname' => 'buzzblogpro_RecentNewsWidget', 
			'description' => esc_html__('A widget that displays posts in slideshow', 'buzzblogpro') 
		);
        $control_ops = array('width' => 600, 'height' => 350);
		parent::__construct(
			'buzzblogpro_RecentNewsWidget',
			esc_html__('Hercules - Recent News Slideshow', 'buzzblogpro'),
			$widget_ops, $control_ops
		);

	}
/**
 * Displays custom posts widget on blog.
 */
public function widget($args, $instance) {
	
	extract( $args );
	$title 	= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
  if (isset($instance['excerpt_length']))
    $limit = apply_filters('widget_title', $instance['excerpt_length']);
  else
    $limit = 0;

	
  $valid_sort_orders = array('date', 'title', 'rand');
  if ( in_array($instance['sort_by'], $valid_sort_orders) ) {
    $sort_by = $instance['sort_by'];
    $sort_order = (bool) !empty($instance['asc_sort_order']) ? 'ASC' : 'DESC';
  } else {
    // by default, display latest first
    $sort_by = 'date';
    $sort_order = 'DESC';
  }
	
	// Get array of post info.
	
	$arg = array(
		'showposts' => $instance["num"],
		'ignore_sticky_posts' => 1,
		'post_type' => 'post',
		'orderby' => $sort_by,
		'order' => $sort_order
	);
	
			$custom_posts = array();
        if (!empty($instance['custom_posts'])) {
            $custom_posts = explode(',', $instance['custom_posts']);
            $custom_posts = array_map('trim', $custom_posts);
            $custom_posts = array_map('intval', $custom_posts);
			$arg['post__in'] = $custom_posts;
		}
		if (isset($instance['exclude']) && $instance['exclude'] == 'exclude' && isset($instance['widget_categories']) ) {

			$arg['category__not_in'] = $instance['widget_categories'];
		}
		if (isset($instance['exclude']) && $instance['exclude'] == 'include' && isset($instance['widget_categories'])) {

			$arg['category__in'] = $instance['widget_categories'];
		}
        
		if( $mostpopular == 'Once Weekly' ) {
		$arg['meta_key'] = 'buzzblogpro_post_week_views_count';
		$arg['orderby'] = 'meta_value_num';
		} elseif ( $mostpopular == 'Once a Month' ) {
		$arg['meta_key'] = 'buzzblogpro_post_month_views_count';
		$arg['orderby'] = 'meta_value_num';
		} elseif ( $mostpopular == 'All Time' ) {
		$arg['meta_key'] = 'buzzblogpro_post_views_count';
		$arg['orderby'] = 'meta_value_num';
		}else{}
	
  $cat_posts = new WP_Query($arg);
	
	echo wp_kses_post( $args['before_widget'] );
	
		 if ( $title ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		} 

			 
		if (isset($instance['show_category_link']) && $instance['show_category_link'] != 'no' ) {
							if (isset($instance['exclude']) && $instance['exclude'] == 'include' && isset($instance['widget_categories'])) {
			$termcat = get_term_by('id', reset($instance['widget_categories']), 'category'); $name = $termcat->name; $category_id = $termcat->term_id; ?>
			<h4 class="subtitle"><a href="<?php echo esc_url( get_category_link( $category_id ) ); ?>"><?php echo sanitize_text_field( $name ); ?></a></h4>
				<?php }
                } 
				
	// Posts list
    $random_ID          = uniqid();
	$rtl_slide = '';
	if (is_rtl()) {$rtl_slide = 'true';}
	 if (isset($instance['slide_width'])){
	$slideshow_width = $instance['slide_width'];
	}else{
	$slideshow_width = 280;
	}
	 if (isset($instance['slide_height'])){
	$slideshow_height = $instance['slide_height'];
	}else{
	$slideshow_height = 420;
	}
	$display_navs       = $instance['slideshow_displaynavs']== 'yes' ? 'true' : 'false';
	$display_pagination = $instance['slideshow_displaypagination']== 'yes' ? 'true' : 'false';
	
	echo '<div class="parallax-disabled carousel-wrap slideshow '.(empty($instance['container_class']) ? '' : $instance['container_class']).'  '.(empty($instance['layout']) ? 'underneath' : 'overlay-layout').'" style="margin-bottom:' .esc_attr($instance["bottommargin"]). 'px;">';
				echo '<div id="owl-carousel-' . esc_attr($random_ID) . '" class="owl-carousel-post owl-carousel" data-center="false" data-howmany="' .esc_attr($instance["num"]). '" data-margin="' .esc_attr($instance["margin"]). '" data-items="' .esc_attr($instance["numdesktop"]). '" data-tablet="' .esc_attr($instance["numtablet"]). '" data-mobile="' .esc_attr($instance["numphone"]). '"  data-auto-play="true" data-auto-play-timeout="9000" data-nav="' .esc_attr($display_navs). '" data-rtl="'.esc_attr($rtl_slide).'" data-pagination="' .esc_attr($display_pagination). '">';
	
	$limittext = $limit;
	while ( $cat_posts->have_posts() )
	{
		$cat_posts->the_post();
	?>
   
   
<?php
 if(has_post_thumbnail()) {
$post_id = $cat_posts->post->ID;


if ( !empty($instance['layout'] )) {

$img_url = wp_get_attachment_url( get_post_thumbnail_id());
				
		$img_width = $slideshow_width ? $slideshow_width : 280;
		$img_height = $slideshow_height ? $slideshow_height : 420;

        $img = aq_resize( $img_url, $img_width, $img_height, true, true, true ); 

		  ?>
   
                   
   
   
          <div class="owl-slide cover post-list_h lazyload <?php if ( empty($instance['show_border'] )) { echo 'slide-with-border'; }else{echo 'slide-no-border';} ?>" data-bg="<?php echo esc_url($img); ?>">
            <div class="cover-wrapper" style="height:<?php echo (empty($slideshow_height) ? '600' : $slideshow_height); ?>px;" >
              <div class="cover-content">
                <?php echo !empty($instance['show_category']) ? buzzblogpro_post_category($post_id,' ') : ''; ?>
                <?php if ( !empty($instance['show_title'] )) : ?>
<h4><a class="post-title" href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php esc_attr(the_title()); ?></a></h4>
<?php endif; ?>
<?php if ( !empty($instance['date'] )) : 
buzzblogpro_post_meta(array('date'), true, 'meta-space-top');
endif; ?>
		        <?php if (!empty($instance['excerpt'] )) : ?>
		<div class="excerpt">
<?php $excerpt = get_the_content();
echo buzzblogpro_limit_text($excerpt,$limittext); ?>
		   </div>
        <?php endif; ?>
          <?php if (!empty($instance['more_link'] )) : ?>
        <a href="<?php esc_url(the_permalink()) ?>" class="<?php if($instance['more_link_class']!="") {echo esc_attr($instance['more_link_class']);}else{ ?>slideshow-btn<?php } ?>"><?php if($instance['more_link_text']==""){  esc_html_e('Read more', 'buzzblogpro'); }else{ ?><?php echo esc_attr($instance['more_link_text']); ?><?php } ?></a>
      <?php endif; ?>
              </div>
            </div>
            <a href="<?php the_permalink();?>" class="cover-link"></a>
          </div>
   
   <?php }else{ ?>
   
               <div class="owl-slide post-list_h">
             
				  			            <?php	
			            $var = array(
		'width'          => $slideshow_width ? $slideshow_width : 280,
		'height'         => $slideshow_height ? $slideshow_height : 420,
		
		'addclass' => 'recent-news-slideshow',
		'addstyle' => 'max-height:'.$slideshow_height.'px;',
						'crop'           => true,
		'single'           => true,
		'gif'           => false,
		'pinit'           => true,
		'lazy'           => false,
		'reviewscore'           => false,
		'disablevideolink' => true,
		'disableimagelink' => true,
);

			           
				            buzzblogpro_post_thumbnail( $var );
			             
			            ?>
				
				<div class="post-list-inner">
                <?php echo !empty($instance['show_category']) ? buzzblogpro_post_category($post_id,' ') : ''; ?>
                                <?php if ( !empty($instance['show_title'] )) : ?>
<h4><a class="post-title" href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php esc_attr(the_title()); ?></a></h4>
<?php endif; ?>
               <?php if ( !empty($instance['date'] )) : 
buzzblogpro_post_meta(array('date'), true, 'meta-space-top');
endif; ?>
		        <?php if (!empty($instance['excerpt'] )) : ?>
		<div class="excerpt">
<?php $excerpt = get_the_content();
echo buzzblogpro_limit_text($excerpt,$limittext); ?>
		   </div>
        <?php endif; ?>
          <?php if (!empty($instance['more_link'] )) : ?>
        <a href="<?php esc_url(the_permalink()) ?>" class="<?php if($instance['more_link_class']!="") {echo esc_attr($instance['more_link_class']);}else{ ?>slideshow-btn<?php } ?>"><?php if($instance['more_link_text']==""){  esc_html_e('Read more', 'buzzblogpro'); }else{ ?><?php echo esc_attr($instance['more_link_text']); ?><?php } ?></a>
      <?php endif; ?>
              </div>
            </div>
		<?php } ?>	
   
   
   <?php } ?>
   
   
   
   
	<?php } ?>
	<?php echo "</div></div>"; 
	wp_reset_postdata();
	?>
	
<?php 	
	echo wp_kses_post( $args['after_widget'] );
	
}

/**
 * Form processing.
 */
public function update($new, $old)
	{
		foreach ($new as $key => $val) {
			$new[$key] = wp_kses_post($val);
		}
		
		return $new;
	}

/**
 * The configuration form.
 */
public function form($instance) {
  
  
  $defaults = array(
			'title' => '', 'mostpopular' => 'None','widget_categories' => array(), 'exclude' => 'exclude','posttype' => '', 'num' => '3', 'numdesktop' => '1','numtablet' => '1','numphone' => '1','margin' => '0','bottommargin' => '0','slide_width' => '280', 'slide_height' => '400', 'sort_by' => '', 'asc_sort_order' => '', 'show_category' => '', 'date' => '', 'container_class' => '', 'posts_category' => '', 'show_title' => '', 'layout' => '', 'excerpt' => '', 'excerpt_length' => '', 'show_border' => '', 'more_link' => '', 'more_link_text' => '', 'slideshow_displaynavs'=> 'yes','slideshow_displaypagination'=> 'yes', 'more_link_class' => '', 'custom_posts' => ''
		);
		
		$instance = array_merge($defaults, (array) $instance);
		extract($instance);

  $sort_by = esc_attr($instance['sort_by']);
  $mostpopular_list = esc_attr($instance['mostpopular']);
  $categories = isset($instance['widget_categories']) ? $instance['widget_categories'] : array();
  $exlude_list = esc_attr($instance['exclude']);
?>

  <p>
    <label for="<?php echo esc_attr($this->get_field_id("title")); ?>">
        <?php esc_html_e( 'Title', 'buzzblogpro' ); ?>:
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id("title")); ?>" name="<?php echo esc_attr($this->get_field_name("title")); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
    </label>
  </p>
  <div style="width:330px; float:left; padding-right:20px; border-right:1px solid #dddddd;">

  <p>
      <label for="<?php echo esc_attr($this->get_field_id("num")); ?>">
          <?php esc_html_e('Number of posts to show', 'buzzblogpro'); ?>:
          <input style="text-align: center;" id="<?php echo esc_attr($this->get_field_id("num")); ?>" name="<?php echo esc_attr($this->get_field_name("num")); ?>" type="text" value="<?php echo absint($instance["num"]); ?>" size='4' />
      </label>
</p>
<p>
      <label for="<?php echo esc_attr($this->get_field_id("numdesktop")); ?>">
          <?php esc_html_e('The number of visible posts on desktop', 'buzzblogpro'); ?>:
          <input style="text-align: center;" id="<?php echo esc_attr($this->get_field_id("numdesktop")); ?>" name="<?php echo esc_attr($this->get_field_name("numdesktop")); ?>" type="text" value="<?php echo absint($instance["numdesktop"]); ?>" size='4' />
      </label>
</p>
<p>
      <label for="<?php echo esc_attr($this->get_field_id("numtablet")); ?>">
          <?php esc_html_e('The number of visible posts on tablet', 'buzzblogpro'); ?>:
          <input style="text-align: center;" id="<?php echo esc_attr($this->get_field_id("numtablet")); ?>" name="<?php echo esc_attr($this->get_field_name("numtablet")); ?>" type="text" value="<?php echo absint($instance["numtablet"]); ?>" size='4' />
      </label>
</p>
<p>
      <label for="<?php echo esc_attr($this->get_field_id("numphone")); ?>">
          <?php esc_html_e('The number of visible posts on phone', 'buzzblogpro'); ?>:
          <input style="text-align: center;" id="<?php echo esc_attr($this->get_field_id("numphone")); ?>" name="<?php echo esc_attr($this->get_field_name("numphone")); ?>" type="text" value="<?php echo absint($instance["numphone"]); ?>" size='4' />
      </label>
</p>
<p>
      <label for="<?php echo esc_attr($this->get_field_id("margin")); ?>">
          <?php esc_html_e('The margin between slides', 'buzzblogpro'); ?>:
          <input style="text-align: center;" id="<?php echo esc_attr($this->get_field_id("margin")); ?>" name="<?php echo esc_attr($this->get_field_name("margin")); ?>" type="text" value="<?php echo absint($instance["margin"]); ?>" size='4' />
      </label>
</p>
<p>
      <label for="<?php echo esc_attr($this->get_field_id("bottommargin")); ?>">
          <?php esc_html_e('The bottom margin of the slideshow.', 'buzzblogpro'); ?>:
          <input style="text-align: center;" id="<?php echo esc_attr($this->get_field_id("bottommargin")); ?>" name="<?php echo esc_attr($this->get_field_name("bottommargin")); ?>" type="text" value="<?php echo absint($instance["bottommargin"]); ?>" size='4' />
      </label>
</p>
<p>
      <label for="<?php echo esc_attr($this->get_field_id("slide_width")); ?>">
          <?php esc_html_e('Image width', 'buzzblogpro'); ?>:
          <input style="text-align: center;" id="<?php echo esc_attr($this->get_field_id("slide_width")); ?>" name="<?php echo esc_attr($this->get_field_name("slide_width")); ?>" type="text" value="<?php echo absint($instance["slide_width"]); ?>" size='3' />
      </label>
</p>
  <p>
      <label for="<?php echo esc_attr($this->get_field_id("slide_height")); ?>">
          <?php esc_html_e('Image height', 'buzzblogpro'); ?>:
          <input style="text-align: center;" id="<?php echo esc_attr($this->get_field_id("slide_height")); ?>" name="<?php echo esc_attr($this->get_field_name("slide_height")); ?>" type="text" value="<?php echo absint($instance["slide_height"]); ?>" size='3' />
      </label>
</p>


<p>
  <label for="<?php echo esc_attr($this->get_field_id("sort_by")); ?>">
  <?php esc_html_e('Sort by', 'buzzblogpro'); ?>:
    <select id="<?php echo esc_attr($this->get_field_id("sort_by")); ?>" name="<?php echo esc_attr($this->get_field_name("sort_by")); ?>">
      <?php
        $options = array('date', 'title', 'rand');
            foreach ($options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $sort_by == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
  </label>
</p>
  
<p>
  <label for="<?php echo esc_attr($this->get_field_id("asc_sort_order")); ?>">
    <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("asc_sort_order")); ?>" name="<?php echo esc_attr($this->get_field_name("asc_sort_order")); ?>" value="1" <?php checked( (bool) $instance["asc_sort_order"], true ); ?> />
          <?php esc_html_e( 'Reverse sort order (ascending)', 'buzzblogpro' ); ?>
  </label>
</p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id("show_category")); ?>">
      <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("show_category")); ?>" name="<?php echo esc_attr($this->get_field_name("show_category")); ?>"<?php checked( (bool) $instance["show_category"], true ); ?> />
      <?php esc_html_e( 'Show category name', 'buzzblogpro' ); ?>
  </label>
</p>

<p>
  <label for="<?php echo esc_attr($this->get_field_id("date")); ?>">
      <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("date")); ?>" name="<?php echo esc_attr($this->get_field_name("date")); ?>"<?php checked( (bool) $instance["date"], true ); ?> />
      <?php esc_html_e( 'Show meta', 'buzzblogpro' ); ?>
  </label>
</p>

  <p>
      <label for="<?php echo esc_attr($this->get_field_id("show_title")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("show_title")); ?>" name="<?php echo esc_attr($this->get_field_name("show_title")); ?>"<?php checked( (bool) $instance["show_title"], true ); ?> />
          <?php esc_html_e( 'Show post title', 'buzzblogpro' ); ?>
      </label>
  </p>
 <p>
      <label for="<?php echo esc_attr($this->get_field_id("show_border")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("show_border")); ?>" name="<?php echo esc_attr($this->get_field_name("show_border")); ?>"<?php checked( (bool) $instance["show_border"], true ); ?> />
          <?php esc_html_e( 'Disable border ?', 'buzzblogpro' ); ?>
      </label>
  </p>
<p>
      <label for="<?php echo esc_attr($this->get_field_id("layout")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("layout")); ?>" name="<?php echo esc_attr($this->get_field_name("layout")); ?>" value="1" <?php checked( $instance["layout"], 1 ); ?> />
          <?php esc_html_e( 'Overlay layout', 'buzzblogpro' ); ?>
      </label>
  </p>
<p>
        <label for="<?php echo esc_attr($this->get_field_id("slideshow_displaynavs")); ?>">
    <?php esc_html_e( 'Show next/prev buttons', 'buzzblogpro' ); ?>
	<select id="<?php echo esc_attr($this->get_field_id("slideshow_displaynavs")); ?>" name="<?php echo esc_attr($this->get_field_name("slideshow_displaynavs")); ?>">
      <?php
        $slideshow_displaynavs_options = array('yes', 'no');
            foreach ($slideshow_displaynavs_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $instance["slideshow_displaynavs"] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
  </label>
  </p>
 <p>
        <label for="<?php echo esc_attr($this->get_field_id("slideshow_displaypagination")); ?>">
    <?php esc_html_e( 'Show dots navigation', 'buzzblogpro' ); ?>
	<select id="<?php echo esc_attr($this->get_field_id("slideshow_displaypagination")); ?>" name="<?php echo esc_attr($this->get_field_name("slideshow_displaypagination")); ?>">
      <?php
        $slideshow_displaypagination_options = array('yes', 'no');
            foreach ($slideshow_displaypagination_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $instance["slideshow_displaypagination"] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
  </label>
  </p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id("mostpopular")); ?>">
  <?php esc_html_e('Most Popular Posts Type', 'buzzblogpro'); ?>
    <select id="<?php echo esc_attr($this->get_field_id("mostpopular")); ?>" name="<?php echo esc_attr($this->get_field_name("mostpopular")); ?>">
      <?php
        $mostpopular_options = array('None', 'All Time', 'Once Weekly', 'Once a Month');
            foreach ($mostpopular_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $mostpopular_list == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
  </label>
</p> 
  
<fieldset style="border:1px solid #F1F1F1; padding:10px 10px 10px; margin-bottom:1em;">

			<label for="<?php echo esc_attr($this->get_field_id('custom_posts')); ?>"><?php esc_html_e("Editor's choice:", "buzzblogpro"); ?>
				<br />
				<input id="<?php echo esc_attr($this->get_field_id('custom_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_posts')); ?>" type="text" value="<?php echo esc_attr($custom_posts); ?>" />
                <br />
                <span style="color: #999;"><?php esc_html_e('Add IDs, separated by commas, eg. 145, 168, 229', 'buzzblogpro'); ?></span>
			</label>
		
</fieldset>		
<fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">

  <label for="<?php echo esc_attr($this->get_field_id("exclude_category")); ?>">
    <?php esc_html_e( 'Select categories you want to', 'buzzblogpro' ); ?>
	<select id="<?php echo esc_attr($this->get_field_id("exclude")); ?>" name="<?php echo esc_attr($this->get_field_name("exclude")); ?>">
      <?php
        $exlude_options = array('exclude', 'include');
            foreach ($exlude_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $exlude_list == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
  </label>
  
  <ul>
  <?php foreach (get_categories() as $category): ?>
    <li>
      <label>
        <input type="checkbox"
             class="checkbox"
             name="<?php echo $this->get_field_name('widget_categories') ?>[]"
             value="<?php echo $category->cat_ID ?>"
             <?php checked(in_array($category->cat_ID, $categories)) ?> />
        <?php echo $category->name ?>
      </label>
    </li>
  <?php endforeach ?>
  </ul>
  <p>
        <label for="<?php echo esc_attr($this->get_field_id("show_category_link")); ?>">
    <?php esc_html_e( 'Do you want to display the category name? (Only works with include option)', 'buzzblogpro' ); ?>
	<select id="<?php echo esc_attr($this->get_field_id("show_category_link")); ?>" name="<?php echo esc_attr($this->get_field_name("show_category_link")); ?>">
      <?php
        $show_category_link_options = array('yes', 'no');
            foreach ($show_category_link_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $instance["show_category_link"] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
  </label>
  </p>
</fieldset>		

<p>
  <label for="<?php echo esc_attr($this->get_field_id("container_class")); ?>">
    <?php esc_html_e( 'Container class', 'buzzblogpro' ); ?>:
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id("container_class")); ?>" name="<?php echo esc_attr($this->get_field_name("container_class")); ?>" type="text" value="<?php echo esc_attr($instance["container_class"]); ?>" /> <span style="font-size:11px; color:#999;"><?php esc_html_e( '(default: "featured_custom_posts")', 'buzzblogpro' ); ?></span>
  </label>
</p>
</div>
<div style="width:230px; float:left; padding-left:17px;">
  <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php esc_html_e('Excerpt', 'buzzblogpro'); ?>:</legend>
  <p>
      <label for="<?php echo esc_attr($this->get_field_id("excerpt")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("excerpt")); ?>" name="<?php echo esc_attr($this->get_field_name("excerpt")); ?>"<?php checked( (bool) $instance["excerpt"], true ); ?> />
          <?php esc_html_e( 'Show post excerpt', 'buzzblogpro' ); ?>
      </label>
  </p>
  <p>
      <label for="<?php echo esc_attr($this->get_field_id("excerpt_length")); ?>">
          <?php esc_html_e( 'Excerpt length (words):', 'buzzblogpro' ); ?>
      </label>
      <input style="text-align: center;" type="text" id="<?php echo esc_attr($this->get_field_id("excerpt_length")); ?>" name="<?php echo esc_attr($this->get_field_name("excerpt_length")); ?>" value="<?php echo esc_attr($instance["excerpt_length"]); ?>" size="3" />
  </p>
  </fieldset>
  <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php esc_html_e('More link', 'buzzblogpro'); ?>:</legend>
  <p>
      <label for="<?php echo esc_attr($this->get_field_id("more_link")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("more_link")); ?>" name="<?php echo esc_attr($this->get_field_name("more_link")); ?>"<?php checked( (bool) $instance["more_link"], true ); ?> />
          <?php esc_html_e( 'Show "More link"', 'buzzblogpro' ); ?>
      </label>
  </p>
  
  <p>
  <label for="<?php echo esc_attr($this->get_field_id("more_link_text")); ?>">
    <?php esc_html_e( 'Link text', 'buzzblogpro' ); ?>:
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id("more_link_text")); ?>" name="<?php echo esc_attr($this->get_field_name("more_link_text")); ?>" type="text" value="<?php echo esc_attr($instance["more_link_text"]); ?>" /> <span style="font-size:11px; color:#999;"><?php esc_html_e( '(default: "Read more")', 'buzzblogpro' ); ?></span>
  </label>
  </p>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id("more_link_class")); ?>">
    <?php esc_html_e( 'Link class', 'buzzblogpro' ); ?>:
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id("more_link_class")); ?>" name="<?php echo esc_attr($this->get_field_name("more_link_class")); ?>" type="text" value="<?php echo esc_attr($instance["more_link_class"]); ?>" /> <span style="font-size:11px; color:#999;"><?php esc_html_e( '(default: "link")', 'buzzblogpro' ); ?></span>
  </label>
  </p>
  </fieldset>
</div>
<div style="clear:both;"></div>
		
<?php
}
}
?>