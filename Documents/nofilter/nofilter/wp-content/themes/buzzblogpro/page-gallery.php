<?php
/**
* Template Name: Gallery Page
*/
get_header(); 
?>
<?php
if(buzzblogpro_getVariable('gallery_layout')=='wide' or buzzblogpro_getVariable('gallery_layout')=='' ){
$container = 'container-fluid';
}else{$container = 'container';}
?>
<div class="content-holder clearfix">
<div class="<?php echo $container; ?>">
<?php get_template_part('title'); ?>

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
get_template_part("loop/loop-gallery");
?>
</div>
</div>
</div>
</div>
<?php get_footer(); ?>