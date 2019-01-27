<?php
///////////////////////////////////////////
// Twitter Class
///////////////////////////////////////////
class buzzblogpro_Twitter extends WP_Widget {
	
	///////////////////////////////////////////
	// Twitter
	///////////////////////////////////////////
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'twitter', 'description' => esc_html__('A list of latest tweets', 'buzzblogpro') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'buzzblogpro-twitter' );

		/* Create the widget. */
		parent::__construct( 'buzzblogpro-twitter', esc_html__('Hercules - Twitter', 'buzzblogpro'), $widget_ops, $control_ops );
	}
	
	///////////////////////////////////////////
	// Widget
	///////////////////////////////////////////
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$username = isset( $instance['username'] ) ? $instance['username'] : '';
		$show_count = isset( $instance['show_count'] ) ? $instance['show_count'] : 5;
		$hide_timestamp = isset( $instance['hide_timestamp'] ) ? 'false' : 'true';
		$show_follow = isset( $instance['show_follow'] ) ? ''.$instance['show_follow'] : 'false';
		$follow_text = isset( $instance['follow_text'] ) ? $instance['follow_text'] : '';
		$include_retweets = isset( $instance['include_retweets'] ) ? 'true' : 'false';
		$exclude_replies = isset( $instance['exclude_replies'] ) ? 'true' : 'false';
		$widget_id = $this->id;

		/* Before widget (defined by themes). */
		echo wp_kses_post( $args['before_widget'] );

		/* Title of widget (before and after defined by themes). */
			if ( $title ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		} 

		/* remove twitter.com from Twitter ID */
		$username = preg_replace( '/^(https?:\/\/)?twitter.com\//', '', $username );

		echo buzzblogpro_shortcode_twitter(array(
			'username' => $username,
			'show_count' => $show_count,
			'show_timestamp' => $hide_timestamp,
			'show_follow' => $show_follow,
			'follow_text' => $follow_text,
			'include_retweets' => $include_retweets,
			'exclude_replies' => $exclude_replies,
			'is_widget' => 'true',
			'widget_id' => $widget_id
		));

		/* After widget (defined by themes). */
		echo wp_kses_post( $args['after_widget'] );
	}
	
	///////////////////////////////////////////
	// Update
	///////////////////////////////////////////
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = $new_instance['username'];
		$instance['show_count'] = $new_instance['show_count'];
		$instance['hide_timestamp'] = $new_instance['hide_timestamp'];
		$instance['show_follow'] = $new_instance['show_follow'];
		$instance['follow_text'] = $new_instance['follow_text'];
		$instance['include_retweets'] = $new_instance['include_retweets'];
		$instance['exclude_replies'] = $new_instance['exclude_replies'];

		// delete transient
		delete_transient( $this->id . '_buzzblogpro_tweets' );

		return $instance;
	}
	
	///////////////////////////////////////////
	// Form
	///////////////////////////////////////////
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html__('Latest Tweets', 'buzzblogpro'),
			'username' => '',
			'show_count' => 5,
			'hide_timestamp' => false,
			'show_follow' => true,
			'follow_text' => esc_html__('&rarr; Follow me', 'buzzblogpro'),
			'include_retweets' => false,
			'exclude_replies' => true
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'buzzblogpro'); ?></label><br />
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e('Twitter Username:', 'buzzblogpro'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" value="<?php echo esc_attr( $instance['username'] ); ?>" type="text"/>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>"><?php esc_html_e('Show:', 'buzzblogpro'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_count' ) ); ?>" value="<?php echo esc_attr( $instance['show_count'] ); ?>" size="3" type="text" /> <?php esc_html_e('tweets', 'buzzblogpro'); ?>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['hide_timestamp'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'hide_timestamp' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_timestamp' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'hide_timestamp' ) ); ?>"><?php esc_html_e('Hide timestamp', 'buzzblogpro'); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_follow'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_follow' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_follow' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_follow' ) ); ?>"><?php esc_html_e('Display follow me button', 'buzzblogpro'); ?></label>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'follow_text' ) ); ?>"><?php esc_html_e('Follow me text:', 'buzzblogpro'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'follow_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'follow_text' ) ); ?>" value="<?php echo esc_attr( $instance['follow_text'] ); ?>" type="text" />
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['include_retweets'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'include_retweets' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'include_retweets' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'include_retweets' ) ); ?>"><?php esc_html_e('Include retweets', 'buzzblogpro'); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['exclude_replies'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'exclude_replies' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_replies' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'exclude_replies' ) ); ?>"><?php esc_html_e('Exclude replies', 'buzzblogpro'); ?></label>
		</p>
		
		<p>
			<?php esc_html_e('Twitter access token is required at Appearance -> Theme Options -> Twitter Settings', 'buzzblogpro'); ?>
		</p>
		
		<?php
	}
}

/**
 * Display tweets by user
 * @param array $atts
 * @param String $content
 * @return String
 */
function buzzblogpro_shortcode_twitter( $atts, $content = null ) {
	global $buzzblogpro_twitter_instance;
	$buzzblogpro_twitter_instance++;
$random = buzzblogpro_gener_random(10);
if (is_rtl()) {$rtl_slide = 'true';}else{$rtl_slide = 'false';}
	extract(shortcode_atts(array(
		'username' => '',
		'show_count' => 5,
		'show_timestamp' => 'true',
		'show_follow' => 'false',
		'follow_text' => esc_html__('&rarr; Follow me', 'buzzblogpro'),
		'include_retweets' => 'false',
		'exclude_replies' => 'false',
		'is_widget' => 'false',
		'widget_id' => ''
	), $atts, 'buzzblogpro_twitter' ));
	
	$is_shortcode = '';
	$transient_id = $buzzblogpro_twitter_instance . '_' . get_the_ID();
	if ( 'false' == $is_widget ) {
		$is_shortcode = 'shortcode';
	}

	if ( 'true' == $is_widget ) {
		$transient_id = $widget_id;
	}

	$args = array(
		'username' => sanitize_user( strip_tags( $username ) ),
		'limit' => intval( $show_count ),
		'include_retweets' => $include_retweets,
		'exclude_replies' => $exclude_replies
	);

	$tweets = buzzblogpro_twitter_get_data( $transient_id, $args );
	if( $username =='' ) {
		echo esc_html__('Enter your Twitter username', 'buzzblogpro').'<br />';
	}
	if( is_array( $tweets ) && isset( $tweets['error_message'] ) ) {
		return $tweets['error_message'];
	}

	$out = '<div class="twitter-list '.$is_shortcode.'">
			<div id="twitter-block-'.$buzzblogpro_twitter_instance.'"><i class="hs hs-twitter"></i>';

	if ( is_array( $tweets ) && count( $tweets ) > 0 ) {
		$out .= '<div id="owl-carousel-'.$random.'" class="owl-carousel twitter-list" data-howmany="'.intval( $show_count ).'" data-margin="10" data-items="1" data-tablet="1" data-mobile="1"  data-auto-play="true" data-auto-play-timeout="5000" data-nav="false" data-rtl="'.$rtl_slide.'" data-pagination="true">';

		foreach( $tweets as $tweet ) {
			$text = $tweet->text;
			foreach ( $tweet->entities as $type => $entity ) {
				if( 'urls' == $type ) {
					foreach($entity as $j => $url) {
						$update_with = '<a href="' . esc_url( $url->url ) . '" target="_blank" title="' . esc_attr( $url->expanded_url ) . '" class="twitter-user">' . $url->display_url . '</a>';
						$text = str_replace($url->url, $update_with, $text);
					}
				} elseif ( 'hashtags' == $type ) {
					foreach($entity as $j => $hashtag) {
						$update_with = '<a href="' . esc_url( '//twitter.com/search?q=%23' . $hashtag->text . '&src=hash' ) . '" target="_blank" title="' . esc_attr( $hashtag->text ) . '" class="twitter-user">#' . $hashtag->text . '</a>';
						$text = str_replace('#'.$hashtag->text, $update_with, $text);
					}
				} elseif ( 'user_mentions' == $type ) {
					foreach($entity as $j => $user) {
						$user->screen_name = str_replace( '@', '', $user->screen_name );
						$update_with = '<a href="' . esc_url( '//twitter.com/' . $user->screen_name ) . '" target="_blank" title="' . esc_attr( $user->name ) . '" class="twitter-user">@' . $user->screen_name . '</a>';
						$text = str_replace('@'.$user->screen_name, $update_with, $text);
					}
				} elseif ( 'media' == $type ) {
					foreach ( $entity as $j => $media ) {
						$update_with = '<a href="' . esc_url( $media->url ) . '" target="_blank" title="' . esc_attr( $media->expanded_url ) . '" class="twitter-media">' . $media->display_url . '</a>';
						$text = str_replace( $media->url, $update_with, $text );
					}
				}
			}
			$out .= '<div class="twitter-item">'.$text;
			if ( 'false' != $show_timestamp ) {
				// hour ago time format
				$time = sprintf( esc_html__('%s ago', 'buzzblogpro'), human_time_diff( strtotime( $tweet->created_at ) ) );
				$out .= '<br /><em class="twitter-timestamp"><small>' . wp_kses_post( $time ) . '</small></em>';
			}
			$out .= '</div>';
		}
		$out .= '</div>';
	}
	$out .= '</div>';
	if ( 'false' != $show_follow ) {
		$out .= '<div class="follow-me-btn"><a target="_blank" class="btn btn-default btn-normal" href="' . esc_url( '//twitter.com/' . $username ) . '">' . $follow_text . '</a></div>';
	}

	$out .= '</div>';

	return $out;
}

/**
 * Get twitter data store from cache
 * @param $transient_id
 * @param $args
 * @return array|mixed
 */
function buzzblogpro_twitter_get_data ( $transient_id, $args ) {
	$data = array();
	$transient_key = $transient_id . '_buzzblogpro_tweets';

	$transient = get_transient( $transient_key );
	
	if ( false === $transient ) {
		$response = buzzblogpro_request_tweets( $args );

		if ( ! is_wp_error( $response ) && is_array( $response ) && ( isset( $response[0]->user->id ) || isset( $response['error_message'] ) ) ) {
			$data = $response;
			set_transient( $transient_key, $data, 60 * 60 ); // 60 min cache
		}
	} else {
		$data = $transient;
	}

	return $data;
}

/**
 * Get request tweets from service api
 * @param $args
 * @return bool|object
 */
function buzzblogpro_request_tweets($args) {
	$prefix = 'setting-twitter_settings_';
	
	$screen_name = urlencode(strip_tags( sanitize_user( str_replace( '@', '', $args['username'] ) ) ));
	
	if ( $args['limit'] != '' ) {
		$count = intval( $args['limit'] );
	}
	if ( $args['include_retweets'] == 'true' ) {
		$include_rts = '1';
	} else {
		$include_rts = '0';
	}
	$exclude_replies = $args['exclude_replies'];
	
	$consumer_key = buzzblogpro_getVariable('twitter_consumer_key');
	$consumer_secret = buzzblogpro_getVariable('twitter_consumer_secret');

	if ( ! class_exists( 'Wp_Twitter_Api' ) ) {
		// Require twitter oauth class
		require 'twitteroauth/class-wp-twitter-api.php';
	}
	$credentials = apply_filters( 'buzzblogpro_twitter_credentials', array(
				'consumer_key' => $consumer_key,
		'consumer_secret' => $consumer_secret
	) );

	$query = 'screen_name='.$screen_name.'&count='.$count.'&include_rts='.$include_rts.'&exclude_replies='.$exclude_replies.'&include_entities=true';
	
	$twitterConnection = new Wp_Twitter_Api( $credentials );
	$tweets = $twitterConnection->query($query);
	
	return $tweets;
}

/**
 * Flush transient when post is saved.
 * @param $post_id
 */
function buzzblogpro_twitter_flush_transient( $post_id ) {
	//verify post is not a revision
	if ( ! wp_is_post_revision( $post_id ) ) {
		// Count unprefixed and/or prefixed shortcode instances
		$post_content = '';
		if ( isset( $_POST['content'] ) ) {
			$post_content = $_POST['content'];
		}
		$unprefixed_shortcode = substr_count($post_content, '[twitter');
		$prefixed_shortcode = substr_count($post_content, '[buzzblogpro-twitter');
		$shortcode_count = $unprefixed_shortcode + $prefixed_shortcode;
		if ( $shortcode_count > 0 ) {
			// delete transients
			for ($i=1; $i <= $shortcode_count; $i++) { 
				delete_transient( $i.'_'.$post_id.'_buzzblogpro_tweets' );
			}
		}
	}
}