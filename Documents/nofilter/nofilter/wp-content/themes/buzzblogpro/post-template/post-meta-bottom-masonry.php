<?php if (buzzblogpro_getVariable('social_share')!='no') { ?>
<div class="bottom-meta">
<?php if (buzzblogpro_getVariable('shareon')!='no') { ?><p class="shareon"><?php echo theme_locals("share_on"); ?></p><?php }?>
	<div class="row">
		<div class="col-md-12">
			<?php get_template_part( 'post-template/share-buttons' ); ?>
		</div>
</div>
</div>
<?php } ?>