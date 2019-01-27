<?php
// =============================== CategoryBanner ======================================//
class buzzblogpro_CategoryBanner extends WP_Widget {

	function __construct() {

		$widget_ops = array(
			'classname' => 'buzzblogpro_CategoryBanner', 
			'description' => esc_html__('A widget that displays category banners', 'buzzblogpro') 
		);
        
		parent::__construct(
			'buzzblogpro_CategoryBanner',
			esc_html__('Hercules - Category Banner', 'buzzblogpro'),
			$widget_ops
		);

	}

function widget($args, $instance) {
	
	extract( $args );
	$title 	= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );


echo wp_kses_post( $args['before_widget'] );
	
if ( $title ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		} 
		
if (isset($instance['banner_width'])){
	$banner_width = $instance['banner_width'];
	}else{
	$banner_width = 292;
	}
	 if (isset($instance['banner_height'])){
	$banner_height = $instance['banner_height'];
	}else{
	$banner_height = 200;
	}
	


if (isset($instance['widget_categories'])) {
$exclude_array = implode(",", $instance['widget_categories']);
}else{$exclude_array='';}
	$arg = array(
    'orderby' => 'name',
    'order'   => 'ASC',
	'exclude'    => $exclude_array
);
	
if (!empty($instance['horizontal_layout'])) { echo '<div class="banner-category-wrap">';}
$categories = get_categories($arg);
 
foreach( $categories as $category ) {
$category_link = sprintf( 
        '<a class="cover-link" href="%1$s" alt="%2$s"></a>',
        esc_url( get_category_link( $category->term_id ) ),
        esc_attr( sprintf( esc_html__( 'View all posts in %s', 'buzzblogpro' ), $category->name ) )
    );

$cat_id = $category->term_id;
$image_id = get_term_meta ( $cat_id, '_buzzblogpro_category-image-id', true );

if (!empty($image_id)) {
		$img_width = $banner_width ? $banner_width : 292;
		$img_height = $banner_height ? $banner_height : 200;
		
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) && function_exists( 'jetpack_photon_url' ) ) {
			
			$image_args = array(
				'resize' => $img_width . ',' . $img_height
			);
			$img = jetpack_photon_url( $image_id, $image_args );
		}else{
        $img = aq_resize( $image_id, $img_width, $img_height, true, true, true ); 
		}
?>
   
<div class="promo cover lazyload <?php if (!empty($instance['horizontal_layout'])) { echo 'banner-category-inline ';} ?><?php if ( empty($instance['show_border'] )) { echo 'banner-with-border'; }else{echo 'banner-no-border';} ?>" data-bg="<?php echo esc_url($img); ?>">
<div class="cover-wrapper" style="height:<?php echo (empty($banner_height) ? '600' : $banner_height); ?>px;" >
<div class="cover-content">
<?php echo '<h4>' . esc_html( $category->name ) . '</h4> '; ?>
</div>
</div>
<?php echo $category_link; ?>
</div>

<?php  	
	
	} 	
} 	
if (!empty($instance['horizontal_layout'])) { echo '</div>';}	
echo wp_kses_post( $args['after_widget'] );
	
}

/**
 * Form processing.
 */
function update($new_instance, $old_instance) {
  $instance = $old_instance;
  $instance['widget_categories'] = $new_instance['widget_categories'];
  $instance['banner_width'] = strip_tags($new_instance['banner_width']);
  $instance['horizontal_layout'] = strip_tags($new_instance['horizontal_layout']);
  $instance['banner_height'] = strip_tags($new_instance['banner_height']);
  $instance['posttype'] = strip_tags($new_instance['posttype']);
  $instance['title'] = strip_tags($new_instance['title']);
  $instance['show_border'] = strip_tags($new_instance['show_border']);
return $instance;
}

/**
 * The configuration form.
 */
function form($instance) {
  /* Set up some default widget settings. */
  $defaults = array( 'title' => '', 'posttype' => '', 'horizontal_layout' => '', 'banner_width' => '292', 'banner_height' => '200', 'widget_categories' => array(), 'show_border' => '' );
  $instance = wp_parse_args( (array) $instance, $defaults );
  $categories = isset($instance['widget_categories']) ? $instance['widget_categories'] : array();
 
?>

  <p>
    <label for="<?php echo esc_attr($this->get_field_id("title")); ?>">
        <?php esc_html_e( 'Title', 'buzzblogpro' ); ?>:
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id("title")); ?>" name="<?php echo esc_attr($this->get_field_name("title")); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
    </label>
  </p>
<p>
						
						
						<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("horizontal_layout")); ?>" name="<?php echo esc_attr($this->get_field_name("horizontal_layout")); ?>"<?php checked( (bool) $instance["horizontal_layout"], true ); ?> />
						
						
						<label for="<?php echo esc_attr( $this->get_field_id('horizontal_layout') ); ?>"><?php echo esc_html__('Enable horizontal layout ?', 'buzzblogpro'); ?></label>
						<br />
						</p>

<p>
      <label for="<?php echo esc_attr($this->get_field_id("banner_width")); ?>">
          <?php esc_html_e('Image width', 'buzzblogpro'); ?>:
          <input style="text-align: center;" id="<?php echo esc_attr($this->get_field_id("banner_width")); ?>" name="<?php echo esc_attr($this->get_field_name("banner_width")); ?>" type="text" value="<?php echo absint($instance["banner_width"]); ?>" size='3' />
      </label>
</p>
  <p>
      <label for="<?php echo esc_attr($this->get_field_id("banner_height")); ?>">
          <?php esc_html_e('Image height', 'buzzblogpro'); ?>:
          <input style="text-align: center;" id="<?php echo esc_attr($this->get_field_id("banner_height")); ?>" name="<?php echo esc_attr($this->get_field_name("banner_height")); ?>" type="text" value="<?php echo absint($instance["banner_height"]); ?>" size='3' />
      </label>
</p>

  <p>
      <label for="<?php echo esc_attr($this->get_field_id("show_border")); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("show_border")); ?>" name="<?php echo esc_attr($this->get_field_name("show_border")); ?>"<?php checked( (bool) $instance["show_border"], true ); ?> />
          <?php esc_html_e( 'Disable border ?', 'buzzblogpro' ); ?>
      </label>
  </p>
  
   <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">

  <label for="<?php echo esc_attr($this->get_field_id("exclude_category")); ?>">
    <?php esc_html_e( 'Select categories you want to exclude', 'buzzblogpro' ); ?>
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