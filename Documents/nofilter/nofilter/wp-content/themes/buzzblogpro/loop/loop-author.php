<?php /* Loop Name: Loop author */ ?>
<?php get_template_part('post-template/post-author'); ?>

<div id="recent-author-posts" class="ajax-container">
	<?php
		if (have_posts()) : while (have_posts()) : the_post(); ?>
	 <div class="ajax-post-wrapper" >
  <?php get_template_part( 'content' ); ?>
  </div>
		<?php	endwhile; else: 
get_template_part( 'content', 'none' );
	 endif; ?>
</div>