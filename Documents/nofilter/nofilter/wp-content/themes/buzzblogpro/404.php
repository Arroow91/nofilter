<?php 
/**
* Template Name: 404
*/ 
get_header(); ?>
<div class="content-holder clearfix">
    <div class="container">
                <div class="row error404-holder">
                    <div class="col-md-7 error404-holder_num">
                    	<?php echo esc_html__('404', 'buzzblogpro'); ?>
                    </div>
                    <div class="col-md-5">
                    <div>
    <?php echo '<h3>' . esc_html__('Page Not Found', 'buzzblogpro') . '</h3>'; ?>
</div>

<?php echo '<h5>' . esc_html__('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'buzzblogpro') . '</h5>'; ?>
<?php echo '<p>' . esc_html__('Please try using our search box below.', 'buzzblogpro') . '</p>'; ?>

<?php get_search_form(); ?>
                    </div>
                </div>
    </div>
</div>

<?php get_footer(); ?>