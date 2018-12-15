<?php
/*
*
* Footer Style 2
*
* Minimal Menu + Copyright
*
*/
?>
<div class="footer-container minimal-menu">

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
			printf( esc_html__( '%1$s by %2$s.', 'myboutique' ), '<a href="https://munichparisstudio.com" target="_blank">myboutique WordPress Theme</a>', 'MunichParis Studio' );
			?>
		</p><!-- .site-info -->
	</div>
			
</div><!-- .footer-container -->