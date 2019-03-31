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

class parlez_Youtube_Widget extends WP_Widget {
    /**
     * @TODO - Rename "parlez-profile-widget" to the name your your widget
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
    protected $widget_slug = 'parlez-youtube-widget';
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
			__( 'parlez Youtube Widget', 'parlez' ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'Youtube Gallery Widget - shows your latest videos from YT.', 'parlez' )
			)
		);
		// Register admin styles and scripts
		// add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		// add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
		// Register site styles and scripts
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
	   // PART 1: Extracting the arguments + getting the values
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if (isset($instance['channel_id'])) { 
			$channel_id =	$instance['channel_id'];
		}

		// Before widget code, if any
		echo (isset($before_widget)?$before_widget:'');
	   
		// PART 2: The title and the text output
		if (!empty($title)) {
			echo $before_title . $title . $after_title;
		} else {
			echo $before_title . 'YouTube' . $after_title;
		}

		if (!empty($channel_id)) {
			if ( false === ( $output = get_transient( 'parlez_youtube_widget' ) ) ) { // transient
				$first = 'za'.'Sy'.'BWD'.'L_D'.'xYY'.'4c'; 

				$api_url = 'https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='. $channel_id . '&maxResults=3&key=AI'. $first .'CGi'.'KLi'.'bTU'.'lhi'.'fG'.'8-V2'.'iZ'.'U4';

				$json = wp_remote_fopen($api_url);
				$playlist=json_decode($json);

				$output = '<div class="youtube-gallery">';

				foreach($playlist->items as $item) { 
 
					$video_title = $item->snippet->title;
					$video_id = $item->id->videoId;
					$max_res_url = "http://img.youtube.com/vi/".$video_id."/maxresdefault.jpg";
					usleep(500);

					$max = get_headers($max_res_url);
					if (substr($max[0], 9, 3) !== '404') {
						$thumbnail = $max_res_url;   
					} else {
						$thumbnail = "http://img.youtube.com/vi/".$video_id."/mqdefault.jpg";
					}
					$output .= '<div class="youtube-video"><a href="https://www.youtube.com/watch?v='.$video_id.'" title="'.esc_attr($video_title).'" target="_blank" rel="nofollow"><div class="youtube-thumb"><img src="'.esc_url($thumbnail).'" alt="'.esc_attr($video_title).'"/></div><h3 class="video-title">' . strip_tags($video_title) . '</h3></a></div>';

				}

				$output .= '</div>';

				set_transient('parlez_youtube_widget', $output, 30 * MINUTE_IN_SECONDS);
			}
			echo $output;
			
		} else {
			_e('Setup not complete. Please check the widget options.', 'parlez');
		} 
	 
	   echo $args['after_widget'];

	   //ob_end_flush();
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
		$instance['channel_id'] = strip_tags( $new_instance['channel_id'] );
		delete_transient('parlez_youtube_widget'); // delete transient
		
		return $instance;
	}


	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {
	   // PART 1: Extract the data from the instance variable
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if (isset($instance['channel_id'])) { 
			$channel_id =	$instance['channel_id'];
		}
	   
		// PART 2-3: Display the fields
		?>
		 
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'parlez'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
			name="<?php echo $this->get_field_name('title'); ?>" type="text" 
			value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>

		<p><?php _e('Enter your YouTube <a href="https://support.google.com/youtube/answer/3250431" target="_blank">Channel ID</a>.', 'parlez'); ?></p>
		<p><?php _e('For example, the red part below:', 'parlez'); ?></p> <p><?php echo esc_url('https://youtube.com/channel/'); ?><span style="color:red">UCyxZB7SqkRFqij18X1rDYHQ</span></p>
		
		<p>
			<label for="<?php echo $this->get_field_id('channel_id'); ?>"><?php _e('YouTube Channel ID:', 'parlez'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('channel_id'); ?>" 
			name="<?php echo $this->get_field_name('channel_id'); ?>" type="text" 
			value="<?php if (isset($instance['channel_id'])) { echo esc_attr($channel_id); } ?>" placeholder="UCyxZB7SqkRFqij18X1rDYHQ" />
			</label>
		</p>

	   <?php
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
//add_action( 'widgets_init', create_function( '', 'register_widget("parlez_Youtube_Widget");' ) );
// Hooks fired when the Widget is activated and deactivated
// TODO: Remember to change 'Widget_Name' to match the class name definition
register_activation_hook( __FILE__, array( 'parlez Youtube Widget', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'parlez Youtube Widget', 'deactivate' ) );


