<?php
/**
 * Template to display products in cart
 */

global $woocommerce;
$carts = array_reverse( $woocommerce->cart->get_cart() );

foreach ( $carts as $cart_item_key => $values ) :
	$_product = $values['data'];

	if ( $_product->exists() && $values['quantity'] > 0 ): ?>

		<div class="product">

			<a href="<?php echo esc_url( $woocommerce->cart->get_remove_url($cart_item_key) ); ?>" data-product-key="<?php echo esc_attr($cart_item_key); ?>" class="remove-item remove-item-js">
				<i class="icon-flatshop-close"></i>
			</a>

			<figure class="product-image">
				
				<a href="<?php echo esc_url( get_permalink(apply_filters('woocommerce_in_cart_product_id', $values['product_id'])) ); ?>">
					<?php
						
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $values, $cart_item_key );
						
						echo str_replace( array( 'http:', 'https:' ), '', $thumbnail );
						
					?>
				</a>

			</figure>

			<div class="product-details">
				<h3 class="product-title">
					<a href="<?php echo esc_url( get_permalink(apply_filters('woocommerce_in_cart_product_id', $values['product_id'])) );?>">
						<?php echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ); ?>
					</a>
				</h3>
				<p class="quantity-count"><?php echo sprintf(esc_html__('x %d', 'buzzblogpro'), $values['quantity']); ?></p>
			</div>

		</div>

	<?php endif; ?>

<?php endforeach; ?>
