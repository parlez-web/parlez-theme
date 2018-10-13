<?php 
if ( ! function_exists( 'cosmo_featured_row' ) ) :
	/**
	 * Shows a number of featured posts with thumbnail in a row.
	 * 
	 * @param $ppp: Number of posts to show
	 * @param $template: Content template to use
	 */
	function cosmo_featured_row($template, $ppp, $cat) {

		$featured_args = array('post_type' => 'post', 'posts_per_page' => $ppp, 'orderby'=> 'ASC', 'category_name' => $cat); //WP Query for Featured Posts on top 
		?>

		<section class="featured-row">
      
	        <?php
	        /* 
	        * Invoke a custom WP-query
	        */
	        cosmo_custom_query($featured_args, $template);
	        ?>

	    </section>

	    <?php
    }
endif;


