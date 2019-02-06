<?php
$introtext = wpautop(get_post_meta( get_the_ID(), '_buzzblogpro_page_intro_text', true )) ? wpautop(get_post_meta( get_the_ID(), '_buzzblogpro_page_intro_text', true )) : '';
$sidebardef = get_post_meta( get_the_ID(), '_buzzblogpro_pagesidebarposition', true ) ? get_post_meta( get_the_ID(), '_buzzblogpro_pagesidebarposition', true ) : 'right';
$sidebarpost = $sidebardef =='inherit' ? buzzblogpro_getVariable('page_sidebar_pos') : $sidebardef;
$sidebar_width = buzzblogpro_getVariable('sidebar_width') ? buzzblogpro_getVariable('sidebar_width') : 'smaller';
$content_width = get_post_meta( get_the_ID(), '_buzzblogpro_content_width_page', true ) ? get_post_meta( get_the_ID(), '_buzzblogpro_content_width_page', true ) : 'normal'; 
$buzzblogpro_title = get_post_meta( get_the_ID(), 'buzzblogpro_page_tit', true );
$buzzblogpro_subtitle = get_post_meta( get_the_ID(), 'buzzblogpro_page_sub', true );
$buzzblogpro_page_title = get_post_meta( get_the_ID(), 'buzzblogpro_page_title_enable', true ) ? get_post_meta( get_the_ID(), 'buzzblogpro_page_title_enable', true ) : 'enable';
					
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
<?php if (has_post_thumbnail() ): ?>


<?php 
$enable_parallax = get_post_meta( get_the_ID(), '_buzzblogpro_page_enable_parallax', 1 ) ? 'scaled' : 'cover'; 
$buzzblogpro_feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'buzzblogpro-standard-large');
?>

<div style="background-image: url(<?php echo esc_attr($buzzblogpro_feat_image[0]);?>);" class="parallax-image modern-layout" data-herculesdesign-parallax='{"backgroundUrl":"<?php echo esc_attr($buzzblogpro_feat_image[0]);?>","backgroundSize":[<?php echo esc_attr($buzzblogpro_feat_image[1]);?>,<?php echo esc_attr($buzzblogpro_feat_image[2]);?>],"backgroundSizing":"<?php echo esc_attr($enable_parallax);?>","limitMotion":"0.7"}' >

<div class="header-overlay"></div>
<div class="container"><div class="row">
                    <div class="col-md-12" id="content">
					<?php
					if($buzzblogpro_page_title == esc_html__('enable','buzzblogpro')){
					?>
					<section class="title-section">
				<?php
					 $buzzblogpro_title = get_post_meta( get_the_ID(), 'buzzblogpro_page_tit', true );
$buzzblogpro_subtitle = get_post_meta( get_the_ID(), 'buzzblogpro_page_sub', true );
					if($buzzblogpro_title == ""){ ?>
						<h1><?php esc_attr(the_title()); ?></h1>
						<?php
					} else { ?>
						<h1><?php echo esc_attr($buzzblogpro_title); ?></h1>
					<?php
					}
					if($buzzblogpro_subtitle != ""){ ?>
						<h2><?php echo esc_attr($buzzblogpro_subtitle);?></h2>
						
					<?php } ?>
					</section>
					<?php } ?>
					</div>
                </div></div>
</div><div class="spacer"></div>
<?php endif; ?>
<div class="container <?php echo esc_attr($content_width); ?>">
<div class="row">

<?php if ($sidebarpost=='none') { ?>
<div class="col-md-12" id="content">
<?php }else{ ?>
<div class="<?php if ($sidebarpost=='right' or $sidebarpost==''){echo 'col-xs-12 col-sm-12 col-md-'.esc_attr( $main_class).'';}elseif ($sidebarpost=='left'){echo 'col-xs-12 col-sm-12 col-sm-push-12 col-md-'.esc_attr( $main_class).' col-md-push-'.esc_attr( $sidebar_class).'';} ?>" id="content">
<?php } ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>	
    <div class="isopad">
	<?php if($introtext){echo '<div class="intro-text">'.wp_kses( $introtext, wp_kses_allowed_html( 'post' ) ).'</div>';}  ?> 
        <div class="post-inner"><?php the_content(); ?></div>
        <?php wp_link_pages('before=<div class="pagelink"><div class="pagination">&after=</div></div>'); ?>
		<?php comments_template('', true); ?>
</div>
</div>
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