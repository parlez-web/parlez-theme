<?php
/**
 * jouy Theme Customizer
 *
 * @package jouy
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jouy_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'jouy_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function jouy_customize_preview_js() {
	wp_enqueue_script( 'jouy_customizer', get_template_directory_uri() . '/js/customizer/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'jouy_customize_preview_js' );


/**
* Register Theme Options Panel.
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function jouy_customizer_panel_register( $wp_customize ) {
$current_theme = wp_get_theme();

$wp_customize->add_panel( 'jouy_theme_options_panel', array(
        'priority'       => 2,
        'capability'     => 'edit_theme_options',
        'title'          => __($current_theme . ' Options', 'jouy'),
        'description'    => __('Options for Jouy Theme.', 'jouy'),
    ) );
}
add_action( 'customize_register', 'jouy_customizer_panel_register' );


/**
* Register Customizer Sections.
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function jouy_customizer_sections_register( $wp_customize ) {

// Homepage
$wp_customize->add_section( 'jouy_homepage_section', array(
        'priority'       => 2,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'jouy_theme_options_panel',
        'title'          => __('Homepage Settings', 'jouy'),
        'description'    => __('Settings for the homepage in this theme', 'jouy'),
    ) );

// Single Article
$wp_customize->add_section( 'jouy_article_section', array(
        'priority'       => 4,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'jouy_theme_options_panel',
        'title'          => __('Article View Settings', 'jouy'),
        'description'    => __('Settings for the single posts in this theme', 'jouy'),
    ) );

// General
$wp_customize->add_section( 'jouy_general_section', array(
        'priority'       => 4,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'jouy_theme_options_panel',
        'title'          => __('General Options', 'jouy'),
        'description'    => __('General settings for the Jouy Theme.', 'jouy'),
    ) );
}
add_action( 'customize_register', 'jouy_customizer_sections_register' );


/**
* Add Customizer Functions for Color Scheme
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function jouy_color_customize_register( $wp_customize ) {
    // Secondary Color
    $wp_customize->add_setting( 'secondary_color', array(
      'default'   => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
      'section' => 'jouy_general_section',
      'label'   => esc_html__( 'Light Background Color', 'jouy' ),
    ) ) );

    // Accent Color
    $wp_customize->add_setting( 'accent_color', array(
      'default'   => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
      'section' => 'jouy_general_section',
      'label'   => esc_html__( 'Accent Color (e.g. for links, buttons etc.)', 'jouy' ),
    ) ) );
}
add_action( 'customize_register', 'jouy_color_customize_register' );



/**
* Add Customizer Functions for Social Media Icons
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function jouy_social_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'jouy_social_media' , array(
	    'title'      => __( 'Social Media', 'mps' ),
	    'priority'   => 70,
	    'panel'		 => 'jouy_theme_options_panel',
	    'description' => __( 'Please add the links to your social media channels here. The URLs need to have a http:// or https:// in front, so it is best to simply copy the URL from the browser address tab. <br/> <a href="#">Find more information in our documentation</a>.', 'mps' )
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
		'section'    => 'jouy_social_media',
		'settings'   => 'facebook_link',
	) ) );

      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'instagram_link', array(
		'label'        => __( 'Instagram Link', 'mp' ),
		'section'    => 'jouy_social_media',
		'settings'   => 'instagram_link',
	) ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_link', array(
		'label'        => __( 'Twitter Link', 'mp' ),
		'section'    => 'jouy_social_media',
		'settings'   => 'twitter_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloglovin_link', array(
		'label'        => __( 'Bloglovin URL', 'mp' ),
		'section'    => 'jouy_social_media',
		'settings'   => 'bloglovin_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pinterest_link', array(
		'label'        => __( 'Pinterest Link', 'mp' ),
		'section'    => 'jouy_social_media',
		'settings'   => 'pinterest_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google_link', array(
		'label'        => __( 'Google+ Link', 'mp' ),
		'section'    => 'jouy_social_media',
		'settings'   => 'google_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'youtube_link', array(
		'label'        => __( 'Youtube Link', 'mp' ),
		'section'    => 'jouy_social_media',
		'settings'   => 'youtube_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'snapchat_link', array(
		'label'        => __( 'Snapchat Link', 'mp' ),
		'section'    => 'jouy_social_media',
		'settings'   => 'snapchat_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vimeo_link', array(
		'label'        => __( 'Vimeo Link', 'mp' ),
		'section'    => 'jouy_social_media',
		'settings'   => 'vimeo_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'dribble_link', array(
		'label'        => __( 'Dribble Link', 'mp' ),
		'section'    => 'jouy_social_media',
		'settings'   => 'dribble_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rss_link', array(
		'label'        => __( 'RSS Link', 'mp' ),
		'section'    => 'jouy_social_media',
		'settings'   => 'rss_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'linkedin_link', array(
		'label'        => __( 'Linkedin Link', 'mp' ),
		'section'    => 'jouy_social_media',
		'settings'   => 'linkedin_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'soundcloud_link', array(
		'label'        => __( 'Soundcloud Link', 'mp' ),
		'section'    => 'jouy_social_media',
		'settings'   => 'soundcloud_link',
	) ) );
}
add_action( 'customize_register', 'jouy_social_customize_register' );



/**
* Add Customizer Functions for Related Posts
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function jouy_related_posts_customize_register( $wp_customize ) {

	//* Add Customizer Setting: Checkbox Related Posts
	$wp_customize->add_setting( 'jouy_related_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'jouy_sanitize_checkbox'
	) );

   //* Add Customizer Control: Checkbox Related Posts
   $wp_customize->add_control( 'jouy_related_checkbox_control',
		array(
			'settings'		=> 'jouy_related_checkbox',
			'section'		=> 'jouy_article_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show Related Posts', 'jouy' ),
		)
	);

	//* Add Customizer Setting: Headline Related Posts
	$wp_customize->add_setting( 'jouy_related_headline' , array(
	    'default'     => 'Related Posts',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Headline Related Posts
   $wp_customize->add_control( 'jouy_related_headline_control',
		array(
			'settings'		=> 'jouy_related_headline',
			'section'		=> 'jouy_article_section',
			'type'			=> 'text',
			'label'			=> __( 'Related Posts - Headline', 'jouy' ),
			'description'	=> __( 'Set the headline for the related posts section, e.g. "You may also like".', 'jouy' )
		)
	);

	//* Add Customizer Setting: Number Related Posts
	$wp_customize->add_setting( 'jouy_related_number' , array(
	    'default'     => '3',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'jouy_sanitize_number_absint'
	) );

   //* Add Customizer Control: Number Related Posts
   $wp_customize->add_control( 'jouy_related_number_control',
		array(
			'settings'		=> 'jouy_related_number',
			'section'		=> 'jouy_article_section',
			'type'			=> 'number',
			'label'			=> __( 'Number of Related Posts', 'jouy' ),
			'description'	=> __( 'Set the number of related posts to display below each article.', 'jouy' )
		)
	);

   //* Add Customizer Setting: Category or Tags for Related Posts
	$wp_customize->add_setting( 'jouy_related_type' , array(
	    'default'     => 'categories',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'jouy_sanitize_select'
	) );

   //* Add Customizer Control: Category or Tags for Related Posts Radioboxes Control
   	$wp_customize->add_control('jouy_related_type',
		array(
			'settings'		=> 'jouy_related_type',
			'section'		=> 'jouy_article_section',
			'type'			=> 'radio',
			'label'			=> __( 'Related Posts Type', 'jouy' ),
			'description'	=> __( 'Please select if Related Posts should be shown based on tags or categories.', 'jouy' ),
			'choices'		=> array(
				'categories' => __( 'Categories', 'jouy' ),
				'tags' => __( 'Tags', 'jouy' )
			)
		)
	);

}
add_action( 'customize_register', 'jouy_related_posts_customize_register' );


/**
* Add Read More Functionality
*/
function jouy_readmore_customize_register( $wp_customize ) {

   //* Add Customizer Setting: Read More Button Text
	$wp_customize->add_setting( 'jouy_readmore_text' , array(
	    'default'     => 'Read More',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Read More Button Text
   $wp_customize->add_control( 'jouy_readmore_text',
		array(
			'settings'		=> 'jouy_readmore_text',
			'section'		=> 'jouy_homepage_section',
			'type'			=> 'text',
			'label'			=> __( 'Read More Button Text', 'jouy' ),
			'description'	=> __( 'Set the text to display on the read more button, e.g. "Continue Reading" or simply "Read More".', 'jouy' )
		)
	);

}
add_action( 'customize_register', 'jouy_readmore_customize_register' );



/**
* Add Sticky Sidebar Customizer Settings
*/
function jouy_sidebar_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'jouy_stickysidebar_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'jouy_sanitize_checkbox'
	) );

   //* Add Customizer Control: Checkbox Related Posts
   $wp_customize->add_control( 'jouy_stickysidebar_checkbox',
		array(
			'settings'		=> 'jouy_stickysidebar_checkbox',
			'section'		=> 'jouy_general_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Make the sidebar stick to the top when scrolling', 'jouy' ),
		)
	);


   //* Add Customizer Setting: Mobile Navigation Headline
	$wp_customize->add_setting( 'jouy_mobnav_headline' , array(
	    'default'     => 'What are you looking for?',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Mobile Navigation Headline
   $wp_customize->add_control( 'jouy_mobnav_headline',
		array(
			'settings'		=> 'jouy_mobnav_headline',
			'section'		=> 'jouy_general_section',
			'type'			=> 'text',
			'label'			=> __( 'Mobile Navigation - Title', 'jouy' ),
			'description'	=> __( 'Set the title for the mobile navigation, e.g. "What are you looking for?".', 'jouy' )
		)
	);

}
add_action( 'customize_register', 'jouy_sidebar_customize_register' );



/**
* Add Sticky Sidebar Customizer Settings
*/
function jouy_slider_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'jouy_slider_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'jouy_sanitize_checkbox'
	) );

   //* Add Customizer Control: Checkbox Related Posts
   $wp_customize->add_control( 'jouy_slider_checkbox',
		array(
			'settings'		=> 'jouy_slider_checkbox',
			'section'		=> 'jouy_homepage_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show the Post Slider in the top section', 'jouy' ),
		)
	);

   //* Add Customizer Setting: Category or Tags for Related Posts
	$wp_customize->add_setting( 'jouy_slider_type' , array(
	    'default'     => 'latest',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'jouy_sanitize_select'
	) );

   //* Add Customizer Control: Category or Tags for Related Posts Radioboxes Control
   	$wp_customize->add_control('jouy_slider_type',
		array(
			'settings'		=> 'jouy_slider_type',
			'section'		=> 'jouy_homepage_section',
			'type'			=> 'radio',
			'label'			=> __( 'Slider Posts Type', 'jouy' ),
			'description'	=> __( 'Please select what posts should be shown in the top slider.', 'jouy' ),
			'choices'		=> array(
				'latest' => __( 'Latest Posts', 'jouy' ),
				'featured' => __( 'Featured Posts (posts that have the category "featured")', 'jouy' )
			)
		)
	);


}
add_action( 'customize_register', 'jouy_slider_customize_register' );


