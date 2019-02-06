<?php
if ( !is_home() && buzzblogpro_getVariable('remove_header_other_pages') =='yes' or !is_front_page() && buzzblogpro_getVariable('remove_header_other_pages') =='yes' ) {
}else{
?>
<div class="container">

<div class="row row-eq-height">
    
	
	<?php if ( is_active_sidebar( 'hs_left_header_logo' ) OR is_active_sidebar( 'hs_right_header_logo' ) ) { ?>
	<div class="col-md-4 col-sm-4 col-xs-12 top-header-left-widget left-space">
	<?php dynamic_sidebar("hs_left_header_logo"); ?>
        </div>
		<div class="col-md-4 col-sm-4 col-xs-12 top-header-center-logo">
		<?php get_template_part("static/static-logo"); ?>
		</div>
			<div class="col-md-4 col-sm-4 col-xs-12 top-header-left-widget left-space">
	<?php dynamic_sidebar("hs_right_header_logo"); ?>
        </div>
		
		<?php }else{ ?>
		
		<div class="col-md-12">
   <?php get_template_part("static/static-logo"); ?>
   </div>
   
   <?php } ?>
</div>

</div>
 <?php } ?>
<?php if (buzzblogpro_getVariable('fullwidth_menu')== 'yes') {$container = 'container-fluid fullwidthmenu'; }else{$container = 'container';} ?>

<?php
if (buzzblogpro_getVariable('header_position')== 'stickyheader') { ?>
<div class="sticky-wrapper">
<div class="sticky-nav">
<?php } ?>
<?php if (buzzblogpro_getVariable('mainmenu_shadow_menu')== 'yes') { ?>
<div class="shadow-menu">
<?php } ?>
<div class="<?php echo esc_attr($container); ?>">
<div class="row">
	<div class="col-md-12">
<?php get_template_part("static/static-nav"); ?>
</div>
</div>
</div>
<?php if (buzzblogpro_getVariable('mainmenu_shadow_menu')== 'yes') { ?>
</div>
<?php } ?>
<?php
if (buzzblogpro_getVariable('header_position')== 'stickyheader') { ?>
</div>
</div>
<?php } ?>