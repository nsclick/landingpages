<?php
function ns_csv_list_shortcode( $atts ) {
	ob_start();
?>
<?php
return ob_get_clean();	
}
add_shortcode( 'csv_list', 'ns_csv_list_shortcode' );

register_vc_shortcode(array(
	"name" => __("NSK CSV List", 'nskameleon'),
	"base" => "csv_list",
	"class" => "",
	"category" => __('Content', 'nskameleon'),
	"front_enqueue_js" => get_template_directory_uri().'/js/DataTables-1.10.2/js/jquery.dataTables.min.js',
	"front_enqueue_css" => get_template_directory_uri().'/js/DataTables-1.10.2/css/jquery.dataTables.css',
	"params" => array(
		array(
			"type" => "attach_image",
			"holder" => "div",
			"class" => "",
			"heading" => __("CSV", 'nskameleon'),
			"param_name" => "csv",
			"value" => __(""),
			"description" => __("Archivo CSV, la primera linea deben ser los nombres de columna", 'nskameleon')
		),
	)
));
