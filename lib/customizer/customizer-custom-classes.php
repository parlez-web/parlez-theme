<?php
/**
 * A class to create a dropdown for all categories in your wordpress site
 */
add_action( 'customize_register', 'cosmo_customize_classes_register' );

function cosmo_customize_classes_register($wp_customize) {
 class Category_Dropdown_Custom_Control extends WP_Customize_Control {
    private $cats = false;
    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->cats = get_categories($options);
        parent::__construct( $manager, $id, $args );
    }
    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
       {
            if(!empty($this->cats))
            {
                ?>
                    <label>
                      <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
                      <select <?php $this->link(); ?>>
                           <?php
                                foreach ( $this->cats as $cat )
                                {
                                    printf('<option value="%s" %s>%s</option>', $cat->term_id, selected($this->value(), $cat->term_id, false), $cat->name);
                                }
                           ?>
                      </select>
                    </label>
                <?php
            }
       }
 }
}
/**
 * Select sanitization callback example.
 *
 * - Sanitization: select
 * - Control: select, radio
 * 
 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
 * as a slug, and then validates `$input` against the choices defined for the control.
 * 
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function cosmo_sanitize_select( $input, $setting ){
         
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);
 
    //get the list of possible select options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                             
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
             
}

/**
 * Checkbox sanitization callback example.
 * 
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function cosmo_sanitize_checkbox( $checked ) {
  // Boolean check.
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Number sanitization callback example.
 *
 * - Sanitization: number_absint
 * - Control: number
 * 
 * Sanitization callback for 'number' type text inputs. This callback sanitizes `$number`
 * as an absolute integer (whole number, zero or greater).
 * 
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int Sanitized number; otherwise, the setting default.
 */
function cosmo_sanitize_number_absint( $number, $setting ) {
  // Ensure $number is an absolute integer (whole number, zero or greater).
  $number = absint( $number );
  
  // If the input is an absolute integer, return it; otherwise, return the default
  return ( $number ? $number : $setting->default );
}


/**
 * Image sanitization callback example.
 *
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default.
 *
 * - Sanitization: image file extension
 * - Control: text, WP_Customize_Image_Control
 * 
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */
function cosmo_sanitize_image( $image, $setting ) {
  /*
   * Array of valid image file types.
   *
   * The array includes image mime types that are included in wp_get_mime_types()
   */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
  // Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
  // If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}


/**
 * HEX Color sanitization callback example.
 *
 * - Sanitization: hex_color
 * - Control: text, WP_Customize_Color_Control
 * 
 * Note: sanitize_hex_color_no_hash() can also be used here, depending on whether
 * or not the hash prefix should be stored/retrieved with the hex color value.
 * 
 * @see sanitize_hex_color() https://developer.wordpress.org/reference/functions/sanitize_hex_color/
 * @link sanitize_hex_color_no_hash() https://developer.wordpress.org/reference/functions/sanitize_hex_color_no_hash/
 *
 * @param string               $hex_color HEX color to sanitize.
 * @param WP_Customize_Setting $setting   Setting instance.
 * @return string The sanitized hex color if not null; otherwise, the setting default.
 */
function cosmo_sanitize_hex_color( $hex_color, $setting ) {
  // Sanitize $input as a hex value without the hash prefix.
  $hex_color = sanitize_hex_color( $hex_color );
  
  // If $input is a valid hex value, return it; otherwise, return the default.
  return ( ! is_null( $hex_color ) ? $hex_color : $setting->default );
}