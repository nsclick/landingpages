<?php
//http://chevroletinalco.cl/wp-content/uploads/new-cars/485a5665-b81c-3863-d33c-5266eca822b1/aveo_sedan_fb.jpg

//[box_a link="" img_url="" img_title=""]
function ns_box_a_shortcode( $atts ) {
	extract( $atts ); 
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
	extract( $atts );
	
	if( isset($branches) ){
		$branches = str_replace("<br />", "", $branches);
		$branches = explode("\n", $branches);
	} else {
		$branches = array();
	}
	
?> 
	<ul class="select_contacto">
		<li><img src="/wp-content/themes/nskameleon/images/ico-fono.png" alt="Inalco" title="Inalco" class="ico-fono"/>Contacte su Sucursal INALCO<span class="ico-arrow"><img src="/wp-content/themes/nskameleon/images/ico-arrowdown.png" alt="Inalco" title="Inalco"/></span>
			<ul>
				<?php foreach($branches as $line): ?>
					<li><?php echo $line ?></li>
				<?php endforeach; ?>
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
					array(
					"type" => "textarea",
						"holder" => "div",
						"class" => "",
						"heading" => __('Lista de sucursales', 'nskameleon'),
						"param_name" => "branches",
						"value" => __(""),
						"description" => __("Una sucursal por linea.", 'nskameleon')
						)
				)
));

function ns_box_bajada_shortcode( $atts ) {
	
	extract( shortcode_atts( array(
      'text' => '',
      'icon' => '',
	), $atts ) );
   
	if($icon){
		$icon = wp_get_attachment_image( $icon );
	}
	
	ob_start();
?> 
<div class="box_bajadac">
	<div class="box_bajada">
		<span class="texto"><?php echo $text ?></span>
		<span class="icono"><?php echo $icon ?></span>
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
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __('Texto', 'nskameleon'),
						"param_name" => "text",
						"value" => __(""),
						"description" => __(htmlentities( 'Puede inyectar algo de html, Ej: Un <b>texto</b>' ), 'nskameleon')
						),
					array(
						"type" => "attach_image",
						"holder" => "div",
						"class" => "",
						"heading" => __('Ícono', 'nskameleon'),
						"param_name" => "icon",
						"value" => __(""),
						"description" => __("Tamaño 68x53 fondo trasparente", 'nskameleon')
						),
						
				)

));

function ns_subt_shortcode( $atts ) {

	extract( shortcode_atts( array(
      'text' => ''
	), $atts ) );
	
	return '<h2 class="subt">' . $text . '</h2>';

}
add_shortcode( 'subt', 'ns_subt_shortcode' );

register_vc_shortcode(array(

	"name" => __("NSK Titulo h2", 'nskameleon'),
	"base" => "subt",
	"class" => "",
	"category" => __('Content', 'nskameleon'),
	//'admin_enqueue_js' => array(get_template_directory_uri() . '/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri() . '/vc_extend/bartag.css'),
	"params" => array(
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __('Texto', 'nskameleon'),
						"param_name" => "text",
						"value" => __(""),
						"description" => __(htmlentities( 'Puede inyectar algo de html, Ej: Un <b>texto</b>' ), 'nskameleon')
						),
						
				)

));

function ns_box_desc_shortcode( $atts ) {

	extract( shortcode_atts( array(
      'title' => '',
      'img' => '',
      'link' => '',
      'desc' => ''      
	), $atts ) );
	
	if( $link )
		$link = vc_build_link($link);
	
	if($img){
		$img = wp_get_attachment_image( $img, 'full' );
	}
	
	ob_start();
?> 
	<div class="box_desc">
		<div class="foto">
			<?php if( $link ): ?>
			<a href="<?php echo $link['http'] ?>"><?php echo $img ?><span class="super"><?php echo $title ?></span></a>
			<?php else: ?>
			<?php echo $img ?><span class="super"><?php echo $title ?></span>
			<?php endif; ?>
		</div>
		<p><?php echo $desc ?></p>
	</div>

<?php
return ob_get_clean();
}
add_shortcode( 'box_desc', 'ns_box_desc_shortcode' );

register_vc_shortcode(array(

	"name" => __("NSK Box Descripción", 'nskameleon'),
	"base" => "box_desc",
	"class" => "",
	"category" => __('Content', 'nskameleon'),
	//'admin_enqueue_js' => array(get_template_directory_uri() . '/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri() . '/vc_extend/bartag.css'),
	"params" => array(
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __('Título', 'nskameleon'),
						"param_name" => "title",
						"value" => __(""),
						"description" => __(htmlentities( 'Puede inyectar algo de html, Ej: Un <b>texto</b>' ), 'nskameleon')
						),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Enlace", 'nskameleon'),
						"param_name" => "link",
						"value" => __(""),
						"description" => __(".", 'nskameleon')
					),
					array(
						"type" => "attach_image",
						"holder" => "div",
						"class" => "",
						"heading" => __('Imágen', 'nskameleon'),
						"param_name" => "img",
						"value" => __(""),
						"description" => __("Tamaño 349x124 o que mantenga la misma proporción", 'nskameleon')
						),
					array(
						"type" => "textarea_html",
						"holder" => "div",
						"class" => "",
						"heading" => __('Descripción', 'nskameleon'),
						"param_name" => "desc",
						"value" => __(""),
						"description" => __("", 'nskameleon')
						),
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

function ns_models_selector_shortcode( $atts ) {
ob_start();
?>
<div class="selector">
	<div class="auto">
		<div class="foto"><img src="/wp-content/themes/nskameleon/images/cruze.jpg" alt="Modelo y versi&oacute;n" title="Modelo y versi&oacute;n" /></div>
		<div class="texto"><b>Chevrolet Cruze</b>Sedán 1.8 MT LS<span>Desde <b>$8.590.000</b></span></div>
		<div class="switcher">
			<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" >
				<label class="onoffswitch-label" for="myonoffswitch"> <span class="onoffswitch-inner"> <span class="onoffswitch-active"><span class="onoffswitch-switch"><img src="/wp-content/themes/nskameleon/images/ico-yess.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> <span class="onoffswitch-inactive"><span class="onoffswitch-switch"><img src="/wp-content/themes/nskameleon/images/ico-arrowright.png" alt="Inalco" title="Inalco" style="margin:8px 0 0 0" /></span></span> </span> </label>
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
add_shortcode( 'models_selector', 'ns_models_selector_shortcode' );

register_vc_shortcode(array(

	"name" => __("NSK Modelos", 'nskameleon'),
	"base" => "models_selector",
	"class" => "",
	"category" => __('Content', 'nskameleon'),
	"params" => array(
		array(
			"type" => "checkbox",
			"holder" => "div",
			"class" => "",
			"heading" => __('Mostrar el precio?', 'nskameleon'),
			"param_name" => "price",
			"value" => array('Si' => 'si'),
			//"description" => __("Una sucursal por linea.", 'nskameleon')
		),
		array(
			"type" => "checkbox",
			"holder" => "div",
			"class" => "",
			"heading" => __('Mostrar el la foto?', 'nskameleon'),
			"param_name" => "photo",
			"value" => array('Si' => 'si'),
			//"description" => __("Una sucursal por linea.", 'nskameleon')
		),
		array(
			"type" => "ns_models",
			"holder" => "div",
			"class" => "",
			"heading" => __('Modelos', 'nskameleon'),
			"param_name" => "models",
			//"value" => array('Si' => 'si'),
			//"description" => __("Una sucursal por linea.", 'nskameleon')
		)
	)
));

function ns_param_models_field($settings, $value) {
	// echo '<pre>',print_r($settings),'</pre>';
	$dependency = vc_generate_dependencies_attributes($settings);
	return '<div class="my_param_block">'
             .'<input name="'.$settings['param_name']
             .'" class="wpb_vc_param_value wpb-textinput '
             .$settings['param_name'].' '.$settings['type'].'_field" type="text" value="'
             .$value.'" ' . $dependency . '/>'
         .'</div>';
}
add_shortcode_param('ns_models', 'ns_param_models_field');
