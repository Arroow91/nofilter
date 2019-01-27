<?php 
get_header(); 
$sidebar_width = buzzblogpro_getVariable('sidebar_width') ? buzzblogpro_getVariable('sidebar_width') : 'smaller';
switch ($sidebar_width) {
		case 'bigger':
			$sidebar_class = '4';
			$main_class = '8';
		break;
		case 'smaller':
			$sidebar_class = '3';
			$main_class = '9';
		break;
	}
?>
<div class="content-holder clearfix">
<?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && buzzblogpro_getVariable('blog_slideshow')!='inside' && !is_paged()) { ?> 
<div class="slideshow-bg"> 
<?php if (buzzblogpro_getVariable('blog_slideshow')=='fullwidth' ) { ?> 
<?php if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();} ?> 
				<?php }else{ ?> 
				
				<div class="container" <?php if(buzzblogpro_getVariable('slideshow_container_width')) {echo 'style = "max-width: '.buzzblogpro_getVariable('slideshow_container_width').'px;"';} ?>>
				<div class="row">
				<div class="col-md-12">
<?php if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();} ?>
				</div>
				</div>
				 </div>
				 <?php } ?>
				 </div>
				  <?php } ?> 
				 
 <?php if(buzzblogpro_getVariable('blog_sidebar_pos') != 'metro') { ?> 
<div class="container">
<?php get_template_part('title'); ?>
				<?php if ( is_active_sidebar( 'hs_under_header' ) ) : ?>

				<div class="row">
				<div class="col-md-12">
				<?php dynamic_sidebar("hs_under_header"); ?>
				</div>
				</div>
				
				<?php endif; ?>
				<?php if (buzzblogpro_getVariable('trending_slideshow') == 'yes' && !is_paged() ) { get_template_part('post-template/trending'); } ?>
		
				<?php if (buzzblogpro_getVariable('promotion_enable')=='yes' && !is_paged()) { buzzblogpro_promo_areaslides(); } ?>
				</div>
				
				<?php if ( is_active_sidebar( 'hs_front_page_1' ) && !is_paged() ) : ?>

				<?php dynamic_sidebar("hs_front_page_1"); ?>
				
				<?php endif; ?>
				
				<div class="container">
                <div class="row main-blog">
				<?php if (buzzblogpro_getVariable('blog_sidebar_pos')=='right' or buzzblogpro_getVariable('blog_sidebar_pos')=='') { ?>   
                    <div class="col-md-<?php echo esc_attr( $main_class); ?>" id="content">
					<?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && buzzblogpro_getVariable('blog_slideshow')=='inside' && !is_paged() ) {if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();}} ?> 
                        <?php if ( is_active_sidebar( 'hs_before_blog' ) && !is_paged() ) {dynamic_sidebar("hs_before_blog"); } ?>
						<?php get_template_part('post-template/masonry-stickypost-template'); ?>
						<?php get_template_part("loop/loop-blog-main"); ?>
						<?php get_template_part('post-template/post-nav'); ?>
                    </div>
					
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
				 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
					<?php } ?> 
					<?php if (buzzblogpro_getVariable('blog_sidebar_pos')=='left') { ?> 					
                    <div class="col-md-<?php echo esc_attr( $main_class); ?> col-md-push-<?php echo esc_attr( $sidebar_class); ?>" id="content">
					<?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && buzzblogpro_getVariable('blog_slideshow')=='inside' && !is_paged() ) {if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();}} ?> 
<?php if ( is_active_sidebar( 'hs_before_blog' ) && !is_paged() ) {dynamic_sidebar("hs_before_blog"); } ?>
                        <?php get_template_part('post-template/masonry-stickypost-template'); ?>
						<?php get_template_part("loop/loop-blog-main"); ?>
						<?php get_template_part('post-template/post-nav'); ?>
                    </div>
					
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> col-md-pull-<?php echo esc_attr( $main_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?> left" id="sidebar">
                        		 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                   
					<?php } ?> 
					<?php if (buzzblogpro_getVariable('blog_sidebar_pos')=='full') { ?>   
                    <div class="col-md-12" id="content">
					<?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && buzzblogpro_getVariable('blog_slideshow')=='inside' && !is_paged() ) {if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();}} ?> 
<?php if ( is_active_sidebar( 'hs_before_blog' ) && !is_paged() ) {dynamic_sidebar("hs_before_blog"); } ?>
<?php get_template_part('post-template/masonry-stickypost-template'); ?>                       
					   <?php get_template_part("loop/loop-blog-main"); ?>
						<?php get_template_part('post-template/post-nav'); ?>
                    </div>
					
					<?php } ?>
					<?php if (buzzblogpro_getVariable('blog_sidebar_pos')=='masonry2' or buzzblogpro_getVariable('blog_sidebar_pos')=='masonry3' or buzzblogpro_getVariable('blog_sidebar_pos')=='masonry4') { ?>   
                    <div class="col-md-12" id="content">
					<?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && buzzblogpro_getVariable('blog_slideshow')=='inside' && !is_paged() ) {if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();}} ?>
<?php if ( is_active_sidebar( 'hs_before_blog' ) && !is_paged() ) {dynamic_sidebar("hs_before_blog"); } ?>				
					<?php get_template_part('post-template/masonry-stickypost-template'); ?>
					<div class="grid js-masonry ajax-container row">
                        <?php 
						get_template_part("loop/loop-masonry-blog"); ?>
                    </div>
					<div class="row">
					<div class="col-md-12">
					<?php get_template_part('post-template/post-nav'); ?>
					</div></div>
					</div>
					<?php } ?>
					<?php if (buzzblogpro_getVariable('blog_sidebar_pos')=='masonry2sideright') { 
					 ?>   
                    <div class="col-md-<?php echo esc_attr( $main_class); ?>" id="content">
					<?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && buzzblogpro_getVariable('blog_slideshow')=='inside' && !is_paged() ) {if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();}} ?> 
<?php if ( is_active_sidebar( 'hs_before_blog' ) && !is_paged() ) {dynamic_sidebar("hs_before_blog"); } ?>
					<?php get_template_part('post-template/masonry-stickypost-template'); ?>
					<div class="grid js-masonry ajax-container row">
                         <?php 
						get_template_part("loop/loop-masonry-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
                        		 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                   
					<?php } ?> 
					<?php if (buzzblogpro_getVariable('blog_sidebar_pos')=='masonry2sideleft') {
                    ?>   
					 <div class="col-md-<?php echo esc_attr( $main_class); ?> col-md-push-<?php echo esc_attr( $sidebar_class); ?> " id="content">
					 <?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && buzzblogpro_getVariable('blog_slideshow')=='inside' && !is_paged() ) {if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();}} ?> 
<?php if ( is_active_sidebar( 'hs_before_blog' ) && !is_paged() ) {dynamic_sidebar("hs_before_blog"); } ?>
					 <?php get_template_part('post-template/masonry-stickypost-template'); ?>
					<div class="grid js-masonry ajax-container row">
                         <?php 
						
						get_template_part("loop/loop-masonry-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> col-md-pull-<?php echo esc_attr( $main_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?> left" id="sidebar">
                        		 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                  
					<?php } ?> 
					
										<?php if (buzzblogpro_getVariable('blog_sidebar_pos')=='listpostsideright') { 
					 ?>   
                    <div class="col-md-<?php echo esc_attr( $main_class); ?>" id="content">
					<?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && buzzblogpro_getVariable('blog_slideshow')=='inside' && !is_paged() ) {if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();}} ?> 
<?php if ( is_active_sidebar( 'hs_before_blog' ) && !is_paged() ) {dynamic_sidebar("hs_before_blog"); } ?>
<?php get_template_part('post-template/masonry-stickypost-template'); ?>
					<div class="list-post ajax-container row">
                         <?php 
						get_template_part("loop/loop-list-post-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
                       		 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                   
					<?php } ?> 
					
					<?php if (buzzblogpro_getVariable('blog_sidebar_pos')=='listpostsideleft') {
                    ?>   
					 <div class="col-md-<?php echo esc_attr( $main_class); ?> col-md-push-<?php echo esc_attr( $sidebar_class); ?> " id="content">
					 <?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && buzzblogpro_getVariable('blog_slideshow')=='inside' && !is_paged() ) {if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();}} ?> 
<?php if ( is_active_sidebar( 'hs_before_blog' ) && !is_paged() ) {dynamic_sidebar("hs_before_blog"); } ?>
<?php get_template_part('post-template/masonry-stickypost-template'); ?>
                     <div class="list-post ajax-container row">
                         <?php 
						get_template_part("loop/loop-list-post-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> col-md-pull-<?php echo esc_attr( $main_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?> left" id="sidebar">
                        		 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                   
					<?php } ?> 
					<?php if (buzzblogpro_getVariable('blog_sidebar_pos')=='listpostfullwidth') {
                    ?>   
					 <div class="col-md-12 " id="content">
					 <?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && buzzblogpro_getVariable('blog_slideshow')=='inside' && !is_paged() ) {if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();}} ?> 
<?php if ( is_active_sidebar( 'hs_before_blog' ) && !is_paged() ) {dynamic_sidebar("hs_before_blog"); } ?>
<?php get_template_part('post-template/masonry-stickypost-template'); ?>
                     <div class="list-post ajax-container fullwidth row">
                         <?php 
						get_template_part("loop/loop-list-post-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
					<?php } ?> 
										<?php if (buzzblogpro_getVariable('blog_sidebar_pos')=='zigzagfullwidth') { ?>   
					 <div class="col-md-12 " id="content">
					  <?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && buzzblogpro_getVariable('blog_slideshow')=='inside' && !is_paged() ) {if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();}} ?> 
<?php if ( is_active_sidebar( 'hs_before_blog' ) && !is_paged() ) {dynamic_sidebar("hs_before_blog"); } ?>
<?php get_template_part('post-template/masonry-stickypost-template'); ?>
                     <div class="zigzag list-post fullwidth ajax-container row">
                         <?php 
						get_template_part("loop/loop-zigzag-post-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
					<?php } ?> 
					
															<?php if (buzzblogpro_getVariable('blog_sidebar_pos')=='zigzagsideright') { 
					 ?>   
                    <div class="col-md-<?php echo esc_attr( $main_class); ?>" id="content">
					<?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && buzzblogpro_getVariable('blog_slideshow')=='inside' && !is_paged() ) {if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();}} ?> 
<?php if ( is_active_sidebar( 'hs_before_blog' ) && !is_paged() ) {dynamic_sidebar("hs_before_blog"); } ?>
<?php get_template_part('post-template/masonry-stickypost-template'); ?>
					<div class="zigzag list-post ajax-container row">
                         <?php 
						get_template_part("loop/loop-zigzag-post-blog-sidebar"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
                       		 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                   
					<?php } ?> 
					
					<?php if (buzzblogpro_getVariable('blog_sidebar_pos')=='zigzagsideleft') {
                    ?>   
					 <div class="col-md-<?php echo esc_attr( $main_class); ?> col-md-push-<?php echo esc_attr( $sidebar_class); ?> " id="content">
					 <?php if (buzzblogpro_getVariable('slideshow_enable')=='yes' && buzzblogpro_getVariable('blog_slideshow')=='inside' && !is_paged() ) {if( class_exists( 'buzzblogpro_slideshowClass' ) ) {buzzblogpro_slideshowClass::buzzblogpro_slideshow();}} ?> 
<?php if ( is_active_sidebar( 'hs_before_blog' ) && !is_paged() ) {dynamic_sidebar("hs_before_blog"); } ?>
<?php get_template_part('post-template/masonry-stickypost-template'); ?>
                     <div class="zigzag list-post ajax-container row">
                         <?php 
						get_template_part("loop/loop-zigzag-post-blog-sidebar"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> col-md-pull-<?php echo esc_attr( $main_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?> left" id="sidebar">
                        		 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                   
					<?php } ?> 
					
                      </div>
    </div>	
	<?php } ?> 
	
										<?php if (buzzblogpro_getVariable('blog_sidebar_pos')=='metro') { ?>   
										<div class="container">
                <div class="row"><div class="col-md-12">
										<?php if (buzzblogpro_getVariable('trending_slideshow') == 'yes' && !is_paged() ) { get_template_part('post-template/trending'); } ?>
				<?php if (buzzblogpro_getVariable('promotion_enable')=='yes' && !is_paged()) { buzzblogpro_promo_areaslides(); } ?>
				<?php if ( is_active_sidebar( 'hs_before_blog' ) && !is_paged() ) {dynamic_sidebar("hs_before_blog"); } ?>
						</div></div></div>				
					 <div class="container-fluido"><div class="col-md-12 " id="content">


                     <div class="metro-post fullwidth ajax-container row">  
                         <?php 
						get_template_part("loop/loop-metro-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div></div>
					<?php } ?> 
	
</div>
<?php 
if (buzzblogpro_getVariable('most-popular_post')=='yes') { ?> 
	<div class="most-commented">
	<div class="container">
				<div class="row">
				<div class="col-md-12"> 
			<?php get_template_part( 'post-template/most-popular-posts' ); ?>
				</div>
				</div>
				</div>
				</div>
<?php }	?> 
<?php get_footer(); ?>