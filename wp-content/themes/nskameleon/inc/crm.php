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
		
	function send_quote($data){
		
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
}

/*
 * Send Quote to CRM
 * @Params
 * $data["source"] Lead source, default 'landing'
 * $data["rut"]
 * $data[email]
 * $post["telefono"]
 * $post["nombre"]
 * $post["comentario"]
 * $post["products"] = array() with CRM products id Ex: array('e2e800fc-fb8b-da6e-1b4c-5279742402c0', b72e1a96-cde7-4414-ffc1-527974fb3c9e)
 * 
 * @return json response
 * 
 * */
function send_quote($data){
		
	$crmBind = array(
		'lead_source' 					=> $data["source"] ? $data["source"] : 'landing' ,
		'rut' 							=> str_replace(array('.', ',',' ', '-', '_', '/'), '', $data["rut"]),
		'email' 						=> $data["email"],
		'telefono' 						=> $data["telefono"],
		'como_nos_conocio' 				=> 'Landing Page',
		'name' 							=> $data["nombre"],
		'comentarios_datos_personales' 	=> $data["comentario"],	
		'products' 						=> $data["products"]
	);
		
	$crm = new Crm;
	return $crm->send_quote($crmBind);
}
