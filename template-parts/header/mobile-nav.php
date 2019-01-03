<nav id="mobile-navigation" class="main-navigation">
	<button class="menu-toggle slide-down" aria-controls="main-navigation" aria-expanded="false"><i class="icon-menu"></i><span><?php echo __('Menu', 'myboutique') ?></span></button>
	<i class="icon-search-bold search-icon"></i>
	<div class="mobile-menu-container">
		<?php
		if ( has_nav_menu( 'primary-menu' ) ) : 
			wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'menu_id'        => 'primary-menu',
			) );
		endif;		
		?>
		<?php
		if ( has_nav_menu( 'secondary-menu' ) ) :
			wp_nav_menu( array(
				'theme_location' => 'secondary-menu',
				'menu_id'        => 'secondary-menu',
			) );
		endif;		
		?>
		<?php myboutique_social_media(); ?>
	</div>
</nav>