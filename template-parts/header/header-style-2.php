<?php
/**
 * Template part for Navigation/Header Style 2
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package My_Boutique_Theme
 */
?>

<?php myboutique_popup_search(); ?>

<div class="header-container">
	<button class="menu-toggle slide-2" aria-controls="primary-menu" aria-expanded="false"><i class="icon-menu"></i></button>

	<!-- Left Navigation Menu -->
	<nav id="left-navigation" class="main-navigation left-navigation">
		<div class="menu-container">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'menu_id'        => 'primary-menu',
			) );		
			?>
		</div>
	</nav>

	<!-- Site Header -->
	<?php get_template_part( 'template-parts/header/site', 'title' ); ?>

	<!-- Right Navigation Menu -->
	<nav id="right-navigation" class="main-navigation right-navigation">
		<div class="menu-container">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'secondary-menu',
				'menu_id'        => 'secondary-menu',
			) );		
			?>
		</div>
		<div class="social-search-container">
			<?php 
			//Woocommerce Icons
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			 
			    $count = WC()->cart->cart_contents_count;
			    ?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php 
			    if ( $count > 0 ) {
			        ?>
			        <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
			        <?php
			    }
			        ?></a>
			 
			<?php } ?>
		</div>
	</nav>
</div>


<!-- Mobile Navigation Menu -->
<nav id="mobile-navigation">
	<div class="menu-container">
	<?php
		wp_nav_menu( array(
			'theme_location' => 'primary-menu',
			'menu_id'        => 'primary-menu',
		) );		
		?>
	<?php
	wp_nav_menu( array(
		'theme_location' => 'secondary-menu',
		'menu_id'        => 'secondary-menu',
	) );		
	?>
	</div>
	<div class="social-search-container">
		<?php 
		myboutique_social_media();
		get_search_form();
		?>
	</div>
</nav>
