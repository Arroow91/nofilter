<?php if (buzzblogpro_getVariable('fullwidth_menu')== 'yes') {$container = 'container-fluid fullwidthmenu'; }else{$container = 'container';} ?>
<?php
if ( !is_home() && buzzblogpro_getVariable('remove_header_other_pages') =='yes' or !is_front_page() && buzzblogpro_getVariable('remove_header_other_pages') =='yes' ) {
}else{
?>
<div class="<?php echo esc_attr($container); ?>">
<div class="top-ads-container">
<div class="row row-eq-height">
    <div class="col-sm-3 col-md-3">
         <div class="logo-ads-left">
        <?php get_template_part("static/static-logo"); ?>
    </div>
    </div>
	    <div class="col-sm-9 col-md-9 left-space">
         <div class="right-ads ">
        <?php dynamic_sidebar("hs_ads"); ?>
    </div>
    </div>
</div></div>
</div>
<?php } ?>
<?php
if (buzzblogpro_getVariable('header_position')== 'stickyheader') { ?>
<div class="sticky-wrapper">
<div class="sticky-nav">
<?php } ?>
<?php if (buzzblogpro_getVariable('mainmenu_shadow_menu')== 'yes') { ?>
<div class="shadow-menu">
<?php } ?>
<div class="<?php echo esc_attr($container); ?>">
<div class="row ads-below-menu">
<div class="col-md-12 col-sm-12 col-xs-12 top-left">
	<?php
get_template_part("static/static-nav");
?>
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