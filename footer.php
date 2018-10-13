<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MP_Starter_Theme
 */

?>
	<div class="before-footer">
		<?php dynamic_sidebar( 'before-footer' ); ?> 
	</div>

	<footer id="colophon" class="site-footer light-bg">
		<div class="footer-widget-area">
			<?php dynamic_sidebar( 'footer-widgets' ); ?> 
		</div>
		<div class="footer-menu">
			<?php wp_nav_menu( array(
					'theme_location' => 'footer-menu',
					'menu_id'        => 'footer-menu',
				  ) ); ?>
		</div>
		<div class="site-info">
			<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html( 'Copyright '. date("Y") . '. %s'), get_bloginfo('name') );
			?>
			<p>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( '%1$s by %2$s.', 'cosmo' ), 'cosmo Theme', '<a href="https://munichparisstudio.com" target="_blank">MunichParis Studio</a>' );
			?>
			</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
