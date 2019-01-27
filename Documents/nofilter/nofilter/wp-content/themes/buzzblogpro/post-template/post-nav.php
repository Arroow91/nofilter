<?php
global $wp_query;
?>
<div class="row pagination-below"><div class="col-md-12">
<?php 
$pagination_type = buzzblogpro_getVariable('pagination_type') ? buzzblogpro_getVariable('pagination_type') : 'pagnum';
if($pagination_type=='pagnum') : ?>
  <?php
  the_posts_pagination( array(
   'mid_size' => 3,
   'type' => 'list',
				'prev_text'          => theme_locals("prev"),
				'next_text'          => theme_locals("next")
			) );
			?>
<?php endif; ?>
<?php 
if ( $wp_query->max_num_pages > 1 && $pagination_type=='paglink' ) : ?>
    <div class="paglink">
     <span class="pull-left">
	  <?php previous_posts_link(theme_locals("newer")) ?>
</span>       
	   <span class="pull-right">
		<?php next_posts_link(theme_locals("older")) ?>
	  </span>
    </div>
  <?php endif; ?>

  		<?php
		if ( $wp_query->max_num_pages > 1 && $pagination_type=='loadmore' or $wp_query->max_num_pages > 1 && $pagination_type=='infinite' ) { 
		$all_num_pages = $wp_query -> max_num_pages;
  $next_page_url = buzzblogpro_next_page($all_num_pages);

?>
<div class="ajax-pagination-container">
  <a href="<?php echo esc_url($next_page_url); ?>" id="ajax-load-more-posts-button"></a>
</div>
<?php } ?>
</div></div>