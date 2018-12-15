/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function($) {
	var container, button, menu, links, i, len;

	container = $('.main-navigation');

	button = $('.menu-toggle');
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.find('ul').first();

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.attr( 'aria-expanded', 'false' );
	if ( -1 === menu.hasClass( 'nav-menu' ) ) {
		menu.addClass('nav-menu');
	}

	button.on('click', function() {
		var container = $(this).parents('nav');
		var menu = container.find('ul');

		if ( $(this).hasClass('slide-down') ) {
			slideDownMenu(container, menu);
		} else {
			showFullwidthMenu(container, menu);
		}
	});

	$('.menu-toggle.slide-2').on('click', function() {
		var container = $('#mobile-navigation');
		var menu = $('#mobile-navigation');
		slideDownMenu(container, menu);
	})

	function slideDownMenu(container, menu) {
		var button = container.find('button');

		if ( container.hasClass( 'toggled' ) ) {
			button.attr( 'aria-expanded', 'false' );
			button.innerHTML = '<i class="icon-menu"></i>';
			menu.attr( 'aria-expanded', 'false' );
		} else {
			button.attr( 'aria-expanded', 'true' );
			button.innerHTML = '<i class="icon-delete close"></i>';
			menu.attr( 'aria-expanded', 'true' );
		}

		container.toggleClass('toggled');
		//menu.slideToggle();
	}

	function showFullwidthMenu(container, menu) {
		var button = container.find('button');
		
		if ( container.hasClass( 'toggled' ) ) {
			container.toggleClass('toggled');
			button.attr( 'aria-expanded', 'false' );
			button.html('<i class="icon-menu"></i>');
			menu.attr( 'aria-expanded', 'false' );
		} else {
			container.toggleClass('toggled');
			button.attr( 'aria-expanded', 'true' );
			button.html('<i class="icon-delete close"></i>');
			menu.attr( 'aria-expanded', 'true' );
		}
	}

	// Close mechanism
	$('.close').on('click', function() {
		
		if ( container.hasClass( 'toggled' ) ) {
			button.attr( 'aria-expanded', 'false' );
			button.html('<i class="icon-menu"></i>');
			menu.attr( 'aria-expanded', 'false' );
		} else {
			button.attr( 'aria-expanded', 'true' );
			button.html('<i class="icon-delete close"></i>');
			menu.attr( 'aria-expanded', 'true' );
		}

		container.toggleClass('toggled');
		//$('#site-navigation .nav-menu').slideToggle();
	});


	/* Add icons and click listeners to mobile submenus */
	$submenu_link = $('.nav-menu .menu-item-has-children');
	$submenu_link.find('a:eq(0)').append('<i class="icon-down"></i>');
	
	$('.menu-item-has-children .icon-down').on('click', function(event) {
		event.preventDefault();
		$(this).parents('.menu-item').find('ul.sub-menu').slideToggle();
		$(this).toggleClass("icon-up");
	})

	// Get all the link elements within the menu.
	links    = menu.find( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.find( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );

/*
* Navigation sticky on scroll
*/
// $(window).scroll(function () {
//     if ($(window).scrollTop() > 350) {
//       $('.main-navigation').addClass('fixed');
//     }
//     if ($(window).scrollTop() < 351) {
//       $('.main-navigation').removeClass('fixed');
//     }
//   });

// Open Search Pop
$('.search-icon, .close-search').on('click', function() {
	$('.popup-search').fadeToggle();
});


})(jQuery);
