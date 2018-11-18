<?php
/**
 * Template part for topbar
 *
 * @package Ahashop
 */

?>
<div class="top-bar hidden-sm hidden-xs">
	<div class="container">
		<div class="top-bar-line">
			<div class="row">
				<div class="top-bar-links">
					<div class="col-sm-6">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'top-menu',
							'fallback_cb'    => false,
							'container'      => '',
							'menu_class'     => 'top-bar-acc',
						) );
						?>
					</div>

					<div class="col-sm-6 text-right">
						<ul class="top-bar-currency-language">
							<li>
								<?php ahashop_social_follow(); ?>
							</li>
						</ul>
					</div>

				</div>
			</div>
		</div>

	</div>
</div> <!-- end top bar -->
