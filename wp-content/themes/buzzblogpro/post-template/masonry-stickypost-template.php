<?php
$sticky = get_option( 'sticky_posts' );
$args = array(
	'posts_per_page'      => 1,
	'post__in'            => $sticky,
	'ignore_sticky_posts' => 1,
	'post_type' => 'post'
);
// The Query
$query1 = new WP_Query( $args );

if(isset($sticky[0]) && !$paged){

// The Loop
while ( $query1->have_posts() ) {
	$query1->the_post(); 	
?>

<div class="row"><div class="col-md-12 sticky">

<?php
get_template_part('content');
if (buzzblogpro_getVariable('related_post') !='no' and buzzblogpro_getVariable('related_post_single') !='yes') { get_template_part( 'post-template/related-posts' ); }
?>
	
</div></div>
<?php	
}
}
wp_reset_postdata();
?>