<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
	<div class="row">
	<div class="col-md-12">
	<div class="post_content">
	<?php 
 
	if(is_singular()) : ?>

	<div class="isopad">
		<?php the_content(); ?>
				<?php wp_link_pages('before=<div class="pagelink">&after=</div>'); ?>
						<?php if(buzzblogpro_getVariable('post_tag') != 'no'){ ?>
									<span class="tagcloud"> 
									<?php 
										if(get_the_tags()){
											the_tags('', '');
										} else {
											echo theme_locals('has_not_tags');
										}
									 ?>
								</span>
								<?php
							} ?>
		<div class="clear"></div>

	</div>
<?php
		$buzzblogpro_affiliate_banner = get_post_meta(get_the_ID(), 'buzzblogpro_affiliate_banner', true);
$buzzblogpro_shopstyle_affiliate_banner = get_post_meta(get_the_ID(), 'buzzblogpro_shopstyle_affiliate_banner', true); 
$single_affiliate_banner = get_post_meta(get_the_ID(), 'buzzblogpro_single_affiliate_banner', true);

if ($single_affiliate_banner != 'no' ) {

		if ($buzzblogpro_affiliate_banner or $buzzblogpro_shopstyle_affiliate_banner) { ?>
		<div class="affiliate-banner">
		<span class="shop-the-post"><?php esc_html_e('Shop The Post','buzzblogpro'); ?></span>
		<?php if ($buzzblogpro_affiliate_banner && shortcode_exists('show_shopthepost_widget')) { 
		echo do_shortcode( '[show_shopthepost_widget id="'.$buzzblogpro_affiliate_banner.'"]' ); 
		}
		if ($buzzblogpro_shopstyle_affiliate_banner) {
		echo $buzzblogpro_shopstyle_affiliate_banner; 
		}
		?>
		</div>
		<?php } } ?>
	<?php endif; ?>

</div>
	<div class="meta-line">
	<?php get_template_part( 'post-template/share-buttons' ); ?>
	</div>
</div></div>

<?php  if(is_singular() && buzzblogpro_getVariable('post_author_box')!='no' ) {
get_template_part('post-template/post-author'); } ?>
</article>