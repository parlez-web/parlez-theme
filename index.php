<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */

get_header(); 

$sidebar = (get_theme_mod('myboutique_show_sidebar', 'fullwidth') == 'sidebar') ? true : false;

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			$i = 0;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				if($i == 0) {
					get_template_part( 'template-parts/content', 'home' );
				} else {
					get_template_part( 'template-parts/content', 'home-small' );
				}

				$i++;

			endwhile;

			// Older and newer posts
			myboutique_numeric_posts_nav();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->


	</div><!-- #primary -->

	<?php 

	if($sidebar) {
		get_sidebar();
	}
	

	// Close the primary/secondary container on fullwidth pages
	if(!is_home() || !is_single()) {
		echo '</div>';
	}

	
	if(is_home()) { ?>
		<div id="after-content-home" class="widget-area after-content-home">
			<?php dynamic_sidebar( 'after-content-home' ); ?>
		</div><!-- #after-content-home -->
	<?php }
	?>

<?php
get_footer();
