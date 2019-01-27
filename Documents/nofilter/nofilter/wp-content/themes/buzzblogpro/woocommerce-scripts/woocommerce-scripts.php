<?php
/** gets the url to remove an item from dock cart */
function buzzblogpro_get_remove_url( $cart_item_key ) {
	global $woocommerce;
	$cart_page_id = woocommerce_get_page_id('cart');
	if ($cart_page_id)
		return apply_filters('woocommerce_get_remove_url', $woocommerce->nonce_url( 'cart', add_query_arg('update_cart', $cart_item_key, get_permalink($cart_page_id))));
}  

/**
 * Remove from cart/update
 **/
function buzzblogpro_update_cart_action() {
	global $woocommerce;
	
	// Update Cart
	if (isset($_GET['update_cart']) && $_GET['update_cart']  && $woocommerce->verify_nonce('cart')) :
		
		$cart_totals = $_GET['update_cart'];
		
		if (sizeof($woocommerce->cart->get_cart())>0) : 
			foreach ($woocommerce->cart->get_cart() as $cart_item_key => $values) :
				
        $update = $values['quantity'] - 1;
        
				if ($cart_totals == $cart_item_key) 
          $woocommerce->cart->set_quantity( $cart_item_key, $update);
				
			endforeach;
		endif;
		
		echo json_encode(array('deleted' => 'deleted'));
    die();
		
	endif;
}

/**
 * Add cart total and shopdock cart to the WC Fragments
 */
function buzzblogpro_theme_add_to_cart_fragments( $fragments ) {

	ob_start();
	get_template_part( 'includes/shopdock' );
	$shopdock = ob_get_clean();
	$fragments['#shopdock'] = $shopdock;
	$total = WC()->cart->get_cart_contents_count();
	$cl= $total>0?'icon-menu-count':'icon-menu-count cart_empty';
	$fragments['#cart-icon-count .icon-menu-count'] = '<span class="'.$cl.'">' . $total. '</span>';
	return $fragments;
}

/**
 * Delete cart
 */
function buzzblogpro_theme_woocommerce_delete_cart() {
	global $woocommerce;

	if ( isset($_POST['remove_item']) && $_POST['remove_item'] ) {
		$woocommerce->cart->set_quantity( $_POST['remove_item'], 0 );
		WC_AJAX::get_refreshed_fragments();
		die();
	}
}

/**
 * Add to cart ajax on single product page
 */
function buzzblogpro_theme_woocommerce_add_to_cart() {
	ob_start();
	WC_AJAX::get_refreshed_fragments();
	die();	
}

/**
 * Remove (unnecessary) success message after a product was added to cart through theme's AJAX method.
 */
 
function buzzblogpro_theme_wc_add_to_cart_message( $message ) {
	if ( isset( $_REQUEST['action'] ) && 'theme_add_to_cart' == $_REQUEST['action'] ) {
		$message = '';
	}
	return $message;
}


//Woocommerce product per page
function buzzblogpro_overide_product_count($cols)
{
global $buzzblogpro_options;
if(isset($buzzblogpro_options['woocommerce_items_per_page'])) {
				return $buzzblogpro_options['woocommerce_items_per_page'];
				}
}
add_filter( 'loop_shop_per_page', 'buzzblogpro_overide_product_count', 20 );
add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );
function woo_hide_page_title() {
	return false;
}
add_action( 'after_setup_theme', 'buzzblogpro_woocommerce_support' );
function buzzblogpro_woocommerce_support() {
    add_theme_support( 'woocommerce' );
				add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
}
// Change number or products per row to 3
add_filter('loop_shop_columns', 'buzzblogpro_loop_columns');
if (!function_exists('buzzblogpro_loop_columns')) {
	function buzzblogpro_loop_columns() {
		return 3; // 3 products per row
	}
}

function buzzblogpro_get_cart_items() {
	global $woocommerce;

	$articles = sizeof( $woocommerce->cart->get_cart() );


	$cart = $total_articles = '';

	if (  $articles > 0 ) {
		$total_articles = $woocommerce->cart->cart_contents_count;
		foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

				$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
				$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price = apply_filters( 'woocommerce_cart_item_price', $woocommerce->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                $string = apply_filters( 'woocommerce_get_remove_url', $woocommerce->cart->get_remove_url( $cart_item_key ));
				$cart .= '<li class="cart-item-list clearfix">';
				if ( ! $_product->is_visible() ) {
					$cart .= str_replace( array( 'http:', 'https:' ), '', $thumbnail );
				} else {
					$cart .= '<a class="product-image" href="'.esc_url(get_permalink( $product_id )).'">
								'.str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . '
							</a>';
				}
                $cart .= '<a title="'.esc_html__( 'Remove this item', 'buzzblogpro' ).'" class="remove" href="'.$string.'"><i class="fa fa-times" aria-hidden="true"></i>
</a>';
				$cart .= '<div class="product-details"><span class="product-name">' . $product_name .'</span>';

				$cart .= '<span class="product-quantity">'. apply_filters( 'woocommerce_widget_cart_item_quantity',  '<span class="quantity-container">' . sprintf( '%s &times; %s',$cart_item['quantity'] , '</span>' . $product_price ) , $cart_item, $cart_item_key ) . '</span>';
				$cart .= '</div>';
				$cart .= '</li>';
			}
		}

		$cart .= '<li class="subtotal"><span class="subtotalwr">' . esc_html__('Estimated total:', 'buzzblogpro') . '</span><span> ' . $woocommerce->cart->get_cart_total() . '</span></li>';

		$cart .= '<li class="buttons clearfix">
								<a href="'.esc_url(wc_get_cart_url()).'" class="btn btn-default btn-normal"><i class="fa fa-bag"></i>'.esc_html__( 'View Cart', 'buzzblogpro' ).'</a>
								
							</li>';

	} else {
		$cart .= '<li><span>' . esc_html__('No products in the cart.','buzzblogpro') . '</span></li>';
	}

	return array('cart' => $cart, 'articles' => $total_articles);
}

function buzzblogpro_woomenucart_ajax() {

	$cart = buzzblogpro_get_cart_items();

	echo json_encode($cart);

	die();
}

/**
 * Fragments
 * Adding cart total and shopdock markup to the fragments
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'buzzblogpro_theme_add_to_cart_fragments' );

/**
 * Theme delete cart hook
 * Note: for Add to cart using default WC function
 */
add_action( 'wp_ajax_theme_delete_cart', 'buzzblogpro_theme_woocommerce_delete_cart' );
add_action( 'wp_ajax_nopriv_theme_delete_cart', 'buzzblogpro_theme_woocommerce_delete_cart' );

/**
 * Theme adding cart hook
 * Adding cart ajax on single product page
 */
add_action( 'wp_ajax_theme_add_to_cart', 'buzzblogpro_theme_woocommerce_add_to_cart' );
add_action( 'wp_ajax_nopriv_theme_add_to_cart', 'buzzblogpro_theme_woocommerce_add_to_cart' );

add_action( 'init', 'buzzblogpro_update_cart_action');

add_filter( 'woocommerce_output_related_products_args', 'buzzblogpro_related_products_args' );
  function buzzblogpro_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns'] = 3; 
	return $args;
}

//Display product description on WooCommerce shop/category pages 
function buzzblogpro_woocommerce_after_shop_loop_item_title_short_description() {
	global $product;
	if ( ! $product->get_short_description() ) return;
	?>
	<div class="woocommerce-product-details__short-description" itemprop="description">
		<?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() ) ?>
	</div>
	<?php
}
add_action('woocommerce_after_shop_loop_item_title', 'buzzblogpro_woocommerce_after_shop_loop_item_title_short_description', 5);


/**
 * Override pagination
 */
function buzzblogpro_wc_woocommerce_pagination() {

	global $wp_query;

	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	?>

<div class="row pagination-below"><div class="col-md-12">
  <?php
  the_posts_pagination( array(
   'mid_size' => 3,
   'type' => 'list',
				'prev_text'          => theme_locals("prev"),
				'next_text'          => theme_locals("next")
			) );
			?>


</div></div>

	<?php
}

remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'buzzblogpro_wc_woocommerce_pagination', 10 );

/**
 * prev next product
 */
add_action( 'woocommerce_after_single_product', 'buzzblogpro_prev_next_product' );
function buzzblogpro_prev_next_product(){
get_template_part('woocommerce-scripts/pagination');
}

//custom badge
add_filter( 'woocommerce_sale_flash', 'buzzblogpro_custom_sales_badge' );
function buzzblogpro_custom_sales_badge() {
$badge = '<div class="ribbon-wrapper-featured hidden-phone"><div class="ribbon-featured">' . esc_html__('Sale!','buzzblogpro') . '</span></div></div>';
return $badge;
}
?>