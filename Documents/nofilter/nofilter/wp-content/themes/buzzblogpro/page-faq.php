<?php
/**
* Template Name: FAQs
*/
get_header(); ?>
<div class="content-holder clearfix">
<div class="container">
<?php get_template_part('title'); ?>
                <div class="row">
                    <div class="col-md-12" id="content">
					<article class="post__holder">
					<?php get_template_part("loop/loop-page"); ?>
                        <?php get_template_part("loop/loop-faq"); ?>
						</article>
                    </div>
                </div>
    </div>
</div>
<?php get_footer(); ?>