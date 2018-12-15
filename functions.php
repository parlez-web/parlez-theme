<?php
/**
 * myboutique Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package myboutique_Theme
 */


/* 
* Launch the Fox framework.
*/
require_once( get_template_directory() . '/lib/fox.php' );
new Fox();


if ( ! function_exists( 'myboutique_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function myboutique_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Boutique Starter Theme, use a find and replace
		 * to change 'myboutique' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'myboutique', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary Menu', 'myboutique' ),
			'secondary-menu' => esc_html__( 'Secondary Menu', 'myboutique' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'myboutique' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'myboutique_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );


		/**
		 * Add support for custom images sizes.
		 */
		add_image_size( 'slider', 0, 500, true );
		add_image_size( 'large-home', 800, 800, true );

		/*
		* Add Theme Support calls from the Fox Framework.
		*/
		// Popular Posts: myboutique_popular_posts()
		add_theme_support('popular-posts');

		// Featured Posts in a row: myboutique_featured_row()
		add_theme_support('featured-row-posts');

		// Featured Posts in slick slider: myboutique_post_slider()
		add_theme_support('featured-slick-slider');

		// Youtube Recent Videos Widget
		add_theme_support('youtube-widget');

		// Profile Widget
		add_theme_support('profile-widget');

		// Posts Widget
		add_theme_support('post-preview-widget');

		// Thumbnails Widget
		add_theme_support('thumbnails-widget');


		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
		 */
		add_editor_style( 'assets/css/editor-styles.css' );

		// Woocommerce Support
		add_theme_support( 'woocommerce' );
	}
endif;
add_action( 'after_setup_theme', 'myboutique_setup', 5 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function myboutique_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'myboutique_content_width', 640 );
}
add_action( 'after_setup_theme', 'myboutique_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function myboutique_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'myboutique' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'myboutique' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Before Content', 'myboutique' ),
		'id'            => 'before-content-home',
		'description'   => esc_html__( 'Widget Area before main content that shows only on the homepage.', 'myboutique' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>'
	) );


	register_sidebar( array(
		'name'          => esc_html__( 'Homepage After Content', 'myboutique' ),
		'id'            => 'after-content-home',
		'description'   => esc_html__( 'Widget Area after main content that shows only on the homepage.', 'myboutique' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>'
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Instagram Area', 'myboutique' ),
		'id'            => 'before-footer',
		'description'   => esc_html__( 'The widget area to add an Instagram feed right above the footer.', 'myboutique' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>'
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'After Single Post Area', 'myboutique' ),
		'id'            => 'single-post-widgets',
		'description'   => esc_html__( 'Insert Widgets specifially after single posts, right before the footer.', 'myboutique' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>'
	) );
}
add_action( 'widgets_init', 'myboutique_widgets_init' );


/*
* Theme Update Checker
*/
require get_template_directory() . '/plugin-update-checker-4.4/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
  'http://themes.munichparisstudio.com/server/?action=get_metadata&slug=myboutique',
  __FILE__,
  'myboutique'
);


/**
 * Enqueue scripts and styles.
 */
function myboutique_scripts() {
	wp_enqueue_style( 'myboutique-style', get_stylesheet_uri() );
	// Enqueue customizer color css
	$custom_css = myboutique_get_customizer_css();
  	wp_add_inline_style( 'myboutique-style', $custom_css );

	//Enqueue custom minified and concatenated js
	wp_enqueue_script( 'myboutique-custom-slick-min', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '', true );
	
	wp_enqueue_script( 'myboutique-custom', get_template_directory_uri() . '/js/custom.min.js', array('jquery'), '', true );
	
	wp_enqueue_style( 'myboutique-slick-style', get_template_directory_uri() . '/assets/css/slick.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


}
add_action( 'wp_enqueue_scripts', 'myboutique_scripts' );


/**
* Change the Archive Title 
*/
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    }
    return $title;
});


/*
* Generate the color scheme from the Customizer
*/
function myboutique_get_customizer_css() {
    ob_start();

    $bg_color = get_theme_mod( 'secondary_color', '#faf1ed' );
    $accent_color = get_theme_mod( 'accent_color', '#ddaba8' );
    $navfooter_bg_color = get_theme_mod( 'myboutique_footer_bg', '#111111' );
    $navfooter_color = get_theme_mod( 'myboutique_footer_font_color', '#ffffff' );

    $navfooter_shade = ($navfooter_color == 'dark') ? '#0c0c0c' : '#ffffff';


    if ( ! empty( $bg_color ) || ! empty( $accent_color ) || ! empty($navfooter_color) || ! empty($navfooter_bg_color) ) {
      ?>
      .light-bg, .widget_yikes_easy_mc_widget {
        background-color: <?php echo sanitize_hex_color($bg_color); ?>;
      }
      .main-navigation.fixed, footer.site-footer, .main-navigation:not(.toggled) ul .sub-menu {
      	background-color: <?php echo sanitize_hex_color($navfooter_bg_color); ?>;
  	  }
  	  .main-navigation.fixed a, .main-navigation:not(.toggled) .sub-menu a, .main-navigation.fixed li a, .site-header a, .main-navigation.fixed .social-media-icons a, .main-navigation.fixed .searchform, .footer-info, .footer-info a, .footer-menu a, .footer-container .footer-info p.site-title a  {
  	  	color: <?php echo sanitize_hex_color($navfooter_shade); ?>;
  	  }
      button, input[type="submit"], .widget_yikes_easy_mc_widget form .yikes-easy-mc-submit-button:hover {
      	background-color: <?php echo sanitize_hex_color($accent_color); ?>;
  	  }
  	  article.slick-slide .entry-body .readmore .btn.read-more:hover {
  	  	background-color: <?php echo sanitize_hex_color($accent_color);?>!important;
  	  }
  	  .youtube-gallery .youtube-thumb::after, .social-media-icons a:hover, .cat-links a:hover, .site-info p a:hover, .site-main article.small .entry-body .entry-content button:hover, .nav-links a:hover {
      	color: <?php echo sanitize_hex_color($accent_color); ?>;
  	  }
  	  .single .entry-content a {
		color: <?php echo sanitize_hex_color($accent_color); ?>;
		border-bottom: 1px solid <?php echo sanitize_hex_color($accent_color); ?>;
	  }
      <?php
    }

    $css = ob_get_clean();
    return $css;
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/lib/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/lib/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/lib/template-functions.php';

/**
 * Plugin activation of required and recommended plugins.
 */
require get_template_directory() . '/lib/plugin-activation.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/lib/customizer/customizer-custom-classes.php';
require get_template_directory() . '/lib/customizer/customizer-settings.php';

/**
 * Theme tags.
 */
require get_template_directory() . '/inc/theme-tags.php';


