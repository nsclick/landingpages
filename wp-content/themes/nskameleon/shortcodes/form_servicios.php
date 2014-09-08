<?php

function ns_form_servicios_submit () {
	// require_once ( get_template_directory() . '/inc/send_crm.php' );
	// $crm = new Crm;
	// $response['crm'] = $crm->send_cotizacion($crmData);

	$params = array();
	parse_str ( $_POST['data'], $params );

	$receivers 	= $params['c'];
	$comments 	= $params['comments'];
	$email  	= $params['email'];
	// $pixels  	= $params['pixels'];
	$sucursal 	= $params['location'];

	$response = array(
		'd'		=> $params
	);

	// wp_mail (
	// 	$receivers,
		// ''
	// );

	$response['m'] = wp_mail (
		'ljayk@nsclick.cl',
		'Suject',
		'Content'
	);

	echo json_encode ( $response );
	die;
}

add_action( 'wp_ajax_ns_form_servicios_submit', 'ns_form_servicios_submit' );
add_action( 'wp_ajax_nopriv_ns_form_servicios_submit', 'ns_form_servicios_submit' );

/**
 * Formulario de Servicios
 */
function ns_form_servicios_shortcode( $atts, $content = null) {
	wp_enqueue_script ( 'ns_form_servicios', get_stylesheet_directory_uri() . '/js/ns_form_servicios.js', array('jquery'), '1.0' );
	wp_localize_script( 'ns_form_servicios', 'ns_data', array( 'ajax' => admin_url( 'admin-ajax.php' ) ) );

ob_start();
?>

<?php
$sucursales = isset ( $atts['sucursales'] ) ? explode ( ',', $atts['sucursales'] ) : null;
$correos 	= isset ( $atts['correos'] ) ? explode ( ',', $atts['correos'] ) : null;

// echo '<pre>';
// var_dump(  );
// echo '</pre>';

?>

<div class="form_i">
	<form id="ns_form_servicios">
		<span class="mje_ok">Recibir&aacute;s en tu correo informaci&oacute;n completa de todos los servicios.</span>
		<span class="mje_error">Existen errores en el formulario.</span>
		<div class="caja">
			<label for="nombre">Nombre:</label>
			<input name="name" type="text"/>
		</div>
		<div class="caja">
			<label for="email">E-mail:</label>
			<input name="email" type="text"/>
		</div>
		<div class="caja">
			<label for="fono">Tel&eacute;fono:</label>
			<input name="phone" type="text"/>
		</div>
		<div class="caja">
			<label for="sucursal">Seleccione sucursal:</label>
			<select name="location">
				<option value="">Elije una sucursal</option>
				<?php foreach ( $sucursales as $sucursal ): ?>
					<option value="<?php echo strtolower ( $sucursal ); ?>"><?php echo $sucursal; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="caja">
			<label for="comentarios">Comentarios:
				<br/>
				<b>(Opcional)</b></label>
			<textarea name="comments"></textarea>
		</div>
		<div class="btn_send">
			<p>
				* Al cotizar tienes la opcion de realizar un <img src="/landingpages/wp-content/themes/nskameleon/images/testdrive.png" alt="Test Drive" title="Test Drive" />
			</p>
			<input type="submit" value="Enviar">
			<div class="divclear">
				&nbsp;
			</div>
		</div>

		<?php
			if ( !empty ( $correos ) ) :
				foreach ( $correos as $correo ) :
		?>
				<input type="hidden" name="c[]" value="<?php echo $correo; ?>" />
		<?php
				endforeach;
			endif;
		?>

		<?php
			if ( !empty ( $sucursales ) ) :
				foreach ( $sucursales as $sucursal ) :
		?>
				<input type="hidden" name="s[]" value="<?php echo $sucursal; ?>" />
		<?php
				endforeach;
			endif;
		?>

		<!-- Special Fields -->
		<?php
			echo do_shortcode ( $content );
		?>
		<!--/ Special Fields -->

		<input type="hidden" name="title" value="<?php the_title(); ?>" />

	</form>
</div>
<?php
return ob_get_clean();
}
add_shortcode( 'ns_form_servicios', 'ns_form_servicios_shortcode' );

register_vc_shortcode ( 
	array (
		"name" 						=> __("NS Form Servicios", 'nskameleon'),
		"base" 						=> "ns_form_servicios",
		"class" 					=> "",
		"category" 					=> __('Content', 'nskameleon'),
		"as_parent" 				=> array(
			'only' => 'ns_form_pixel,ns_form_email,ns_form_crm'
		),
	    "content_element" 			=> true,
	    "show_settings_on_create" 	=> false,
	    "params" 					=> array(
	        array(
				"type" 			=> "exploded_textarea",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> __("Sucursales"),
				"param_name" 	=> "sucursales",
				"value" 		=> '',
				"description" 	=> __("Sucursales separadas por salto de línea (presionar ENTER).")
			),
			array(
				"type" 			=> "exploded_textarea",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> __("Correos"),
				"param_name" 	=> "correos",
				"value" 		=> '',
				"description" 	=> __("Correos separados por salto de línea (presionar ENTER).")
			)
	    ),
	    "js_view" 					=> 'VcColumnView'
	)
);
