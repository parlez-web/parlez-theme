<?php
/*
* Popular Posts
* 
* Shows the most popular posts by visitors count and can be styled accordingly.
*
*/
if ( ! function_exists( 'parlez_popular_posts' ) ) :
	/**
	 * Shows most popular posts by views
	 * 
	 * @param $templates: Content template
	 * @param $ppp: Posts per page
	 */
	function parlez_popular_posts($template, $ppp, $classname = '') {

		$popular_posts_args = array(
		    'posts_per_page' => $ppp,
		    'meta_key' => 'parlez_post_viewed',
		    'orderby' => 'meta_value_num',
		    'order'=> 'DESC'
		);
		  
		$popular_posts_loop = new WP_Query( $popular_posts_args ); ?>
		
		<div class="popular-posts <?php echo $classname ?>">
			
			<?php  
			while( $popular_posts_loop->have_posts() ): $popular_posts_loop->the_post();
			    get_template_part( 'template-parts/content/content', $template );
			endwhile;
			wp_reset_query(); ?>

		</div>
		<?php
	}
endif;


if ( ! function_exists( 'parlez_count_post_visits' ) ) :
//* Function that counts post visits - needed for the popular posts widget
function parlez_count_post_visits() {
    if( is_single() ) {
        global $post;
        $views = get_post_meta( $post->ID, 'parlez_post_viewed', true );
        if( $views == '' ) {
            update_post_meta( $post->ID, 'parlez_post_viewed', '1' );   
        } else {
            $views_no = intval( $views );
            update_post_meta( $post->ID, 'parlez_post_viewed', ++$views_no );
        }
    }
}
add_action( 'wp_head', 'parlez_count_post_visits' );
endif;