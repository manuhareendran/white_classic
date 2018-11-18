<?php
/**
 * Template for shortcode [ahashop_team_member]
 *
 * @package Ahashop
 * @var array  $atts
 * @var array  $socials
 * @var string $el_class
 */

?>
<div class="animated-from-left <?php echo esc_attr( $el_class ); ?>">
	<div class="team-member">
		<?php if ( $atts['avatar'] ) : ?>
			<div class="team-img">
				<?php echo wp_get_attachment_image( $atts['avatar'], 'full' ); ?>
			</div>
		<?php endif; ?>

		<h4 class="team-title uppercase"><?php echo esc_html( $atts['name'] ); ?></h4>

		<?php if ( $atts['position'] ) : ?>
			<span><?php echo esc_html( $atts['position'] ); ?></span>
		<?php endif; ?>

		<div class="team-details">
			<?php if ( $atts['desc'] ) : ?>
				<?php echo wp_kses_post( wpautop( $atts['desc'] ) ); ?>
			<?php endif; ?>

			<?php if ( $socials ) : ?>
				<div class="social-icons rounded">
					<?php foreach ( $socials as $social ) : ?>
						<a href="<?php echo esc_url( $social['url'] ); ?>" target="_blank"><i class="<?php echo esc_attr( $social['icon'] ); ?>"></i></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div> <!-- end team member -->
