<?php /* Loop Name: Loop faq */ ?>
 
<div id="accordion" class="panel-group">
    
<?php
    $i = 1;
    $terms = get_terms("faq_categories");
    $count = count($terms);
    if ($count > 0) {
        foreach ($terms as $term) {
            echo '<h3>' . $term->name . '</h3>';

            $faqquery = new WP_Query(array(
                        'post_type' => 'faq',
                        'posts_per_page' => -1,
                        'orderby' => 'post_date',
                        'order' => 'DESC',
                        'no_found_rows' => 1,
                        'faq_categories' => $term->slug
                        )
            );

            while ($faqquery->have_posts()) : $faqquery->the_post();
            ?>
			<div class="panel panel-default">
            <div class="panel-heading">
			
	
	<a data-toggle="collapse" data-parent="#accordion" href="#id-<?php echo esc_attr($i); ?>"><h4 class="panel-title"><?php the_title(); ?></h4></a>
	
    
	</div>
    
            <div id="id-<?php echo esc_attr($i); ?>" class="panel-collapse collapse">
			<div class="panel-body">
                <?php the_content(); ?>
            </div>
	</div>
			
    </div>
            <?php
			$i++;
                endwhile;
            
        }
    }
    wp_reset_postdata();
?>
    
</div>
 
 