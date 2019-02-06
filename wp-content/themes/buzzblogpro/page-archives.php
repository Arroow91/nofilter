<?php
/**
* Template Name: Archives
*/

get_header(); ?>

<div class="content-holder clearfix">
    <div class="container">         
<?php get_template_part('title'); ?>
                <div class="row">
                    <div class="col-md-12" id="content">
			
                        <?php get_template_part("loop/loop-archives"); ?>
						
                    </div>
                </div>
    </div>
</div>

<?php get_footer(); ?>