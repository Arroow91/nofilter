<header class="post-header">
	
<div class="meta-space-top post_category"><span><?php echo get_the_term_list( $post->ID, 'gallery-categories', '', ', ', '' ); ?></span></div>
	<?php if(!has_post_format('quote')){ ?>
		<?php if(!is_singular()) : ?>
		
			<h2 class="post-title"><a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<?php else :?>
			<h1 class="post-title"><?php the_title(); ?></h1>
		<?php endif; ?>
		<?php 
buzzblogpro_post_meta(array('author', 'date', 'comments', 'reading_time', 'views', 'editlink'), false, 'meta-space-top'); 
?>
<?php } ?>
</header>