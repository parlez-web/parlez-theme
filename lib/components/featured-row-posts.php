<?php 
if ( ! function_exists( 'parlez_featured_row' ) ) :
	/**
	 * Shows a number of featured posts with thumbnail in a row.
	 * 
	 * @param $ppp: Number of posts to show
	 * @param $template: Content template to use
	 */
	function parlez_featured_row($template, $ppp, $cat, $classname) {

		$featured_args = array('post_type' => 'post', 'posts_per_page' => $ppp, 'orderby'=> 'ASC', 'category_name' => $cat); //WP Query for Featured Posts on top 
		?>

		<section class="featured-row <?php echo $classname ?>">
      
	        <?php
	        /* 
	        * Invoke a custom WP-query
	        */
	        parlez_custom_query($featured_args, $template);
	        ?>

	    </section>

	    <?php
    }
endif;


