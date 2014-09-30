<?php

/**
 * Formulario de Autos
 */
function ns_form_cotiza_shortcode( $atts ) {
ob_start();
?>
<div class="form_i">
	<form>
		<span class="mje_ok">Recibir&aacute;s en tu correo informaci&oacute;n completa de todos los servicios.</span>
		<span class="mje_error">Existen errores en el formulario.</span>
		<div class="caja">
			<label for="nombre">Nombre:</label>
			<input type="text"/>
		</div>
		<div class="caja">
			<label for="email">E-mail:</label>
			<input type="text"/>
		</div>
		<div class="caja">
			<label for="fono">Tel&eacute;fono:</label>
			<input type="text"/>
		</div>
		<div class="caja">
			<label for="autos">Autos seleccionados:</label>
			<div class="autos">
				<div class="auto1">
					CHEVROLET CAPTIVA IV LT FULL 2.2D AWD 6AT <a href="#"><span>x</span></a>
				</div>
				<div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div>
				<div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div><div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div>
				<div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div>
				<div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div><div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div>
				<div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div>
				<div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div><div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div>
				<div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div>
				<div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div><div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div>
				<div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div>
				<div class="auto1">
					Modelo y version <a href="#"><span>x</span></a>
				</div>
			</div>
		</div>
		<div class="caja">
			<label for="sucursal">Seleccione sucursal:</label>
			<select>
				<option>sucursal 1</option>
			</select>
		</div>
		<div class="caja">
			<label for="comentarios">Comentarios:
				<br/>
				<b>(Opcional)</b></label>
			<textarea></textarea>
		</div>
		<div class="btn_send">
			<p>
				* Al cotizar tienes la opcion de realizar un <img src="/landingpages/wp-content/themes/nskameleon/images/testdrive.png" alt="Test Drive" title="Test Drive" />
			</p>
			<input type="submit" value="Cotizar">
			<div class="divclear">
				&nbsp;
			</div>
		</div>
	</form>
</div>
<?php
return ob_get_clean();
}
add_shortcode( 'form_cotiza', 'ns_form_cotiza_shortcode' );

register_vc_shortcode(array(

	"name" 		=> __("NSK Form Cotizacion", 'nskameleon'),
	"base" 		=> "ns_form_cotiza",
	"class" 	=> "",
	"category" 	=> __('Content', 'nskameleon'),
	"as_parent" => array(
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
				),
				array(
					"type" 			=> "checkbox",
					"holder" 		=> "div",
					"class" 		=> "",
					"heading" 		=> __("CRM"),
					"param_name" 	=> "crm",
					"value" 		=> array(
						'Incluir'	=> true
					),
					"description" 	=> __("Incluye la integración con el CRM.")
				)
		    ),
		    "js_view" 					=> 'VcColumnView'
));
