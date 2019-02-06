<?php 
/**
 * Search Autocomplete
 */
// Search SQL filter for matching against post title only.
function buzzblogpro_search_by_title_only( $search, $wp_query )
{
global $wpdb;

if ( empty( $search ) )
return $search; // skip processing - no search term in query

$q = $wp_query->query_vars;
$n = ! empty( $q['exact'] ) ? '' : '%';

$search =
$searchand = '';

foreach ( (array) $q['search_terms'] as $term ) {
$term = $wpdb->esc_like( $term );

$search .= "{$searchand}($wpdb->posts.post_title REGEXP '[[:<:]]{$term}[[:>:]]')";

$searchand = ' AND ';
}

if ( ! empty( $search ) ) {
$search = " AND ({$search}) ";
if ( ! is_user_logged_in() )
$search .= " AND ($wpdb->posts.post_password = '') ";
}

return $search;
}

add_filter( 'posts_search', 'buzzblogpro_search_by_title_only', 1000, 2 );
function buzzblogpro_search_autocomplete(){
	if(!empty($_POST['term'])){
		$term  = sanitize_text_field($_POST['term']);
		if(!empty($term)){
			$query_args = array(
						'post_type'=>array('post'),
						'post_status'=>'publish',
						'posts_per_page'=>4,
						's'=>$term
			);
			global $wpdb,$query,$is_woocmerce_active,$is_product;
			$is_woocmerce_active = buzzblogpro_is_woocommerce_active();
			if($is_woocmerce_active){
				$query_args['post_type'][] = 'product';
			}
			
			wp_reset_postdata();
			$query = new WP_Query( $query_args );
			
			if($is_woocmerce_active){
				$is_woocmerce_active = false;
				$is_product = false;
				while ( $query->have_posts() ){
					$query->the_post();
					if(get_post_type()==='product'){
						$is_woocmerce_active = true;
					}
					else{
						$is_product = true;
					}
					
					if($is_product && $is_woocmerce_active){
						break;
					}
				}
				$query->rewind_posts();
			}
			else{
				$is_product = true;
			}
			
			get_template_part( 'includes/search-box-result' );
		}
	}
	wp_die();
}



add_action('wp_ajax_buzzblogpro_search_autocomplete','buzzblogpro_search_autocomplete');
add_action('wp_ajax_nopriv_buzzblogpro_search_autocomplete','buzzblogpro_search_autocomplete');

if (!empty($_GET['type']) && in_array($_GET['type'], array('post', 'product')) && !is_admin()) {
    add_filter('pre_get_posts', 'buzzblogpro_search_pre_get_posts', 5, 1);
}

function buzzblogpro_search_pre_get_posts($query) {
    if ($query->is_main_query() && $query->is_search()) {
        $post_type = $_GET['type'];
        $post_types = $post_type === 'post' ? array('post', 'page') : (buzzblogpro_is_woocommerce_active() ? $post_type : false);
        if ($post_types) {
            if ($post_type === 'post' && ((is_array($query->post_type) && !in_array('page', $query->post_type)))) {
                $post_types = $post_type;
            }
            global $wp_post_types;
            $searchable_cpt = is_array($post_types) ? $post_types : array($post_types);
            //for builder's action do_search
            foreach ($wp_post_types as $k => &$p) {
                $p->exclude_from_search = !in_array($k, $searchable_cpt);
            }
            $query->set('post_type', $post_types);
        }
    }
    return $query;
}