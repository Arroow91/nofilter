<?php
/**
 * Template for cart
 */
?>

<div id="shopdock">
	<?php

	if (sizeof(WC()->cart->get_cart())>0):
		?>
		<div id="cart-wrap" class="areproducts">
			<div id="cart-list">
				<div class="jspContainer">
					<div class="jspPane">
						<?php get_template_part('includes/loop-product', 'cart'); ?>
					</div>
				</div>
			</div>
			

			<div class="cart-total-checkout-wrap">
				<p class="cart-total">
					<span class="amount"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
					<a id="view-cart" href="<?php echo esc_url(wc_get_cart_url()) ?>">
						<?php esc_html_e('view cart', 'buzzblogpro') ?>
					</a>
				</p>

				<p class="checkout-button">
					<button type="submit" class="but-cart" onClick="document.location.href = '<?php echo esc_url(WC()->cart->get_checkout_url()); ?>';
								return false;"><?php  esc_html_e('Checkout', 'buzzblogpro') ?></button>
				</p>
			</div>
		</div>
	<?php else:?>
	<div id="cart-wrap"><div class="empty-cart">
			<?php esc_html_e('No products in the cart', 'buzzblogpro') ?>
			</div></div>
	<?php endif; ?>
</div>