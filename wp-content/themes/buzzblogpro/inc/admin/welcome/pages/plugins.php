	<div class="wrap buzzblog-getting-started">
		<div class="intro-wrap">
			<div class="intro">
				<a href="<?php echo esc_url('https://buzzblogpro.hercules-design.com/demo/'); ?>"><img class="buzzblog-logo" src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/assets/css/logo.png' ); ?>" alt="<?php esc_html_e( 'BuzzBlog', 'buzzblog' ); ?>" /></a>	
				<h3><?php printf( esc_html__( 'Welcome to', 'buzzblog' ) ); ?> <strong><?php echo Buzzblogpro_Theme_Admin::$buzzblogpro_theme_name; ?></strong></h3>
				<p class="wp-buzzblogpro-badge">
	 <?php echo esc_html__( 'Version: ', 'buzzblogpro' ).Buzzblogpro_Theme_Admin::$buzzblogpro_theme_version; ?></p>
			</div>


			
			
			<?php

$buzzblogpro_links = array(
	'buzzblogpro-plugins'			  				=> 'Install Plugins'
	
);
	if ( class_exists( 'Redux' ) && function_exists( 'buzzblogpro_register_widgets' ) ) {
	$buzzblogpro_links['buzzblogpro_options_options'] = 'Theme Options';
	}
?>
<ul class="inline-list">
<?php
	foreach ( $buzzblogpro_links as $link_id => $title ) {
		?>
		<li class="<?php if ( $link_id === $_GET['page']) { echo ' current'; } ?>"><a href="<?php echo esc_url("admin.php?page={$link_id}"); ?>" >
			<?php echo esc_attr($title); ?>
		</a></li>
		<?php
	}
?>
</ul>

		</div>
		
		<div class="panels">
			<div id="panel" class="panel">
		<p class="about-text welcome-text">
	<?php echo Buzzblogpro_Theme_Admin::$buzzblogpro_theme_name.esc_html__( ' is now installed and ready to use with your WordPress site. Please install required plugins.', 'buzzblogpro' ); ?> 
</p>
<div class="theme-browser buzzblogpro-plugins buzzblogpro-content">
		<?php
		$plugins = TGM_Plugin_Activation::$instance->plugins;
		$i = 0;
		foreach( $plugins as $plugin ):
			//if (!$plugin['required']) continue;
	
			$file_path = $plugin['file_path'];
			
			$actions = Buzzblogpro_Theme_Admin()->buzzblogpro_plugins_install( $plugin );

			if( is_plugin_active( $file_path ) ) {
				$plugin_status = 'active';
				$class = 'active';
			}
		?>
		<div class="theme">
			<div class="theme-screenshot"><img src="<?php echo esc_attr($plugin['image_url']); ?>" /></div>
			<?php if( isset( $actions['update'] ) && $actions['update'] ): ?>
			<div class="update-message notice inline notice-warning notice-alt"><p><?php esc_html_e( 'New version available.', 'buzzblogpro' ); ?></p></div> 
			<?php endif; ?>
			<?php if( $plugin['required']) { ?>
			<div class="notice inline error notice-alt"><p><?php if( is_plugin_active( $file_path ) ) {esc_html_e( 'Installed', 'buzzblogpro' ); }else{esc_html_e( 'Required', 'buzzblogpro' ); }?></p></div>
			<?php } ?>
			<h3 class="theme-name" id=""><?php echo esc_attr($plugin['name']); ?></h3>
			<div class="theme-actions">
				<?php foreach( $actions as $action ) { echo $action; } ?> 
			</div>

			
		</div>
	
		<?php $i++; endforeach; ?>
	</div>
				</div></div>
</div>



