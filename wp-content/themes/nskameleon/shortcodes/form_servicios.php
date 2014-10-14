<?php

/**
 * Formulario
 */
function ns_form_shortcode( $atts, $content = null) {
	if ( !isset ( $atts['servicios_form_config'] ) ) {
	 	$atts['servicios_form_config'] = '';
	 }
 	
	 try {
	 	$data =  $atts['servicios_form_config'];
	 } catch (Exception $e) {
	 	$data = "{}";
	 }
	 
	 $post = get_post ();

	 wp_enqueue_script ( 'angularjs.ngSanitize', get_stylesheet_directory_uri() . '/vendor/angular/angular-sanitize.js', array('angularjs'));
	 wp_enqueue_script ( 'ns_form', get_stylesheet_directory_uri() . '/js/forms/servicios.js', array('jquery', 'angularjs'), '1.0', false );
	 wp_localize_script(
	 	'ns_form',
	 	'ns_data',
	 	array(
	 		'ajax' 			=> admin_url( 'admin-ajax.php' ),
	 		'data'			=> $data,
	 		'models'		=> get_models(),
	 		'page_title'	=> get_the_title(),
	 		'page_slug'		=> $post->post_name
	 	)
	 );

ob_start();

// echo '<pre>';
// var_dump( $post->post_name );
// echo '</pre>';
?>

<!-- <div class="wpb_row vc_row-fluid">
	<div class="vc_span12 wpb_column column_container">
	</div>
</div> -->



<div class="wpb_row vc_row-fluid">
	<div class="vc_span12 wpb_column column_container">
		<div class="wpb_wrapper">
			
<div class="form_i asd" data-ng-app="ServicesFormApp" data-ng-cloak>
	<form id="ns_form_servicios" name="ns_form_servicios" data-ng-controller="FormCtrl">
		
		<div class="wpb_row vc_row-fluid conte-inalco">
		
			<div class="vc_span5 wpb_column column_container" data-ng-if="showModels">
				<div class="wpb_wrapper height720">
					<h2 class="subt">Nuestros Autos</h2>					
						<!-- Models -->
						<div class="selector">
						
						<!-- Car Model -->
						<div class="auto" data-ng-repeat="m in models">
							<div class="foto" data-ng-if="showPhoto">
								<img data-ng-src="{{photoServer}}{{m.foto}}" alt="{{m.name}}" title="{{m.name}}" />
							</div>
							
							<div class="text_wrapper">
								<div class="texto">
                                	<div style="display:table-cell;vertical-align:middle">
										<span class="fmodelo"><b>{{m.name}}</b></span>
										<br data-ng-if="showPrice" /><span class="fprecio" data-ng-if="showPrice">Desde <b>{{m.option_value.precio_desde | price : '$ '}}</b></span>
										<br data-ng-if="$parent.$parent.showDescription" /><span class="ficha fdescripcion" data-ng-if="$parent.$parent.showDescription">{{m.description}}</span>
                                        </div>
								</div>
							</div>
							
							<div class="switcher">
								<div class="onoffswitch">
									<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch{{$index}}" data-ng-model="m.state" data-ng-change="toggleModel(m, $index)" >
									<label class="onoffswitch-label" for="myonoffswitch{{$index}}">
										<span class="onoffswitch-inner">
											<span class="onoffswitch-active">
												<span class="onoffswitch-switch">
													<img src="<?php echo get_template_directory_uri(); ?>/images/ico-yess.png" alt="Inalco" title="Inalco" />
												</span>
											</span>
											<span class="onoffswitch-inactive">
												<span class="onoffswitch-switch">
													<img src="<?php echo get_template_directory_uri(); ?>/images/ico-arrowright.png" alt="Inalco" title="Inalco" />
												</span>
											</span>
										</span>
									</label>
								</div>
							</div>
							
						</div>
						<!--/ Car Model -->
						
					</div>
					<!--/ Models -->
				</div>
			</div>
			
			<div ng-class="{'vc_span12': !showModels, 'vc_span7': showModels}" class="wpb_column column_container">
				<div class="wpb_wrapper">
					<h2 class="subt">Ingrese sus datos</h2>
					
					<!-- Success Message -->
					<div data-ng-show="success" class="form-message mje_ok">
						<p><span>Muchas gracias por contactarnos, hemos recibido sus datos.</span></p>
						<p><span>Pronto nuestros ejecutivos se comunicarán con usted</span></p>
					</div>
					<!--/ Success Message -->

					<!-- Error Message -->
					<div data-ng-show="_error" class="form-message mje_error">
						<p>Lo sentimos, en este momento este servicio no esta disponible. Por favor int&eacute;ntelo m&aacute;s tarde.</p>
					</div>
					<!--/ Error Message -->
					
					
					<!-- Form Wrapper --> 
					<div data-ng-show="!sent">	
						
						<!-- Name -->
						<div class="caja">
							<label for="nombre">Nombre:</label>
							<input id="name" name="firstname" type="text" data-ng-model="firstname" required />
				
							<span class="help-block" data-ng-show="ns_form_servicios.firstname.$dirty && ns_form_servicios.firstname.$error.required">
								<span>Por favor ingrese un Nombre.</span>
							</span>
						</div>
						<!--/ Name -->
						
						<!-- LastName -->
						<div class="caja">
							<label for="nombre">Apellidos:</label>
							<input id="name" name="lastname" type="text" data-ng-model="lastname" required />
				
							<span class="help-block" data-ng-show="ns_form_servicios.lastname.$dirty && ns_form_servicios.lastname.$error.required">
								<span>Por favor ingrese un Apellido.</span>
							</span>
						</div>
						<!--/ LastName -->
						
						<!-- Rut -->
						<div class="caja" data-ng-if="isCrm">
							<label for="rut">Rut:</label>
							<input id="rut" name="rut" type="text" data-ng-model="$parent.rut" required ng-change="validateRut($parent.rut)" />
										
							<span class="help-block" data-ng-show="ns_form_servicios.rut.$dirty && ns_form_servicios.rut.$invalid">
								<span>Rut inv&aacute;lido.</span>
							</span>
						</div>
						<!--/ Rut -->
				
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
						<div class="caja" data-ng-if="sucursales.length > 0">
							<label for="sucursal">Seleccione sucursal:</label>
							<select id="sucursal" name="sucursal"  data-ng-model="$parent.sucursal" data-ng-options="s.name for s in sucursales" required>
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
						
						<div data-ng-if="showModels">
						<!-- Selected Models -->
							<div class="caja">
								<label for="autos">Autos seleccionados:</label>
								<div class="autos">
									<div class="auto1" data-ng-repeat="m in selectedModels">
										<span>{{m.name}}</span>
										<a href="#" data-ng-click="toggleModel(m, $index, false)"><span>x</span></a>
									</div>
								</div>
								
								<span data-ng-if="ns_form_servicios.$dirty && missingModels" class="help-block help-invalid">
									<i class="icon icon-cancel"></i>
									<span>No hay modelos seleccionados.</span>
								</span>
							</div
						><!--/ Selected Models -->
						</div>
				
						<!-- Submit Button -->
						<div class="btn_send">
							<p>
								<span>* Al cotizar tienes la opcion de realizar un Test Drive</span>
								<!-- <img src="/landingpages/wp-content/themes/nskameleon/images/testdrive.png" alt="Test Drive" title="Test Drive" /> -->
							</p>
				
							<button type="submit" data-ng-disabled="sending" data-ng-click="submit()" class="btn">
								<span data-ng-if="!sending">Cotizar</span>
								<span data-ng-if="sending">Enviando...</span>
							</button>
				
							<div class="divclear">
								&nbsp;
							</div>
						</div>
						<!--/ Submit Button -->
						
					</div>
					<!--/ Form Wrapper -->
					
					<!-- Pixels -->
					<div data-ng-repeat="p in pixels" data-ng-if="p.visible">
						<div data-ng-bind-html="p.code"></div>
					</div>
					<!--/ Pixels -->

					<input type="hidden" name="title" value="<?php the_title(); ?>" />					
					
					
				</div>
			</div>	
		</div>

		


	</form>
</div>

    </div>
  </div>
</div>
<?php
return ob_get_clean();
}


function ns_form_field_shortcode ( $settings, $value ) {

	// Include Shortcode Actions Files
	$actions_dir 	= get_template_directory() . DIRECTORY_SEPARATOR . "actions";
	$actions_list 	= list_php_files ( $actions_dir );
	$actions 		= array();
	$models 		= get_models();
	foreach ( $actions_list as $action_listed ) {
		$action_name = str_replace ( '.php', '', $action_listed );

		$actions[] = array(
			'name' 		=> $action_name,
			'shortcode'	=> $action_name . '_shortcode'
		);
	}

    $dependency 	= vc_generate_dependencies_attributes($settings);
    ob_start();

//    echo '<pre>';
//    print_r (the_ID());
//    echo '</pre>';
?>
	<div id="ns_servicios_admin_form" data-ng-cloak data-value='<?php echo $value; ?>' data-actions='<?php echo base64_encode ( json_encode ( $actions ) ); ?>' data-models="<?php echo base64_encode ( json_encode ( $models ) ); ?>">

		<form name="ns_servicios_form" data-ng-controller="ServiciosFormCtrl">
			
			<!-- CRM -->
			<div class="from-group">
				<label>Conectar con CRM</label>
				<input type="radio" ng-model="data.crm" value="true" /><span>Si</span>
				<input type="radio" ng-model="data.crm" value="false" /><span>No</span>
			</div>
			<!--/ CRM -->
			
			<!-- Actions -->
			<div class="form-group">
				<label>Acci&oacute;n</label>
				<select name="action" class="form-control" data-ng-model="action" data-ng-options="a.name for a in actions" data-ng-change="changeAction()">
					<option value="">Selecciona una acci&oacute;n</option>
				</select>
			</div>
			<!--/ Actions -->

			<!-- Models -->
			<div class="form-group">

				<label>Modelos</label>
				
				<div class="form-group error-message" data-ng-if="missingModels">
					<p><strong>Error:</strong> No hay modelos seleccionados y se ha activado la conexi&oacute;n con el CRM. Favor seleccionar al menos un modelo.</p>
				</div>

				<div class="form-group">
					<label>Mostrar precio</label>

					<input type="radio" data-ng-model="data.showPrice" value="true">
					<span>Si</span>
					<input type="radio" data-ng-model="data.showPrice" value="false">
					<span>No</span>
				</div>

				<div class="form-group">
					<label>Mostrar imagen</label>

					<input type="radio" data-ng-model="data.showPhoto" value="true">
					<span>Si</span>
					<input type="radio" data-ng-model="data.showPhoto" value="false">
					<span>No</span>
				</div>
				
				<div class="form-group">
					<label>Mostrar Descripci&oacute;n</label>

					<input type="radio" data-ng-model="data.showDescription" value="true">
					<span>Si</span>
					<input type="radio" data-ng-model="data.showDescription" value="false">
					<span>No</span>
				</div>

				<div class="form-group">
					<label>Servidor Im&aacute;genes</label>

					<input type="text" data-ng-model="data.photoServer" />
				</div>

				<div class="form-group">
					<ul>
						<li>
							<button type="button" data-ng-click="selectAllModelsSelection(true)" >Seleccionar todos</button>
							<button type="button" data-ng-click="selectAllModelsSelection(false)">Remover todos</button>
						</li>
						<li data-ng-repeat="m in models track by m.term_id">
							<input type="checkbox" data-ng-model="modelSelected" data-ng-change="checkModelSelection ($index, modelSelected, m)" data-ng-checked="data.models.hasOwnProperty (m.term_id)">
							<span>{{m.name}}</span>
							<textarea data-ng-if="data.models.hasOwnProperty (m.term_id)" data-ng-change="updateData ()" data-ng-model="data.models[m.term_id].description" placeholder="Descripción del modelo"></textarea>
						</li>
					</ul>
				</div>

			</div>
			<!--/ Models -->

			<!-- Sucursales -->
			<div class="form-group">
				<label>Sucursales</label>

				<input type="text" data-ng-model="sucursal">
				<button type="button" data-ng-click="addSucursal()">Agregar</button>


				<div class="form-group">
					<ul>
						<li class="ns-sucursal" data-ng-repeat="s in data.sucursales" data-ng-form="sucursal_form" data-ng-controller="SucursalFormCtrl">
							<input type="text" data-ng-model="s.name" placeholder="Nombre Sucursal" />
							<input type="text" data-ng-model="s.address" placeholder="Dirección Sucursal" />
							<input type="text" data-ng-model="s.phone" placeholder="Teléfono Sucursal" />

							<input type="text" data-ng-model="recipient" placeholder="Destinatario" />
							<button type="button" data-ng-click="addRecipient()">A&ntilde;adir Destinatario</button>
							<input type="text" data-ng-model="cc" placeholder="CC" />
							<button type="button" data-ng-click="addCc()">A&ntilde;adir CC</button>


							<ul>
								<li data-ng-repeat="r in s.recipients track by $index">
									<span>{{r}}</span>
									<button type="button" data-ng-click="removeRecipient($index)">Remover</button>
								</li>
							</ul>

							<ul>
								<li data-ng-repeat="c in s.ccs track by $index">
									<span>{{c}}</span>
									<button type="button" data-ng-click="removeCc($index)">Remover</button>
								</li>
							</ul>

							<button type="button" data-ng-click="removeSucursal($index)">Remover</button>
						</li>
					</ul>
				</div>

			</div>

			<!--/ Sucursales -->

			<!-- Pixels -->
			<div class="form-group">
				<label>Pixels</label>
				<input type="text" name="pixel" data-ng-model="pixel" placeholder="HTML">
				<input type="text" data-ng-model="pixelParamName" placeholder="Nombre del parámetro" />
				<input type="text" data-ng-model="pixelParamValue" placeholder="Valor del parámetro" />
				<button type="button" data-ng-click="addPixel()">Agregar</button>

				<div>
					<ul>
						<li data-ng-repeat="p in data.pixels">
							<span>{{p.code}}</span>
							<span>{{p.paramName}}</span>
							<span>{{p.paramValue}}</span>

							<button type="button" data-ng-click="removePixel($index)">Eliminar</button>
						</li>
					</ul>
				</div>
			</div>
			<!--/ Pixels -->
			
			<!-- Fixed Recipients -->
			<div class="form-group">
				<label>Destinatarios Fijos</label>
				<input type="email" name="fixedRecipient" data-ng-model="fixedRecipient" />
				<button type="button" data-ng-click="addFixedRecipient()" >Agregar</button>
				
				<div>
					<ul>
						<li data-ng-repeat="fr in data.recipients">
							<span>{{fr}}</span>
							<button type="button" data-ng-click="removeFixedRecipient($index)">Remover</button>
						</li>
					</ul>
				</div>
			</div>
			<!--/ Fixed Recipients -->

			<!-- Debug -->
			<div data-ng-if="debug">
				<h3>Data</h3>
				<pre>{{data | json}}</pre>
			</div>
			<!--/ Debug -->

			<!-- Visual Composer Field -->
				<input name="<?php echo $settings['param_name']; ?>" type="text" style="display:none;" class="wpb_vc_param_value" data-ng-model="result" />
			<!--/ Visual Composer Field -->
		</form>

	</div>	
<?php
    return ob_get_clean();
}

add_shortcode_param ( 'ns_form_field', 'ns_form_field_shortcode', get_template_directory_uri () . '/js/forms/servicios.admin.js' );



add_shortcode( 'ns_form', 'ns_form_shortcode' );

register_vc_shortcode ( 
	array (
		"name" 						=> __("NS Formulario", 'nskameleon'),
		"base" 						=> "ns_form",
		"class" 					=> "",
		"category" 					=> __('Content', 'nskameleon'),
		"as_parent" 				=> array(
			'only' => 'ns_form_pixel,ns_form_email,ns_form_crm'
		),
		'admin_enqueue_js'			=> get_template_directory_uri () . '/vendor/angular/angular.js',
		// 'admin_enqueue_js'			=> get_template_directory_uri () . '/vendor/angular/angular.min.js',
	    "params" 					=> array(
	    	array (
	    		'type' 			=> 'ns_form_field',
	    		'holder'		=> 'div',
	    		'class'			=> '',
	    		'heading'		=> __(''),
	    		'param_name'	=> 'servicios_form_config',
	    		'value'			=> '',
	    		'description'	=> __('Configuración de formularios.')
	    	)
	    )
	)
);
