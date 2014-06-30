<?php
/*
Plugin Name: Custom Quick Styles
Plugin URI: http://www.speckygeek.com
Description: Add custom styles in your posts and pages content using TinyMCE WYSIWYG editor. The plugin adds a Styles dropdown menu in the visual post editor.
Based on TinyMCE Kit plug-in for WordPress

http://plugins.svn.wordpress.org/tinymce-advanced/branches/tinymce-kit/tinymce-kit.php

*/
/**
 * Apply styles to the visual editor
 */  
add_filter('mce_css', 'tuts_mcekit_editor_style');
function tuts_mcekit_editor_style($url) {

    if ( !empty($url) )
        $url .= ',';

    // Retrieves the plugin directory URL and adds editor stylesheet
    // Change the path here if using different directories
    //$url .= trailingslashit( plugin_dir_url(__FILE__) ) . '/editor-styles.css';
    //$url .= trailingslashit( get_bloginfo("template_url") ) . '/css/editor-styles.css';
    $url .= get_bloginfo("template_url")  . '/css/editor-style.css';

    return $url;
}

/**
 * Add "Styles" drop-down
 */  
function tuts_mcekit_editor_buttons($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

add_filter('mce_buttons_2', 'tuts_mcekit_editor_buttons');

/**
 * Add "Styles" drop-down content or classes
 */  
function tuts_mcekit_editor_settings($settings) {
    if (!empty($settings['theme_advanced_styles']))
        $settings['theme_advanced_styles'] .= ';';    
    else
        $settings['theme_advanced_styles'] = '';

    /**
     * Add styles in $classes array.
     * The format for this setting is "Name to display=class-name;".
     * More info: http://wiki.moxiecode.com/index.php/TinyMCE:Configuration/theme_advanced_styles
     *
     * To be allow translation of the class names, these can be set in a PHP array (to keep them
     * readable) and then converted to TinyMCE's format. You will need to replace 'textdomain' with
     * your theme's textdomain.
     */
    $classes = array(
        __('Warning','textdomain') => 'warning',
        __('Celeste','textdomain') => 'celeste',
        __('Cafe','textdomain') => 'cafe',        
    );

    $class_settings = '';
    foreach ( $classes as $name => $value )
        $class_settings .= "{$name}={$value};";

    $settings['theme_advanced_styles'] .= trim($class_settings, '; ');
    return $settings;
} 

add_filter('tiny_mce_before_init', 'tuts_mcekit_editor_settings');

/*
 * Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
 * Enqueue the custom stylesheet in the front-end
 */
add_action('wp_enqueue_scripts', 'tuts_mcekit_editor_enqueue');
function tuts_mcekit_editor_enqueue() {
  $StyleUrl = plugin_dir_url(__FILE__).'editor-styles.css';
  wp_enqueue_style( 'myCustomStyles', $StyleUrl );
}
?>
