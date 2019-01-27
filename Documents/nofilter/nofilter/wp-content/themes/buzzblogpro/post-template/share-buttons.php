<?php
$social_share = buzzblogpro_getVariable('social_share');
$facebook_share = buzzblogpro_getVariable('facebook_share');
$twitter_share = buzzblogpro_getVariable('twitter_share');
$twitter_username = buzzblogpro_getVariable('hs_twitter_username');
$gplus_share = buzzblogpro_getVariable('gplus_share');
$pinterest_share = buzzblogpro_getVariable('pinterest_share');
$tumblr_share = buzzblogpro_getVariable('tumblr_share');
$email_share = buzzblogpro_getVariable('email_share');
$vkontakte_share = buzzblogpro_getVariable('vkontakte_share');
$whatsapp_share = buzzblogpro_getVariable('whatsapp_share');
$linkedin_share = buzzblogpro_getVariable('linkedin_share');

if (buzzblogpro_getVariable('social_share')=='yes' ) {

?>

<div class="share-buttons">
	<?php

		$permalink = get_permalink(get_the_ID());
		$titleget = strip_tags(get_the_title());
	?>

<?php
if ($facebook_share=='yes') { ?>
<a class="hs-icon hs hs-facebook" onClick="window.open('https://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink);?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="https://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink);?>"></a>
<?php } ?>
<?php
if ($twitter_share=='yes') { ?> 
<a class="hs-icon hs hs-twitter" onClick="window.open('https://twitter.com/share?url=<?php echo esc_url( $permalink); ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?><?php if ($twitter_username!='') { echo esc_attr( '&amp;via='.$twitter_username);} ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="https://twitter.com/share?url=<?php echo esc_url( $permalink); ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?><?php if ($twitter_username!='') { echo esc_attr( '&amp;via='.$twitter_username);} ?>"></a>
<?php } ?>
<?php
if ($gplus_share=='yes') { ?>
<a class="hs-icon hs hs-gplus" onClick="window.open('https://plus.google.com/share?url=<?php echo esc_url( $permalink); ?>','Google plus','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="https://plus.google.com/share?url=<?php echo esc_url( $permalink); ?>"></a>
<?php } ?>
<?php if ($pinterest_share=='yes') { $pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
<a target="_blank" class="hs-icon hs hs-pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url( $permalink); ?>&amp;media=<?php echo esc_attr($pinterestimage[0]); ?>&amp;description=<?php echo str_replace(" ", "%20", $titleget); ?>" data-pin-do="buttonPin" data-pin-custom="true"></a>
<?php } ?>
<?php
if ($tumblr_share=='yes') {
$str = $permalink;
$str = preg_replace('#^https?://#', '', $str);
?>
<a class="hs-icon hs hs-tumblr" onClick="window.open('https://www.tumblr.com/share/link?url=<?php echo esc_attr($str); ?>&amp;name=<?php echo str_replace(" ", "%20", $titleget); ?>','Tumblr','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="https://www.tumblr.com/share/link?url=<?php echo esc_attr($str); ?>&amp;name=<?php echo str_replace(" ", "%20", $titleget); ?>"></a>
<?php } ?>
<?php
if ($linkedin_share=='yes') { ?>
<a class="hs-icon hs hs-linkedin" onClick="window.open('https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink); ?>','Linkedin','width=1000,height=650,left='+(screen.availWidth/2-500)+',top='+(screen.availHeight/2-325)+''); return false;" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>&amp;source=LinkedIn"></a>
<?php } ?>
<?php
if ($vkontakte_share=='yes') { ?>
<a class="hs-icon hs hs-vk" onclick="window.open('https://vk.com/share.php?url=<?php echo esc_url( $permalink);?>','vkontakte','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="https://vk.com/share.php?url=<?php echo esc_url( $permalink);?>"></a>
<?php } ?>
<?php
if ($whatsapp_share=='yes') { ?>
<a class="hs-icon hs hs-whatsapp visible-xs-inline-block" href="whatsapp://send?text=<?php echo str_replace(" ", "%20", $titleget).'-'.esc_url( $permalink); ?>" data-action="share/whatsapp/share"></a>
<?php } ?>
<?php
if ($email_share=='yes') { ?>
<a class="hs-icon hs hs-mail" href="mailto:?subject=<?php echo str_replace(" ", "%20", $titleget); ?>&amp;body=<?php echo esc_url( $permalink); ?>"></a>
<?php } ?>
	
		
	<?php if( function_exists('hercules_likes') && buzzblogpro_getVariable('post_likes') !='no' ) { echo '<span class="heart hs-icon">';  hercules_likes(); echo '</span>'; } ?>
	

</div>
<?php } ?>