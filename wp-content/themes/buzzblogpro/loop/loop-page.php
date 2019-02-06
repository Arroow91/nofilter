<?php /* Loop Name: Loop page */ ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
    <?php 
		if (has_post_thumbnail() ):
	?>

	<div class="post-thumb clearfix">		
			<figure class="featured-thumbnail thumbnail large">
				<?php the_post_thumbnail( 'full' ); ?>
			</figure>
			<div class="clear"></div>	
</div>			
		<?php endif; ?>		
    
        <?php the_content(); ?>
        <div class="pagelink"><?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?></div>
    </div>
<?php endwhile; ?>

