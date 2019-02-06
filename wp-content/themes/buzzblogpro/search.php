<?php get_header(); ?>
<div class="content-holder clearfix">
    <div class="container">
<?php get_template_part('title'); ?>
                <div class="row">
                    <div class="col-md-12" >
                        <div class="list-post ajax-container row">
                         <?php 
						get_template_part("loop/loop-search"); ?>
                    </div>
                        <?php get_template_part('post-template/post-nav'); ?>
                    </div>
                </div>
    </div>
</div>
<?php get_footer(); ?>