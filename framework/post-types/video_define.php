<?php
add_action( 'init', 'create_video_type' );
function create_video_type() {
	register_post_type( 'th_video',
		array(
			'labels' => array(
				'name' => __( 'Videos' ),
				'singular_name' => __( 'Video' ),
                'add_new' => 'New Video',
                'add_new_item' => 'New Video'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'video'),
            //'supports' => array('title', 'thumbnail')
            'supports' => array('title', 'editor', 'thumbnail')
		)
	);
}

add_action('add_meta_boxes', 'add_video_metaboxes');
function add_video_metaboxes() {
    add_meta_box('theme_video_codigo', 'Video Youtube', 'theme_video_codigo', 'th_video', 'normal', 'default');        
} 

function theme_video_codigo() {
    global $post;
    $theme_video_id = get_post_meta($post->ID, 'theme_video_id', true);
    echo '
    <p>
        <label>Codigo Video:</label>
        <input type="text" name="theme_video_id" size="15" value="'.$theme_video_id.'" /> <i>http://www.youtube.com/watch?v=<b>Lv9DqkRcbaE</b></i>
    </p>
    <input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="'.wp_create_nonce(plugin_basename(_FILE_)).'" />';  
}

function theme_save_video_codigo() {
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
        $theme_video_id = $_POST['theme_video_id'];        
        update_post_meta($post->ID, 'theme_video_id',$theme_video_id);       
        
    }
add_action('save_post', 'theme_save_video_codigo'); 


/// Definiendo Autores
add_action('add_meta_boxes', 'add_autor_metaboxes2');
function add_autor_metaboxes2() {
    add_meta_box('theme_autor_cual2', 'Autor del Articulo', 'theme_autor_cual2', 'th_video', 'normal', 'default');        
}  

function theme_autor_cual2() {
    global $post;
    $autor_cual = get_post_meta($post->ID, 'theme_autor_cual', true);
    echo '
    <p>
        <label>Autor: </label>
        <select name="autor_cual">';
        
        $args = array(
            'post_type' => 'th_autor',
            'orderby' => 'title',
            'posts_per_page' => 99,
            'order' => 'ASC'
        );
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $current_id = get_the_ID();
                if($autor_cual==$current_id) {
                    echo '<option selected="selected" value="'.$current_id.'">' . get_the_title() . '</option>';
                } else {
                    echo '<option value="'.$current_id.'">' . get_the_title() . '</option>';
                }
            }
        }
        wp_reset_postdata();
          
    echo '</select>
    </p>
    <input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="'.wp_create_nonce(plugin_basename(_FILE_)).'" /> 
    ';
    //echo $autor_cual;
}
function theme_save_autor_cual2() {
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
        $autor_cual = $_POST['autor_cual'];        
        update_post_meta($post->ID, 'theme_autor_cual',$autor_cual);
    }
add_action('save_post', 'theme_save_autor_cual2'); 
?>