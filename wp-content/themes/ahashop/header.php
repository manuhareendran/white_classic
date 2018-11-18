<?php
/**
 * Site header template
 *
 * @package Ahashop
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- <meta name="description" content="helps you build online clothing store with WordPress"> -->
	<!-- <meta name="keywords" content="online,shop,store,wordpress"> -->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-offset="60" data-target=".navbar">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ahashop' ); ?></a>

	<main class="content-wrapper oh">

		<?php do_action( 'ahashop_site_wrapper_begin' ); ?>

		<!-- Navigation -->
		<header class="nav-type-1">

			<?php ahashop_top_bar(); ?>

			<?php get_template_part( 'template-parts/header/navigation' ); ?>

		</header> <!-- end navigation -->

		<?php
		/**
		 * Hook ahashop_after_header
		 *
		 * @hooked ahashop_breadcrumb() - 10
		 */
		do_action( 'ahashop_after_header' );
		?>

		<?php if ( ! is_404() ) : ?>
			<!-- Blog Standard -->
			<section class="<?php echo esc_attr( ahashop_get_content_classes() ); ?>" id="content">
				<div class="container relative">
					<div class="row">
		<?php endif; ?>
