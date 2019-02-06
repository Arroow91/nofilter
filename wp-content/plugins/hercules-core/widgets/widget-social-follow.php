<?php
/**
 * Register Social Follow widget
 */

class Buzzblogpro_SocialFollow_Widget extends WP_Widget 
{
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'buzzblogpro-social',
			esc_html_x('Hercules - Social Follow', 'Admin', 'buzzblogpro'),
			array('description' => esc_html_x('Show social follower buttons.', 'Admin', 'buzzblogpro'), 'classname' => 'widget-social-buzzblogpro')
		);
		
	}

	public function widget($args, $instance) 
	{
		$title = apply_filters('widget_title', esc_html($instance['title']));

		echo $args['before_widget'];

		if (!empty($title)) {
			
			echo $args['before_title'] . wp_kses_post($title) . $args['after_title']; // before_title/after_title are built-in WordPress sanitized
		}

		$services = $this->services();
		$active   = isset($instance['social']) ? $instance['social'] : array();  
		$display = isset($instance['display']) ? $instance['display'] : 'icons';
        $displayinline = isset($instance['displayinline']) ? $instance['displayinline'] : 'oneline';
		
		?>
		<?php if ($display =="labels") {
				$addClass = "social__list_label";
			} elseif ($display == "both") { 
				$addClass = "social__list_both";
			} elseif ($display == "icons") { 
				$addClass = "social__list";
			} ?>
		
		<ul class="social <?php echo esc_attr($addClass); ?> <?php echo esc_attr($displayinline); ?> unstyled clearfix" itemscope itemtype="http://schema.org/Organization">
			<link itemprop="url" href="<?php echo esc_url(home_url('/')); ?>">
			<?php 
			foreach ($active as $key):
								
				$service = $services[$key];
				$urls = $instance[$key];
				
			?>
			
				<li class="services">

				<?php if ($display == "both") { ?>
					<a href="<?php echo $urls; ?>" class="service-link <?php echo esc_attr($key); ?>" target="_blank" itemprop="sameAs">
						<i class="<?php echo esc_attr($service['icon']); ?>"></i>
						<span class="label"><?php echo esc_html($service['label']); ?></span>
					</a>
<?php } ?>
<?php if ($display == "icons") { ?>

<a href="<?php echo $urls; ?>" class="service-link <?php echo esc_attr($key); ?>" target="_blank" itemprop="sameAs">
						<i class="<?php echo esc_attr($service['icon']); ?>"></i>
					</a>
<?php } ?>

<?php if ($display == "labels") { ?>
<a href="<?php echo $urls; ?>" class="service-link <?php echo esc_attr($key); ?>" target="_blank" itemprop="sameAs">
						<span class="label"><?php echo esc_html($service['label']); ?></span>
					</a>
<?php } ?>
				</li>
			
			<?php 
			endforeach; 
			?>
		</ul>
		
		<?php

		echo $args['after_widget'];
	}
	
	/**
	 * Supported services
	 */
	public function services()
	{

		$services = array(
			'facebook' => array(
				'label' => esc_html__('Facebook', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-facebook',
			),
				
			'twitter' => array(
				'label' => esc_html__('Twitter', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-twitter',
			),
			'gplus' => array(
				'label' => esc_html__('Google+', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-gplus',
			),
			'flickr' => array(
				'label' => esc_html__('Flickr', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-flickr',
			),
			'linkedin' => array(
				'label' => esc_html__('Linkedin', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-linkedin',
			),
			'instagram' => array(
				'label' => esc_html__('Instagram', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-instagram',
			),
			'youtube' => array(
				'label' => esc_html__('Youtube', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-youtube',
			),
			'aim' => array(
				'label' => esc_html__('Aim', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-aim',
			),
			'dribbble' => array(
				'label' => esc_html__('Dribbble', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-dribbble',
			),
			'deviantart' => array(
				'label' => esc_html__('Deviantart', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-deviantart',
			),
			'pinterest' => array(
				'label' => esc_html__('Pinterest', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-pinterest',
			),
			
			'vimeo' => array(
				'label' => esc_html__('Vimeo', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-vimeo',
			),
			'goodreads' => array(
				'label' => esc_html__('Goodreads', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-goodreads',
			),
			'bloglovin' => array(
				'label' => esc_html__('Bloglovin', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-bloglovin',
			),
			'tumblr' => array(
				'label' => esc_html__('Tumblr', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-tumblr',
			),
			'vk' => array(
				'label' => esc_html__('Vk', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-vk',
			),
			'snapchat' => array(
				'label' => esc_html__('Snapchat', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-snapchat',
			),
			'mail' => array(
				'label' => esc_html__('Mail', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-mail',
			),
			'rss' => array(
				'label' => esc_html__('RSS', 'buzzblogpro'),
				'icon'  => 'hs-icon hs hs-rss',
			),
		);
		
		
		return apply_filters( 'hercules_social_filter', $services );
	}
	

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance)
	{
		$defaults = array('title' => '', 'social' => array(), 'display' => 'icons', 'displayinline' => 'oneline', 'mail' => 'mailto:-here-email-address-');
		$instance = array_merge($defaults, (array) $instance);
		$display = $instance['display'];
		$displayinline = $instance['displayinline'];
		extract($instance);
		
		// Merge current values for sorting reasons
		$services = array_merge(array_flip($social), $this->services());
		?>
		
		<p> 
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__('Title:', 'buzzblogpro'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		<p><?php esc_html_e('Display:', 'buzzblogpro'); ?></p>
		<label for="<?php echo esc_attr($this->get_field_id('icons')); ?>"><input type="radio" name="<?php echo esc_attr($this->get_field_name('display')); ?>" value="icons" id="<?php echo esc_attr($this->get_field_id('icons')); ?>" <?php checked($display, "icons"); ?>></input><?php esc_html_e('Icons', 'buzzblogpro'); ?></label>
		<label for="<?php echo esc_attr($this->get_field_id('labels')); ?>"><input type="radio" name="<?php echo esc_attr($this->get_field_name('display')); ?>" value="labels" id="<?php echo esc_attr($this->get_field_id('labels')); ?>" <?php checked($display, "labels"); ?>></input><?php esc_html_e('Labels', 'buzzblogpro'); ?></label>
        <label for="<?php echo esc_attr($this->get_field_id('both')); ?>"><input type="radio" name="<?php echo esc_attr($this->get_field_name('display')); ?>" value="both" id="<?php echo esc_attr($this->get_field_id('both')); ?>" <?php checked($display, "both"); ?>></input><?php esc_html_e('Both', 'buzzblogpro'); ?></label>
		
		<p><?php esc_html_e('Columns:', 'buzzblogpro'); ?></p>
	  <label for="<?php echo esc_attr($this->get_field_id('oneline')); ?>"><input type="radio" name="<?php echo esc_attr($this->get_field_name('displayinline')); ?>" value="oneline" id="<?php echo esc_attr($this->get_field_id('oneline')); ?>" <?php checked($displayinline, "oneline"); ?>></input><?php esc_html_e('One column', 'buzzblogpro'); ?></label>
		<label for="<?php echo esc_attr($this->get_field_id('twocolumns')); ?>"><input type="radio" name="<?php echo esc_attr($this->get_field_name('displayinline')); ?>" value="twocolumns" id="<?php echo esc_attr($this->get_field_id('twocolumns')); ?>" <?php checked($displayinline, "twocolumns"); ?>></input><?php esc_html_e('Two columns', 'buzzblogpro'); ?></label>
        <label for="<?php echo esc_attr($this->get_field_id('threecolumns')); ?>"><input type="radio" name="<?php echo esc_attr($this->get_field_name('displayinline')); ?>" value="threecolumns" id="<?php echo esc_attr($this->get_field_id('threecolumns')); ?>" <?php checked($displayinline, "threecolumns"); ?>></input><?php esc_html_e('Three columns', 'buzzblogpro'); ?></label>
      
  
		
			<p><label for="<?php echo esc_attr($this->get_field_id('social')); ?>"><?php echo esc_html__('Social Icons:', 'buzzblogpro'); ?></label></p>
			
			<p><small><?php esc_html_e('Drag and drop to re-order.', 'buzzblogpro'); ?></small></p>
			
			<div class="buzzblogpro-social-services">
			<?php foreach ($services as $key => $service): 
			$url = isset($instance[$key]) ? $instance[$key] : '' ;	
			?>
			
			<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;background:#ffffff;">
			<legend style="padding:0 5px;"><?php echo esc_html($service['label']); ?>:</legend>
				<label for="<?php echo esc_attr($this->get_field_id($key)); ?>"><p style="margin-top: 0;">
				<input class="" type="checkbox" name="<?php echo esc_attr($this->get_field_name('social')); ?>[]" value="<?php echo esc_attr($key); ?>"<?php 
				echo (in_array($key, $social) ? ' checked' : ''); ?> /> <?php esc_html_e('URL:', 'buzzblogpro'); ?>
				<input style="width:250px;" class="" id="<?php echo esc_attr($this->get_field_id($key)); ?>" name="<?php echo esc_attr($this->get_field_name($key)); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
				</p></label>
				</fieldset>
			
			<?php endforeach; ?>
			
			</div>
			
		
		
		<script>
		jQuery(function($) { 
			$('.buzzblogpro-social-services').sortable({cursor: "move"});
		});
		</script>
	
	
		<?php
	}

	/**
	 * Save widget.
	 * 
	 * Strip out all HTML using wp_kses
	 * 
	 * @see wp_kses_post()
	 */
	public function update($new, $old)
	{
	$instance = $old;
		foreach ($new as $key => $val) {

			// Social just needs intval
			if ($key == 'social') {
				
				array_walk($val, 'intval');
				$new[$key] = $val;

				continue;
			}
			
			// Filter disallowed html 			
			$new[$key] = wp_kses_post($val);
		}
		
		return $new;
	}
}
