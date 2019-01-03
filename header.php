<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package My_Boutique_Theme
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
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'myboutique' ); ?></a>

	<?php get_template_part( 'template-parts/header/header', 'style-1' ); ?>

	<?php if(is_home()) {

		$featured_layout = get_theme_mod('myboutique_featured_layout', 'slider-fullwidth');
		
		if($featured_layout == 'slider_fullwidth' || $featured_layout == 'slider_contentwidth' || $featured_layout == 'slider_overlay') {
			//myboutique_featured_row('featured', 4, 'featured', 'top');
			myboutique_post_slider(4, 'featured');
		} else if($featured_layout == 'slider_centered') {
			myboutique_centered_slider(4, 'featured');
		}

		?>
		<div id="before-content-home" class="widget-area before-content-home">
			<?php dynamic_sidebar( 'before-content-home' ); ?>
		</div><!-- #before-content-home -->
	<?php 
	}


	$sidebar = (get_theme_mod('myboutique_show_sidebar', 'fullwidth') == 'sidebar') ? true : false;

	$sidebar_class = ($sidebar) ? 'has-sidebar' : '';
	?>

	<div id="content" class="site-content small-width <?php echo $sidebar_class ?>">
