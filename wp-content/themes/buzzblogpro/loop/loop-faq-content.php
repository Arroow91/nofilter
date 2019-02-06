<?php /* Loop Name: Loop page */ ?>  
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php if($post->post_content=="") :

else : ?>
<div class="row">
                <div class="col-md-12">
					<article class="post__holder">
    <div id="post-separate" <?php post_class('page clearfix'); ?>>
        <?php the_content(); ?>
    </div>
							</article>
                    </div>
</div>
	<?php endif; ?>
<?php endwhile; ?>