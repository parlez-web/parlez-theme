<?php
/**
 * Template part for Navigation/Header Style 1
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */
?>

<?php //parlez_popup_search(); ?>

<div class="top-container">

	<!-- Site Header -->
	<?php get_template_part( 'template-parts/header/site', 'title' ); ?>

	<!-- Mobile Navigation -->
	<?php get_template_part( 'template-parts/header/mobile', 'nav' ); ?>

	<!-- Main Navigation -->
	<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
	<nav id="site-navigation" class="main-navigation">
		<div class="menu-container fullwidth">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'primary-menu',
					'menu_id'        => 'primary-menu',
				) );	
			?>
		</div>
	</nav>
	<?php endif; ?>

</div>
