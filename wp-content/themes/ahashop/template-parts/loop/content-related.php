<?php
/**
 * Template part for related post
 *
 * @package Ahashop
 */

?>
<article <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-img">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail( 'ahashop-large' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<?php the_title( '<div class="entry"><h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">', '</a></h4></div>' ); ?>
</article>
