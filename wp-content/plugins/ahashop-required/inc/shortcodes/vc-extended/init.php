<?php
/*
Plugin Name: Extended Visual Composer by VCExtended
Description: Description
Plugin URI: http://#
Author: Author
Author URI: http://#
Version: 1.0
License: GPL2
Text Domain: vc_extended
Domain Path: Domain Path
*/

if ( defined( 'VC_EXTENDED_URL' ) ) {
	return;
}

define( 'VC_EXTENDED_URL', plugin_dir_url( __FILE__ ) );
define( 'VC_EXTENDED_PATH', plugin_dir_path( __FILE__ ) );

if ( ! class_exists( 'VC_Extended_Loader' ) ) :

	/**
	 * The VC_Extended_Loader class.
	 */
	final class VC_Extended_Loader {
		/**
		 * Instance implements.
		 *
		 * @var VC_Extended_Loader
		 */
		private static $instance;

		/**
		 * Alias of static::get_instance().
		 *
		 * @return VC_Extended_Loader
		 */
		public static function init() {
			return static::get_instance();
		}

		/**
		 * Instance the class.
		 *
		 * @return VC_Extended_Loader
		 */
		public final static function get_instance() {
			if ( null === static::$instance ) {
				static::$instance = new static;
			}

			return static::$instance;
		}

		private function __construct() {
			require VC_EXTENDED_PATH . '/inc/utils.php';
			require_once 'inc/class-vc-extended-utils.php';
			require_once 'inc/class-vc-extended-animate-core.php';

			add_action( 'vc_after_init', array( $this, 'register_shortcode' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}

		public function register_shortcode() {

			require_once 'inc/class-vc-extended-snippets.php';
			require_once 'inc/class-wpbakeryshortcode-extended.php';
			require_once 'inc/class-vc-extended-param-abstract.php';
			require_once 'inc/class-vc-extended-row-overlay.php';

			$paths = glob( VC_EXTENDED_PATH . '/inc/{shortcodes,params}/min-*.php', GLOB_BRACE | GLOB_NOSORT );

			foreach ( $paths as $path ) {
				if ( false === strpos( basename( $path ),  'min-' ) ) {
					continue;
				}

				require_once $path;
			}

			// require_once 'test.php';
		}

		public function enqueue_scripts() {
			wp_enqueue_style( 'extras-vc', VC_EXTENDED_URL . '/css/vc-extended.css' );
		}

		public function admin_enqueue_scripts() {
			wp_enqueue_style( 'extras-vc-admin', VC_EXTENDED_URL . '/css/admin.css' );
			wp_enqueue_style( 'hint.css', VC_EXTENDED_URL . 'css/vendor/hint.css', array(), '2.3.2' );
		}
	}
endif;

VC_Extended_Loader::init();
