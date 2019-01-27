<?php /* Loop Name: Loop blog */ ?>
<?php if (
in_array( $style, array( 'masonry-2', 'masonry-3', 'masonry-4', 'list' ) ) && $specials == 'show-specials') { ?>
<div class="ajax-post-wrapper block col-xs-12 col-sm-12 col-md-12" > 
<div class="grid-block-full">
<?php }else{ ?>
	 <div class="ajax-post-wrapper" >
	 <?php } ?>
	<?php 
get_template_part('content'); 
		if (buzzblogpro_getVariable('related_post')) {
		if (buzzblogpro_getVariable('related_post') !='no' and buzzblogpro_getVariable('related_post_single') !='yes') { get_template_part( 'post-template/related-posts' ); }	
		} 
		
	?>

<?php if (
in_array( $style, array( 'masonry-2', 'masonry-3', 'masonry-4', 'list' ) ) && $specials == 'show-specials') { ?>
</div></div>
<?php }else{ ?>
</div>
<?php } ?>

