<?php
/**
 * Template for post in posts list
 *
 * @package Ahashop
 */

?>
<!-- standard post -->
<article <?php post_class( 'entry-item' ); ?>>
	<?php ahashop_featured_image(); ?>

	<div class="entry-wrap">
		<div class="entry">
			<?php ahashop_entry_title(); ?>

			<?php ahashop_post_meta(); ?>

			<div class="entry-content">
				<?php ahashop_entry_content(); ?>
			</div>
		</div>
	</div>
</article> <!-- end standard post -->
