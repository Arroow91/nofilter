<?php if (has_nav_menu('primary-menu')) { ?> 
<nav id="primary" class="sidemenu sidemenu-off top-icon-wrap" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
<?php if (buzzblogpro_getVariable('header_layout') == 'left') {
get_template_part("static/static-logo");
} 
?>	
<?php 
$alignitemsl = $alignitemsr = '';
if (buzzblogpro_getVariable('split_menu_align_items') == 'yes') { 
$alignitemsl = ' alignsideleft';
$alignitemsr = ' alignsideright';
} ?>
				<?php if (buzzblogpro_getVariable('header_layout') == 'split') {
				
				$isspit = "primary-menu left-menu";
				}else{
				$isspit = "primary-menu";
				}
				buzzblogpro_theme_main_menu('primary-menu', $isspit.$alignitemsl );
				?>
<?php 
if (buzzblogpro_getVariable('header_layout') != 'fullwidthleftright'&& buzzblogpro_getVariable('header_layout') != 'fullwidthleftright-logo-below' ) {
get_template_part( 'includes/cart' ); 
} ?>		
<?php if (buzzblogpro_getVariable('header_layout') == 'split') {

get_template_part("static/static-logo");
buzzblogpro_theme_main_menu('split-right-menu', 'primary-menu right-menu'.$alignitemsr.'');} ?>
			</nav>
<?php } ?>