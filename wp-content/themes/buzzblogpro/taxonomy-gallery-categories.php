<?php
get_header(); 
?>
<?php
if(buzzblogpro_getVariable('gallery_layout')=='wide' or buzzblogpro_getVariable('gallery_layout')=='' ){
$container = 'container-fluid';
}else{$container = 'container';}
?>
<div class="content-holder clearfix">
    <div class="container">
                <div class="row">
                    <div class="col-md-12" id="title-header">
					<section class="title-section">
                        <div class="category-box"><h1><span><?php echo theme_locals("gallery_categorie"); ?> </span> <?php echo single_cat_title( '', false ); ?></h1></div>
</section>
					</div>
                </div>
    </div>
</div>
<div class="content-holder clearfix">
<div class="<?php echo $container; ?>">
<div class="row">
<div class="col-md-12">
<?php
if ( buzzblogpro_getVariable('gallery_cat_filter') != 'no') {
?>
<div class="category-filter">
<ul>
<?php 
	 $args = array(
	'show_option_all'    => '',
	'orderby'            => 'term_group',
	'order'              => 'ASC',
	'style'              => 'list',
	'show_count'         => 0,
	'hide_empty'         => 1,
	'use_desc_for_title' => 0,
	'child_of'           => 0,
	'feed'               => '',
	'feed_type'          => '',
	'feed_image'         => '',
	'exclude'            => '',
	'exclude_tree'       => '',
	'include'            => '',
	'hierarchical'       => 0,
	'title_li'           => '',
	'show_option_none'   => '',
	'number'             => null,
	'echo'               => 1,
	'depth'              => 2,
	'pad_counts'         => 0,
	'taxonomy'           => 'gallery-categories',
	'walker'             => null
    );
wp_list_categories($args);
?>
</ul>
</div>
<?php } ?>
<?php
$images_per_page = buzzblogpro_getVariable('images_per_page');
$gallery_columns = buzzblogpro_getVariable('gallery_columns');

switch ($gallery_columns) {
    case 2:
        $cols = 'col-xs-12 col-sm-6 col-md-6';
        break;
    case 3:
        $cols = 'col-xs-12 col-sm-4 col-md-4';
        break;
	case 4:
        $cols = 'col-xs-12 col-sm-3 col-md-3';
        break;
}
require_once get_template_directory() . '/gallery-category-loop.php';
?>
</div>
</div>
</div>
                    </div>
<?php get_footer(); ?>