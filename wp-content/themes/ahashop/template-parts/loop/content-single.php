<?php
/**
 * Template for single post
 *
 * @package Ahashop
 */

?>
<!-- standard post -->
<article <?php post_class( 'entry-item' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-img">
			<?php the_post_thumbnail( 'ahashop-large' ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-wrap">
		<div class="entry">
			<?php ahashop_entry_title(); ?>

			<?php ahashop_post_meta(); ?>

			<div class="entry-content">
				<?php ahashop_entry_content(); ?>
			</div>

			<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'ahashop' ),
					get_the_title()
				),
				'<div class="edit-link">',
				'</div>'
			);
			?>
		</div>
	</div>
</article> <!-- end standard post -->
