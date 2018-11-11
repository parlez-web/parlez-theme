<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package MP_Starter_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			cosmo_posts_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php 
	$sidebar = (get_theme_mod('cosmo_show_sidebar', 'fullwidth') == 'sidebar') ? true : false;
	
	if($sidebar) {
		get_sidebar();
	}
	?>

	<?php
	if( get_theme_mod('cosmo_related_checkbox', true) == true) {
		if ( get_theme_mod('cosmo_related_type', 'categories') == 'categories' ) {
			cosmo_related_posts_categories();
		}
		else {
			cosmo_related_posts_tags();
		}
	}
	

	// Single Post and Page Widget
	?>
	<div id="after-single-post" class="widget-area single-post-widgets">
		<?php dynamic_sidebar( 'single-post-widgets' ); ?>
	</div><!-- #after-single-post -->

<?php
get_footer();
