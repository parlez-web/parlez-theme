<?php

/*
* Enqueue necessary scripts.
*/
function enqueue_genre_ajax_scripts() {
    wp_localize_script( 'myboutique-custom', 'ajaxpagination', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	));
}
add_action('wp_enqueue_scripts', 'enqueue_genre_ajax_scripts');


/*
* Require necessary customizer functionality.
*/
require_once( get_template_directory() . '/lib/customizer/customizer-ajax-categories.php' );


/* 
* AJAX Loading for Category Posts on Homepage
*/
add_action('wp_ajax_nopriv_myboutique_category_post_ajax', 'myboutique_load_ajax_category');
add_action('wp_ajax_myboutique_category_post_ajax', 'myboutique_load_ajax_category');
 
if (!function_exists('myboutique_load_ajax_category')) {
	function myboutique_load_ajax_category(){ 

   		$post_cat = sanitize_text_field($_POST['cat']);
 
	    $cat = (isset($_POST['cat'])) ? $_POST['cat'] : 0;
 
	    $args = array(
	        'post_type'   => 'post',
	        'cat' 		  => $cat,
	        'post_status' => 'publish',
	        'posts_per_page' => 3
	    );
 
	    $cat_loop = new WP_Query($args);
	    ?>
	    <h3><?php echo get_cat_name($cat) ?></h3>
	    <?php
	    if ($cat_loop -> have_posts()) :
	    	while ($cat_loop -> have_posts()) : $cat_loop -> the_post();

				get_template_part( 'template-parts/content-home', get_post_format() );
				
	    	endwhile;
	    else: 
	    	echo 'Could not be found';
	    endif;
 
	    wp_reset_postdata();
 
	    wp_die();

	}
}


if ( ! function_exists( 'myboutique_ajax_categories' ) ) :
	/**
	 * Shows posts from different categories by ajax
	 * 
	 * @param $ppp: Posts per page
	 * @param $template: Content template to use
	 */
	function myboutique_ajax_categories($template, $ppp) {

		$first_cat = get_theme_mod('myboutique_ajax_first_cat');
		$first_cat_name = get_cat_name($first_cat);
		$second_cat = get_theme_mod('myboutique_ajax_second_cat');
		$second_cat_name = get_cat_name($second_cat);
		$third_cat = get_theme_mod('myboutique_ajax_third_cat');
		$third_cat_name = get_cat_name($third_cat);

		?>
		<div class="category-thumbnails">
			<div id="category-filter">
				<button class="btn" data-category="<?php echo $first_cat ?>"><?php echo $first_cat_name ?></button>
				<button class="btn" data-category="<?php echo $second_cat ?>"><?php echo $second_cat_name ?></button>
				<button class="btn" data-category="<?php echo $third_cat ?>"><?php echo $third_cat_name ?></button>
			</div>
			<?php

			$ajax_category_args = array(
			    'posts_per_page' => $ppp,
			    'cat' => get_theme_mod('myboutique_ajax_first_cat'),
			    'order'=> 'DESC'
			);
			  
			$ajax_category_loop = new WP_Query( $ajax_category_args ); ?>

			<h3 class="ajax-cat-name"><?php echo $first_cat_name ?></h3>
			
			<div class="category-posts">
				<?php  
				while( $ajax_category_loop->have_posts() ): $ajax_category_loop->the_post();
				    get_template_part( 'template-parts/content', $template );
				endwhile;
				wp_reset_query();
			?></div>
		</div>
	<?php
	}
endif;
