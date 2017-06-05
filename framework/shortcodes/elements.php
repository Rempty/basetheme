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
add_shortcode('vimeo', 'vimeo');

// Literal
function literal_shortcode( $atts, $content = NULL ) {	 
	return '<div class="literal">' . $content . '</div>';
}
add_shortcode( 'literal', 'literal_shortcode' );


/// Div
function theme_shortcode_div( $atts, $content = null ) {
    extract(shortcode_atts(array(  
        "class" => '',        
        "href" => ''        
    ), $atts)); 
	if($href != "") { 
		return '
		<div class="div '.$class.'">
			'. do_shortcode(trim( $content )).'
			<a class="circulo__link" href="'.$href.'">link</a>
		</div>'; 
	} else {
		return '<div class="'.$class.'">'. do_shortcode(trim( $content )).'</div>';
	}
}
add_shortcode( 'div', 'theme_shortcode_div' );


/// Span
function theme_shortcode_span( $atts, $content = null ) {
    extract(shortcode_atts(array(  
        "class" => ''        
    ), $atts)); 
	return '<span class="'.$class.'">'. trim( $content ).'</span>';
}
add_shortcode( 'span', 'theme_shortcode_span' );


/// Sections
function theme_shortcode_section( $atts, $content = null ) {
    extract(shortcode_atts(array(  
        "class" => '',        
        "id" => ''        
    ), $atts)); 	
	return '<section id="'.$id.'" class="'.$class.'">'. do_shortcode(trim( $content )).'</section>';	
}
add_shortcode( 'section', 'theme_shortcode_section' );


// Shortcodes productos
function shortcode_productos( $atts ) {
    extract(shortcode_atts(array(  
        "cuantos" => '99',
        "seccion" => '3'        
    ), $atts)); 
    $rpta = productos__mostrar($seccion, $cuantos);
	return $rpta;
}
add_shortcode( 'productos', 'shortcode_productos' );


// Shortcodes Slide
function theme_shortcode_slide( $atts ) {
    extract(shortcode_atts(array(  
        "id" => '1',        
    ), $atts)); 
    GLOBAL $post;
    $args = array(
            'post_type'=>'mkt_slider',            
            'posts_per_page' => -1,
			'p' => $id
        );
        $rpta = '	
		<div class="mislide cycle-slideshow" data-cycle-fx="scrollHorz" data-cycle-fx="fade" data-cycle-timeout="4000" data-cycle-slides=" >.banner__image " >
		<div class="cycle-pager"></div>';
        $the_query = new WP_Query( $args );
        // The Loop
        while ( $the_query->have_posts() ) :
	       $the_query->the_post();
		   $id = get_the_ID();
		   $laimagen = get_post_meta($id, 'mkt_re_', true);		   
		   foreach ($laimagen as $arr){
			   $imagen = $arr['mkt_image_imagen'];
			   $titulo = $arr['mkt_re_text_titulo'];
			   $subtitulo = $arr['mkt_re_text_subtitulo'];
			   $link = $arr['mkt_re_text_link'];
			   $boton = $arr['mkt_re_text_button'];
				$rpta .= '				
				<div class="banner__image" style="background-image:url('.$imagen["url"].')">
                    <div class="container">
                        <h2>'.$titulo.'</h2>
                        <h3>'.$subtitulo.'</h3>
                        <a class="btn btn-red" href="'.$link.'">'.$boton.'</a>
                    </div>
				</div>';
		   }
        endwhile;
        $rpta .= '</ul>';
        wp_reset_query();
	return $rpta;
}
add_shortcode( 'slider', 'theme_shortcode_slide' ); 
?>