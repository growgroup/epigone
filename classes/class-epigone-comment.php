<?php
/**
 * Extend comment form
 * =====================================================
 * @package  epigone
 * @license  GPLv2 or later
 * =====================================================
 */

class Epigone_Comment extends Walker_Comment {

	var $tree_type = 'comment';
	var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

	/**
	 * construct
	 *
	 */

	public function __construct() {

		echo '<h3 id="comments-title" class="comments--title">' . __( 'Comments', 'epigone' ) . '</h3>';
		echo '<ul id="comment-list" class="comments--list">';

	}

	public function start_lvl( &$output, $depth = 0, $args = array() ) {

		$GLOBALS['comment_depth'] = $depth + 1;
		echo '<ul class="children comments--list">';

	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {

		$GLOBALS['comment_depth'] = $depth + 1;
		echo '</ul><!-- /.children -->';

	}

	public function start_el( &$output, $comment, $depth, $args, $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>

		<li <?php comment_class( $parent_class ); ?> id="comment-<?php comment_ID() ?>">
			<div id="comment-body-<?php comment_ID() ?>" class="comments--body">

				<div class="comment-author vcard author">
					<?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, $args['avatar_size'] ) :'' ); ?>
					<cite class="comment author-name"><?php echo get_comment_author_link(); ?></cite>
				</div><!-- /.comment-author -->

				<div id="comment-content-<?php comment_ID(); ?>" class="comments--content">
					<?php if( !$comment->comment_approved ) : ?>
					<em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>

					<?php else: comment_text(); ?>
					<?php endif; ?>
				</div><!-- /.comment-content -->

				<div class="comment--meta comment--meta-data">
					<a href="<?php
					echo htmlspecialchars( get_comment_link( get_comment_ID() ) );
					?>"><?php comment_date(); ?> at <?php comment_time(); ?></a> <?php edit_comment_link( '(Edit)' ); ?>
				</div><!-- /.comment-meta -->

				<div class="reply">
					<?php
					$reply_args = array(
							'add_below' => $add_below,
							'depth' => $depth,
							'max_depth' => $args['max_depth'],
					);

					comment_reply_link( array_merge( $args, $reply_args ) );  ?>
				</div><!-- /.reply -->
			</div><!-- /.comment-body -->

	<?php
	}

	public function end_el(&$output, $comment, $depth = 0, $args = array() ) {

		echo '</li><!-- /#comment-' . get_comment_ID() . ' -->';

	}

	public function __destruct() {

		echo '</ul><!-- /#comment-list -->';

	}
}
