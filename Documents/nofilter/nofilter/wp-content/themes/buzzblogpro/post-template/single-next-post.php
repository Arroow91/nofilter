<?php 
$pagination_type = buzzblogpro_getVariable('single_pagination_type');
if($pagination_type=='fixednav' && !buzzblogpro_is_touch() or $pagination_type=='bothnav' && !buzzblogpro_is_touch() ) {
if ( is_singular( 'post' ) && !buzzblogpro_is_touch('phone') ) : ?>
<?php $prev_post = get_previous_post(); ?>
    <?php if ( $prev_post ) : ?>
	<div class="single-next-post">
		<div class="post-text">
			<span class="sub-title">
                <?php esc_html_e( 'Previous' ,'buzzblogpro' ); ?>
            </span>
			<h5 class="post-title">
                <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo get_the_title( $prev_post->ID ); ?></a>
            </h5>
		</div>
		<div class="post-thumbnail">
			
				<?php
				$args = array(
					'post_id'        => $prev_post->ID,
					'attachment_id'  => get_post_thumbnail_id( $prev_post->ID ),
					'width'          => 140,
					'height'         => 180,
					'pinit' => false,
					'no-icon' => true,
					'disablevideolink' => true,
		'disableimagelink' => true,
				);
				if ( has_post_thumbnail( $prev_post->ID ) ) {
					buzzblogpro_post_thumbnail( $args );   
				} 
				?>
			
		</div>
	</div>
	<?php endif; ?>
<?php endif; ?>
<?php } ?>
