<!-- Show this box once the theme is updated -->
<?php 
		$protocol = isset( $_SERVER['https'] ) ? 'https://' : 'http://';
		$buzzblogpro_ajax_url = admin_url( 'admin-ajax.php', $protocol );
?>
<script>
	(function($) {
		$(document).ready(function() {
				$("body").on('click', '#buzzblogpro_update_box_hide',function(e){
	    			e.preventDefault();
	    			$(this).parent().remove();
	    			$.post('<?php echo esc_url($buzzblogpro_ajax_url); ?>', {action: 'buzzblogpro_update_version'}, function(response) {});
    			});

		});
	})(jQuery);

</script>

<div class="notice notice-success is-dismissible">
	
	<a href="#" class="welcome-panel-close" id="buzzblogpro_update_box_hide">Dismiss</a>

	<div class="welcome-panel-content">
		
		<h2>Congratulations, your website just got better!</h2>
		<p class="about-description">BUZZBLOGPRO has been successfully updated to version <?php echo BUZZBLOGPRO_THEME_VERSION; ?></p>

	</div>

</div>