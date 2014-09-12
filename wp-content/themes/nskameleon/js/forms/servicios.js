(function (window, angular, $, d, undefined) {

	var data = angular.fromJson (d.data);
	console.log(data);

	angular.module ('ServicesFormApp', [])

		/**
		 * FormCtrl
		 */
		.controller ('FormCtrl', [
			'$scope',
			function ($scope) {

				var ajaxUrl,
					action 			= 'services_form_submit';
				// Models
				$scope.success 		= false;
				$scope._error 		= false;
				$scope.sending 		= false;
				$scope.sent 		= false;
				$scope.sucursales 	= [];
				$scope.emails 		= [];
				$scope.pixels 		= [];
				
				angular.extend ($scope.emails, data.recipients);
				angular.extend ($scope.sucursales, data.sucursales);
				angular.extend ($scope.pixels, data.pixels);

				$scope.submit = function () {
					$scope.sending = true;

					// Set fields $dirty as true to display error messages if needed
					if (!$scope.ns_form_servicios.$valid) {
						$scope.ns_form_servicios.name.$dirty 		= true;
						$scope.ns_form_servicios.phone.$dirty 		= true;
						$scope.ns_form_servicios.email.$dirty 		= true;
						$scope.ns_form_servicios.sucursal.$dirty 	= true;
						$scope.ns_form_servicios.comments.$dirty 	= true;
						
						$scope.sending = false;
						return; // Show error messages and do nothing else...
					}

					// jQuery to the rescue :P
					// $.ajax({
					// 	type: 		'POST',
					// 	dataType: 	'json',
					// 	data: 		{
					// 		action: 		action,
					// 		nombre: 		$scope.firstname,
					// 		apellido: 		$scope.lastname,
					// 		mail: 			$scope.email,
					// 		crm_product: 	$scope.product.code,
					// 		telefono: 		$scope.phone,
					// 		sede: 			$scope.sede,
					// 		programa: 		$scope.product.name,
					// 		brochure: 		0
					// 	},
					// 	url: 		ajaxUrl,
					// 	success: 	function (data) {
					// 		$timeout (function () { // Since this is outside angular environment
					// 			if (data.success)
					// 				$scope.success = true;
					// 			else
					// 				$scope._error 	= true;

					// 			$scope.sending 	= false;
					// 			$scope.sent 	= true;
					// 		});
					// 	}
					// });
					// EOF jQuery XD

				};

			}
		])

	;

})(window, angular, jQuery, ns_data);