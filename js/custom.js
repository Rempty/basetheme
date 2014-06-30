// remap jQuery to $
document.documentElement.className += ' js_on ';

(function($){})(window.jQuery);


/* trigger when page is ready */
$(document).ready(function (){
    $("ul#menu-topmenu").superfish({        
        autoArrows: false,
        delay: 100
    });
    $('#menu-topmenu').slicknav({
		prependTo:'header#header .container',
        label: ''
    });
});
// Content Toggle
jQuery(function($){
    // Initial state of toggle (hide)
    $(".slide_toggle_content").hide();
    // Process Toggle click (http://api.jquery.com/toggle/)
    $("h4.slide_toggle").toggle(function(){
	    $(this).addClass("clicked");
	}, function () {
	    $(this).removeClass("clicked");
    });
    // Toggle animation (http://api.jquery.com/slideToggle/)
    $("h4.slide_toggle").click(function(){
	$(this).next(".slide_toggle_content").slideToggle();
    });
});

// Content Accordion
jQuery(document).ready(function($){
    $('.accordion-container').hide();
    $('.accordion-toggle:first').addClass('active').next().show();
    $('.accordion-toggle').click(function(){
        if( $(this).next().is(':hidden') ) {
            $('.accordion-toggle').removeClass('active').next().slideUp();
            $(this).toggleClass('active').next().slideDown();
        }
        return false; // Prevent the browser jump to the link anchor
    });
});

// Tabs
jQuery(document).ready(function($){
	$('.tabs a').click(function(){
		switch_tabs($(this));
	});
	switch_tabs($('.defaulttab'));
	function switch_tabs(obj) {
		$('.tab-content').hide();
		$('.tabs a').removeClass("selected");
		var id = obj.attr("rel");
		$('#'+id).show();
		obj.addClass("selected");
	}
});

/* optional triggers

$(window).load(function() {
	
});

$(window).resize(function() {
	
});

*/