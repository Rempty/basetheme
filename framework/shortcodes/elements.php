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


/// Highlight
function theme_shortcode_highlight( $atts, $content = null ) {
    extract(shortcode_atts(array(  
        "bgcolor" => '#fff',
        "color" => '#444'        
    ), $atts)); 
	return '<span class="highlight" style="color:'.$color.'; background-color:'.$bgcolor.'">'.$content.'</span>';
}
add_shortcode( 'highlight', 'theme_shortcode_highlight' );



// Shortcode: radio
// Usage: [radio rurl="http://ejemplo/cancion.mp3"][/radio]
function theme_radio($atts){
    global $post; 
    $postid = $post->ID;
    extract(shortcode_atts(array(  
        "rurl" => ''
    ), $atts)); 
    //$rurl=get_post_meta($postid, 'theme_trabajos_spot', true);
    $ret='<div class="clearboth"></div><br/>';
    if($rurl!=''){
        $ret.='<div class="radio">';
        $ret.='<audio controls>
            <source src="'.$rurl.'" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio> ';
        $ret.='</div>';
    }
    return $ret;
}
add_shortcode( 'radio', 'theme_radio' );

// Shortcode: accordion_toggle
// Usage: [accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle]
function accordion_toggle_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    global $single_accordion_toggle_array;
    $single_accordion_toggle_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
    return $single_accordion_toggle_array;
}
add_shortcode('accordion_toggle', 'accordion_toggle_func');

/* Shortcode: accordion
 * Usage:   [accordion]
 * 		[accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle]
 * 		[accordion_toggle title="title 2"]Your content goes here...[/accordion_toggle]
 * 	    [/accordion]
 */
function accordion_func( $atts, $content = null ) {
    global $single_accordion_toggle_array;
    $single_accordion_toggle_array = array(); // clear the array

    $accordion_output = '<div class="clear"></div>';
    $accordion_output .= '<div class="accordion-wrapper">';
    do_shortcode($content); // execute the '[accordion_toggle]' shortcode first to get the title and content
    foreach ($single_accordion_toggle_array as $tab => $accordion_toggle_attr_array) {
	$accordion_output .= '<h3 class="accordion-toggle"><a href="#">'.$accordion_toggle_attr_array['title'].'</a></h3>';
        $accordion_output .= '<div class="accordion-container">';
        $accordion_output .= '  <div class="content-block">'.$accordion_toggle_attr_array['content'].'</div>';
        $accordion_output .= '</div><!-- end accordion-container -->';
    }
    $accordion_output .= '</div><!-- end accordion-wrapper -->';
    $accordion_output .= '<div class="clear"></div>';
    return $accordion_output;
}
add_shortcode('accordion', 'accordion_func');

// Shortcode: toggle_content
// Usage: [toggle_content title="Title XD"]Your content goes here...[/toggle_content]
function toggle_content_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    $html = '<h4 class="slide_toggle"><a href="#">' .$title. '</a></h4>';
    $html .= '<div class="slide_toggle_content" style="display: none;">'.do_shortcode($content).'</div>';
    return $html;
}
add_shortcode('toggle_content', 'toggle_content_func');


// Shortcode: youtube
// Usage: [youtube id="dadsadas" width="600" height="320"][/youtube]
function youtube($atts) {
    extract(shortcode_atts(array(
    'id' => 'idyoutube',
    "width" => '600',
    "height" => '450'
    ), $atts));

    return '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
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
    <iframe width="'.$width.'" height="'.$height.'" src="http://player.vimeo.com/video/'.$id.'?rel=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
}
add_shortcode('vimeo', 'viemo');

// Shortcode: tab
// Usage: [tab title="title 1"]Your content goes here...[/tab]
function tab_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    global $single_tab_array;
    $single_tab_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
    return $single_tab_array;
}
add_shortcode('tab', 'tab_func');

/* Shortcode: tabs
 * Usage:   [tabs]
 * 		[tab title="title 1"]Your content goes here...[/tab]
 * 		[tab title="title 2"]Your content goes here...[/tab]
 * 	    [/tabs]
 */
function tabs_func( $atts, $content = null ) {
    global $single_tab_array;
    $single_tab_array = array(); // clear the array

    $tabs_nav = '<div class="clear"></div>';
    $tabs_nav .= '<div class="tabs-wrapper">';
    $tabs_nav .= '<ul class="tabs">';
    do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content
    $tabs_content = '';
    $tabs_output = '';
    foreach ($single_tab_array as $tab => $tab_attr_array) {
	$random_id = rand(1000,2000);
	$default = ( $tab == 0 ) ? ' class="defaulttab"' : '';
	$tabs_nav .= '<li><a href="javascript:void(0)"'.$default.' rel="tab'.$random_id.'"><span>'.$tab_attr_array['title'].'</span></a></li>';
	$tabs_content .= '<div class="tab-content" id="tab'.$random_id.'"><div class="tabs-inner-padding">'.$tab_attr_array['content'].'</div></div>';
    }
    $tabs_nav .= '</ul>';
    $tabs_output .= $tabs_nav . $tabs_content;
    $tabs_output .= '</div><!-- tabs-wrapper end -->';
    $tabs_output .= '<div class="clear"></div>';
    return $tabs_output;
}
add_shortcode('tabs', 'tabs_func');



// Divider
function theme_shortcode_hr( $atts, $content = null ) {
    extract(shortcode_atts(array(  
        "weight" => '1',
        "color" => '#CCCCCC',
        'style'=>'dotted'
    ), $atts)); 
	return '<div class="divider" style="border-bottom:'.$weight.'px '.$color.' '.$style.';"></div>';
}
add_shortcode( 'divider', 'theme_shortcode_hr' );


// Margin
function theme_shortcode_margin( $atts, $content = null ) {
    extract(shortcode_atts(array(  
        "size" => '5'        
    ), $atts)); 
	return '<div style="margin-bottom:'.$size.'px ;"></div>';
}
add_shortcode( 'margin', 'theme_shortcode_margin' );


// Literal
function literal_shortcode( $atts, $content = NULL ) {	 
	return '<div class="literal">' . $content . '</div>';
}
add_shortcode( 'literal', 'literal_shortcode' );


// Alerts
function theme_shortcode_alert( $atts, $content = null ) {
    extract(shortcode_atts(array(  
        "style" => '1'        
    ), $atts));
    
    $styles = array(
        '1' => 'success',
        '2' => 'info',
        '3' => 'warning',
        '4' => 'danger'        
    );
	return '<div class="alert alert-'.$styles[$style].'">'.$content.'</div>';
}
add_shortcode( 'alert', 'theme_shortcode_alert' );


// Progress Bar
function theme_shortcode_pbar( $atts, $content = null ) {
    extract(shortcode_atts(array(  
        "size" => '75',        
        'style'=>'1',        
    ), $atts)); 
    
    $styles = array(
        '1' => 'default',
        '2' => 'primary',
        '3' => 'success',
        '4' => 'info',
        '5' => 'warning',
        '6' => 'danger',
        '7' => 'link'
    );
	return '
    <div class="progress">
    <div style="width: '.$size.'%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="'.$size.'" role="progressbar" class="progress-bar progress-bar-'.$styles[$style].'">
    <span class="sr-only">'.$size.'% Complete</span></div>
    </div>
    ';
}
add_shortcode( 'pbar', 'theme_shortcode_pbar' );
?>