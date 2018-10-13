<?php
/**
 * All theme custom functions and tags (not in the framework) go in here.
 *
 * @package MP_Starter_Theme
 */

// Allow HTML tags in Widget title 
function html_widget_title( $var) {
	$var = (str_replace( '[span]', '<span>', $var ));
	$var = (str_replace( '[/span]', '</span>', $var ));
	return $var ;
		
}
add_filter( 'widget_title', 'html_widget_title' );


// Set number of posts on archive pages
function wpsites_query( $query ) {
if ( ($query->is_archive() || $query->is_search() ) && $query->is_main_query() && !is_admin() ) {
        $query->set( 'posts_per_page', 9 );
    }
}
add_action( 'pre_get_posts', 'wpsites_query' );


// Re-build posts navigation
function cosmo_posts_navigation() {
	?>
	<nav class="posts-navigation">
		<div class="nav-links">
		  <div class="nav-previous"><p>Previous Article</p><?php previous_post_link() ?></div>
		  <div class="nav-next"><p>Next Article</p><?php next_post_link() ?></div>
		</div>
	</nav>
	<?php 
}
			