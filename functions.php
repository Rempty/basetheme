<?php
define( "THEME_DIR", get_template_directory() );
define( "THEME_DIR_URL", get_template_directory_uri() );
define( "THEME_NAME", 'Plantilla base' );
define( "THEME_SLUG", 'mibase' );
define( "THEME_STYLES", THEME_DIR_URL . "/css" );
define( "THEME_FRAMEWORK", THEME_DIR . "/framework" );


// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'basetheme', THEME_DIR . '/languages' );                
        
        
        $locale = get_locale();
        $locale_file = THEME_DIR . "/languages/$locale.php";
        if ( is_readable($locale_file) ) {
            require_once($locale_file);
        } 
               
    
	// Add RSS links to <head> section
	add_theme_support( 'automatic-feed-links' );
	
	// Load jQuery
	function mytheme_enqueue_scripts() {
       wp_deregister_script('jquery');
       wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"), false, '1.11.1');
       wp_enqueue_script('jquery');
    }
    add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => __('Sidebar Widgets','html5reset' ),
    		'id'   => 'sidebar-widgets',
    		'description'   => __( 'These are widgets for the sidebar.','html5reset' ),
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>'
    	));
    }
    
    register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'mytheme' ),
	) );
    
    // Disable Autoformat
    function my_formatter($content) {
        $new_content = '';
        $pattern_full = '{(\[raw\].*?\[/raw\])}is';
        $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
        $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

        foreach ($pieces as $piece) {
            if (preg_match($pattern_contents, $piece, $matches)) {
                $new_content .= $matches[1];
            } else {
                $new_content .= wptexturize(wpautop($piece));
            }
        }

        return $new_content;
    }

    remove_filter('the_content', 'wpautop');
    remove_filter('the_content', 'wptexturize');
    add_filter('the_content', 'my_formatter', 99);
    
    
    
    if ( function_exists( 'add_theme_support' ) ) { 
        add_theme_support( 'post-thumbnails' ); 
        set_post_thumbnail_size( 300, 112, true );
        add_image_size( 'lansdscape-thumb', 860, 300, true );  
        add_image_size( 'mini-thumb', 70, 70, true );
    }
    
    /*********************************************************
    Incorpora Framework
    *********************************************************/     
	require_once THEME_DIR . "/meta-box-class/my-meta-box-class.php"; 
    require_once THEME_FRAMEWORK . "/post-types/slider_define.php";    
    require_once THEME_FRAMEWORK . "/admin/admin-recientes.php";
    require_once THEME_FRAMEWORK . "/admin/customizer.php";
	require_once THEME_FRAMEWORK . "/shortcodes/elements.php";    
    require_once THEME_FRAMEWORK . "/sidebar_generator.php";    
    require_once THEME_FRAMEWORK . "/widgets.php";
    
    

 
// Gallery shortcode to modify for link="none". 
function modified_gallery_shortcode($attr) {
    global $post, $wp_locale;
    $output = gallery_shortcode($attr);
   // remove link
   if($attr['link'] == "none") {
     $output = preg_replace(array('/<a[^>]*>/', '/<\/a>/'), '', $output);
   }
return $output;
}
add_shortcode( 'gallery', 'modified_gallery_shortcode' );

/**
 * Checks whether a dynamic sidebar exists
 *
 * @param string $sidebar_name, sidebar name
 * @return bool True, if sidebar exists. False otherwise.
 */
function sidebar_exist( $sidebar_name ) {
    global $wp_registered_sidebars;
    foreach ( (array) $wp_registered_sidebars as $index => $sidebar ) {
	if ( in_array($sidebar_name, $sidebar) )
	    return true;
    }
    return false;
}

/**
 * Checks whether a dynamic sidebar exists and if is active (has any widgets)
 *
 * @param string $sidebar_name, sidebar name
 * @return bool True, if exists and active (using widgets). False otherwise.
 */
function sidebar_exist_and_active( $sidebar_name ) {
    global $wp_registered_sidebars;
    foreach ( (array) $wp_registered_sidebars as $index => $sidebar ) {
	if ( in_array($sidebar_name, $sidebar) ) {
	    return is_active_sidebar( $sidebar['id'] );
	}
    }
    return false;
}
// Return the column (widget area) HTML
function get_dynamic_column( $id = '', $class = '', $widget_area = '' ) {
    return "<div id='{$id}' class='{$class}'><div class='column-content-wrapper'>".udesign_get_dynamic_sidebar( $widget_area )."</div></div><!-- end {$id} -->";
}
// Currently there is no available function to return the contents of a dynamic sidebar. Therefore use this one:
function udesign_get_dynamic_sidebar($index = '') {
	$sidebar_contents = "";
	ob_start();
        if ( function_exists('dynamic_sidebar') && dynamic_sidebar( $index ) )
	$sidebar_contents = ob_get_clean();
	return $sidebar_contents;
}

add_filter('widget_text', 'do_shortcode');

/*Sidebar Selector*/

function sidebar( $post_id = NULL )
		{
				sidebar_generator( 'get_sidebar', $post_id );
		}

/// Pagination
function wp_pagination($wp_query) {
	global $wp_rewrite;    
	$pages = '';
	$max = $wp_query->max_num_pages;
	if (!$current = get_query_var('paged')) $current = 1;
	$a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
	$a['total'] = $max;
	$a['current'] = $current;

	$total = 1; //1 - display the text "Page N of N", 0 - not display
	$a['mid_size'] = 5; //how many links to show on the left and right of the current
	$a['end_size'] = 1; //how many links to show in the beginning and end
	//$a['prev_text'] = '<'; //text of the "Previous page" link
    $a['prev_text'] = '<img src="'.get_bloginfo("template_url").'/img/navizq.png" />';
	$a['next_text'] = '<img src="'.get_bloginfo("template_url").'/img/navder.png" />';

	if ($max > 1) echo '<div class="navigation">';
	if ($total == 1 && $max > 1) {
	   //$pages = '<span class="pages">Page ' . $current . ' of ' . $max . '</span>'."\r\n";
	   echo $pages . paginate_links($a);
    }
	if ($max > 1) echo '</div>';
}


// Favicon 
function prefix_custom_site_icon_size( $sizes ) {
   $sizes[] = 64;
 
   return $sizes;
}
add_filter( 'site_icon_image_sizes', 'prefix_custom_site_icon_size' );
 
function prefix_custom_site_icon_tag( $meta_tags ) {
   $meta_tags[] = sprintf( '<link rel="icon" href="%s" sizes="64x64" />', esc_url( get_site_icon_url( null, 64 ) ) );
 
   return $meta_tags;
}
add_filter( 'site_icon_meta_tags', 'prefix_custom_site_icon_tag' );	
?>