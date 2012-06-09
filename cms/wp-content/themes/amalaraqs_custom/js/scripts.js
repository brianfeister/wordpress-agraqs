jQuery(document).ready(function() {

// append user agent string as 'data-useragent' attached to top level HTML tag for targeting nitpicks in modern browsers

var b = document.documentElement;
	b.setAttribute('data-useragent',  navigator.userAgent);
	b.setAttribute('data-platform', navigator.platform );
	
	
	/* This is basic Fancybox activation - uses default settings */
	
			$("a.fancybox").fancybox({
	        	'hideOnContentClick': true
	        });
	        
	        /* This is a non-obtrustive Fancybox method for youtube videos*/
	
			$("a[rel=video_box], a.video_box, a.fancy_box").fancybox({
	        	'hideOnContentClick': false,									   
				overlayShow: true,
				showNavArrows: true,
				type: 'swf'
			});

});
