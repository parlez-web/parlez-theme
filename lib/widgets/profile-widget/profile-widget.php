<?php

/**
 * WordPress Widget Boilerplate
 *
 * The WordPress Widget Boilerplate is an organized, maintainable boilerplate for building widgets using WordPress best practices.
 *
 * @package   Widget_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 *
 */
 
 // Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}
// TODO: change 'Widget_Name' to the name of your plugin
class Myboutique_Profile_Widget extends WP_Widget {
    /**
     *
     * Unique identifier for your widget.
     *
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * widget file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $widget_slug = 'mps-profile-widget';
	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {
		// load plugin text domain
		add_action( 'init', array( $this, 'mps' ) );		
		// TODO: update description
		parent::__construct(
			$this->get_widget_slug(),
			__( 'myboutique Profile Widget', $this->get_widget_slug() ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'Profile Widget for Sidebar of myboutique Theme.', $this->get_widget_slug() )
			)
		);
		// Register admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
		// // Register site styles and scripts
		// add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
		// add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );
		// Refreshing the widget's cached output with each new post
		add_action( 'save_post',    array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	} // end constructor


    /**
     * Return the widget slug.
     *
     * @since    1.0.0
     *
     * @return    Plugin slug variable.
     */
    public function get_widget_slug() {
        return $this->widget_slug;
    }


	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/
	/**
	 * Outputs the content of the widget.
	 *
	 * @param array args  The array of form elements
	 * @param array instance The current instance of the widget
	 */
	public function widget( $args, $instance ) {
	   // Our variables from the widget settings
	   $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Default title', 'mps' ) : $instance['title'] );
	   $image = ! empty( $instance['image'] ) ? $instance['image'] : '';
	   $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
	   $button_text = ! empty( $instance['button_text'] ) ? $instance['button_text'] : '';
	   $button_link = ! empty( $instance['button_link'] ) ? $instance['button_link'] : '';
	 
	   $before_widget = str_replace('class="', 'class="about-widget ', $args["before_widget"]);

	   ob_start();
	   echo $before_widget;
	   
	   ?>

	   <div class="widget-content">
	 
		   <?php if($image): ?>
		      <div class="about-image"><img src="<?php echo esc_url($image); ?>" alt=""></div>
		   <?php endif; ?>

		   <div class="about-content light-bg">

		   		<?php 
				if ( ! empty( $instance['title'] ) ) {
				    echo $args['before_title'] . $title . $args['after_title'];
				}
		   		?>

				<?php if($description) : ?>
					<p class='about-text'><?php echo $description ?></p>
				<?php endif; ?>

				<?php if($button_text && $button_link) : ?>
					<a href='<?php echo esc_url($button_link) ?>'><p class="dark"><?php echo $button_text ?> >></p></a>
				<?php endif; ?>

			</div> 

		</div>
	 
	   <?php
	   echo $args['after_widget'];

	   ob_end_flush();
	}
	
	
	public function flush_widget_cache() {
    	wp_cache_delete( $this->get_widget_slug(), 'widget' );
	}


	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param array new_instance The new instance of values to be generated via the update.
	 * @param array old_instance The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {
	   // $instance = array();
	   $instance = $old_instance;

	   $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	   $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
	   $instance['description'] =  strip_tags($new_instance['description']);
	   $instance['button_text'] =  strip_tags($new_instance['button_text']);
	   $instance['button_link'] = strip_tags($new_instance['button_link']);

	   return $instance;

	}


	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {
	   $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'mps' );
	   $image = ! empty( $instance['image'] ) ? $instance['image'] : get_template_directory_uri() . '/lib/widgets/profile-widget/no-image.PNG';

	   $description = ! empty ( $instance['description']) ? esc_textarea($instance['description']) : '';
	   $button_link = ! empty ( $instance['button_link'] ) ? esc_attr($instance['button_link']): '';
	   $button_text = ! empty( $instance['button_text'] ) ? esc_attr($instance['button_text']) : '';
	  

	   ?>

	   <!-- Title -->
	   <p>
	      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
	      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	   </p>

	   <!-- Image -->
	   <p>
	      <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image:' ); ?></label>
	      <!-- -->
	      <img src="<?php echo esc_url( $image ); ?>" class="preview">
	      <input class="widefat selection" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo $image ?>" />
	      <button id="upload_image" class="upload_image button button-primary">Upload Image</button>
	   </p>


	   <!-- Description -->
	   <p>
			<label for="<?php echo $this->get_field_id( 'description' ) ?>">
				<?php esc_html_e( 'About Text:', 'mps' ); ?>
			</label>
			<textarea id="<?php echo $this->get_field_id( 'description' ) ?>" name="<?php echo $this->get_field_name( 'description' ) ?>" class="widefat"><?php echo $description ?></textarea>
		</p>

	   <!-- Button Text -->
	   <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>">
				<?php esc_html_e( 'About Page Button Text:', 'mps' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'button_text' ) ?>"
		       name="<?php echo $this->get_field_name( 'button_text' ) ?>"
		       value="<?php echo $button_text ?>"
		       type="text"
		       class="widefat"
		/>
		</p>

		<!-- Button Link -->
		<p>
			<label for="<?php echo $this->get_field_id( 'button_link' ) ?>">
				<?php esc_html_e( 'About Page Button Link:', 'mps' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'button_link' ) ?>"
		       name="<?php echo $this->get_field_name( 'button_link' ) ?>"
		       value="<?php echo $button_link ?>"
		       type="text"
		       class="widefat"
		/>
		</p>


	   <?php
	}

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/
	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function mps() {
		// TODO be sure to change 'mps-profile-widget' to the name of *your* plugin
		load_plugin_textdomain( $this->get_widget_slug(), false, dirname( plugin_basename( __FILE__ ) ) . 'lang/' );
	} // end widget_textdomain


	/**
	 * Fired when the plugin is activated.
	 *
	 * @param  boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		// TODO define activation functionality here
	} // end activate



	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public static function deactivate( $network_wide ) {
		// TODO define deactivation functionality here
	} // end deactivate



	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {
		wp_enqueue_style( $this->get_widget_slug().'-admin-styles', get_template_directory_uri() . '/lib/widgets/profile-widget/css/admin.css' );
	} // end register_admin_styles



	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {
		wp_enqueue_script( $this->get_widget_slug().'-admin-script', get_template_directory_uri() . '/lib/widgets/profile-widget/js/admin.js', array('jquery') );
	} // end register_admin_scripts



	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {
		wp_enqueue_style( $this->get_widget_slug().'-widget-styles', get_template_directory_uri() . '/lib/widgets/profile-widget/css/widget.css' );
	} // end register_widget_styles



	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_widget_scripts() {
		wp_enqueue_script( $this->get_widget_slug().'-script', '/js/widget.js', array('jquery') );
	} // end register_widget_script


	/**
	 * Registers Widget.
	 */
	public function register_the_widget() {
		register_widget("MPS_Profile_Widget");
	} // end register_widget_script

} // end class


/*
* Register the widget.
*/
function myboutique_load_profile_widget() {
	register_widget( 'Myboutique_Profile_Widget' );
}

// TODO: Remember to change 'Widget_Name' to match the class name definition
add_action( 'widgets_init', 'myboutique_load_profile_widget' );
// Hooks fired when the Widget is activated and deactivated
// TODO: Remember to change 'Widget_Name' to match the class name definition
register_activation_hook( __FILE__, array( 'MPS Profile Widget', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'MPS Profile Widget', 'deactivate' ) );


