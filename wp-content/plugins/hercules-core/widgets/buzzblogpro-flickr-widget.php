<?php
class buzzblogpro_FlickrWidget extends WP_Widget {

	function __construct() {

		$widget_ops = array(
			'classname' => 'flickr', 
			'description' => esc_html__('A widget that displays the latest flickr images', 'buzzblogpro') 
		);

		parent::__construct(
			'buzzblogpro_FlickrWidget',
			esc_html__('Hercules - Flickr', 'buzzblogpro'),
			$widget_ops
		);

	}

      
 

  /** @see WP_Widget::widget */
  function widget($args, $instance) {	
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $flickr_id = apply_filters('flickr_id', $instance['flickr_id']);
    $amount = apply_filters('flickr_image_amount', $instance['image_amount']);
    $linktext = apply_filters('widget_linktext', $instance['linktext']);
	$suf = rand(100000,999999);

?>
<?php echo wp_kses_post( $args['before_widget'] );
if ( $title )
echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] ); 
wp_enqueue_script( 'buzzblogpro-jflickrfeed', plugin_dir_url(__FILE__) . 'flickrjs/jflickrfeed.js', array( 'jquery' ), '1.0', true ); ?>


<div class="grid_gallery clearfix">			
<div class="zoom-gallery grid_gallery_inner">
<div id="cbox">
</div>
</div>
<?php if ($linktext) { ?>
<br>
<a target="_blank" href="http://flickr.com/photos/<?php echo esc_attr($flickr_id) ?>" class="btn btn-default btn-normal"><?php echo esc_attr($linktext); ?></a>
<?php } ?>
</div>

<script>
(function ($) {
    'use strict';
	$(document).ready(function(){
$('#cbox').jflickrfeed({
	limit: <?php echo esc_attr($amount) ?>,
	qstrings: {
		id: '<?php echo esc_attr($flickr_id) ?>'
	},
	itemTemplate:
	'<div class="gallery_item"><figure class="featured-thumbnail thumbnail large">' +
		'<a class="image-wrap thumbnail zoomer" data-source="{{image_b}}" href="{{image_b}}" title="{{title}}">' +
			'<img class="img-responsive" src="{{image_q}}" alt="{{title}}" />' +
		'</a>' +
	'</figure></div>'
});
});
}(jQuery));
</script>
								
<?php echo wp_kses_post( $args['after_widget'] ); ?>
			 
<?php }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
      /* Set up some default widget settings. */
      $defaults = array( 'title' => '', 'flickr_id' => '', 'image_amount' => '', 'linktext' => '' );
      $instance = wp_parse_args( (array) $instance, $defaults );	

      $title = esc_attr($instance['title']);
			$flickr_id = esc_attr($instance['flickr_id']);
			$amount = esc_attr($instance['image_amount']);
			$linktext = esc_attr($instance['linktext']);
			
        ?>
      <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'buzzblogpro'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

      <p><label for="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>"><?php esc_html_e('Flickr ID:', 'buzzblogpro'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr_id')); ?>" type="text" value="<?php echo esc_attr($flickr_id); ?>" /></label></p>
	  	<p><label for="<?php echo esc_attr($this->get_field_id('image_amount')); ?>"><?php esc_html_e('Images count:', 'buzzblogpro'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('image_amount')); ?>" name="<?php echo esc_attr($this->get_field_name('image_amount')); ?>" type="text" value="<?php echo esc_attr($amount); ?>" /></label></p>	
      <p><label for="<?php echo esc_attr($this->get_field_id('linktext')); ?>"><?php esc_html_e('Link Text:', 'buzzblogpro'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linktext')); ?>" name="<?php echo esc_attr($this->get_field_name('linktext')); ?>" type="text" value="<?php echo esc_attr($linktext); ?>" /></label></p>	
			
<?php }

} 
?>