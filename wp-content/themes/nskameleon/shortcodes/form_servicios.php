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
	$sucursales = isset ( $atts['sucursales'] ) ? explode ( ',', $atts['sucursales'] ) : null;
	$correos 	= isset ( $atts['correos'] ) ? explode ( ',', $atts['correos'] ) : null;

	wp_enqueue_script ( 'ns_form_servicios', get_stylesheet_directory_uri() . '/js/forms/servicios.js', array('jquery', 'angularjs'), '1.0', true );
	wp_localize_script(
		'ns_form_servicios',
		'ns_data',
		array(
			'ajax' 	=> admin_url( 'admin-ajax.php' ),
			's'		=> $sucursales,
			'c'		=> $correos
		)
	);

ob_start();
?>

<?php

// echo '<pre>';
// var_dump(  );
// echo '</pre>';
?>

<div class="form_i" data-ng-app="ServicesFormApp">
	<form id="ns_form_servicios" name="ns_form_servicios" data-ng-controller="FormCtrl">
		
		<!-- Success Message -->
		<div data-ng-show="success" class="form-message mje_ok">
			<p>
				<span>Enhorabuena, tus datos han sido enviados con &eacute;xito!</span>
				<br>
				<span>Recibir&aacute;s en tu correo informaci&oacute;n completa de todos los servicios.</span>
			</p>
		</div>
		<!--/ Success Message -->

		<!-- Error Message -->
		<div data-ng-show="_error" class="form-message mje_error">
			<p>Oops, algo malo sucedi&oacute;. Favor intentalo m&aacute;s tarde.</p>
		</div>
		<!--/ Error Message -->

		<!-- Name -->
		<div class="caja">
			<label for="nombre">Nombre:</label>
			<input id="name" name="name" type="text" data-ng-model="name" required />

			<span class="help-block" data-ng-show="ns_form_servicios.name.$dirty && ns_form_servicios.name.$error.required">
				<span>Por favor ingrese un Nombre v&aacute;lido.</span>
			</span>
		</div>
		<!--/ Name -->

		<!-- Email -->
		<div class="caja">
			<label for="email">E-mail:</label>
			<input id="email" name="email" type="email" data-ng-model="email" required />

			<span class="help-block" data-ng-show="ns_form_servicios.email.$dirty && ns_form_servicios.email.$error.required">
				<span>Por favor ingrese un correo v&aacute;lido.</span>
			</span>
		</div>
		<!--/ Email -->

		<!-- Phone -->
		<div class="caja">
			<label for="fono">Tel&eacute;fono:</label>
			<input name="phone" type="tel" data-ng-model="phone" required data-ng-pattern="/^(\(\+\d+\)\s?)?[0-9]+$/" />

			<span class="help-block" data-ng-show="ns_form_servicios.phone.$dirty && ns_form_servicios.phone.$error.required">
				<span>Por favir digite un n&uacute;mero de tel&eacute;fono v&aacute;lido.</span>
			</span>
		</div>
		<!--/ Phone -->

		<!-- Sucursal -->
		<div class="caja">
			<label for="sucursal">Seleccione sucursal:</label>
			<select id="sucursal" name="sucursal"  data-ng-model="sucursal" data-ng-options="s.name for s in sucursales" required>
				<option value="">Elije una sucursal</option>
			</select>

			<span data-ng-show="ns_form_servicios.sucursal.$dirty && !ns_form_servicios.sucursal.$valid" class="help-block help-invalid">
				<i class="icon icon-cancel"></i>
				<span>Por favor selecciona una sucursal</span>
			</span>
		</div>
		<!--/ Sucursal -->

		<!-- Comments -->
		<div class="caja">
			<label for="comentarios">
				<span>Comentarios:</span>
				<br/>
				<b>(Opcional)</b>
			</label>
			<textarea id="comentarios" name="comments" data-ng-model="comments"></textarea>
		</div>
		<!--/ Comments -->

		<!-- Submit Button -->
		<div class="btn_send">
			<p>
				<span>* Al cotizar tienes la opcion de realizar un </span>
				<img src="/landingpages/wp-content/themes/nskameleon/images/testdrive.png" alt="Test Drive" title="Test Drive" />
			</p>

			<button type="submit" data-ng-disabled="sending" data-ng-click="submit()" class="btn">
				<span data-ng-if="!sending">Enviar</span>
				<span data-ng-if="sending">Enviando...</span>
			</button>

			<div class="divclear">
				&nbsp;
			</div>
		</div>
		<!--/ Submit Button -->

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
