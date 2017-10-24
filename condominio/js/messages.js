/**
 * controle de mensagens do sistema
 */
var mostrarAlertas = function( tipo,msg ) {
	$('#alertas').append("<span class=\"texto-msg\">" + msg + "</span>");			
	if(tipo == "sucesso"){
		$('#alertas').removeClass('alert-danger').addClass('alert-success').show('slow');
	}else if(tipo == "erro"){
		$('#alertas').removeClass('alert-success').addClass('alert-danger').show('slow');				
	}
	
	setInterval(function(){ 
		$('#alertas').fadeOut('slow', function() {
			$('span').remove(".texto-msg");
		});		
	 },2500);	
};