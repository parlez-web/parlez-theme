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

class cosmo_Posts_Widget extends WP_Widget {
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
    protected $widget_slug = 'posts-widget';
	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {
		// load plugin text domain
		add_action( 'init', array( $this, 'cosmo' ) );		
		// TODO: update description
		parent::__construct(
			$this->get_widget_slug(),
			__( 'cosmo Posts Widget', $this->get_widget_slug() ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'Show featured posts in different theme locations.', $this->get_widget_slug() )
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
	   $title = ! empty( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
	   $number = ! empty( $instance['number'] ) ? $instance['number'] : 4;
	   $type = ! empty( $instance['type'] ) ? $instance['type'] : '';
	   $category = ! empty( $instance['category'] ) ? $instance['category'] : '';
	 
	   $before_widget = str_replace('class="', 'class="posts-widget', $args["before_widget"]);

	   ob_start();
	   echo $before_widget;

	   if (!empty($title)) {
	   	echo $args['before_title'] . $title . $args['after_title'];
	   }
	   
	   	if($type == 'category' && !empty($category)) {
	   		$cat_slug = get_cat_name( $category );

	   		cosmo_featured_row('featured-small', $number, $cat_slug);

	  	} else if ($type == 'popular') {
	  		cosmo_popular_posts('featured-small', $number);
	  	} else if ($type == 'featured') {
	  		cosmo_featured_row('featured-small', $number, 'featured-small');
	  	}

	  	// No category set (if type is category)
	  	if($type == 'category' && empty($category)) {
	  		echo 'Please specify the category in the widget settings.';
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
	   // $instance = array();
	   $instance = $old_instance;

	   $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	   $instance['number'] =  strip_tags($new_instance['number']);
	   $instance['type'] =  strip_tags($new_instance['type']);
	   $instance['category'] = strip_tags($new_instance['category']);
	 
	   return $instance;

	}


	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {
	   $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'cosmo' );

	   $number = ! empty ( $instance['number']) ? $instance['number'] : 4;
	   $type = ! empty ( $instance['type'] ) ? esc_attr($instance['type']): 'featured';
	   $category = ! empty( $instance['category'] ) ? esc_attr($instance['category']) : '';
	  
	   ?>

	   <!-- Title -->
	   <p>
	      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
	      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	   </p>


	   <!-- Type of posts -->
	   <p>
			<label for="<?php echo $this->get_field_id( 'type' ) ?>">
				<?php esc_html_e( 'Which kind of posts would you like to show?', 'cosmo' ); ?>
			</label>
			
			<select class="widefat" id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">

               <option value="featured" <?php selected( $type, 'featured');?> >Featured Posts</option>
               <option value="category" <?php selected( $type, 'category');?>>Category Posts</option>
               <option value="popular" <?php selected( $type, 'popular');?>>Popular Posts</option>

            </select>
		</p>

	   <!-- Category (if category posts is set) -->
		<p>

			<label for="<?php echo $this->get_field_id( 'type' ) ?>">
				<?php esc_html_e( 'Category', 'cosmo' ); ?>
			</label>

		<?php 
	    $args = array(
	        'name'             => $this->get_field_name('category'),
	        'show_option_none' => __( 'Select a Category' ),
	        'show_count'       => 0,
	        'orderby'          => 'name',
	        'echo'             => 0,
	        'selected'         => $category,
	        'class'            => 'widefat'
	    );
	    
	    echo wp_dropdown_categories($args);

        ?>
    </p>

		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ) ?>">
				<?php esc_html_e( 'Number of Posts to show', 'cosmo' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'number' ) ?>"
		       name="<?php echo $this->get_field_name( 'number' ) ?>"
		       value="<?php echo $number ?>"
		       type="number"
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
	public function cosmo() {
		// TODO be sure to change 'cosmo-profile-widget' to the name of *your* plugin
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

} // end class


// TODO: Remember to change 'Widget_Name' to match the class name definition
add_action( 'widgets_init', create_function( '', 'register_widget("cosmo_Posts_Widget");' ) );
// Hooks fired when the Widget is activated and deactivated
// TODO: Remember to change 'Widget_Name' to match the class name definition
register_activation_hook( __FILE__, array( 'cosmo Posts Widget', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'cosmo Posts Widget', 'deactivate' ) );


