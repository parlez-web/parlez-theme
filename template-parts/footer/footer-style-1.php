<?php
/*
*
* Footer Style 1 
*
* Logo + Description left + 2 Menus right
*
*/
?>
<div class="footer-container big-menu">
			<div class="footer-info">
				<?php
				$custom_logo = get_theme_mod('myboutique_footer_logo');

				if($custom_logo != '') {

					echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home"><img src="' . $custom_logo . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '"></a>';

				} else {
					
					echo '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) . '</a></p>';

				}

				
				$footer_description = get_theme_mod('myboutique_footer_description');

				if($footer_description != '') {

					echo '<p class="blog-description">' . $footer_description . '</p>';

				} else {
					
					echo '<p class="blog-description">' . get_bloginfo( 'description', 'display' ) . '</p>';
					
				}

				?>
				<p class="site-info">
					<?php
						/* translators: 1: Theme name, 2: Theme author. */
						printf( esc_html__( '%1$s by %2$s.', 'myboutique' ), '<a href="https://munichparisstudio.com" target="_blank">myboutique WordPress Theme</a>', 'MunichParis Studio' );
					?>
				</p><!-- .site-info -->
			</div>
			<div class="footer-menu">
				<?php wp_nav_menu( array(
						'theme_location' => 'footer-menu',
						'menu_id'        => 'footer-menu',
					  ) ); ?>
			</div>
		</div><!-- .footer-container -->