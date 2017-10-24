$(document).ajaxSend(function( event, jqxhr, settings ) {
	loading(settings.loading);
}).ajaxStop(function() {
	loading(false);
});

function loading(status){
	if( status === true){ //|| settings.loading == undefined
		$('#loading').modal('show');
	}else{
		$('#loading').modal('hide');
	}
}