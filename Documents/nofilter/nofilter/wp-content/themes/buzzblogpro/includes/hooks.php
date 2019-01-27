<?php 
	if(!function_exists('buzzblogpro_enable_threaded_comments')) {
		function buzzblogpro_enable_threaded_comments()
		{
			if (!is_admin()) {
				if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
					wp_enqueue_script('comment-reply');
				}
			}	
		}
		add_action('get_header', 'buzzblogpro_enable_threaded_comments');
	}


add_filter( 'the_content_more_link', 'buzzblogpro_modify_read_more_link' );
function buzzblogpro_modify_read_more_link() {
return '<div class="viewpost-button"><a class="button" href="' . get_permalink() . '"><span>'.theme_locals("continue_reading").'</span></a></div>';
}

//posts_per_page_for_gallery_categories

function buzzblogpro_set_posts_per_page_for_gallery_categories( $query ) {
$buzzblogpro_images_per_page = buzzblogpro_getVariable('images_per_page');
if($buzzblogpro_images_per_page ==''){$buzzblogpro_images_per_page = 6;}
if (!is_admin() && $query->is_main_query() && is_tax('gallery_categories')) {

        $query->set( 'posts_per_page', $buzzblogpro_images_per_page );
        return;
    }
}
add_action( 'pre_get_posts', 'buzzblogpro_set_posts_per_page_for_gallery_categories' );

//wc menu cart
add_filter('wp_nav_menu_items','buzzblogpro_wcmenucart', 10, 2);
function buzzblogpro_wcmenucart($menu, $args) {
$subscribe = $logoimage = $search = $burger = $whichmenu = '';
if (buzzblogpro_getVariable('header_layout') == 'split') {
$whichmenu = 'split-right-menu';
}else{
$whichmenu = 'primary-menu';
}
if ( $args->theme_location == $whichmenu  ) {
        
if ( buzzblogpro_getVariable('hs_newsletter_display')=='yes' ) {
			$subscribe = '<li><a class="newsletter-ajax-popup" href="#hs_signup">'.theme_locals("subscribe").'</a></li>';
}
			
if ( buzzblogpro_getVariable('g_search_box_id')=='yes') { 
			$search = '<li class="hidden-xs search-icon-link"><a class="search-icon" href="#"><i class="hs hs-search-2"></i></a></li>';
} 
if ( buzzblogpro_getVariable('logo_image')=='yes') { 
$logoimage = '<li><a href="'. esc_url( home_url( '/' ) ).'" class="logo-in-menu"><img src="'. esc_url( buzzblogpro_getVariable('logo_image_url','url')).'" width="'. esc_attr( buzzblogpro_getVariable('logo_image_url','width')).'" height="'. esc_attr( buzzblogpro_getVariable('logo_image_url','height')).'" alt="'. get_bloginfo('name').'" title="'. get_bloginfo('description').'"></a></li>';
}
}  
    $menu = $logoimage . $menu . $subscribe . $search;
    return $menu;
}

// custom signature

add_filter('the_content', 'buzzblogpro_add_my_signature', 20);
function buzzblogpro_add_my_signature($content) {
if( is_single() && is_main_query() ) {
if(buzzblogpro_getVariable('signature_text') !='') {
$buzzblogpro_my_custom_signature_text = '<div class="signature-text">'.buzzblogpro_getVariable('signature_text').'</div>'; 
}else{$buzzblogpro_my_custom_signature_text ='';}

if(buzzblogpro_getVariable('custom-signature-image','url') !='') {
$buzzblogpro_my_custom_signature_image = '<div class="signature-image"><img class="nopin" src="'.esc_url( buzzblogpro_getVariable('custom-signature-image','url')).'" width="'.esc_attr( buzzblogpro_getVariable('custom-signature-image','width')).'" height="'.esc_attr( buzzblogpro_getVariable('custom-signature-image','height')).'" alt="signature" title="signature" /></div>';
}else{$buzzblogpro_my_custom_signature_image ='';}


if(is_single() && 'gallery' != get_post_type() && !is_home() && 'no' != buzzblogpro_getVariable( 'custom-signature-display' )) {
if(!has_post_format( array('quote','link'))) {

$content .= '<div class="custom-signature">'.$buzzblogpro_my_custom_signature_text.$buzzblogpro_my_custom_signature_image.'</div>';

}}
}
return $content;
} 

// posts_per_page_in_categories
function buzzblogpro_posts_in_category($query){
global $buzzblogpro_options;
if(isset($buzzblogpro_options['items_cat_count'])){
$items_cat_count = $buzzblogpro_options['items_cat_count'];
if($items_cat_count ==''){$items_cat_count = 6;}
    if ($query->is_category && $query->is_main_query()) {
		if ($items_cat_count) {
            $query->set('posts_per_archive_page', $items_cat_count);
			}
    }
}
}
add_filter('pre_get_posts', 'buzzblogpro_posts_in_category');

// body classes
add_filter( 'body_class','buzzblogpro_body_classes' );
function buzzblogpro_body_classes( $classes ) {
if(buzzblogpro_getVariable('header_layout')== 'topleftmenu' && !buzzblogpro_is_touch( 'phone' )){
$classes[] = 'top-left-menu';
}
if(buzzblogpro_getVariable('header_layout')== 'bottomleftmenu' && !buzzblogpro_is_touch( 'phone' )){
$classes[] = 'top-left-menu';
}
if(buzzblogpro_getVariable('header_layout')== 'left' && buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'no'){
$classes[] = 'yes-woo-and-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'left' && !buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'no'){
$classes[] = 'yes-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'left' && buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'yes'){
$classes[] = 'yes-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'topleftmenu' && buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'no'){
$classes[] = 'yes-topleftmenu-woo-and-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'topleftmenu' && !buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'no'){
$classes[] = 'yes-topleftmenu-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'topleftmenu' && buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'yes'){
$classes[] = 'yes-topleftmenu-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'bottomleftmenu' && buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'no'){
$classes[] = 'yes-topleftmenu-woo-and-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'bottomleftmenu' && !buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'no'){
$classes[] = 'yes-topleftmenu-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'bottomleftmenu' && buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'yes'){
$classes[] = 'yes-topleftmenu-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'fullwidthleftright' && buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'no'){
$classes[] = 'yes-topleftmenu-woo-and-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'fullwidthleftright' && !buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'no'){
$classes[] = 'yes-topleftmenu-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'fullwidthleftright' && buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'yes'){
$classes[] = 'yes-topleftmenu-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'fullwidthleftright-logo-below' && buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'no'){
$classes[] = 'yes-topleftmenu-woo-and-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'fullwidthleftright-logo-below' && !buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'no'){
$classes[] = 'yes-topleftmenu-burger';
}
if(buzzblogpro_getVariable('header_layout')== 'fullwidthleftright-logo-below' && buzzblogpro_is_woocommerce_active() && buzzblogpro_getVariable('hamburger_menu') == 'yes'){
$classes[] = 'yes-topleftmenu-burger';
}
if(buzzblogpro_getVariable('blog_slideshow')=='inside'){
$classes[] = 'slideshow-inside';
}
if (buzzblogpro_getVariable('fullwidth_menu')== 'no') {
$classes[] = 'no-fullwidth-menu';
}
if(buzzblogpro_getVariable('ligtbox_images')=='yes'){
$classes[] = 'magnificpopup-enabled';
}
if (buzzblogpro_getVariable('header_layout') == 'split' && buzzblogpro_getVariable('hamburger_menu') == 'no') {
$classes[] = 'split-menu yes-topleftmenu-burger';
}
if (buzzblogpro_getVariable('header_layout') == 'split' && buzzblogpro_getVariable('hamburger_menu') == 'yes') {
$classes[] = 'split-menu';
}
$classes[] = buzzblogpro_is_touch() ? 'touch' : 'no-touch';
if(buzzblogpro_getVariable('main_layout')== 'boxed'){
$classes[] = 'boxed';
}else{
$classes[] = 'wide';
}
return $classes;    
}

if( is_admin() ) {
function buzzblogpro_tc_more_buttons($buttons) {
    array_push($buttons, 'fontselect','fontsizeselect','styleselect');
 
    return $buttons;
}
add_filter("mce_buttons_3", "buzzblogpro_tc_more_buttons");
}


//cookie banner

add_filter( 'wp_footer', 'buzzblogpro_cookie_banner' );
function buzzblogpro_cookie_banner() {

	if ( 'no' == buzzblogpro_getVariable( 'cookie_banner' ) or '' == buzzblogpro_getVariable( 'cookie_banner' ) ) {
		return;
	}

	if ( '' == buzzblogpro_getVariable( 'cookie_text' ) ) {
		return;
	}

	if ( isset( $_COOKIE['buzzblogpro_cookie_banner'] ) && '1' == $_COOKIE['buzzblogpro_cookie_banner'] ) {
		return;
	}

	ob_start(); ?>

	<div id="buzzblogpro-cookie-banner" class="hidden buzzblogpro-cookie-banner-wrap alert alert-warning alert-dismissible" role="alert">
		<div class="container">
		<div class="row"><div class="col-md-12 buzzblogpro-cookie-banner-text">
		<p><?php echo htmlspecialchars_decode( buzzblogpro_getVariable( 'cookie_text' ) ); ?></p>
			<a href="#" id="buzzblogpro-dismiss-cookie" class="btn dismiss-cookie" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true"><?php esc_html_e('OK', 'buzzblogpro'); ?></span>
			</a>
			<?php if (  buzzblogpro_getVariable( 'cookie_more_info_url' ) ) { ?>
			<a href="<?php echo esc_url(buzzblogpro_getVariable( 'cookie_more_info_url' ));?>" id="buzzblogpro-more-info" target="_blank" class="btn more-info">
				<span aria-hidden="true"><?php esc_html_e('More information', 'buzzblogpro'); ?></span>
			</a>
			<?php } ?>
			
		</div></div></div>
	</div>

	<?php $output = ob_get_contents();
	ob_end_clean();
	$output = apply_filters( 'buzzblogpro_cookie_banner', $output );

	printf( '%s', $output );
}


add_action( 'wp_enqueue_scripts', 'buzzblogpro_enqueue_utility_scripts' );
function buzzblogpro_enqueue_utility_scripts() {
if ( 'no' != buzzblogpro_getVariable( 'cookie_banner' ) && !( isset( $_COOKIE['buzzblogpro_cookie_banner'] ) && '1' == $_COOKIE['buzzblogpro_cookie_banner'] )) { 
		wp_enqueue_script('buzzblogpro-cookie-banner', trailingslashit(get_template_directory_uri()).'/js/jquery.buzzblogpro.cookie.banner.js',array( 'jquery' ),'1.0.0',true);
		wp_localize_script( 'buzzblogpro-cookie-banner', 'cookie_banner_args', array(
				'name'    => 'buzzblogpro_cookie_banner',
				'value'   => '1',
				'options' => array(
					'expires' => YEAR_IN_SECONDS,
					'path'    => ( defined( 'COOKIEPATH' ) ? COOKIEPATH : '/' ),
					'domain'  => ( defined( 'COOKIE_DOMAIN' ) ? COOKIE_DOMAIN : '' )
				),
			)
		);
	}
}


//clear_nav_menu_item_id
add_filter('nav_menu_item_id', 'buzzblogpro_clear_nav_menu_item_id', 10, 4);
function buzzblogpro_clear_nav_menu_item_id($menu_item_item_id, $item, $args, $depth) {
    return "";
}

//remove cat counter
add_filter('wp_list_categories', 'buzzblogpro_cat_count_span');
function buzzblogpro_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span>(', $links);
  $links = str_replace(')', ')</span>', $links);
  return $links;
}

//ads above single post content 
add_filter('the_content', 'buzzblogpro_single_post_ad_above');

function buzzblogpro_single_post_ad_above($content) {
if( is_single() && is_main_query() ) {
$ad = buzzblogpro_getVariable('ads_before_post_content');
if($ad){
$my_ads = '<div class="hercules-ad-above-single">'.do_shortcode( $ad ).'</div>';

if(is_single() && 'gallery' != get_post_type() && !is_home() && !has_post_format( array('quote','link'))) {
$content = $my_ads.$content;
}
}
}
return $content;
}
//ads after single post content 
add_filter('the_content', 'buzzblogpro_single_post_ad_after');

function buzzblogpro_single_post_ad_after($content) {
if( is_single() && is_main_query() && !is_singular( 'product' ) ) {
$ad = buzzblogpro_getVariable('ads_after_post_content');
if($ad){
$my_ads = '<div class="hercules-ad-after-single">'.do_shortcode( $ad ).'</div>';

if(is_single() && 'gallery' != get_post_type() && !is_home() && !has_post_format( array('quote','link'))) {
$content = $content.$my_ads;
}
}
}
return $content;
}


function buzzblogpro_exclude_posts_from_home_page( $query ) {
global $buzzblogpro_options;
if (!is_admin() &&  $query->is_home() && $query->is_main_query()) {
$posts1 = array();
if (!is_admin() &&  $query->is_home() && $query->is_main_query() && ! empty( $buzzblogpro_options['do_not_dublicate'] ) && is_array( $buzzblogpro_options['do_not_dublicate'] )) {
$posts1 = $buzzblogpro_options['do_not_dublicate'];
}
$posts2 = get_option( 'sticky_posts' );
$query->set( 'post__not_in', array_merge($posts1,$posts2 ));
return;
    }
}
add_action( 'pre_get_posts', 'buzzblogpro_exclude_posts_from_home_page' );

remove_filter('term_description','wpautop');

function buzzblogpro_add_class_attachment_link($html){
    $postid = get_the_ID();
    $html = str_replace('<a','<a class="nolightbox"',$html);
    return $html;
}
add_filter('wp_get_attachment_link','buzzblogpro_add_class_attachment_link',5,1);

/* 
* filter to add an icon to social widget
function buzzblogpro_social_add_icon( $args ) {
    		$args['battery'] = array(
				'label' => esc_html__('battery', 'buzzblogpro'),
				'icon'  => 'hs-icon fa fa-battery-half',
			);
			
    return $args;
}
add_filter( 'hercules_social_filter', 'buzzblogpro_social_add_icon' );
*/