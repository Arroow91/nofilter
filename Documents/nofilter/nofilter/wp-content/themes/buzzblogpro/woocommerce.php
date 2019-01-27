<?php get_header(); ?>
<div class="content-holder clearfix">
<?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && !is_singular( 'product' ) && !is_paged() && buzzblogpro_getVariable('woocommerce_slideshow_disable')!='yes' ) { ?> 
<?php if (buzzblogpro_getVariable('blog_slideshow')=='fullwidth' ) { ?> 
<?php buzzblogpro_slideshowClass::buzzblogpro_slideshow(); ?> 
				<?php }else{ ?> 
				 
				<div class="container" <?php if(buzzblogpro_getVariable('slideshow_container_width')) {echo 'style = "max-width: '.buzzblogpro_getVariable('slideshow_container_width').'px;"';} ?>>
				<div class="row">
				<div class="col-md-12">
<?php buzzblogpro_slideshowClass::buzzblogpro_slideshow(); ?>
				</div>
				</div>
				 </div>
				 <?php } } ?> 
	<div class="container">
	<?php if ( !is_singular( 'product' ) && !is_paged() && !is_product_category() && !is_product_tag() ) { ?>
	<div class="row">
				<div class="col-md-12"><section class="title-section">
			<?php
				$buzzblogpro_blog_text = buzzblogpro_getVariable('woocommerce_title');
				 if($buzzblogpro_blog_text){?>
					<h1><?php echo esc_attr( buzzblogpro_getVariable('woocommerce_title')); ?></h1>
				<?php } ?>
				<?php $hercules_blog_sub = buzzblogpro_getVariable('woocommerce_subtitle'); ?>
				<?php if($hercules_blog_sub){?>
					<?php echo "<span></span><h2>". esc_attr( buzzblogpro_getVariable('woocommerce_subtitle') ) . "</h2>"; 	?>
				<?php } ?>
				</section></div>
				</div>
					<?php } ?>
					
				<?php if ( is_product_category() or is_product_tag()) { ?>
				<section class="title-section"><div class="row">
				<div class="col-md-12">
				<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
				<?php woocommerce_breadcrumb(); ?>
				</div>
				</div></section>
				<?php } ?>
					
				<?php if ( is_active_sidebar( 'hs_under_header' ) ) : ?>

				<div class="row">
				<div class="col-md-12">
				<?php dynamic_sidebar("hs_under_header"); ?>
				</div>
				</div>
				
				<?php endif; ?>
				     <div class="row main-page">
					 
					 					 <?php
					if ( is_singular( 'product' ) ) { ?>
					
					<div class="col-md-12 content" id="content"><?php woocommerce_breadcrumb(); ?>
<?php
			while ( have_posts() ) : the_post();

				wc_get_template_part( 'content', 'single-product' );

			endwhile; ?>
 </div>
		 <?php } else {?>
					 
				<?php if (buzzblogpro_getVariable('woocommerce_sidebar_pos')=='right' or buzzblogpro_getVariable('woocommerce_sidebar_pos')=='') { ?>   
                    <div class="col-md-8 content" id="content">
                        <?php 
						get_template_part("loop/loop-woocommerce"); ?>
                    </div>
                 <div class="col-md-4 sidebar" id="sidebar">
                        <?php dynamic_sidebar("hs_woocommerce_sidebar"); ?>
                    </div>
					<?php } ?> 
					<?php if (buzzblogpro_getVariable('woocommerce_sidebar_pos')=='left') { ?>   
                    <div class="col-md-8 col-md-push-4 content" id="content">
                         <?php get_template_part("loop/loop-woocommerce"); ?>
                    </div>
                 <div class="col-md-4 col-md-pull-8 sidebar left" id="sidebar">
                        <?php dynamic_sidebar("hs_woocommerce_sidebar"); ?>
                    </div>
					<?php } ?> 
					<?php if (buzzblogpro_getVariable('woocommerce_sidebar_pos')=='full') { ?>   
                    <div class="col-md-12 content" id="content">
 <?php get_template_part("loop/loop-woocommerce"); ?>
                    </div>
					<?php } ?>
					
 <?php } ?>
					
                      </div>
	</div>
</div>
<?php get_footer(); ?>