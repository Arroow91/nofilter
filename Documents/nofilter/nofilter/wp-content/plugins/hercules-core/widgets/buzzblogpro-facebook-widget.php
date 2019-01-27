<?php
	class buzzblogpro_Facebook_Widget extends WP_Widget {

	function __construct() {

		$widget_ops = array(
			'classname' => 'buzzblogpro_Facebook_Widget', 
			'description' => esc_html__('Facebook Like Box Widget', 'buzzblogpro') 
		);

		parent::__construct(
			'buzzblogpro_Facebook_Widget',
			esc_html__('Hercules - Facebook Like Box Widget', 'buzzblogpro'),
			$widget_ops
		);

	}	
		public function widget( $args, $instance ){
			extract($args, EXTR_SKIP);
			$title          = apply_filters('widget_title', empty($instance['title']) ? esc_html__('My Facebook Page', 'buzzblogpro') : $instance['title']);
			$facebook_URL   = apply_filters('widget_facebook_URL', empty($instance['facebook_URL']) ? '' : $instance['facebook_URL']);
			$box_width      = apply_filters('widget_box_width', empty($instance['box_width']) ? '300' : $instance['box_width']);
			$box_height     = apply_filters('widget_box_height', empty($instance['box_height']) ? '500' : $instance['box_height']);
			$display_haeder = apply_filters('widget_display_haeder', empty($instance['display_haeder']) ? 'false' : 'true');
			$display_faces  = apply_filters('widget_display_faces', empty($instance['display_faces']) ? 'false' : 'true');
			$display_stream = apply_filters('widget_display_stream', empty($instance['display_stream']) ? 'false' : 'true');
			$small_header = apply_filters('widget_small_header', empty($instance['small_header']) ? 'false' : 'true');
			$location       = get_bloginfo('language')==""? "en_US" : str_replace('-', '_', get_bloginfo('language'));

			if($facebook_URL!=''){
				echo wp_kses_post( $args['before_widget'] );
				echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
				?>
				<div class="facebook_like_box">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo esc_js($location); ?>/sdk.js#xfbml=1&version=v3.2&appId=290794764313764";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-page" data-href="<?php echo esc_url($facebook_URL); ?>" data-width="<?php echo esc_attr($box_width); ?>" data-height="<?php echo esc_attr($box_height); ?>" data-small-header="<?php echo esc_attr($small_header); ?>" data-adapt-container-width="true" data-hide-cover="<?php echo esc_attr($display_haeder); ?>" data-show-facepile="<?php echo esc_attr($display_faces); ?>" data-show-posts="<?php echo esc_attr($display_stream); ?>"><div class="fb-xfbml-parse-ignore"></div></div></div>
			<?php
				echo wp_kses_post( $args['after_widget'] );
			}else { 
			echo wp_kses_post( $args['before_widget'] );
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
			echo esc_html__('Facebook error', 'buzzblogpro'); 
			echo wp_kses_post( $args['after_widget'] ); }
		}
		public function update( $new_instance, $old_instance ){
			$instance                   = $old_instance;
			$instance['title']          = strip_tags($new_instance['title']);
			$instance['facebook_URL']   = $new_instance['facebook_URL'];
			$instance['box_width']      = $new_instance['box_width'];
			$instance['box_height']     = $new_instance['box_height'];
			$instance['display_haeder'] = $new_instance['display_haeder'];
			$instance['display_faces']  = $new_instance['display_faces'];
			$instance['display_stream'] = $new_instance['display_stream'];
			$instance['small_header'] = $new_instance['small_header'];

			return $instance;
		}
		public function form( $instance ){   
			$defaults = array('title' => 'My Facebook Page', 'facebook_URL'=>'', 'box_width' => '300', 'box_height' => '500', 'display_haeder' => 'on', 'display_faces' => 'on', 'display_stream' => 'on', 'small_header' => 'on', 'display_header' => 'on');
			$instance = wp_parse_args( (array) $instance, $defaults );

			$title          = esc_attr($instance['title']);
			$facebook_URL   = $instance['facebook_URL'];
			$box_width      = $instance['box_width'];
			$box_height     = $instance['box_height'];
			$display_haeder = $instance['display_haeder'];
			$display_faces  = $instance['display_faces'];
			$display_stream = $instance['display_stream'];
			$small_header = $instance['small_header'];

			?>
			<!--title-->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__('Title', 'buzzblogpro'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>
			<!--facebook_URL-->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('facebook_URL')); ?>"><?php echo esc_html__('Facebook page url', 'buzzblogpro'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook_URL')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook_URL')); ?>" type="text" value="<?php echo esc_url($facebook_URL); ?>" />
				<span style="font-size:11px; color:#999;"><?php echo esc_html__('The Like Box only works with https://www.facebook.com/help/174987089221178/', 'buzzblogpro'); ?></span>
			</p>
			<!--box_width-->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('box_width')); ?>"><?php echo esc_html__('Width', 'buzzblogpro'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('box_width')); ?>" name="<?php echo esc_attr($this->get_field_name('box_width')); ?>" type="text" value="<?php echo esc_attr($box_width); ?>" />
			</p>
			<!--box_height-->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('box_height')); ?>"><?php echo esc_html__('Height', 'buzzblogpro'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('box_height')); ?>" name="<?php echo esc_attr($this->get_field_name('box_height')); ?>" type="text" value="<?php echo esc_attr($box_height); ?>" />
			</p>
			<!--display_haeder-->
			<p>
				<input class="checkbox" id="<?php echo esc_attr($this->get_field_id('display_haeder')); ?>" name="<?php echo esc_attr($this->get_field_name('display_haeder')); ?>" type="checkbox" <?php checked($instance['display_haeder'], 'on' ); ?> /> <label for="<?php echo esc_attr($this->get_field_id('display_haeder')); ?>"><?php echo esc_html__('Hide cover photo in the header', 'buzzblogpro')."."; ?></label>
			</p>
			<!--display_faces-->
			<p>
				<input class="checkbox" id="<?php echo esc_attr($this->get_field_id('display_faces')); ?>" name="<?php echo esc_attr($this->get_field_name('display_faces')); ?>" type="checkbox" <?php checked($instance['display_faces'], 'on' ); ?> /> <label for="<?php echo esc_attr($this->get_field_id('display_faces')); ?>"><?php echo esc_html__('Show profile photos when friends like this', 'buzzblogpro')."."; ?></label>
			</p>
			<!--display_stream-->
			<p>
				<input class="checkbox" id="<?php echo esc_attr($this->get_field_id('display_stream')); ?>" name="<?php echo esc_attr($this->get_field_name('display_stream')); ?>" type="checkbox" <?php checked($instance['display_stream'], 'on' ); ?> /> <label for="<?php echo esc_attr($this->get_field_id('display_stream')); ?>"><?php echo esc_html__("Show posts from the Page's timeline.", 'buzzblogpro')."."; ?></label>
			</p>
			<!--small_header-->
			<p>
				<input class="checkbox" id="<?php echo esc_attr($this->get_field_id('small_header')); ?>" name="<?php echo esc_attr($this->get_field_name('small_header')); ?>" type="checkbox" <?php checked($instance['small_header'], 'on' ); ?> /> <label for="<?php echo esc_attr($this->get_field_id('small_header')); ?>"><?php echo esc_html__('Use the small header instead', 'buzzblogpro')."."; ?></label>
			</p>
			<?php
		}
	}
?>