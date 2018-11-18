<?php
/**
 * Template Name: Page builder
 * Template Post Type: page
 *
 * @package Ahashop
 */

get_header( 'page-builder' );

	if ( have_posts() ) :

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			the_content();

		endwhile;

	endif;

get_footer( 'page-builder' );
