<?php /* Static Name: Logo */ ?>
<!-- BEGIN LOGO -->                     
<div class="logo">                            
		<?php if(buzzblogpro_getVariable('logo_type') == 'off' or buzzblogpro_getVariable('logo_type') == ''){ ?>
				<div class="logo_h logo_h__txt"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('description'); ?>" class="logo_link"><?php bloginfo( 'name' ); ?></a></div>
				<!-- Site Tagline -->
				<?php if(buzzblogpro_getVariable('logo_tagline') == 'yes'){ ?>
				<p class="logo_tagline"><span><?php bloginfo('description'); ?></span></p>
				<?php } ?>	
		<?php } else { ?>
				<?php if(buzzblogpro_getVariable('logo_url','url') == ''){ ?>
						<div class="logo_h logo_h__txt"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('description'); ?>" class="logo_link"><?php bloginfo( 'name' ); ?></a></div>
				<!-- Site Tagline -->
				<p class="logo_tagline"><span><?php bloginfo('description'); ?></span></p>
				<?php } else  { ?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo_h logo_h__img"><img src="<?php echo esc_url( buzzblogpro_getVariable('logo_url','url')); ?>" width="<?php echo esc_attr( buzzblogpro_getVariable('logo_url','width')); ?>" height="<?php echo esc_attr( buzzblogpro_getVariable('logo_url','height')); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
				<?php if(buzzblogpro_getVariable('logo_tagline') == 'yes'){ ?>		
				<p class="logo_tagline"><span><?php bloginfo('description'); ?></span></p>
				<?php } ?>
				<?php } ?>
		<?php } ?>	
<?php if ( is_active_sidebar( 'hs_under_header_logo' ) ) { ?>
<?php dynamic_sidebar("hs_under_header_logo"); 
} ?>		
</div>

<!-- END LOGO -->