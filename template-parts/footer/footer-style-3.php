<?php
/*
*
* Footer Style 3
*
* Big Logo + Menu
*
*/
?>
<div class="footer-container big-logo">

	<div class="footer-logo">
		<?php
				$custom_logo = get_theme_mod('myboutique_footer_logo');

				if($custom_logo != '') {

					echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home"><img src="' . $custom_logo . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '"></a>';

				} else {
					
					echo '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) . '</a></p>';

				}
		?>
	</div>

	<div class="footer-menu">
		<?php wp_nav_menu( array(
			'theme_location' => 'footer-menu',
			'menu_id'        => 'footer-menu',
			) ); ?>
	</div>

	<div class="footer-info">
		<p class="site-info">
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( '%1$s by %2$s.', 'myboutique' ), '<a href="https://munichparisstudio.com" target="_blank">myboutique WordPress Theme</a>', 'My Boutique Themes' );
			?>
		</p><!-- .site-info -->
	</div>
			
</div><!-- .footer-container -->