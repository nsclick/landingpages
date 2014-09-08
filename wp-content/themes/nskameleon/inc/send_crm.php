<?php

// define('CRM_URL', 'http://crm.inalco.cl');
define('CRM_URL', 'http://crm.inalco.cl/dev');

function _curl($url, $query) {
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	//die("$url?$query");
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => "$url?$query",
	    CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:24.0) Gecko/20100101 Firefox/24.0'
	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);

	if(curl_errno($curl)){
		return json_encode(array('error' => curl_error($curl))); 
	}
	
	// Close request to clear up some resources
	curl_close($curl);
	return strip_tags(trim($resp));
}

class Crm{
	
//	var $url = "http://198.20.234.144/~scrmcstm/inalcocl/index.php";
	var $url = NULL;
	
	function __construct(){
		$this->url = CRM_URL . "/index.php";
	}
		
	function send_cotizacion($data){
		//Send email backup
		//$this->sendBackupEmail ( $data );
		
		//Set the operation
		$data['entryPoint'] = 'CreateQuote';
		
		//Format the products_ids
		$n_products = array();
		foreach($data['products'] as $p){
			$n_products[$p] = 1;
		}
		
		$data['products'] = $n_products;
		
		//echo $this->url . '?' . http_build_query($data);die();
		$result = _curl($this->url, http_build_query($data));
		
		$result = json_decode($result);
		
	    return $result;

	}
	
	/**
	 * sendBackupEmail
	 */
	private function sendBackupEmail ( $data = null ) {
		require_once('phpmailer_v5.1/class.phpmailer.php');

		$mailer = new PHPMailer;
		$mailer->isSMTP();                                      // Set mailer to use SMTP
		$mailer->Host = 'smtp.inalco.cl';  // Specify main and backup server
		$mailer->SMTPAuth = true;                               // Enable SMTP authentication
		$mailer->Username = 'inalcocrm@inalco.cl';                            // SMTP username
		$mailer->Password = '?Sj@4z~HNZUM';                           // SMTP password
		$mailer->CharSet = 'UTF-8';                 // UTF-8 encoding

		$mailer->From = 'inalcocrm@inalco.cl';
		$mailer->FromName = 'Inalco Website';

		// $mailer->addAddress( 'contactoweb@inalco.cl', '');
		$mailer->addAddress( 'contactoweb@inalco.cl', '');

		$mailer->Subject = 'Solicitud de Cotización - WEB';
		$mail_body = '';

		foreach ( $data['cars_names'] as $index => $car_name ) {
			$i = $index + 1;
			$mail_body .= "[{$i}] {$car_name}\n";
		}
		
		$mail_body .= "\nProspecto\n\n";
		$mail_body .= "Nombre: {$data['name']}\n";
		$mail_body .= "RUT: {$data['rut']}\n";
		$mail_body .= "Tel: {$data['telefono']}\n";
		$mail_body .= "Email: {$data['email']}\n";
		if ( isset ( $data['financiamiento'] ) ) {
			$modo_de_pago = $data['financiamiento'] == 'si' ? 'Crédito' : 'Contado';
			$mail_body .= "Medio Pago: {$modo_de_pago}\n";
		}
		if ( isset ( $data['pie'] ) ) {
			$mail_body .= "Monto Pie: {$data['pie']}\n";
		}
		if ( isset ( $data['cuotas'] ) ) {
			$mail_body .= "Cuotas: {$data['cuotas']}\n";
		}

		$mailer->Body    = $mail_body;
		$sent = $mailer->send();
	}
}
