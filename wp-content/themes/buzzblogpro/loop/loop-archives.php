<?php /* Loop Name: Loop archives */ ?>
<div class="post-content">
<?php the_content(); ?>
</div>
        <div class="archive_lists">
		
            <div class="row category-filter">
<div class="col-md-4 col-sm-4 col-xs-4" >

	<form id="category-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

		<?php
		$args = array(
			'show_option_none' => esc_html__( 'Select category', 'buzzblogpro' ),
			'show_count'       => 1,
			'orderby'          => 'name',
			'echo'             => 0,
		);
		?>

		<?php $select  = wp_dropdown_categories( $args ); ?>
		<?php $replace = "<select$1 onchange='return this.form.submit()'>"; ?>
		<?php $select  = preg_replace( '#<select([^>]*)>#', $replace, $select ); ?>

		<?php echo balanceTags($select); ?>


	</form>
</div>
<div class="col-md-4 col-sm-4 col-xs-4" >

				<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
  <option value=""><?php esc_html_e('Select Month', 'buzzblogpro'); ?></option> 
  <?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
</select>
</div>
<div class="col-md-4 col-sm-4 col-xs-4" >
<?php get_search_form(); ?>

</div>
</div>
        </div>
		
<div class="grid js-masonry ajax-container row">
<?php 

	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
$blog_class = '4';
$args = array( 'post_type' => 'post', 'paged' => $paged, 'ignore_sticky_posts' => 1 );

$loop = new WP_Query( $args );
	 if ($loop->have_posts()) : 
	 while ($loop->have_posts()) : $loop->the_post();
	 ?>
<div class="grid-item ajax-post-wrapper block col-xs-12 col-sm-6 col-md-<?php echo esc_attr( $blog_class); ?>" > 
<div class="grid-block">
		
<?php get_template_part('post-template/content', 'masonry'); ?>
	</div>
</div>
<?php 
 endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php else: ?>	
<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
</div>
<div class="row pagination-below">
					<div class="col-md-12">
					<?php 
$pagination_type = buzzblogpro_getVariable('pagination_type');
if(function_exists('buzzblogpro_hs_pagination') && $pagination_type=='pagnum') : ?>
  <?php buzzblogpro_hs_pagination($loop->max_num_pages); ?>
<?php endif; ?>
<?php 
if ( $loop->max_num_pages > 1 && $pagination_type=='paglink' ) : ?>
    <div class="paglink">
      <span class="pull-left">
	  <?php previous_posts_link(theme_locals("newer")); ?>
	  </span>
	   <span class="pull-right">
        <?php next_posts_link(theme_locals("older"), $loop->max_num_pages); ?>
	  </span>
    </div>
					<?php endif; ?>
  		<?php
		if ( $loop->max_num_pages > 1 && $pagination_type=='loadmore' or $loop->max_num_pages > 1 && $pagination_type=='infinite' ) { 
		$all_num_pages = $loop -> max_num_pages;
  $next_page_url = buzzblogpro_next_page($all_num_pages);

?>
<div class="ajax-pagination-container">
  <a href="<?php echo esc_url($next_page_url); ?>" id="ajax-load-more-posts-button"></a>
</div>
<?php } ?>
</div></div>