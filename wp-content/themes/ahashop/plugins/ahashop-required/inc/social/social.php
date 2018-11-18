<?php
/**
 * Social network module
 *
 * @package Ahashop
 */

/**
 * Class Ahashop_Social
 */
class Ahashop_Social {

	/**
	 * Class Ahashop_Social construct.
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	/**
	 * Register blog settings.
	 *
	 * @param  WP_Customize $wp_customize WP_Customize object.
	 */
	public function customize_register( $wp_customize ) {
		$wp_customize->add_panel( 'social', array(
			'title'       => __( 'Social network', 'ahashop' ),
			'priority'    => apply_filters( 'ahashop_social_panel_priority', 80 ),
		) );

		$wp_customize->add_section( 'social_follow', array(
			'title'       => __( 'Social follow', 'ahashop' ),
			'panel'       => 'social',
		) );

		$socials = self::get_socials();
		foreach ( $socials as $name => $data ) {
			$wp_customize->add_setting( 'social_follow[' . $name . ']', array(
				'sanitize_callback' => 'esc_url',
				'transport'         => 'refresh',
			) );

			$wp_customize->add_control( 'social_follow[' . $name . ']', array(
				'label'       => $data['name'],
				'section'     => 'social_follow',
				'type'        => 'text',
			) );
		}

		$wp_customize->add_section( 'social_sharing', array(
			'title'       => __( 'Social sharing', 'ahashop' ),
			'panel'       => 'social',
			'description' => __( 'Enable social network for sharing', 'ahashop' ),
		) );

		$not_sharing = apply_filters( 'ahashop_socials_not_for_sharing', array(
			'wordpress',
			'behance',
			'instagram',
		) );

		foreach ( $socials as $name => $data ) {
			if ( in_array( $name, $not_sharing ) ) {
				continue;
			}

			$wp_customize->add_setting( 'social_sharing[' . $name . ']', array(
				'sanitize_callback' => 'absint',
				'transport'         => 'refresh',
			) );

			$wp_customize->add_control( 'social_sharing[' . $name . ']', array(
				'label'       => $data['name'],
				'section'     => 'social_sharing',
				'type'        => 'checkbox',
			) );
		}
	}

	/**
	 * Get social list.
	 *
	 * @return array
	 */
	public static function get_socials() {
		return apply_filters( 'ahashop_socials', array(
			'behance' => array(
				'name' => __( 'Behance', 'ahashop' ),
				'icon' => 'fa fa-behance',
			),
			'digg' => array(
				'name' => __( 'Digg', 'ahashop' ),
				'icon' => 'fa fa-digg',
			),
			'facebook' => array(
				'name' => __( 'Facebook', 'ahashop' ),
				'icon' => 'fa fa-facebook',
			),
			'google' => array(
				'name' => __( 'Google+', 'ahashop' ),
				'icon' => 'fa fa-google',
			),
			'instagram' => array(
				'name' => __( 'Instagram', 'ahashop' ),
				'icon' => 'fa fa-instagram',
			),
			'linkedin' => array(
				'name' => __( 'LinkedIn', 'ahashop' ),
				'icon' => 'fa fa-linkedin',
			),
			'pinterest' => array(
				'name' => __( 'Pinterest', 'ahashop' ),
				'icon' => 'fa fa-pinterest',
			),
			'tumblr' => array(
				'name' => __( 'Tumblr', 'ahashop' ),
				'icon' => 'fa fa-tumblr',
			),
			'twitter' => array(
				'name' => __( 'Twitter', 'ahashop' ),
				'icon' => 'fa fa-twitter',
			),
			'wordpress' => array(
				'name' => __( 'WordPress', 'ahashop' ),
				'icon' => 'fa fa-wordpress',
			),
		) );
	}
}
new Ahashop_Social();

/**
 * Display socials list.
 *
 * @param  array $data Array with key is social name and value is social url.
 */
function ahashop_socials_list( $data = null ) {
	if ( ! $data ) {
		$data = get_theme_mod( 'social_follow', array() );
	}

	if ( ! $data ) {
		return;
	}

	$socials = Ahashop_Social::get_socials();

	?>
	<ul class="social-list">
		<?php foreach ( $data as $name => $url ) :
			if ( ! $url ) {
				continue;
			}

			if ( ! isset( $socials[ $name ] ) ) {
				continue;
			}
			?>
			<li><a href="<?php echo esc_url( $url ); ?>" class="social-list__item_link"><i class="icon <?php echo esc_attr( $socials[ $name ]['icon'] ); ?>"></i></a></li>
		<?php endforeach; ?>
	</ul>
	<?php
}

/**
 * Get facebook sharing url.
 *
 * @param  string $url   Content url.
 * @param  string $title Title.
 * @return string
 */
function ahashop_get_sharing_url_facebook( $url, $title = null, $media = null ) {
	return esc_url( sprintf(
		'https://www.facebook.com/sharer.php?u=&1$s&title=%2$s',
		$url,
		esc_attr( $title )
	) );
}

/**
 * Get digg sharing url.
 *
 * @param  string $url   Content url.
 * @param  string $title Title.
 * @return string
 */
function ahashop_get_sharing_url_digg( $url, $title = null, $media = null ) {
	return esc_url( sprintf(
		'http://digg.com/submit?url=%1$s&title=%2$s',
		$url,
		esc_attr( $title )
	) );
}

/**
 * Get twitter sharing url.
 *
 * @param  string $url   Content url.
 * @param  string $title Title.
 * @return string
 */
function ahashop_get_sharing_url_twitter( $url, $title = null, $media = null ) {
	return esc_url( sprintf(
		'https://twitter.com/intent/tweet?url=%1$s&text=%2$s',
		$url,
		esc_attr( $title )
	) );
}

/**
 * Get linkedin sharing url.
 *
 * @param  string $url   Content url.
 * @param  string $title Title.
 * @return string
 */
function ahashop_get_sharing_url_linkedin( $url, $title = null, $media = null ) {
	return esc_url( sprintf(
		'https://www.linkedin.com/shareArticle?url=%1$s&title=%2$s',
		$url,
		esc_attr( $title )
	) );
}

/**
 * Get google sharing url.
 *
 * @param  string $url   Content url.
 * @param  string $title Title.
 * @return string
 */
function ahashop_get_sharing_url_google( $url, $title = null, $media = null ) {
	return esc_url( sprintf(
		'https://plus.google.com/share?url=%s',
		$url
	) );
}

/**
 * Get pinterest sharing url.
 *
 * @param  string $url   Content url.
 * @param  string $title Title.
 * @return string
 */
function ahashop_get_sharing_url_pinterest( $url, $title = null, $media = null ) {
	return esc_url( sprintf(
		'http://pinterest.com/pin/create/button/?url=%1$s&description=%2$s&media=%3$s',
		$url,
		$title,
		$media
	) );
}

/**
 * Get tumblr sharing url.
 *
 * @param  string $url   Content url.
 * @param  string $title Title.
 * @return string
 */
function ahashop_get_sharing_url_tumblr( $url, $title = null, $media = null ) {
	return esc_url( sprintf(
		'http://www.tumblr.com/share/link?url=%1$s&name=%2$s&description=',
		$url,
		$title
	) );
}
