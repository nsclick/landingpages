<?php

function ns_models_selector_shortcode( $atts ) {
	//debug_var($atts);
	extract( shortcode_atts( array(
      'price' => '',
      'photo' => '',
      'models' => '',
      'server' => '',
      'id_destination' => ''
	), $atts ) );
	
	$models = explode(',', $models);
	$all_models = get_models();
	
	//debug_var($all_models);
	ob_start();
?>
<div class="selector">
	<?php foreach($all_models as $index => $model): ?>
	<?php if( in_array( $model->term_id, $models) ):?>
	<?php 
		//Determina la foto
		foreach($model->option_value['fotos'] as $foto){
			if($foto['type'] == 'fondo_blanco')
				$thumb = "http://$server" . $foto['url'];
		}
	?>
	<div class="auto">
		<?php if($photo): ?><div class="foto"><img src="<?php echo $thumb ?>" alt="<?php echo $model->name ?>" title="<?php echo $model->name ?>" /></div><?php endif; ?>
		<div class="texto"><b><?php echo $model->name ?></b><?php if($price): ?><span>Desde <b><?php echo number_format($model->option_value['precio_desde'], 0, ',','.'); ?></b></span><?php endif; ?></div>
		<div class="switcher">
			<div class="onoffswitch" term-id="<?php echo $model->term_id ?>">
				<input type="checkbox" name="onoffswitch<?php echo $index ?>" class="onoffswitch-checkbox" id="myonoffswitch<?php echo $index ?>" >
				<label class="onoffswitch-label" for="myonoffswitch<?php echo $index ?>"> <span class="onoffswitch-inner"> <span class="onoffswitch-active"><span class="onoffswitch-switch"><img src="/wp-content/themes/nskameleon/images/ico-yess.png" alt="Inalco" title="Inalco" /></span></span> <span class="onoffswitch-inactive"><span class="onoffswitch-switch"><img src="/wp-content/themes/nskameleon/images/ico-arrowright.png" alt="Inalco" title="Inalco" /></span></span> </span> </label>
			</div>
		</div>
	</div>
	<input type="hidden" name="<?php echo $model->term_id ?>" id="<?php echo $model->term_id ?>" value='<?php echo json_encode($model) ?>'>
	<?php endif; ?>
	<?php endforeach; ?>

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
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Servidor", 'nskameleon'),
			"param_name" => "server",
			"value" => __("chevroletinalco.local"),
			"description" => __("Url del servidor para tomar las fotos miniatura de los autos", 'nskameleon')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("ID campo destino", 'nskameleon'),
			"param_name" => "id_destination",
			"value" => __(""),
			"description" => __("ID del campo destino de la seleccion", 'nskameleon')
		),
		
		array(
			"type" => "ns_models",
			"holder" => "div",
			"class" => "",
			"param_name" => "models",
			"heading" => __('Modelos', 'nskameleon'),
			//"value" => array('Si' => 'si'),
			//"description" => __("Una sucursal por linea.", 'nskameleon')
		)
	)
));

function ns_param_models_field($settings, $value) {
	
	$dependency = vc_generate_dependencies_attributes($settings);
	$models = get_models();
	
	$value = $value ? $value : '';
	$selected = $value ? explode(',', $value) : array() ;
	
	$html = array();
	$html[] = '<input class="wpb_vc_param_value" type="hidden" name="' . $settings['param_name'] . '" id="models" value="'. $value  .'"/>';	
	$html[] = '<div class="edit_form_line"><input type="checkbox" name="all-models" id="all-models" value="1"/><b>Todos</b></div>';	

	foreach($models as $model){
		$checked = (in_array($model->term_id, $selected)) ? 'checked="true"' : '';
		$html[] = '<div class="edit_form_line"><input type="checkbox" class="inalc-models" name="m-list[]" value="' . $model->term_id . '" '. $checked .'/>' . $model->name . '</div>';	
	}
	return implode("\n", $html); 
}
add_shortcode_param('ns_models', 'ns_param_models_field', get_template_directory_uri().'/js/models-selector.js');
