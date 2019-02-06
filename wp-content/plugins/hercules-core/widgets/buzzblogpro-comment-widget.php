<?php
class buzzblogpro_CommentWidget extends WP_widget {

		function __construct() {

		$widget_ops = array(
			'classname' => 'widget_my_recent_comments', 
			'description' => esc_html__('Recent Comments', 'buzzblogpro') 
		);

		parent::__construct(
			'buzzblogpro_CommentWidget',
			esc_html__('Hercules - Recent Comments', 'buzzblogpro'),
			$widget_ops
		);

	}

	function widget( $args, $instance ) {
		global $wpdb, $comments, $comment;

		extract( $args, EXTR_SKIP );

		$title               = apply_filters('widget_title', empty($instance['title']) ? esc_html__('My Recent Comments', 'buzzblogpro') : $instance['title']);
		$comments_count      = apply_filters('widget_title', empty($instance['comments_count']) ? 5 : $instance['comments_count']);
		$display_avatar      = apply_filters('widget_display_avatar', empty($instance['display_avatar']) ? esc_html__('off', 'buzzblogpro') : esc_html__('on', 'buzzblogpro') );
		$avatar_size         = apply_filters('widget_avatar_size', empty($instance['avatar_size']) ? esc_html__('48', 'buzzblogpro') : $instance['avatar_size']);
		$display_author_name = apply_filters('widget_display_author_name', empty($instance['display_author_name']) ? esc_html__('off', 'buzzblogpro') : esc_html__('on', 'buzzblogpro') );
		$display_date        = apply_filters('widget_display_date', empty($instance['display_date']) ? esc_html__('off', 'buzzblogpro') : esc_html__('on', 'buzzblogpro') );
		$display_post_title  = apply_filters('widget_display_post_title', empty($instance['display_post_title']) ? esc_html__('off', 'buzzblogpro') : esc_html__('on', 'buzzblogpro') );
		$meta_format         = apply_filters('widget_meta_format', empty($instance['meta_format']) ? 'none' : $instance['meta_format'] );

		if ( $comments_count < 1 ) {
			$comments_count = 1;
		} else if ( $comments_count > 15 ) {
			$comments_count = 15;
		}
		$comment_len = 100;

		if ( function_exists( 'wpml_get_language_information' ) ) {
			global $sitepress;

			$sql = "
				SELECT * FROM {$wpdb->comments}
				JOIN {$wpdb->prefix}icl_translations
				ON {$wpdb->comments}.comment_post_id = {$wpdb->prefix}icl_translations.element_id
				AND {$wpdb->prefix}icl_translations.element_type='post_post'
				WHERE comment_approved = '1'
				AND language_code = '".$sitepress->get_current_language()."'
				ORDER BY comment_date_gmt DESC LIMIT {$comments_count}";
		} else {
			$sql = "
				SELECT * FROM $wpdb->comments
				LEFT OUTER JOIN $wpdb->posts
				ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
				WHERE comment_approved = '1'
				AND comment_type not in ('pingback','trackback')
				AND post_password = ''
				AND post_type in ('post','page','attachment','portfolio')
				ORDER BY comment_date_gmt
				DESC LIMIT {$comments_count}";
		}

		if ( !$comments = wp_cache_get( 'recent_comments', 'widget' ) ) {
			$comments = $wpdb->get_results($sql);
			wp_cache_add( 'recent_comments', $comments, 'widget' );
		}

		$comments = array_slice( (array) $comments, 0, $comments_count );
?>
		<?php echo wp_kses_post( $args['before_widget'] ); ?>
			<?php if ( $title ) echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] ); ?>
		<ul class="comments-custom unstyled"><?php
			if ( $comments ) : foreach ( (array) $comments as $comment) : ?>

			<li class="comments-custom_li"><div class="small">
				<?php if ( function_exists( 'get_avatar' ) && $display_avatar != esc_html__('off', 'buzzblogpro') ) {
					//echo '<figure class="thumbnail featured-thumbnail">';
						$comment_ID = get_comment_ID();
						echo get_avatar( get_comment( $comment_ID )->comment_author_email, $avatar_size );
					//echo '</figure>';
				} ?>
				<?php if($display_post_title != esc_html__('off', 'buzzblogpro')) {
					$post_ID = $comment->comment_post_ID;
					$title_format = "";
					if($meta_format=="labels"){
						$title_format = '<span class="ladle">'.esc_html_e('Comment in', 'buzzblogpro').':</span> ';
					}
					echo '<div class="meta_format">'.$title_format.'<h6 class="comments-custom_h_title"><a href="'.get_permalink($post_ID).'" title="'.get_post($post_ID)->post_title.'">'.get_post($post_ID)->post_title.'</a></h6></div>';
				}?>
				<?php if($display_author_name != esc_html__('off', 'buzzblogpro')) {
					$title_author_name = "";
					if($meta_format=="icons"){
						$title_author_name = '<i class="fa fa-user"></i> ';
					} else  if($meta_format=="labels"){
						$title_author_name = '<span class="ladle">'.esc_html_e('Author', 'buzzblogpro').':</span> ';
					}
					echo esc_html( $title_author_name).'<span class="comments-custom_h_author">'.esc_attr( $comment->comment_author).'</span>';
				}?>
				<?php
				if($display_date != esc_html__('off', 'buzzblogpro')) {
					$title_date = "";
					if($meta_format=="icons"){
						$title_date = '<i class="fa fa-clock-o"></i> ';
					} else  if($meta_format=="labels"){
						$title_date = '<span class="ladle">'.esc_html_e('Date', 'buzzblogpro').':</span> ';
					}
					$comment_date = get_comment_date();
					$comment_time = get_comment_time();
					echo  ' | '.$title_date.'<time datetime="'.date('Y-m-d\TH:i:s', strtotime($comment_date.$comment_time)).'">'.$comment_date.' '.$comment_time.'</time>';
				}?></div>
			<div class="clear"></div>
				<div class="comments-custom_txt">
					<a href="<?php echo get_comment_link( $comment->comment_ID ); ?>" title="<?php esc_html_e('Go to this comment', 'buzzblogpro'); ?>"><?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len)); if (strlen($comment->comment_content) > $comment_len) echo '...';?></a>
				</div>
			</li>
		<?php
			endforeach; endif;?>
		</ul>
		<?php echo wp_kses_post( $args['after_widget'] ); ?>
<?php
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['comments_count'] = strip_tags( $new_instance['comments_count'] );
		$instance['avatar_size'] = $new_instance['avatar_size'];
		$instance['display_author_name'] = $new_instance['display_author_name'];
		$instance['display_avatar'] = $new_instance['display_avatar'];
		$instance['display_date'] = $new_instance['display_date'];
		$instance['display_post_title'] = $new_instance['display_post_title'];
		$instance['meta_format'] = $new_instance['meta_format'];

		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance) {
		$defaults = array( 'title' => esc_html__('My Recent Comments', 'buzzblogpro'), 'comments_count' => '5', 'display_avatar' => esc_html__('on', 'buzzblogpro'), 'avatar_size' => esc_html__('48', 'buzzblogpro'),  'display_author_name' => esc_html__('on', 'buzzblogpro'), 'display_date' => esc_html__('on', 'buzzblogpro'), 'display_post_title' => esc_html__('on', 'buzzblogpro'), 'meta_format' => 'none' );
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = esc_attr($instance['title']);
		$comments_count = esc_attr($instance['comments_count']);
		$avatar_size = esc_attr($instance['avatar_size']);
		$display_author_name = esc_attr($instance['display_author_name']);
		$display_avatar = esc_attr($instance['display_avatar']);
		$display_date = esc_attr($instance['display_date']);
		$display_post_title = esc_attr($instance['display_post_title']);
		$meta_format = esc_attr($instance['meta_format']);

		?>
		<p><label for="<?php esc_attr( $this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'buzzblogpro').":"; ?><input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title')); ?>" name="<?php echo esc_attr( $this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title); ?>" /></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('comments_count')); ?>"><?php esc_html_e('Number of comments to show', 'buzzblogpro'); ?><input class="widefat" id="<?php echo esc_attr( $this->get_field_id('comments_count')); ?>" name="<?php echo esc_attr( $this->get_field_name('comments_count')); ?>" type="text" value="<?php echo esc_attr( $comments_count); ?>" /></label></p>
		<p><input class="checkbox" id="<?php echo esc_attr( $this->get_field_id('display_avatar')); ?>" name="<?php echo esc_attr( $this->get_field_name('display_avatar')); ?>" type="checkbox" <?php checked( $instance['display_avatar'], esc_html__('on', 'buzzblogpro') ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id('display_avatar')); ?>"><?php esc_html_e('Display avatar', 'buzzblogpro'); ?></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('avatar_size')); ?>"><?php esc_html_e('Avatar size (px)', 'buzzblogpro'); ?>
			<select id="<?php echo esc_attr( $this->get_field_id('avatar_size')); ?>" name="<?php echo esc_attr( $this->get_field_name('avatar_size')); ?>" style="width:80px;" >
				<option value="128" <?php echo ($avatar_size === esc_html__('128', 'buzzblogpro') ? ' selected="selected"' : ''); ?>><?php echo esc_html__('128x128', 'buzzblogpro');?></option>
				<option value="96" <?php echo ($avatar_size === esc_html__('96', 'buzzblogpro') ? ' selected="selected"' : ''); ?>><?php echo esc_html__('96x96', 'buzzblogpro');?></option>
				<option value="64" <?php echo ($avatar_size === esc_html__('64', 'buzzblogpro') ? ' selected="selected"' : ''); ?>><?php echo esc_html__('64x64', 'buzzblogpro'); ?></option>
				<option value="48" <?php echo ($avatar_size === esc_html__('48', 'buzzblogpro') ? ' selected="selected"' : ''); ?>><?php echo esc_html__('48x48', 'buzzblogpro'); ?></option>
				<option value="32" <?php echo ($avatar_size === esc_html__('32', 'buzzblogpro') ? ' selected="selected"' : ''); ?>><?php echo esc_html__('32x32', 'buzzblogpro'); ?></option>
			</select> 
		</label></p>
		<p><input class="checkbox" id="<?php echo esc_attr( $this->get_field_id('display_author_name')); ?>" name="<?php echo esc_attr( $this->get_field_name('display_author_name')); ?>" type="checkbox" <?php checked( $instance['display_author_name'], esc_html__('on', 'buzzblogpro') ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id('display_author_name')); ?>"><?php esc_html_e('Display the comment author', 'buzzblogpro'); ?></label></p>
		<p><input class="checkbox" id="<?php echo esc_attr( $this->get_field_id('display_date')); ?>" name="<?php echo esc_attr( $this->get_field_name('display_date')); ?>" type="checkbox" <?php checked( $instance['display_date'], esc_html__('on', 'buzzblogpro') ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id('display_date')); ?>"><?php esc_html_e('Display the comment date', 'buzzblogpro'); ?></label></p>
		<p><input class="checkbox" id="<?php echo esc_attr( $this->get_field_id('display_post_title')); ?>" name="<?php echo esc_attr( $this->get_field_name('display_post_title')); ?>" type="checkbox" <?php checked( $instance['display_post_title'], esc_html__('on', 'buzzblogpro') ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id('display_post_title')); ?>"><?php esc_html_e('Display post title', 'buzzblogpro'); ?></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('meta_format')); ?>"><?php esc_html_e('Meta format', 'buzzblogpro'); ?><br />
			<select id="<?php echo esc_attr( $this->get_field_id('meta_format')); ?>" name="<?php echo esc_attr( $this->get_field_name('meta_format')); ?>" style="width:150px;" >
				<option value="none" <?php echo ($meta_format === 'none' ? ' selected="selected"' : ''); ?>><?php esc_html_e('None', 'buzzblogpro') ?></option>
				<option value="icons" <?php echo ($meta_format === 'icons' ? ' selected="selected"' : ''); ?>><?php esc_html_e('Icons', 'buzzblogpro') ?></option>
				<option value="labels" <?php echo ($meta_format === 'labels' ? ' selected="selected"' : ''); ?>><?php esc_html_e('Labels', 'buzzblogpro') ?></option>
			</select>
		</label></p>
		<?php
	}
} 
?>