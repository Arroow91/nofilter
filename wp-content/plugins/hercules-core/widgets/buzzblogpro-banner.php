<?php
	class buzzblogpro_banner_widget extends WP_Widget {

	function __construct() {

		$widget_ops = array(
			'classname' => 'buzzblogpro_banner_widget', 
			'description'=> esc_html__('Hercules Banner Widget', 'buzzblogpro') 
		);

		parent::__construct(
			'buzzblogpro_banner_widget',
			esc_html__('Hercules - Banner', 'buzzblogpro'),
			$widget_ops
		);

	}
		/** @see WP_Widget::widget */
		function widget($args, $instance) {
			extract(array_merge($args , $instance));
			if (isset($fill)) {
			$fill = ($fill=='on')? true: false;
			}else{$fill ='';}
			if ($image_url) {
			@list($width, $height, $type, $attr) = getimagesize(esc_url($image_url));
			}
			echo wp_kses_post( $args['before_widget'] );
			if ( $title ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		} 
			echo ($link_url && $fill) ? '<a class="banner_link" href="'.esc_url($link_url).'" target="_blank">' : '' ;
			echo '<div class="banner_wrapper ';
			if ( $fill ) {
			echo 'fill_class" style="background-size: cover; background-repeat: no-repeat; background-image: url('.esc_url($image_url).')';
			}
			echo '">';
				echo (!$fill && $image_url)? '<figure class="thumbnail"><a target="_blank" href="'.esc_url($link_url).'"><img class="lazyload" data-src="'.esc_url($image_url).'" '.$attr.' alt=""></a></figure>' : '' ;
				
				echo '<div class="excerpt">'.$description_text.'</div>';
			echo '</div>';
			echo ($link_url && $fill) ? '</a>' : '' ;
			echo wp_kses_post( $args['after_widget'] );

			
		}

		/** @see WP_Widget::update */
		public function update( $new_instance, $old_instance ) {
			return $new_instance;
		}

		/** @see WP_Widget::form */
		public function form($instance) {
			$defaults = array(
				'title' => '',
				'description_text' => '',
				'image_url' => '',
				'fill' => '',
				'link_url' => ''
			);
			extract(array_merge($defaults, $instance));

			$form_field_type = array(
				'title' => array('type' => 'text', 'class' => 'widefat', 'inline_style' => '',  'title' => esc_html__('Title', 'buzzblogpro'), 'description' => '', 'value' => $title),
				'description_text' => array('type' => 'textarea', 'class' => 'widefat', 'inline_style' => '',  'title' => esc_html__('Banner description', 'buzzblogpro'), 'description' => '', 'value' => $description_text),
				'image_url' => array('type' => 'upload', 'class' => 'widefat', 'inline_style' => '', 'title' => esc_html__('Image URL', 'buzzblogpro'), 'description' => '', 'value' => $image_url),
				'fill' => array('type' => 'checkbox', 'class' => '', 'inline_style' => '', 'title' => esc_html__('Fill image', 'buzzblogpro'), 'description' => '', 'value' => $fill),
				'link_url' => array('type' => 'text', 'class' => 'widefat', 'inline_style' => '', 'title' => esc_html__('Link URL', 'buzzblogpro'), 'description' => '', 'value' => $link_url)
			);

			$output = '';
			foreach ($form_field_type as $key => $args) {
				$field_id = esc_attr($this->get_field_id($key));
				$field_name = esc_attr($this->get_field_name($key));
				$field_class = $args['class'];
				$field_title = $args['title'];
				$field_description = $args['description'];
				$field_value = $args['value'];
				$field_options = isset($args['value_options']) ? $args['value_options'] : array() ;
				$inline_style = $args['inline_style'] ? 'style="'.$args['inline_style'].'"' : '' ;

				$output .= '<p>';
				switch ($args['type']) {
					case 'text':
						$output .= '<label for="'.$field_id.'">'.$field_title.': <input '.$inline_style.' class="'.$field_class.'" id="'.$field_id.'" name="'.$field_name.'" type="text" value="'.esc_attr($field_value).'" /></label>';
					break;
					case 'checkbox':
						$checked = isset($instance[$key]) ? 'checked' : '' ;
						$output .= '<label for="'.$field_id.'"><input value="on" '.$inline_style.' class="'.$field_class.'" id="'.$field_id.'" name="'.$field_name.'" type="checkbox" '.$checked.' />'.$field_title.'</label>';
					break;
					case 'select':
						$output .= '<label for="'.$field_id.'">'.$field_title.': <select id="'.$field_id.'" name="'.$field_name.'" '.$inline_style.' >';
							if(!empty($field_options)){
								foreach ($field_options as $key_options => $value_options) {
									$selected = $key_options == $field_value ? ' selected' : '' ;
									$output .= '<option value="'.$key_options.'" '.$selected.'>'.$value_options.'</option>';
								}
							}
						$output .= '</select></label>';
					break;
					case 'textarea':
						$output .= '<textarea class="'.$field_class.'" rows="8" cols="10" id="'.$field_id.'" name="'.$field_name.'">'.$field_value.'</textarea>';
					break;
					case 'upload':
						$output .= '<label for="'.$field_id.'">'.$field_title.':</label>';
						$output .= '<input name="'.$field_name.'" id="'.$field_id.'"  '.$inline_style.' class="'.$field_class.'" type="text" size="36"  value="'.$field_value.'" />';
						$output .= '<input style="margin: 10px 0" class="button" onClick="hs_open_uploader(this, \'baner_image\')" id="baner_image_upload" type="button" value="'.esc_html__('Select Image', 'buzzblogpro').'" />';
						$output .= '<span class="baner_image" style="text-align:center;"><img src="'.esc_url($image_url).'" style="max-width:100%;"></span>';
					break; 
				} 
				$output .= '<br><small>'.$field_description.'</small>';
				$output .= '</p>';
				
			}
			
			echo balanceTags($output);
		}
	}
	function upload_scripts($hook){
	if( $hook != 'widgets.php' )
	return;
				wp_enqueue_script('buzzblogpro-hsenq', plugin_dir_url(__FILE__) . 'aboutme-js/admin-script.js', array('jquery'), null, true);
		}
	add_action('admin_enqueue_scripts', 'upload_scripts');
?>