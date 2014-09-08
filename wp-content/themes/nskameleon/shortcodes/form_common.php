<?php
/**
 * Corm Pixel Shortcode
 */
function ns_form_pixel ( $atts, $content = null ) {
	$name 	= $atts['pixel_parameter_name'];
	$value 	= $atts['pixel_parameter_value'];
	$code 	= urldecode ( base64_decode ( $atts['pixel_code'] ) );
	
	return 	'<input type="hidden" name="pixels[' . $name . '][p]" value="' . $value . '" />'
			. '<input type="hidden" name="pixels[' . $name . '][c]" value="' . $code . '" />';
}

/**
 * Form CRM Shortcode
 */
function ns_form_crm ( $atts, $content = null ) {
	$url 		= $atts['crm_url'];
	$username 	= $atts['crm_username'];
	$pswd 		= $atts['crm_password'];
	
	return '';
}
add_shortcode ( 'ns_form_pixel', 'ns_form_pixel' );

register_vc_shortcode ( 
	array (
		"name" 						=> __("NS Pixel", 'nskameleon'),
		"base" 						=> "ns_form_pixel",
		// "category" 					=> __('Content', 'nskameleon'),
		"as_child" 					=> array(
			'only' => 'ns_form_servicios,ns_form_cotiza'
		),
	    "content_element" 			=> true,
	    "params" 					=> array(
       		array(
				"type" 			=> "textfield",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> __("Nombre del parámetro del Píxel"),
				"param_name" 	=> "pixel_parameter_name",
				"value" 		=> '',
				"description" 	=> __("Nombre del parámetro del Píxel.")
			),
			array(
				"type" 			=> "textfield",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> __("Valor del parámetro del Píxel"),
				"param_name" 	=> "pixel_parameter_value",
				"value" 		=> '',
				"description" 	=> __("Valor del parámetro del Píxel.")
			),
			array(
				"type" 			=> "textarea_raw_html",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> __("Código del Píxel"),
				"param_name" 	=> "pixel_code",
				"value" 		=> '',
				"description" 	=> __("Código del Píxel.")
			)
	    )
	)
);

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_NS_Form_Servicios extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_NS_Form_Cotiza extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_NS_Form_Pixel	extends WPBakeryShortCode {}
    class WPBakeryShortCode_NS_Form_Email 	extends WPBakeryShortCode {}
    // class WPBakeryShortCode_NS_Form_CRM 	extends WPBakeryShortCode {}
}
