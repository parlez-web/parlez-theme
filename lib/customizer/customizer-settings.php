<?php
/**
 * cosmo Theme Customizer
 *
 * @package cosmo
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cosmo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'cosmo_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cosmo_customize_preview_js() {
	wp_enqueue_script( 'cosmo_customizer', get_template_directory_uri() . '/js/customizer/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'cosmo_customize_preview_js' );


/**
* Register Theme Options Panel.
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function cosmo_customizer_panel_register( $wp_customize ) {
$current_theme = wp_get_theme();

$wp_customize->add_panel( 'cosmo_theme_options_panel', array(
        'priority'       => 2,
        'capability'     => 'edit_theme_options',
        'title'          => __($current_theme . ' Options', 'cosmo'),
        'description'    => __('Options for cosmo Theme.', 'cosmo'),
    ) );
}
add_action( 'customize_register', 'cosmo_customizer_panel_register' );


/**
* Register Customizer Sections.
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function cosmo_customizer_sections_register( $wp_customize ) {

// Homepage
$wp_customize->add_section( 'cosmo_homepage_section', array(
        'priority'       => 2,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'cosmo_theme_options_panel',
        'title'          => __('Homepage Settings', 'cosmo'),
        'description'    => __('Settings for the homepage in this theme', 'cosmo'),
    ) );

// Single Article
$wp_customize->add_section( 'cosmo_article_section', array(
        'priority'       => 4,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'cosmo_theme_options_panel',
        'title'          => __('Article View Settings', 'cosmo'),
        'description'    => __('Settings for the single posts in this theme', 'cosmo'),
    ) );

// General
$wp_customize->add_section( 'cosmo_general_section', array(
        'priority'       => 4,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'cosmo_theme_options_panel',
        'title'          => __('General Options', 'cosmo'),
        'description'    => __('General settings for the cosmo Theme.', 'cosmo'),
    ) );

// Footer & Navigation Settings
$wp_customize->add_section( 'cosmo_footer_nav_section', array(
	    'title'          => esc_attr__( 'Navigation & Footer Settings', 'cosmo' ),
	    'description'    => esc_attr__( 'Set custom logo, styles and colors for sticky navigation and the footer.', 'cosmo' ),
	    'panel'          => 'cosmo_theme_options_panel',
	    'priority'       => 10,
	) );

}
add_action( 'customize_register', 'cosmo_customizer_sections_register' );


/**
* Add Customizer Functions for Color Scheme
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function cosmo_color_customize_register( $wp_customize ) {
    // Secondary Color
    $wp_customize->add_setting( 'secondary_color', array(
      'default'   => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
      'section' => 'cosmo_general_section',
      'label'   => esc_html__( 'Light Background Color', 'cosmo' ),
    ) ) );

    // Accent Color
    $wp_customize->add_setting( 'accent_color', array(
      'default'   => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
      'section' => 'cosmo_general_section',
      'label'   => esc_html__( 'Accent Color (e.g. for links, buttons etc.)', 'cosmo' ),
    ) ) );
}
add_action( 'customize_register', 'cosmo_color_customize_register' );



/**
* Add Customizer Functions for Social Media Icons
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function cosmo_social_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'cosmo_social_media' , array(
	    'title'      => __( 'Social Media', 'cosmo' ),
	    'priority'   => 70,
	    'panel'		 => 'cosmo_theme_options_panel',
	    'description' => __( 'Please add the links to your social media channels here. The URLs need to have a http:// or https:// in front, so it is best to simply copy the URL from the browser address tab. <br/> <a href="#">Find more information in our documentation</a>.', 'cosmo' )
	) );

	$wp_customize->add_setting( 'facebook_link' , array(
	    'default'     => 'Your Facebook link here',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'instagram_link' , array(
	    'default'     => 'Your Instagram link here',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'twitter_link' , array(
	    'default'     => 'Your Twitter link here',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'bloglovin_link' , array(
	    'default'     => 'Your Bloglovin link here',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   $wp_customize->add_setting( 'pinterest_link' , array(
    	'default'     => 'Your Pinterest link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

    $wp_customize->add_setting( 'google_link' , array(
    	'default'     => 'Your Google+ link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'youtube_link' , array(
    	'default'     => 'Your Youtube link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'snapchat_link' , array(
    	'default'     => 'Your Snapchat link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'vimeo_link' , array(
    	'default'     => 'Your Vimeo link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'dribble_link' , array(
    	'default'     => 'Your Dribble link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'linkedin_link' , array(
    	'default'     => 'Your Linkedin link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'soundcloud_link' , array(
    	'default'     => 'Your Soundcloud link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_setting( 'rss_link' , array(
    	'default'     => 'Your RSS feed link here',
    	'transport'   => 'refresh',
    	'sanitize_callback' => 'sanitize_text_field'
	) );


   //* Add Customizer Controls
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook_link', array(
		'label'        => __( 'Facebook Link', 'mp' ),
		'section'    => 'cosmo_social_media',
		'settings'   => 'facebook_link',
	) ) );

      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'instagram_link', array(
		'label'        => __( 'Instagram Link', 'mp' ),
		'section'    => 'cosmo_social_media',
		'settings'   => 'instagram_link',
	) ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_link', array(
		'label'        => __( 'Twitter Link', 'mp' ),
		'section'    => 'cosmo_social_media',
		'settings'   => 'twitter_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloglovin_link', array(
		'label'        => __( 'Bloglovin URL', 'mp' ),
		'section'    => 'cosmo_social_media',
		'settings'   => 'bloglovin_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pinterest_link', array(
		'label'        => __( 'Pinterest Link', 'mp' ),
		'section'    => 'cosmo_social_media',
		'settings'   => 'pinterest_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google_link', array(
		'label'        => __( 'Google+ Link', 'mp' ),
		'section'    => 'cosmo_social_media',
		'settings'   => 'google_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'youtube_link', array(
		'label'        => __( 'Youtube Link', 'mp' ),
		'section'    => 'cosmo_social_media',
		'settings'   => 'youtube_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'snapchat_link', array(
		'label'        => __( 'Snapchat Link', 'mp' ),
		'section'    => 'cosmo_social_media',
		'settings'   => 'snapchat_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vimeo_link', array(
		'label'        => __( 'Vimeo Link', 'mp' ),
		'section'    => 'cosmo_social_media',
		'settings'   => 'vimeo_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'dribble_link', array(
		'label'        => __( 'Dribble Link', 'mp' ),
		'section'    => 'cosmo_social_media',
		'settings'   => 'dribble_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rss_link', array(
		'label'        => __( 'RSS Link', 'mp' ),
		'section'    => 'cosmo_social_media',
		'settings'   => 'rss_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'linkedin_link', array(
		'label'        => __( 'Linkedin Link', 'mp' ),
		'section'    => 'cosmo_social_media',
		'settings'   => 'linkedin_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'soundcloud_link', array(
		'label'        => __( 'Soundcloud Link', 'mp' ),
		'section'    => 'cosmo_social_media',
		'settings'   => 'soundcloud_link',
	) ) );
}
add_action( 'customize_register', 'cosmo_social_customize_register' );



/**
* Add Customizer Functions for Related Posts
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function cosmo_related_posts_customize_register( $wp_customize ) {

	//* Add Customizer Setting: Checkbox Related Posts
	$wp_customize->add_setting( 'cosmo_related_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'cosmo_sanitize_checkbox'
	) );

   //* Add Customizer Control: Checkbox Related Posts
   $wp_customize->add_control( 'cosmo_related_checkbox_control',
		array(
			'settings'		=> 'cosmo_related_checkbox',
			'section'		=> 'cosmo_article_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show Related Posts', 'cosmo' ),
		)
	);

	//* Add Customizer Setting: Headline Related Posts
	$wp_customize->add_setting( 'cosmo_related_headline' , array(
	    'default'     => 'Related Posts',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Headline Related Posts
   $wp_customize->add_control( 'cosmo_related_headline_control',
		array(
			'settings'		=> 'cosmo_related_headline',
			'section'		=> 'cosmo_article_section',
			'type'			=> 'text',
			'label'			=> __( 'Related Posts - Headline', 'cosmo' ),
			'description'	=> __( 'Set the headline for the related posts section, e.g. "You may also like".', 'cosmo' )
		)
	);

	//* Add Customizer Setting: Number Related Posts
	$wp_customize->add_setting( 'cosmo_related_number' , array(
	    'default'     => '3',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'cosmo_sanitize_number_absint'
	) );

   //* Add Customizer Control: Number Related Posts
   $wp_customize->add_control( 'cosmo_related_number_control',
		array(
			'settings'		=> 'cosmo_related_number',
			'section'		=> 'cosmo_article_section',
			'type'			=> 'number',
			'label'			=> __( 'Number of Related Posts', 'cosmo' ),
			'description'	=> __( 'Set the number of related posts to display below each article.', 'cosmo' )
		)
	);

   //* Add Customizer Setting: Category or Tags for Related Posts
	$wp_customize->add_setting( 'cosmo_related_type' , array(
	    'default'     => 'categories',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'cosmo_sanitize_select'
	) );

   //* Add Customizer Control: Category or Tags for Related Posts Radioboxes Control
   	$wp_customize->add_control('cosmo_related_type',
		array(
			'settings'		=> 'cosmo_related_type',
			'section'		=> 'cosmo_article_section',
			'type'			=> 'radio',
			'label'			=> __( 'Related Posts Type', 'cosmo' ),
			'description'	=> __( 'Please select if Related Posts should be shown based on tags or categories.', 'cosmo' ),
			'choices'		=> array(
				'categories' => __( 'Categories', 'cosmo' ),
				'tags' => __( 'Tags', 'cosmo' )
			)
		)
	);

}
add_action( 'customize_register', 'cosmo_related_posts_customize_register' );


/**
* Add Read More Functionality
*/
function cosmo_readmore_customize_register( $wp_customize ) {

   //* Add Customizer Setting: Read More Button Text
	$wp_customize->add_setting( 'cosmo_readmore_text' , array(
	    'default'     => 'Read More',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Read More Button Text
   $wp_customize->add_control( 'cosmo_readmore_text',
		array(
			'settings'		=> 'cosmo_readmore_text',
			'section'		=> 'cosmo_homepage_section',
			'type'			=> 'text',
			'label'			=> __( 'Read More Button Text', 'cosmo' ),
			'description'	=> __( 'Set the text to display on the read more button, e.g. "Continue Reading" or simply "Read More".', 'cosmo' )
		)
	);

}
add_action( 'customize_register', 'cosmo_readmore_customize_register' );



/**
* Add Sticky Sidebar Customizer Settings
*/
function cosmo_sidebar_customize_register( $wp_customize ) {

	//* Add Customizer Setting: Sidebar on Homepage + Single
	$wp_customize->add_setting( 'cosmo_show_sidebar' , array(
	    'default'     => 'fullwidth',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'cosmo_sanitize_select'
	) );

   //* Add Customizer Control: Sidebar on Homepage + Single Radioboxes Control
   	$wp_customize->add_control('cosmo_show_sidebar',
		array(
			'settings'		=> 'cosmo_show_sidebar',
			'section'		=> 'cosmo_general_section',
			'type'			=> 'radio',
			'label'			=> __( 'Show Sidebar', 'cosmo' ),
			'description'	=> __( 'Please select if you want to show a sidebar next to your posts on homepage and single posts.', 'cosmo' ),
			'choices'		=> array(
				'sidebar' => __( 'Show Sidebar', 'cosmo' ),
				'fullwidth' => __( 'Full-Width Posts', 'cosmo' )
			)
		)
	);



	$wp_customize->add_setting( 'cosmo_stickysidebar_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'cosmo_sanitize_checkbox'
	) );

   //* Add Customizer Control: Checkbox Sticky Sidebar
   $wp_customize->add_control( 'cosmo_stickysidebar_checkbox',
		array(
			'settings'		=> 'cosmo_stickysidebar_checkbox',
			'section'		=> 'cosmo_general_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Make the sidebar stick to the top when scrolling', 'cosmo' ),
		)
	);

   //* Add Customizer Setting: Mobile Navigation Headline
	$wp_customize->add_setting( 'cosmo_mobnav_headline' , array(
	    'default'     => 'What are you looking for?',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Mobile Navigation Headline
   $wp_customize->add_control( 'cosmo_mobnav_headline',
		array(
			'settings'		=> 'cosmo_mobnav_headline',
			'section'		=> 'cosmo_general_section',
			'type'			=> 'text',
			'label'			=> __( 'Mobile Navigation - Title', 'cosmo' ),
			'description'	=> __( 'Set the title for the mobile navigation, e.g. "What are you looking for?".', 'cosmo' )
		)
	);

}
add_action( 'customize_register', 'cosmo_sidebar_customize_register' );



/**
* Add Sticky Sidebar Customizer Settings
*/
function cosmo_slider_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'cosmo_slider_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'cosmo_sanitize_checkbox'
	) );

   //* Add Customizer Control: Checkbox Related Posts
   $wp_customize->add_control( 'cosmo_slider_checkbox',
		array(
			'settings'		=> 'cosmo_slider_checkbox',
			'section'		=> 'cosmo_homepage_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show the Post Slider in the top section', 'cosmo' ),
		)
	);

   //* Add Customizer Setting: Category or Tags for Related Posts
	$wp_customize->add_setting( 'cosmo_slider_type' , array(
	    'default'     => 'latest',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'cosmo_sanitize_select'
	) );

   //* Add Customizer Control: Category or Tags for Related Posts Radioboxes Control
   	$wp_customize->add_control('cosmo_slider_type',
		array(
			'settings'		=> 'cosmo_slider_type',
			'section'		=> 'cosmo_homepage_section',
			'type'			=> 'radio',
			'label'			=> __( 'Slider Posts Type', 'cosmo' ),
			'description'	=> __( 'Please select what posts should be shown in the top slider.', 'cosmo' ),
			'choices'		=> array(
				'latest' => __( 'Latest Posts', 'cosmo' ),
				'featured' => __( 'Featured Posts (posts that have the category "featured")', 'cosmo' )
			)
		)
	);


}
add_action( 'customize_register', 'cosmo_slider_customize_register' );



/*
* Add support for the custom footer logo and more settings
*/
function cosmo_footer_customize_register( $wp_customize ) {

	//* Add Customizer Setting: Footer Logo Upload
	$wp_customize->add_setting( 'cosmo_footer_logo' , array(
	    'default'     => 0,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'cosmo_sanitize_image'
	) );

	// Add Customizer control: Footer Logo Upload
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cosmo_footer_logo', array(
       	'label'    => __( 'Upload a logo for the footer and sticky navigation', 'cosmo' ),
        'section'  => 'cosmo_footer_nav_section',
        'settings' => 'cosmo_footer_logo',
    ) ) );

    // Color Picker for Bg Color
	$wp_customize->add_setting('cosmo_footer_bg', array(
            'default' => '#0c0c0c',
            'type' => 'theme_mod',
            'sanitize_callback' => 'cosmo_sanitize_hex_color'
        )
    );
	// Color Control
	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'cosmo_footer_bg_color', array(
		'label' => __( 'Set a background color', 'cosmo' ), 
        'section' => 'cosmo_footer_nav_section',
        'settings' => 'cosmo_footer_bg',
        'type' => 'color',
    ) ) );

    //* Based on set background color: Choose light or dark font color
	$wp_customize->add_setting( 'cosmo_footer_font_color' , array(
	    'default'     => 'light',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'cosmo_sanitize_select'
	) );

   //* Add Customizer Control: Category or Tags for Related Posts Radioboxes Control
   	$wp_customize->add_control('cosmo_footer_font_color',
		array(
			'settings'		=> 'cosmo_footer_font_color',
			'section'		=> 'cosmo_footer_nav_section',
			'type'			=> 'radio',
			'label'			=> __( 'Set a font color', 'cosmo' ),
			'description'	=> __( 'Please select if the footer font should be light or dark (based on the background color you chose before).', 'cosmo' ),
			'choices'		=> array(
				'light' => __( 'Light', 'cosmo' ),
				'dark' => __( 'Dark', 'cosmo' )
			)
		)
	);


	// Footer Credit/Copyright Text
    $wp_customize->add_setting( 'cosmo_footer_description' , array(
	    'default'     => '',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Controls
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cosmo_footer_description', array(
		'label'        => __( 'Footer site description', 'mp' ),
		'description'	=> __( 'The theme will automatically fetch your blog description if this field is empty.', 'cosmo' ),
		'type' => 'textarea',
		'section'    => 'cosmo_footer_nav_section',
		'settings'   => 'cosmo_footer_description',
	) ) );
}
add_action( 'customize_register', 'cosmo_footer_customize_register' );
