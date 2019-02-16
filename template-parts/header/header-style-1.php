<?php
/**
 * Template part for Navigation/Header Style 1
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */
?>

<?php myboutique_popup_search(); ?>

<!-- Mobile Navigation -->
<?php get_template_part( 'template-parts/header/mobile', 'nav' ); ?>

<!-- Main Navigation -->
<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
<nav id="site-navigation" class="main-navigation">
	<div class="menu-container fullwidth">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'menu_id'        => 'primary-menu',
			) );	
		?>
	</div>
	<div class="social-search-container">
		<?php myboutique_social_media(); ?>
		<i class="icon-search-bold search-icon"></i>
		<?php 
		//Woocommerce Icon
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		 
		    $count = WC()->cart->cart_contents_count;
		   	?>
		   	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">

		        <span class="cart-contents"><i class="icon-shopping-bag"></i> <?php echo esc_html( $count ); ?></span>
		    </a>
		 
		<?php } ?>
	</div>
</nav>
<?php endif; ?>

<!-- Site Header -->
<?php get_template_part( 'template-parts/header/site', 'title' ); ?>

<!-- Optional Navigation Menu -->
<?php if ( has_nav_menu( 'secondary-menu' ) ) : ?>
<nav id="sub-navigation" class="sub-navigation main-navigation">
	<?php
		wp_nav_menu( array(
			'theme_location' => 'secondary-menu',
			'menu_id'        => 'secondary-menu',
		) );		
	?>
</nav>
<?php endif; ?>
