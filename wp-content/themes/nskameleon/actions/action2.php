<?php
	
function ns_action2_shortcode (  ) {
	$response = array(
		'success' => false
	);
	
	$response['p'] = $_POST;
	$response['success'] = true;
	
	echo json_encode ( $response );
	die();
}
	
add_action( 'wp_ajax_action2_shortcode', 'ns_action2_shortcode' );
add_action( 'wp_ajax_nopriv_action2_shortcode', 'ns_action2_shortcode' );

?>