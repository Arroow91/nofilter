<?php /* Static Name: Footer navigation */
	if (has_nav_menu('footer_menu')) {
		if ( buzzblogpro_getVariable('footer_menu') == 'yes') { ?>  
		<nav class="nav footer-nav">
			<?php wp_nav_menu( array(
				'container'       => 'ul',
				'depth'           => 0,
				'theme_location' => 'footer_menu' 
				)); 
			?>
		</nav>
	<?php }
	}
?>