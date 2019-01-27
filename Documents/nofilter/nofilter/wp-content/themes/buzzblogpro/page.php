<?php get_header(); ?>
<?php 
$deflayout = get_post_meta( get_the_ID(), '_buzzblogpro_standard_layout_format_page', true ) ? get_post_meta( get_the_ID(), '_buzzblogpro_standard_layout_format_page', true ) : 'layout1';
$layout = $deflayout =='inherit' ? buzzblogpro_getVariable('page_layout_options') : $deflayout;
?>
<div class="content-holder clearfix">
<?php if ( is_active_sidebar( 'hs_under_header' ) ) : ?>
<div class="container">
				<div class="row">
				<div class="col-md-12">
				<?php dynamic_sidebar("hs_under_header"); ?>
				</div>
				</div>
				</div>
				<?php endif; ?>
	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
		<?php get_template_part( 'page-template/'.$layout); ?>
	<?php endwhile; else : endif; ?>	
</div>
<?php get_footer(); ?>
