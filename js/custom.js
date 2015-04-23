/* trigger when page is ready */
jQuery(document).ready(function (){
    jQuery("ul#menu-topmenu").superfish({        
        autoArrows: false,
        delay: 100
    });
    jQuery('#menu-topmenu').slicknav({
		prependTo:'header#header .container',
        label: ''
    });
});