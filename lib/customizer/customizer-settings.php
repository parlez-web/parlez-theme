<?php
/**
 * myboutique Theme Customizer
 *
 * @package myboutique
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function myboutique_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'myboutique_customize_register' );


/**
* Register Theme Options Panel.
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function myboutique_customizer_panel_register( $wp_customize ) {
$current_theme = wp_get_theme();

$wp_customize->add_panel( 'myboutique_theme_options_panel', array(
        'priority'       => 2,
        'capability'     => 'edit_theme_options',
        'title'          => __($current_theme . ' Options', 'myboutique'),
        'description'    => __('Options for myboutique Theme.', 'myboutique'),
    ) );
}
add_action( 'customize_register', 'myboutique_customizer_panel_register' );


/**
* Register Customizer Sections.
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function myboutique_customizer_sections_register( $wp_customize ) {

// Homepage
$wp_customize->add_section( 'myboutique_homepage_section', array(
        'priority'       => 2,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'myboutique_theme_options_panel',
        'title'          => __('Homepage', 'myboutique'),
    ) );

// Single Article
$wp_customize->add_section( 'myboutique_article_section', array(
        'priority'       => 4,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'myboutique_theme_options_panel',
        'title'          => __('Articles & Pages', 'myboutique'),
    ) );

// Theme Colors
$wp_customize->add_section( 'myboutique_color_section', array(
        'priority'       => 4,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'myboutique_theme_options_panel',
        'title'          => __('Colors', 'myboutique'),
        'description'  => __('<em>MBT Tip</em>: Are you unsure which colors to pick? Get inspired by our theme demos or download the exact color files directly from here.', 'myboutique')
    ) );

// Theme Fonts
$wp_customize->add_section( 'myboutique_fonts_section', array(
        'priority'       => 4,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'myboutique_theme_options_panel',
        'title'          => __('Fonts', 'myboutique'),
    ) );

// General
$wp_customize->add_section( 'myboutique_general_section', array(
        'priority'       => 4,
        'capability'     => 'edit_theme_options',
        'panel'		 	 => 'myboutique_theme_options_panel',
        'title'          => __('General Options', 'myboutique'),
    ) );

// Footer & Navigation Settings
$wp_customize->add_section( 'myboutique_footer_nav_section', array(
	    'title'          => esc_attr__( 'Footer', 'myboutique' ),
	    'description'    => esc_attr__( 'Set custom logo, styles and colors for sticky navigation and the footer.', 'myboutique' ),
	    'panel'          => 'myboutique_theme_options_panel',
	    'priority'       => 10,
	) );

}
add_action( 'customize_register', 'myboutique_customizer_sections_register' );


/**
* Add Customizer Functions for Color Scheme
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function myboutique_color_customize_register( $wp_customize ) {
    // Secondary Color
    $wp_customize->add_setting( 'base_color', array(
      'default'   => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'base_color', array(
      'section' => 'myboutique_color_section',
      'label'   => esc_html__( 'Base Color', 'myboutique' ),
      'description' => esc_html__( 'Defines the base aesthetic of the theme. Choose a pastel color for a feminine look or a darker shade for a cool, more sophisticated color scheme.', 'myboutique' )
    ) ) );

    // Accent Color
    $wp_customize->add_setting( 'accent_color', array(
      'default'   => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
      'section' => 'myboutique_color_section',
      'label'   => esc_html__( 'Accent Color', 'myboutique' ),
      'description' => esc_html__( 'Is used for links, hover states, sometimes buttons and special titles. Give your design a popping look with a complimentary color (as opposed to the base color) or stay in the same family for a more harmonic color scheme.', 'myboutique' )
    ) ) );

 //     // Title Font Color
 //    $wp_customize->add_setting( 'title_font_color', array(
 //      'default'   => '',
 //      'transport' => 'refresh',
 //      'sanitize_callback' => 'sanitize_hex_color',
 //    ) );

 //    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'title_font_color', array(
 //      'section' => 'myboutique_color_section',
 //      'label'   => esc_html__( 'Title Font Color', 'myboutique' ),
 //      'description' => esc_html__( 'Post Title, Page Title, Widget Title, etc.', 'myboutique' )
 //    ) ) );

 //    // Body Font Color
 //    $wp_customize->add_setting( 'body_font_color', array(
 //      'default'   => '',
 //      'transport' => 'refresh',
 //      'sanitize_callback' => 'sanitize_hex_color',
 //    ) );

 //    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_font_color', array(
 //      'section' => 'myboutique_color_section',
 //      'label'   => esc_html__( 'Body Font Color', 'myboutique' ),
 //      'description' => esc_html__( 'Post Body Text, Page Text, Widget Text', 'myboutique' )
 //    ) ) );

 //    // Button Background Color
 //    $wp_customize->add_setting( 'button_bg_color', array(
 //      'default'   => '',
 //      'transport' => 'refresh',
 //      'sanitize_callback' => 'sanitize_hex_color',
 //    ) );

 //    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_bg_color', array(
 //      'section' => 'myboutique_color_section',
 //      'label'   => esc_html__( 'Button Background Color', 'myboutique' )
 //    ) ) );

 //    // Button Font Color
 //    $wp_customize->add_setting( 'button_font_color', array(
 //      'default'   => '',
 //      'transport' => 'refresh',
 //      'sanitize_callback' => 'sanitize_hex_color',
 //    ) );

 //    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_font_color', array(
 //      'section' => 'myboutique_color_section',
 //      'label'   => esc_html__( 'Button Font Color', 'myboutique' ),
 //    ) ) );

 //     // Color Picker for Footer Bg Color
	// $wp_customize->add_setting('footer_bg_color', array(
 //        'default' => '#0c0c0c',
 //        'sanitize_callback' => 'myboutique_sanitize_hex_color'
 //        )
 //    );
	// // Color Control
	// $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', array(
	// 	'label' => __( 'Footer Background Color', 'myboutique' ), 
 //        'section' => 'myboutique_color_section',
 //        'type' => 'color',
 //    ) ) );

 //     // Color Picker for Footer Bg Color
	// $wp_customize->add_setting('footer_font_color', array(
 //        'default' => '#ffffff',
 //        'sanitize_callback' => 'myboutique_sanitize_hex_color'
 //        )
 //    );
	// // Color Control
	// $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'footer_font_color', array(
	// 	'label' => __( 'Footer Font Color', 'myboutique' ), 
 //        'section' => 'myboutique_color_section',
 //        'type' => 'color',
 //    ) ) );

 //    // Color Picker for Primary Navbar Bg Color
	// $wp_customize->add_setting('primary_navbar_bg_color', array(
 //        'default' => '#0c0c0c',
 //        'sanitize_callback' => 'myboutique_sanitize_hex_color'
 //        )
 //    );
	// // Color Control
	// $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'primary_navbar_bg_color', array(
	// 	'label' => __( 'Primary (Top) Navbar Background Color', 'myboutique' ), 
 //        'section' => 'myboutique_color_section',
 //        'type' => 'color',
 //    ) ) );

 //     // Color Picker for Primary Navbar Color
	// $wp_customize->add_setting('primary_navbar_font_color', array(
 //        'default' => '#ffffff',
 //        'sanitize_callback' => 'myboutique_sanitize_hex_color'
 //        )
 //    );
	// // Color Control
	// $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'primary_navbar_font_color', array(
	// 	'label' => __( 'Secondary (Top) Navbar Font Color', 'myboutique' ), 
 //        'section' => 'myboutique_color_section',
 //        'type' => 'color',
 //    ) ) );


 //   // Color Picker for Secondary Navbar Bg Color
 //  $wp_customize->add_setting('secondary_navbar_bg_color', array(
 //        'default' => '#0c0c0c',
 //        'sanitize_callback' => 'myboutique_sanitize_hex_color'
 //        )
 //    );
 //  // Color Control
 //  $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'secondary_navbar_bg_color', array(
 //    'label' => __( 'Secondary (below header) Navbar Background Color', 'myboutique' ), 
 //        'section' => 'myboutique_color_section',
 //        'type' => 'color',
 //    ) ) );

 //     // Color Picker for Secondary Navbar Color
 //  $wp_customize->add_setting('secondary_navbar_font_color', array(
 //        'default' => '#ffffff',
 //        'sanitize_callback' => 'myboutique_sanitize_hex_color'
 //        )
 //    );
 //  // Color Control
 //  $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'secondary_navbar_font_color', array(
 //    'label' => __( 'Secondary (below header) Navbar Font Color', 'myboutique' ), 
 //        'section' => 'myboutique_color_section',
 //        'type' => 'color',
 //    ) ) );


 //    // Color Picker for Slider Overlay Bg Color
	// $wp_customize->add_setting('overlay_bg_color', array(
 //        'default' => '#0c0c0c',
 //        'sanitize_callback' => 'myboutique_sanitize_hex_color'
 //        )
 //    );

	// // Color Control
	// $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'overlay_bg_color', array(
	// 	'label' => __( 'Slider Overlay Background Color', 'myboutique' ), 
 //        'section' => 'myboutique_color_section',
 //        'type' => 'color',
 //    ) ) );

 //     // Color Picker for Slider Overlay Font Color
	// $wp_customize->add_setting('overlay_font_color', array(
 //        'default' => '#ffffff',
 //        'sanitize_callback' => 'myboutique_sanitize_hex_color'
 //        )
 //    );
	// // Color Control
	// $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'overlay_font_color', array(
	// 	'label' => __( 'Slider Overlay Font Color', 'myboutique' ), 
 //        'section' => 'myboutique_color_section',
 //        'type' => 'color',
 //    ) ) );
}
add_action( 'customize_register', 'myboutique_color_customize_register' );



/**
* Add Customizer Functions for Social Media Icons
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function myboutique_social_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'myboutique_social_media' , array(
	    'title'      => __( 'Social Media', 'myboutique' ),
	    'priority'   => 70,
	    'panel'		 => 'myboutique_theme_options_panel',
	    'description' => __( 'Please add the links to your social media channels here. The URLs need to have a http:// or https:// in front, so it is best to simply copy the URL from the browser address tab. <br/> <a href="#">Find more information in our documentation</a>.', 'myboutique' )
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

 //    $wp_customize->add_setting( 'google_link' , array(
 //    	'default'     => 'Your Google+ link here',
 //    	'transport'   => 'refresh',
 //    	'sanitize_callback' => 'sanitize_text_field'
	// ) );

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
		'section'    => 'myboutique_social_media',
		'settings'   => 'facebook_link',
	) ) );

      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'instagram_link', array(
		'label'        => __( 'Instagram Link', 'mp' ),
		'section'    => 'myboutique_social_media',
		'settings'   => 'instagram_link',
	) ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_link', array(
		'label'        => __( 'Twitter Link', 'mp' ),
		'section'    => 'myboutique_social_media',
		'settings'   => 'twitter_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloglovin_link', array(
		'label'        => __( 'Bloglovin URL', 'mp' ),
		'section'    => 'myboutique_social_media',
		'settings'   => 'bloglovin_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pinterest_link', array(
		'label'        => __( 'Pinterest Link', 'mp' ),
		'section'    => 'myboutique_social_media',
		'settings'   => 'pinterest_link',
	) ) );

 //   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google_link', array(
	// 	'label'        => __( 'Google+ Link', 'mp' ),
	// 	'section'    => 'myboutique_social_media',
	// 	'settings'   => 'google_link',
	// ) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'youtube_link', array(
		'label'        => __( 'Youtube Link', 'mp' ),
		'section'    => 'myboutique_social_media',
		'settings'   => 'youtube_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'snapchat_link', array(
		'label'        => __( 'Snapchat Link', 'mp' ),
		'section'    => 'myboutique_social_media',
		'settings'   => 'snapchat_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vimeo_link', array(
		'label'        => __( 'Vimeo Link', 'mp' ),
		'section'    => 'myboutique_social_media',
		'settings'   => 'vimeo_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'dribble_link', array(
		'label'        => __( 'Dribble Link', 'mp' ),
		'section'    => 'myboutique_social_media',
		'settings'   => 'dribble_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'rss_link', array(
		'label'        => __( 'RSS Link', 'mp' ),
		'section'    => 'myboutique_social_media',
		'settings'   => 'rss_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'linkedin_link', array(
		'label'        => __( 'Linkedin Link', 'mp' ),
		'section'    => 'myboutique_social_media',
		'settings'   => 'linkedin_link',
	) ) );

   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'soundcloud_link', array(
		'label'        => __( 'Soundcloud Link', 'mp' ),
		'section'    => 'myboutique_social_media',
		'settings'   => 'soundcloud_link',
	) ) );
}
add_action( 'customize_register', 'myboutique_social_customize_register' );



/**
* Add Customizer Functions for Related Posts
*
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function myboutique_related_posts_customize_register( $wp_customize ) {

	//* Add Customizer Setting: Checkbox Related Posts
	$wp_customize->add_setting( 'myboutique_related_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'myboutique_sanitize_checkbox'
	) );

   //* Add Customizer Control: Checkbox Related Posts
   $wp_customize->add_control( 'myboutique_related_checkbox_control',
		array(
			'settings'		=> 'myboutique_related_checkbox',
			'section'		=> 'myboutique_article_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show Related Posts', 'myboutique' ),
		)
	);

	//* Add Customizer Setting: Headline Related Posts
	$wp_customize->add_setting( 'myboutique_related_headline' , array(
	    'default'     => 'Related Posts',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Headline Related Posts
   $wp_customize->add_control( 'myboutique_related_headline_control',
		array(
			'settings'		=> 'myboutique_related_headline',
			'section'		=> 'myboutique_article_section',
			'type'			=> 'text',
			'label'			=> __( 'Related Posts - Headline', 'myboutique' ),
			'description'	=> __( 'Set the headline for the related posts section, e.g. "You may also like".', 'myboutique' )
		)
	);

	//* Add Customizer Setting: Number Related Posts
	$wp_customize->add_setting( 'myboutique_related_number' , array(
	    'default'     => '3',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'myboutique_sanitize_number_absint'
	) );

   //* Add Customizer Control: Number Related Posts
   $wp_customize->add_control( 'myboutique_related_number_control',
		array(
			'settings'		=> 'myboutique_related_number',
			'section'		=> 'myboutique_article_section',
			'type'			=> 'number',
			'label'			=> __( 'Number of Related Posts', 'myboutique' ),
			'description'	=> __( 'Set the number of related posts to display below each article.', 'myboutique' )
		)
	);

   //* Add Customizer Setting: Category or Tags for Related Posts
	$wp_customize->add_setting( 'myboutique_related_type' , array(
	    'default'     => 'categories',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'myboutique_sanitize_select'
	) );

   //* Add Customizer Control: Category or Tags for Related Posts Radioboxes Control
   	$wp_customize->add_control('myboutique_related_type',
		array(
			'settings'		=> 'myboutique_related_type',
			'section'		=> 'myboutique_article_section',
			'type'			=> 'radio',
			'label'			=> __( 'Related Posts Type', 'myboutique' ),
			'description'	=> __( 'Please select if Related Posts should be shown based on tags or categories.', 'myboutique' ),
			'choices'		=> array(
				'categories' => __( 'Categories', 'myboutique' ),
				'tags' => __( 'Tags', 'myboutique' )
			)
		)
	);

}
add_action( 'customize_register', 'myboutique_related_posts_customize_register' );




/**
* Add Sticky Sidebar Customizer Settings
*/
function myboutique_sidebar_customize_register( $wp_customize ) {

	//* Add Customizer Setting: Sidebar on Homepage + Single
	$wp_customize->add_setting( 'myboutique_show_sidebar' , array(
	    'default'     => 'fullwidth',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'myboutique_sanitize_select'
	) );

   //* Add Customizer Control: Sidebar on Homepage + Single Radioboxes Control
   	$wp_customize->add_control('myboutique_show_sidebar',
		array(
			'settings'		=> 'myboutique_show_sidebar',
			'section'		=> 'myboutique_general_section',
			'type'			=> 'radio',
			'label'			=> __( 'Show Sidebar', 'myboutique' ),
			'description'	=> __( 'Please select if you want to show a sidebar next to your posts on homepage and single posts.', 'myboutique' ),
			'choices'		=> array(
				'sidebar' => __( 'Show Sidebar', 'myboutique' ),
				'fullwidth' => __( 'Full-Width Posts', 'myboutique' )
			)
		)
	);



	$wp_customize->add_setting( 'myboutique_stickysidebar_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'myboutique_sanitize_checkbox'
	) );

   //* Add Customizer Control: Checkbox Sticky Sidebar
   $wp_customize->add_control( 'myboutique_stickysidebar_checkbox',
		array(
			'settings'		=> 'myboutique_stickysidebar_checkbox',
			'section'		=> 'myboutique_general_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Make the sidebar stick to the top when scrolling', 'myboutique' ),
		)
	);

   //* Add Customizer Setting: Mobile Navigation Headline
	$wp_customize->add_setting( 'myboutique_mobnav_headline' , array(
	    'default'     => 'What are you looking for?',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Mobile Navigation Headline
   $wp_customize->add_control( 'myboutique_mobnav_headline',
		array(
			'settings'		=> 'myboutique_mobnav_headline',
			'section'		=> 'myboutique_general_section',
			'type'			=> 'text',
			'label'			=> __( 'Mobile Navigation - Title', 'myboutique' ),
			'description'	=> __( 'Set the title for the mobile navigation, e.g. "What are you looking for?".', 'myboutique' )
		)
	);

}
add_action( 'customize_register', 'myboutique_sidebar_customize_register' );



/**
* Add Sticky Sidebar Customizer Settings
*/
function myboutique_slider_customize_register( $wp_customize ) {
	//* Add Customizer Setting: Slider/Top Section Layout
	$wp_customize->add_setting( 'myboutique_featured_layout' , array(
	    'default'     => 'slider_fullwidth',
	    'transport'   => 'refresh',
	    //'sanitize_callback' => 'myboutique_sanitize_select'
	) );

   //* Add Customizer Control: Slider/Top Section Layout
   	$wp_customize->add_control(new Slider_Picker_Custom_Control( $wp_customize, 'myboutique_featured_layout',
		array(
			'settings'		=> 'myboutique_featured_layout',
			'section'		=> 'myboutique_homepage_section',
			'type'			=> 'radio',
			'label'			=> __( 'Featured Section Layout', 'myboutique' ),
			'description'	=> __( 'Please select the Layout of the top featured section', 'myboutique' ),
			// 'choices'		=> array(
			// 	'latest' => __( 'Latest Posts', 'myboutique' ),
			// 	'featured' => __( 'Featured Posts (posts that have the category "featured")', 'myboutique' )
			// )
		)
	));


	//* Add Customizer Setting: Checkbox Featured Section Overlay
	$wp_customize->add_setting( 'myboutique_featured_overlay_checkbox' , array(
	    'default'     => TRUE,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'myboutique_sanitize_checkbox'
	) );

   //* Add Customizer Control: Checkbox Featured Section Overlay
   $wp_customize->add_control( 'myboutique_featured_overlay_checkbox',
		array(
			'section'		=> 'myboutique_homepage_section',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show Overlay (Post Title, Categories, etc.)', 'myboutique' ),
		)
	);

   //* Add Customizer Setting: Category or Tags for Related Posts
	// $wp_customize->add_setting( 'myboutique_slider_type' , array(
	//     'default'     => 'latest',
	//     'transport'   => 'refresh',
	//     'sanitize_callback' => 'myboutique_sanitize_select'
	// ) );

 //   //* Add Customizer Control: Category or Tags for Related Posts Radioboxes Control
 //   	$wp_customize->add_control('myboutique_slider_type',
	// 	array(
	// 		'settings'		=> 'myboutique_slider_type',
	// 		'section'		=> 'myboutique_homepage_section',
	// 		'type'			=> 'radio',
	// 		'label'			=> __( 'Featured Section Posts Type', 'myboutique' ),
	// 		'description'	=> __( 'Please select which kind of posts should be shown in the top featured section.', 'myboutique' ),
	// 		'choices'		=> array(
	// 			'latest' => __( 'Recent Posts', 'myboutique' ),
	// 			'category' => __( 'Category Posts', 'myboutique' )
	// 		)
	// 	)
	// );


	//* Add Customizer Setting: Category Dropdown for Featured Section
	$wp_customize->add_setting( 'myboutique_featured_category' , array(
	    'default'     => '0',
	    'transport'   => 'refresh',
	    //'sanitize_callback' => 'myboutique_sanitize_select'
	) );

   //* Add Customizer Control: Category Dropdown for Featured Section
   	$wp_customize->add_control(new Category_Dropdown_Custom_Control($wp_customize, 'myboutique_featured_category',
		array(
			'settings'		=> 'myboutique_featured_category',
			'section'		=> 'myboutique_homepage_section',
			'type'			=> 'select',
			'label'			=> __( 'Select the Featured Posts Category', 'myboutique' ),
			'description'	=> __( 'Hint: Choose "All Categories" for the most recent posts and create an extra "featured" category to choose exact posts.', 'myboutique' ),
			// 'choices'		=> array(
			// 	'latest' => __( 'Recent Posts', 'myboutique' ),
			// 	'category' => __( 'Category Posts', 'myboutique' )
			// )
		)
	));


	//* Add Customizer Setting: Homepage Post Layout Picker
	$wp_customize->add_setting( 'myboutique_posts_layout' , array(
	    'default'     => 'normal',
	    'transport'   => 'refresh',
	    //'sanitize_callback' => 'myboutique_sanitize_select'
	) );

   //* Add Customizer Control: Homepage Post Layout Picker
   	$wp_customize->add_control(new Layout_Picker_Custom_Control( $wp_customize, 'myboutique_posts_layout',
		array(
			'settings'		=> 'myboutique_posts_layout',
			'section'		=> 'myboutique_homepage_section',
			'type'			=> 'radio',
			'label'			=> __( 'Homepage Posts Layout', 'myboutique' ),
			'description'	=> __( 'Please select the layout of the blog post loop on the homepage.', 'myboutique' ),
			// 'choices'		=> array(
			// 	'latest' => __( 'Latest Posts', 'myboutique' ),
			// 	'featured' => __( 'Featured Posts (posts that have the category "featured")', 'myboutique' )
			// )
		)
	));


}
add_action( 'customize_register', 'myboutique_slider_customize_register' );


/**
* Add Read More Functionality
*/
function myboutique_readmore_customize_register( $wp_customize ) {

   //* Add Customizer Setting: Read More Button Text
	$wp_customize->add_setting( 'myboutique_readmore_text' , array(
	    'default'     => 'Read More',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Control: Read More Button Text
   $wp_customize->add_control( 'myboutique_readmore_text',
		array(
			'settings'		=> 'myboutique_readmore_text',
			'section'		=> 'myboutique_homepage_section',
			'type'			=> 'text',
			'label'			=> __( 'Read More Button Text', 'myboutique' ),
			'description'	=> __( 'Set the text to display on the read more button, e.g. "Continue Reading" or simply "Read More". Leave blank to not show the button at all.', 'myboutique' )
		)
	);

}
add_action( 'customize_register', 'myboutique_readmore_customize_register' );



/**
* (Google) Fonts Functionality

function myboutique_googlefonts_customize_register( $wp_customize ) {

   //* Add Customizer Setting: Title Google Font 
	$wp_customize->add_setting( 'title_font', array(
	    'default'     => 'open-sans',
	    'transport'   => 'refresh'
	) );

   //* Add Customizer Control: Title Google Font 
   $wp_customize->add_control( new GoogleFonts_Picker_Custom_Control( $wp_customize, 'title_font',
		array(
			'section'		=> 'myboutique_fonts_section',
			'label'			=> __( 'Title Font', 'myboutique' ),
		)
	));

   //* Add Customizer Setting: Body Google Font
	$wp_customize->add_setting( 'body_font', array(
	    'default'     => 'lora',
	    'transport'   => 'refresh'
	) );

   //* Add Customizer Control: Body Google Font
   $wp_customize->add_control( new GoogleFonts_Picker_Custom_Control( $wp_customize, 'body_font',
		array(
			'section'		=> 'myboutique_fonts_section',
			'label'			=> __( 'Body Font', 'myboutique' ),
		)
	));

   //* Add Customizer Setting: Menu Google Font
	$wp_customize->add_setting( 'menu_font', array(
	    'default'     => 'montserrat',
	    'transport'   => 'refresh'
	) );

   //* Add Customizer Control: Menu Google Font
   $wp_customize->add_control( new GoogleFonts_Picker_Custom_Control( $wp_customize, 'menu_font',
		array(
			'section'		=> 'myboutique_fonts_section',
			'label'			=> __( 'Menu & Button Font', 'myboutique' ),
		)
	));

}
add_action( 'customize_register', 'myboutique_googlefonts_customize_register' );
*/



/*
* Add support for the custom footer logo and more settings
*/
function myboutique_footer_customize_register( $wp_customize ) {

	//* Add Customizer Setting: Footer Logo Upload
	$wp_customize->add_setting( 'myboutique_footer_logo' , array(
	    'default'     => 0,
	    'transport'   => 'refresh',
	    'sanitize_callback'	=> 'myboutique_sanitize_image'
	) );

	// Add Customizer control: Footer Logo Upload
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'myboutique_footer_logo', array(
       	'label'    => __( 'Upload a logo for the footer and sticky navigation', 'myboutique' ),
        'section'  => 'myboutique_footer_nav_section',
        'settings' => 'myboutique_footer_logo',
    ) ) );

	// Footer Credit/Copyright Text
    $wp_customize->add_setting( 'myboutique_footer_description' , array(
	    'default'     => '',
	    'transport'   => 'refresh',
	    'sanitize_callback' => 'sanitize_text_field'
	) );

   //* Add Customizer Controls
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'myboutique_footer_description', array(
		'label'        => __( 'Footer site description', 'mp' ),
		'description'	=> __( 'The theme will automatically fetch your blog description if this field is empty.', 'myboutique' ),
		'type' => 'textarea',
		'section'    => 'myboutique_footer_nav_section',
		'settings'   => 'myboutique_footer_description',
	) ) );
}
add_action( 'customize_register', 'myboutique_footer_customize_register' );
