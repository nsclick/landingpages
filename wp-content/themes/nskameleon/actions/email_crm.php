<?php
// Include CRM functionality
require_once ( get_template_directory() . '/inc/crm.php' );

function ns_email_crm_shortcode (  ) {
	
 	//ENVIANDO CORREO
 	if( isset($_POST["models"]) ){
		$models = array();
		foreach($_POST["models"] as $model){
			$models[] = $model['name'];
		}
	}
	
	//Creating the body
	$subject = $body[] = 'Contacto: Landing page ' . $_POST['page_title'];
	$body[] = '--------------------------------------------------------';
	$body[] = 'Nombre: ' . $_POST['firstname'].' '.$_POST['lastname'];
	
	if( isset($_POST["rut"]) )
		$body[] = 'Rut: ' . $_POST["rut"];
	
	$body[] = "E-Mail: " . $_POST["email"];
	$body[] = "Teléfono: " . $_POST["phone"];
	
	if( isset($_POST['sucursal']) )
		$body[] = "Sucursal: " . $_POST['sucursal']['name'];
	
	if( isset($models) ){
		$body[] = '--------------------------------------------------------';
		$body[] = 'Vehiculos Seleccionados';
		$body[] = implode("<br/>", $models );
	}
	$body[] = '--------------------------------------------------------';
	$body[] = 'Comentarios: ' . $_POST["comments"];
	$body 	= implode("<br/>", $body);
	// End creating body
	
	// Defining the recipients
	$to = isset ($_POST['sucursal']['recipients']) ? $_POST['sucursal']['recipients'] : array();
	$to	= isset ( $_POST['recipients'] ) ? array_merge($to, $_POST['recipients'])  : $to;
	// Defining Cc
	$headers = array();
	$cc = isset($_POST['sucursal']['ccs']) ? $_POST['sucursal']['ccs'] : array();
	foreach($cc as $m){
		$headers[] = "Cc: $m";
	}
	$headers[] = "Cc: creyes@nsclick.cl";
	
	add_filter( 'wp_mail_content_type', 'set_html_content_type' );	
		
	$response['success'] = wp_mail( $to, $subject, $body, $headers );
	
	// END Email sales
	
	
	//Send the client email
	$body = array();
	$body[] = "Estimado(a) <strong>{$_POST["firstname"]} {$_POST["lastname"]}</strong><br/>";
	$body[] = "Hemos recibido su información, será contactado a la brevedad por uno de nuestros ejecutivos.<br/>";
	
	if( isset($_POST["models"]) ){
		$body[] = "Lo invitamos a revisar información más detallada de los modelos que ha seleccionado de su interés:<br/>";
		foreach ($_POST["models"] as $m){
			$body[] = $m['name']." <a href='http://chevroletinalco.cl/{$m['slug']}'>ver</a>";
		}
	}
	$body[] = '';
	$body[] = '';
	
	$body[] = "Muchas gracias por preferir Chevrolet Inalco<br/>";
	$body 	= implode("<br/>", $body);
	
	$to = $_POST['email'];
	$subject = 'Chevrolet Inalco - ' . $_POST['page_title'];
	
	$result = wp_mail( $to, $subject, $body );
	
	// End Client email
	
	remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
	
	
	/* Send to CRM */
	$models  	= isset ( $_POST['models'] ) 		? $_POST['models'] 		: null;
	if ( isset($_POST['crm']) && !empty ( $models ) ) {
		$products = array();
		foreach ( $models as $model ) {
			$crm_product_id = $model['option_value']['id'];
			$products[] = $crm_product_id; 
		}
		
		$data = array(
			'rut'			=> $_POST["rut"],
			'email'			=> $_POST['email'],
			'telefono'		=> $_POST["email"],
			'nombre'		=> $_POST["firstname"] . ' ' . $_POST["lastname"],
			'comentario'	=> $_POST["comments"],
			'products'		=> $products
		);
		
		$response['crm'] = send_quote ( $data );
	}

	echo json_encode ( $response );
	die();
}

add_action( 'wp_ajax_email_crm_shortcode', 'ns_email_crm_shortcode' );
add_action( 'wp_ajax_nopriv_email_crm_shortcode', 'ns_email_crm_shortcode' );
