<?php
function theme_page_sidebar() {
    global $post;
       
    $sidebar = get_post_meta($post->ID, 'theme_page_sidebar', true);
        $custom_sidebars = get_option("theme_name_sidebar");
        if(!empty($custom_sidebars)){
            echo '<select name="sidebar">';
            echo '<option value="">Seleccione</option>';
			$custom_sidebar_names = explode(',',$custom_sidebars);
			foreach ($custom_sidebar_names as $name){
			 if($sidebar==$name){
			    echo '<option selected="selected" value="'.$name.'">'.$name.'</option>'; 
			 }else{
			     echo '<option value="'.$name.'">'.$name.'</option>';
			 }
				
			}
            echo '</select>';
		}
        
}
function theme_save_page_sidebar() {
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
        $post_sidebar = $_POST['sidebar'];
        update_post_meta($post->ID, 'theme_page_sidebar',$post_sidebar);        
    }
add_action('save_post', 'theme_save_page_sidebar');
?>