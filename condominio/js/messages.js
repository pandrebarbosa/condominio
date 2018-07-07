/**
 * controle de mensagens do sistema
 */
var mostrarAlertas = function( tipo, msg ) {
	$('#alertas').append("<span class=\"texto-msg\">" + msg + "</span>");
	$('#alertas').removeClass();
	$('#alertas').addClass('alert alert-dismissable alert-' + tipo).show('slow');
	
	setInterval(function(){ 
		$('#alertas').fadeOut('slow', function() {
			$('span').remove(".texto-msg");
		});		
	 },3000);	
};