<?php

vc_add_shortcode_param( 'at_slick', function( $settings, $value ) {
	$output = '';

	ob_start(); ?>

	<div class="">

		<div class="vc_row">
			<div class="vc_col-xs-6">
				<label class="vc_checkbox-label">
					<input id="scrollwheel-false" value="false" class="checkbox" type="checkbox" name="scrollwheel">
					<span><?php esc_html_e( 'Enables Autoplay', 'sydneywp' ); ?></span>
				</label>
			</div>

			<div class="vc_col-xs-6">
				<label class="wpb_element_label"><?php esc_html_e( 'Autoplay Speed in milliseconds', 'sydneywp' ); ?></label>
				<input type="number" name="autoplaySpeed" value="">
			</div>
		</div>

		<br>

		<div class="vce-input-group-responsive">
			<div class="vce-input-group">
				<span class="vce-input-group__addon" title="<?php echo esc_attr( esc_html__( 'Large', 'sydneywp' ) ); ?>">
					<span class="dashicons dashicons-desktop"></span>
				</span>

				<input type="text" placeholder="">

				<span class="vce-input-group__tooltip"><?php echo esc_attr( esc_html__( 'Large', 'sydneywp' ) ); ?></span>
			</div>

			<div class="vce-input-group">
				<span class="vce-input-group__addon" title="<?php echo esc_attr( esc_html__( 'Medium', 'sydneywp' ) ); ?>">
					<span class="dashicons dashicons-laptop"></span>
				</span>

				<input type="text" placeholder="">

				<span class="vce-input-group__tooltip"><?php echo esc_attr( esc_html__( 'Medium', 'sydneywp' ) ); ?></span>
			</div>

			<div class="vce-input-group">
				<span class="vce-input-group__addon" title="<?php echo esc_attr( esc_html__( 'Small', 'sydneywp' ) ); ?>">
					<span class="dashicons dashicons-tablet"></span>
				</span>

				<input type="text" placeholder="">

				<span class="vce-input-group__tooltip"><?php echo esc_attr( esc_html__( 'Small', 'sydneywp' ) ); ?></span>
			</div>

			<div class="vce-input-group">
				<span class="vce-input-group__addon" title="<?php echo esc_attr( esc_html__( 'Extra Small', 'sydneywp' ) ); ?>">
					<span class="dashicons dashicons-smartphone"></span>
				</span>

				<input type="text" placeholder="">

				<span class="vce-input-group__tooltip"><?php echo esc_attr( esc_html__( 'Extra Small', 'sydneywp' ) ); ?></span>
			</div>
		</div>

	</div>

	<?php

	$output = ob_get_contents();
	ob_clean();

	return $output;
});
