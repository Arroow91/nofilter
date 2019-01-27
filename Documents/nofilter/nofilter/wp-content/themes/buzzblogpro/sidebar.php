<?php 
if(is_page()) {
$sidebar = get_post_meta( get_the_ID(), '_buzzblogpro_pageavailablesidebars', true ) ? get_post_meta( get_the_ID(), '_buzzblogpro_pageavailablesidebars', true ) : 'hs_main_sidebar';
}elseif(is_category()){
$category = get_category( get_query_var( 'cat' ) );
$cat_id = $category->cat_ID;
$sidebar = get_term_meta ( $cat_id, '_buzzblogpro_category_availablesidebars', true ) ? get_term_meta ( $cat_id, '_buzzblogpro_category_availablesidebars', true ) : 'hs_main_sidebar'; 
}else{
$sidebar = get_post_meta( get_the_ID(), '_buzzblogpro_availablesidebars', true ) ? get_post_meta( get_the_ID(), '_buzzblogpro_availablesidebars', true ) : 'hs_main_sidebar'; 
}
?>
<?php if( $sidebar != 'none') : ?>

	<div class="theiaStickySidebar">

		<?php if ( $sidebar != 'none' && is_active_sidebar( $sidebar ) ) : ?>
				<?php dynamic_sidebar( $sidebar ); ?>
		<?php endif; ?>

	</div>

<?php endif; ?> 