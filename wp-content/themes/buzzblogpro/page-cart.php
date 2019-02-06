<?php get_header(); ?>

<div class="content-holder clearfix">
	<div class="container">
<?php get_template_part('title'); ?>
				     <div class="row">   
                    <div class="col-md-12 content" id="content">
					<main id="main" class="site-main" role="main">
                        <?php get_template_part("loop/loop-main-page"); ?>
					</main>
                    </div>
                      </div>
	</div>
</div>
<?php get_footer(); ?>