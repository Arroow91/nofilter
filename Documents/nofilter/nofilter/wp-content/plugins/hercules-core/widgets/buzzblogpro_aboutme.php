<?php
/*
About me box
*/
class buzzblogpro_aboutmebox extends WP_widget {

public function __construct() {

		$widget_ops = array(
			'classname' => 'buzzblogpro_aboutmebox', 
			'description' => esc_html__('A widget that displays the about me box', 'buzzblogpro') 
		);

		parent::__construct(
			'buzzblogpro_aboutmebox',
			esc_html__('Hercules - About me box', 'buzzblogpro'),
			$widget_ops
		);
        //add_action( 'save_post', array( $this, 'invalidate_widget_cache' ) );
		//add_action( 'deleted_post', array( $this, 'invalidate_widget_cache' ) );
		//add_action( 'switch_theme', array( $this, 'invalidate_widget_cache' ) );
	}

public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'aboutme_headline' => '', 'horizontal_layout' => '', 'text' => '', 'image_author_uri' => false, 'global_link' => '', 'circle_img' => '', 'signature_img' => '', 'modern_layout' => '', 'global_link_text' => '', 'global_link_href' => '') );
		
		$title 				= $instance['title'];
		$aboutme_headline 	= $instance['aboutme_headline'];
		$text 				= $instance['text'];
		$image_author_uri 	= $instance['image_author_uri'];
		$global_link = $instance['global_link'];
		$circle_img = $instance['circle_img'];
		$signature_img = $instance['signature_img'];
		$modern_layout = $instance['modern_layout'];
		$global_link_text = $instance['global_link_text']; 
		$global_link_href = $instance['global_link_href'];
	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'buzzblogpro'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
	    <p>
      		<label for="<?php echo esc_attr($this->get_field_id('image_author_uri')); ?>"><?php esc_html_e('Author image', 'buzzblogpro'); ?>:</label><br />
			<input type="hidden" name="<?php echo esc_attr($this->get_field_name('image_author_uri')); ?>" id="<?php echo esc_attr($this->get_field_id('image_author_uri')); ?>" value="<?php echo esc_url($image_author_uri); ?>" />
			<input class="button" onClick="hs_open_uploader(this, 'about_me_image')" id="about_image_upload" value="Upload" />
	    </p>
      	<p class="about_me_image" style="text-align:center;">
      		<img src="<?php echo esc_url($image_author_uri); ?>" style="max-width:100%;">
      	</p>
  <p>
            <label for="<?php echo esc_attr($this->get_field_id("circle_img")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("circle_img")); ?>" name="<?php echo esc_attr($this->get_field_name("circle_img")); ?>"<?php checked( (bool) $instance["circle_img"], true ); ?> />
          <?php esc_html_e( 'Do you want the picture to be in the circle? Your image should be a perfect square.', 'buzzblogpro' ); ?>
      </label>
     
  </p>
  <p>
            <label for="<?php echo esc_attr($this->get_field_id("signature_img")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("signature_img")); ?>" name="<?php echo esc_attr($this->get_field_name("signature_img")); ?>"<?php checked( (bool) $instance["signature_img"], true ); ?> />
          <?php esc_html_e( 'Do you want to display custom signature ?', 'buzzblogpro' ); ?>
      </label>
     
  </p>
    <p>
            <label for="<?php echo esc_attr($this->get_field_id("modern_layout")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("modern_layout")); ?>" name="<?php echo esc_attr($this->get_field_name("modern_layout")); ?>"<?php checked( (bool) $instance["modern_layout"], true ); ?> />
          <?php esc_html_e( 'Do you want to activate a modern layout ?', 'buzzblogpro' ); ?>
      </label>
     
  </p>
  
  <p>
						
						
						<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("horizontal_layout")); ?>" name="<?php echo esc_attr($this->get_field_name("horizontal_layout")); ?>"<?php checked( (bool) $instance["horizontal_layout"], true ); ?> />
						
						
						<label for="<?php echo esc_attr( $this->get_field_id('horizontal_layout') ); ?>"><?php echo esc_html__('Enable horizontal layout ?', 'buzzblogpro'); ?></label>
						<br />
						</p>
	    <p>
      		<label for="<?php echo esc_attr($this->get_field_id('aboutme_headline')); ?>"><?php esc_html_e('Headline', 'buzzblogpro'); ?>:</label><br />
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('aboutme_headline')); ?>" name="<?php echo esc_attr($this->get_field_name('aboutme_headline')); ?>" value="<?php echo esc_attr($aboutme_headline); ?>">
	    </p>
	    <p>
      		<label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php esc_html_e('Info', 'buzzblogpro'); ?>:</label><br />
			<textarea class="widefat" rows="5" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo esc_textarea($text); ?></textarea>
	    </p>
  <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php esc_html_e('Link to about me page', 'buzzblogpro'); ?>:</legend>
  <p>
      <label for="<?php echo esc_attr($this->get_field_id("global_link")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("global_link")); ?>" name="<?php echo esc_attr($this->get_field_name("global_link")); ?>"<?php checked( (bool) $instance["global_link"], true ); ?> />
          <?php esc_html_e( 'Show link to about me page', 'buzzblogpro' ); ?>
      </label>
  </p>
  
  <p>
  <label for="<?php echo esc_attr($this->get_field_id("global_link_text")); ?>">
    <?php esc_html_e( 'Link text', 'buzzblogpro' ); ?>:
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id("global_link_text")); ?>" name="<?php echo esc_attr($this->get_field_name("global_link_text")); ?>" type="text" value="<?php echo esc_attr($instance["global_link_text"]); ?>" /> <span style="font-size:11px; color:#999;"><?php esc_html_e( '(default: "Read More")', 'buzzblogpro' ); ?></span>
  </label>
  </p>
  <p>
      <label for="<?php echo esc_attr($this->get_field_id("global_link_href")); ?>">
          <?php esc_html_e( 'Link URL', 'buzzblogpro' ); ?>:
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id("global_link_href")); ?>" name="<?php echo esc_attr($this->get_field_name("global_link_href")); ?>" type="text" value="<?php echo esc_url($instance["global_link_href"]); ?>" />
      </label>
  </p>
  </fieldset>
	<?php
	}

public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 			= $new_instance['title'];
		$instance['aboutme_headline'] 			= $new_instance['aboutme_headline'];
		$instance['horizontal_layout'] = strip_tags($new_instance['horizontal_layout']);
		$instance['image_author_uri'] 		= $new_instance['image_author_uri'];
		$instance['global_link'] = strip_tags($new_instance['global_link']);
		$instance['circle_img'] = strip_tags($new_instance['circle_img']);
		$instance['signature_img'] = strip_tags($new_instance['signature_img']);
		$instance['modern_layout'] = strip_tags($new_instance['modern_layout']);
  $instance['global_link_href'] = strip_tags($new_instance['global_link_href']);
  $instance['global_link_text'] = strip_tags($new_instance['global_link_text']);

		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
		$instance['filter'] = isset($new_instance['filter']);
		//$this->invalidate_widget_cache();
		return $instance;
	}
public function invalidate_widget_cache()
	{
		delete_transient( $this->id );
	}
public function widget( $args, $instance ) {
		extract($args);
		$title 	= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text 	= apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$aboutme_headline 	= apply_filters( 'widget_text', empty( $instance['aboutme_headline'] ) ? '' : $instance['aboutme_headline'], $instance );


		echo wp_kses_post( $args['before_widget'] );
		//$code = get_transient( $this->id );
		
		//if( $code === false ) {
		$code = '';
		if ( $title ) {
			$code .=  wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		} 
if (isset($instance['modern_layout']) && !empty($instance['modern_layout'])) {$modernlayout = 'about-modernlayout';}else{$modernlayout = '';}
if (isset($instance['circle_img']) && !empty($instance['circle_img'])) {$imgcircle = 'imgcircle';}else{$imgcircle = '';}
			$code .=  '<div class="widget-body '.$modernlayout.' '.$imgcircle.'">'; 

				if(!empty($instance['image_author_uri'])){
				
				$blank_image = get_stylesheet_directory_uri() . '/images/empty.png';
				$bool = buzzblogpro_getVariable('lazyload_images');
						if ( $bool == 'yes') {
            $class = 'lazyload';
            $src = 'src="'. esc_url( $blank_image ) .'" data-src="'. esc_url( $instance['image_author_uri'] ) .'"';
            $srcs = 'src="'. esc_url( $blank_image ) .'" data-src="'. esc_url( buzzblogpro_getVariable('custom-signature-image','url')) .'"';
        } else {
 $class = '';
            $src = 'src="'. esc_url($instance['image_author_uri']) .'"';
            $srcs = 'src="'. esc_url( buzzblogpro_getVariable('custom-signature-image','url')) .'"';
        }
				@list($width, $height, $type, $attr) = getimagesize(esc_url($instance['image_author_uri']));
				
				
				if (!empty($instance['horizontal_layout'])) {
				$code .=  '<div class="row row-eq-height about-horizontal-layout"><div class="col-md-5 col-md-push-7">';
				}
				
					$code .=  '<div class="hs_about_img '.$this->id.'"><figure class="thumbnail">';
					if (isset($instance['global_link_href']) && !empty($instance['global_link_href']) && empty($instance['global_link'])) {
        $code .=  '<a class="aboutme-overlay-link" href="'.esc_url($instance['global_link_href']).'"></a>';
		}
            $code .=  '<img class="'.$class.'" '.$src.' '.$attr.' alt="'.strip_tags($aboutme_headline).'" />';
    $code .=  '</figure></div>';
				} 

if (!empty($instance['horizontal_layout'])) {
				$code .=  '</div><div class="col-md-7 col-md-pull-5 left-space">';
				}
				
				$code .=  '<div class="hs_aboutme_text post-list-inner">';
				$code .=  !empty( $aboutme_headline ) ? $aboutme_headline : '';
				if(buzzblogpro_getVariable('custom-signature-image','url') !='' &&  isset($instance['signature_img']) && !empty($instance['signature_img'])) {
$buzzblogpro_my_custom_signature_image = '<div class="signature-image"><img class="'.$class.'" '.$srcs.'  width="'.esc_attr( buzzblogpro_getVariable('custom-signature-image','width')).'" height="'.esc_attr( buzzblogpro_getVariable('custom-signature-image','height')).'" alt="signature" title="signature" /></div>';
}else{$buzzblogpro_my_custom_signature_image ='';}
				$code .=  '<p class="about_para">'.(!empty( $instance['filter'] ) ? wpautop( $text ) : $text).'</p>'.$buzzblogpro_my_custom_signature_image;
				if (isset($instance['global_link']) && !empty($instance['global_link'])) {
	  $code .=  '<div class="readmore-button"><a href="'.$instance['global_link_href'].'" class="btn btn-default btn-normal">';
	  if($instance['global_link_text']==""){
	  $code .=  esc_html__( 'Read more', 'buzzblogpro' );
	  }else{
	  $code .=  esc_attr($instance['global_link_text']);
	  } 
	  $code .=  '</a></div>';
	 }
				$code .=  '</div>';
				
				if (!empty($instance['horizontal_layout'])) {
				$code .=  '</div></div>';
				}
				
			$code .=  '</div>';
//set_transient( $this->id, $code, YEAR_IN_SECONDS );
			//}
		echo $code;
		echo wp_kses_post( $args['after_widget'] );
	}
}

if(!function_exists('buzzblogpro_aboutme_enq')){
	function buzzblogpro_aboutme_enq($hook){
	if( $hook != 'widgets.php' )
	return;
	
wp_enqueue_media(); 	
	  wp_enqueue_script('buzzblogpro-hsenq', plugin_dir_url(__FILE__) . 'aboutme-js/admin-script.js', array('jquery'), null, true);
	}
	add_action('admin_enqueue_scripts', 'buzzblogpro_aboutme_enq');
}