<?php
function ns_csv_list_shortcode( $atts ) {

	extract( shortcode_atts( array(
      'csv' => null
	), $atts ) );
	
	wp_enqueue_script( 'jquery.dataTables', get_template_directory_uri().'/js/DataTables-1.10.2/js/jquery.dataTables.min.js', 'jquery', false);
	wp_enqueue_style( 'dataTables', get_template_directory_uri().'/js/DataTables-1.10.2/css/jquery.dataTables.css' );
	wp_enqueue_style( 'dataTables-ns', get_template_directory_uri().'/js/DataTables-1.10.2/css/jquery.dataTables-ns.css' );
	
	$path = get_attached_file( $csv );
	
	$data = file( $path );
	$headers = array_shift ( $data );
	$headers = explode("\t", $headers);
	
	
	ob_start();
?>

<script type="text/javascript">
jQuery(document).ready( function () {
    jQuery('#models-table').DataTable( {
		paging: false,
		scrollY: 400,
		language: {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	} );
	
} ); 
</script>

<table id="models-table">
	<thead>
		<tr>
			<?php foreach( $headers as $h ): ?>
			<th><?php echo trim( $h ) ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
	
	<?php foreach($data as $row): 
		$rc = explode("\t", $row);
	?>
	<tr>
		<?php foreach( $rc as $c ): ?>
		<td><?php echo trim($c) ?></td>
		<?php endforeach; ?>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php
return ob_get_clean();	
}
add_shortcode( 'csv_list', 'ns_csv_list_shortcode' );

register_vc_shortcode(array(
	"name" => __("NSK CSV List", 'nskameleon'),
	"base" => "csv_list",
	"class" => "",
	"category" => __('Content', 'nskameleon'),
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
