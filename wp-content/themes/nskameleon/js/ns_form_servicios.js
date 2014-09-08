(function (window, $, ns_data, undefined) {
$(document.body).ready (function () {

	var form = $('#ns_form_servicios');


	form.on ('submit', function (ev) {
		ev.preventDefault();

		var data = {
			action: 'ns_form_servicios_submit',
			data: 	form.serialize()
		};

		$.ajax ({
			type: 		'POST',
			url: 		ns_data.ajax,
			dataType: 	'json',
			data: 		{
				action: 'ns_form_servicios_submit',
				data: 	form.serialize()
			},
			success: function (r) {
				console.log(r);
			}
		});
	});

});
})(window, jQuery, ns_data);