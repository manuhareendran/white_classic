<?php
/**
 * Template part for single post author box
 *
 * @package Ahashop
 */

?>
<!-- entry author -->
<div class="entry-author-box clearfix">
	<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>

	<div class="author-info">
		<h6 class="author-name uppercase"><?php the_author(); ?></h6>
		
		<?php if ( $position = get_the_author_meta( 'position' ) ) : ?>
			<span><?php echo wp_kses_post( $position ); ?></span>
		<?php endif; ?>
		
		<?php if ( $desc = get_the_author_meta( 'description' ) ) : ?>
			<p class="mb-0"><?php echo wp_kses_post( nl2br( $desc ) ); ?></p>
		<?php endif; ?>
	</div>
</div>
