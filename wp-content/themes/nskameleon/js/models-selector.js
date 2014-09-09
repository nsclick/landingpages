!function($) {
    $('#all-models').click(function(e){
        //e.preventDefault();
        //console.log( $( this ).prop('checked') );
        if($( this ).prop('checked'))
			$( '.inalc-models' ).prop('checked', true);
        else
			$( '.inalc-models' ).prop('checked', false);
    });
	
	var saveChecked = function() {
		var selected = [];
		$( ".inalc-models" ).each(function( index ) {
			if($( this ).prop('checked')){
				selected.push($( this ).val());
			}
		});
		
		//console.log(selected);
		var json_str = JSON.stringify(selected);
		json_str = json_str.replace(/["'\[\]]/g, "");
		$( '#models' ).val( json_str );
	};
	
	$( ".inalc-models, #all-models" ).on( "change", saveChecked );
	
	
}(window.jQuery);
