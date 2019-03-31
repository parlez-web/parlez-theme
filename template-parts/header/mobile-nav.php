<nav id="mobile-navigation" class="main-navigation">
	<button class="menu-toggle slide-down" aria-controls="main-navigation" aria-expanded="false"><i class="icon-menu"></i><span><?php echo __('Menu', 'parlez') ?></span></button>
	<!-- <i class="icon-search-bold search-icon"></i> -->
	<div class="mobile-menu-container">
		<?php
		if ( has_nav_menu( 'primary-menu' ) ) : 
			wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'menu_id'        => 'primary-menu',
			) );
		endif;		
		?>
		<?php parlez_social_media(); ?>
	</div>
</nav>