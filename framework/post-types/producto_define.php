<?php
add_action( 'init', 'create_producto_type' );
function create_producto_type() {
	register_post_type( 'mkt_producto',
		array(
			'labels' => array(
				'name' => __( 'Productos' ),
				'singular_name' => __( 'Producto' ),
                'add_new' => 'Nuevo producto',
                'add_new_item' => 'Nuevo producto'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'producto'),
            'exclude_from_search' => false,
            'supports' => array( 'title', 'editor', 'thumbnail', ),
		)
	);
}

/// Definir metaboxes
if (is_admin()){
    $prefix = 'mkt_';
    $config = array(
    'id'             => 'mkt_producto_box',          // meta box id, unique per meta box
    'title'          => 'Detalles',          // meta box title
    'pages'          => array('mkt_producto'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true         //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );  
  
  $producto_meta =  new AT_Meta_Box($config);
  $producto_meta->addText($prefix.'titulo',array('name'=> 'Titulo '));    $producto_meta->addText($prefix.'subtitulo',array('name'=> 'Subtitulo '));    
  $producto_meta->addText($prefix.'marca',array('name'=> 'Marca '));    
  $producto_meta->addImage($prefix.'image_thumb',array('name'=> 'Miniatura '));
  $producto_meta->addFile($prefix.'ficha',array('name'=> 'Ficha Técnica'));
  
  $producto_meta->Finish();
}


// Register Taxonomy seccion
function custom_taxonomy_seccion() {	
	$labels = array(
		'name'                       => 'Sección',
		'singular_name'              => 'Sección',
		'menu_name'                  => 'Secciones',
	);
	
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,		
	);
	register_taxonomy( 'seccionproducto', array( 'mkt_producto' ), $args );
}
add_action( 'init', 'custom_taxonomy_seccion', 0 );
?>