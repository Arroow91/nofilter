<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (theme_locals("please_do_not"));

	if ( post_password_required() ) { ?>
	<?php echo '<p class="nocomments">' . theme_locals("password") . '</p>'; ?>
	<?php
		return;
	}
?>	
<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$consent  = empty($commenter['comment_author_email']) ? '' : ' checked="checked"';
    $buzzblogpro_comments_args = array(
        'label_submit'=> theme_locals("post_comment"),
        'title_reply'=> theme_locals("what_do_you_think"),
        'comment_notes_after' => '',
        'comment_field' => '<div class="row"><div class="col-md-12"><div class="form-group"><textarea cols="45" rows="8" id="comment" class="form-control" name="comment" aria-required="true" placeholder="' . theme_locals("your_comment") . '"></textarea></div></div></div>',
        'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<div class="row"><div class="col-md-4"><div class="form-group">' . ( $req ? '' : '' ) .
      '<input placeholder="' . theme_locals("author_name") . '" id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' /></div></div>',

    'email' =>
      '<div class="col-md-4"><div class="form-group">' . ( $req ? '' : '' ) .
      '<input placeholder="' . theme_locals("email_comment") . '" id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' /></div></div>',

    'url' =>
      '<div class="col-md-4"><div class="form-group"><input placeholder="' . theme_locals("website_comment") . '" id="url" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></div></div></div>',
	  'cookies' => '
			<p class="comment-form-cookies-consent">
				<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />
				<label for="wp-comment-cookies-consent">' 
					. esc_html__('Save my name, email, and website in this browser for the next time I comment.') .'
				</label>
			</p>',
    )
        ),
);  
	// Not supported before 4.9.6
	if (version_compare($GLOBALS['wp_version'], '4.9.6', '<')) {
		unset($fields['cookies']);
	}
comment_form($buzzblogpro_comments_args); ?>
	<?php if ( have_comments() ) : global $wp_query; ?>
	<div id="comments" class="comment-holder">
	<?php if (!empty($comments_by_type['comment'])) { 
$comments_number = get_comments_number();
$ping_nr = count($wp_query->comments_by_type['pingback']);
$comments_number_no_ping = $comments_number - $ping_nr ;
	?>
		<h5 class="comments-h"><span>
					<?php
				printf( esc_html(_nx( '1 Comment', '%1$s Comments', $comments_number_no_ping, 'comments title', 'buzzblogpro' )),
					number_format_i18n( $comments_number_no_ping ), get_the_title() );
			?>
					</span></h5>
		<ul class="commentlist">
<?php wp_list_comments(	array(
					'type'       => 'comment',
					'callback'   => 'buzzblogpro_comment',
					'avatar_size'=> 65,
					'comment_date'=> buzzblogpro_getVariable('date_format') ? buzzblogpro_getVariable('date_format') : 'F j, Y'
				)); ?>
</ul>
<?php }  ?>
		<div class="pagination">
		  <?php paginate_comments_links(); ?> 
		</div>
	</div>
	<?php else : ?>

	<?php if ( comments_open() ) : ?>
	   <?php echo '<p class="nocomments">' . theme_locals("no_comments_yet") . '</p>'; ?>
		<?php else : ?>

		<?php endif; ?>
	
	<?php endif; ?>
