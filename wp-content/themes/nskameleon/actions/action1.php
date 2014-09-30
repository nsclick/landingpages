<?php
// Include CRM functionality
require_once ( get_template_directory() . '/inc/crm.php' );

function ns_action1_shortcode (  ) {
	$response = array(
		'success' => false
	);
	
	$response['p'] 			= $_POST;
	$response['success'] 	= true;
	
	$firstname 	= isset ( $_POST['firstname'] ) 	? $_POST['firstname'] 	: null;
	$lastname 	= isset ( $_POST['lastname'] ) 		? $_POST['lastname'] 	: null;
	$lastname 	= isset ( $_POST['lastname'] ) 		? $_POST['lastname'] 	: null;
	$phone 		= isset ( $_POST['phone'] ) 		? $_POST['phone'] 		: null;
	$email 		= isset ( $_POST['email'] ) 		? $_POST['email'] 		: null;
	$sucursal 	= isset ( $_POST['sucursal'] ) 		? $_POST['sucursal'] 	: null;
	$recipients	= isset ( $_POST['recipients'] ) 	? $_POST['recipients'] 	: null;
	$models  	= isset ( $_POST['models'] ) 		? $_POST['models'] 		: null;
	$rut 		= isset ( $_POST['rut'] ) 			? $_POST['rut'] 		: null;
	$comments 	= isset ( $_POST['comments'] ) 		? $_POST['comments'] 	: null;
	
	/* There was a sucursal selected */
	if ( !empty ( $sucursal ) ) {
		$emails = array_merge ( $sucursal['recipients'], $sucursal['ccs'] ); // Join sucursal recipients with ccs
//		wp_mail ( $emails, 'Sucursal Email Subject', 'Body of the Sucursal email.' );
	}
	
	/* There are fixed recipients */
	if ( !empty ( $recipients ) ) {
//		wp_mail ( $recipients, 'Recipients Email Subject', 'Body of the recipients email.' );
	}
	
	/* Send user */
	if ( !empty ( $email ) ) {
//		wp_mail ( $email, 'Client Email Subject', 'Body of the client email.' );
	}
	
	/* Send to CRM */
	if ( !empty ( $models ) ) {
		$products = array();
		foreach ( $models as $model ) {
			$crm_product_id = $model['option_value']['id'];
			$products[] = $crm_product_id; 
		}
		
		$data = array(
			'rut'			=> $rut,
			'email'			=> $email,
			'telefono'		=> $phone,
			'nombre'		=> $firstname . ' ' . $lastname,
			'comentario'	=> $comments,
			'products'		=> $products
		);
		
		$response['crm'] = send_quote ( $data );
	}
	
	
	echo json_encode ( $response );
	die();
}
	
add_action( 'wp_ajax_action1_shortcode', 'ns_action1_shortcode' );
add_action( 'wp_ajax_nopriv_action1_shortcode', 'ns_action1_shortcode' );

?>