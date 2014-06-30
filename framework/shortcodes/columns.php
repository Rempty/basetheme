<?php
/*
CULUMNS SHORTCODE
*/
function theme_shortcode_column( $atts, $content = null, $code ) {
    extract( shortcode_atts( array(
		'last' => 'false'		
	), $atts ) );
    if($last=="true") {
	   return '<div class="' . $code . ' last">' . wpautop( do_shortcode( trim( $content ) ) ) . '</div>';
    } else {
        return '<div class="' . $code . '">' . wpautop( do_shortcode( trim( $content ) ) ) . '</div>';
    }
}
function theme_shortcode_column_last( $atts, $content = null, $code ) {
	return '<div class="' . str_replace( '_last', '', $code ) . ' last">' . wpautop( do_shortcode( trim( $content ) ) ) . '</div><div class="clearboth"></div>';
}



add_shortcode( 'one_half', 'theme_shortcode_column' );
add_shortcode( 'one_third', 'theme_shortcode_column' );
add_shortcode( 'one_fourth', 'theme_shortcode_column' );
add_shortcode( 'one_fifth', 'theme_shortcode_column' );
add_shortcode( 'five', 'theme_shortcode_column' );
add_shortcode( 'foto_horizontal', 'theme_shortcode_column' );
add_shortcode( 'foto_vertical', 'theme_shortcode_column' );

add_shortcode( 'two_third', 'theme_shortcode_column' );
add_shortcode( 'three_fourth', 'theme_shortcode_column' );

add_shortcode( 'one_half_last', 'theme_shortcode_column_last' );
add_shortcode( 'one_third_last', 'theme_shortcode_column_last' );
add_shortcode( 'one_fourth_last', 'theme_shortcode_column_last' );
add_shortcode( 'foto_vertical_last', 'theme_shortcode_column_last' );

add_shortcode( 'two_third_last', 'theme_shortcode_column_last' );
add_shortcode( 'three_fourth_last', 'theme_shortcode_column_last' );

add_shortcode( 'one_fifth_last', 'theme_shortcode_column_last' );

?>