<?php if((is_singular() && buzzblogpro_getVariable('featured_images') =='featured1') or (is_singular() && buzzblogpro_getVariable('featured_images') =='') ) { ?>

	<?php if(has_post_thumbnail()) { ?>
<figure class="featured-thumbnail thumbnail large">
				<?php buzzblogpro_pinterest_share(); ?>
				<?php the_post_thumbnail( 'buzzblogpro-standard-large' ); ?> 
</figure>
<?php
   }
 } 