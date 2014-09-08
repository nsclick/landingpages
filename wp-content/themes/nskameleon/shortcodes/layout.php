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
