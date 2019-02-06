<?php
if ( ! class_exists( 'Buzzblogpro_Pinterest' ) ):

	class Buzzblogpro_Pinterest {

		// Pinterest url
		var $pinterest_feed = 'https://pinterest.com/%s/feed.rss';
		var $pinterest_feed_board = 'https://pinterest.com/%s/%s.rss';
		
		var $start_time;

		function __construct() {
			$this->start_time = microtime( true );
		}

		// Render the pinboard and output
		function render_html( $username, $boardname, $numbers, $cache_time = 1200, $follow = true ) {
			$pins = $this->get_pins( $username, $boardname, $numbers, $cache_time );
			if ( is_null( $pins ) ) {
				echo( "Unable to load Pinterest pins for '$username'\n" );
			}
			else {
				echo '<div class="images clearfix">';
				foreach ( $pins as $pin ) {
					$title = $pin['title'];
					$url   = $pin['url'];
					$image = $pin['image'];

					echo '<figure class="effect-bubba"><a class="overlay-button" href="' . esc_url( $url ) . '" title="' . esc_attr( $title ) . '" target="_blank" alt="' . esc_attr( $title ) . '"></a><img class="buzzblogpro-image-holder lazyload" data-src="' . esc_url( $image ) . '" width="90" height="90" /></figure>';
				}
			}
			?>
			</div>
			<?php if ( $follow ): ?>
				<div class="pinit-url">
					<a href="https://pinterest.com/<?php echo sanitize_text_field( $username ); ?>/" target="_blank">@<?php echo sanitize_text_field( $username ); ?></a>
				</div>
			<?php endif; ?>
		<?php
		}

		function get_pins( $username, $boardname, $numbers, $cache_time = 1200 ) {

			//if( !is_numeric( $cache_time ) && $cache_time < 1 ): $cache_time = 1200; endif;
			// Set caching.
			
			//add_filter( 'wp_feed_cache_transient_lifetime', function($a) { return $cache_time; } );

			// Get the RSS feed.
			if($boardname) {
			$url = sprintf( $this->pinterest_feed_board, $username, $boardname );
			}else{
			$url = sprintf( $this->pinterest_feed, $username );
			}
			$rss = fetch_feed( $url );
			if ( is_wp_error( $rss ) ) {
				return null;
			}

			$maxitems  = $rss->get_item_quantity( $numbers );
			$rss_items = $rss->get_items( 0, $maxitems );

			$pins;
			if ( is_null( $rss_items ) ) {
				$pins = null;
			}
			else {

				// Build patterns to search/replace in the image urls
				$search  = array( '_b.jpg' );
				$replace = array( '_t.jpg' );

				// Make url protocol relative
				array_push( $search, 'https://' );
				array_push( $replace, '//' );

				$pins = array();
				foreach ( $rss_items as $item ) {
					$title       = $item->get_title();
					$description = $item->get_description();
					$url         = $item->get_permalink();
					if ( preg_match_all( '/<img src="([^"]*)".*>/i', $description, $matches ) ) {
						$image = str_replace( $search, $replace, $matches[1][0] );
					}
					array_push( $pins, array(
						'title' => $title,
						'image' => $image,
						'url'   => $url
					) );
				}
			}

			return $pins;
		}
	}

endif; /* End check if class exists */

class Buzzblogpro_Pinterest_Widget extends WP_Widget {

	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname'   => 'buzzblogpro_pinterest_widget',
							 'description' => esc_html__( 'A widget that display pinterest images.', 'buzzblogpro' )
		);

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'buzzblogpro_pinterest_widget' );

		/* Create the widget. */
		global $wp_version;
		if ( 4.3 > $wp_version ) {
			$this->WP_Widget( 'buzzblogpro_pinterest_widget', esc_html__( 'Hercules - Pinterest Widget', 'buzzblogpro' ), $widget_ops, $control_ops );
		}
		else {
			parent::__construct( 'buzzblogpro_pinterest_widget', esc_html__( 'Hercules - Pinterest Widget', 'buzzblogpro' ), $widget_ops, $control_ops );
		}
	}

	function widget( $args, $instance ) {
		extract( $args );

		echo ent2ncr( $before_widget );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo ent2ncr( $before_title . $title . $after_title );

		echo '<div class="buzzblogpro-pinterest-widget-container imgs_wrapper">';

		// Render the pinboard from the widget settings.
		$username = $instance['username'];
		$boardname = $instance['boardname'] ? $instance['boardname'] : '';
		$numbers  = $instance['numbers'];
		$follow   = $instance['follow'];
		$cache    = $instance['cache'] ? $instance['cache'] : 7200;

		$pinboard = new Buzzblogpro_Pinterest();
		$pinboard->render_html( $username, $boardname, $numbers, $cache, $follow );

		echo '</div>';

		echo ent2ncr( $after_widget );
	}

	function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['boardname'] = strip_tags( $new_instance['boardname'] );
		$instance['numbers']  = absint( $new_instance['numbers'] );
		$instance['follow']   = $new_instance['follow'];
		$instance['cache']    = $new_instance['cache'];

		return $instance;
	}

	function form( $instance ) {
		// load current values or set to default.
		$defaults = array( 'title' => 'On Pinterest', 'username' => 'username', 'boardname' => '', 'numbers' => '9', 'cache' => '7200', 'follow' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'buzzblogpro' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo sanitize_text_field( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Your pinterest username:', 'buzzblogpro' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo sanitize_text_field( $instance['username'] ); ?>" />
		</p>
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'boardname' ) ); ?>"><?php esc_html_e( 'Your pinterest board name: (not required)', 'buzzblogpro' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'boardname' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'boardname' ) ); ?>" type="text" value="<?php echo sanitize_text_field( $instance['boardname'] ); ?>" />
		</p>
		
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'numbers' ) ); ?>"><?php esc_html_e( 'Numbers image to show:', 'buzzblogpro' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'numbers' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'numbers' ) ); ?>" type="number" value="<?php echo absint( $instance['numbers'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cache' ) ); ?>"><?php esc_html_e( 'Cache life time ( unit is seconds ):', 'buzzblogpro' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cache' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cache' ) ); ?>" type="number" value="<?php echo absint( $instance['cache'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'follow' ) ); ?>"><?php esc_html_e( 'Display more link with username text?:', 'buzzblogpro' ); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'follow' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'follow' ) ); ?>" <?php checked( (bool) $instance['follow'], true ); ?> />
		</p>
	<?php
	}
}