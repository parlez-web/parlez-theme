<?php
/**
 * Merlin WP configuration file.
 *
 * @package   Merlin WP
 * @version   1.0.0
 * @link      https://merlinwp.com/
 * @author    Rich Tabor, from ThemeBeans.com & the team at ProteusThemes.com
 * @copyright Copyright (c) 2018, Merlin WP of Inventionn LLC
 * @license   Licensed GPLv3 for Open Source Use
 */
if ( ! class_exists( 'Merlin' ) ) {
	return;
}
/**
 * Set directory locations, text strings, and settings.
 */
$wizard = new Merlin(
	$config = array(
		'directory'            => 'lib/merlin', // Location / directory where Merlin WP is placed in your theme.
		'merlin_url'           => 'onboarding', // The wp-admin page slug where Merlin WP loads.
		'parent_slug'          => 'themes.php', // The wp-admin parent page slug for the admin menu item.
		'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
		'child_action_btn_url' => 'https://codex.wordpress.org/child_themes', // URL for the 'child-action-link'.
		'dev_mode'             => true, // Enable development mode for testing.
		'license_step'         => false, // EDD license activation step.
		'license_required'     => false, // Require the license activation step.
		'license_help_url'     => '', // URL for the 'license-tooltip'.
		'edd_remote_api_url'   => '', // EDD_Theme_Updater_Admin remote_api_url.
		'edd_item_name'        => '', // EDD_Theme_Updater_Admin item_name.
		'edd_theme_slug'       => '', // EDD_Theme_Updater_Admin item_slug.
		'ready_big_button_url' => '/', // Link for the big button on the ready step.
	),
	$strings = array(
		'admin-menu'               => esc_html__( 'Theme Setup', 'myboutique' ),
		/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
		'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'myboutique' ),
		'return-to-dashboard'      => esc_html__( 'Return to the dashboard', 'myboutique' ),
		'ignore'                   => esc_html__( 'Disable this wizard', 'myboutique' ),
		'btn-skip'                 => esc_html__( 'Skip', 'myboutique' ),
		'btn-next'                 => esc_html__( 'Next', 'myboutique' ),
		'btn-start'                => esc_html__( 'Start', 'myboutique' ),
		'btn-no'                   => esc_html__( 'Cancel', 'myboutique' ),
		'btn-plugins-install'      => esc_html__( 'Install', 'myboutique' ),
		'btn-child-install'        => esc_html__( 'Install', 'myboutique' ),
		'btn-content-install'      => esc_html__( 'Install', 'myboutique' ),
		'btn-import'               => esc_html__( 'Import', 'myboutique' ),
		'btn-license-activate'     => esc_html__( 'Activate', 'myboutique' ),
		'btn-license-skip'         => esc_html__( 'Later', 'myboutique' ),
		/* translators: Theme Name */
		'license-header%s'         => esc_html__( 'Activate %s', 'myboutique' ),
		/* translators: Theme Name */
		'license-header-success%s' => esc_html__( '%s is Activated', 'myboutique' ),
		/* translators: Theme Name */
		'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'myboutique' ),
		'license-label'            => esc_html__( 'License key', 'myboutique' ),
		'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'myboutique' ),
		'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'myboutique' ),
		'license-tooltip'          => esc_html__( 'Need help?', 'myboutique' ),
		/* translators: Theme Name */
		'welcome-header%s'         => esc_html__( 'Welcome to %s', 'myboutique' ),
		'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'myboutique' ),
		'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'myboutique' ),
		'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'myboutique' ),
		'child-header'             => esc_html__( 'Install Child Theme', 'myboutique' ),
		'child-header-success'     => esc_html__( 'You\'re good to go!', 'myboutique' ),
		'child'                    => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'myboutique' ),
		'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'myboutique' ),
		'child-action-link'        => esc_html__( 'Learn about child themes', 'myboutique' ),
		'child-json-success%s'     => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'myboutique' ),
		'child-json-already%s'     => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'myboutique' ),
		'plugins-header'           => esc_html__( 'Install Plugins', 'myboutique' ),
		'plugins-header-success'   => esc_html__( 'You\'re up to speed!', 'myboutique' ),
		'plugins'                  => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'myboutique' ),
		'plugins-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'myboutique' ),
		'plugins-action-link'      => esc_html__( 'Advanced', 'myboutique' ),
		'import-header'            => esc_html__( 'Import Content', 'myboutique' ),
		'import'                   => sprintf( 'Let\'s import content to your website, to help you get familiar with the theme. See all <a href="%s">Theme Demos</a>.', 'https://goo.gl' ),
		'import-action-link'       => esc_html__( 'Advanced', 'myboutique' ),
		'ready-header'             => esc_html__( 'All done. Have fun!', 'myboutique' ),
		/* translators: Theme Author */
		'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'myboutique' ),
		'ready-action-link'        => esc_html__( 'Extras', 'myboutique' ),
		'ready-big-button'         => esc_html__( 'View your website', 'myboutique' ),
		'ready-link-1'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://wordpress.org/support/', esc_html__( 'Explore WordPress', 'myboutique' ) ),
		'ready-link-2'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://themebeans.com/contact/', esc_html__( 'Get Theme Support', 'myboutique' ) ),
		'ready-link-3'             => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start Customizing', 'myboutique' ) ),
	)
);

function merlin_import_files() {
	return array(
		array(
			'import_file_name'           => '1 - Fashion Blog w/ sidebar',
			'import_file_url'            => 'http://www.your_domain.com/merlin/demo-content.xml',
			'import_widget_file_url'     => 'http://www.your_domain.com/merlin/widgets.json',
			'import_customizer_file_url' => 'http://www.your_domain.com/merlin/customizer.dat',
			'import_preview_image_url'   => 'https://www.cameraegg.org/wp-content/uploads/2013/03/Canon-EOS-100D-Rebel-SL1-Sample-Image-1024x682.jpg',
			'import_notice'              => __( 'Demo 1 - Fashion Blog with Sidebar', 'your-textdomain' ),
			'preview_url'                => 'http://www.your_domain.com/my-demo-1',
		),
		array(
			'import_file_name'           => '2 - Lifestyle Blog (Fullwidth)',
			'import_file_url'            => 'http://www.your_domain.com/merlin/demo-content.xml',
			'import_widget_file_url'     => 'http://www.your_domain.com/merlin/widgets.json',
			'import_customizer_file_url' => 'http://www.your_domain.com/merlin/customizer.dat',
			'import_preview_image_url'   => 'https://www.cameraegg.org/wp-content/uploads/2013/03/Canon-EOS-100D-Rebel-SL1-Sample-Image-1024x682.jpg',
			'import_notice'              => __( 'Demo 2 - Lifestyle Blog with Sidebar', 'your-textdomain' ),
			'preview_url'                => 'http://www.your_domain.com/my-demo-1',
		),
	);
}
add_filter( 'merlin_import_files', 'merlin_import_files' );