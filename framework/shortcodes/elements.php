<?php
/// Separador
function theme_shortcode_separator( $atts ) {
    extract(shortcode_atts(array(  
        "weight" => '1',
        "color" => '#CCCCCC'
    ), $atts)); 
	return '<hr style="border-top:' . $weight . 'px '.$color.' solid" />';
}
add_shortcode( 'separator', 'theme_shortcode_separator' );
///Clearboth
function theme_shortcode_clearboth( $atts ) {
	return '<div class="clearboth"> </div>';
}

add_shortcode( 'clearboth', 'theme_shortcode_clearboth' );


/// POSTS
// Usage: [list_posts cuantos="1" categoria="xyz" post_type="posts"][/list_posts]
function theme_shortcode_posts( $atts ) {
    extract(shortcode_atts(array(  
        "cuantos" => '1',
        "categoria" => 'blog',
        "post_type"=>'posts'
    ), $atts)); 
    GLOBAL $post;
    $args = array(
            'post_type'=>$post_type,
            'category_name' => $categoria,
            'posts_per_page' => $cuantos
        );
        $rpta = '<ul class="listPosts">';
        $the_query = new WP_Query( $args );
        // The Loop
        while ( $the_query->have_posts() ) :
	       $the_query->the_post();
	       $rpta .= '
            <li>                
                <h3><a href="'.get_permalink().'">' . get_the_title() . '</a></h3> 
                '.get_the_excerpt().'               
            </li>';
        endwhile;
        $rpta .= "</ul>";
        wp_reset_query();
	return $rpta;
}
add_shortcode( 'list_posts', 'theme_shortcode_posts' );



/// Blockquote
function theme_shortcode_blockquote( $atts, $content = null ) {
    extract(shortcode_atts(array(  
        "bgcolor" => '#fff',
        "color" => '#444',
        'align'=>'none'
    ), $atts)); 
	return '<blockquote class="align'.$align.'" style="color:'.$color.'; background-color:'.$bgcolor.'">'. wpautop( trim( $content ) ).'</blockquote>';
}
add_shortcode( 'blockquote', 'theme_shortcode_blockquote' );


// Shortcode: youtube
// Usage: [youtube id="dadsadas" width="600" height="320"][/youtube]
function youtube($atts) {
    extract(shortcode_atts(array(
    'id' => 'idyoutube',
    "width" => '600',
    "height" => '450'
    ), $atts));

    return '<div class="embed-container"><iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$id.'?rel=0" frameborder="0" allowfullscreen></iframe></div>';
}
add_shortcode('youtube', 'youtube');

// Shortcode: vimeo
// Usage: [vimeo id="dadsadas" width="600" height="320"][/youtube]
function vimeo($atts) {
    extract(shortcode_atts(array(
    'id' => 'idyoutube',
    "width" => '600',
    "height" => '450'
    ), $atts));

    return '
    <div class="embed-container"><iframe width="'.$width.'" height="'.$height.'" src="http://player.vimeo.com/video/'.$id.'?rel=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
}
add_shortcode('vimeo', 'viemo');

// Literal
function literal_shortcode( $atts, $content = NULL ) {	 
	return '<div class="literal">' . $content . '</div>';
}
add_shortcode( 'literal', 'literal_shortcode' );
?>