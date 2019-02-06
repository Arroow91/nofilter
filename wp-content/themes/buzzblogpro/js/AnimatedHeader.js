if( /Android|iPhone|iPod|iPad|BlackBerry/i.test(navigator.userAgent) ) {
}else {
(function ($) {
    'use strict';
	$('.sticky-nav').css("height", $('.sticky-nav').outerHeight());
	$('.sticky-wrapper').css("height", $('.sticky-wrapper').outerHeight());
	var sticky_navigation_offset_top = $('.sticky-nav').offset().top;
	var sticky_navigation = function(){
		var scroll_top = $(window).scrollTop();
		if (scroll_top > sticky_navigation_offset_top) { 
			$('.sticky-nav').addClass("navbar-fixed-top");
			$('.sticky-wrapper').addClass("navbar-fixed-top-two");
		} else {
			 $('.sticky-nav').removeClass("navbar-fixed-top");
			 $('.sticky-wrapper').removeClass("navbar-fixed-top-two");
		}   
	};
	sticky_navigation();
	$(window).scroll(function() {
		 sticky_navigation();
	});
}(jQuery));
}