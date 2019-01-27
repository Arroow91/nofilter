<?php /* Loop Name: Loop metro blog */ ?>
<?php 
$i = 1;
	 if (have_posts()) : 
	 while (have_posts()) : the_post();
	 ?>

<?php $count = 1; if( $i%3 == 1 ){ $count = 1; $gridol = '6'; } elseif( $i%3 == 2 ){ $count = 2; $gridol = '3'; } elseif( $i%3 == 0 ){ $count = 3; $gridol = '3'; } 
$nextrow = 'nonextrow'; if( $i%4 == 0 ){ $nextrow = 'nextrow'; }
?>
<div id="post-<?php the_ID(); ?>" class="ajax-post-wrapper block col-xs-12 col-sm-6 col-md-<?php echo esc_attr($gridol); ?> <?php echo esc_attr($nextrow); ?> " > 

<?php 
/**
* Grid post template
*/ 
				
				$img_url = wp_get_attachment_url( get_post_thumbnail_id());
				$img_width = 1272;
				$img_height = 1272;
				$isgif = '';
				$img = aq_resize( $img_url, $img_width, $img_height, true, true, true );
		$file_type = wp_check_filetype( $img_url );

			if( ! empty( $file_type ) && $file_type['ext'] == 'gif' ){
		 $isgif = 'giftrue';
		}else{
           $isgif = '';
        }
		

?>
		<div class="post_content cover" <?php  if($isgif == 'giftrue') { echo 'style="background-image: url('.esc_url($img_url).')"'; } ?>>
		
<?php  if(has_post_thumbnail()) { ?>
<div class="thumb-container">
	
							<div class="thumbnail <?php echo esc_attr($isgif); ?>" > 
								<img src="<?php echo esc_url($img); ?>" width="<?php echo esc_attr($img_width); ?>" height="<?php echo esc_attr($img_height); ?>" alt="<?php the_title_attribute();?>" >
							</div>
	
		
	<div class="cover-content">
<?php buzzblogpro_post_category('',' '); ?>

			<h2 class="grid-post-title"><?php the_title(); ?></h2>
	
	
<?php buzzblogpro_post_meta(array('author', 'date', 'editlink'), true, 'meta-space-top');  ?>

	

			
</div>
<a href="<?php the_permalink();?>" class="cover-link"></a>
</div>
<?php } ?>
</div>
	
</div>
<?php $i++ ; 
 endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php else: ?>	
<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>