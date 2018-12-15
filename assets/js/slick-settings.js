/**
* Slick Slider Initializing
*/
(function($) {

	// Slider Type 1
	$('.slick').slick({
	    dots: true,
	    infinite: true,
	    speed: 300,
	    prevArrow: '',
	    nextArrow: '<i class="next-slide icon-arrow-right"></i>'
	});

	// Slider Type 2
	$('.centered-slider').slick({
	  dots: true,
	  infinite: true,
	  speed: 300,
	  centerMode: true,
	  centerPadding: '300px',
	  slidesToShow: 1,
	    prevArrow: '',
	    nextArrow: '<i class="next-slide icon-arrow-right"></i>'
	});

})(jQuery);