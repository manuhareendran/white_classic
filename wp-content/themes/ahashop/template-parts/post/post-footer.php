<?php
/**
 * Template part for single post footer
 *
 * @package Ahashop
 */

?>
<div class="row">

	<!-- tags -->
	<div class="col-sm-6">
		<?php the_tags( '<div class="entry-tags tags clearfix">
			<span>' . esc_html__( 'Tags:', 'ahashop' ) . '</span>', ', ', '</div>' ); ?>
	</div>

	<?php if ( class_exists( 'Ahashop_Social' ) ) : ?>
		<!-- entry share -->
		<div class="col-sm-6">
			<div class="entry-share">
				<?php ahashop_entry_sharing(); ?>
			</div>
		</div>
	<?php endif; ?>
</div>
