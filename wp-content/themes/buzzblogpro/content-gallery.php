<?php 
$hs_gal_role = get_post_meta( get_the_ID(), 'buzzblogpro_gallery_role', true );
$hs_gal_year = get_post_meta( get_the_ID(), 'buzzblogpro_gallery_year', true );
$hs_gal_client = get_post_meta( get_the_ID(), 'buzzblogpro_gallery_client', true );
$hs_gal_technology = get_post_meta( get_the_ID(), 'buzzblogpro_gallery_technology', true );
$hs_gal_url = get_post_meta( get_the_ID(), 'buzzblogpro_gallery_url', true );
$hs_gal_target = get_post_meta( get_the_ID(), 'buzzblogpro_gallery_target', true );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
	<div class="row">
	<div class="col-md-12">

	<?php /* Top meta */ ?>
	<?php get_template_part('post-template/post-meta-top-gallery');  ?>
<?php /* Top meta */ ?>
	
<?php /* content */ ?>
						
	<!-- Post Content -->
	<div class="post_content">
	<?php get_template_part('post-template/post-thumb'); ?>
	<?php 
	if(is_singular()) : ?>
	<div class="isopad">

	<div class="row">
	<div class="col-md-2 gallery-meta-line">
	<?php if ($hs_gal_role) { ?>
<div class="gal-role">
<h4><?php echo theme_locals("gal_our_role");?></h4>
<span><?php echo esc_attr( $hs_gal_role); ?></span>
</div>
<?php } ?>
<?php if ($hs_gal_year) { ?>
<div class="gal-year">
<h4><?php echo theme_locals("gal_year");?></h4>
<span><?php echo esc_attr( $hs_gal_year); ?></span>
</div>
<?php } ?>
<?php if ($hs_gal_client) { ?>
<div class="gal-client">
<h4><?php echo theme_locals("gal_client");?></h4>
<span><?php echo esc_attr( $hs_gal_client); ?></span>
</div>
<?php } ?>
<?php if ($hs_gal_technology) { ?>
<div class="gal-technology">
<h4><?php echo theme_locals("gal_technology");?></h4>
<span><?php echo esc_attr( $hs_gal_technology); ?></span>
</div>
<?php } ?>
<?php if ($hs_gal_url) { ?>
				<div class="readmore-button"><a <?php if ($hs_gal_target) {echo esc_attr( 'target="_'.$hs_gal_target.'"'); } ?> class="btn btn-default btn-normal" href="<?php echo esc_url($hs_gal_url); ?>"><?php echo theme_locals("gal_url"); ?></a></div>
		<?php } ?>
</div>
<?php if (!$hs_gal_role && !$hs_gal_year && !$hs_gal_client && !$hs_gal_technology && !$hs_gal_url ) { ?>
<div class="col-md-12">
<?php }else{ ?>
<div class="col-md-10">
<?php } ?>
<?php the_content();
wp_link_pages('before=<div class="pagelink">&after=</div>'); ?>
</div>
</div>

<div class="clear"></div>

	</div>
	<!-- //Post Content -->	
	<?php endif; ?>
<?php /* content */ ?>
</div>
	
</div></div>
<!-- Meta and share buttons -->
<div class="row meta-line">
<div class="col-md-12">
<?php get_template_part( 'post-template/share-buttons' ); ?>
</div></div>
</article>