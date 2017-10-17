<?php

/**
 * Class ParseComment
 *
 * @since Cactus Alpha 1.0
 * @package cactus
 */

namespace App\Views;

class ParseComment {

	public function __construct() {

	}

	public static function get_comment_form_args() {
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$html_req = ( $req ? " required='required'" : '' );
		$commenter = wp_get_current_commenter();
		
		$fields =  array(

			'author' =>
			'<p class="comment-form-author">'.
			'<input id="author" name="author" type="text" placeholder="' . esc_html__( 'Name', 'felis' ) . ( $req ? '*' : '' ) .' " value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30"' . $aria_req . ' /></p>',

			'email' =>
			'<p class="comment-form-email">'.
			'<input id="email" name="email" type="text" placeholder="' . esc_html__( 'Email', 'felis' ) . ( $req ? '*' : '' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'" size="30"' . $aria_req . ' /></p>',

			'url' =>
			'<p class="comment-form-url">'.
			'<input id="url" name="url" type="text" placeholder="' . esc_html__( 'Website', 'felis' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" size="30" /></p>',
			);

		$args = array(
			'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h4>',
			'fields' => $fields,
			'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_html__( 'Comment', 'felis' ) . '"></textarea></p>'
			);

		return $args;
	}

	public static function comment_item( $comment, $args, $depth ) {
		if ('div' === $args['style']) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo esc_html($tag); ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ('div' != $args['style']) : ?>
		<article id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<div class="block block-left">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( $args['avatar_size'] != 0 ) {
						echo get_avatar($comment, $args['avatar_size']);
					} ?>
					<b class="fn"><?php echo get_comment_author_link(); ?></b>
				</div>
				<div class="comment-metadata">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
						<div><?php
						/* translators: 1: date, 2: time */
						printf( esc_html__( '%1$s at %2$s', 'felis' ), get_comment_date(), get_comment_time() ); ?></div></a>
					</div>
				</footer>
				<div class="comment-content">
					<?php comment_text(); ?>

					<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'felis'); ?></em>
					<br/>
				<?php endif; ?>

				<?php edit_comment_link(esc_html__('(Edit)', 'felis'), '  ', ''); ?>
			</div>
			<div class="reply">
				<?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			</div>
			<!-- .comment-meta -->
		</div>

		<?php if ( 'div' != $args['style'] ) : ?>
	</article>
	<?php endif; ?>
	<?php
	}
}