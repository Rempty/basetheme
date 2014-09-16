<?php
add_action( 'init', 'create_slider_type' );
function create_slider_type() {
	register_post_type( 'slider',
		array(
			'labels' => array(
				'name' => __( 'Sliders' ),
				'singular_name' => __( 'Slider' ),
                'add_new' => 'New Slider',
                'add_new_item' => 'New Slider'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'slider'),
            'exclude_from_search' => true,
            'supports' => 'title', 'page-attributes' 
		)
	);
}

add_action('add_meta_boxes', 'add_slider_metaboxes');
function add_slider_metaboxes() {
    add_meta_box('theme_slider_banner', 'Banners', 'theme_slider_banner', 'slider', 'normal', 'default');        
}  

function theme_slider_banner() {
    global $post;
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_register_script('my-upload', get_bloginfo("template_url").'/js/custom-admin.js', array('jquery','media-upload','thickbox'));
    wp_enqueue_script('my-upload');
    wp_enqueue_style('thickbox');         
    
    $banners = get_post_meta($post->ID, 'theme_page_banner', true);
    $titulos = get_post_meta($post->ID, 'theme_page_titulo', true);
    $subtitulos = get_post_meta($post->ID, 'theme_page_subtitulo', true);
    $cont = get_post_meta($post->ID, 'theme_page_content', true);
    $link = get_post_meta($post->ID, 'theme_page_link', true);
    
    echo '<div id="sliderAdmin">';
    echo '
    <p align="right">
        <a href="#" onclick="agrega_slide(); return false;">Agregar Slide</a>
    </p>';    
    
    $n=0;
    if(is_array($banners)){
    foreach($banners as $cual => $banner) {
    $n++;
    echo '
    <div class="sliderItem'.$n.'">';
        if($banner!="") {            
            echo '<p><img src="'.$banner.'" width="500" /></p>';
        }
    echo '
        <p>
        <label>URL Banner(h:213px): </label>
        <input class="upload_image" id="slide1" type="text" size="50" name="upload_image['.$n.']" value="'.$banner.'" />
        <input class="upload_image_button" id="button1" type="button" value="Upload Image" />
        <br/>
        <label>Título Banner: </label>
        <input type="text" size="50" name="banner_title['.$n.']" value="'.$titulos[$cual].'">
        <br/>
        <label>Subtítulo Banner: </label>
        <input type="text" size="50" name="banner_subtitle['.$n.']" value="'.$subtitulos[$cual].'">
        <br/>
        <label>Contenido: </label>
            <textarea rows="6" cols="50" name="banner_cont['.$n.']">'.$cont[$cual].'</textarea>
        <br/>
        <label>Link: </label>
        <input type="text" size="50" name="banner_link['.$n.']" value="'.$link[$cual].'">
        <br/>
        [ <a href="#" onclick="borrar_slide('.$n.'); return false;">Borrar Slide</a> ]
        </p>
        <hr/>
    </div>
    ';
    }
    }
    echo '    
    <input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="'.wp_create_nonce(plugin_basename(_FILE_)).'" />';    
    echo '</div>';         
}

function theme_save_slider_banner() {
        global $post;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post->ID;
        } 
        if(!wp_verify_nonce($_POST['eventmeta_noncename'], plugin_basename(_FILE_))){
            return $post->ID;
            if(!current_user_can('edit_post', $post->ID)) {
                return $post->ID;
            }           
        }
        $post_banner = $_POST['upload_image'];
        $post_titulo = $_POST['banner_title'];
        $post_subtitulo = $_POST['banner_subtitle'];
        $post_cont = $_POST['banner_cont'];
        $post_link = $_POST['banner_link'];
        update_post_meta($post->ID, 'theme_page_banner',$post_banner);        
        update_post_meta($post->ID, 'theme_page_titulo',$post_titulo);
        update_post_meta($post->ID, 'theme_page_subtitulo', $post_subtitulo);
        update_post_meta($post->ID, 'theme_page_content', $post_cont);
        update_post_meta($post->ID, 'theme_page_link', $post_link);
    }
add_action('save_post', 'theme_save_slider_banner'); 
?>