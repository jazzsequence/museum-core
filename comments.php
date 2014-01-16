<?php

if ( post_password_required() ) { ?>

	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','museum-core'); ?></p>
	<?php return;

}

if ( have_comments() ) : ?>
	<h3 id="comments"><?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'museum-core' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?></h3>

	<nav class="navigation clearfix">
		<ul class="pager">
			<li class="previous"><?php previous_comments_link() ?></li>
			<li class="next"><?php next_comments_link() ?></li>
		</ul>
	</nav>

	<ol class="commentlist">
		<?php wp_list_comments('callback=ap_core_comment'); ?>
	</ol>

	<nav class="navigation clearfix">
		<ul class="pager">
			<li class="previous"><?php previous_comments_link() ?></li>
			<li class="next"><?php next_comments_link() ?></li>
		</ul>
	</nav>
 <?php endif; // ends have_comments()

if ( !comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) && !is_page() ) :

		// if it's not a page, display comments are closed message ?>
		<p><?php _e('Comments are closed.','museum-core'); ?></p>

<?php endif;

if ( comments_open() ) : ?>

	<div class="cancel-comment-reply">
		<small><?php cancel_comment_reply_link( '<span class="text-danger">' . __( 'Cancel comment response', 'museum-core' ) . '</span>' ); ?></small>
	</div>

<?php

	$ap_comment_form = '<div class="form-group"><label for="comment">' . __( 'Comment', 'museum-core' ) . '</label>';
	$ap_comment_form .= '<textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>';
	$ap_comment_form .= '</div>';

	$ap_comment_notes_after = '<div class="form-group form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'museum-core' ), ' <pre>' . allowed_tags() . '</pre>' ) . '</div>';

	comment_form( array( 'comment_field' => $ap_comment_form, 'comment_notes_after' => $ap_comment_notes_after ) ); ?>

<?php endif; // end comments_open() ?>