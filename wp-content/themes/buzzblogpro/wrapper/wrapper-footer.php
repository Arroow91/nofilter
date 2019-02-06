<?php /* Wrapper Name: Footer */ ?>
<?php
$layout = buzzblogpro_getVariable('footer_layout_order','enabled');
if ($layout): foreach ($layout as $key=>$value) {
    switch($key) {
      case 'instagram': get_template_part( 'wrapper/instagram' );
       break;
      case 'bottom': get_template_part( 'wrapper/bottom-area' );
       break; 
    }
	if($key=''){
	get_template_part( 'wrapper/instagram' );
	   get_template_part( 'wrapper/bottom-area' );
	}
}
endif;
?>
<?php if ( is_active_sidebar( 'hs_bottom_4' ) ) : ?>
<div class="bottom4">
<div class="container">
<div class="row bottom4-widgets">
    <div class="col-md-12">
        <?php dynamic_sidebar("hs_bottom_4"); ?>
    </div>
</div>
</div>
</div>
<?php endif; ?>
 
 <?php if ( buzzblogpro_getVariable('footer_logo') == 'yes' or buzzblogpro_getVariable('footer_logo') == '') { ?> 
<div class="footer-logo">
<div class="container">

<div class="row logo-nav">
<div class="col-md-12">
    	<?php get_template_part("static/static-footer-logo"); ?>
		</div>
		</div>
		</div>
		</div>
<?php } ?>
<?php if ( is_active_sidebar( 'hs_under_footer_logo' ) ) { ?>
<div class="under-footer-logo">
<div class="container">
<div class="row">
<div class="col-md-12">
<?php dynamic_sidebar("hs_under_footer_logo"); ?>
</div>
</div></div></div>
<?php } ?>

<?php if ( buzzblogpro_getVariable('footer_lowest') == 'yes' or buzzblogpro_getVariable('footer_lowest') == '') { ?> 
<?php if (buzzblogpro_getVariable('footer_lowest_fullwidth')== 'yes') {$container = 'container-fluid'; }else{$container = 'container';} ?>
<div class="lowestfooter"><div class="<?php echo esc_attr($container); ?>"><div class="row">
<div class="col-sx-12 col-md-6">
<?php if ( buzzblogpro_getVariable('footer_menu') == 'yes') { ?> 
		<?php get_template_part("static/static-footer-nav"); ?>
			
	<?php } ?>
	</div>

<div class="col-sx-12 col-md-6">
<?php $hs_footer_text = buzzblogpro_getVariable('footer_text') ? buzzblogpro_getVariable('footer_text') : esc_html__('Copyrights &copy; 2018 BUZZBLOGPRO. All Rights Reserved.','buzzblogpro');
if($hs_footer_text) { ?>
<div id="footer-text" class="footer-text">
		<?php echo wp_kses_post($hs_footer_text); ?>
</div>
<?php } ?>
			</div>
	</div></div></div>
<?php } ?>