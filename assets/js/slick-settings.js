/**
* Slick Slider Initializing
*/
(function($) {

	// Slider Type 1
	$('.slick').slick({
	    dots: true,
	    infinite: true,
	    speed: 300,
	    prevArrow: '<i class="prev-slide icon-chevron-left"></i>',
	    nextArrow: '<i class="next-slide icon-chevron-right"></i>'
	});

	// Slider Type 2
	$('.centered-slider').slick({
	  dots: true,
	  infinite: true,
	  speed: 300,
	  centerMode: true,
	  centerPadding: '300px',
	  slidesToShow: 1,
	  prevArrow: '<i class="prev-slide icon-chevron-left"></i>',
	  nextArrow: '<i class="next-slide icon-chevron-right"></i>',
	  responsive: [
	  	{
	      breakpoint: 1024,
	      settings: {
	        centerPadding: '80px',
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	      	centerPadding: '30px',
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	      	centerMode: false,
	      	centerPadding: '0px',
	      }
	    }
	   ]
	});

})(jQuery);