<?php 
class hs_recent_popular_tab_widget extends WP_Widget {
	function __construct() {
		// ajax functions
		add_action('wp_ajax_hs_recent_popular_tab_widget_content', array(&$this, 'ajax_hs_recent_popular_tab_widget_content'));
		add_action('wp_ajax_nopriv_hs_recent_popular_tab_widget_content', array(&$this, 'ajax_hs_recent_popular_tab_widget_content'));
        
        // css
        add_action('wp_enqueue_scripts', array(&$this, 'hs_recent_popular_tab_register_scripts'));
        
		// admin scripts
		add_action('admin_enqueue_scripts', array(&$this, 'hs_recent_popular_tab_admin_scripts'));
		
		$widget_ops = array('classname' => 'widget_hs_recent_popular_tab', 'description' => esc_html__('Display posts in tabbed format.', 'buzzblogpro'));
		$control_ops = array('width' => 200, 'height' => 350);
		parent::__construct('hs_recent_popular_tab_widget', esc_html__('Hercules Recent Popular Widget', 'buzzblogpro'), $widget_ops, $control_ops);
    }	
    
	
	
// admin scripts
	function hs_recent_popular_tab_admin_scripts($hook) {
	if ($hook == 'widgets.php') {
        wp_register_script('hs_recent_popular_tab_widget_admin', plugin_dir_url(__FILE__) . 'recent-popular-assets/js/hs-recent-tab-widget-admin.js', array('jquery'));  
        wp_enqueue_script('hs_recent_popular_tab_widget_admin');
		}
    }
	
	
	
	
    function hs_recent_popular_tab_register_scripts() { 
		// JS
		wp_register_script( 'hs_recent_popular_tab_widget', plugin_dir_url(__FILE__) . 'recent-popular-assets/js/hs-recent-tab-widget.js', array('jquery'));     
		wp_localize_script( 'hs_recent_popular_tab_widget', 'hs_recent_popular_tab',         
			array( 'ajax_url' => admin_url( 'admin-ajax.php' )) 
		);
		// CSS     
		wp_register_style('hs_recent_popular_tab_widget_css', plugin_dir_url(__FILE__) . 'recent-popular-assets/css/hs-recent-tab-widget.css', true);
    }  
    	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 
			'widget_title' => '',
            'tabs' => array('mostpopular' => 1, 'recent' => 1, 'trending' => 0, 'custom' => 0, 'mostcommented' => 0), 
            'tab_order' => array('mostpopular' => 1, 'recent' => 2, 'trending' => 3, 'custom' => 4, 'mostcommented' => 5), 
            'tab_titles' => array('mostpopular' => esc_html__('Most Popular', 'buzzblogpro'), 'recent' => esc_html__('Recent', 'buzzblogpro'), 'trending' => esc_html__('Trending', 'buzzblogpro'), 'custom' => esc_html__('Editors choice', 'buzzblogpro'), 'mostcommented' => esc_html__('Most commented', 'buzzblogpro')), 
            'allow_pagination' => 1,
			'excerpt' => 1,
			'excerpt_length' => '10', 
			'thumb_width' => '300', 
			'thumb_height' => '300',
			'nr_columns' => '3', 
			'show_title' => 1,
			'show_date' => 1,
			'show_category' => 1,
			'more_link' => 1,
			'popular_type' => '',
            'more_link_text' => 'Read more',
			'horizontal_layout' => 0,
            'posts_category' => '', 			
            'post_num' => '3', 
			'comment_num' => 1,
			'thumb' => 1,
			'left_thumb' => 0,
            'thumb_as_link' => '',
            'custom_posts' => ''
        ));
        
		extract($instance);
		?>
        <div class="hs_recent_popular_tab_options_form">

        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>"><?php esc_html_e( 'Title:','buzzblogpro' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'widget_title' )); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>" />
		</p>

        <h4><?php esc_html_e('Select Tabs', 'buzzblogpro'); ?></h4>
        
		<div class="hs_recent_popular_tab_select_tabs">
			<label class="alignleft" style="display: block; width: 50%; margin-bottom: 7px;" for="<?php echo esc_attr($this->get_field_id("tabs")); ?>_mostpopular">
				<input type="checkbox" class="checkbox hs_recent_popular_tab_enable_mostpopular" id="<?php echo esc_attr($this->get_field_id("tabs")); ?>_mostpopular" name="<?php echo esc_attr($this->get_field_name("tabs")); ?>[mostpopular]" value="1" <?php if (isset($tabs['mostpopular'])) { checked( 1, $tabs['mostpopular'], true ); } ?> />
				<?php esc_html_e( 'Most Popular', 'buzzblogpro'); ?>
			</label>
			<label class="alignleft" style="display: block; width: 50%; margin-bottom: 7px;" for="<?php echo esc_attr($this->get_field_id("tabs")); ?>_recent">
				<input type="checkbox" class="checkbox hs_recent_popular_tab_enable_recent" id="<?php echo esc_attr($this->get_field_id("tabs")); ?>_recent" name="<?php echo esc_attr($this->get_field_name("tabs")); ?>[recent]" value="1" <?php if (isset($tabs['recent'])) { checked( 1, $tabs['recent'], true ); } ?> />		
				<?php esc_html_e( 'Recent', 'buzzblogpro'); ?>
			</label>
<label class="alignleft" style="display: block; width: 50%; margin-bottom: 7px;" for="<?php echo esc_attr($this->get_field_id("tabs")); ?>_trending">
				<input type="checkbox" class="checkbox hs_recent_popular_tab_enable_trending" id="<?php echo esc_attr($this->get_field_id("tabs")); ?>_trending" name="<?php echo esc_attr($this->get_field_name("tabs")); ?>[trending]" value="1" <?php if (isset($tabs['trending'])) { checked( 1, $tabs['trending'], true ); } ?> />		
				<?php esc_html_e( 'Trending', 'buzzblogpro'); ?>
			</label>
			<label class="alignleft" style="display: block; width: 50%; margin-bottom: 7px;" for="<?php echo esc_attr($this->get_field_id("tabs")); ?>_custom">
				<input type="checkbox" class="checkbox hs_recent_popular_tab_enable_custom" id="<?php echo esc_attr($this->get_field_id("tabs")); ?>_custom" name="<?php echo esc_attr($this->get_field_name("tabs")); ?>[custom]" value="1" <?php if (isset($tabs['custom'])) { checked( 1, $tabs['custom'], true ); } ?> />
				<?php esc_html_e( 'Custom', 'buzzblogpro'); ?>
			</label>
			<label class="alignleft" style="display: block; width: 50%; margin-bottom: 7px;" for="<?php echo esc_attr($this->get_field_id("tabs")); ?>_mostcommented">
				<input type="checkbox" class="checkbox hs_recent_popular_tab_enable_mostcommented" id="<?php echo esc_attr($this->get_field_id("tabs")); ?>_mostcommented" name="<?php echo esc_attr($this->get_field_name("tabs")); ?>[mostcommented]" value="1" <?php if (isset($tabs['mostcommented'])) { checked( 1, $tabs['mostcommented'], true ); } ?> />
				<?php esc_html_e( 'Most Commented', 'buzzblogpro'); ?>
			</label>
		</div>
        <div class="clear"></div>
        
        <div class="hs_recent_popular_tab_advanced_options">
		        <p class="hs_recent_popular_tab_custom_posts"<?php echo (empty($tabs['custom']) ? ' style="display: none;"' : ''); ?>>
			<label for="<?php echo esc_attr($this->get_field_id('custom_posts')); ?>"><?php esc_html_e('Editor choice:', 'buzzblogpro'); ?>
				<br />
				<input id="<?php echo esc_attr($this->get_field_id('custom_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_posts')); ?>" type="text" value="<?php echo esc_attr($custom_posts); ?>" />
                <br />
                <span style="color: #999;"><?php esc_html_e('Add IDs, separated by commas, eg. 145, 168, 229', 'buzzblogpro'); ?></span>
			</label>
		</p>
		     <h4><a href="#" class="hs_recent_popular_tab_titles_header"><?php esc_html_e('Tab Titles', 'buzzblogpro'); ?></a> | <a href="#" class="hs_recent_popular_tab_order_header"><?php esc_html_e('Tab Order', 'buzzblogpro'); ?></a></h4>
        
        <div class="hs_recent_popular_tab_order" style="display: none;">
            
            <label class="alignleft hs_recent_popular_tab_mostpopular_order" for="<?php echo esc_attr($this->get_field_id('tab_order')); ?>_mostpopular" style="width: 50%;<?php echo (empty($tabs['mostpopular']) ? ' display: none;' : ''); ?>">
				<input id="<?php echo esc_attr($this->get_field_id('tab_order')); ?>_mostpopular" name="<?php echo esc_attr($this->get_field_name('tab_order')); ?>[mostpopular]" type="number" min="1" step="1" value="<?php echo esc_attr($tab_order['mostpopular']); ?>" style="width: 48px;" />
                <?php esc_html_e('Most Popular', 'buzzblogpro'); ?>
            </label>
            <label class="alignleft hs_recent_popular_tab_recent_order" for="<?php echo esc_attr($this->get_field_id('tab_order')); ?>_recent" style="width: 50%;<?php echo (empty($tabs['recent']) ? ' display: none;' : ''); ?>">
				<input id="<?php echo esc_attr($this->get_field_id('tab_order')); ?>_recent" name="<?php echo esc_attr($this->get_field_name('tab_order')); ?>[recent]" type="number" min="1" step="1" value="<?php echo esc_attr($tab_order['recent']); ?>" style="width: 48px;" />
                <?php esc_html_e('Recent', 'buzzblogpro'); ?>
            </label>
<label class="alignleft hs_recent_popular_tab_trending_order" for="<?php echo esc_attr($this->get_field_id('tab_order')); ?>_trending" style="width: 50%;<?php echo (empty($tabs['trending']) ? ' display: none;' : ''); ?>">
				<input id="<?php echo esc_attr($this->get_field_id('tab_order')); ?>_trending" name="<?php echo esc_attr($this->get_field_name('tab_order')); ?>[trending]" type="number" min="1" step="1" value="<?php echo esc_attr($tab_order['trending']); ?>" style="width: 48px;" />
                <?php esc_html_e('Trending', 'buzzblogpro'); ?>
            </label>
            <label class="alignleft hs_recent_popular_tab_custom_order" for="<?php echo esc_attr($this->get_field_id('tab_order')); ?>_custom" style="width: 50%;<?php echo (empty($tabs['custom']) ? ' display: none;' : ''); ?>">
				<input id="<?php echo esc_attr($this->get_field_id('tab_order')); ?>_custom" name="<?php echo esc_attr($this->get_field_name('tab_order')); ?>[custom]" type="number" min="1" step="1" value="<?php echo esc_attr($tab_order['custom']); ?>" style="width: 48px;" />
			    <?php esc_html_e('Custom', 'buzzblogpro'); ?>
            </label>
			<label class="alignleft hs_recent_popular_tab_mostcommented_order" for="<?php echo esc_attr($this->get_field_id('tab_order')); ?>_mostcommented" style="width: 50%;<?php echo (empty($tabs['mostcommented']) ? ' display: none;' : ''); ?>">
				<input id="<?php echo esc_attr($this->get_field_id('tab_order')); ?>_mostcommented" name="<?php echo esc_attr($this->get_field_name('tab_order')); ?>[mostcommented]" type="number" min="1" step="1" value="<?php echo esc_attr($tab_order['mostcommented']); ?>" style="width: 48px;" />
                <?php esc_html_e('Most Popular', 'buzzblogpro'); ?>
            </label>
        </div>
		<div class="clear" style="margin-bottom: 15px;"></div>
        
        <div class="hs_recent_popular_tab_titles" style="display: none;">
            
            <label class="alignleft hs_recent_popular_tab_mostpopular_title" for="<?php echo esc_attr($this->get_field_id('tab_titles')); ?>_mostpopular" style="width: 50%;<?php echo (empty($tabs['mostpopular']) ? ' display: none;' : ''); ?>">
				<?php esc_html_e('Most Popular', 'buzzblogpro'); ?>
                <input id="<?php echo esc_attr($this->get_field_id('tab_titles')); ?>_mostpopular" name="<?php echo esc_attr($this->get_field_name('tab_titles')); ?>[mostpopular]" type="text" value="<?php echo esc_attr($tab_titles['mostpopular']); ?>" style="width: 98%;" />
            </label>
            <label class="alignleft hs_recent_popular_tab_recent_title" for="<?php echo esc_attr($this->get_field_id('tab_titles')); ?>_recent" style="width: 50%;<?php echo (empty($tabs['recent']) ? ' display: none;' : ''); ?>">
				<?php esc_html_e('Recent', 'buzzblogpro'); ?>
                <input id="<?php echo esc_attr($this->get_field_id('tab_titles')); ?>_recent" name="<?php echo esc_attr($this->get_field_name('tab_titles')); ?>[recent]" type="text" value="<?php echo esc_attr($tab_titles['recent']); ?>" style="width: 98%;" />
            </label>
<label class="alignleft hs_recent_popular_tab_trending_title" for="<?php echo esc_attr($this->get_field_id('tab_titles')); ?>_trending" style="width: 50%;<?php echo (empty($tabs['trending']) ? ' display: none;' : ''); ?>">
				<?php esc_html_e('Trending', 'buzzblogpro'); ?>
                <input id="<?php echo esc_attr($this->get_field_id('tab_titles')); ?>_trending" name="<?php echo esc_attr($this->get_field_name('tab_titles')); ?>[trending]" type="text" value="<?php echo esc_attr($tab_titles['trending']); ?>" style="width: 98%;" />
            </label>
            <label class="alignleft hs_recent_popular_tab_custom_title" for="<?php echo esc_attr($this->get_field_id('tab_titles')); ?>_custom" style="width: 50%;<?php echo (empty($tabs['custom']) ? ' display: none;' : ''); ?>">
				<?php esc_html_e('Custom', 'buzzblogpro'); ?>
                <input id="<?php echo esc_attr($this->get_field_id('tab_titles')); ?>_custom" name="<?php echo esc_attr($this->get_field_name('tab_titles')); ?>[custom]" type="text" value="<?php echo esc_attr($tab_titles['custom']); ?>" style="width: 98%;" />
            </label>
			<label class="alignleft hs_recent_popular_tab_mostcommented_title" for="<?php echo esc_attr($this->get_field_id('tab_titles')); ?>_mostcommented" style="width: 50%;<?php echo (empty($tabs['mostcommented']) ? ' display: none;' : ''); ?>">
				<?php esc_html_e('Most Commented', 'buzzblogpro'); ?>
                <input id="<?php echo esc_attr($this->get_field_id('tab_titles')); ?>_mostcommented" name="<?php echo esc_attr($this->get_field_name('tab_titles')); ?>[mostcommented]" type="text" value="<?php echo esc_attr($tab_titles['mostcommented']); ?>" style="width: 98%;" />
            </label>
        </div>
		<div class="clear" style="margin-bottom: 15px;"></div>
          <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:0em;">
  <legend style="padding:0 5px;"><?php esc_html_e('Post', 'buzzblogpro'); ?>:</legend>
          <p>
			<label for="<?php echo esc_attr($this->get_field_id('post_num')); ?>"><?php esc_html_e('Number of posts to show:', 'buzzblogpro'); ?>
				<br />
				<input id="<?php echo esc_attr($this->get_field_id('post_num')); ?>" name="<?php echo esc_attr($this->get_field_name('post_num')); ?>" type="number" min="1" step="1" value="<?php echo esc_attr($post_num); ?>" />
			</label>
		</p>
  <p>
      <label for="<?php echo esc_attr($this->get_field_id("show_title")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("show_title")); ?>" name="<?php echo esc_attr($this->get_field_name("show_title")); ?>"<?php checked( (bool) $instance["show_title"], true ); ?> />
          <?php esc_html_e( 'Show post title', 'buzzblogpro' ); ?>
      </label>
  </p>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id("comment_num")); ?>">
      <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("comment_num")); ?>" name="<?php echo esc_attr($this->get_field_name("comment_num")); ?>"<?php checked( (bool) $instance["comment_num"], true ); ?> />
      <?php esc_html_e( 'Show number of comments', 'buzzblogpro' ); ?>
  </label>
</p>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id("show_date")); ?>">
      <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("show_date")); ?>" name="<?php echo esc_attr($this->get_field_name("show_date")); ?>"<?php checked( (bool) $instance["show_date"], true ); ?> />
      <?php esc_html_e( 'Show date', 'buzzblogpro' ); ?>
  </label>
</p>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id("show_category")); ?>">
      <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("show_category")); ?>" name="<?php echo esc_attr($this->get_field_name("show_category")); ?>"<?php checked( (bool) $instance["show_category"], true ); ?> />
      <?php esc_html_e( 'Show category', 'buzzblogpro' ); ?>
  </label>
</p>

<p>
  <label for="<?php echo esc_attr($this->get_field_id("posts_category")); ?>">
    <?php esc_html_e( 'Category', 'buzzblogpro' ); ?>:
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id("posts_category")); ?>" name="<?php echo esc_attr($this->get_field_name("posts_category")); ?>" type="text" value="<?php echo esc_attr($instance["posts_category"]); ?>" /> <span style="font-size:11px; color:#999;"><?php esc_html_e( '(Add category IDs, separated by commas)', 'buzzblogpro' ); ?></span>
  </label>
</p>
  </fieldset>
  <div class="clear" style="margin-bottom: 15px;"></div>
  <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
		
			<legend style="padding:0 5px;"><?php esc_html_e('Most Popular Posts Type', 'buzzblogpro'); ?>:</legend>
			<p>
			<select id="<?php echo esc_attr( $this->get_field_id('popular_type') ); ?>" name="<?php echo esc_attr( $this->get_field_name('popular_type') ); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('' == $instance['popular_type']) echo 'selected="selected"'; ?>>All Time</option>
				<option value='week' <?php if ('week' == $instance['popular_type']) echo 'selected="selected"'; ?>>Once Weekly</option>
				<option value='month' <?php if ('month' == $instance['popular_type']) echo 'selected="selected"'; ?>>Once a Month</option>
			</select>
		</p>  
  </fieldset>
   <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php esc_html_e('Thumbnail', 'buzzblogpro'); ?>:</legend>
  
  <p>
      <label for="<?php echo esc_attr($this->get_field_id("thumb")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("thumb")); ?>" name="<?php echo esc_attr($this->get_field_name("thumb")); ?>" value="1" <?php checked( (bool) $instance["thumb"], true ); ?> />
          <?php esc_html_e( 'Show post thumbnail', 'buzzblogpro' ); ?>
      </label>
  </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id("left_thumb")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("left_thumb")); ?>" name="<?php echo esc_attr($this->get_field_name("left_thumb")); ?>" value="1" <?php checked( (bool) $instance["left_thumb"], true ); ?> />
          <?php esc_html_e( 'Show small thumb on the left ?', 'buzzblogpro' ); ?>
      </label>
  </p>
  <p>
      <label for="<?php echo esc_attr($this->get_field_id("thumb_as_link")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("thumb_as_link")); ?>" name="<?php echo esc_attr($this->get_field_name("thumb_as_link")); ?>"<?php checked( (bool) $instance["thumb_as_link"], true ); ?> />
          <?php esc_html_e( 'Thumbnail as link', 'buzzblogpro' ); ?>
      </label>
  </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id("thumb_width")); ?>">
          <?php esc_html_e( 'Thumb width:', 'buzzblogpro' ); ?>
      </label>
      <input style="text-align: center;" type="text" id="<?php echo esc_attr($this->get_field_id("thumb_width")); ?>" name="<?php echo esc_attr($this->get_field_name("thumb_width")); ?>" value="<?php echo esc_attr($instance["thumb_width"]); ?>" size="3" />
  </p>
      <p>
      <label for="<?php echo esc_attr($this->get_field_id("thumb_height")); ?>">
          <?php esc_html_e( 'Thumb height:', 'buzzblogpro' ); ?>
      </label>
      <input style="text-align: center;" type="text" id="<?php echo esc_attr($this->get_field_id("thumb_height")); ?>" name="<?php echo esc_attr($this->get_field_name("thumb_height")); ?>" value="<?php echo esc_attr($instance["thumb_height"]); ?>" size="3" />
  </p>
  </fieldset>
  <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php esc_html_e('Excerpt', 'buzzblogpro'); ?></legend>
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
  </fieldset>
  
      <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php esc_html_e('Layout', 'buzzblogpro'); ?>:</legend>
  <p>
      <label for="<?php echo esc_attr($this->get_field_id("horizontal_layout")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("horizontal_layout")); ?>" name="<?php echo esc_attr($this->get_field_name("horizontal_layout")); ?>"<?php checked( (bool) $instance["horizontal_layout"], true ); ?> />
          <?php esc_html_e( 'Do you want to display posts in horizontal layout ?"', 'buzzblogpro' ); ?>
      </label>
  </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id("nr_columns")); ?>">
          <?php esc_html_e( 'Nr of columns in horizontal layout:', 'buzzblogpro' ); ?>
      </label>
      <input style="text-align: center;" type="text" id="<?php echo esc_attr($this->get_field_id("nr_columns")); ?>" name="<?php echo esc_attr($this->get_field_name("nr_columns")); ?>" value="<?php echo esc_attr($instance["nr_columns"]); ?>" size="3" />
  </p>
  </fieldset>
  
        <p>
			<label for="<?php echo esc_attr($this->get_field_id("allow_pagination")); ?>">				
				<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("allow_pagination")); ?>" name="<?php echo esc_attr($this->get_field_name("allow_pagination")); ?>" value="1" <?php if (isset($allow_pagination)) { checked( 1, $allow_pagination, true ); } ?> />
				<?php esc_html_e( 'Allow pagination', 'buzzblogpro'); ?>
			</label>
		</p>
	
        
        
        <div class="clear"></div>
        
   
        
        </div><!-- .hs_recent_popular_tab_advanced_options -->
		</div><!-- .hs_recent_popular_tab_options_form -->
		<?php 
	}	
	
	function update( $new_instance, $old_instance ) {	
		$instance = $old_instance;
		$instance['widget_title'] = strip_tags( $new_instance['widget_title'] );
		$instance['show_title'] = strip_tags($new_instance['show_title']);
		$instance['show_date'] = strip_tags($new_instance['show_date']);
		$instance['popular_type']        = $new_instance['popular_type'];
		$instance['show_category'] = strip_tags($new_instance['show_category']);
		$instance['comment_num'] = strip_tags($new_instance['comment_num']);
		$instance['thumb'] = strip_tags($new_instance['thumb']);
		$instance['left_thumb'] = strip_tags($new_instance['left_thumb']);
		$instance['thumb_as_link'] = strip_tags($new_instance['thumb_as_link']);
		$instance['excerpt'] = strip_tags($new_instance['excerpt']);
		$instance['excerpt_length'] = strip_tags($new_instance['excerpt_length']);
		$instance['thumb_width'] = strip_tags($new_instance['thumb_width']);
		$instance['thumb_height'] = strip_tags($new_instance['thumb_height']);
		$instance['nr_columns'] = strip_tags($new_instance['nr_columns']);
		$instance['more_link'] = strip_tags($new_instance['more_link']);
		$instance['more_link_text'] = strip_tags($new_instance['more_link_text']);
		$instance['horizontal_layout'] = strip_tags($new_instance['horizontal_layout']);
		$instance['tabs'] = $new_instance['tabs'];
        $instance['tab_order'] = $new_instance['tab_order'];
        $instance['tab_titles'] = wp_kses_post($new_instance['tab_titles']);
		$instance['allow_pagination'] = $new_instance['allow_pagination'];
		$instance['post_num'] = $new_instance['post_num'];
        $instance['custom_posts'] = $new_instance['custom_posts'];
		$instance['posts_category'] = $new_instance['posts_category'];
		

		return $instance;	
	}	
	function widget( $args, $instance ) {	
		extract($args, EXTR_SKIP); 
		extract($instance, EXTR_SKIP);
		$widget_title = apply_filters( 'widget_title', $widget_title );
		wp_enqueue_script( 'hs_recent_popular_tab_widget' );
		
        wp_enqueue_style( 'hs_recent_popular_tab_widget_css' );
		$popular_type        = isset( $instance['popular_type'] ) ? $instance['popular_type'] : '';
		if (empty($tabs)) $tabs = array('recent' => 1, 'mostpopular' => 1);    
		$tabs_count = count($tabs);     
		if ($tabs_count <= 1) {       
			$tabs_count = 1;       
		} elseif($tabs_count > 3) {   
			$tabs_count = 4;      
		}
        
        $available_tabs = array(
            'mostpopular' => $tab_titles['mostpopular'], 
            'recent' => $tab_titles['recent'],  
			'trending' => $tab_titles['trending'], 
            'custom' => $tab_titles['custom'],
			'mostcommented' => $tab_titles['mostcommented']
        );
            
        array_multisort($tab_order, $available_tabs);
        
		?>	
		<?php if (! empty($horizontal_layout)) { echo '<div class="before_the_blog_content">';}	?>	
		<?php echo wp_kses_post($before_widget);
		if ( ! empty( $widget_title ) ) echo wp_kses_post($before_title . $widget_title . $after_title); ?>	
		<div class="hs_recent_popular_tab_widget_content" id="<?php echo esc_attr($widget_id); ?>_content">		
			<div class="tab-menu-wrap"><ul class="hs-recent-popular-tabs <?php echo "has-$tabs_count-"; ?>tabs">
                <?php foreach ($available_tabs as $tab => $label) : ?>
                <?php if (!empty($tabs[$tab])): ?><li class="tab_title"><a href="#" data-id="<?php echo esc_attr($tab); ?>-tab"><?php echo esc_attr($label); ?></a></li><?php endif; ?>
                <?php endforeach; ?></ul></div>	
			<div class="clear"></div>  
			<div class="inside <?php if ($left_thumb) {echo 'left-thumb-inside';} ?>">        
				<?php if (!empty($tabs['mostpopular'])): ?>	
					<div data-id="mostpopular-tab-content" class="tab-content">				
					</div> <!--end #mostpopular-tab-content-->       
				<?php endif; ?>       
				<?php if (!empty($tabs['recent'])): ?>	
					<div data-id="recent-tab-content" class="tab-content"> 		 
					</div> <!--end #recent-tab-content-->		
				<?php endif; ?>  
				<?php if (!empty($tabs['trending'])): ?>	
					<div data-id="trending-tab-content" class="tab-content"> 		 
					</div> <!--end #trending-tab-content-->		
				<?php endif; ?>   				
				<?php if (!empty($tabs['custom'])): ?>       
					<div data-id="custom-tab-content" class="tab-content"> 				 
					</div> <!--end #custom-tab-content-->  
				<?php endif; ?>	
								<?php if (!empty($tabs['mostcommented'])): ?>       
					<div data-id="mostcommented-tab-content" class="tab-content mostcommented-tab-content"> 				 
					</div> <!--end #mostcommented-tab-content-->  
				<?php endif; ?>	
				<div class="clear"></div>	
			</div> <!--end .inside -->	
			<div class="clear"></div>
		</div><!--end #tabber -->    
		<?php    
		// inline script 
		// to support multiple instances per page with different settings   
		
		unset($instance['tabs'], $instance['tab_order'], $instance['tab_titles']); // unset unneeded  
		?>  
		<script type="text/javascript">  
			jQuery(function($) {    
				$('#<?php echo esc_attr($widget_id); ?>_content').data('args', <?php echo wp_json_encode($instance); ?>);  
			});  
		</script> 

		<?php echo wp_kses_post($after_widget); ?>
		<?php if (! empty($horizontal_layout)) { echo '</div>';}	?>
		<?php 
	}  
	
    
	function ajax_hs_recent_popular_tab_widget_content() {     
		$tab = $_POST['tab'];       
		$args = $_POST['args'];  
		$page = intval($_POST['page']);    
		if ($page < 1)        
			$page = 1;            
		if (!is_array($args))      
			return '';
        
		// sanitize args		
		$post_num = (empty($args['post_num']) ? 5 : intval($args['post_num']));    
		if ($post_num > 20 || $post_num < 1) { // max 20 posts
			$post_num = 5;   
		}      
                
        
        $custom_posts = array();
        if (!empty($args['custom_posts'])) {
            $custom_posts = explode(',', $args['custom_posts']);
            $custom_posts = array_map('trim', $custom_posts);
            $custom_posts = array_map('intval', $custom_posts);
        }
        $posts_category = array();
        if (!empty($args['posts_category'])) {
            $posts_category = explode(',', $args['posts_category']);
            $posts_category = array_map('trim', $posts_category);
            $posts_category = array_map('intval', $posts_category);
        }
		
		
		$allow_pagination = !empty($args['allow_pagination']);
        $show_title = !empty($args['show_title']);
		$show_date = !empty($args['show_date']);
		$show_category = !empty($args['show_category']);
		$excerpt = !empty($args['excerpt']);
		$excerpt_length = (empty($args['excerpt_length']) ? 12 : intval($args['excerpt_length']));
$thumb_width = (empty($args['thumb_width']) ? 300 : intval($args['thumb_width']));
$thumb_height = (empty($args['thumb_height']) ? 300 : intval($args['thumb_height']));		
        $nr_columns = (empty($args['nr_columns']) ? 3 : intval($args['nr_columns'])); 
		
		$more_link = !empty($args['more_link']);
		$more_link_text = (empty($args['more_link_text']) ? 'Read more' : $args['more_link_text']); 
		$horizontal_layout = !empty($args['horizontal_layout']);
		
		
$comment_num = !empty($args['comment_num']);
$thumb = !empty($args['thumb']);
$left_thumb = !empty($args['left_thumb']);
$thumb_as_link = !empty($args['thumb_as_link']); 

if( $popular_type == 'week' ) {
		$poptype = 'buzzblogpro_post_week_views_count';
		} elseif ( $popular_type == 'month' ) {
		$poptype = 'buzzblogpro_post_month_views_count';
		}else{
		$poptype = 'buzzblogpro_post_views_count';
		}
		
		switch ($tab) {
			case "mostpopular":      
				$custom_query = array(
                    'ignore_sticky_posts' => 1, 
                    'post_type' => 'post',
                    'posts_per_page' => $post_num, 
                    'post_status' => 'publish', 
                    'orderby' => 'meta_value_num', 
                    'meta_key' => $poptype,
					'category__in' => $posts_category,
                    'order' => 'desc', 
                    'paged' => $page
                );

			break;   
                      
             
			case "custom":        
				 $custom_query = array(
                    'ignore_sticky_posts' => 1, 
                    'post_type' => 'post',
                    'posts_per_page' => $post_num, 
                    'post_status' => 'publish', 
                    'orderby' => 'post__in',
                    'post__in' => $custom_posts,
                    'paged' => $page
                );
			break;  

            case "trending":
                $custom_query = array(
                    'ignore_sticky_posts' => 1, 
                    'post_type' => 'post',
                    'posts_per_page' => $post_num, 
                    'post_status' => 'publish', 
                    'orderby' => 'meta_value_num', 
                    'meta_key' => 'views',
					'category__in' => $posts_category,
                    'order' => 'desc', 
                    'paged' => $page
                );

			break;

			case "mostcommented":      
				$custom_query = array(
                    'ignore_sticky_posts' => 1, 
                    'post_type' => 'post',
                    'posts_per_page' => $post_num, 
                    'post_status' => 'publish', 
                    'orderby' => 'comment_count', 
					'category__in' => $posts_category,
                    'order' => 'desc', 
                    'paged' => $page
                );

			break; 

            case "recent":
            default:
                $custom_query = array(
                    'ignore_sticky_posts' => 1, 
                    'post_type' => 'post',
                    'posts_per_page' => $post_num, 
                    'post_status' => 'publish', 
					'category__in' => $posts_category,
                    'orderby' => 'date',
                    'order' => 'desc',
                    'paged' => $page
                );

			break;			
		}  
        
        ?>  
<?php if (!$horizontal_layout) {	?>	
<ul>

			<?php 
			$review_query = new WP_Query($custom_query);  		
			$last_page = $review_query->max_num_pages;  
$posts_counter = 0;			
			while ($review_query->have_posts()) : $review_query->the_post();  ?>	

<li class="cat_post_item-<?php echo esc_attr($posts_counter); ?> <?php if ($left_thumb) {echo 'left-thumb';} ?>">
					
         <div class="post-list_h">
		 <?php if (!$left_thumb) { ?>
		  <?php if ( $show_category ) { ?>
<div class="meta-space-top">
<span class="post_categories">
<?php 
echo buzzblogpro_post_category($post->ID,', ');
?>
</span>
</div>
 <?php } ?>
		 		         <?php if ( $show_title ) : ?>
			  <h4><a class="post-title" href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php esc_attr(the_title()); ?></a></h4>
			<?php endif; ?>
			
					   <div class="meta-space-top">
   <?php if ( $show_date ) : 
        buzzblogpro_post_date();
       endif; ?>

      <?php if ( $comment_num && $tab != 'mostcommented'  ) : ?>
        <span class="post-list_comment"><?php comments_number(); ?></span>
      <?php endif; ?>
      </div>
	  <?php } ?>
      		<?php 
        if(has_post_thumbnail()) {
          if ($thumb) : 
$bool = buzzblogpro_getVariable('lazyload_images');
$blank_image = get_stylesheet_directory_uri() . '/images/empty.png';
if(has_post_format('video')){
$embed = get_post_meta(get_the_ID(), 'buzzblogpro_video_embed', true);
$vimeo = strpos($embed, "vimeo");
	    $youtube = strpos($embed, "youtu");
	if($youtube !== false){	
$video_id = str_replace( 'http://', '', $embed );
	    	$video_id = str_replace( 'https://', '', $video_id );
	        $video_id = str_replace( 'www.youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtu.be/', '', $video_id );
	        $video_id = str_replace( '&feature=channel', '', $video_id );
			$link = '//www.youtube.com/embed/'.esc_attr($video_id);
			}
if($vimeo !== false){

	        //Get ID from video url
	        $video_id = str_replace( 'http://vimeo.com/', '', $embed );
	        $video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );
			$video_id = str_replace( 'https://vimeo.com/', '', $video_id );
			$link = '//player.vimeo.com/video/'.esc_attr($video_id);
			}
}
		  
		  
		  $img_url = wp_get_attachment_url( get_post_thumbnail_id());
				$img_width = $thumb_width ? $thumb_width : 300;
				$img_height = $thumb_height ? $thumb_height : 300;
				$img = aq_resize( $img_url, $img_width, $img_height, true, true, true );
				
				
				if ( $bool == 'yes' ) {
            $class = 'lazyload';
            $src = 'src="'. esc_url( $blank_image ) .'" data-src="'. esc_url( $img ) .'"';

        } else {
$class = '';
            $src = 'src="'. esc_url($img) .'"';

        }
		
				?>
		  <figure class="featured-thumbnail thumbnail large">
		  	  <?php if($tab == 'mostcommented' && $comment_num) {
	  $comments_count = wp_count_comments( get_the_ID() );
	  echo '<div class="comments-count hs hs-comment-1"><span>' . $comments_count->approved . '</span></div>';
	  } ?>
          <?php if ( $thumb_as_link ) : ?>
              <a class="tab-widget-img <?php if($embed){echo 'popup-vimeo';} ?>" href="<?php if($embed) { echo esc_attr($link); } else { esc_url(the_permalink()); } ?>">
            <?php endif; ?>
												<?php if(has_post_format('video')){
echo '<div class="cover-video"></div>';
 }  ?>
              <img <?php echo $src; ?> class="<?php echo esc_attr($class); ?>" width="<?php echo esc_attr($img_width); ?>" height="<?php echo esc_attr($img_height); ?>" alt="<?php esc_attr(the_title());?>" />

            <?php if ( $thumb_as_link ) : ?> 
              </a>
            <?php endif; ?>
			</figure>
          
        <?php endif;
      }		
   ?> 	
  
  <div class="post-list-inner <?php if (!$thumb) {echo 'no-thumb';} if (!$left_thumb && !$excerpt && !$more_link) {echo 'no-bg-excerpt'; } ?>"> 
  		 <?php if ($left_thumb) { ?>
		 <?php if ( $show_category ) { ?>
<div class="meta-space-top">
<span class="post_categories">
<?php 
$post_categories = get_the_category( $post->ID );
echo '<a class="" href="' . get_category_link( $post_categories[0]->term_id ) . '">'. $post_categories[0]->name .'</a>';
?>
</span>
</div>
 <?php } ?>
		 		         <?php if ( $show_title ) : ?>
			  <h4><a class="post-title" href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php esc_attr(the_title()); ?></a></h4>
			<?php endif; ?>
			
					   <div class="meta-space-top">
   <?php if ( $show_date ) : 
        buzzblogpro_post_date();
       endif; ?>

      <?php if ( $comment_num && $tab != 'mostcommented' ) : ?>
<span class="post-list_comment"><?php comments_number(); ?></span>
      <?php endif; ?>
      </div>
	  <?php } ?>
        <?php if ( $excerpt ) : ?>

            <?php $excerpts = get_the_content();
echo buzzblogpro_limit_text($excerpts,$excerpt_length); ?>
		   
        <?php endif; ?>
    
	  
      <?php if ( $more_link ) : ?>
        <a href="<?php esc_url(the_permalink()) ?>" class="btn btn-default btn-normal more_link_class"><?php if($more_link_text==""){  esc_html_e('Read more', 'buzzblogpro'); }else{ ?><?php echo esc_attr($more_link_text); ?><?php } ?></a>
      <?php endif; ?>
		 </div></div>
	
		 </li>
			<?php $post_num++; $posts_counter++; endwhile; wp_reset_query(); ?>		
		 </ul>
<?php }else{ ?>


<?php $i=0; // counter ?>


			<?php 
			$review_query = new WP_Query($custom_query); 
$max_columns = $nr_columns; //columns will arrange to any number (as long as it is evenly divisible by 12)
$column = 12/$max_columns; //column number
$total_items = $review_query->post_count;
$remainder = $review_query->post_count%$max_columns; //how many items are in the last row
$first_row_item = ($total_items - $remainder); //first item in the last row			
			$last_page = $review_query->max_num_pages;  
$posts_counter = 0;			
			while ($review_query->have_posts()) : $review_query->the_post();  ?>	

<?php if ($i%$max_columns==0) { // if counter is multiple of 3 ?>
    <div class="row">
    <?php } ?>
			
<?php if ($i >= $first_row_item) { //if in last row ?>   
    <div class="cat_post_item-<?php echo esc_attr($posts_counter); ?> col-xs-12 col-sm-6 col-md-<?php echo 12/$remainder; ?> <?php if ($left_thumb) {echo 'left-thumb';} ?>">
    <?php } else { ?>
    <div class="cat_post_item-<?php echo esc_attr($posts_counter); ?> col-xs-12 col-sm-6 col-md-<?php echo $column; ?> <?php if ($left_thumb) {echo 'left-thumb';} ?>">
    <?php } ?>
			
					
         <div class="post-list_h">
		 <?php if (!$left_thumb) { ?>
		  <?php if ( $show_category ) { ?>
<div class="meta-space-top">
<span class="post_categories">
<?php 
echo buzzblogpro_post_category($post->ID,', ');
?>
</span>
</div>
 <?php } ?>
		 		         <?php if ( $show_title ) : ?>
			  <h4><a class="post-title" href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php esc_attr(the_title()); ?></a></h4>
			<?php endif; ?>
			
					   <div class="meta-space-top">
   <?php if ( $show_date ) : 
        buzzblogpro_post_date();
       endif; ?>

      <?php if ( $comment_num && $tab != 'mostcommented'  ) : ?>
        <span class="post-list_comment"><?php comments_number(); ?></span>
      <?php endif; ?>
      </div>
	  <?php } ?>
      		<?php 
        if(has_post_thumbnail()) {
          if ($thumb) : 
$bool = buzzblogpro_getVariable('lazyload_images');
$blank_image = get_stylesheet_directory_uri() . '/images/empty.png';
		  if(has_post_format('video')){
$embed = get_post_meta(get_the_ID(), 'buzzblogpro_video_embed', true);
$vimeo = strpos($embed, "vimeo");
	    $youtube = strpos($embed, "youtu");
	if($youtube !== false){	
$video_id = str_replace( 'http://', '', $embed );
	    	$video_id = str_replace( 'https://', '', $video_id );
	        $video_id = str_replace( 'www.youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtu.be/', '', $video_id );
	        $video_id = str_replace( '&feature=channel', '', $video_id );
			$link = '//www.youtube.com/embed/'.esc_attr($video_id);
			}
if($vimeo !== false){

	        //Get ID from video url
	        $video_id = str_replace( 'http://vimeo.com/', '', $embed );
	        $video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );
			$video_id = str_replace( 'https://vimeo.com/', '', $video_id );
			$link = '//player.vimeo.com/video/'.esc_attr($video_id);
			}
}
		  $img_url = wp_get_attachment_url( get_post_thumbnail_id());
				$img_width = $thumb_width ? $thumb_width : 300;
				$img_height = $thumb_height ? $thumb_height : 300;
				$img = aq_resize( $img_url, $img_width, $img_height, true, true, true );
				
				
				if ( $bool == 'yes' ) {
            $class = 'lazyload';
            $src = 'src="'. esc_url( $blank_image ) .'" data-src="'. esc_url( $img ) .'"';

        } else {
$class = '';
            $src = 'src="'. esc_url($img) .'"';

        }
				?>
		  <figure class="featured-thumbnail thumbnail large">
		  	  <?php if($tab == 'mostcommented' && $comment_num) {
	  $comments_count = wp_count_comments( get_the_ID() );
	  echo '<div class="comments-count hs hs-comment-1"><span>' . $comments_count->approved . '</span></div>';
	  } ?>
          <?php if ( $thumb_as_link ) : ?>
              <a class="tab-widget-img <?php if($embed){echo 'popup-vimeo';} ?>" href="<?php if($embed) { echo esc_attr($link); } else { esc_url(the_permalink()); } ?>">
            <?php endif; ?>
												<?php if(has_post_format('video')){
echo '<div class="cover-video"></div>';
 }  ?>
              <img <?php echo $src; ?> class="<?php echo esc_attr($class); ?>" width="<?php echo esc_attr($img_width); ?>" height="<?php echo esc_attr($img_height); ?>" alt="<?php esc_attr(the_title());?>" />

            <?php if ( $thumb_as_link ) : ?> 
              </a>
            <?php endif; ?>
			</figure>
          
        <?php endif;
      }		
   ?> 	
  
  <div class="post-list-inner <?php if (!$thumb) {echo 'no-thumb';} if (!$left_thumb && !$excerpt && !$more_link) {echo 'no-bg-excerpt'; } ?>"> 
  		 <?php if ($left_thumb) { ?>
		 <?php if ( $show_category ) { ?>
<div class="meta-space-top">
<span class="post_categories">
<?php 
$post_categories = get_the_category( $post->ID );
echo '<a class="" href="' . get_category_link( $post_categories[0]->term_id ) . '">'. $post_categories[0]->name .'</a>';
?>
</span>
</div>
 <?php } ?>
		 		         <?php if ( $show_title ) : ?>
			  <h4><a class="post-title" href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php esc_attr(the_title()); ?></a></h4>
			<?php endif; ?>
			
					   <div class="meta-space-top">
   <?php if ( $show_date ) : 
        buzzblogpro_post_date();
       endif; ?>

      <?php if ( $comment_num && $tab != 'mostcommented' ) : ?>
<span class="post-list_comment"><?php comments_number(); ?></span>
      <?php endif; ?>
      </div>
	  <?php } ?>
        <?php if ( $excerpt ) : ?>

            <?php $excerpts = get_the_content();
echo buzzblogpro_limit_text($excerpts,$excerpt_length); ?>
		   
        <?php endif; ?>
    
	  
      <?php if ( $more_link ) : ?>
        <a href="<?php esc_url(the_permalink()) ?>" class="btn btn-default btn-normal more_link_class"><?php if($more_link_text==""){  esc_html_e('Read more', 'buzzblogpro'); }else{ ?><?php echo esc_attr($more_link_text); ?><?php } ?></a>
      <?php endif; ?>
		 </div></div>
	
		 </div>        

    <?php $i++; ?>
	<?php if($i%$max_columns==0) { // if counter is multiple of 3 ?>
    </div>
    <?php } ?>
			<?php $post_num++; $posts_counter++; endwhile; wp_reset_query(); ?>		
<?php if($i%$max_columns!=0) { // put closing div if loop is not exactly a multiple of 3 ?>
</div>
<?php } ?>




<?php } ?>
        <div class="clear"></div>
		<?php if ($allow_pagination) : ?>         
			<?php $this->tab_pagination($page, $last_page); ?>      
		<?php endif; ?>                      
		<?php               
		die(); // required to return a proper result  
	}    
    function tab_pagination($page, $last_page) {  
		?>   
		<div class="hs-recent-popular-tab-pagination">     
			<?php if ($page > 1) : ?>               
				<a href="#" class="previous"><span><?php esc_html_e('&larr;', 'buzzblogpro'); ?></span></a>      
			<?php endif; ?>        
			<?php if ($page != $last_page) : ?>     
				<a href="#" class="next"><span><?php esc_html_e('&rarr;', 'buzzblogpro'); ?></span></a>      
			<?php endif; ?>          
		</div>                   
		<div class="clear"></div>
		<input type="hidden" class="page_num" name="page_num" value="<?php echo esc_attr($page); ?>" />    
		<?php   
	}
}
?>