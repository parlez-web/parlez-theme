<?php
/**
 * myboutique Admin Functionality
 *
 * @package myboutique
 */

function myboutique_theme_docs_admin_notice(){
    global $pagenow;
    if ( $pagenow == 'themes.php' ) {
         echo '<div class="notice notice-success is-dismissible">
             <p>Welcome to your new <strong>My Boutique Theme</strong>. Please have a look at our <a href="#">Theme Documentation</a> for theme setup and customization.</p>
         </div>';
    }
}
add_action('admin_notices', 'myboutique_theme_docs_admin_notice');