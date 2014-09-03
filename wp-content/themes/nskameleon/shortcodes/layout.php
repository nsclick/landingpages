<?php

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
		<li><img src="wp-content/themes/nskameleon/images/ico-fono.png" alt="Inalco" title="Inalco" class="ico-fono"/>Contacte su Sucursal INALCO<span class="ico-arrow"><img src="wp-content/themes/nskameleon/images/ico-arrowdown.png" alt="Inalco" title="Inalco"/></span>
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

	"name" => __("NSK Box Descripction", 'nskameleon'),
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