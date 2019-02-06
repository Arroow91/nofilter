<?php /* Loop Name: Loop page */ ?>  
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php if($post->post_content=="") :

else : ?>
    <div id="post-separate" <?php post_class('page clearfix'); ?>>
        <?php the_content(); ?>
        <?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
    </div>
	<?php comments_template('', true); ?>
	<?php endif; ?>
<?php endwhile; ?>