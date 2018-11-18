<?php
/**
 * Plugin Name: Ahashop required
 * Description: Required plugin for Ahashop theme.
 * Plugin URI: https://minwp.com/themes/ahashop
 * Author: minWP
 * Author URI: https://minwp.com/themes/ahashop
 * Version: 1.2
 * License: GPL2
 * Text Domain: ahashop-required
 * Domain Path: /languages
 *
 * @package Ahashop
 */

/*
Copyright (C) 2017  MinwpTeam  minwpteam@gmail.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( defined( 'AHASHOP_REQUIRED_VERSION' ) ) {
	return;
}

define( 'AHASHOP_REQUIRED_VERSION', '1.0.1' );
define( 'AHASHOP_REQUIRED_FILE', __FILE__ );
define( 'AHASHOP_REQUIRED_PATH', plugin_dir_path( AHASHOP_REQUIRED_FILE ) );
define( 'AHASHOP_REQUIRED_URL', plugin_dir_url( AHASHOP_REQUIRED_FILE ) );

/**
 * Class Ahashop_Required
 */
class Ahashop_Required {

	/**
	 * Class Ahashop_Required construct.
	 */
	public function __construct() {
		$this->includes();
	}

	/**
	 * Includes functions.
	 */
	public function includes() {
		require_once AHASHOP_REQUIRED_PATH . 'inc/social/social.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/shortcodes/shortcodes.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/mega-menu/mega-menu.php';
		require_once AHASHOP_REQUIRED_PATH . 'inc/dummy-data.php';
	}
}
new Ahashop_Required();
