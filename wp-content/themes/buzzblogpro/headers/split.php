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