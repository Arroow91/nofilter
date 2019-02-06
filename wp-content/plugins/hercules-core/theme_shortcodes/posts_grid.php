<?php
/**
 * Post Grid
 *
 */
if (!function_exists('hs_posts_grid_shortcode')) {

	function hs_posts_grid_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract(shortcode_atts(array(
			'type'            => 'post',
			'category'        => '',
			'custom_category' => '',
			'tag'             => '',
			'columns'         => '3',
			'rows'            => '3',
			'order_by'        => 'date',
			'order'           => 'DESC',
			'thumb_width'     => '370',
			'thumb_height'    => '420',
			'lightbox'  	  => 'yes',
			'meta'            => 'yes',
			'excerpt_count'   => '15',
			'link'            => 'yes',
			'link_text'       => __('Read more', 'buzzblogpro'),
			'custom_class'    => ''
		), $atts));

		$spans = $columns;
		$rand  = rand();

		// columns
		switch ($spans) {
			case '1':
			$spans = 'col-md-12';
			break;
		case '2':
			$spans = 'col-md-6 col-sm-6 col-xs-12';
			break;
		case '3':
			$spans = 'col-md-4 col-sm-4 col-xs-12';
			break;
		case '4':
			$spans = 'col-md-3 col-sm-3 col-xs-12';
			break;
		case '6':
			$spans = 'col-md-2 col-sm-2 col-xs-12';
				break;
		}

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
			$output_end = '';
			$countul    = 0;

			if ($numb > count($posts)) {
				$output_end = '</div>';
			}

			$output = '<div class="row '. $custom_class .' grid-item-'.$countul.'">';


			foreach ( $posts as $j => $post ) {
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
				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
				$url            = $attachment_url[0];
				$image          = aq_resize($url, $thumb_width, $thumb_height, true, true, true);

				if ($count > $columns) {
					$count = 1;
					$countul ++;
					$output .= '<div class="row '. $custom_class .' grid-item-'.$countul.'">';
				}

				$output .= '<div class="'. $spans .' grid-item-'.$count.'">';
$output .= '<div class="post-grid-block">';
						if(has_post_thumbnail($post_id)) {
							$output .= '<div class="thumb-container"><div class="thumbnail">';
							$output .= '<a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
							$output .= '<img  src="'.$image.'" alt="'.get_the_title($post_id).'" />';
							$output .= '</a></div></div>';
							$output .= '<header class="post-header">';
						}else{
$output .= '<header class="post-header" style="margin-top: 0px!important;">';
}						

					$output .= '<h2 class="grid-post-title"><a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
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
							$output .= '<span class="post_category">';
							if ($type!='' && $type!='post') {
								$terms = get_the_terms( $post_id, $type.'_category');
								if ( $terms && ! is_wp_error( $terms ) ) {
									$out = array();
									
									foreach ( $terms as $term )
										$out[] = '<a href="' .get_term_link($term->slug, $type.'_category') .'">'.$term->name.'</a>';
										$output .= join(',', $out );
								}
							} else {
								$categories = get_the_category($post_id);
								if($categories){
									$out = array();
								
									foreach($categories as $category)
										$out[] = '<a href="'.get_category_link($category->term_id ).'" title="'.$category->name.'">'.$category->cat_name.'</a> ';
										$output .= join( ', ', $out );
								}
							}
							
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
						$output .= '<a href="'.get_permalink($post_id).'" class="btn btn-default btn-normal" title="'.get_the_title($post_id).'">';
						$output .= $link_text;
						$output .= '</a>';
					}
					$output .= '</header></div></div>';
					if ($j == count($posts)-1) {
						$output .= $output_end;
					}
				if ($count % $columns == 0) {
					$output .= '</div><!-- .posts-grid (end) -->';
				}
			$count++;
			$i++;

		} // end for
		wp_reset_postdata(); // restore the global $post variable

		return $output;
	}
	add_shortcode('posts_grid', 'hs_posts_grid_shortcode');
} ?>