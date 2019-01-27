<?php
function buzzblogpro_mobilemenucart() {
		
			if ( buzzblogpro_getVariable('hs_newsletter_display')=='yes' ) {
			$newsletter_link = '<a class="newsletter-ajax-popup" href="#hs_signup"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>';
			}else{$newsletter_link = '';}
			if ( function_exists( 'is_woocommerce' ) ) {
			global $woocommerce;	
						$checkout_url = wc_get_cart_url();
						$total_articles = $woocommerce->cart->cart_contents_count;
						$icon_badge = (( $total_articles !== 0 ) ? '<span class="badge">'.$total_articles.'</span>' : '<span class="badge empty"></span>');
						$woo_icon_mobile = '<a class="mobile-shopping-cart" href="'.$checkout_url.'"><span class="cart-icon-container"><i class="hs hs-cart5"></i>'.$icon_badge.'</span></a>';
						}else{$woo_icon_mobile = '';}
						echo balanceTags('<div class="mobile-icons">'.$woo_icon_mobile.$newsletter_link.'<div class="st-trigger-effects"><a class="bt-menu-trigger nav-icon4"><span></span></a></div></div>');
}
?>		
<div class="mobile-top-panel visible-xs-block visible-sm-block">
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12 top-left">
<?php
if ( is_active_sidebar( 'hs_mobile_top_panel' ) ) { 
dynamic_sidebar("hs_mobile_top_panel"); 
}
?>
<?php buzzblogpro_mobilemenucart(); ?>
</div>
</div>
</div>
</div>