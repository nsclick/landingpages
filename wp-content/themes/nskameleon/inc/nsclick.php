<?php

/**
 * include_once for php files within dir
 * */
function include_php_files($dir){
	$files = list_php_files ( $dir );
	
	foreach ( $files as $file ) {		
		include $dir . DIRECTORY_SEPARATOR . $file ;
	}

	return $files;
}

/**
 * Get list of php files within a dir
 */
function list_php_files ( $dir ){
	
	$files 	= scandir($dir); // returns array of files, sorted alphabetically
	$_files = array();

	foreach($files as $file) {
		$filename = $dir.DIRECTORY_SEPARATOR.$file;
		if(is_file($filename)) {
			$file_parts = pathinfo($filename);
			if($file_parts['extension'] == 'php') {
				$_files[] = $file;
			}
		}
	}

	return $_files;
}

/**
 * Register shortcodes
 * */
function nsk_shortcodes_init() {
	$dir = get_template_directory() . DIRECTORY_SEPARATOR . "shortcodes";
	include_php_files($dir);	
}
add_action( 'init', 'nsk_shortcodes_init');


/**
 * Register actions
 */
function nsk_actions_init () {
	$actions_dir 	= get_template_directory() . DIRECTORY_SEPARATOR . "actions";
	$actions_list 	= include_php_files ( $actions_dir );
}
add_action ( 'init', 'nsk_actions_init' );

/**
 * Register shortcodes
 * */
function nsk_custom_widgets_init() {
	$dir = get_template_directory() . DIRECTORY_SEPARATOR. "widgets";
	include_php_files($dir);	
}
add_action( 'init', 'nsk_custom_widgets_init');


$vc_shortcodes = array();
/**
 * Register VC shortodes
 * */
function register_vc_shortcode($data){
	$GLOBALS['vc_shortcodes'][$data['base']] = $data;
}

/**
 * 
 * */
function nsk_load_shortcodes_to_vs() {
	foreach($GLOBALS['vc_shortcodes'] as $data){
		//debug_var($data);
		vc_map($data);
	}
}
add_action( 'init', 'nsk_load_shortcodes_to_vs' );
 
 
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
//add_filter( 'the_content', 'nsk_the_content_cleaner', 5 );

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


function get_models(){
//	return array ();

	//$mydb = new wpdb ( 'landingpages','nsdev','website','localhost' );
	$mydb = new wpdb ( 'devnscli_luis',']7J,(0s&#z4h','devnscli_inalco_generadorlandings_modelos','localhost' );
	$rows = $mydb->get_results("SELECT t.*,o.option_value FROM wp_terms t, wp_options o WHERE t.term_id IN (SELECT term_id FROM wp_term_taxonomy where taxonomy = 'Modelo') AND t.term_id=o.option_name ORDER BY t.name");
	
	array_walk($rows, 'models_unserialize');
	
	return $rows;
}

function models_unserialize(&$item1, $key, $prefix=0){
    $item1->option_value = unserialize($item1->option_value);
}

function debug_var ($data) {
	echo '<pre>';
	print_r ( $data );
	echo '</pre>';
}

function ns_load_scripts(){
	//wp_enqueue_script( 'jquery.base64',get_template_directory_uri() . '/js/jquery.base64.js', 'jquery', false);	
}
add_action('wp_enqueue_scripts', 'ns_load_scripts');
add_action('admin_enqueue_scripts', 'ns_load_scripts');
