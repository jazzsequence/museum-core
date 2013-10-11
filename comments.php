<?php

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','museum-core'); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'museum-core' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?></h3>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist">
	<?php wp_list_comments('type=all&callback=ap_core_comment'); ?>
	</ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed
		if ( !is_page() ) {
			// if it's not a page, display comments are closed message ?>
			<p><?php _e('Comments are closed.','museum-core'); ?></p>
		<?php }
	 endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php
	$ap_anchor = '<a href="' . wp_login_url( get_permalink() ) . '">';
	$ap_anchorclose = '</a>';
	echo sprintf( __('You must be %1$slogged in%$2s to post a comment.','museum-core'), $ap_anchor, $ap_anchorclose ); ?></p>
<?php else : ?>

<?php

	$ap_comment_form = '<div class="form-group"><label for="comment">' . __( 'Comment', 'museum-core' ) . '</label>';
	$ap_comment_form .= '<textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>';
	$ap_comment_form .= '</div>';

	$ap_comment_notes_after = '<div class="form-group form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'museum-core' ), ' <pre>' . allowed_tags() . '</pre>' ) . '</div>';

?>

<?php comment_form( array( 'comment_field' => $ap_comment_form, 'comment_notes_after' => $ap_comment_notes_after ) ); ?>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
