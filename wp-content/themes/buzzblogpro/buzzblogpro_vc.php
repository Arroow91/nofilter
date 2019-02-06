<?php
/**
 * Add on for Visual Composer
 * If VC installed, this file will load
 * This add-on only use for BrigiTte theme
 *
 * @since 1.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Buzzblogpro_VC_Admin {

	function __construct() {
		// We safely integrate with VC with this hook
		add_action( 'init', array( $this, 'integrate' ) );
	}

	/**
	 * Integrate elements (shortcodes) into VC interface
	 */
	public function integrate() {
		// Check if Visual Composer is installed
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			// Display notice that Visual Composer is required
			add_action( 'admin_notices', array( __CLASS__, 'notice' ) );

			return;
		}

		/*
		 * Register custom shortcodes within Visual Composer interface
		 *
		 * @see http://kb.wpbakery.com/index.php?title=Vc_map
		 */
		// Latest Posts
		vc_map( array(
			'name'        => esc_html__( 'Latest Posts', 'buzzblogpro' ),
			'description' => 'Display your latest posts',
			'base'        => 'latest_posts',
			'class'       => '',
			'controls'    => 'full',
			'icon'        => get_template_directory_uri() . '/images/vc-icon.png',
			'category'    => 'Buzzblogpro',
			'params'      => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Heading Title for Latest Posts', 'buzzblogpro' ),
					'param_name'  => 'heading', 
					'description' => '',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Latest Posts Layout', 'buzzblogpro' ),
					'value'       => array(
						'Standard Posts'                   => 'standard',
						'Grid Masonry 2 Columns Posts'               => 'masonry-2',
						'Grid Masonry 3 Columns Posts'     => 'masonry-3',
						'Grid Masonry 4 Columns Posts'     => 'masonry-4',
						'List Posts'                       => 'list',
						'ZigZag'              => 'zigzag'
					),
					'param_name'  => 'style',
					'description' => esc_html__( 'Select Latest Posts Style', 'buzzblogpro' ),
				),
								array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Sticky post', 'buzzblogpro' ),
					'value'       => array(
						'Show sticky post'                   => 'showsticky',
						'Hide sticky post'               => 'hidesticky'
					),
					'param_name'  => 'sticky',
					'description' => esc_html__( 'Do you want to display sticky post ?', 'buzzblogpro' ),
				),
												array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Special post', 'buzzblogpro' ),
					'value'       => array(
					'Hide special posts' => 'hide-specials',
					'Show special posts' => 'show-specials'
						
					),
					'param_name'  => 'specials',
					'description' => esc_html__( 'Do you want to have every third post full width ? Only works for list post and masonry layouts.', 'buzzblogpro' ), 
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Number Posts Per Page', 'buzzblogpro' ), 
					'param_name'  => 'number',
					'description' => esc_html__( 'Fill the number posts per page you want here', 'buzzblogpro' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Exclude Categories',
					'param_name'  => 'exclude',
					'description' => esc_html__( 'If you want to exclude any categories, fill the categories slug here. Example: travel, life-style', 'buzzblogpro' ), 
				)
			)
		) );

vc_map( array(
			'name'        => esc_html__( 'Posts Block 1', 'buzzblogpro' ),
			'description' => 'Display a Posts Block',
			'base'        => 'post_block_1',
			'class'       => '',
			'controls'    => 'full',
			'icon'        => get_template_directory_uri() . '/images/block1.png',
			'category'    => 'Buzzblogpro',
			'params'      => array(
							array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Type of posts', 'buzzblogpro' ), 
					'param_name'  => 'type',
					'description' => esc_html__( 'This is the type of posts. Leave it blank for posts from Blog', 'buzzblogpro' ),
				),
							array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Number of columns', 'buzzblogpro' ),
					'value'       => array(
					'default' => '3',
						'1 column' => '1',
						'2 colums' => '2',
						'3 colums' => '3',
						'4 colums' => '4'
					),
					'param_name'  => 'columns',
					'description' => 'Choose number of columns',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Number of rows', 'buzzblogpro' ),
					'value'       => array(
					'default' => '1',
						'1 row' => '1',
						'2 rows' => '2',
						'3 rows' => '3',
						'4 rows' => '4'
					),
					'param_name'  => 'rows',
					'description' => 'Choose number of rows',
				),
								array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Choose the order by mode', 'buzzblogpro' ),
					'value'       => array(
					'default' => 'date',
						'date' => 'date',
						'title' => 'title',
						'popular' => 'popular',
						'random' => 'random'
					),
					'param_name'  => 'order_by',
					'description' => 'Order by',
				),
												array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Choose the order mode ( from Z to A or from A to Z)', 'buzzblogpro' ),
					'value'       => array(
					'default' => 'DESC',
						'DESC' => 'DESC',
						'ASC' => 'ASC'
					),
					'param_name'  => 'order',
					'description' => '',
				),
												array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image width', 'buzzblogpro' ),    
					'param_name'  => 'thumb_width',
					'description' => esc_html__( 'Set the width for your featured images', 'buzzblogpro' ), 
				),
								array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image height', 'buzzblogpro' ),    
					'param_name'  => 'thumb_height',
					'description' => esc_html__( 'Set the height for your featured images', 'buzzblogpro' ), 
				),
																array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Show a post meta?)', 'buzzblogpro' ),
					'value'       => array(
					'default' => 'yes',
						'yes' => 'yes',
						'no' => 'no'
					),
					'param_name'  => 'meta',
					'description' => '',
				),
												array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'The number of words in the excerpt', 'buzzblogpro' ),    
					'param_name'  => 'excerpt_count',
					'description' => esc_html__( 'How many words are displayed in the excerpt?', 'buzzblogpro' ), 
				),
																				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Link', 'buzzblogpro' ),
					'value'       => array(
					'default' => 'yes',
						'yes' => 'yes',
						'no' => 'no'
					),
					'param_name'  => 'link',
					'description' => esc_html__( 'Show link after posts, yes or no.)', 'buzzblogpro' ),
				),
																array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Link Text', 'buzzblogpro' ),    
					'param_name'  => 'link_text',
					'description' => esc_html__( 'Text for the link', 'buzzblogpro' ), 
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Which category to pull from? (for Blog posts)', 'buzzblogpro' ),
					'value'       => self::get_terms( 'category' ),
					'param_name'  => 'category',
					'description' => esc_html__( 'Select featured category', 'buzzblogpro' ), 
				),
																				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Which category to pull from? (for Custom posts)', 'buzzblogpro' ),    
					'param_name'  => 'custom_category',
					'description' => esc_html__( 'Enter the slug of the category you would like to pull posts from. Leave blank if you would like to pull from all categories.', 'buzzblogpro' ), 
				)
									
			)
		) );
vc_map( array(
			'name'        => esc_html__( 'Posts Block 2', 'buzzblogpro' ),
			'description' => 'Display a Posts Block',
			'base'        => 'post_block_2',
			'class'       => '',
			'controls'    => 'full',
			'icon'        => get_template_directory_uri() . '/images/block2.png',
			'category'    => 'Buzzblogpro',
			'params'      => array(
							array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Type of posts', 'buzzblogpro' ), 
					'param_name'  => 'type',
					'description' => esc_html__( 'This is the type of posts. Leave it blank for posts from Blog', 'buzzblogpro' ),
				),
							array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Number of columns', 'buzzblogpro' ),
					'value'       => array(
					'default' => '3',
						'1 column' => '1',
						'2 colums' => '2',
						'3 colums' => '3',
						'4 colums' => '4'
					),
					'param_name'  => 'columns',
					'description' => 'Choose number of columns',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Number of rows', 'buzzblogpro' ),
					'value'       => array(
					'default' => '1',
						'1 row' => '1',
						'2 rows' => '2',
						'3 rows' => '3',
						'4 rows' => '4'
					),
					'param_name'  => 'rows',
					'description' => 'Choose number of rows',
				),
								array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Choose the order by mode', 'buzzblogpro' ),
					'value'       => array(
					'default' => 'date',
						'date' => 'date',
						'title' => 'title',
						'popular' => 'popular',
						'random' => 'random'
					),
					'param_name'  => 'order_by',
					'description' => 'Order by',
				),
												array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Choose the order mode ( from Z to A or from A to Z)', 'buzzblogpro' ),
					'value'       => array(
					'default' => 'DESC',
						'DESC' => 'DESC',
						'ASC' => 'ASC'
					),
					'param_name'  => 'order',
					'description' => '',
				),
												array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image width', 'buzzblogpro' ),    
					'param_name'  => 'thumb_width',
					'description' => esc_html__( 'Set the width for your featured images', 'buzzblogpro' ), 
				),
								array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image height', 'buzzblogpro' ),    
					'param_name'  => 'thumb_height',
					'description' => esc_html__( 'Set the height for your featured images', 'buzzblogpro' ), 
				),
																array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Show a post meta?)', 'buzzblogpro' ),
					'value'       => array(
					'default' => 'yes',
						'yes' => 'yes',
						'no' => 'no'
					),
					'param_name'  => 'meta',
					'description' => '',
				),
												array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'The number of words in the excerpt', 'buzzblogpro' ),    
					'param_name'  => 'excerpt_count',
					'description' => esc_html__( 'How many words are displayed in the excerpt?', 'buzzblogpro' ), 
				),
																				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Link', 'buzzblogpro' ),
					'value'       => array(
					'default' => 'yes',
						'yes' => 'yes',
						'no' => 'no'
					),
					'param_name'  => 'link',
					'description' => esc_html__( 'Show link after posts, yes or no.)', 'buzzblogpro' ),
				),
																array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Link Text', 'buzzblogpro' ),    
					'param_name'  => 'link_text',
					'description' => esc_html__( 'Text for the link', 'buzzblogpro' ), 
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Which category to pull from? (for Blog posts)', 'buzzblogpro' ),
					'value'       => self::get_terms( 'category' ),
					'param_name'  => 'category',
					'description' => esc_html__( 'Select featured category', 'buzzblogpro' ), 
				),
																				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Which category to pull from? (for Custom posts)', 'buzzblogpro' ),    
					'param_name'  => 'custom_category',
					'description' => esc_html__( 'Enter the slug of the category you would like to pull posts from. Leave blank if you would like to pull from all categories.', 'buzzblogpro' ), 
				)
									
			)
		) );
		
											
vc_map( array(
			'name'        => esc_html__( 'Posts Block 3', 'buzzblogpro' ),
			'description' => 'Display a Posts Block',
			'base'        => 'post_block_3',
			'class'       => '',
			'controls'    => 'full',
			'icon'        => get_template_directory_uri() . '/images/block3.png',
			'category'    => 'Buzzblogpro',
			'params'      => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image width', 'buzzblogpro' ),    
					'param_name'  => 'thumb_width',
					'description' => esc_html__( 'Set the width for your featured images', 'buzzblogpro' ), 
				),
								array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image height', 'buzzblogpro' ),    
					'param_name'  => 'thumb_height',
					'description' => esc_html__( 'Set the height for your featured images', 'buzzblogpro' ), 
				),
array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Show a post meta?)', 'buzzblogpro' ),
					'value'       => array(
					'default' => 'yes',
						'yes' => 'yes',
						'no' => 'no'
					),
					'param_name'  => 'meta',
					'description' => '',
				),
												array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'The number of words in the excerpt', 'buzzblogpro' ),    
					'param_name'  => 'excerpt_count',
					'description' => esc_html__( 'How many words are displayed in the excerpt?', 'buzzblogpro' ), 
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Which category to pull from?', 'buzzblogpro' ),
					'value'       => self::get_terms( 'category' ),
					'param_name'  => 'category',
					'description' => esc_html__( 'Select Featured Category', 'buzzblogpro' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Number Posts Display', 'buzzblogpro' ),
					'param_name'  => 'number',
					'description' => esc_html__('Fill the number posts display you want here', 'buzzblogpro' ),
				)
			)
		) );
	}

	/**
	 * Show notice if your plugin is activated but Visual Composer is not
	 */
	public static function notice() {
		?>

		<div class="updated">
			<p><?php esc_html_e( '<strong>Buzzblogpro VC Addon</strong> requires <strong>Visual Composer</strong> plugin to be installed and activated on your site.', 'buzzblogpro' ) ?></p>
		</div>

	<?php
	}

	/**
	 * Get category for auto complete field
	 *
	 * @param string $taxonomy Taxnomy to get terms
	 *
	 * @return array
	 */
	private static function get_terms( $taxonomy = 'category' ) {
		$cats = get_terms( $taxonomy );
		if ( ! $cats || is_wp_error( $cats ) ) {
			return array();
		}

		$categories = array();
		$categories[] = array(
				'label' => 'all post',
				'value' => '',
				'group' => 'category',
			);
		foreach ( $cats as $cat ) {
			$categories[] = array(
				'label' => $cat->name,
				'value' => $cat->slug,
				'group' => 'category',
			);
			
		}

		return $categories;
	}
}

new Buzzblogpro_VC_Admin();


class Buzzblogpro_VC_Shortcodes {
	/**
	 * Add shortcodes
	 */
	public static function init() {
		$shortcodes = array(
			'latest_posts',
			'post_block_1',
			'post_block_2',
			'post_block_3'
		);

		foreach ( $shortcodes as $shortcode ) {
			add_shortcode( $shortcode, array( __CLASS__, $shortcode ) );
		}
	}

	/**
	 * Retrieve HTML markup of latest_posts shortcode
	 *
	 * @param array  $atts
	 * @param string $content
	 *
	 * @return string
	 */
	public static function latest_posts( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'style'   => 'standard',
			'sticky'   => 'showsticky',
			'specials'   => 'hide-specials',
			'heading' => '',
			'number'  => '10',
			'exclude' => ''
		), $atts ) );

		$return = '';

		if ( ! isset( $number ) || ! is_numeric( $number ) ): $number = '10'; endif;
		 global $paged;
		if ( get_query_var('paged') ) {
     $paged = get_query_var('paged'); 
     }
    elseif ( get_query_var('page') ) { 
	
    $paged = get_query_var('page'); 
    }
    else { $paged = 1; }
		
		$args  = array( 'post_type' => 'post', 'paged' => $paged, 'posts_per_page' => $number, 'post__not_in' => get_option( 'sticky_posts' ), 'ignore_sticky_posts' => 1 );
		if ( ! empty( $exclude ) ):
			$exclude_cats      = str_replace( ' ', '', $exclude );
			$exclude_array     = explode( ',', $exclude_cats );
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => $exclude_array,
					'operator' => 'NOT IN'
				)
			);
		endif;
        $counter = 1;
		switch ($style) {
		case 'masonry-2':
			$counter_set = '3';
		break;
		case 'list':
			$counter_set = '3';
		break;
		case 'masonry-3':
			$counter_set = '4';
		break;
		case 'masonry-4':
			$counter_set = '5';
		break;
	}
		$query_custom = new WP_Query( $args );
		if ( $query_custom->have_posts() ) :
			ob_start();
			?>

			<?php if ( $heading ) : ?>
				<div class="widget-content"><h4 class="subtitle"><?php echo sanitize_text_field( $heading ); ?></h4></div>
			<?php endif; ?>
<?php if ( in_array( $sticky, array( 'showsticky' ) ) && ! is_paged() ) : get_template_part('post-template/masonry-stickypost-template'); endif; ?>
			
			<?php if ( in_array( $style, array( 'masonry-2', 'masonry-3', 'masonry-4' ) ) ) : wp_enqueue_script('masonry'); ?><div class="grid js-masonry ajax-container row"><?php endif; ?>
			<?php if ( in_array( $style, array( 'standard' ) ) ) : ?><div class="ajax-container"> <?php endif; ?>
			
            <?php if ( in_array( $style, array( 'list', 'zigzag' ) ) ) : ?><div class="list-post ajax-container row"><?php endif; ?>
			<?php /* The loop */
			while ( $query_custom->have_posts() ) : $query_custom->the_post();
			if ($style != 'zigzag' && $style != 'standard' ) {
			if ($counter % $counter_set == 0 && $specials == 'show-specials' ) {
			include( locate_template( 'VC-latest-posts/content-standard.php' ) );
			}else{
				include( locate_template( 'VC-latest-posts/content-' . $style . '.php' ) );
				}
				}else{
				include( locate_template( 'VC-latest-posts/content-' . $style . '.php' ) );
				}
				$counter ++ ; 
			endwhile;
			?>
		</div>
		
				<div class="row pagination-below">
					<div class="col-md-12">
					<?php 
$pagination_type = buzzblogpro_getVariable('pagination_type');
if(function_exists('buzzblogpro_hs_pagination') && $pagination_type=='pagnum') : ?>
  <?php buzzblogpro_hs_pagination($query_custom->max_num_pages); ?>
<?php endif; ?>
<?php 
if ( $query_custom->max_num_pages > 1 && $pagination_type=='paglink' ) : ?>

    <div class="paglink">
     <span class="pull-left">
	  <?php previous_posts_link(theme_locals("newer")); ?>
	   </span>
	   <span class="pull-right">
        <?php next_posts_link(theme_locals("older"), $query_custom->max_num_pages); ?>
	  </span>
    </div>
					<?php endif; ?>
  		<?php
		if ( $query_custom->max_num_pages > 1 && $pagination_type=='loadmore' or $query_custom->max_num_pages > 1 && $pagination_type=='infinite' ) { 
		$all_num_pages = $query_custom -> max_num_pages;
  $next_page_url = buzzblogpro_next_page($all_num_pages);

?>
<div class="ajax-pagination-container">
  <a href="<?php echo esc_url($next_page_url); ?>" id="ajax-load-more-posts-button"></a>
</div>
<?php } ?>
</div><div class="clear"></div>

</div>

		<?php
		endif; wp_reset_postdata(); ?>

		

		
		<?php
		$return = ob_get_clean();

		return $return;
	}
	
public static function post_block_1( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'type'            => 'post',
			'category'        => '',
			'custom_category' => '',
			'tag'             => '',
			'columns'         => '3',
			'rows'            => '1',
			'order_by'        => 'date',
			'order'           => 'DESC',
			'thumb_width'     => '370',
			'thumb_height'    => '420',
			'lightbox'  	  => 'yes',
			'meta'            => 'yes',
			'excerpt_count'   => '15',
			'link'            => 'yes',
			'link_text'       => esc_html__('Read more', 'buzzblogpro'),
			'custom_class'    => 'post_block_1'
		), $atts));
if( ! is_paged() ) { 
		$rand  = rand();

		// check what order by method user selected
		switch ($order_by) {
			case 'date':
				$order_by = 'post_date';
				break;
			case 'title':
				$order_by = 'title';
				break;
			case 'popular':
				$order_by = 'comment_count';
				break;
			case 'random':
				$order_by = 'rand';
				break;
		}

		// check what order method user selected (DESC or ASC)
		switch ($order) {
			case 'DESC':
				$order = 'DESC';
				break;
			case 'ASC':
				$order = 'ASC';
				break;
		}

		// show link after posts?
		switch ($link) {
			case 'yes':
				$link = true;
				break;
			case 'no':
				$link = false;
				break;
		}

			global $post;

			$numb = $columns * $rows;

			// WPML filter
			$suppress_filters = get_option('suppress_filters');

			$args = array(
				'post_type'         => $type,
				'category_name'     => $category,
				$type . '_category' => $custom_category,
				'tag'               => $tag,
				'numberposts'       => $numb,
				'orderby'           => $order_by,
				'order'             => $order,
				'suppress_filters'  => $suppress_filters
			);

			$posts = get_posts( $args );

			if ( empty( $posts ) ) {
				wp_reset_postdata();
				return;
			}

			$i          = 0;
			$count      = 1;
			$max_columns = $columns;
			$column = 12/$max_columns; //column number
			$total_items = count($posts);
			$remainder = $total_items%$max_columns; 
			$first_row_item = ($total_items - $remainder);
			$countul    = 0;

			if ($numb > count($posts)) {
				
			}

			$cattitle = '';
			if ($category) {
			$termcat = get_term_by('slug', $category, 'category'); $name = $termcat->name;
			$category_id = $termcat->term_id;
			$cattitle = '<div class="widget-content"><h4 class="subtitle"><a href="'. esc_url( get_category_link( $category_id ) ).'">'.sanitize_text_field( $name ).'</a></h4></div>';
				}
			
			$output = $cattitle;


			foreach ( $posts as $j => $post ) {
			
			if ($i%$max_columns==0) {
			$output .= '<div class="row '. $custom_class .' grid-item-'.$countul.'">';
			}
				$post_id = $posts[$j]->ID;
				//Check if WPML is activated
				if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
					global $sitepress;

					$post_lang = $sitepress->get_language_for_element( $post_id, 'post_' . $type );
					$curr_lang = $sitepress->get_current_language();
					// Unset not translated posts
					if ( $post_lang != $curr_lang ) {
						unset( $posts[$j] );
					}
					// Post ID is different in a second language Solution
					if ( function_exists( 'icl_object_id' ) ) {
						$posts[$j] = get_post( icl_object_id( $posts[$j]->ID, $type, true ) );
					}
				}

				setup_postdata($posts[$j]);
				$excerpt        = get_the_excerpt();
				$attachment_url = wp_get_attachment_url( get_post_thumbnail_id($post_id));
				$url            = $attachment_url;
				

		if (function_exists('exif_imagetype') && @exif_imagetype($url) == IMAGETYPE_GIF) {
		$image = $url;
		}else{
         $image          = aq_resize($url, $thumb_width, $thumb_height, true, true, true);
        }
		

				
				if ($count > $columns) {
					$count = 1;
					$countul ++;
				}

				if ($i >= $first_row_item) { 
    $output .= '<div class="cat_post_item-'.esc_attr($i).' col-xs-12 col-sm-6 col-md-'. 12/$remainder.'">';
     } else {
    $output .= '<div class="cat_post_item-'.esc_attr($i).' col-xs-12 col-sm-6 col-md-'.$column.'">';
    }
	
$output .= '<div class="post-grid-block post">';
						if(has_post_thumbnail($post_id)) {
							$output .= '<div class="thumb-container"><div class="thumbnail">';
							$output .= '<a href="'.get_permalink($post_id).'" title="'.wp_strip_all_tags(get_the_title($post_id)).'">';
							$output .= '<img  src="'.$image.'" alt="'.wp_strip_all_tags(get_the_title($post_id)).'" />';
							$output .= '</a></div></div>';
							$output .= '<header class="post-header">';
						}else{
$output .= '<header class="post-header" style="margin-top: 0px!important;">';
}											if ($meta == 'yes') {
$output .= '<div class="meta-space-top">';
							$output .= '<span class="post_category">';
							if ($type!='' && $type!='post') {
								$terms = get_the_terms( $post_id, $type.'_category');
								if ( $terms && ! is_wp_error( $terms ) ) {
									$out = array();
									
									foreach ( $terms as $term )
										$out[] = '<a href="' .get_term_link($term->slug, $type.'_category') .'">'.$term->name.'</a>';
										$output .= join('', $out );
								}
							} else {
								$categories = get_the_category($post_id);
								if($categories){
									$out = array();
								
									foreach($categories as $category)
										$out[] = '<a href="'.get_category_link($category->term_id ).'" title="'.$category->name.'">'.$category->cat_name.'</a> ';
										$output .= join( '', $out );
								}
							}
							
							$output .= '</span>';
							$output .= '</div>';
							}
							
					$output .= '<h2 class="grid-post-title"><a href="'.get_permalink($post_id).'" title="'.wp_strip_all_tags(get_the_title($post_id)).'">';
						$output .= get_the_title($post_id);
					$output .= '</a></h2>';
					if ($meta == 'yes') {
$output .= '<div class="meta-space-top">';
				// post author
							$output .= '<span class="post_author">';
							$output .= theme_locals("text_before_author");
							$output .= ' <a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author_meta('display_name').'</a>';
							$output .= '</span>';
							// post date
							$output .= '<span class="post-date">';
							$output .= '<time datetime="'.get_the_time('Y-m-d\TH:i:s', $post_id).'">' .get_the_date(). '</time>';
							$output .= '</span>';


						$output .= '</div>';
						// end post meta
					}
					
					if($excerpt_count >= 1){
						$output .= '<p class="excerpt">';
							$output .= buzzblogpro_limit_text($excerpt,$excerpt_count);
						$output .= '</p>';
					}
					if($link){
						$output .= '<a href="'.get_permalink($post_id).'" class="btn btn-default btn-normal" title="'.wp_strip_all_tags(get_the_title($post_id)).'">';
						$output .= $link_text;
						$output .= '</a>';
					}
					$output .= '</header></div></div>';
					$i++;
					
				if($i%$max_columns==0) {
					$output .= '</div>';
				}
			$count++;
			

		} // end for
		wp_reset_postdata();
 if($i%$max_columns!=0) { 
$output .= '</div>';
 } 
   
		return $output;
		}
	}
	
// Post Block 2

public static function post_block_2( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'type'            => 'post',
			'category'        => '',
			'custom_category' => '',
			'tag'             => '',
			'columns'         => '3',
			'rows'            => '1',
			'order_by'        => 'date',
			'order'           => 'DESC',
			'thumb_width'     => '370',
			'thumb_height'    => '420',
			'lightbox'  	  => 'yes',
			'meta'            => 'yes',
			'excerpt_count'   => '15',
			'link'            => 'yes',
			'link_text'       => esc_html__('Read more', 'buzzblogpro'),
			'custom_class'    => 'post_block_2'
		), $atts));
if( ! is_paged() ) { 
		$rand  = rand();

		// check what order by method user selected
		switch ($order_by) {
			case 'date':
				$order_by = 'post_date';
				break;
			case 'title':
				$order_by = 'title';
				break;
			case 'popular':
				$order_by = 'comment_count';
				break;
			case 'random':
				$order_by = 'rand';
				break;
		}

		// check what order method user selected (DESC or ASC)
		switch ($order) {
			case 'DESC':
				$order = 'DESC';
				break;
			case 'ASC':
				$order = 'ASC';
				break;
		}

		// show link after posts?
		switch ($link) {
			case 'yes':
				$link = true;
				break;
			case 'no':
				$link = false;
				break;
		}

			global $post;

			$numb = $columns * $rows;

			// WPML filter
			$suppress_filters = get_option('suppress_filters');

			$args = array(
				'post_type'         => $type,
				'category_name'     => $category,
				$type . '_category' => $custom_category,
				'tag'               => $tag,
				'numberposts'       => $numb,
				'orderby'           => $order_by,
				'order'             => $order,
				'suppress_filters'  => $suppress_filters
			);

			$posts = get_posts( $args );

			if ( empty( $posts ) ) {
				wp_reset_postdata();
				return;
			}

			$i          = 0;
			$count      = 1;
			$max_columns = $columns;
			$column = 12/$max_columns; //column number
			$total_items = count($posts);
			$remainder = $total_items%$max_columns; 
			$first_row_item = ($total_items - $remainder);
			$countul    = 0;

			$small = '';

			$cattitle = '';
			if ($category) {
			$termcat = get_term_by('slug', $category, 'category'); $name = $termcat->name;
			$category_id = $termcat->term_id;
			$cattitle = '<div class="widget-content"><h4 class="subtitle"><a href="'. esc_url( get_category_link( $category_id ) ).'">'.sanitize_text_field( $name ).'</a></h4></div>';
				}
			
			$output = $cattitle;


			foreach ( $posts as $j => $post ) {
			
			if ($i%$max_columns==0) {
			$output .= '<div class="row '. $custom_class .' grid-item-'.$countul.'">';
			}
				$post_id = $posts[$j]->ID;
				//Check if WPML is activated
				if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
					global $sitepress;

					$post_lang = $sitepress->get_language_for_element( $post_id, 'post_' . $type );
					$curr_lang = $sitepress->get_current_language();
					// Unset not translated posts
					if ( $post_lang != $curr_lang ) {
						unset( $posts[$j] );
					}
					// Post ID is different in a second language Solution
					if ( function_exists( 'icl_object_id' ) ) {
						$posts[$j] = get_post( icl_object_id( $posts[$j]->ID, $type, true ) );
					}
				}

				setup_postdata($posts[$j]);
				$excerpt        = get_the_excerpt();
				$attachment_url = wp_get_attachment_url( get_post_thumbnail_id($post_id));
				$url            = $attachment_url;
				if (function_exists('exif_imagetype') && exif_imagetype($url) == IMAGETYPE_GIF) {
		$image = $url;
		}else{
          $image          = aq_resize($url, $thumb_width, $thumb_height, true, true, true);
        }


		
				if ($count > $columns) {
					$count = 1;
					$countul ++;
				}
				
if ($columns == 1 && $i > 0) {$small = 'small-post';}
if ($columns == 2 && $i > 1) {$small = 'small-post';}
if ($columns == 3 && $i > 2) {$small = 'small-post';}
if ($columns == 4 && $i > 3) {$small = 'small-post';}
				if ($i >= $first_row_item) { 
    $output .= '<div class="cat_post_item-'.esc_attr($i).' col-xs-12 col-sm-6 col-md-'. 12/$remainder.'">';
     } else {
    $output .= '<div class="cat_post_item-'.esc_attr($i).' '.esc_attr($small).' col-xs-12 col-sm-6 col-md-'.$column.'">';
    }
	
$output .= '<div class="post-grid-block post">';
						if(has_post_thumbnail($post_id)) {
							$output .= '<div class="thumb-container"><div class="thumbnail">';
							$output .= '<a href="'.get_permalink($post_id).'" title="'.wp_strip_all_tags(get_the_title($post_id)).'">';
							$output .= '<img  src="'.$image.'" alt="'.wp_strip_all_tags(get_the_title($post_id)).'" />';
							$output .= '</a></div></div>';
							$output .= '<header class="post-header">';
						}else{
$output .= '<header class="post-header" style="margin-top: 0px!important;">';
}											if ($meta == 'yes' && $small != 'small-post' ) {
$output .= '<div class="meta-space-top">';
							$output .= '<span class="post_category">';
							if ($type!='' && $type!='post') {
								$terms = get_the_terms( $post_id, $type.'_category');
								if ( $terms && ! is_wp_error( $terms ) ) {
									$out = array();
									
									foreach ( $terms as $term )
										$out[] = '<a href="' .get_term_link($term->slug, $type.'_category') .'">'.$term->name.'</a>';
										$output .= join('', $out );
								}
							} else {
								$categories = get_the_category($post_id);
								if($categories){
									$out = array();
								
									foreach($categories as $category)
										$out[] = '<a href="'.get_category_link($category->term_id ).'" title="'.$category->name.'">'.$category->cat_name.'</a> ';
										$output .= join( '', $out );
								}
							}
							
							$output .= '</span>';
							$output .= '</div>';
							}
							
					$output .= '<h2 class="grid-post-title"><a href="'.get_permalink($post_id).'" title="'.wp_strip_all_tags(get_the_title($post_id)).'">';
						$output .= get_the_title($post_id);
					$output .= '</a></h2>';
					if ($meta == 'yes') {
$output .= '<div class="meta-space-top">';
				// post author
							$output .= '<span class="post_author">';
							$output .= theme_locals("text_before_author");
							$output .= ' <a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author_meta('display_name').'</a>';
							$output .= '</span>';
							// post date
							$output .= '<span class="post-date">';
							$output .= '<time datetime="'.get_the_time('Y-m-d\TH:i:s', $post_id).'">' .get_the_date(). '</time>';
							$output .= '</span>';


						$output .= '</div>';
						// end post meta
					}
					
					if($excerpt_count >= 1 && $small != 'small-post'){
						$output .= '<p class="excerpt">';
							$output .= buzzblogpro_limit_text($excerpt,$excerpt_count);
						$output .= '</p>';
					}
					if($link && $small != 'small-post'){
						$output .= '<a href="'.get_permalink($post_id).'" class="btn btn-default btn-normal" title="'.wp_strip_all_tags(get_the_title($post_id)).'">';
						$output .= $link_text;
						$output .= '</a>';
					}
					$output .= '</header></div></div>';
					$i++;
					
				if($i%$max_columns==0) {
					$output .= '</div>';
				}
			$count++;
			

		} // end for
		wp_reset_postdata();
 if($i%$max_columns!=0) { 
$output .= '</div>';
 } 
		return $output;
	}
	}
	
// Post block 3
public static function post_block_3( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'category' => '',
			'number'   => '5',
			'thumb_width'     => '500',
			'thumb_height'    => '320',
			'meta'            => 'yes',
			'excerpt_count'   => '15',
			'custom_class'    => 'post_block_3'
		), $atts ) );
if( ! is_paged() ) { 
		$return = '';
		if ( ! isset( $number ) || ! is_numeric( $number ) ): $number = '5'; endif;
			
			$args       = array(
				'post_type'         => 'post',
				'category_name'     => $category,
                'showposts' => $number
			);
			

				
			$block_3_query = new WP_Query( $args );
			$numers_results = $block_3_query->post_count;

			if ( $block_3_query->have_posts() ) :
			ob_start();
			?>
				
							<?php
							if ($category) {
			$termcat = get_term_by('slug', $category, 'category'); $name = $termcat->name; $category_id = $termcat->term_id; ?>
			<div class="widget-content"><h4 class="subtitle"><a href="<?php echo esc_url( get_category_link( $category_id ) ); ?>"><?php echo sanitize_text_field( $name ); ?></a></h4></div>
				<?php } ?>
				
			<div class="row <?php echo esc_attr($custom_class); ?>">
				<?php
				$counter = 1;
				while ( $block_3_query->have_posts() ): $block_3_query->the_post();
					include( locate_template( 'VC-blocks/block-type3.php' ) );
					$counter ++; endwhile;
				?>
				</div>

			<?php
			endif; wp_reset_postdata();
		

		$return = ob_get_clean();

		return $return;
		}
	}
	
}

if ( ! is_admin() ) {
	Buzzblogpro_VC_Shortcodes::init();
}