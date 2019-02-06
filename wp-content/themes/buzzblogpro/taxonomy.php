<?php get_header(); 
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
<div class="container">
<?php get_template_part('title'); ?>
				<?php if ( is_active_sidebar( 'hs_under_header' ) ) : ?>

				<div class="row">
				<div class="col-md-12">
				<?php dynamic_sidebar("hs_under_header"); ?>
				</div>
				</div>
				
				<?php endif; ?>

                <div class="row">
				<?php if (buzzblogpro_getVariable('blog_cat_sidebar_pos')=='right' or buzzblogpro_getVariable('blog_cat_sidebar_pos')=='') { ?>   
                    <div class="col-md-<?php echo esc_attr( $main_class); ?>" id="content">
					
                        <?php get_template_part("loop/loop-blog-main"); ?>
						<?php get_template_part('post-template/post-nav'); ?>
                    </div>
					
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
				 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
					<?php } ?> 
					<?php if (buzzblogpro_getVariable('blog_cat_sidebar_pos')=='left') { ?> 					
                    <div class="col-md-<?php echo esc_attr( $main_class); ?> col-md-push-<?php echo esc_attr( $sidebar_class); ?>" id="content">
					 
                        <?php get_template_part("loop/loop-blog-main"); ?>
						<?php get_template_part('post-template/post-nav'); ?>
                    </div>
					
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> col-md-pull-<?php echo esc_attr( $main_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?> left" id="sidebar">
                        		 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                   
					<?php } ?> 
					<?php if (buzzblogpro_getVariable('blog_cat_sidebar_pos')=='full') { ?>   
                    <div class="col-md-12" id="content">
					
                        <?php get_template_part("loop/loop-blog-main"); ?>
						<?php get_template_part('post-template/post-nav'); ?>
                    </div>
					
					<?php } ?>
					<?php if (buzzblogpro_getVariable('blog_cat_sidebar_pos')=='masonry2' or buzzblogpro_getVariable('blog_cat_sidebar_pos')=='masonry3' or buzzblogpro_getVariable('blog_cat_sidebar_pos')=='masonry4' or is_category( 'inspo' )) { ?>   
                    <div class="col-md-12" id="content">
					 
					<div class="grid js-masonry ajax-container row">
                        <?php 
						get_template_part("loop/loop-masonry-cat-blog"); ?>
                    </div>
					<div class="row">
					<div class="col-md-12">
					<?php get_template_part('post-template/post-nav'); ?>
					</div></div>
					</div>
					<?php } ?>
					<?php if (buzzblogpro_getVariable('blog_cat_sidebar_pos')=='masonry2sideright' && !is_category( 'inspo' )) { 
					 ?>   
                    <div class="col-md-<?php echo esc_attr( $main_class); ?>" id="content">
					

					<div class="grid js-masonry ajax-container row">
                         <?php 
						get_template_part("loop/loop-masonry-cat-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
                        		 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                   
					<?php } ?> 
					<?php if (buzzblogpro_getVariable('blog_cat_sidebar_pos')=='masonry2sideleft') {
                    ?>   
					 <div class="col-md-<?php echo esc_attr( $main_class); ?> col-md-push-<?php echo esc_attr( $sidebar_class); ?> " id="content">
					

					<div class="grid js-masonry ajax-container row">
                         <?php 
						
						get_template_part("loop/loop-masonry-cat-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> col-md-pull-<?php echo esc_attr( $main_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?> left" id="sidebar">
                        		 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                  
					<?php } ?> 
					
										<?php if (buzzblogpro_getVariable('blog_cat_sidebar_pos')=='listpostsideright') { 
					 ?>   
                    <div class="col-md-<?php echo esc_attr( $main_class); ?>" id="content">
					
					<div class="list-post ajax-container row">
                         <?php 
						get_template_part("loop/loop-list-cat-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
                       		 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                   
					<?php } ?> 
					
					<?php if (buzzblogpro_getVariable('blog_cat_sidebar_pos')=='listpostsideleft') {
                    ?>   
					 <div class="col-md-<?php echo esc_attr( $main_class); ?> col-md-push-<?php echo esc_attr( $sidebar_class); ?> " id="content">
					
                     <div class="list-post ajax-container row">
                         <?php 
						get_template_part("loop/loop-list-cat-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> col-md-pull-<?php echo esc_attr( $main_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?> left" id="sidebar">
                        		 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                   
					<?php } ?> 
					<?php if (buzzblogpro_getVariable('blog_cat_sidebar_pos')=='listpostfullwidth') {
                    ?>   
					 <div class="col-md-12 " id="content">
					 
                     <div class="list-post ajax-container fullwidth row">
                         <?php 
						get_template_part("loop/loop-list-cat-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
					<?php } ?> 
										<?php if (buzzblogpro_getVariable('blog_cat_sidebar_pos')=='zigzagfullwidth') { ?>   
					 <div class="col-md-12 " id="content">
					 
                     <div class="list-post fullwidth ajax-container row">
                         <?php 
						get_template_part("loop/loop-zigzag-cat-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
					<?php } ?> 
					
					
					
					
															<?php if (buzzblogpro_getVariable('blog_cat_sidebar_pos')=='zigzagsideright') { 
					 ?>   
                    <div class="col-md-<?php echo esc_attr( $main_class); ?>" id="content">
					
					<div class="list-post ajax-container row">
                         <?php 
						get_template_part("loop/loop-zigzag-cat-blog-sidebar"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
                       		 <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                   
					<?php } ?> 
					
					<?php if (buzzblogpro_getVariable('blog_cat_sidebar_pos')=='zigzagsideleft') {
                    ?>   
					 <div class="col-md-<?php echo esc_attr( $main_class); ?> col-md-push-<?php echo esc_attr( $sidebar_class); ?> " id="content">
					
                     <div class="list-post ajax-container row">
                         <?php 
						get_template_part("loop/loop-zigzag-cat-blog-sidebar"); ?>
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
</div>
<?php get_footer(); ?>