<?php
add_action( 'init', 'create_slider_type' );
function create_slider_type() {
	register_post_type( 'mkt_slider',
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

/// Definir metaboxes
if (is_admin()){
    $prefix = 'mkt_';
    $config = array(
    'id'             => 'mkt_slider_box',          // meta box id, unique per meta box
    'title'          => 'Detalles',          // meta box title
    'pages'          => array('mkt_slider'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true         //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );  
  
  $slider_meta =  new AT_Meta_Box($config);
  $slider_meta->addText($prefix.'duracion',array('name'=> 'Duración (en milisegundos) '));  
  
  /// Agregar repetidor
  $repeater_fields[] = $slider_meta->addText($prefix.'re_text_titulo',array('name'=> 'Titulo ', 'class'=>'at_slide_text'),true);
  $repeater_fields[] = $slider_meta->addText($prefix.'re_text_link',array('name'=> 'Link ', 'class'=>'at_slide_text'),true);
  $repeater_fields[] = $slider_meta->addImage($prefix.'image_imagen',array('name'=> 'Imagen '),true);
  
  $slider_meta->addRepeaterBlock($prefix.'re_',array(
    'inline'   => true, 
    'name'     => 'Slides',
    'fields'   => $repeater_fields, 
    'sortable' => true
  ));
  
  $slider_meta->Finish();
}
?>