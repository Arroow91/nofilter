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
                <div class="row">
                    <div class="col-md-<?php echo esc_attr( $main_class); ?> content <?php if (buzzblogpro_getVariable('blog_sidebar_pos')==''){echo 'right';}else{echo esc_attr( buzzblogpro_getVariable('blog_sidebar_pos')); } ?>" id="content" role="main">
                        <?php get_template_part("loop/loop-blog-main"); ?>
                    </div>
                    <div class="col-md-<?php echo esc_attr( $sidebar_class); ?> sidebar <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
                       <div class="theiaStickySidebar">
                        <?php dynamic_sidebar("hs_main_sidebar"); ?>
                    </div></div>
                </div>
    </div>
</div>
<?php get_footer(); ?>