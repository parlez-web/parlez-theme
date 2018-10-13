<?php
/*
* Slick slider that shows featured posts from category 'featured'.
*
*/
if ( ! function_exists( 'cosmo_post_slider' ) ) :
	/**
	 * Show a featured post slider
   *
   * @param $ppp: Number of posts to show
   * @param $template: Content template to use
   *
	 */
	function cosmo_post_slider($ppp, $template) {

      if(get_theme_mod('cosmo_slider_type', 'latest') == 'latest') {
        $cat_name = '';
      } else {
        $cat_name = 'featured';
      }

    	$loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $ppp, 'orderby'=> 'ASC', 'category_name' => $cat_name));  
        
      if( $loop->have_posts() ) { ?>
        <div class="slick">
          <?php while ( $loop->have_posts() ) : $loop->the_post(); 
            get_template_part( 'template-parts/content', $template );
          endwhile; 
          ?>
    		</div> <!-- End the Slick Carousel div -->
    <?php } 
   }
endif;