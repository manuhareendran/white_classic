<?php
/**
 * Template for single page
 *
 * @package Ahashop
 */

?>
<article <?php post_class( 'entry-item' ); ?>>
	<?php ahashop_featured_image(); ?>

	<div class="entry-wrap">
		<div class="entry">
			<?php ahashop_entry_title(); ?>

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
</article>
