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

$category = get_category( get_query_var( 'cat' ) );
$cat_id = $category->cat_ID;
$image_id = get_term_meta ( $cat_id, '_buzzblogpro_category-image-id_id', true );

$individual_layout = get_term_meta ( $cat_id, '_buzzblogpro_category_layout_format', true ) ? get_term_meta ( $cat_id, '_buzzblogpro_category_layout_format', true ) : 'right';
$cat_layout = $individual_layout =='inherit' ? buzzblogpro_getVariable('blog_cat_sidebar_pos') : $individual_layout;

?>
<div class="content-holder clearfix">


<?php
if (!empty($image_id)) {
?>

<?php 
$enable_parallax = buzzblogpro_getVariable('enable_header_parallax')== 'yes' ? 'scaled' : 'scaled'; 
$buzzblogpro_feat_image = wp_get_attachment_image_src($image_id, 'buzzblogpro-standard-large');
?>

<div style="background-image: url(<?php echo esc_attr($buzzblogpro_feat_image[0]);?>);" class="parallax-image modern-layout" data-herculesdesign-parallax='{"backgroundUrl":"<?php echo esc_attr($buzzblogpro_feat_image[0]);?>","backgroundSize":[<?php echo esc_attr($buzzblogpro_feat_image[1]);?>,<?php echo esc_attr($buzzblogpro_feat_image[2]);?>],"backgroundSizing":"<?php echo esc_attr($enable_parallax);?>","limitMotion":"0.7"}' >




<?php buzzblogpro_category_title(); ?></div>
<?php }else{ 
buzzblogpro_category_title();
} ?>


	<div class="container">

				<?php if ( is_active_sidebar( 'hs_under_header' ) ) : ?>

				<div class="row">
				<div class="col-md-12">
				<?php dynamic_sidebar("hs_under_header"); ?>
				</div>
				</div>
				
				<?php endif; ?>

                <div class="row">
				<?php if ($cat_layout=='right' or $cat_layout=='') { ?>   
                    <div class="col-md-<?php echo esc_attr( $main_class); ?>" id="content">
					
                        <?php get_template_part("loop/loop-blog-main"); ?>
						<?php get_template_part('post-template/post-nav'); ?>
                    </div>
					
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
				 
                        <?php get_sidebar(); ?>
                   </div>
					<?php } ?> 
					<?php if ($cat_layout=='left') { ?> 					
                    <div class="col-md-<?php echo esc_attr( $main_class); ?> col-md-push-<?php echo esc_attr( $sidebar_class); ?>" id="content">
					 
                        <?php get_template_part("loop/loop-blog-main"); ?>
						<?php get_template_part('post-template/post-nav'); ?>
                    </div>
					
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> col-md-pull-<?php echo esc_attr( $main_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?> left" id="sidebar">
                        		 
                        <?php get_sidebar(); ?>
                    </div>
                   
					<?php } ?> 
					<?php if ($cat_layout=='full') { ?>   
                    <div class="col-md-12" id="content">
					
                        <?php get_template_part("loop/loop-blog-main"); ?>
						<?php get_template_part('post-template/post-nav'); ?>
                    </div>
					
					<?php } ?>
					<?php if ($cat_layout=='masonry2' or $cat_layout=='masonry3' or $cat_layout=='masonry4') { ?>   
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
					<?php if ($cat_layout=='masonry2sideright') { 
					 ?>   
                    <div class="col-md-<?php echo esc_attr( $main_class); ?>" id="content">
					

					<div class="grid js-masonry ajax-container row">
                         <?php 
						get_template_part("loop/loop-masonry-cat-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
                        		 
                        <?php get_sidebar(); ?>
                    </div>
                   
					<?php } ?> 
					<?php if ($cat_layout=='masonry2sideleft') {
                    ?>   
					 <div class="col-md-<?php echo esc_attr( $main_class); ?> col-md-push-<?php echo esc_attr( $sidebar_class); ?> " id="content">
					

					<div class="grid js-masonry ajax-container row">
                         <?php 
						
						get_template_part("loop/loop-masonry-cat-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> col-md-pull-<?php echo esc_attr( $main_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?> left" id="sidebar">
                        		
                        <?php get_sidebar(); ?>
                    </div>
                  
					<?php } ?> 
					
										<?php if ($cat_layout=='listpostsideright') { 
					 ?>   
                    <div class="col-md-<?php echo esc_attr( $main_class); ?>" id="content">
					
					<div class="list-post ajax-container row">
                         <?php 
						get_template_part("loop/loop-list-cat-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
                       		
                        <?php get_sidebar(); ?>
                   </div>
                   
					<?php } ?> 
					
					<?php if ($cat_layout=='listpostsideleft') {
                    ?>   
					 <div class="col-md-<?php echo esc_attr( $main_class); ?> col-md-push-<?php echo esc_attr( $sidebar_class); ?> " id="content">
					
                     <div class="list-post ajax-container row">
                         <?php 
						get_template_part("loop/loop-list-cat-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> col-md-pull-<?php echo esc_attr( $main_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?> left" id="sidebar">
                        		 
                        <?php get_sidebar(); ?>
                    </div>
                   
					<?php } ?> 
					<?php if ($cat_layout=='listpostfullwidth') {
                    ?>   
					 <div class="col-md-12 " id="content">
					 
                     <div class="list-post ajax-container fullwidth row">
                         <?php 
						get_template_part("loop/loop-list-cat-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
					<?php } ?> 
										<?php if ($cat_layout=='zigzagfullwidth') { ?>   
					 <div class="col-md-12 " id="content">
					 
                     <div class="zigzag list-post fullwidth ajax-container row">
                         <?php 
						get_template_part("loop/loop-zigzag-cat-blog"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
					<?php } ?> 
					
					
					
					
															<?php if ($cat_layout=='zigzagsideright') { 
					 ?>   
                    <div class="col-md-<?php echo esc_attr( $main_class); ?>" id="content">
					
					<div class="zigzag list-post ajax-container row">
                         <?php 
						get_template_part("loop/loop-zigzag-cat-blog-sidebar"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
                       		 
                        <?php get_sidebar(); ?>
                    </div>
                   
					<?php } ?> 
					
					<?php if ($cat_layout=='zigzagsideleft') {
                    ?>   
					 <div class="col-md-<?php echo esc_attr( $main_class); ?> col-md-push-<?php echo esc_attr( $sidebar_class); ?> " id="content">
					
                     <div class="zigzag list-post ajax-container row">
                         <?php 
						get_template_part("loop/loop-zigzag-cat-blog-sidebar"); ?>
                    </div>
					<?php get_template_part('post-template/post-nav'); ?>
					</div>
                 <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> col-md-pull-<?php echo esc_attr( $main_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?> left" id="sidebar">
                        		 
                        <?php get_sidebar(); ?>
                   </div>
                   
					<?php } ?> 
                      </div>
               
    </div>
</div>
<?php get_footer(); ?>