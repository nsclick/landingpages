(function (window, angular, $, d, undefined) {

	var data 	= angular.fromJson (d.data),
		models	= d.models;
	
	angular.forEach (models, function (model) {
		var fotos 		= model.option_value.fotos,
			fotoBlanca;
		
		angular.forEach (fotos, function (foto) {
			if (foto.type == 'fondo_blanco')
				fotoBlanca = foto.url;
		});
		
		model.foto = fotoBlanca;
	});
	
	//console.log(data, models); 

	angular.module ('ServicesFormApp', ['ngSanitize'])

		/**
		 * FormCtrl
		 */
		.controller ('FormCtrl', [
			'$scope',
			'$timeout',
			'$location',
			'$sce',
			function ($scope, $timeout, $location, $sce) {
				// Models
				$scope.success 			= false;
				$scope._error 			= false;
				$scope.sending 			= false;
				$scope.sent 			= false;
				$scope.isCrm  			= (data.crm == 'true');
				$scope.showPrice 		= (data.showPrice == 'true');
				$scope.showPhoto 		= (data.showPhoto == 'true');
				$scope.selectedModels 	= [];
				$scope.sucursales 		= [];
				$scope.emails 			= [];
				$scope.pixels 			= [];
				$scope.models 			= [];
				$scope.photoServer 		= data.hasOwnProperty('photoServer') ? data.photoServer : '';
				
				// Fields Models
				$scope.firstname 		= null;
				$scope.lastname 		= null;
				$scope.rut 				= null;
				$scope.email 			= null;
				$scope.phone 			= null;
				$scope.comments 		= null;
				
				var hasSucursales = data.hasOwnProperty('sucursales') && angular.isArray(data.sucursales) && data.sucursales.length > 0;
				if (hasSucursales) {
					$scope.sucursal 	= null;
					angular.extend ($scope.sucursales, data.sucursales);
				}
				
				angular.extend ($scope.pixels, data.pixels);
				
				if ($scope.isCrm) {
					angular.forEach (models, function (model) {
						var termId = model.term_id;
						
						if (data.models.hasOwnProperty (termId)) {
							$scope.models.unshift (model);
						}
					});
				};
				
				angular.forEach ($scope.pixels, function (pixel) {
					pixel.code = $sce.trustAsHtml (pixel.code);
				});
				
				$scope.toggleModel = function (model, index, state) {
					state = !angular.isUndefined(state) ? state : model.state || false;
					
					if (state)
						$scope.selectedModels.unshift(model);
					else {
						$scope.selectedModels.splice(index, 1);
						model.state = state;
					}
				};
				
				$scope.submit = function () {
					$scope.sending = true;
					
					// Set fields $dirty as true to display error messages if needed
					if (!$scope.ns_form_servicios.$valid) {
						$scope.ns_form_servicios.firstname.$dirty 	= true;
						$scope.ns_form_servicios.lastname.$dirty 	= true;
						$scope.ns_form_servicios.phone.$dirty 		= true;
						$scope.ns_form_servicios.email.$dirty 		= true;
						if (hasSucursales)
							$scope.ns_form_servicios.sucursal.$dirty 	= true;
						$scope.ns_form_servicios.comments.$dirty 	= true;
						if ($scope.ns_form_servicios.hasOwnProperty('rut'))
							$scope.ns_form_servicios.rut.$dirty 	= true;
						
						$scope.sending = false;
						return; // Show error messages and do nothing else...
					}
					
					// Basic information collected
					var i = {
							action: 		data.action.shortcode,
					 		firstname: 		$scope.firstname,
					 		lastname: 		$scope.lastname,
					 		email: 			$scope.email,
					 		phone:	 		$scope.phone,
					 		comments: 		$scope.comments
					};
					
					// Sucursales
					if (hasSucursales)
						i.sucursal = $scope.sucursal;
					
					// CRM
					if (data.crm == 'true') {
						i.crm 		= true;
						i.products 	= $scope.products;
						i.rut 		= $scope.rut;
					}
					
					// Products
					if (models)
						i.models = $scope.selectedModels;
					
					// CRM
					if ( data.hasOwnProperty ('recipients' ) && angular.isArray (data.recipients) && data.recipients.length > 0) {
						i.recipients 		= data.recipients;
					}

					/* jQuery to the rescue :P */
					$.ajax({
					 	type: 		'POST',
					 	dataType: 	'json',
					 	data: 		i,
					 	url: 		d.ajax,
					 	success: 	function (r) {
					 		console.log('Response: ', r);
					 		
					 		$timeout (function () { // Since this is outside angular environment
					 			if (r.success) {
					 				$scope.success = true;		
					 				showPixels ();
					 			}
					 			else
					 				$scope._error 	= true;

					 			$scope.sending 	= false;
					 			$scope.sent 	= true;
					 		});
					 	}
					 });
					/* EOF jQuery XD */

				};
				
				function showPixels () {
					var search = $location.search();
					
					angular.forEach ($scope.pixels, function (pixel) {
						if (search.hasOwnProperty (pixel.paramName))
							if (pixel.paramValue == search[pixel.paramName])
								pixel.visible = true;
					});
				};
				
//				showPixels ();

			}
		])
		
		/**
		 *  Price Filter
		 */
		.filter ('price', [ 
			function () {
				return function (value, symbol, separator) {
					var str 	= value.toString(),
						out 	= '',
						counter	= 0;
					
					symbol 		= symbol === false ? '' : symbol;
					separator 	= separator === false ? '' : separator;
					
					symbol 		= !angular.isUndefined(symbol) ? symbol : '$';
					separator	= !angular.isUndefined(separator) ? separator : '.';
					
					for (var i = str.length - 1; i >= 0; i-- ) {
						counter++;
						
						if (counter % 3 == 0 && (i > 0)) {
							out = separator + str[i] + out;
						} else {
							out = str[i] + out;
						}
					}
					
					return symbol + out;
				}
			}
		])

	;

})(window, angular, jQuery, ns_data);
