<?php

/**
 * WordPress Widget Boilerplate
 *
 * The WordPress Widget Boilerplate is an organized, maintainable boilerplate for building widgets using WordPress best practices.
 *
 * @package   Thumbnails_Widgets
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

class Myboutique_Thumbnails_Widget extends WP_Widget {
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
    protected $widget_slug = 'thumbnails-widget';
	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {
		// load plugin text domain
		add_action( 'init', array( $this, 'myboutique' ) );		
		// TODO: update description
		parent::__construct(
			$this->get_widget_slug(),
			__( 'MBT Thumbnails Widget', $this->get_widget_slug() ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'Show three thumbnail images with links to categories, pages or external sites.', $this->get_widget_slug() )
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
	   
	   $image1 = ! empty( $instance['image-1'] ) ? $instance['image-1'] : '';
	   $button_text1 = ! empty( $instance['button_text-1'] ) ? $instance['button_text-1'] : '';
	   $button_link1 = ! empty( $instance['button_link-1'] ) ? $instance['button_link-1'] : '';
	   $image2 = ! empty( $instance['image-2'] ) ? $instance['image-2'] : '';
	   $button_text2 = ! empty( $instance['button_text-2'] ) ? $instance['button_text-2'] : '';
	   $button_link2 = ! empty( $instance['button_link-2'] ) ? $instance['button_link-2'] : '';
	   $image3 = ! empty( $instance['image-3'] ) ? $instance['image-3'] : '';
	   $button_text3 = ! empty( $instance['button_text-3'] ) ? $instance['button_text-3'] : '';
	   $button_link3 = ! empty( $instance['button_link-3'] ) ? $instance['button_link-3'] : '';
	 
	   $before_widget = str_replace('class="', 'class="posts-widget', $args["before_widget"]);

	   ob_start();
	   echo $before_widget;

	   echo '<div class="widget-content small-width">';

	   if (!empty($title)) {
	   	echo $args['before_title'] . $title . $args['after_title'];
	   }
	   
	   ?>

	   <div class="thumbnails-row">
	   		<div class="thumbnail" style="background-image: url(<?php echo $image1 ?>)">
	   			<p><a href="<?php echo esc_url($button_link1) ?>"><?php echo $button_text1 ?></a></p>
	   		</div>
	   		<div class="thumbnail" style="background-image: url(<?php echo $image2 ?>)">
	   			<p><a href="<?php echo esc_url($button_link2) ?>"><?php echo $button_text2 ?></a></p>
	   		</div>
	   		<div class="thumbnail" style="background-image: url(<?php echo $image3 ?>)">
	   			<p><a href="<?php echo esc_url($button_link3) ?>"><?php echo $button_text3 ?></a></p>
	   		</div>
	   </div>

	   <?php

	   echo '</div>';

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
	   
	   $instance['image-1'] = ( ! empty( $new_instance['image-1'] ) ) ? $new_instance['image-1'] : '';
	   $instance['button_text-1'] =  strip_tags($new_instance['button_text-1']);
	   $instance['button_link-1'] = strip_tags($new_instance['button_link-1']);

	   $instance['image-2'] = ( ! empty( $new_instance['image-2'] ) ) ? $new_instance['image-2'] : '';
	   $instance['button_text-2'] =  strip_tags($new_instance['button_text-2']);
	   $instance['button_link-2'] = strip_tags($new_instance['button_link-2']);

	   $instance['image-3'] = ( ! empty( $new_instance['image-3'] ) ) ? $new_instance['image-3'] : '';
	   $instance['button_text-3'] =  strip_tags($new_instance['button_text-3']);
	   $instance['button_link-3'] = strip_tags($new_instance['button_link-3']);

	   // Save instance of TinyMCE editor
	   $rand1 = ( ! empty( $new_instance['the_random_number1'] ) ) ? (int) $new_instance['the_random_number1'] : 0;

	   $instance['the_random_number1'] = $rand1;
	   $instance[ 'wp_editor_' . $rand1 ] = $new_instance[ 'wp_editor_' . $rand1 ];
	 
	   return $instance;

	}


	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {
	   $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'myboutique' );

	   $image1 = ! empty( $instance['image-1'] ) ? $instance['image-1'] : get_template_directory_uri() . '/lib/widgets/thumbnails-widget/no-image.PNG';
	   $image2 = ! empty( $instance['image-2'] ) ? $instance['image-2'] : get_template_directory_uri() . '/lib/widgets/thumbnails-widget/no-image.PNG';
	   $image3 = ! empty( $instance['image-3'] ) ? $instance['image-3'] : get_template_directory_uri() . '/lib/widgets/thumbnails-widget/no-image.PNG';

	   $button_link1 = ! empty ( $instance['button_link-1'] ) ? esc_url($instance['button_link-1']): '';
	   $button_text1 = ! empty( $instance['button_text-1'] ) ? esc_attr($instance['button_text-1']) : '';

	   $button_link2 = ! empty ( $instance['button_link-2'] ) ? esc_url($instance['button_link-2']): '';
	   $button_text2 = ! empty( $instance['button_text-2'] ) ? esc_attr($instance['button_text-2']) : '';

	   $button_link3 = ! empty ( $instance['button_link-3'] ) ? esc_url($instance['button_link-3']): '';
	   $button_text3 = ! empty( $instance['button_text-3'] ) ? esc_attr($instance['button_text-3']) : '';

	   $rand1 = ! empty( $instance['the_random_number1'] ) ? (int) $instance['the_random_number1'] : 0;
	   $editor_content1 = ! empty( $instance[ 'wp_editor_' . $rand1 ] ) ? $instance[ 'wp_editor_' . $rand1 ] : 'Hello World';
	  
	   ?>

	   <!-- Title -->
	   <p>
	      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
	      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	   </p>

	   <hr/>

	   	<div class="toggle-content">
		   	<h3>Thumbnail 1</h3>
		   	<span class="dashicons dashicons-arrow-down"></span>
		</div>
	   <div class="toggle thumbnail-1">
	   	
		  <!-- Image 1 -->
		   <p>
		      <label for="<?php echo $this->get_field_id( 'image-1' ); ?>"><?php _e( 'Image 1:' ); ?></label>
		      <!-- -->
		      <img src="<?php echo esc_url( $image1 ); ?>" class="preview">
		      <input class="widefat selection" id="<?php echo $this->get_field_id( 'image-1' ); ?>" name="<?php echo $this->get_field_name( 'image-1' ); ?>" type="text" value="<?php echo $image1 ?>" />
		      <button class="upload_image button button-primary">Upload Image</button>
		   </p>

		   <!-- Button Text 1 -->
		   <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_text-1' ) ); ?>">
					<?php esc_html_e( 'Button 1 Text:', 'mps' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_text-1' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_text-1' ) ?>"
			       value="<?php echo $button_text1 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>

			<?php
			// var_dump($editor_content1);

			// // start wp_editor
		 //    $rand1    = rand( 0, 999 );
		 //    $ed_id   = $this->get_field_id( 'wp_editor_' . $rand1 );
		 //    $ed_name = $this->get_field_name( 'wp_editor_' . $rand1 );

		 //    $content   = $editor_content1;
		 //    $editor_id = $ed_id;

		 //      $settings = array(
		 //      'media_buttons' => false,
		 //      'textarea_rows' => 5,
		 //      'textarea_name' => $ed_name,
		 //      'teeny'         => true,
		 //    );

		 //    wp_editor( $content, $editor_id, $settings );
			// // end wp_editor

			// printf(
			//   '<input type="hidden" id="%s" name="%s" value="%d" />',
			//   $this->get_field_id( 'the_random_number1' ),
			//   $this->get_field_name( 'the_random_number1' ),
			//   $rand1
			// );
			?>

			<!-- Button Link 1 -->
			<p>
				<label for="<?php echo $this->get_field_id( 'button_link-1' ) ?>">
					<?php esc_html_e( 'Button 1 Link:', 'mps' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_link-1' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_link-1' ) ?>"
			       value="<?php echo $button_link1 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>

	   </div>


		<hr/>

		<div class="toggle-content">
		   	<h3>Thumbnail 2</h3>
		   	<span class="dashicons dashicons-arrow-down"></span>
		</div>
	   <div class="toggle thumbnail-2">


			<!-- Image 2 -->
		   <p>
		      <label for="<?php echo $this->get_field_id( 'image-2' ); ?>"><?php _e( 'Image 2:' ); ?></label>
		      <!-- -->
		      <img src="<?php echo esc_url( $image2 ); ?>" class="preview">
		      <input class="widefat selection" id="<?php echo $this->get_field_id( 'image-2' ); ?>" name="<?php echo $this->get_field_name( 'image-2' ); ?>" type="text" value="<?php echo $image2 ?>" />
		      <button class="upload_image button button-primary">Upload Image</button>
		   </p>

		   <!-- Button Text 2 -->
		   <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_text-2' ) ); ?>">
					<?php esc_html_e( 'Button 2 Text:', 'mps' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_text-2' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_text-2' ) ?>"
			       value="<?php echo $button_text2 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>

			<!-- Button Link 2 -->
			<p>
				<label for="<?php echo $this->get_field_id( 'button_link-2' ) ?>">
					<?php esc_html_e( 'Button 2 Link:', 'mps' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_link-2' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_link-2' ) ?>"
			       value="<?php echo $button_link2 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>
		</div>

		<hr/>

		<div class="toggle-content">
		   	<h3>Thumbnail 3</h3>
		   	<span class="dashicons dashicons-arrow-down"></span>
		</div>

	   <div class="toggle thumbnail-3">

			<!-- Image 3 -->
		   <p>
		      <label for="<?php echo $this->get_field_id( 'image-3' ); ?>"><?php _e( 'Image 3:' ); ?></label>
		      <!-- -->
		      <img src="<?php echo esc_url( $image3 ); ?>" class="preview">
		      <input class="widefat selection" id="<?php echo $this->get_field_id( 'image-3' ); ?>" name="<?php echo $this->get_field_name( 'image-3' ); ?>" type="text" value="<?php echo $image3 ?>" />
		      <button class="upload_image button button-primary">Upload Image</button>
		   </p>

		   <!-- Button Text 3 -->
		   <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_text-3' ) ); ?>">
					<?php esc_html_e( 'Button 3 Text:', 'mps' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_text-3' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_text-3' ) ?>"
			       value="<?php echo $button_text3 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>

			<!-- Button Link 3 -->
			<p>
				<label for="<?php echo $this->get_field_id( 'button_link-3' ) ?>">
					<?php esc_html_e( 'Button 3 Link:', 'mps' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id( 'button_link-3' ) ?>"
			       name="<?php echo $this->get_field_name( 'button_link-3' ) ?>"
			       value="<?php echo $button_link3 ?>"
			       type="text"
			       class="widefat"
			/>
			</p>
		</div>

	   <?php
	}

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/
	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function myboutique() {
		// TODO be sure to change 'myboutique-thumbnails-widget' to the name of *your* plugin
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
		wp_enqueue_style( $this->get_widget_slug().'-admin-styles', get_template_directory_uri() . '/lib/widgets/thumbnails-widget/css/admin.css' );
	} // end register_admin_styles



	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {
		wp_enqueue_script( $this->get_widget_slug().'-admin-script', get_template_directory_uri() . '/lib/widgets/thumbnails-widget/js/admin.js', array('jquery') );
	} // end register_admin_scripts



	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {
		wp_enqueue_style( $this->get_widget_slug().'-widget-styles', get_template_directory_uri() . '/lib/widgets/thumbnails-widget/css/widget.css' );
	} // end register_widget_styles



	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_widget_scripts() {
		wp_enqueue_script( $this->get_widget_slug().'-script', '/js/widget.js', array('jquery') );
	} // end register_widget_script


} // end class

/*
* Register the widget.
*/
function myboutique_load_thumbnails_widget() {
	register_widget( 'Myboutique_Thumbnails_Widget' );
}


// TODO: Remember to change 'Widget_Name' to match the class name definition
add_action( 'widgets_init', 'myboutique_load_thumbnails_widget' );
// Hooks fired when the Widget is activated and deactivated
register_activation_hook( __FILE__, array( 'MBT Thumbnails Widget', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'MBT Thumbnails Widget', 'deactivate' ) );


