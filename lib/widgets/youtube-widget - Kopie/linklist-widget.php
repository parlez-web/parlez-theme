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

class parlez_LinkList_Widget extends WP_Widget {
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
    protected $widget_slug = 'parlez-linklist-widget';
	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {
		// load plugin text domain
		add_action( 'init', array( $this, 'parlez' ) );		
		// TODO: update description
		parent::__construct(
			$this->get_widget_slug(),
			__( 'parlez LinkList Widget', 'parlez' ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'Link List Widget - show your favorite blogs, websites or online shops. Great for affiliate links as well.', 'parlez' )
			)
		);
		// Register admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
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
	   // PART 1: Extracting the arguments + getting the values
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

		if (isset($instance['description'])) { 
			$description =	$instance['description'];
		}

		$links = empty($instance['links']) ? [] : $instance['links'];

		// Before widget code, if any
		echo (isset($before_widget)?$before_widget:'');
	   
		// The title and links output
		if (!empty($title)) {
			echo $before_title . $title . $after_title;
		} else {
			echo $before_title . 'YouTube' . $after_title;
		}

		if(!empty($links)) {
			echo "Fennekin";
		}
	 
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
	   	$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['description'] = strip_tags( $new_instance['description'] );
		$instance['links'] = $new_instance['links'];
		
		return $instance;
	}


	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		// Extract the data from the instance variable
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );

		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if (isset($instance['description'])) { 
			$description =	$instance['description'];
		} else {
			$description = '';
		}

		$links = empty($instance['links']) ? array(0 => array('name' => '', 'link' => ''), 1 => array('name' => '', 'link' => ''), 2 => array('name' => '', 'link' => '')) : $instance['links'];
	  ?>
		 
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'parlez'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
			name="<?php echo $this->get_field_name('title'); ?>" type="text" 
			value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:', 'parlez'); ?>
			<textarea id="<?php echo $this->get_field_id('description'); ?>" 
			name="<?php echo $this->get_field_name('description'); ?>"><?php echo esc_attr($description); ?>" /></textarea>
			</label>
		</p>
	?>
	<?php 

		foreach($links as $key => $value) {

			$name = 'name';
			$linkKey = 'link';

			?>
			<h4>Link #<?php echo $key ?></h4>

			<label for="<?php echo $this->get_field_id('link') . '[' . $key . '][' . $name . ']'; ?>"><?php _e('Insert Name', 'parlez'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('link') . '[' . $key . '][' . $name . ']'; ?>" name="<?php echo $this->get_field_id('link') . '[' . $key . '][' . $name . ']'; ?>" value="<?php echo $value['name']; ?>" type="url"/>
			</label> 

			<label for="<?php echo $this->get_field_id('link') . '[' . $key . '][' . $linkKey . ']'; ?>"><?php _e('Insert Link', 'parlez'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('link') . '[' . $key . '][' . $linkKey . ']'; ?>" name="<?php echo $this->get_field_id('link') . '[' . $key . '][' . $linkKey . ']'; ?>" value="<?php echo $value['link']; ?>" type="url"/>
			</label> 

    <?php
		}
		
	?>
		<p>
			<span class="add-more">+</span>
		</p>

	   <?php

	   var_dump($links);
	}

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/
	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function parlez() {
		// TODO be sure to change 'parlez-profile-widget' to the name of *your* plugin
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
		wp_enqueue_style( $this->get_widget_slug().'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ) );
	} // end register_admin_styles



	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {
		wp_enqueue_script( $this->get_widget_slug().'-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array('jquery') );
	} // end register_admin_scripts



	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {
		wp_enqueue_style( $this->get_widget_slug().'-widget-styles', plugins_url( 'css/widget.css', __FILE__ ) );
	} // end register_widget_styles



	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_widget_scripts() {
		wp_enqueue_script( $this->get_widget_slug().'-script', plugins_url( 'js/widget.js', __FILE__ ), array('jquery') );
	} // end register_widget_scripts

} // end class


// TODO: Remember to change 'Widget_Name' to match the class name definition
add_action( 'widgets_init', create_function( '', 'register_widget("parlez_LinkList_Widget");' ) );
// Hooks fired when the Widget is activated and deactivated
// TODO: Remember to change 'Widget_Name' to match the class name definition
register_activation_hook( __FILE__, array( 'parlez LinkList Widget', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'parlez LinkList Widget', 'deactivate' ) );


