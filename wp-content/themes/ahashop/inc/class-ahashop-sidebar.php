<?php
/**
 * Sidebar feature
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_Sidebar
 */
class Ahashop_Sidebar {

	/**
	 * Class Ahashop_Sidebar construct.
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'register_settings' ) );

		add_action( 'add_meta_boxes', array( $this, 'register_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_meta_box' ) );

		add_filter( 'ahashop_content_classes', array( $this, 'layout_content_classes' ) );
	}

	/**
	 * Register customize settings.
	 *
	 * @param  object $wp_customize WP_Customize object.
	 */
	public function register_settings( $wp_customize ) {
		$opt_sidebar_layout = $this->_get_option_sidebar_layout();

		$wp_customize->add_section( 'sidebar', array(
			'title'    => esc_html__( 'Sidebar', 'ahashop' ),
			'priority' => 60,
		) );

		// Blog.
		$wp_customize->add_setting( 'sidebar_layout', array(
			'default'              => ahashop_default( 'sidebar_layout' ),
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ahashop_sanitize_sidebar_layout',
		) );
		$wp_customize->add_control( 'sidebar_layout', array(
			'label'       => esc_html__( 'Sidebar layout', 'ahashop' ),
			'section'     => 'sidebar',
			'type'        => 'select',
			'choices'     => $opt_sidebar_layout,
		) );

		// Archive.
		$wp_customize->add_setting( 'sidebar_archive_layout', array(
			'default'              => ahashop_default( 'sidebar_archive_layout' ),
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ahashop_sanitize_sidebar_layout',
		) );
		$wp_customize->add_control( 'sidebar_archive_layout', array(
			'label'       => esc_html__( 'Sidebar layout for archive page', 'ahashop' ),
			'section'     => 'sidebar',
			'type'        => 'select',
			'choices'     => $opt_sidebar_layout,
		) );

		// Single.
		$wp_customize->add_setting( 'sidebar_single_layout', array(
			'default'              => ahashop_default( 'sidebar_single_layout' ),
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ahashop_sanitize_sidebar_layout',
		) );
		$wp_customize->add_control( 'sidebar_single_layout', array(
			'label'       => esc_html__( 'Sidebar layout for single page', 'ahashop' ),
			'section'     => 'sidebar',
			'type'        => 'select',
			'choices'     => $opt_sidebar_layout,
		) );

		// Page.
		$wp_customize->add_setting( 'sidebar_page_layout', array(
			'default'              => ahashop_default( 'sidebar_page_layout' ),
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ahashop_sanitize_sidebar_layout',
		) );
		$wp_customize->add_control( 'sidebar_page_layout', array(
			'label'       => esc_html__( 'Sidebar layout for page detail page', 'ahashop' ),
			'section'     => 'sidebar',
			'type'        => 'select',
			'choices'     => $opt_sidebar_layout,
		) );
	}

	/**
	 * Register meta box.
	 *
	 * @param  string $post_type Post type.
	 */
	public function register_meta_box( $post_type ) {
		add_meta_box(
			'ahashop-sidebar-layout',
			esc_html__( 'Sidebar layout', 'ahashop' ),
			array( $this, 'render_meta_box' ),
			$post_type,
			'side',
			'default'
		);
	}

	/**
	 * Render meta box.
	 *
	 * @param  object $post WP_Post object.
	 */
	public function render_meta_box( $post ) {
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'ahashop_sidebar_layout', 'ahashop_sidebar_layout_nonce' );

		$sidebar_layout = get_post_meta( $post->ID, '_ahashop_sidebar_layout', true );
		?>
		<p>
			<label for="ahashop-sidebar-layout"><?php esc_html_e( 'Custom sidebar layout', 'ahashop' ); ?></label>
			<select id="ahashop-sidebar-layout" name="ahashop_sidebar_layout" class="widefat">
				<option value=""><?php esc_html_e( 'Default', 'ahashop' ); ?></option>

				<?php foreach ( $this->_get_option_sidebar_layout() as $key => $value ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $sidebar_layout, $key ); ?>><?php echo esc_html( $value ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php
	}

	/**
	 * Save meta value.
	 *
	 * @param  int $post_id Post id.
	 */
	public function save_meta_box( $post_id ) {
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['ahashop_sidebar_layout_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['ahashop_sidebar_layout_nonce']; // WPCS: sanitization, csrf ok.

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'ahashop_sidebar_layout' ) ) {
			return $post_id;
		}

		/*
		 * If this is an autosave, our form has not been submitted,
		 * so we don't want to do anything.
		 */
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) { // WPCS: sanitization, csrf ok.
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		/* OK, it's safe for us to save the data now. */

		if ( isset( $_POST['ahashop_sidebar_layout'] ) ) {
			update_post_meta( $post_id, '_ahashop_sidebar_layout', sanitize_text_field( wp_unslash( $_POST['ahashop_sidebar_layout'] ) ) );
		}
	}

	/**
	 * Get option sidebar layouts.
	 *
	 * @return array
	 */
	protected function _get_option_sidebar_layout() {
		return array(
			'sidebar-right' => esc_html__( 'Sidebar right', 'ahashop' ),
			'sidebar-left'  => esc_html__( 'Sidebar left', 'ahashop' ),
			'no-sidebar'    => esc_html__( 'No sidebar', 'ahashop' ),
		);
	}

	/**
	 * Get option sidebar names.
	 *
	 * @return array
	 */
	protected function _get_option_sidebar_name() {
		global $wp_registered_sidebars;

		$option = array();

		foreach ( $wp_registered_sidebars as $sidebar ) {
			$option[ $sidebar['id'] ] = $sidebar['name'];
		}

		return $option;
	}

	/**
	 * Get sidebar layout value.
	 *
	 * @return string
	 */
	public static function get_sidebar_layout() {
		if ( is_archive() ) {
			$sidebar_layout = ahashop_option( 'sidebar_archive_layout' );
		} elseif ( is_page() ) {
			$sidebar_layout = ahashop_option( 'sidebar_page_layout' );

			$meta_value = get_post_meta( get_the_ID(), '_ahashop_sidebar_layout', true );

			if ( $meta_value ) {
				$sidebar_layout = $meta_value;
			}
		} elseif ( is_single() ) {
			$sidebar_layout = ahashop_option( 'sidebar_single_layout' );

			$meta_value = get_post_meta( get_the_ID(), '_ahashop_sidebar_layout', true );

			if ( $meta_value ) {
				$sidebar_layout = $meta_value;
			}
		} else {
			$sidebar_layout = ahashop_option( 'sidebar_layout' );
		}

		return apply_filters( 'ahashop_sidebar_layout', $sidebar_layout );
	}

	/**
	 * Check if no sidebar.
	 *
	 * @return boolean
	 * @static
	 */
	public static function is_no_sidebar() {
		return 'no-sidebar' == self::get_sidebar_layout();
	}

	/**
	 * Filter content classes.
	 *
	 * @param  array $classes Content classes.
	 * @return array
	 */
	public function layout_content_classes( $classes ) {
		$sidebar_layout = self::get_sidebar_layout();

		$classes[] = 'layout-' . $sidebar_layout;

		return $classes;
	}
}
new Ahashop_Sidebar();
