<?php

function ns_camiones_shortcode (  ) {
	
	//Send the sales email
	$message = "Contacto: Landing page Camiones</strong><br><br>";
    $message .= "Nombre: {$_POST['firstname']} {$_POST['lastname']}<br>";
	$message .= "E-Mail: {$_POST['email']}<br>";
    $message .= "Tel&eacute;fono: {$_POST['phone']}<br>";
	$message .= "Sucursal: {$_POST['sucursal']['name']}<br>";
	$message .= "Vehiculos Seleccionados<br>";

	foreach($_POST["models"] as $model){
		$message .= "- " . $model['name'] . "<br>";
	}
	$message .= "--------------------------------------------------------<br>";
	$message .= "Mensaje: {$_POST['comments']}<br>";
	
	$recipients	= isset ( $_POST['recipients'] ) 	? $_POST['recipients'] 	: null;
	
	$to = is_array($recipients) ? array_merge($_POST['sucursal']['recipients'], $recipients) : $to;
	
	$headers = array();
	$cc = is_array($_POST['sucursal']['ccs']) ? $_POST['sucursal']['ccs'] : array();
	foreach($cc as $m){
		$headers[] = "Cc: $m";
	}
	
	$subject = "Contacto desde Pagina web www.chevroletinalco.cl/camiones";
	
	add_filter( 'wp_mail_content_type', 'set_html_content_type' );	
	
	$response['success'] = wp_mail( $to, $subject, $message, $headers );
	
	//Debug
//	$headers = array('Cc: creyes@nsclick.cl');	
//	$response['success'] = wp_mail( 'cesar.cesarreyes@gmail.com', $subject, $message, $headers );

	//Send the client email
	$message = "Estimado(a) <strong>{$_POST['firstname']} {$_POST['lastname']}</strong><br/><br/>";
	$message .= "Hemos recibido su información, será contactado a la brevedad por nuestro ejecutivo: <br/>";
	$message .= "Nombre: {$_POST['sucursal']['recipients'][0]}<br/>";
	$message .= "Sucursal: {$_POST['sucursal']['name']} - {$_POST['sucursal']['address']}<br/><br/>";
	$message .= "Lo invitamos a revisar información más detallada de los modelos que ha seleccionado de su interés:<br/>";		
	
	$to = $_POST['email'];
	$subject = "Contacto recibido desde www.chevroletinalco.cl";

	$result = wp_mail( $to, $subject, $message );
	
	//Debug
//	$result = wp_mail( 'cesar.cesarreyes@gmail.com', $subject, $message);

	
	remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
	echo json_encode ( $response );
	die();
}

add_action( 'wp_ajax_camiones_shortcode', 'ns_camiones_shortcode' );
add_action( 'wp_ajax_nopriv_camiones_shortcode', 'ns_camiones_shortcode' );
