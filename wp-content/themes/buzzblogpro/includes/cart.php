<?php if (buzzblogpro_is_woocommerce_active() or buzzblogpro_getVariable('hamburger_menu') == 'no') { ?>
									<ul class="icon-menu top-icon-wrap">
									
									<?php if (buzzblogpro_getVariable('woocommerce_cart_icon') != 'no') { ?>
									<?php if (buzzblogpro_is_woocommerce_active()):?>
										<?php global $woocommerce; ?>
											<?php 
												$total = $woocommerce->cart->get_cart_contents_count();
												$cart_is_dropdown = 'dropdown';
											?>
											<li id="cart-icon-count" class="cart">
												<a <?php if(!$cart_is_dropdown):?>id="cart-link"<?php endif; ?> href="<?php echo esc_url(wc_get_cart_url());?>">
													<i class="hs hs-cart5"></i>
													<span class="icon-menu-count<?php if($total<=0):?> cart_empty<?php endif; ?>"><?php echo esc_attr($total); ?></span> 
													<span class="tooltip"><?php esc_html_e('Cart','buzzblogpro')?></span>
												</a>
												<?php if($cart_is_dropdown):?>
													<?php get_template_part( 'includes/shopdock' ); ?>
												<?php endif;?> 
											</li>
											<?php endif; ?>	
											<?php } ?>	
											<?php if (buzzblogpro_getVariable('hamburger_menu') == 'no') {?><li class="st-trigger-effects"><a href="#" class="bt-menu-trigger nav-icon4"><span></span></a></li>
										<?php } ?>	
									</ul>							
<?php } ?>