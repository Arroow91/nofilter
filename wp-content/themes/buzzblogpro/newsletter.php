<div id="hs_signup" class="zoom-anim-dialog mfp-hide" data-showonload="<?php if(buzzblogpro_getVariable('newsletter-cookie-onload') =='yes') { echo 'true';}else{echo 'false';} ?>">
<div id="hs_signup_inner" class="row-eq-height">
<?php 
if (buzzblogpro_getVariable('newsletter_image_url','url')) {
$isimage = '';
?>
<div class="newsletter-picture">
<img src="<?php echo esc_url( buzzblogpro_getVariable('newsletter_image_url','url')); ?>" width="<?php echo esc_attr( buzzblogpro_getVariable('newsletter_image_url','width')); ?>" height="<?php echo esc_attr( buzzblogpro_getVariable('newsletter_image_url','height')); ?>" alt="" title="" />
</div>
<?php 
}else{
$isimage = 'withoutimage';
}
?>

<div class="newsletter-form left-space <?php echo esc_attr($isimage);?>">
<?php dynamic_sidebar("hs_newsletter_popup"); ?>

</div>


</div></div>