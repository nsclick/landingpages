<?php

//[box_a link="" img_url="" img_title=""]
function ns_box_a_shortcode( $atts ) {
	extract( $atts ); 
	debug_var($atts);
	$href = vc_build_link($href);
	
	return '<a href="'.$link.'" class="box_a" rel="subsection"><img src="'.$img_url.'" alt="'.$img_title.'" title="'.$img_title.'"/></a>';
}
add_shortcode( 'box_a', 'ns_box_a_shortcode' );

register_vc_shortcode(array(
	"name" => __("NSK Box A", 'nskameleon'),
	"base" => "box_a",
	"class" => "",
	"category" => __('Content', 'nskameleon'),
	//'admin_enqueue_js' => array(get_template_directory_uri() . '/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri() . '/vc_extend/bartag.css'),
	"params" => array(
					array(
						"type" => "textfield ",
						"holder" => "div",
						"class" => "",
						"heading" => __("Link", 'nskameleon'),
						"param_name" => "link",
						"value" => __(""),
						"description" => __("Description for link param.", 'nskameleon')
					),
					array(
						"type" => "attach_image",
						"holder" => "div",
						"class" => "",
						"heading" => __("Image", 'nskameleon'),
						"param_name" => "img_url",
						"value" => __(""),
						"description" => __("Description for link param.", 'nskameleon')
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Image Title", 'nskameleon'),
						"param_name" => "img_title",
						"value" => __(""),
						"description" => __("Description for link param.", 'nskameleon')
					),
				)
));

function ns_select_contact_shortcode( $atts ) {
	ob_start();
?>
<ul class="select_contacto">
	<li><img src="/landingpages/wp-content/themes/nskameleon/images/ico-fono.png" alt="Inalco" title="Inalco" class="ico-fono"/>Contacte su Sucursal INALCO<span class="ico-arrow"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-arrowdown.png" alt="Inalco" title="Inalco"/></span>
		<ul>
			<li>
				Bellavista 12345678
			</li>
			<li>
				Bellavista 12345678
			</li>
			<li>
				Bellavista 12345678
			</li>
			<li>
				Bellavista 12345678
			</li>
			<li>
				Bellavista 12345678
			</li>
			<li>
				Bellavista 12345678
			</li>
		</ul>
	</li>
</ul>
<?php
return ob_get_clean();
}
add_shortcode( 'select_contact', 'ns_select_contact_shortcode' );

register_vc_shortcode(array(
"name" => __("NSK Select Contact", 'nskameleon'),
"base" => "select_contact",
"class" => "",
"category" => __('Content', 'nskameleon'),
//'admin_enqueue_js' => array(get_template_directory_uri() . '/vc_extend/bartag.js'),
//'admin_enqueue_css' => array(get_template_directory_uri() . '/vc_extend/bartag.css'),
"params" => array(
)
));

function ns_box_bajada_shortcode( $atts ) {
ob_start();
?>
<div class="box_bajadac">
	<div class="box_bajada">
		<span class="texto">Un <b>texto</b> más  más más largo.</span>
		<span class="icono"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-yes.png" alt="Inalco" title="Inalco" /></span>
	</div>
</div>
<?php
return ob_get_clean();
}
add_shortcode( 'box_bajada', 'ns_box_bajada_shortcode' );

register_vc_shortcode(array(
"name" => __("NSK Box Bajada", 'nskameleon'),
"base" => "box_bajada",
"class" => "",
"category" => __('Content', 'nskameleon'),
//'admin_enqueue_js' => array(get_template_directory_uri() . '/vc_extend/bartag.js'),
//'admin_enqueue_css' => array(get_template_directory_uri() . '/vc_extend/bartag.css'),
"params" => array(
)
));

function ns_subt_shortcode( $atts ) {
return '<h2 class="subt">Servicios Chevrolet INALCO</h2>';
}
add_shortcode( 'subt', 'ns_subt_shortcode' );

register_vc_shortcode(array(
"name" => __("NSK Titulo 2", 'nskameleon'),
"base" => "subt",
"class" => "",
"category" => __('Content', 'nskameleon'),
//'admin_enqueue_js' => array(get_template_directory_uri() . '/vc_extend/bartag.js'),
//'admin_enqueue_css' => array(get_template_directory_uri() . '/vc_extend/bartag.css'),
"params" => array(
)
));

function ns_box_desc_shortcode( $atts ) {
ob_start();
?>
<div class="box_desc">
	<div class="foto"><img src="/landingpages/wp-content/themes/nskameleon/images/banner.jpg" alt="Inalco" title="Inalco" /><span class="super">Desabolladura y Pintura</span>
	</div>
	<p>
		Los técnicos de Chevrolet INALCO son los que mejor conocen tu vehículo, cuentan con herramientas especiales de última generación diseñadas para cada modelo de Chevrolet.
	</p>
</div>
<?php
return ob_get_clean();
}
add_shortcode( 'box_desc', 'ns_box_desc_shortcode' );

register_vc_shortcode(array(
"name" => __("NSK Box Descripcion", 'nskameleon'),
"base" => "box_desc",
"class" => "",
"category" => __('Content', 'nskameleon'),
//'admin_enqueue_js' => array(get_template_directory_uri() . '/vc_extend/bartag.js'),
//'admin_enqueue_css' => array(get_template_directory_uri() . '/vc_extend/bartag.css'),
"params" => array(
)
));

function ns_form_servicios_shortcode( $atts ) {
ob_start();
?>
<div class="form_i">
	<form>
		<span class="mje_ok">Recibirás en tu correo información completa de todos los servicios.</span>
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
			<input type="submit" value="Enviar">
			<div class="divclear">
				&nbsp;
			</div>
		</div>
	</form>
</div>
<?php
return ob_get_clean();
}
add_shortcode( 'form_servicios', 'ns_form_servicios_shortcode' );

register_vc_shortcode(array(
"name" => __("NSK Form Servicios", 'nskameleon'),
"base" => "form_servicios",
"class" => "",
"category" => __('Content', 'nskameleon'),
//'admin_enqueue_js' => array(get_template_directory_uri() . '/vc_extend/bartag.js'),
//'admin_enqueue_css' => array(get_template_directory_uri() . '/vc_extend/bartag.css'),
"params" => array(
)
));

function ns_form_cotiza_shortcode( $atts ) {
ob_start();
?>
<div class="form_i">
	<form>
		<span class="mje_ok">Recibirás en tu correo información completa de todos los servicios.</span>
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
"name" => __("NSK Form Cotizacion", 'nskameleon'),
"base" => "form_cotiza",
"class" => "",
"category" => __('Content', 'nskameleon'),
//'admin_enqueue_js' => array(get_template_directory_uri() . '/vc_extend/bartag.js'),
//'admin_enqueue_css' => array(get_template_directory_uri() . '/vc_extend/bartag.css'),
"params" => array(
)
));

function ns_selector_shortcode( $atts ) {
ob_start();
?>
<div class="selector">
	<div class="auto">
		<div class="foto"><img src="/landingpages/wp-content/themes/nskameleon/images/cruze.jpg" alt="Modelo y versi&oacute;n" title="Modelo y versi&oacute;n" /></div>
		<div class="texto"><b>Chevrolet Cruze</b>Sedán 1.8 MT LS<span>Desde <b>$8.590.000</b></span></div>
		<div class="switcher">
			<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" >
				<label class="onoffswitch-label" for="myonoffswitch"> <span class="onoffswitch-inner"> <span class="onoffswitch-active"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-yess.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> <span class="onoffswitch-inactive"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-arrowright.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> </span> </label>
			</div>
		</div>
	</div>
	<div class="auto">
		<div class="foto"><img src="/landingpages/wp-content/themes/nskameleon/images/cruze.jpg" alt="Modelo y versi&oacute;n" title="Modelo y versi&oacute;n" /></div>
		<div class="texto"><b>Chevrolet Cruze</b>Sedán 1.8 MT LS<span>Desde <b>$8.590.000</b></span></div>
		<div class="switcher">
			<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch2" >
				<label class="onoffswitch-label" for="myonoffswitch2"> <span class="onoffswitch-inner"> <span class="onoffswitch-active"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-yess.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> <span class="onoffswitch-inactive"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-arrowright.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> </span> </label>
			</div>
		</div>
	</div>
	<div class="auto">
		<div class="foto"><img src="/landingpages/wp-content/themes/nskameleon/images/cruze.jpg" alt="Modelo y versi&oacute;n" title="Modelo y versi&oacute;n" /></div>
		<div class="texto"><b>Chevrolet Cruze</b>Sedán 1.8 MT LS<span>Desde <b>$8.590.000</b></span></div>
		<div class="switcher">
			<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch3" class="onoffswitch-checkbox" id="myonoffswitch3" >
				<label class="onoffswitch-label" for="myonoffswitch3"> <span class="onoffswitch-inner"> <span class="onoffswitch-active"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-yess.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> <span class="onoffswitch-inactive"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-arrowright.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> </span> </label>
			</div>
		</div>
	</div>
	<div class="auto">
		<div class="foto"><img src="/landingpages/wp-content/themes/nskameleon/images/cruze.jpg" alt="Modelo y versi&oacute;n" title="Modelo y versi&oacute;n" /></div>
		<div class="texto"><b>Chevrolet Cruze</b>Sedán 1.8 MT LS<span>Desde <b>$8.590.000</b></span></div>
		<div class="switcher">
			<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch4" class="onoffswitch-checkbox" id="myonoffswitch4" >
				<label class="onoffswitch-label" for="myonoffswitch4"> <span class="onoffswitch-inner"> <span class="onoffswitch-active"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-yess.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> <span class="onoffswitch-inactive"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-arrowright.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> </span> </label>
			</div>
		</div>
	</div>
	<div class="auto">
		<div class="foto"><img src="/landingpages/wp-content/themes/nskameleon/images/cruze.jpg" alt="Modelo y versi&oacute;n" title="Modelo y versi&oacute;n" /></div>
		<div class="texto"><b>Chevrolet Cruze</b>Sedán 1.8 MT LS<span>Desde <b>$8.590.000</b></span></div>
		<div class="switcher">
			<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch5" class="onoffswitch-checkbox" id="myonoffswitch5" >
				<label class="onoffswitch-label" for="myonoffswitch5"> <span class="onoffswitch-inner"> <span class="onoffswitch-active"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-yess.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> <span class="onoffswitch-inactive"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-arrowright.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> </span> </label>
			</div>
		</div>
	</div>
	<div class="auto">
		<div class="foto"><img src="/landingpages/wp-content/themes/nskameleon/images/cruze.jpg" alt="Modelo y versi&oacute;n" title="Modelo y versi&oacute;n" /></div>
		<div class="texto"><b>Chevrolet Cruze</b>Sedán 1.8 MT LS<span>Desde <b>$8.590.000</b></span></div>
		<div class="switcher">
			<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch6" class="onoffswitch-checkbox" id="myonoffswitch6" >
				<label class="onoffswitch-label" for="myonoffswitch6"> <span class="onoffswitch-inner"> <span class="onoffswitch-active"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-yess.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> <span class="onoffswitch-inactive"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-arrowright.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> </span> </label>
			</div>
		</div>
	</div>
	<div class="auto">
		<div class="foto"><img src="/landingpages/wp-content/themes/nskameleon/images/cruze.jpg" alt="Modelo y versi&oacute;n" title="Modelo y versi&oacute;n" /></div>
		<div class="texto"><b>Chevrolet Cruze</b>Sedán 1.8 MT LS<span>Desde <b>$8.590.000</b></span></div>
		<div class="switcher">
			<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch7" class="onoffswitch-checkbox" id="myonoffswitch7" checked>
				<label class="onoffswitch-label" for="myonoffswitch7"> <span class="onoffswitch-inner"> <span class="onoffswitch-active"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-yess.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> <span class="onoffswitch-inactive"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-arrowright.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> </span> </label>
			</div>
		</div>
	</div>
	<div class="auto">
		<div class="foto"><img src="/landingpages/wp-content/themes/nskameleon/images/cruze.jpg" alt="Modelo y versi&oacute;n" title="Modelo y versi&oacute;n" /></div>
		<div class="texto"><b>Chevrolet Cruze</b>Sedán 1.8 MT LS<span>Desde <b>$8.590.000</b></span></div>
		<div class="switcher">
			<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch8" class="onoffswitch-checkbox" id="myonoffswitch8" >
				<label class="onoffswitch-label" for="myonoffswitch8"> <span class="onoffswitch-inner"> <span class="onoffswitch-active"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-yess.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> <span class="onoffswitch-inactive"><span class="onoffswitch-switch"><img src="/landingpages/wp-content/themes/nskameleon/images/ico-arrowright.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> </span> </label>
			</div>
		</div>
	</div>
</div>
<?php
return ob_get_clean();
}
add_shortcode( 'selector', 'ns_selector_shortcode' );

register_vc_shortcode(array(
"name" => __("NSK Selector Autos", 'nskameleon'),
"base" => "selector",
"class" => "",
"category" => __('Content', 'nskameleon'),
//'admin_enqueue_js' => array(get_template_directory_uri() . '/vc_extend/bartag.js'),
//'admin_enqueue_css' => array(get_template_directory_uri() . '/vc_extend/bartag.css'),
"params" => array(
)
));
