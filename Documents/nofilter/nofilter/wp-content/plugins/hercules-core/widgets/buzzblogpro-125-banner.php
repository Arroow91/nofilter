<?php
class buzzblogpro_Ad_125_125_Widget extends WP_Widget {
  
function __construct() {
    $widget_ops = array('classname' => 'ad_125_125', 'description' => esc_html__('Add 125x125 ads.', 'buzzblogpro') );

    $control_ops = array('id_base' => 'ad_125_125-widget');

    parent::__construct('ad_125_125-widget', esc_html__('Hercules - 125x125 Ads', 'buzzblogpro'), $widget_ops, $control_ops);
  }
  
  function widget($args, $instance)
  {
  $title = apply_filters('widget_title', $instance['title'] );
    extract($args);

    ?>
	<?php echo wp_kses_post( $args['before_widget'] ); ?>
			<?php if ( $title ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		}  ?>
    <ul class="banners clearfix unstyled">
      <?php
      $ads = array(1, 2, 3, 4);
      foreach($ads as $ad_count):
        if($instance['ad_125_img_'.$ad_count] && $instance['ad_125_link_'.$ad_count]):
      ?>
      <li class="banners_li">
       <a target="_blank" href="<?php echo esc_url($instance['ad_125_link_'.$ad_count]); ?>"><img src="<?php echo esc_url($instance['ad_125_img_'.$ad_count]); ?>" width="125" height="125" alt="<?php esc_html_e('Advertisement', 'buzzblogpro');?>" class="banners_img"/></a>
      </li>
      <?php endif; endforeach; ?>
    </ul>
    <?php echo wp_kses_post( $args['after_widget'] );
  }
  
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
	$instance['title']      = strip_tags( $new_instance['title'] );
    $instance['ad_125_img_1'] = $new_instance['ad_125_img_1'];
    $instance['ad_125_link_1'] = $new_instance['ad_125_link_1'];
    $instance['ad_125_img_2'] = $new_instance['ad_125_img_2'];
    $instance['ad_125_link_2'] = $new_instance['ad_125_link_2'];
    $instance['ad_125_img_3'] = $new_instance['ad_125_img_3'];
    $instance['ad_125_link_3'] = $new_instance['ad_125_link_3'];
    $instance['ad_125_img_4'] = $new_instance['ad_125_img_4'];
    $instance['ad_125_link_4'] = $new_instance['ad_125_link_4'];

    return $instance;
  }

  function form($instance)
  {
    /* Set up some default widget settings. */
    $defaults = array( 'title' => esc_html__('Advertisement 125x125', 'buzzblogpro'), 'ad_125_img_1' => '', 'ad_125_link_1' => '', 'ad_125_img_2' => '', 'ad_125_link_2' => '', 'ad_125_img_3' => '', 'ad_125_link_3' => '', 'ad_125_img_4' => '', 'ad_125_link_4' => '' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
	<p>
<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'buzzblogpro'); ?></label>
<input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" class="widefat" name="<?php echo esc_html($this->get_field_name( 'title' )); ?>" value="<?php echo esc_html($instance['title']); ?>" />
</p>
    <p><strong><?php esc_html_e('Ad 1', 'buzzblogpro'); ?></strong></p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('ad_125_img_1')); ?>"><?php esc_html_e('Image Ad Link:', 'buzzblogpro'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('ad_125_img_1')); ?>" name="<?php echo esc_html($this->get_field_name('ad_125_img_1')); ?>" value="<?php echo esc_attr($instance['ad_125_img_1']); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('ad_125_link_1')); ?>"><?php esc_html_e('Ad URL:', 'buzzblogpro'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('ad_125_link_1')); ?>" name="<?php echo esc_html($this->get_field_name('ad_125_link_1')); ?>" value="<?php echo esc_attr($instance['ad_125_link_1']); ?>" />
    </p>
    <p><strong><?php esc_html_e('Ad 2', 'buzzblogpro'); ?></strong></p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('ad_125_img_2')); ?>"><?php esc_html_e('Image Ad Link:', 'buzzblogpro'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('ad_125_img_2')); ?>" name="<?php echo esc_html($this->get_field_name('ad_125_img_2')); ?>" value="<?php echo esc_attr($instance['ad_125_img_2']); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('ad_125_link_2')); ?>"><?php esc_html_e('Ad URL:', 'buzzblogpro'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('ad_125_link_2')); ?>" name="<?php echo esc_html($this->get_field_name('ad_125_link_2')); ?>" value="<?php echo esc_attr($instance['ad_125_link_2']); ?>" />
    </p>
    <p><strong><?php esc_html_e('Ad 3', 'buzzblogpro'); ?></strong></p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('ad_125_img_3')); ?>"><?php esc_html_e('Image Ad Link:', 'buzzblogpro'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('ad_125_img_3')); ?>" name="<?php echo esc_html($this->get_field_name('ad_125_img_3')); ?>" value="<?php echo esc_attr($instance['ad_125_img_3']); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('ad_125_link_3')); ?>"><?php esc_html_e('Ad URL:', 'buzzblogpro'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('ad_125_link_3')); ?>" name="<?php echo esc_html($this->get_field_name('ad_125_link_3')); ?>" value="<?php echo esc_attr($instance['ad_125_link_3']); ?>" />
    </p>
    <p><strong><?php esc_html_e('Ad 4', 'buzzblogpro'); ?></strong></p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('ad_125_img_4')); ?>"><?php esc_html_e('Image Ad Link:', 'buzzblogpro'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('ad_125_img_4')); ?>" name="<?php echo esc_html($this->get_field_name('ad_125_img_4')); ?>" value="<?php echo esc_attr($instance['ad_125_img_4']); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('ad_125_link_4')); ?>"><?php esc_html_e('Ad URL:', 'buzzblogpro'); ?></label>
      <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('ad_125_link_4')); ?>" name="<?php echo esc_html($this->get_field_name('ad_125_link_4')); ?>" value="<?php echo esc_attr($instance['ad_125_link_4']); ?>" />
    </p>
  <?php
  }
}
?>