<?php 
global $query,$is_woocmerce_active,$is_product;
if( $query->have_posts()):
?>
	<ul class="search-option-tab">
		<li class="active all-tab"><a href="#all"><?php esc_html_e('All results','buzzblogpro')?></a></li>
		<?php if($is_woocmerce_active && $is_product):?>
			<li><a href="#product"><?php esc_html_e('Shop','buzzblogpro')?></a></li>
			<li><a href="#post"><?php esc_html_e('Blog','buzzblogpro')?></a></li>
		<?php endif;?>
	</ul>
	
	<?php  while ( $query->have_posts() ):?>
		<?php 
		$query->the_post();
		$chechk_product = $is_woocmerce_active && get_post_type()==='product';	
		if(has_post_thumbnail()){
			$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full');
				$img_width = 70;
				$img_height = 70;
				$post_image = aq_resize( $img_url, $img_width, $img_height, true, true, true );
			if(!$post_image){
				$post_image = $chechk_product?get_the_post_thumbnail_url( null,'shop_thumbnail'):get_the_post_thumbnail_url( null,'thumbnail');
			}
		}
		else{
			$post_image = '//placehold.it/70x70';
		}
	?>
		<div class="result-item <?php echo $chechk_product?'result-product':'result-post'?>"> 
			<a href="<?php the_permalink()?>">
				<img class="lazyload" data-src="<?php echo esc_url($post_image); ?>" width="<?php echo esc_attr($img_width); ?>" height="<?php echo esc_attr($img_height); ?>" />
				<h3 class="title"><?php the_title()?></h3>
				<span class="post-date date"><?php  buzzblogpro_time_ago(); ?></span>
				<?php if($chechk_product):?>
					<?php global $product?>
					<span class="price"><?php echo $product->get_price_html()?></span>
				<?php endif;?>
			</a> 
			
		</div>
		<!-- /result-item -->
	<?php endwhile;?>
	
	<?php if($query->max_num_pages>1):?>
		<div class="view-all-wrap"> 
			<?php $search_link = get_search_link($_POST['term']);?>
			<?php if($is_woocmerce_active && $is_product):?>
				<a id="result-link-product" href="<?php echo add_query_arg(array('type'=>'product'),$search_link)?>" class="view-all-button"><?php esc_html_e('View All Products','buzzblogpro')?></a> 
				<a id="result-link-post" href="<?php echo add_query_arg(array('type'=>'post'),$search_link)?>" class="view-all-button"><?php esc_html_e('View All Posts','buzzblogpro')?></a> 
			<?php endif;?>
			<a id="result-link-item" href="<?php echo $search_link ?>" class="view-all-button"><?php _e('View All','buzzblogpro')?></a> 
		</div>
		<!-- /view-all-wrap -->
	<?php endif;?>
	<?php else:?>
		<p><?php esc_html_e('No Items Found','buzzblogpro');?></p>
<?php endif;?>