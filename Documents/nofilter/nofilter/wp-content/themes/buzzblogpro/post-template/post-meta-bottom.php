<?php if (buzzblogpro_getVariable('social_share')!='no' || buzzblogpro_getVariable('post_author_share') != 'no' || buzzblogpro_getVariable('post_comments_share') != 'no') { ?>
<div class="bottom-meta">

<?php if (buzzblogpro_getVariable('shareon')!='no') { ?><p class="shareon"><?php echo theme_locals("share_on"); ?></p><?php }?>
	<div class="row">
<?php if (buzzblogpro_getVariable('post_author_share') == 'no' && buzzblogpro_getVariable('post_comments_share') == 'no') { ?>
		<div class="col-md-12">
			<?php 
	if(!has_post_format('link')){ 
	get_template_part( 'post-template/share-buttons' ); 
	} ?>
		</div>
<?php }else{ ?>
	<div class="col-md-4 col-sm-4 col-xs-12">
<?php   
buzzblogpro_post_meta(array('author_bottom'), false, 'meta-space-top'); 
?>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<?php 
	if(!has_post_format('link')){ 
	get_template_part( 'post-template/share-buttons' ); 
	} ?>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">

		<?php 		
buzzblogpro_post_meta(array('comments_bottom'), false, 'meta-space-top'); 
?>
</div>
<?php } ?>
</div></div>
<?php } ?>