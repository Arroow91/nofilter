<div class="post-author isopad post-author__page clearfix">
<div class="post-author-box">
<div class="row"><div class="col-xs-12 col-sm-3 col-md-2">


	<div class="postauthor_gravatar">
		<div class="postauthor_gravatar_wrap"><?php echo get_avatar( get_the_author_meta('email'), '100' ); ?></div>
	</div>



</div>
<div class="col-xs-12 col-sm-9 col-md-10">
<h5 class="post-author_h"><?php the_author_posts_link(); ?></h5>
		<div class="post-author_desc">
			<?php the_author_meta('description'); ?>
		</div>
		<div class="author-social">
		<?php if(get_the_author_meta('url')) : ?><a target="_blank" class="author-social" href="<?php echo esc_url(the_author_meta('url')); ?>"><i class="hs-icon fa fa-globe"></i></a><?php endif; ?>
		<?php if(get_the_author_meta('facebook')) : ?><a target="_blank" class="author-social" href="<?php echo esc_url(the_author_meta('facebook')); ?>"><i class="hs-icon hs hs-facebook"></i></a><?php endif; ?>
		<?php if(get_the_author_meta('twitter')) : ?><a target="_blank" class="author-social" href="<?php echo esc_url(the_author_meta('twitter')); ?>"><i class="hs-icon hs hs-twitter"></i></a><?php endif; ?>
		<?php if(get_the_author_meta('instagram')) : ?><a target="_blank" class="author-social" href="<?php echo esc_url(the_author_meta('instagram')); ?>"><i class="hs-icon hs hs-instagram"></i></a><?php endif; ?>
		<?php if(get_the_author_meta('google')) : ?><a target="_blank" class="author-social" href="<?php echo esc_url(the_author_meta('google')); ?>"><i class="hs-icon hs hs-gplus"></i></a><?php endif; ?>
		<?php if(get_the_author_meta('pinterest')) : ?><a target="_blank" class="author-social" href="<?php echo esc_url(the_author_meta('pinterest')); ?>"><i class="hs-icon hs hs-pinterest"></i></a><?php endif; ?>
		<?php if(get_the_author_meta('tumblr')) : ?><a target="_blank" class="author-social" href="<?php echo esc_url(the_author_meta('tumblr')); ?>"><i class="hs-icon hs hs-tumblr"></i></a><?php endif; ?>
		<?php if(get_the_author_meta('snapchat')) : ?><a target="_blank" class="author-social" href="<?php echo esc_url(the_author_meta('snapchat')); ?>"><i class="hs-icon hs hs-snapchat"></i></a><?php endif; ?>
		</div>
		</div>
</div>
</div>
</div>
