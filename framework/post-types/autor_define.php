<?php
add_action( 'init', 'create_autor_type' );
function create_autor_type() {
	register_post_type( 'th_autor',
		array(
			'labels' => array(
				'name' => __( 'Autores' ),
				'singular_name' => __( 'Autor' ),
                'add_new' => 'Nuevo Autor',
                'add_new_item' => 'Nuevo Autor'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'autor'),
            'has_archive'         => true,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' )
		)
	);
}
?>