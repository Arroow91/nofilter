<?php
class buzzblogpro_PostsBlock3 extends WP_Widget {

	public function __construct() {

		$widget_ops = array(
			'classname' => 'buzzblogpro_PostsBlock3', 
			'description' => esc_html__('A widget that display a posts block', 'buzzblogpro') 
		);
        
		parent::__construct(
			'buzzblogpro_PostsBlock3',
			esc_html__('Hercules - Posts Block 3', 'buzzblogpro'),
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
		
$mostpopular   = isset($instance['mostpopular']) ? $instance['mostpopular'] : 'None';
$postformat = isset($instance['postformat']) ? $instance['postformat'] : 'All';
$excerpt_count = isset($instance['excerpt_length']) ? $instance['excerpt_length'] : '8';

		$counter = 1;
		 
		$arguments  = array( 'post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option( 'sticky_posts' ), 'ignore_sticky_posts' => 1 );
		
		$custom_posts = array();
        if (!empty($instance['custom_posts'])) {
            $custom_posts = explode(',', $instance['custom_posts']);
            $custom_posts = array_map('trim', $custom_posts);
            $custom_posts = array_map('intval', $custom_posts);
			$arguments['post__in'] = $custom_posts;
		}
		if( $postformat == 'All' ) {
		if (isset($instance['exclude']) && $instance['exclude'] == 'exclude' && isset($instance['widget_categories']) ) {

			$arguments['category__not_in'] = $instance['widget_categories'];
		}
		if (isset($instance['exclude']) && $instance['exclude'] == 'include' && isset($instance['widget_categories'])) {

			$arguments['category__in'] = $instance['widget_categories'];
		}
		}
        
		//if( ! empty( $GLOBALS['buzzblogpro_do_not_duplicate'] ) && is_array( $GLOBALS['buzzblogpro_do_not_duplicate'] )){
	 
	 
		//$arguments['post__not_in'] = $GLOBALS['buzzblogpro_do_not_duplicate'];
		//}
		
		if( $mostpopular == 'Once Weekly' ) {
		$arguments['meta_key'] = 'buzzblogpro_post_week_views_count';
		$arguments['orderby'] = 'meta_value_num';
		} elseif ( $mostpopular == 'Once a Month' ) {
		$arguments['meta_key'] = 'buzzblogpro_post_month_views_count';
		$arguments['orderby'] = 'meta_value_num';
		} elseif ( $mostpopular == 'All Time' ) {
		$arguments['meta_key'] = 'buzzblogpro_post_views_count';
		$arguments['orderby'] = 'meta_value_num';
		}else{}
		
				if( $postformat != 'All' ) {
		
		
		switch ($postformat) {
	case "Standard":
        $postformats = array('post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-audio', 'post-format-chat', 'post-format-video');
		$operator = 'NOT IN';
        break;
    case "Gallery":
        $postformats = array('post-format-gallery');
		$operator = 'IN';
        break;
    case "Link":
        $postformats = array('post-format-link');
		$operator = 'IN';
        break;
    case "Image":
        $postformats = array('post-format-image');
		$operator = 'IN';
        break;
	 case "Audio":
        $postformats = array('post-format-audio');
		$operator = 'IN';
        break;
	 case "Video":
        $postformats = array('post-format-video');
		$operator = 'IN';
        break;
}

		if (isset($instance['exclude']) && $instance['exclude'] == 'exclude' && isset($instance['widget_categories']) ) {

			$arguments['category__not_in'] = $instance['widget_categories'];
			$cats_operator = 'NOT IN';
		}
		if (isset($instance['exclude']) && $instance['exclude'] == 'include' && isset($instance['widget_categories'])) {

			$cats = $instance['widget_categories'];
			$cats_operator = 'IN';
		}

		$arguments['tax_query'] = array('relation' => 'AND',
		array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => $postformats,
            'operator' => $operator
           ),
		   array(
            'taxonomy' => 'category',
            'field' => 'ID',
            'terms' => $cats,
            'operator' => $cats_operator
           ),
		   );
		   }

		$query_block3 = new WP_Query( $arguments );
		$numers_results = $query_block3->post_count;
		if ( $query_block3->have_posts() ) :  ?>
		
		<?php 
		if (isset($instance['show_category_link']) && $instance['show_category_link'] != 'no' ) {
							if (isset($instance['exclude']) && $instance['exclude'] == 'include' && isset($instance['widget_categories'])) {
			$termcat = get_term_by('id', reset($instance['widget_categories']), 'category'); $name = $termcat->name; $category_id = $termcat->term_id; ?>
			<h4 class="subtitle"><a href="<?php echo esc_url( get_category_link( $category_id ) ); ?>"><?php echo sanitize_text_field( $name ); ?></a></h4>
				<?php }
                } ?>
				<?php
			echo '<div class="row post_block_3">'; 
			while ( $query_block3->have_posts() ) : $query_block3->the_post();
			$slider_post_id = get_the_ID();
				//if( $do_not_dublicate ){
               // buzzblogpro_do_not_dublicate( $slider_post_id );
				//}	
			?>	

	<?php if ( $counter == 1 ): ?><div class="col-xs-12 col-sm-6 col-md-6"><?php endif; ?>		
<?php if ( $counter > 1 ): ?><div class="row small-post"><div class="col-md-12"><?php endif; ?>
<div class="post-grid-block post<?php if ( $counter == 1 ) { echo ' big-post'; } ?>">

  <?php
	
		$argsy = array(
		'width'          => isset($instance['thumb_width']) ? $instance['thumb_width'] : 420,
		'height'         => isset($instance['thumb_height']) ? $instance['thumb_height'] : 330,
		'crop'           => true,
		'single'           => true,
		'gif'          => false,
		'reviewscore'           => true,
        'pinit'          => false,		
        );
 
			            if ( has_post_thumbnail() ) {
						echo '<div class="thumb-container">';
				            buzzblogpro_post_thumbnail( $argsy );   
							echo '</div>';
			            } 
						
						echo '<header class="post-header">'; 
						

						if ($instance['show_category'] !='no'  ) {
						buzzblogpro_post_category('',' '); 
						} 						
						if (isset($instance['show_title']) && $instance['show_title'] != 'no' ) { ?>
	<h2 class="grid-post-title"><a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php esc_attr(the_title()); ?></a></h2>
	<?php } ?>
						

	<?php 
	$whattoshow = array();
	if (isset($instance['show_author']) && $instance['show_author'] != 'no' && $counter == 1 ) {
	$whattoshow[] = 'author';
	}
	if (isset($instance['show_date']) && $instance['show_date'] != 'no' ) {
	$whattoshow[] = 'date';
	}
	if (isset($instance['comment_num']) && $instance['comment_num'] != 'no' && $counter == 1 ) {
	$whattoshow[] = 'comments';
	}
    buzzblogpro_post_meta($whattoshow, true, 'meta-space-top'); 
	
	?>
	
	
	<?php if($excerpt_count >= 1 && $counter == 1){ ?>
	<div class="excerpt">
	<?php $excerpt = get_the_excerpt();
	echo buzzblogpro_limit_text($excerpt,$excerpt_count);
	?>
	</div>
	<?php } ?> 
	<div class="clear"></div>
	<?php if (isset($instance['more_link']) && $instance['more_link'] != 'no' && $counter == 1 ) { ?>
	<div class="viewpost-button"><a class="button" href="<?php esc_url(the_permalink()) ?>"><span><?php echo theme_locals("continue_reading"); ?></span></a></div>
	<?php } ?> 
	</header></div>
<?php if ( $counter > 1 ): ?></div></div><?php endif; ?>
<?php if ( $counter == 1 ): ?></div><div class="col-xs-12 col-sm-6 col-md-6"><?php endif; ?>
<?php if ( $counter == $numers_results ): ?></div><?php endif; ?>
						<?php

			$counter ++;
			
			endwhile;
			wp_reset_postdata();
			
echo '</div>';
 
			?>
		
		<?php endif;  ?>

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
			'title' => '','mostpopular' => 'None','postformat' => 'All','widget_categories' => array(), 'exclude' => 'exclude', 'thumb_width' => '420', 'thumb_height'=> '330','comment_num' => 'yes','show_title' => 'yes','show_date' => 'yes','show_category' => 'yes', 'show_category_link' => 'yes', 'show_author' => 'yes', 'excerpt_length' => '8', 'more_link' => 'no','custom_posts' => '' 
			);
		
		
		
		$instance = array_merge($defaults, (array) $instance);
		extract($instance);
		

  
  $columns_list = esc_attr($instance['columns']); 
  $rows_list = esc_attr($instance['rows']);
  
  $mostpopular_list = esc_attr($instance['mostpopular']);
  $postformat_list = esc_attr($instance['postformat']);
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
<p>
  <label for="<?php echo esc_attr($this->get_field_id("postformat")); ?>">
  <?php esc_html_e('Post Format', 'buzzblogpro'); ?>:
    <select id="<?php echo esc_attr($this->get_field_id("postformat")); ?>" name="<?php echo esc_attr($this->get_field_name("postformat")); ?>">
      <?php
        $postformat_options = array('All', 'Standard', 'Gallery', 'Link', 'Image', 'Audio', 'Video');
            foreach ($postformat_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $postformat_list == $option ? ' selected="selected"' : '', '>', $option, '</option>';
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

  <label for="<?php echo esc_attr($this->get_field_id("exclude")); ?>">
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
<fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php esc_html_e('Thumbnail', 'buzzblogpro'); ?>:</legend>
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
  <legend style="padding:0 5px;"><?php esc_html_e('Post meta', 'buzzblogpro'); ?>:</legend>
<p>
        <label for="<?php echo esc_attr($this->get_field_id("show_title")); ?>">
    <?php esc_html_e( 'Show title', 'buzzblogpro' ); ?>
	<select id="<?php echo esc_attr($this->get_field_id("show_title")); ?>" name="<?php echo esc_attr($this->get_field_name("show_title")); ?>">
      <?php
        $show_title_options = array('yes', 'no');
            foreach ($show_title_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $instance["show_title"] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
  </label>
  </p>
  
<p>
        <label for="<?php echo esc_attr($this->get_field_id("comment_num")); ?>">
    <?php esc_html_e( 'Show number of comments', 'buzzblogpro' ); ?>
	<select id="<?php echo esc_attr($this->get_field_id("comment_num")); ?>" name="<?php echo esc_attr($this->get_field_name("comment_num")); ?>">
      <?php
        $comment_num_options = array('yes', 'no');
            foreach ($comment_num_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $instance["comment_num"] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
  </label>
  </p>
<p>
        <label for="<?php echo esc_attr($this->get_field_id("show_date")); ?>">
    <?php esc_html_e( 'Show date', 'buzzblogpro' ); ?>
	<select id="<?php echo esc_attr($this->get_field_id("show_date")); ?>" name="<?php echo esc_attr($this->get_field_name("show_date")); ?>">
      <?php
        $show_date_options = array('yes', 'no');
            foreach ($show_date_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $instance["show_date"] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
  </label>
  </p>  
<p>
        <label for="<?php echo esc_attr($this->get_field_id("show_category")); ?>">
    <?php esc_html_e( 'Show category', 'buzzblogpro' ); ?>
	<select id="<?php echo esc_attr($this->get_field_id("show_category")); ?>" name="<?php echo esc_attr($this->get_field_name("show_category")); ?>">
      <?php
        $show_category_options = array('yes', 'no');
            foreach ($show_category_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $instance["show_category"] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
  </label>
  </p> 
<p>
        <label for="<?php echo esc_attr($this->get_field_id("show_author")); ?>">
    <?php esc_html_e( 'Show author', 'buzzblogpro' ); ?>
	<select id="<?php echo esc_attr($this->get_field_id("show_author")); ?>" name="<?php echo esc_attr($this->get_field_name("show_author")); ?>">
      <?php
        $show_author_options = array('yes', 'no');
            foreach ($show_author_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $instance["show_author"] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
  </label>
  </p> 
 
 </fieldset>
 <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php esc_html_e('Excerpt', 'buzzblogpro'); ?></legend>
  <p>
      <label for="<?php echo esc_attr($this->get_field_id("excerpt_length")); ?>">
          <?php esc_html_e( 'Excerpt length (words):', 'buzzblogpro' ); ?>
      </label>
      <input style="text-align: center;" type="text" id="<?php echo esc_attr($this->get_field_id("excerpt_length")); ?>" name="<?php echo esc_attr($this->get_field_name("excerpt_length")); ?>" value="<?php echo esc_attr($instance["excerpt_length"]); ?>" size="3" />
  </p>
  </fieldset>
    <fieldset style="border:1px solid #F1F1F1; padding:10px 10px 0; margin-bottom:1em;">
  <legend style="padding:0 5px;"><?php esc_html_e('View the Post Button', 'buzzblogpro'); ?>:</legend>
<p>
        <label for="<?php echo esc_attr($this->get_field_id("more_link")); ?>">
    <?php esc_html_e( 'Show "View the Post"', 'buzzblogpro' ); ?>
	<select id="<?php echo esc_attr($this->get_field_id("more_link")); ?>" name="<?php echo esc_attr($this->get_field_name("more_link")); ?>">
      <?php
        $more_link_options = array('yes', 'no');
            foreach ($more_link_options as $option) {
              echo '<option value="' . $option . '" id="' . $option . '"', $instance["more_link"] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            } ?>
    </select>
  </label>
  </p> 
  
  </fieldset>
<?php
}
}
?>