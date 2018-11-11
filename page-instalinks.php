<?php
/**
 *
 * Template Name: InstaLinks
 *
 * The template for displaying the insta links
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<?php
				wp_nav_menu( array(
					'theme_location' => 'insta-links',
					'menu_id'        => 'insta-links',
				) );
			?>
	</div><!-- #primary -->

<?php
get_footer();
