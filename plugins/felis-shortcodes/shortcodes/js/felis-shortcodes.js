(function ($) {
	'use strict';
	/**
	 * Progress Bar Init
	 */

	//Testimonials

	jQuery('.c-testimonials').each(function () {
		var $this = jQuery(this);
		var testimonialsId = $this.attr('data-id');
		var dataAutoplay = $this.attr('data-autoplay');
		var check_rtl = (jQuery("body").css('direction') === "rtl");
		jQuery('#'+testimonialsId).slick({
			dots: true,
			autoplay: false,
			arrows: false,
			autoplaySpeed: 5000,
			infinite: true,
			speed: 300,
			slidesToShow: 1,
			slidesToScroll: 1,
			adaptiveHeight: true,
			rtl: check_rtl,

		});
	});
	
})

(jQuery);