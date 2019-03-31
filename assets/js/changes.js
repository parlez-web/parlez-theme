/**
 * File changes.js
 *
 * All kinds of javascript changes and functions
 *
 */
( function($) {

// Change tagname of posts featured row when inside another section
$('.featured-row').each(function() {

	if($(this).parents('.widget').length) {
		var classes = $(this).attr('class');
		$(this).replaceWith('<div class="' + classes + '">' + $(this).html() +'</div>');
	}

})

// Radio buttons 
// $('.radio-buttons').on('click', function() {
// 	$button = $(this).find('.');
// 	$radio = $button.siblings( 'input[type="radio"]' );

// 	if($radio.is(':checked')) {
// 		$button.siblings( 'input[type="radio"]' ).prop("checked", false);
// 		$button.css( 'background', 'white' );
// 	} else {
// 		$button.siblings( 'input[type="radio"]' ).prop("checked", true);
// 		$button.css( 'background', 'yellow' );
// 	}
	
// })

} )(jQuery);