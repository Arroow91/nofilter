<?php 
$buzzblogpro_blog_text = buzzblogpro_getVariable('blog_text');
$buzzblogpro_page_title = get_post_meta( get_the_ID(), 'buzzblogpro_page_title_enable', true );
					if($buzzblogpro_page_title == esc_html__('enable','buzzblogpro') || ($buzzblogpro_page_title == "" && is_page()) || $buzzblogpro_blog_text !="" || is_category() || is_tax() || is_search() || is_day() || is_month() || is_year() || is_author() || is_tag()  ){ ?>
<section class="title-section">
		<?php 
					$shop_page = false;
			if(function_exists( 'is_shop' )){
				if(is_shop()){
					$shop_page = true;
				}
			}
				if(is_home()){ ?>
			<?php  ?>
				<?php if($buzzblogpro_blog_text){?>
					<h1><?php echo buzzblogpro_getVariable('blog_text'); ?></h1>
				<?php } ?>
				<?php $hercules_blog_sub = buzzblogpro_getVariable('blog_sub'); ?>
				<?php if($hercules_blog_sub){?>
					<?php echo "<span></span><h2>". buzzblogpro_getVariable('blog_sub') . "</h2>"; 	?>
				<?php }
			
		} elseif  ( is_category() && buzzblogpro_getVariable('category_name') =='yes' && buzzblogpro_getVariable('category_word') !='no' || is_category() && buzzblogpro_getVariable('category_name') =='' && buzzblogpro_getVariable('category_word') !='no' ) { ?>
			<div class="category-box"><h1><span><?php printf( theme_locals("category_archives")." %s", '</span>' . single_cat_title( '', false ) . '' ); ?></h1></div>
            <?php if ( category_description() ) {echo '<h2 class="cat-des">'.category_description().'</h2>';} /* displays the category's description from the WordPress admin */ ?>
			
		<?php } elseif ( is_category() && buzzblogpro_getVariable('category_name') =='no' ) { ?>
		
		<?php } elseif ( is_category() && buzzblogpro_getVariable('category_word') =='no' ) { ?>
			<h1><?php printf( " %s", '' . single_cat_title( '', false ) . '' ); ?></h1>
            <?php if ( category_description() ) {echo '<h2 class="cat-des">'.category_description().'</h2>';} /* displays the category's description from the WordPress admin */ ?>	
			
		<?php } elseif ( is_tax('location')  ) { ?>
			<div class="category-box"><h1><span><?php echo esc_html__('Location', 'buzzblogpro'); ?></span>
			<?php echo single_cat_title( '', false ); ?></h1></div>
	<?php } elseif ( is_tax()  ) { ?>
			<div class="category-box"><h1><span><?php echo theme_locals("posts_by_type"); ?></span>
			<h1><?php echo single_cat_title( '', false ); ?></h1></div>
		
		<?php } elseif ( is_search() ) { ?>
			<div class="category-box"><h1><span><?php echo theme_locals("fearch_for"); ?></span>
			<?php the_search_query(); ?></h1></div>
		
		<?php } elseif ( is_day() ) { ?>
			<div class="category-box"><h1><span><?php printf( theme_locals("daily_archives")." %s", '</span>' . get_the_date() ); ?></h1></div>
			
		<?php } elseif ( is_month() ) { ?>	
			<div class="category-box"><h1><span><?php printf( theme_locals("monthly_archives")." %s", '</span>' . get_the_date('F Y') ); ?></h1></div>
			
		<?php } elseif ( is_year() ) { ?>	
			<div class="category-box"><h1><span><?php printf( theme_locals("yearly_archives")." %s", '</span>' . get_the_date('Y') ); ?></h1></div>
		
		<?php } elseif ( is_author() ) { ?>
			
				<div class="category-box"><h1><span><?php echo theme_locals("by");?></span><?php echo get_the_author(); ?></h1></div>
				
		<?php } elseif ( is_tag() ) { ?>
			<div class="category-box"><h1><span><?php printf( theme_locals("tag_archives")." %s", '</span>' . single_tag_title( '', false ) . '' ); ?></h1></div>
			
		<?php } elseif ( is_tag('gallery_tag') ) { ?>
			<?php echo theme_locals("gallery_categories"); ?>
			<small><?php echo single_cat_title( '', false ); ?> </small>

		<?php } elseif ($shop_page) {
				if (class_exists( 'Woocommerce' ) && !is_single()){
					$page_id = woocommerce_get_page_id('shop');
				} elseif (function_exists( 'jigoshop_init' ) && !is_singular()){
					$page_id = jigoshop_get_page_id('shop');
				}
				echo '<h1>'.get_page($page_id)->post_title.'</h1>';
		?>

		<?php } else { ?>
		
			<?php if (have_posts()) : while (have_posts()) : the_post();
				$buzzblogpro_title = get_post_meta( get_the_ID(), 'buzzblogpro_page_tit', true );
$buzzblogpro_subtitle = get_post_meta( get_the_ID(), 'buzzblogpro_page_sub', true );
					if($buzzblogpro_title == ""){ ?>
						<h1><?php esc_attr(the_title()); ?></h1>
						<?php
					} else { ?>
						<h1><?php echo esc_attr($buzzblogpro_title); ?></h1>
					<?php
					}
					if($buzzblogpro_subtitle != ""){ ?>
						<h2><?php echo esc_attr($buzzblogpro_subtitle);?></h2>
					<?php }
				endwhile; endif;			
		} ?>
	
</section>
<?php }else{ ?>
<?php } ?>