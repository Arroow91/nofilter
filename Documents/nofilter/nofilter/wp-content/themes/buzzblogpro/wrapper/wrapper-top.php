<?php /* Wrapper Name: Top */ ?>
<?php if (buzzblogpro_getVariable('fullwidth_menu')== 'yes') {$container = 'container-fluid'; }else{$container = 'container';} ?>
<?php if ( is_active_sidebar( 'hs_top_instagram' ) && !buzzblogpro_is_touch('phone') ) : dynamic_sidebar("hs_top_instagram"); endif; ?>
<?php if ( is_active_sidebar( 'hs_top_0' ) ) : ?>
<div class="top0-container-full visible-md-block visible-lg-block">
<div class="<?php echo esc_attr($container); ?>">
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 top-full">
        <?php dynamic_sidebar("hs_top_0"); ?>
    </div>
</div>
</div>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'hs_top_1' ) OR is_active_sidebar( 'hs_top_2' ) or has_nav_menu( 'top-menu' ) ) : ?>
<div class="top-container top-border visible-md-block visible-lg-block">
<div class="<?php echo esc_attr($container); ?>">
        
<div class="row">

    <div class="col-md-6 col-sm-6 col-xs-4 top-left">
	<?php if( has_nav_menu( 'top-menu' ) ) : ?>
					
					<?php if (function_exists('wp_nav_menu')) { ?>
					<nav id="top-navigation" class="top-nav-menu visible-md-block visible-lg-block">
						<?php wp_nav_menu(array('theme_location' => 'top-menu' , 'fallback_cb' => '' , 'container'  => '' , 'menu_id' => 'top-menu' , 'menu_class' => 'top-menu')); ?>
					</nav>
					<?php } ?>
				<?php endif; ?>

        <?php dynamic_sidebar("hs_top_1"); ?>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-8 top-right">
        <?php dynamic_sidebar("hs_top_2"); ?>
		
    </div>
</div>

</div>

</div>

<?php endif; ?>