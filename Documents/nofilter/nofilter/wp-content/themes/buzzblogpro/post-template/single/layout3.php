<?php
$introtext = get_post_meta( get_the_ID(), '_buzzblogpro_post_intro_text', true ) ? get_post_meta( get_the_ID(), '_buzzblogpro_post_intro_text', true ) : '';
$sidebardef = get_post_meta( get_the_ID(), '_buzzblogpro_sidebarposition', true ) ? get_post_meta( get_the_ID(), '_buzzblogpro_sidebarposition', true ) : 'right';
$sidebarpost = $sidebardef =='inherit' ? buzzblogpro_getVariable('post_sidebar_pos') : $sidebardef;
if (buzzblogpro_is_touch()) {$sidebarpost = 'none';}
$sidebar_width = buzzblogpro_getVariable('sidebar_width') ? buzzblogpro_getVariable('sidebar_width') : 'smaller';
$content_width = get_post_meta( get_the_ID(), '_buzzblogpro_content_width', true ) ? get_post_meta( get_the_ID(), '_buzzblogpro_content_width', true ) : 'normal'; 
switch ($sidebar_width) {
		case 'bigger':
			$sidebar_class = '4';
			$main_class = '8';
		break;
		case 'smaller':
			$sidebar_class = '3';
			$main_class = '9';
		break;
	}
?>
<div class="spacer"></div>
<div class="container"><div class="row"><div class="col-md-12"><?php get_template_part('post-template/post-meta-top');  ?></div></div></div>
<div class="spacer"></div>
	<?php
	  $format = get_post_format();
	  if ($format) {
	  	get_template_part( 'post-template/'.$format );
	  }else{
	  get_template_part('post-template/post-thumb');
	  }
	?>
	
<div class="container <?php echo esc_attr($content_width); ?>">
<div class="spacer"></div>
<div class="row">

<?php if ($sidebarpost=='none') { ?>
<div class="col-md-12" id="content">
<?php }else{ ?>
<div class="<?php if ($sidebarpost=='right' or $sidebarpost==''){echo 'col-xs-12 col-sm-12 col-md-'.esc_attr( $main_class).'';}elseif ($sidebarpost=='left'){echo 'col-xs-12 col-sm-12 col-sm-push-12 col-md-'.esc_attr( $main_class).' col-md-push-'.esc_attr( $sidebar_class).' left-sidebar';} ?>" id="content">
<?php } ?>
<article itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" <?php post_class(array('post__holder','layout3')); ?>>

<?php $blog_sidebar_pos = buzzblogpro_getVariable('blog_sidebar_pos'); ?>
						

	<div class="post_content">
	
		 <div class="isopad">
		 <?php if($introtext){echo '<div class="intro-text">'.wp_kses( $introtext, wp_kses_allowed_html( 'post' ) ).'</div>';}  ?> 
		<div class="post-inner"><?php 
		apply_filters('the_content', '');
		the_content(); ?></div>
		<?php wp_link_pages( array(
				'before'      => '<div class="pagelink"><span class="page-links-title">' . esc_html__( 'Pages:', 'buzzblogpro' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'buzzblogpro' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) ); ?>
		<div class="clear"></div>
	
	
<?php
/**
* Share buttons
*/
?>
<?php if (buzzblogpro_getVariable('social_share')=='yes' ) { ?>
<?php if (!buzzblogpro_is_touch()) { ?>
<div class="vertical-share">
<?php 
$shareon = buzzblogpro_getVariable('shareon');
if ($shareon=='yes') { ?><p class="shareon-vertical"><?php echo theme_locals("share_on"); ?></p><?php } ?>
<?php get_template_part( 'post-template/share-buttons' ); ?>
</div>
<?php }else{ ?>
<?php get_template_part( 'post-template/post-meta-bottom' ); ?>
<?php } ?>
<?php } ?>
<?php
/**
* Tags
*/
?>
<?php if(buzzblogpro_getVariable('post_tag') != 'no'){ ?>
									<span class="tagcloud"> 
									<?php 
										if(get_the_tags()){
											the_tags('', '');
										}
									 ?>
								</span>
								<?php
							} ?>



<?php
/**
* affiliate banner
*/
$buzzblogpro_affiliate_banner = get_post_meta(get_the_ID(), '_buzzblogpro_affiliate_banner', true);
$buzzblogpro_shopstyle_affiliate_banner = get_post_meta(get_the_ID(), '_buzzblogpro_shopstyle_affiliate_banner', true); 
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

</div></div>
<?php  
/**
* post author
*/
if(is_singular() && buzzblogpro_getVariable('post_author_box')!='no' && get_the_author_meta( 'description' ) ) {
get_template_part('post-template/post-author'); } ?>
</article>

<?php 
/**
* pagination
*/
get_template_part('post-template/single/pagination');
?>

<?php 
/**
* related
*/
$related_post = buzzblogpro_getVariable('related_post') ? buzzblogpro_getVariable('related_post') : 'no';		
if ($related_post !='no') { get_template_part( 'post-template/related-posts' ); } ?>

<?php 
/**
* comments
*/
comments_template('', true);
?>

</div>

<?php 
/**
* sidebar
*/
if ($sidebarpost!='none') { ?>
<div class="<?php if ($sidebarpost=='right' or $sidebarpost==''){echo 'col-xs-12 col-sm-12 col-md-'.esc_attr( $sidebar_class).' sidebar';}elseif ($sidebarpost=='left'){echo 'col-xs-12 col-sm-12 col-sm-pull-12 col-md-'.esc_attr( $sidebar_class).' col-md-pull-'.esc_attr( $main_class).' sidebar left';} ?> <?php if (buzzblogpro_getVariable('sidebar_sticky')=='stickysidebar') { echo 'sticky-sidebar'; } ?>" id="sidebar">
<?php get_sidebar(); ?>
</div>
<?php } ?>

</div>

</div>