<?php
add_action('add_meta_boxes', 'add_post_metaboxes');
function add_post_metaboxes() {
    add_meta_box('theme_post_detail', 'Link', 'theme_post_detail', 'post', 'normal', 'default');        
}

function theme_post_detail() {
    global $post;         
    $link = get_post_meta($post->ID, 'theme_post_link', true);
    echo '    
    <label>Link Externo: </label>
    <input id="post_link" type="text" size="60" name="post_link" value="'.$link.'" />    
    ';
    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="'.wp_create_nonce(plugin_basename(_FILE_)).'" />';         
}

function theme_save_post() {
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
        $post_link = $_POST['post_link'];
        update_post_meta($post->ID, 'theme_post_link',$post_link);        
    }
add_action('save_post', 'theme_save_post'); 
?>