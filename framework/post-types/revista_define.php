<?php
add_action( 'init', 'create_revista_type' );
function create_revista_type() {
	register_post_type( 'th_revista',
		array(
			'labels' => array(
				'name' => __( 'Revistas' ),
				'singular_name' => __( 'Revista' ),
                'add_new' => 'Nuevo Articulo',
                'add_new_item' => 'Nuevo Articulo'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'revista'),
            'has_archive'         => true,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
		)
	);
}


///// Definiendo taxonomias
function edicion_init() {
	// create a new taxonomy
	register_taxonomy(
		'edicion',
		'th_revista',
		array(
			'label' => __( 'Edicion' ),
			'rewrite' => array( 'slug' => 'edicion' ),
            'hierarchical'  => true
		)
	);
}
add_action( 'init', 'edicion_init' );

function seccion_init() {
	// create a new taxonomy
	register_taxonomy(
		'seccion',
		'th_revista',
		array(
			'label' => __( 'Seccion' ),
			'rewrite' => array( 'slug' => 'seccion' ),
            'hierarchical' => true
		)
	);
}
add_action( 'init', 'seccion_init' );


/// Definiendo Autores
add_action('add_meta_boxes', 'add_autor_metaboxes');
function add_autor_metaboxes() {
    add_meta_box('theme_autor_cual', 'Autor del Articulo', 'theme_autor_cual', 'th_revista', 'normal', 'default');        
}  

function theme_autor_cual() {
    global $post;
    $autor_cual = get_post_meta($post->ID, 'theme_autor_cual', true);
    $colaborador_cual = get_post_meta($post->ID, 'theme_colaborador_cual', true);
    
    /// Autor
    //echo $autor_cual;
    echo '
    <p>
        <label>Autor: </label>
        <select name="autor_cual">
        <option value="none">Sin Autor</option>
        ';
        
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
          
    echo '</select>';
    
    /// Colaborador  
    //print_r($colaborador_cual);  
    echo '
    <p>
        <label>Colaborador: </label>
        <select name="colaborador_cual[]" MULTIPLE size="5">        
        ';
        
        $args = array(
            'post_type' => 'th_colaborador',
            'orderby' => 'title',
            'posts_per_page' => 99,
            'order' => 'ASC'
        );
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $current_id = get_the_ID();
                $existe = array_search($current_id, $colaborador_cual);
                if( $existe === false) {
                    echo '<option value="'.$current_id.'">' . get_the_title().'</option>';
                } else {
                    echo '<option selected="selected" value="'.$current_id.'">' . get_the_title(). '</option>';
                }
            }
        }
        wp_reset_postdata();
          
    echo '</select>';

    
    
    echo '
    </p>
    <input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="'.wp_create_nonce(plugin_basename(_FILE_)).'" /> 
    ';
    //echo $autor_cual;
}

function theme_save_autor_cual() {
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
        $colaborador_cual = $_POST['colaborador_cual'];
        update_post_meta($post->ID, 'theme_autor_cual',$autor_cual);
        update_post_meta($post->ID, 'theme_colaborador_cual',$colaborador_cual);
    }
add_action('save_post', 'theme_save_autor_cual'); 
?>