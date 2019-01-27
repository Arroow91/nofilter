<?php
/*
Hercules WP Instagram Widget
*/
class buzzblogpro_InstagramWidget extends WP_Widget {
function __construct() {
$widget_ops = array(
'classname' => 'instagram',
'description' => esc_html__('A widget that displays the latest Instagram images', 'buzzblogpro' )
);
parent::__construct( 'instagram-widget', esc_html__('Hercules - Instagram', 'buzzblogpro' ), $widget_ops );
}   // Widget Settings


function widget( $args, $instance ) {

				$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$username = empty( $instance['username'] ) ? '' : $instance['username'];
		$number = empty( $instance['number'] ) ? 6 : $instance['number'];
		$size = empty( $instance['size'] ) ? 'large' : $instance['size'];
		$target = empty( $instance['target'] ) ? '_self' : $instance['target'];
		$showtitle = empty( $instance['showtitle'] ) ? 'show' : $instance['showtitle'];
		$link = empty( $instance['link'] ) ? '' : $instance['link'];

		echo wp_kses_post( $args['before_widget'] );

 
		do_action( 'wpiw_before_widget', $instance );

		if ( $username != '' ) {

			//$media_array = $this->scrape_instagram( $username, $number );

			$media_array = $this->scrape_instagram( $username );
			
			
			if ( is_wp_error( $media_array ) ) {

				echo wp_kses_post( $media_array->get_error_message() );

			} else {

				// filter for images only?
				if ( $images_only = apply_filters( 'wpiw_images_only', FALSE ) )
					$media_array = array_filter( $media_array, array( $this, 'images_only' ) );

				// slice list down to required limit.
				$media_array = array_slice( $media_array, 0, $number );
				
				// filters for custom classes
				$ulclass = '';
				if($number == 8) {$ulclass = 'eight';}
				if($number == 10) {$ulclass = 'ten';}
				
				switch ($size) {
		case 'large':
			$img_dimensions = 'width="640" height="640"';
		break;
		case 'thumbnail':
			$img_dimensions = 'width="160" height="160"';
		break;
		case 'small':
			$img_dimensions = 'width="320" height="320"';
		break;
		case 'original':
			$img_dimensions = '';
		break;
	}
				
				
				$liclass = apply_filters( 'wpiw_item_class', '' );
				$aclass = apply_filters( 'wpiw_a_class', '' );
				$imgclass = apply_filters( 'wpiw_img_class', '' );

				?><div class="imgs_wrapper instagram <?php echo esc_attr( $ulclass ); ?>"><div class="images clearfix">
				<?php if ( $showtitle != 'hide' ) { ?>
				<div class="instagram_footer_heading">
				<?php
				
				
			echo wp_kses_post( $args['before_title'] . '<span>'.$title);
		
			$linkclass = apply_filters( 'wpiw_link_class', '' );

				switch ( substr( $username, 0, 1 ) ) {
			case '#':
				$url = '//instagram.com/explore/tags/' . str_replace( '#', '', $username );
				break;

			default:
				$url = '//instagram.com/' . str_replace( '@', '', $username );
				break;
		}	
			
		if ( $link != '' ) {
			?><a class="instagram-follow-btn" href="<?php echo trailingslashit( esc_url( $url ) ); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>">@<?php echo wp_kses_post( $link ); ?></a>
			<?php
		}
		echo '</span>'. wp_kses_post($args['after_title'] ); ?>
		</div> 
		<?php } ?>
		<?php
				foreach ( $media_array as $item ) {
					
					
				echo '<figure class="effect-bubba">
						<a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'"  class="overlay-button '. esc_attr( $aclass ) .'"></a><img class="lazyload" data-src="'. esc_url( $item[$size] ) .'" alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'" '.$img_dimensions.' />
						<figcaption> 
							<p class="icon-links">
								<span class="icon-heart"><i class="fa fa-heart-o"></i>'. $item['likes'] .'</span>
								<span class="icon-comment"><i class="fa fa-comment-o"></i>'.$item['comments'].'</span>
								
							</p>
							<p class="description">'.wp_trim_words( $item['description'], 5, '...' ).'</p>
						</figcaption>			
					</figure>';
					
					
				}
								
				?></div></div><?php
			}
		}

	

		do_action( 'wpiw_after_widget', $instance );

		echo wp_kses_post( $args['after_widget'] );
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => esc_html__( 'Instagram', 'buzzblogpro'  ), 'username' => '', 'number' => '', 'size' => 'large', 'link' => esc_html__( 'Follow Me!', 'buzzblogpro'  ), 'target' => '_self', 'showtitle' => 'show' ) );
		$title = $instance['title'];
		$username = $instance['username'];
		$number = absint( $instance['number'] );
		$size = $instance['size'];
		$target = $instance['target'];
		$showtitle = $instance['showtitle'];
		$link = $instance['link'];
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'buzzblogpro'  ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username', 'buzzblogpro'  ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" /></label></p>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of photos', 'buzzblogpro' ); ?>:</label>
			<select id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" class="widefat">
				<option value="6" <?php selected( '6', $number ) ?>><?php esc_html_e( '6', 'buzzblogpro' ); ?></option>
				<option value="8" <?php selected( '8', $number ) ?>><?php esc_html_e( '8', 'buzzblogpro' ); ?></option>
				<option value="10" <?php selected( '10', $number ) ?>><?php esc_html_e( '10', 'buzzblogpro' ); ?></option>
				<option value="12" <?php selected( '12', $number ) ?>><?php esc_html_e( '12', 'buzzblogpro' ); ?></option>
			</select>
		</p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Photo size', 'buzzblogpro'  ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" class="widefat">
				<option value="thumbnail" <?php selected( 'thumbnail', $size ) ?>><?php esc_html_e( 'Thumbnail', 'buzzblogpro'  ); ?></option>
				<option value="small" <?php selected( 'small', $size ) ?>><?php esc_html_e( 'Small', 'buzzblogpro'  ); ?></option>
				<option value="large" <?php selected( 'large', $size ) ?>><?php esc_html_e( 'Large', 'buzzblogpro'  ); ?></option>
				<option value="original" <?php selected( 'original', $size ) ?>><?php esc_html_e( 'Original', 'buzzblogpro'  ); ?></option>
			</select>
		</p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open links in', 'buzzblogpro'  ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" class="widefat">
				<option value="_self" <?php selected( '_self', $target ) ?>><?php esc_html_e( 'Current window (_self)', 'buzzblogpro'  ); ?></option>
				<option value="_blank" <?php selected( '_blank', $target ) ?>><?php esc_html_e( 'New window (_blank)', 'buzzblogpro'  ); ?></option>
			</select>
		</p>
				<p><label for="<?php echo esc_attr( $this->get_field_id( 'showtitle' ) ); ?>"><?php esc_html_e( 'Show title', 'buzzblogpro'  ); ?>?</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'showtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showtitle' ) ); ?>" class="widefat">
				<option value="show" <?php selected( 'show', $showtitle ) ?>><?php esc_html_e( 'show', 'buzzblogpro'  ); ?></option>
				<option value="hide" <?php selected( 'hide', $showtitle ) ?>><?php esc_html_e( 'hide', 'buzzblogpro'  ); ?></option>
			</select>
		</p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link text', 'buzzblogpro'  ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" /></label></p>
		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = trim( strip_tags( $new_instance['username'] ) );
		$instance['number'] = ! absint( $new_instance['number'] ) ? 6 : $new_instance['number'];
		$instance['size'] = ( ( $new_instance['size'] == 'thumbnail' || $new_instance['size'] == 'large' || $new_instance['size'] == 'small' || $new_instance['size'] == 'original' ) ? $new_instance['size'] : 'large' );
		$instance['target'] = ( ( $new_instance['target'] == '_self' || $new_instance['target'] == '_blank' ) ? $new_instance['target'] : '_self' );
		$instance['showtitle'] = ( ( $new_instance['showtitle'] == 'show' || $new_instance['showtitle'] == 'hide' ) ? $new_instance['showtitle'] : 'show' );
		$instance['link'] = strip_tags( $new_instance['link'] );
		return $instance;
	}

	
	function scrape_instagram( $username ) {

		$username = trim( strtolower( $username ) );

		switch ( substr( $username, 0, 1 ) ) {
			case '#':
				$url              = 'https://instagram.com/explore/tags/' . str_replace( '#', '', $username );
				$transient_prefix = 'h';
				break;

			default:
				$url              = 'https://instagram.com/' . str_replace( '@', '', $username );
				$transient_prefix = 'u';
				break;
		}

		if ( false === ( $instagram = get_transient( 'instagram-hss-' . sanitize_title_with_dashes( $username ) ) ) ) {

			$remote = wp_remote_get( $url );

			if ( is_wp_error( $remote ) ) {
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'wp-instagram-widget' ) );
			}

			if ( 200 !== wp_remote_retrieve_response_code( $remote ) ) {
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'wp-instagram-widget' ) );
			}

			$shards      = explode( 'window._sharedData = ', $remote['body'] );
			$insta_json  = explode( ';</script>', $shards[1] );
			$insta_array = json_decode( $insta_json[0], true );

			if ( ! $insta_array ) {
				return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'wp-instagram-widget' ) );
			}

			if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
			} elseif ( isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
				$images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
			} else {
				return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'wp-instagram-widget' ) );
			}

			if ( ! is_array( $images ) ) {
				return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'wp-instagram-widget' ) );
			}

			$instagram = array();

			foreach ( $images as $image ) {
				if ( true === $image['node']['is_video'] ) {
					$type = 'video';
				} else {
					$type = 'image';
				}

				$caption = __( 'Instagram Image', 'wp-instagram-widget' );
				if ( ! empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
					$caption = wp_kses( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'], array() );
				}

				$instagram[] = array(
					'description' => $caption,
					'link'        => trailingslashit( '//instagram.com/p/' . $image['node']['shortcode'] ),
					'time'        => $image['node']['taken_at_timestamp'],
					'comments'    => $image['node']['edge_media_to_comment']['count'],
					'likes'       => $image['node']['edge_liked_by']['count'],
					'thumbnail'   => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ),
					'small'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ),
					'large'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src'] ),
					'original'    => preg_replace( '/^https?\:/i', '', $image['node']['display_url'] ),
					'type'        => $type,
				);
			} // End foreach().

    
			// do not set an empty transient - should help catch private or empty accounts
			if ( ! empty( $instagram ) ) {
				$instagram = json_encode( serialize( $instagram ) );
				set_transient( 'instagram-hss-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
			}
		}

		if ( ! empty( $instagram ) ) {

			$instagram = unserialize( json_decode( $instagram ) );
			return $instagram;

		} else {

			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'buzzblogpro'  ) );

		}
	}

	function images_only( $media_item ) {

		if ( 'image' === $media_item['type'] ) {
			return true;
		}

		return false;
	}
}
?>