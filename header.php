<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MP_Starter_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'jouy' ); ?></a>


	<header id="masthead" class="site-header">
		<div class="site-branding">
		<?php
			$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
			if( has_header_image() ) :
		?>
			<<?php echo $heading_tag; ?> class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php the_header_image_tag(); ?>
				</a>
			</<?php echo $heading_tag; ?>>
		<?php else : ?>
			<<?php echo $heading_tag; ?> class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</<?php echo $heading_tag; ?>>
			<?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
		<?php endif; 
		endif; ?>

		</div><!-- .site-branding -->

	</header><!-- #masthead -->

	<nav id="site-navigation" class="main-navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="icon-menu"></i></button>
		<div class="nav-inner">
			<div class="nav-headline">
				<i class="close icon-delete"></i>
				<?php if(get_theme_mod('jouy_mobnav_headline', 'What are you looking for?')) : ?>
					<h3><?php echo get_theme_mod('jouy_mobnav_headline', 'What are you looking for?') ?></h3>
				<?php endif; ?>
			</div>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
			?>
			<?php 
				jouy_social_media();
				get_search_form();
			?>
		</div>
	</nav><!-- #site-navigation -->


	<?php if(is_home()) {
		
		if(get_theme_mod('jouy_slider_checkbox', true) == true) {
			jouy_post_slider(4, 'home-small');
		}

		?>
		<div id="before-content-home" class="widget-area before-content-home">
			<?php dynamic_sidebar( 'before-content-home' ); ?>
		</div><!-- #before-content-home -->
	<?php 
	}
	?>

	<div id="content" class="site-content">
