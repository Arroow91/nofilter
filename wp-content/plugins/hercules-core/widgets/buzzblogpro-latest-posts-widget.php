<?php
/*
// =============================== My Recent News ======================================*/
class buzzblogpro_LatestPostsWidget extends WP_Widget {

	public function __construct() {

		$widget_ops = array(
			'classname' => 'buzzblogpro_LatestPostsWidget', 
			'description' => esc_html__('A widget that displays the latest posts', 'buzzblogpro') 
		);
        
		parent::__construct(
			'buzzblogpro_LatestPostsWidget',
			esc_html__('Hercules - Latest Posts', 'buzzblogpro'),
			$widget_ops
		);

	}
/**
 * Displays custom posts widget on blog.
 */
public function widget($args, $instance) {
	
	extract( $args );
	$title 	= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
	
	
	echo wp_kses_post( $args['before_widget'] );
	
		 if ( $title ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		} 
		
$style   = isset($instance['style']) ? $instance['style'] : 'standard';
$specials   = isset($instance['specials']) ? $instance['specials'] : 'hide-specials';
$number  = isset($instance['number']) ? $instance['number'] : '10';



		if ( ! isset( $number ) || ! is_numeric( $number ) ): $number = '10'; endif;
		 
		
		$arguments  = array( 'post_type' => 'post', 'posts_per_page' => $number, 'post__not_in' => get_option( 'sticky_posts' ), 'ignore_sticky_posts' => 1 );
		
		$custom_posts = array();
        if (!empty($instance['custom_posts'])) {
            $custom_posts = explode(',', $instance['custom_posts']);
            $custom_posts = array_map('trim', $custom_posts);
            $custom_posts = array_map('intval', $custom_posts);
			$arguments['post__in'] = $custom_posts;
		}
		if (isset($instance['exclude']) && $instance['exclude'] == 'exclude' && isset($instance['widget_categories']) ) {

			$arguments['category__not_in'] = $instance['widget_categories'];
		}
		if (isset($instance['exclude']) && $instance['exclude'] == 'include' && isset($instance['widget_categories'])) {

			$arguments['category__in'] = $instance['widget_categories'];
		}
        $counter = 1;
		switch ($style) {
		case 'masonry-2':
			$counter_set = '3';
		break;
		case 'list':
			$counter_set = '3';
		break;
		case 'masonry-3':
			$counter_set = '4';
		break;
		case 'masonry-4':
			$counter_set = '5';
		break;
	}
		$query_custom = new WP_Query( $arguments );
		if ( $query_custom->have_posts() ) :
			
			?>
			
			<?php if ( in_array( $style, array( 'masonry-2', 'masonry-3', 'masonry-4' ) ) ) : wp_enqueue_script('masonry'); ?><div class="grid widget-loop row"><?php endif; ?>
			<?php if ( in_array( $style, array( 'standard' ) ) ) : ?><div class="standard-container"> <?php endif; ?>
			
            <?php if ( in_array( $style, array( 'list', 'zigzag' ) ) ) : ?><div class="list-post row"><?php endif; ?>
			<?php /* The loop */
			while ( $query_custom->have_posts() ) : $query_custom->the_post();
			if ($style != 'zigzag' && $style != 'standard' ) {
			if ($counter % $counter_set == 0 && $specials == 'show-specials' ) {
			include( locate_template( 'VC-latest-posts/content-standard.php' ) );
			}else{
				include( locate_template( 'VC-latest-posts/content-' . $style . '.php' ) );
				}
				}else{
				include( locate_template( 'VC-latest-posts/content-' . $style . '.php' ) );
				}
				$counter ++ ; 
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		


		<?php
		endif;  ?>

		

		
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
			'title' => '', 'style' => 'standard','specials' => 'hide-specials','number'  => '10','widget_categories' => array(), 'exclude' => 'exclude', 'custom_posts' => '' 
			);
		
		$instance = array_merge($defaults, (array) $instance);
		extract($instance);

  
  $style_list = esc_attr($instance['style']); 
  $sticky_list  = esc_attr($instance['sticky']); 
  $specials_list = esc_attr($instance['specials']);
  $categories = isset($instance['widget_categories']) ? $instance['widget_categories'] : array();
  $exlude_list = esc_attr($instance['exclude']);
?>

  <p>
    <label for="<?php echo esc_attr($this->get_field_id("title")); ?>">
        <?php esc_html_e( 'Title', 'buzzblogpro' ); ?>:
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id("title")); ?>" name="<?php echo esc_attr($this->get_field_name("title")); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
    </label>
  </p>

  
 <p>
  <label for="<?php echo esc_attr($this->get_field_id("style")); ?>">
  <?php esc_html_e('Latest Posts Layout', 'buzzblogpro'); ?>:
    <select id="<?php echo esc_attr($this->get_field_id("style")); ?>" name="<?php echo esc_attr($this->get_field_name("style")); ?>">
      <?php
        $style_options = array('standard', 'masonry-2', 'masonry-3', 'masonry-4', 'list', 'zigzag');
            foreach ($style_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $style_list == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
	<br /><span style="font-size:11px; color:#999;"><?php esc_html_e( 'Select Latest Posts Style', 'buzzblogpro' ); ?></span>
  </label>
</p> 

<p>
  <label for="<?php echo esc_attr($this->get_field_id("specials")); ?>">
  <?php esc_html_e('Special post', 'buzzblogpro'); ?>:
    <select id="<?php echo esc_attr($this->get_field_id("specials")); ?>" name="<?php echo esc_attr($this->get_field_name("specials")); ?>">
      <?php
        $sticky_options = array('hide-specials', 'show-specials');
            foreach ($sticky_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $specials_list == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
	<br /><span style="font-size:11px; color:#999;"><?php esc_html_e( 'Do you want to have every third post full width ? Only works for list post and masonry layouts.', 'buzzblogpro' ); ?></span>
  </label>
</p> 
  
  <p>
      <label for="<?php echo esc_attr($this->get_field_id("number")); ?>">
          <?php esc_html_e('Number of posts', 'buzzblogpro'); ?>:
          <input style="text-align: center;" id="<?php echo esc_attr($this->get_field_id("number")); ?>" name="<?php echo esc_attr($this->get_field_name("number")); ?>" type="text" value="<?php echo absint($instance["number"]); ?>" size='4' />
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
</fieldset>	

<?php
}
}
?>