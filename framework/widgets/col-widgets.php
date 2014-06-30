<?php
 	// Bottom Widget Areas
	register_sidebar(array(
		'name' => esc_html__('Bottom 1', 'udesign'),
		'id' => 'bottom-widget-area-1',
		'description' => esc_html__('A widget area, used as the 1st column in the Bottom area (just above the footer).', 'udesign'),
		'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		'before_title' => '<h3 class="bottom-col-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
		'name' => esc_html__('Bottom 2', 'udesign'),
		'id' => 'bottom-widget-area-2',
		'description' => esc_html__('A widget area, used as the 2nd column in the Bottom area (just above the footer).', 'udesign'),
		'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		'before_title' => '<h3 class="bottom-col-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
		'name' => esc_html__('Bottom 3', 'udesign'),
		'id' => 'bottom-widget-area-3',
		'description' => esc_html__('A widget area, used as the 3rd column in the Bottom area (just above the footer).', 'udesign'),
		'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		'before_title' => '<h3 class="bottom-col-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
        'name' => esc_html__('Bottom 4', 'udesign'),
        'id' => 'bottom-widget-area-4',
        'description' => esc_html__('A widget area, used as the 4th column in the Bottom area (just above the footer).', 'udesign'),
        'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
        'before_title' => '<h3 class="bottom-col-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>',
	));
?>