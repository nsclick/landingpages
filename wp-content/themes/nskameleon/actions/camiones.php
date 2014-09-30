<?php

function ns_camiones_shortcode (  ) {
	
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
	
	echo json_encode ( $response );

	die();
}

add_action( 'wp_ajax_camiones_shortcode', 'ns_camiones_shortcode' );
add_action( 'wp_ajax_nopriv_camiones_shortcode', 'ns_camiones_shortcode' );
