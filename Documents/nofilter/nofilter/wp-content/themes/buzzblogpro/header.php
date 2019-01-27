<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="icon" href="http://localhost/nofilter/wp-content/themes/buzzblogpro/images/favicon.ico" type="images/x-con" />
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
<?php wp_head(); ?>	
</head>
<body <?php body_class(); ?>>
<?php get_template_part( 'mobile/mobile-top-panel' ); ?>
<?php if( function_exists( 'buzzblogpro_fixed_social_networks' ) ) {buzzblogpro_fixed_social_networks();} ?>
<div id="st-container" class="st-container">

<div class="st-menu st-effect-4 sidepanel" id="menu-4">
		<?php get_template_part('mobile/menu'); ?>
				<?php dynamic_sidebar("hs_side_panel"); ?>
			</div>
<?php get_template_part('newsletter'); ?>

		<div class="st-pusher">

				<div class="st-content">
					<div class="st-content-inner">
		<div class="main-holder">
		<?php get_template_part('wrapper/wrapper-top'); ?>
		<?php 
		$class = $attr = '';
		if (buzzblogpro_getVariable('header_layout') == 'topleftmenu') {
		$class .= ' topleftmenu';
		}
		if (buzzblogpro_getVariable('header_layout') == 'topcenter') {
		$class .= ' topcenter-menu';
		}  
		$video_url = buzzblogpro_getVariable('header_video_url');

		if ( !is_home() && buzzblogpro_getVariable('enable_video_home') =='yes' or !is_front_page() && buzzblogpro_getVariable('enable_video_home') =='yes' ) {
		$video_url = '';
			}
	if ( $video_url && !buzzblogpro_is_touch() ) {
		$class .= ' parallax-video';
		$attr = ' data-video="' . esc_url( $video_url ) . '" data-start="' . intval( buzzblogpro_getVariable('header_video_start') ) . '" data-end="' . intval( buzzblogpro_getVariable('header_video_end') ) . '"';
	}

	
		?>
		
<?php 

global $buzzblogpro_options;

if(isset($buzzblogpro_options['header_image']) && $buzzblogpro_options['enable_header_parallax']== 'yes') {
 
$enable_parallax = $buzzblogpro_options['enable_header_parallax'] == 'yes' ? 'scaled' : 'scaled'; 
$buzzblogpro_feat_image = $buzzblogpro_options['header_image']['background-image'];
$buzzblogpro_feat_image_width = $buzzblogpro_options['header_image']['media']['width'];
$buzzblogpro_feat_image_height = $buzzblogpro_options['header_image']['media']['height'];
?>

<header id="headerfix" style="background-image: url(<?php echo esc_attr($buzzblogpro_feat_image);?>);" class="<?php echo esc_attr($class);?> headerstyler headerphoto header" data-herculesdesign-parallax='{"backgroundUrl":"<?php echo esc_attr($buzzblogpro_feat_image);?>","backgroundSize":[<?php echo esc_attr($buzzblogpro_feat_image_width);?>,<?php echo esc_attr($buzzblogpro_feat_image_height);?>],"backgroundSizing":"<?php echo esc_attr($enable_parallax);?>","limitMotion":"0.7"}' >

<?php }else{ ?>	
<header id="headerfix" class="<?php echo esc_attr($class);?> headerstyler headerphoto header" <?php echo strip_tags($attr);?> >
<?php } ?>	
<div class="header-overlay"></div>
<div class="visible-xs-block visible-sm-block">
<div class="container">
<div class="row">
    <div class="col-md-12">
        <?php get_template_part("static/static-logo"); ?>
    </div>
</div>
</div>
</div>
<div class="visible-md-block visible-lg-block">
<?php 
$header = buzzblogpro_getVariable('header_layout') ? buzzblogpro_getVariable('header_layout') : 'center';
get_template_part( 'headers/'.$header);
?>
</div>
</header>
<div class="top-panel22 hidden-phone"><div class="container"><div class="row"><div class="col-md-12"><?php get_template_part("static/static-search"); ?></div></div></div></div>