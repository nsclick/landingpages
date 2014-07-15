<?php
if ( !session_id() )
session_start();

/**
 * Session Management
 */
add_action ( 'init', 'ns_start_session' );

function ns_start_session () {
	if ( !session_id() )
		session_start();
}

add_action ( 'wp_login', 'ns_end_session' );
add_action ( 'wp_logout', 'ns_end_session' );

function ns_end_session() {
	session_destroy();
}

define('THEME_PATH', get_theme_root() . '/nskameleon');

/*
 * Loading the helpers*/
require_once(THEME_PATH . '/includes/helpers.php');

/*
 * Loading the widgets and shortcodes*/
require_once (THEME_PATH . '/load_resources.php'); 
 
 
  
/**
 * Enqueue scripts and styles for the front end.
 *
 */
function nsk_scripts() {
	
	// Stylesheets
	wp_enqueue_style( 'html5reset', get_template_directory_uri() . '/assets/css/html5reset.css', array(), null, 'all' );
	wp_enqueue_style( 'columns', get_template_directory_uri() . '/assets/css/columns.css', array(), null, 'all' );
	wp_enqueue_style( 'nsk-base', get_template_directory_uri() . '/assets/css/nskameleon-base.css', array(), null, 'all' );
	
	// Responsive Stylesheets
	wp_enqueue_style( 'nsk-1024x769', get_template_directory_uri() . '/assets/css/1024.css', array(), null, 'only screen and (max-width: 1024px) and (min-width: 769px)' );
	wp_enqueue_style( 'nsk-768x481', get_template_directory_uri() . '/assets/css/768.css', array(), null, 'only screen and (max-width: 768px) and (min-width: 481px)' );
	wp_enqueue_style( 'nsk-480', get_template_directory_uri() . '/assets/css/480.css', array(), null, 'only screen and (max-width: 480px)' );
	
	//Common
	wp_enqueue_script( 'nsk-common-js', get_template_directory_uri() . '/assets/js/common.js', array( 'jquery' ), null, true );
	
}
add_action( 'wp_enqueue_scripts', 'nsk_scripts' ); 

 

/**
 * Registering menus
 *
 */ 
function register_nsk_menu() {
  register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'register_nsk_menu' );
 

/*
if ( ! function_exists( 'header_right_sidebar' ) ) {

// Register Sidebar
function header_right_sidebar() {

	$args = array(
		'id'            => 'header-right-sidebar',
		'name'          => __( 'Header Right Sidebar', 'text_domain' ),
		'description'   => __( 'Appears in the header section at the right.', 'text_domain' ),
		'before_title'  => '<h3 class=',
		'after_title'   => '</h3>',
		'before_widget' => '<div id=',
		'after_widget'  => '</div>',
	);
	register_sidebar( $args );

}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'header_right_sidebar' );

}*/

/**
 * Clear the content
 *
 */
function nsk_the_content_cleaner( $content ) {

    //if ( is_single() ){
		//var_dump($content);
        // Add image to the beginning of each page
        $content = str_replace(array("\n", "\r", "\t"), '', $content);
	//}

    // Returns the content.
    return $content;
}
add_filter( 'the_content', 'nsk_the_content_cleaner', 5 );

function get_post_by_slug( $slug ) { 
	global $wpdb; 
	$post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_status = 'publish'", $slug ) ); 
	if ( $post ) 
		return get_post($post, OBJECT); 
	return null; 
}

function get_permalink_by_slug( $slug ){
	$post = get_post_by_slug( $slug );
	if(!$post)
		return null;
	return get_permalink($post->ID);
}

function debug ($data) {
	echo '<pre>';
	print_r ( $data );
	echo '</pre>';
}
