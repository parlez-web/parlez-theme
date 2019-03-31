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
		$custom_logo = get_theme_mod('parlez_footer_logo');

		if($custom_logo != '') {

			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home"><img src="' . $custom_logo . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '"></a>';

		} else {
					
			echo '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) . '</a></p>';

		}

				
		$footer_description = get_theme_mod('parlez_footer_description');

		if($footer_description != '') {

			echo '<p class="blog-description">' . $footer_description . '</p>';

		} else {
					
			echo '<p class="blog-description">' . get_bloginfo( 'description', 'display' ) . '</p>';
					
		}

		?>
		<p class="site-info">
			<?php
				parlez_social_media();
			?>
		</p><!-- .site-info -->
	</div>
			
	<div class="footer-areas">
		<?php dynamic_sidebar( 'footer-1' ); ?>
		<?php dynamic_sidebar( 'footer-2' ); ?>
		<?php dynamic_sidebar( 'footer-3' ); ?>
	</div>
</div><!-- .footer-container -->