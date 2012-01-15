jQuery(document).ready(function() {

// append user agent string as 'data-useragent' attached to top level HTML tag for targeting nitpicks in modern browsers

var b = document.documentElement;
	b.setAttribute('data-useragent',  navigator.userAgent);
	b.setAttribute('data-platform', navigator.platform );
	
	
//	jQuery('#cycle').cycle({
//		fx: 'fade'
//	});

//	jQuery('figure.gallery-item a').attr('rel','gallery');
//	jQuery('figure.gallery-item a[rel="gallery"]').fancybox();

});
