(function (window, angular, $, undefined) {
	var a, // Actions
		m, // Models
		d; // Data

	angular.module ('ServiciosAdminForm', [])

		.run ([
			'Data',
			function (Data) {
				var missingArrays = [
					'sucursales',
					'pixels',
					'recipients'
				];

				angular.forEach (missingArrays, function (missingArray) {
					if (!Data.value.hasOwnProperty (missingArray))
						Data.value[missingArray] = [];
				});

				var missingObjects = [
					'models'
				];

				angular.forEach (missingObjects, function (missingObject) {
					if (!Data.value.hasOwnProperty (missingObject))
						Data.value[missingObject] = {};
				});

				if (!Data.value.hasOwnProperty ('action'))
					Data.value.action = null;

				if (!Data.value.hasOwnProperty ('showPrice'))
					Data.value.showPrice = null;

				if (!Data.value.hasOwnProperty ('showPhoto'))
					Data.value.showPhoto = null;

				if (!Data.value.hasOwnProperty ('photoServer'))
					Data.value.photoServer = null;

				if (!Data.value.hasOwnProperty ('crm'))
					Data.value.crm = false;

				console.log(Data.value);
			}
		])

		/**
		 * Data
		 */
		.service ('Data', [
			function() {
				try {
					this.value = angular.fromJson (atob (d) );
				} catch (e) {
					this.value = {};
				}
			}
		])

		/**
		 * Actions
		 */
		.service ('Actions', [
			function() {
				try {
					this.value = angular.fromJson (atob (a) );
				} catch (e) {
					this.value = {};
				}
			}
		])

		/**
		 * Models
		 */
		.service ('Models', [
			function() {
				try {
					this.value = angular.fromJson (atob (m) );
				} catch (e) {
					this.value = {};
				}
			}
		])

		/**
		 * ServiciosForm Controller
		 */
		.controller ('ServiciosFormCtrl', [
			'$scope',
			'Data',
			'Actions',
			'Models',
			function ($scope, Data, Actions, Models) {
				$scope.debug  		= true;
				$scope.sucursal 	= null;
				$scope.action  		= null;
				$scope.data 		= Data.value;
				$scope.actions 	 	= Actions.value;
				$scope.models 		= Models.value;
				$scope.result 		= btoa (angular.toJson ($scope.data) );

				angular.forEach ($scope.actions, function (action, index) {
					if (!!$scope.data.action)
					if (action.name == $scope.data.action.name)
						$scope.action = $scope.actions[index];
				});

				$scope.changeAction = function () {
					$scope.data.action = $scope.action;
					$scope.updateData ();
				};

				$scope.addSucursal = function () {
					var newSucursal = {
						name: 		$scope.sucursal,
						recipients: [],
						ccs: 		[]
					};
					$scope.data.sucursales.unshift (newSucursal);
					$scope.sucursal = null;
					$scope.updateData ();
				};

				$scope.removeSucursal = function (index) {
					$scope.data.sucursales.splice (index, 1);
					$scope.updateData ();
				};

				$scope.addPixel = function () {
					var newPixel = {
						code: $scope.pixel
					};
					$scope.data.pixels.unshift (newPixel);
					$scope.pixel = null;
					$scope.updateData ();
				};

				$scope.removePixel = function (index) {
					$scope.data.pixels.splice (index, 1);
					$scope.updateData ();
				};

				$scope.$watch ('data.crm', function (newVal, oldVal) {
					if (newVal != oldVal)
						$scope.updateData ();
				});

				$scope.$watch ('data.showPhoto', function (newVal, oldVal) {
					if (newVal != oldVal)
						$scope.updateData ();
				})

				$scope.$watch ('data.showPrice', function (newVal, oldVal) {
					if (newVal != oldVal)
						$scope.updateData ();
				})

				$scope.$watch ('data.photoServer', function (newVal, oldVal) {
					if (newVal != oldVal)
						$scope.updateData ();
				})

				$scope.updateData = function () {
					$scope.result = btoa (angular.toJson ($scope.data) );
					console.log ('HERE: ', $scope.data);
				};

				$scope.checkModelSelection = function ($index, m) {
					var termId = $scope.models[$index].term_id;

					if (m && !$scope.data.models.hasOwnProperty (termId))
						$scope.data.models[termId] = true;
					else if (!m && $scope.data.models.hasOwnProperty (termId))
						delete ($scope.data.models[termId]);

					$scope.updateData ();
				};

			}
		])

		/**
		 * SucursalesForm Controller
		 */
		.controller ('SucursalFormCtrl', [
			'$scope',
			function ($scope) {
				$scope.recipient 	= null;
				$scope.cc 			= null;
				
				$scope.$watch ('s.name', function (newVal, oldVal) {
					if (newVal != oldVal)
						$scope.updateData ();
				});

				$scope.$watch ('s.address', function (newVal, oldVal) {
					if (newVal != oldVal)
						$scope.updateData ();
				});

				$scope.$watch ('s.phone', function (newVal, oldVal) {
					if (newVal != oldVal)
						$scope.updateData ();
				});

				$scope.addRecipient = function () {
					$scope.s.recipients.unshift ($scope.recipient);
					$scope.updateData ();
				};

				$scope.removeRecipient = function (index) {
					$scope.s.recipients.splice (index, 1);
					$scope.updateData ();
				};

				$scope.addCc = function () {
					$scope.s.ccs.unshift ($scope.cc);
					$scope.updateData ();
				};

				$scope.removeCc = function (index) {
					$scope.s.ccs.splice (index, 1);
					$scope.updateData ();
				};

			}
		])

	;

	/**
	 * Bootstraping the App :D
	 */
	angular.element (document).ready (function () {
		var formWrapper = angular.element (document.querySelector ('#ns_servicios_admin_form'));
		a  				= formWrapper.attr ('data-actions'),
		m  				= formWrapper.attr ('data-models'),
		d 				= formWrapper.attr ('data-value');

		angular.bootstrap (formWrapper, ['ServiciosAdminForm']);
	});

})(window, angular, jQuery);