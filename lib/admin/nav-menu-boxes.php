<?php
/**
 * myboutique Admin Functionality
 *
 * @package myboutique
 */


if ( !class_exists('JMO_Custom_Nav')) {
    class JMO_Custom_Nav {
        public function add_nav_menu_meta_boxes() {
        	add_meta_box(
        		'wl_login_nav_link',
        		__('WishList Login'),
        		array( $this, 'nav_menu_link'),
        		'nav-menus',
        		'side',
        		'low'
        	);
        }
        
        public function nav_menu_link() {
        	$search_icon = "<i class='icon-search-bold'></i>";

        	?>
        	<div id="posttype-wl-login" class="posttypediv">
        		<div id="tabs-panel-wishlist-login" class="tabs-panel tabs-panel-active">
        			<ul id ="wishlist-login-checklist" class="categorychecklist form-no-clear">
        				<li>
        					<label class="menu-item-title">
        						<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> Login/Logout Link
        					</label>
        					<label class="menu-item-title">
        						<input type="checkbox" class="menu-item-checkbox" name="menu-item[3][menu-item-object-id]" value="3"> Search
        					</label>
        					<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
        					<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="Login">
        					<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="<?php bloginfo('wpurl'); ?>/wp-login.php">
        					<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="wl-login-pop">

        					<input type="hidden" class="menu-item-type" name="menu-item[3][menu-item-type]" value="custom">
        					<input type="hidden" class="menu-item-title" name="menu-item[3][menu-item-title]" value="<?php echo $search_icon ?>">
        					<input type="hidden" class="menu-item-url" name="menu-item[3][menu-item-url]" value="">
        					<input type="hidden" class="menu-item-classes" name="menu-item[3][menu-item-classes]" value="wl-login-pop">
        				</li>
        			</ul>
        		</div>
        		<p class="button-controls">
        			<span class="list-controls">
        				<a href="/wordpress/wp-admin/nav-menus.php?page-tab=all&amp;selectall=1#posttype-page" class="select-all">Select All</a>
        			</span>
        			<span class="add-to-menu">
        				<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-post-type-menu-item" id="submit-posttype-wl-login">
        				<span class="spinner"></span>
        			</span>
        		</p>
        	</div>
        <?php }
    }
}
$custom_nav = new JMO_Custom_Nav;
add_action('admin_init', array($custom_nav, 'add_nav_menu_meta_boxes'));



/**
 * Add menu meta box
 *
 * @param object $object The meta box object
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
 */
function custom_add_menu_meta_box( $object ) {
	add_meta_box( 'custom-menu-metabox', __( 'Social Media Icons' ), 'custom_menu_meta_box', 'nav-menus', 'side', 'default' );
	return $object;
}
add_filter( 'nav_menu_meta_box_object', 'custom_add_menu_meta_box', 10, 1);
/**
 * Displays a metabox for authors menu item.
 *
 * @global int|string $nav_menu_selected_id (id, name or slug) of the currently-selected menu
 *
 * @link https://core.trac.wordpress.org/browser/tags/4.5/src/wp-admin/includes/nav-menu.php
 * @link https://core.trac.wordpress.org/browser/tags/4.5/src/wp-admin/includes/class-walker-nav-menu-edit.php
 * @link https://core.trac.wordpress.org/browser/tags/4.5/src/wp-admin/includes/class-walker-nav-menu-checklist.php
 */
function custom_menu_meta_box(){
	global $nav_menu_selected_id;
	$walker = new Walker_Nav_Menu_Checklist();
	
	$current_tab = 'all';
	//$authors = get_users( array( 'orderby' => 'nicename', 'order' => 'ASC', 'who' => 'authors' ) );
	//$admins = array();
	// if ( isset( $_REQUEST['authorarchive-tab'] ) && 'admins' == $_REQUEST['authorarchive-tab'] ) {
	// 	$current_tab = 'admins';
	// }elseif ( isset( $_REQUEST['authorarchive-tab'] ) && 'all' == $_REQUEST['authorarchive-tab'] ) {
	// 	$current_tab = 'all';
	// }

	$icons = array(
		(object) array( 
			'url' => get_theme_mod('facebook_link', 'https://instagram.com'),
			'title' => '<i class="icon-instagram"></i> Instagram',
			'icon' => ''
		),
		(object) array(
			'url' => get_theme_mod('facebook_link', 'https://facebook.com'),
			'title' => '<i class="icon-facebook"></i> Facebook',
			'icon' => '<i class="icon-facebook"></i>'
		), 
	);

	$id = 1;

	/* set values to required item properties */
	foreach ( $icons as $icon ) {
		$icon->classes = array();
		$icon->type = 'custom';
		$icon->object_id = $id;
		$icon->object = 'custom';
		$icon->attr_title = $icon->title;
		$icon->db_id = $id;
		$icon->menu_item_parent = '';
		$icon->target = '';
		$icon->xfn = '';

		$id++;
	}

	$removed_args = array( 'action', 'customlink-tab', 'edit-menu-item', 'menu-item', 'page-tab', '_wpnonce' );
	?>
	<div id="authorarchive" class="categorydiv">
		
		<div id="tabs-panel-authorarchive-all" class="tabs-panel tabs-panel-view-all <?php echo ( 'all' == $current_tab ? 'tabs-panel-active' : 'tabs-panel-inactive' ); ?>">
			<ul id="authorarchive-checklist-all" class="categorychecklist form-no-clear">
			<?php
				echo walk_nav_menu_tree( array_map('wp_setup_nav_menu_item', $icons), 0, (object) array( 'walker' => $walker) );
			?>
			</ul>
		</div><!-- /.tabs-panel -->

		<p class="button-controls wp-clearfix">
			<span class="list-controls">
				<a href="<?php echo esc_url( add_query_arg( array( 'authorarchive-tab' => 'all', 'selectall' => 1, ), remove_query_arg( $removed_args ) )); ?>#authorarchive" class="select-all"><?php _e('Select All'); ?></a>
			</span>
			<span class="add-to-menu">
				<input type="submit"<?php wp_nav_menu_disabled_check( $nav_menu_selected_id ); ?> class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu'); ?>" name="add-authorarchive-menu-item" id="submit-authorarchive" />
				<span class="spinner"></span>
			</span>
		</p>

	</div><!-- /.categorydiv -->
<?php
}