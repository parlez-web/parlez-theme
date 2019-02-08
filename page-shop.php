<?php
/**
 * Template Name: Shopping
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area small-width">
		<main id="main" class="site-main">

			<div class="shopping-menu">
				<?php 
				if ( is_page() && $post->post_parent )    
			        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' .$post->post_parent . '&echo=0' );
			    else
			        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );

			    if ( $childpages ) {    
			        echo '<div class="cat-menu"><ul><li>' . $childpages . '</li></ul></div>';
			    }
				?>
			</div>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div>
<?php

get_footer();
