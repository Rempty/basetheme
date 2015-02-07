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