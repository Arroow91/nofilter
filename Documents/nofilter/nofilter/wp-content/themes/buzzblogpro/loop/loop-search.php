<?php /* Loop Name: Loop list-posts blog */ ?>
<?php 
	 if (have_posts()) : 
	 while (have_posts()) : the_post();
	 ?>
<div id="post-<?php the_ID(); ?>" class="block col-xs-12 col-md-12 ajax-post-wrapper list-post-container" > 
<?php 
   get_template_part('post-template/list-post-template'); 
?>
</div>

<?php 
		endwhile; wp_reset_postdata(); ?>

		<?php else: ?>
		
<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>