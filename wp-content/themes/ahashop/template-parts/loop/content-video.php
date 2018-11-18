<?php
/**
 * Template for post video
 *
 * @package Ahashop
 */

?>
<!-- video post -->
<article <?php post_class( 'entry-item' ); ?>>
	<?php ahashop_featured_video(); ?>

	<div class="entry-wrap">
		<div class="entry">
			<?php ahashop_entry_title(); ?>

			<?php ahashop_post_meta(); ?>

			<div class="entry-content">
				<?php ahashop_entry_content(); ?>
			</div>
		</div>
	</div>
</article> <!-- end video post -->
