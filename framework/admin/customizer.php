<?php
function baset_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'baset_logo' ); // Add setting for logo uploader
         
    // Add control for logo uploader (actual uploader)
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'baset_logo', array(
        'label'    => __( 'Upload Logo', 'basetheme' ),
        'section'  => 'title_tagline',
        'settings' => 'baset_logo',
    ) ) );
}
add_action( 'customize_register', 'baset_customize_register' );
?>