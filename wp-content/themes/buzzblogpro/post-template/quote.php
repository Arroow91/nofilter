<?php 
$quote = get_post_meta(get_the_ID(), '_buzzblogpro_post_quote', true);
$quote_author = get_post_meta(get_the_ID(), '_buzzblogpro_post_quote_author', true);
?>
<?php if($quote) { ?>
<blockquote><p><?php echo $quote ?></p><?php if($quote_author) { ?><cite><?php echo $quote_author ?></cite><?php } ?></blockquote>
<?php } ?>
	
