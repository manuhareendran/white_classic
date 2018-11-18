<?php
/**
 * Template for post audio
 *
 * @package Ahashop
 */

?>
<!-- audio post -->
<article <?php post_class( 'entry-item' ); ?>>
	<?php ahashop_featured_audio(); ?>

	<div class="entry-wrap">
		<div class="entry">
			<?php ahashop_entry_title(); ?>

			<?php ahashop_post_meta(); ?>

			<div class="entry-content">
				<?php ahashop_entry_content(); ?>
			</div>
		</div>
	</div>
</article> <!-- end audio post -->
