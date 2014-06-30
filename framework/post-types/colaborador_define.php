<?php
add_action( 'init', 'create_colaborador_type' );
function create_colaborador_type() {
	register_post_type( 'th_colaborador',
		array(
			'labels' => array(
				'name' => __( 'Colaboradores' ),
				'singular_name' => __( 'colaborador' ),
                'add_new' => 'Nuevo colaborador',
                'add_new_item' => 'Nuevo colaborador'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'colaborador'),
            'has_archive'         => true,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' )
		)
	);
}
?>