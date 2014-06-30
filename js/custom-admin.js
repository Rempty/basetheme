jQuery(document).ready( function( $ ) {   
    var formfield;    
    var formfield2;
    var formfield3;
    $('#sliderAdmin').on("click", ".upload_image_button", function(){
        cual = $(this).attr('id');
        nro = cual.substr(6,3);
        formfield = $('#slide'+nro+'.upload_image').attr('name');
        tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
        return false;
    });
    
    window.original_send_to_editor = window.send_to_editor;
    window.send_to_editor = function(html) {
        if (formfield) {
            imgurl = $('img',html).attr('src');
            $('#slide'+nro+'.upload_image').val(imgurl);
            tb_remove();
        } else if(formfield2) {
            imgurl = $('img',html).attr('src');
            $('#upload_mp3').val(imgurl);
            tb_remove();
        } else if(formfield3) {
            imgurl = $('img',html).attr('src');            
            $('#grilla_imagen'+nro).val(imgurl);
            tb_remove();
        } else {
            window.original_send_to_editor(html);
            //tb_remove();
        }
    }
    
    /***************************
        Insertar MP3
    ****************************/
    $('.inside').on("click", "#upload_mp3_button", function(){                
        formfield2 = $('#upload_mp3').attr('name');        
        tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
        return false;
    });
    
    /***************************
        Insertar Trabajo Reciente
    ****************************/
    $(".upload_reciente_button").click(function() {
        //alert('aaa');
        cual = $(this).attr('id');
        nro = cual.substr(6,1);
        formfield3 = $(this).attr('name');
        tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
        return false;
    });

});
    

/// Sliders
nro_slide = 99;
function agrega_slide() {
    nro_slide = nro_slide+1;
    item = '<div class="sliderItem'+nro_slide+'">';
    item += '<label>URL Banner(h:213px): </label>';
    item += '<input class="upload_image" id="slide'+nro_slide+'" type="text" size="50" name="upload_image['+nro_slide+']" />';
    item += '<input class="upload_image_button" id="button'+nro_slide+'" type="button" value="Upload Image" />';
    item += '<br/>';
    item += '<label>Título Banner: </label>';
    item += '<input type="text" size="50" name="banner_title['+nro_slide+']" >';
    item += '<br/>';
    item +='<label>Subtítulo Banner: </label>';
    item +='<input type="text" size="50" name="banner_subtitle['+nro_slide+']" value="">';
         item +='<br/>';
         item +='<label>Contenido: </label>';
             item +='<textarea rows="6" cols="50" name="banner_cont['+nro_slide+']"></textarea>';            
         item +='<br/>';
         item +='<label>Link: </label>';
         item +='<input type="text" size="50" name="banner_link['+nro_slide+']" value="">';
         item +='<br/>';
    item += '[ <a href="#" onclick="borrar_slide('+nro_slide+'); return false;">Borrar Slide</a> ]';
    item += '</p>';
    item += '<hr/>';
    item += '</div>'; 
    jQuery('#sliderAdmin').append(item);
}

function borrar_slide(cual) {    
    jQuery('.sliderItem'+cual).remove();
}