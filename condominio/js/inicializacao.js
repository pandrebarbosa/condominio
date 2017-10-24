$(document).ready(function(){
	$('.data').mask('00/00/0000');
	$('.mascara-cpf').mask('000.000.000-00');
	$('.mascara-data').mask('99/99/9999');
	$('.placa').mask('AAA-0000');
	$('.date_time').mask('00/00/0000 00:00');

	var maskBehavior = function (val) {
	 return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	options = {onKeyPress: function(val, e, field, options) {
	 field.mask(maskBehavior.apply({}, arguments), options);
	 }
	};
	
	$('.phone').mask(maskBehavior, options);
	
	$('.date').datepicker({
		language:  'pt-BR',
		autoclose: true
	});
	
	$('.datetimepicker').datetimepicker({
		locale: 'pt-BR'
	});
	
	
	//Image editor
	$('.image-editor').cropit({
	  exportZoom: 1.25,
	  imageBackground: false,
	  width: 200,
	  height: 270 
	});
	$('.rotate-cw').click(function() {
	    $('.image-editor').cropit('rotateCW');
	});
	$('.rotate-ccw').click(function() {
	    $('.image-editor').cropit('rotateCCW');
	});
	
	$('.tooltipster').tooltipster({
		animation: 'fade',
		delay: 300,
	    theme: 'tooltipster-shadow'
	});
});

