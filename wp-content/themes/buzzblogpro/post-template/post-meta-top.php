<header class="post-header">
	
	<?php buzzblogpro_post_category('',' '); ?>
		<?php if(!is_singular() or is_page()) : ?>
		
			<h2 class="post-title entry-title" itemprop="name headline"><a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php esc_attr(the_title()); ?></a></h2>
		<?php else :?>
			<h1 class="post-title entry-title" itemprop="name headline"><?php the_title(); ?></h1>
		<?php endif; ?>
		<?php 
buzzblogpro_post_meta(array('date', 'location', 'reading_time', 'views', 'editlink'), false, 'meta-space-top'); 
?>
</header>