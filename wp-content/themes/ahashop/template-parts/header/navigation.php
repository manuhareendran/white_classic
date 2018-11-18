<?php
/**
 * Template part for header navigation
 *
 * @package Ahashop
 */

?>
<nav class="navbar navbar-static-top">
	<div class="navigation" <?php if ( ahashop_option( 'header_scroll_fixed' ) ) : ?>id="sticky-nav"<?php endif; ?>>
		<div class="container relative">

			<div class="row">
				
				<div class="header-mobile-wrapper">
					<!-- Header on Mobile -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
							<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'ahashop' ); ?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<?php
						/**
						 * Hook ahashop_navbar_button
						 *
						 * @hooked ahashop_modile_cart_icon() - 10
						 */
						do_action( 'ahashop_navbar_button' );
						?>

					</div>
					<!-- End: Header on Mobile -->

					<!-- Header on Destop -->
					<div class="header-wrap">
						<div class="header-wrap-holder">

							<?php
							/**
							 * Hook ahashop_before_navbar_logo
							 *
							 * @hooked ahashop_header_search() - 10
							 */
							do_action( 'ahashop_before_navbar_logo' );
							?>

							<!-- Logo -->
							<div class="logo-container">
								<div class="logo-wrap text-center">
									<?php ahashop_logo(); ?>
								</div>
							</div>

							<?php
							/**
							 * Hook ahashop_after_navbar_logo
							 *
							 * @hooked ahashop_header_mini_cart() - 10
							 */
							do_action( 'ahashop_after_navbar_logo' );
							?>

						</div>
					</div>
					<!-- End: Header on Destop -->
				</div>


				<!-- Navigation / Menu  -->
				<div class="nav-wrap">
					<div class="collapse navbar-collapse" id="navbar-collapse">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'container'      => '',
							'menu_class'     => 'nav navbar-nav',
							'walker'         => new Ahashop_Primary_Menu_Walker(),
							'fallback_cb'    => false,
							'items_wrap'     => ahashop_primary_menu_items_wrap(),
						) );
						?>
					</div>
				</div>
				<!-- End: Navigation / Menu  -->

			</div> <!-- end row -->
		</div> <!-- end container -->
	</div> <!-- end navigation -->
</nav> <!-- end navbar -->
