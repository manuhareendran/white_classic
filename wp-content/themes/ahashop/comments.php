<?php
/**
 * Comments template
 *
 * @package Ahashop
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<!-- Comments -->
<div id="comments" class="entry-comments mt-20">
	<?php if ( have_comments() ) : ?>
		<h3 class="heading uppercase mb-40">
			<?php
			$comments_number = get_comments_number();
			printf(
				/* translators: 1: number of comments, 2: post title */
				_nx(
					'%s Comment',
					'%s Comments',
					$comments_number,
					'comments title',
					'ahashop'
				),
				number_format_i18n( $comments_number )
			);
			?>
		</h3>

		<ul class="comment-list">
			<?php
			wp_list_comments( array(
				'avatar_size' => 70,
				'style'       => 'ul',
				'short_ping'  => false,
				'callback'    => 'ahashop_comments_callback',
			) );
			?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 ) : ?>
			<nav class="comments-pagination navigation pagination text-center" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comments navigation', 'ahashop' ); ?></h2>

				<?php
				the_comments_pagination( array(
					'prev_text' => '<i class="fa fa-angle-left"></i>',
					'next_text' => '<i class="fa fa-angle-right"></i>',
				) );
				?>
			</nav>
		<?php endif; ?>
	<?php endif; ?>
</div> <!--  end comments -->

<!-- Leave a Comment -->
<div class="comment-form mt-60">
	<?php ahashop_comment_form(); ?>
</div>
