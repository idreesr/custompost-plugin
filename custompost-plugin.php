<?php
/*
 * Plugin Name: Custom Post Type Plugin
 * Plugin URI: https://www.sheridancollege.ca/
 * Description: A plugin that adds a custom post type, widget, and shortcode  
 * Author: Rida Idrees
 * Author URI: https://www.sheridancollege.ca/
 * Version: 1.0 
 */

// Enqueues the plugin's stylesheet
function add_plugin_styles() {
	wp_enqueue_style('plugin-style', plugins_url('/css/style.css', __FILE__));
}
add_action( 'wp_enqueue_scripts', 'add_plugin_styles' );

// this function creates a custom post type
function cp_type() {
  register_post_type( 'cp_design',
    array(
      'labels' => array(
        'name' => __( 'Design' ),
        'singular_name' => __( 'Design' )
      ),
      'public' => true,
      'has_archive' => true,
      // adding support for featured images, etc. in the CPT post editor
      'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
    )
  );
}
add_action( 'init', 'cp_type' );




?>