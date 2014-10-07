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

	$mydb = new wpdb ( 'landingpages','nsdev','website','localhost' );
	//$mydb = new wpdb ( 'devnscli_luis',']7J,(0s&#z4h','devnscli_inalco_generadorlandings_modelos','localhost' );
	$rows = $mydb->get_results("SELECT t.*,o.option_value FROM wp_terms t, wp_options o WHERE t.term_id IN (SELECT term_id FROM wp_term_taxonomy where taxonomy = 'Modelo') AND t.term_id=o.option_name ORDER BY t.name");
	
	array_walk($rows, 'models_unserialize', $mydb);
	
	$models = array();
	
	//Discard those that haven't versions due to data error
	foreach($rows as $m){
		if( !isset($m->ignore) )
			$models[] = $m;
	}
	
	return $models;
}

function models_unserialize(&$item1, $key, &$db){
    $item1->option_value = unserialize($item1->option_value);
    
    /*getting the cheapest version*/
    
    //List of versions
    $sql = "SELECT ID FROM wp_posts where ID IN (SELECT object_id FROM wp_term_relationships where term_taxonomy_id=(SELECT term_taxonomy_id FROM wp_term_taxonomy WHERE term_id={$item1->term_id})) AND post_status='publish' AND post_type='post'";
	$versions = $db->get_results($sql);
	
	$keys = array();
	if(count($versions)){
		//Get the prices
		foreach($versions as $v){
			$sql = "SELECT meta_key, meta_value FROM wp_postmeta WHERE post_id={$v->ID} AND meta_key IN ('_car_unique_reference', 'price')";
			$data = $db->get_results($sql);
			if($data[0]->meta_key == '_car_unique_reference'){
				$keys[$data[0]->meta_value] = (int) str_replace('.', '', $data[1]->meta_value);
			} else {
				$keys[$data[1]->meta_value] = (int) str_replace('.', '', $data[0]->meta_value);
			}
			
		}
		
		asort($keys);	
		$cheapest = array_chunk($keys, 1, true);
		$cheapest = $cheapest[0];
		$cheapest = array_keys($cheapest);

		$item1->option_value['id'] = $cheapest[0];

	} else {
		//Doesn't has versions, so MUST be ignored
		$item1->ignore = TRUE;
	}
	
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

function set_html_content_type() {
	return 'text/html';
}

/*
Array
(
    [action] => camiones_shortcode
    [firstname] => Nombre
    [lastname] => Apellido
    [email] => creyes@nsclick.cl
    [phone] => 897654654
    [comments] => Pruebas
    [sucursal] => Array
        (
            [name] => PUENTE ALTO
            [recipients] => Array
                (
                    [0] => achaura@inalco.cl
                )

            [ccs] => Array
                (
                    [0] => orivas@inalco.cl
                    [1] => mrodway@inalco.cl
                    [2] => aquirland@inalco.cl
                    [3] => ecastro@inalco.cl
                    [4] => jbooth@inalco.cl
                )

            [address] => Av. Concha y Toro 1120, Puente Alto - Santiago, Chile.
        )

    [crm] => true
    [rut] => 8.828.849-1
    [models] => Array
        (
            [202] => Array
                (
                    [term_id] => 202
                    [name] => NKR
                    [slug] => nkr
                    [term_group] => 0
                    [option_value] => Array
                        (
                            [id] => 5333637c-dc7c-dfcd-c6b2-5266ec7f8cdf
                            [precio_desde] => 15890000
                            [fotos] => Array
                                (
                                    [0] => Array
                                        (
                                            [url] => /new-cars/5333637c-dc7c-dfcd-c6b2-5266ec7f8cdf/gallery/nkr_01.jpg
                                            [type] => galeria
                                        )

                                    [1] => Array
                                        (
                                            [url] => /new-cars/5333637c-dc7c-dfcd-c6b2-5266ec7f8cdf/gallery/nkr_02.jpg
                                            [type] => galeria
                                        )

                                    [2] => Array
                                        (
                                            [url] => /new-cars/5333637c-dc7c-dfcd-c6b2-5266ec7f8cdf/gallery/nkr_03.jpg
                                            [type] => galeria
                                        )

                                    [3] => Array
                                        (
                                            [url] => /new-cars/5333637c-dc7c-dfcd-c6b2-5266ec7f8cdf/gallery/nkr_04.jpg
                                            [type] => galeria
                                        )

                                    [4] => Array
                                        (
                                            [url] => /new-cars/5333637c-dc7c-dfcd-c6b2-5266ec7f8cdf/nkr_fb.jpg
                                            [type] => fondo_blanco
                                        )

                                    [5] => Array
                                        (
                                            [url] => /new-cars/5333637c-dc7c-dfcd-c6b2-5266ec7f8cdf/nkr_fb_menu.jpg
                                            [type] => foto_menu
                                        )

                                )

                            [postID] => 1147
                            [categories] => Array
                                (
                                    [0] => vehiculos
                                    [1] => autos-nuevos
                                    [2] => camiones
                                )

                            [price] => 15711250
                        )

                    [foto] => /new-cars/5333637c-dc7c-dfcd-c6b2-5266ec7f8cdf/nkr_fb.jpg
                    [description] => PBV (kg.): 4.700
Capacidad de carga (Kg.): 2.800
Torque Máximo (Nm/rpm): 354/1.600
                    [$$hashKey] => 00B
                    [state] => true
                )

            [204] => Array
                (
                    [term_id] => 204
                    [name] => NQR 919 E4
                    [slug] => nqr-919-e4
                    [term_group] => 0
                    [option_value] => Array
                        (
                            [id] => 560a24ee-015f-a357-8713-5266ecc93e0e
                            [precio_desde] => 22990000
                            [fotos] => Array
                                (
                                    [0] => Array
                                        (
                                            [url] => /new-cars/560a24ee-015f-a357-8713-5266ecc93e0e/gallery/nqr-919-e4_02.jpg
                                            [type] => galeria
                                        )

                                    [1] => Array
                                        (
                                            [url] => /new-cars/560a24ee-015f-a357-8713-5266ecc93e0e/gallery/nqr-919-e4_01.jpg
                                            [type] => galeria
                                        )

                                    [2] => Array
                                        (
                                            [url] => /new-cars/560a24ee-015f-a357-8713-5266ecc93e0e/gallery/nqr-919-e4_03.jpg
                                            [type] => galeria
                                        )

                                    [3] => Array
                                        (
                                            [url] => /new-cars/560a24ee-015f-a357-8713-5266ecc93e0e/gallery/nqr-919-e4_04.jpg
                                            [type] => galeria
                                        )

                                    [4] => Array
                                        (
                                            [url] => /new-cars/560a24ee-015f-a357-8713-5266ecc93e0e/nqr_fb.jpg
                                            [type] => fondo_blanco
                                        )

                                    [5] => Array
                                        (
                                            [url] => /new-cars/560a24ee-015f-a357-8713-5266ecc93e0e/nqr_fb_menu.jpg
                                            [type] => foto_menu
                                        )

                                )

                            [postID] => 1152
                            [categories] => Array
                                (
                                    [0] => vehiculos
                                    [1] => autos-nuevos
                                    [2] => camiones
                                )

                            [price] => 22735000
                        )

                    [foto] => /new-cars/560a24ee-015f-a357-8713-5266ecc93e0e/nqr_fb.jpg
                    [description] => PBV (kg.): 4.700
Capacidad de carga (Kg.): 2.800
Torque Máximo (Nm/rpm): 354/1.600
                    [$$hashKey] => 009
                    [state] => true
                )

        )

)
* */
