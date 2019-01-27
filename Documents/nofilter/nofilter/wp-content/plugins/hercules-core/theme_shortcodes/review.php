<?php
/**
 * Hercules review Shortcode
 */
function hercules_review_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );

	$review_id = get_the_ID();
	if ( ! empty( $id ) && is_numeric( $id ) ) {
		$review_id = $id;
	}


$entries = get_post_meta( $review_id, '_buzzblogpro_review_box', true );
$review_title = get_post_meta( $review_id, '_buzzblogpro_review_title_text', true );
$review_description = get_post_meta( $review_id, '_buzzblogpro_review_description_text', true );
$total_score = 0;
$total_num = count($entries);

	ob_start(); ?>

<div id="review" class="review-box" itemscope itemtype="http://schema.org/Review">
<?php if($review_title){echo '<h4 class="review-title" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing"><a itemprop="url" href="'.get_permalink().'">'.wp_kses( $review_title, wp_kses_allowed_html( 'post' ) ).'</a></h4>';}  ?> 
<?php
foreach ( (array) $entries as $key => $entry ) {

	$title = $number = '';

	if ( isset( $entry['_buzzblogpro_review_title_box'] ) ) {
		$title = $entry['_buzzblogpro_review_title_box'];
	}

	if ( isset( $entry['_buzzblogpro_review_number'] ) ) {
		$number = esc_html( $entry['_buzzblogpro_review_number'] );
		$form = number_format( $number, 1, '.', '' );
	$percentvalue =	$form * 10;
	}

echo do_shortcode( '[progressbar label="'.wp_kses( $title, wp_kses_allowed_html( 'post' ) ).'" points="'.$number.'" value="'.$percentvalue.'"]' ); 

$total_score+= $number;
}


$total_review = $total_score / $total_num;

$format = number_format( $total_review, 1, '.', '' );
$percent =	$format * 10;
?>

<div class="row score-container">
<div class="col-sm-8 col-md-8 col-ld-9">
<?php if($review_description){echo '<div class="review-description" itemprop="description">'.wp_kses( $review_description, wp_kses_allowed_html( 'post' ) ).'</div><span style="display: none !important;" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name">'.get_the_author().'</span></span>';}  ?> 
</div>
<div class="col-sm-4 col-md-4 col-ld-3">
<div class="review-score" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating"><div class="review-numer" itemprop="ratingValue"><?php echo esc_attr($format); ?></div><span style="display: none !important;" itemprop="bestRating"><?php echo esc_attr($format); ?></span><span class="overall-score"><?php esc_html_e( 'Overall Score', 'buzzblogpro' );?></span></div>
</div>
</div>
</div>

	<?php
	return ob_get_clean();
}

add_shortcode( 'hercules_review', 'hercules_review_shortcode' );
