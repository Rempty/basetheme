<?php
add_action( 'init', 'create_banner_type' );
function create_banner_type() {
	register_post_type( 'th_banner',
		array(
			'labels' => array(
				'name' => __( 'Banners' ),
				'singular_name' => __( 'Banner' ),
                'add_new' => 'Nuevo Banner',
                'add_new_item' => 'Nuevo Banner'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'banner'),
            'has_archive'         => true,
            'supports'            => array( 'title' )
		)
	);
}

/// Añadiendo columnas
function add_banner_columns($columns) {
    unset($columns['author']);
    return array_merge($columns, 
              array('banner_tamano' => 'Tamaño',
                    'banner_vencimiento' => 'F. Vencimiento' ));
}
add_filter('manage_th_banner_posts_columns' , 'add_banner_columns');




function ST4_columns_content($column_name, $post_ID) {  
    $tamanios = array(
         'e1' => 'Vertical externo izquierdo', 
         'e2' => 'Vertical externo derecho',
         'h1' => 'Horizontal encabezado',
         'h2' => 'Horizontal medio',
         'h3' => 'Horizontal footer',
         'v1' => 'Vertical 1',
         'v2' => 'Vertical 2',
         'r1' => 'Rectangulo'
    );
    if ($column_name == 'banner_tamano') {  
        $tamanio = get_post_meta( $post_ID, 'theme_banner_tamano', true );
        echo $tamanios[$tamanio];
    }  
    if ($column_name == 'banner_vencimiento') {  
        $vencimiento = get_post_meta( $post_ID, 'theme_banner_vencimiento', true );
        //echo date(strtotime("j F Y"), $vencimiento);
        echo $vencimiento;  
    }  
}  
add_action('manage_th_banner_posts_custom_column', 'ST4_columns_content', 10, 2);


// Definiendo parámetros
add_action('add_meta_boxes', 'add_banner_metaboxes');
function add_banner_metaboxes() {
    add_meta_box('theme_banner_como', 'Opciones del Banner', 'theme_banner_como', 'th_banner', 'normal', 'default');        
}  

function rev($campo, $valor, $array = false) {
    $rpta = '';
    if($array==false) {
        if($campo == $valor) {
            $rpta .= 'selected="selected"';
        }    
    } else if(is_array($campo)) {
        if(array_search($valor, $campo) === false ) {
            $rpta = '';
        } else {
            $rpta .= 'selected="selected"';
        }
    }
    echo $rpta;
}

function theme_banner_como() {
    global $post;
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_register_script('my-upload', get_bloginfo("template_url").'/js/custom-admin.js', array('jquery','media-upload','thickbox'));
    wp_enqueue_script('my-upload');
       
    
    /// Recoger valores
    $banner_tamano = get_post_meta($post->ID, 'theme_banner_tamano', true);    
    $banner_lugar = get_post_meta($post->ID, 'theme_banner_lugar', true);
    $banner_edicion = get_post_meta($post->ID, 'theme_banner_edicion', true);
    $banner_seccion = get_post_meta($post->ID, 'theme_banner_seccion', true);
    $banner_vencimiento = get_post_meta($post->ID, 'theme_banner_vencimiento', true);
    $banner_link = get_post_meta($post->ID, 'theme_banner_link', true);
    $banner_imagen = get_post_meta($post->ID, 'theme_banner_imagen', true);
    
    if(empty($banner_seccion)){
        $banner_seccion = array();        
    }        
    ?>
    <h3>Opciones:</h3>
    <table>
        <tr>
            <th>Tamaño:</th>
            <td>
                <select name="banner_tamano">
                    <optgroup label="Vertical externo 160x600">
                        <option value="e1" <?php rev($banner_tamano,"e1"); ?>>Vertical externo izquierdo</option>
                        <option value="e2" <?php rev($banner_tamano,"e2"); ?>>Vertical externo derecho</option>
                    </optgroup>
                    
                    <optgroup label="Horizontal 940x90">
                        <option value="h1" <?php rev($banner_tamano,"h1"); ?>>Horizontal encabezado</option>
                        <option value="h2" <?php rev($banner_tamano,"h2"); ?>>Horizontal medio</option>
                        <option value="h3" <?php rev($banner_tamano,"h3"); ?>>Horizontal footer</option>
                    </optgroup>
                    
                    <optgroup label="Vertical 180x300">
                        <option value="v1" <?php rev($banner_tamano,"v1"); ?>>Vertical 1</option>
                        <option value="v2" <?php rev($banner_tamano,"v2"); ?>>Vertical 2</option>                        
                    </optgroup>
                    
                    <optgroup label="Rectangulo 180x150">
                        <option value="r1" <?php rev($banner_tamano,"r1"); ?>>rectangulo 1</option>                        
                    </optgroup>                    
                </select>
            </td>            
        </tr>
        <tr>
            <th>Ubicación</th>
            <td>
                <p>
                    <b>Lugar</b><br/>
                    <select name="banner_lugar[]" multiple="multiple" size="5" style="width: 200px;">
                        <option value="portada" <?php rev($banner_lugar,"portada", true); ?>>Portada</option>
                        <option value="listados" <?php rev($banner_lugar,"listados", true); ?>>Listados</option>
                        <option value="internas" <?php rev($banner_lugar,"internas", true); ?>>Páginas internas</option>
                        <option value="revista" <?php rev($banner_lugar,"revista", true); ?>>Revista/articulos</option>
                    </select>
                </p>
                <!--
                <p>
                    <b>Edición</b><br/>
                    <select name="banner_edicion[]" multiple="multiple" size="5" style="width: 200px;">
                        <?php
                            $terms = get_terms( 'edicion' );
                            foreach ($terms as $term) {
                                $name = $term->name;
                                $id = $term->term_id;
                                if(array_search($id, $banner_edicion) === false ) {                                    
                                    echo '<option value="'.$id.'">'.$name.'</option>';
                                } else {
                                    echo '<option selected="selected" value="'.$id.'">'.$name.'</option>';
                                }   
                            }                            
                        ?>
                    </select>
                </p>
                -->
                <p>
                    <b>Sección</b><br/>
                    <select name="banner_seccion[]" multiple="multiple" size="5" style="width: 200px;">
                        <?php
                            $terms = get_terms( 'seccion' );
                            foreach ($terms as $term) {
                                $name = $term->name;
                                $id = $term->term_id;                                
                                if(array_search($id, $banner_seccion) === false) {
                                    echo '<option value="'.$id.'">'.$name.'</option>';
                                } else {                                    
                                    echo '<option selected="selected" value="'.$id.'">'.$name.'</option>';
                                }   
                            }                            
                        ?>
                    </select>
                </p>
            </td>
        </tr>
        <tr>
            <th>Fecha vencimiento</th>
            <td><input type="text" size="20" value="<?php echo $banner_vencimiento; ?>" name="banner_vencimiento" /> <span>año-mes-dia</span></td>
        </tr>
        <tr>
            <th>Link</th>
            <td><input type="text" size="60" name="banner_link" value="<?php echo $banner_link; ?>" /></td>
        </tr>
        <tr>
            <th>Imagen</th>
            <td>                
                <div class="admin_form_row">
                    <h4>Subir Banner</h4>
                    <div class="theme-option-image-preview" id="banner_media">
                        <?php if($banner_imagen != "") { ?>
                            <img alt="" src="<?php echo $banner_imagen; ?>" />           
                        <?php } ?>             
                    </div>
                    <input type="text" value="<?php echo $banner_imagen; ?>" size="60" name="banner_imagen" id="banner" />
                    <br />
                    <a href="#" class="th_upload_media blue light" rel="<?php echo $id; ?>" title="Add Media">Upload Banner</a>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href="#" class="th_delete_media blue light" rel="<?php echo $id; ?>" title="Remove Media">Remove Banner</a>
                </div>            
            
            </td>
        </tr>
    </table>
    <?php
    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="'.wp_create_nonce(plugin_basename(_FILE_)).'" />';
    ?>
    <?php
}

function theme_save_banner() {
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
        $banner_tamano = $_POST['banner_tamano'];        
        $banner_lugar = $_POST['banner_lugar'];
        $banner_edicion = $_POST['banner_edicion'];
        $banner_seccion = $_POST['banner_seccion'];
        $banner_vencimiento = $_POST['banner_vencimiento'];
        $banner_link = $_POST['banner_link'];
        $banner_imagen = $_POST['banner_imagen'];
        
        update_post_meta($post->ID, 'theme_banner_tamano',$banner_tamano);
        update_post_meta($post->ID, 'theme_banner_lugar',$banner_lugar);
        update_post_meta($post->ID, 'theme_banner_edicion',$banner_edicion);
        update_post_meta($post->ID, 'theme_banner_seccion',$banner_seccion);
        update_post_meta($post->ID, 'theme_banner_vencimiento',$banner_vencimiento);
        update_post_meta($post->ID, 'theme_banner_link',$banner_link);
        update_post_meta($post->ID, 'theme_banner_imagen',$banner_imagen);
        
    }
add_action('save_post', 'theme_save_banner'); 
?>