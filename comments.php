<?php
/**
 * The template for displaying comments
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) {
		?>
		<h3 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( '1' === $comment_count ) {
				_e( '1 Comment', 'void-theme' );
			} else {
				printf( _n( '%s Comment', '%s Comments', $comment_count, 'void-theme' ), number_format_i18n( $comment_count ) );
			}
			?>
		</h3>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 50,
			) );
			?>
		</ol>

		<?php
		the_comments_pagination( array(
			'prev_text' => __( 'Older Comments', 'void-theme' ),
			'next_text' => __( 'Newer Comments', 'void-theme' ),
		) );
	}

	// If comments are closed and there are comments, let's leave a little note.
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
		?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'void-theme' ); ?></p>
		<?php
	}
	?>

	<?php
	comment_form( array(
		'class_form'         => 'comment-form',
		'title_reply'        => __( 'Leave a Comment', 'void-theme' ),
		'title_reply_to'     => __( 'Leave a Reply to %s', 'void-theme' ),
		'cancel_reply_link'  => __( 'Cancel Reply', 'void-theme' ),
		'label_submit'       => __( 'Post Comment', 'void-theme' ),
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published. Required fields are marked *', 'void-theme' ) . '</p>',
		'fields'             => array(
			'author' => '<p class="comment-form-author"><label for="author">' . __( 'Name', 'void-theme' ) . '<span class="required">*</span></label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" required /></p>',
			'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'void-theme' ) . '<span class="required">*</span></label><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" required /></p>',
			'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'void-theme' ) . '</label><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></p>',
		),
	) );
	?>

</div><!-- #comments -->
