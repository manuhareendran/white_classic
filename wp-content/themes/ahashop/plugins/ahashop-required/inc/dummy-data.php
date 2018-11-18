<?php
/**
 * Dummy data register
 *
 * @package Ahashop
 */

/**
 * Register import data.
 *
 * @return array
 */
function ahashop_import_files() {
	return array(
		array(
			'import_file_name'             => 'Default',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'dummy-data/default/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'dummy-data/default/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'dummy-data/default/customizer.dat',
			'import_preview_image_url'     => trailingslashit( get_template_directory() ) . 'dummy-data/default/screenshot.png',
			'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'ahashop' ),
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'ahashop_import_files' );

/**
 * Runs after importing.
 * Set menu location, home page,...
 *
 * @param array $selected_import Selected import file.
 */
function ahashop_after_import( $selected_import ) {
	if ( 'Default' === $selected_import['import_file_name'] ) {
		// Set Menu.
		$main_menu = get_term_by( 'name', 'Main menu', 'nav_menu' );
		$top_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations' , array(
			'primary'     => $main_menu->term_id,
			'top-menu'    => $top_menu->term_id,
		) );

		// Set Front page.
		$home = get_page_by_title( 'Home' );
		$blog = get_page_by_title( 'Blog' );
		if ( isset( $home->ID ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home->ID );
		}

		if ( isset( $blog->ID ) ) {
			update_option( 'page_for_posts', $blog->ID );
		}

		// Set widget nav menu.
		$footer_information = get_term_by( 'name', 'Footer Information', 'nav_menu' );
		$footer_account = get_term_by( 'name', 'Footer Account', 'nav_menu' );
		$footer_help = get_term_by( 'name', 'Footer Help', 'nav_menu' );

		$widget_nav_menus = get_option( 'widget_nav_menu' );

		$widget_nav_menus[1]['nav_menu'] = $footer_information->term_id;
		$widget_nav_menus[2]['nav_menu'] = $footer_help->term_id;
		$widget_nav_menus[3]['nav_menu'] = $footer_account->term_id;

		update_option( 'widget_nav_menu', $widget_nav_menus );
	}
}
add_action( 'pt-ocdi/after_import', 'ahashop_after_import' );

/**
 * Use placeholder image instead of original image.
 *
 * @param  array $data Import post data.
 * @return array
 */
function ahashop_use_placeholder_image( $data ) {
	// If post type is attachment and have attachment url.
	if ( 'attachment' === $data['post_type'] && ! empty( $data['attachment_url'] ) ) {
		// Check if attachment is image.
		$pathinfo = pathinfo( $data['attachment_url'] );

		if ( ! empty( $pathinfo['extension'] ) && in_array( $pathinfo['extension'], array( 'png', 'jpg', 'gif', 'jpeg' ) ) ) {
			$data['attachment_url'] = get_template_directory_uri() . '/dummy-data/placeholder-img.jpg';
		}
	}

	return $data;
}
add_filter( 'wxr_importer.pre_process.post', 'ahashop_use_placeholder_image' );
