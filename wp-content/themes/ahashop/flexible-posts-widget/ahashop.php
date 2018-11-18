<?php
/**
 * Flexible Posts Widget: Ahashop widget template
 *
 * @package Ahashop
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

echo wp_kses_post( $before_widget );

if ( ! empty( $title ) ) {
	echo wp_kses_post( $before_title . $title . $after_title );
}

if ( $flexible_posts->have_posts() ) : ?>
	<div class="entry-list w-thumbs">
		<ul class="posts-list">
			<?php while ( $flexible_posts->have_posts() ) : $flexible_posts->the_post(); ?>

				<li class="entry-li">
					<article <?php post_class( 'post-small clearfix' ); ?>>
						<?php if ( $thumbnail && has_post_thumbnail() ) : ?>
							<div class="entry-img">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( $thumbsize ); ?>
								</a>
							</div>
						<?php endif; ?>

						<div class="entry">
							<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">', '</a></h3>' ); ?>

							<ul class="entry-meta list-inline">
								<li class="entry-date">
									<?php ahashop_entry_date(); ?>
								</li>
							</ul>
						</div>
					</article>
				</li>
			<?php endwhile;
			wp_reset_postdata(); ?>
		</ul>
	</div>
<?php
endif; // End have_posts().

echo wp_kses_post( $after_widget );
