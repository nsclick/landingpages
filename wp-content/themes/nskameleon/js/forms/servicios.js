(function (window, angular, $, d, undefined) {

	var data 		= angular.fromJson ( unescape (decodeURIComponent (window.atob ( d.data ) ) ) ),
		models		= d.models,
		pageSlug 	= d.page_slug,
		pageTitle 	= d.page_title;
	
	angular.forEach (models, function (model) {
		var fotos 		= model.option_value.fotos,
			fotoBlanca;
		
		angular.forEach (fotos, function (foto) {
			if (foto.type == 'fondo_blanco')
				fotoBlanca = foto.url;
		});
		
		model.foto = fotoBlanca;
	});
	
	/**
	 * RUT validation
	 */
	function revisarDigito2( crut )
	{	
		largo = crut.length;	
		if ( largo < 2 )	
		{		
			return false;	
		}	
		if ( largo > 2 )		
			rut = crut.substring(0, largo - 1);	
		else		
			rut = crut.charAt(0);	
		dv = crut.charAt(largo-1);

		if ( rut == null || dv == null )
			return 0	

		var dvr = '0'	
		suma = 0	
		mul  = 2	

		for (i= rut.length -1 ; i >= 0; i--)	
		{	
			suma = suma + rut.charAt(i) * mul		
			if (mul == 7)			
				mul = 2		
			else    			
				mul++	
		}	
		res = suma % 11	
		if (res==1)		
			dvr = 'k'	
		else if (res==0)		
			dvr = '0'	
		else	
		{		
			dvi = 11-res		
			dvr = dvi + ""	
		}
		if ( dvr != dv.toLowerCase() )	
		{		
			return false	
		}

		return true
	}

	function Rut(texto)
	{	
		texto = texto + '';
		var tmpstr = "";	
		for ( i=0; i < texto.length ; i++ )		
			if ( texto.charAt(i) != ' ' && texto.charAt(i) != '.' && texto.charAt(i) != '-' )
				tmpstr = tmpstr + texto.charAt(i);	
		texto = tmpstr;	
		largo = texto.length;	

		if ( largo < 2 )	
		{		
			return false;	
		}	

		for (i=0; i < largo ; i++ )	
		{			
			if ( texto.charAt(i) !="0" && texto.charAt(i) != "1" && texto.charAt(i) !="2" && texto.charAt(i) != "3" && texto.charAt(i) != "4" && texto.charAt(i) !="5" && texto.charAt(i) != "6" && texto.charAt(i) != "7" && texto.charAt(i) !="8" && texto.charAt(i) != "9" && texto.charAt(i) !="k" && texto.charAt(i) != "K" )
	 		{			
				return false;		
			}	
		}	

		var invertido = "";	
		for ( i=(largo-1),j=0; i>=0; i--,j++ )		
			invertido = invertido + texto.charAt(i);	
		var dtexto = "";	
		dtexto = dtexto + invertido.charAt(0);	
		dtexto = dtexto + '-';	
		cnt = 0;	

		for ( i=1,j=2; i<largo; i++,j++ )	
		{		
			//alert("i=[" + i + "] j=[" + j +"]" );		
			if ( cnt == 3 )		
			{			
				dtexto = dtexto + '.';			
				j++;			
				dtexto = dtexto + invertido.charAt(i);			
				cnt = 1;		
			}		
			else		
			{				
				dtexto = dtexto + invertido.charAt(i);			
				cnt++;		
			}	
		}	

		invertido = "";	
		for ( i=(dtexto.length-1),j=0; i>=0; i--,j++ )		
			invertido = invertido + dtexto.charAt(i);		

		if ( revisarDigito2(texto) )		
			return true;	

		return false;
	}
	
	window.RUT = Rut;
	
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
				$scope.showDescription	= (data.showDescription == 'true');
				$scope.showPrice 		= (data.showPrice == 'true');
				$scope.showPhoto 		= (data.showPhoto == 'true');
				$scope.selectedModels 	= {};
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
				
				// Validations
				$scope.missingModels 	= false;
				
				var hasSucursales = data.hasOwnProperty('sucursales') && angular.isArray(data.sucursales) && data.sucursales.length > 0;
				if (hasSucursales) {
					$scope.sucursal 	= null;
					angular.extend ($scope.sucursales, data.sucursales);
				}
				
				angular.extend ($scope.pixels, data.pixels);
				
				if (angular.isObject (data.models)) {
					angular.forEach (models, function (model) {
						var termId = model.term_id;
						
						if (data.models.hasOwnProperty (termId)) {
							model.description = data.models[termId].description; // Bind description
							$scope.models.unshift (model);
						}
					});
				};
				
				$scope.showModels = $scope.models.length > 0;
				
				angular.forEach ($scope.pixels, function (pixel) {
					pixel.code = $sce.trustAsHtml (pixel.code);
				});
				
				$scope.toggleModel = function (model, index, state) {
					state = !angular.isUndefined(state) ? state : model.state || false;
					
					if (state)
						$scope.selectedModels[model.term_id] = model;
					else {
						delete ($scope.selectedModels[model.term_id]);
						model.state = state;
					}
					
					if (Object.keys($scope.selectedModels).length == 0) {
						$scope.missingModels = true;
						return;
					} else {
						$scope.missingModels = false;
					}
				};
				
				$scope.validateRut = function (rut) {
					var isValid = RUT(rut);
					$scope.ns_form_servicios.rut.$setValidity('format', isValid);
				};
				
				$scope.submit = function () {
					if ($scope.isCrm)
						if (Object.keys($scope.selectedModels).length == 0) {
							$scope.ns_form_servicios.$dirty = true;
							$scope.missingModels = true;
							return;
						} else {
							$scope.missingModels = false;
						}
					
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
					 		comments: 		$scope.comments,
					 		page_title:		pageTitle
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
					 				
					 				// Send Google Analytics Triggers
					 				if (window.hasOwnProperty('_gaq'))
					 					_gaq.push(['_trackPageview', '/' + pageSlug + '/enviado']);
					 					
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
