<style>
#JtuyoshiCrop #Painel{font-size:12px;padding-bottom:10px;margin:0}
#JtuyoshiCrop #Principal{position:relative;margin:0}
#JtuyoshiCrop #SelecaoRecorte{position:absolute;background-color:#FFF;border:2px #333 dotted;opacity:0.5}
#JtuyoshiCrop .row{
  padding: 0.5em 1em;
}
.ui-dialog .ui-dialog-title{
	font-weight: normal;
	padding: 0;
}
</style>
<script>

</script>
<div id="Painel">

<div class="row">
  <div class="col-xs-4 col-md-4">

  	<select id="SelectOrientacao" title="Choose the Orientation of the cutout area"  class="form-control">    	
    </select>  	

  </div>
  <div class="col-xs-4 col-md-3">
  	<select id="SelectProporcao" title="Choose the Aspect Ratio of selection"  class="form-control">    	
    </select>
  </div>   
   <div class="col-xs-4 col-md-5">		
		<div class="btn-group">
			<button id="button_crop_recortar" class="btn btn-default">Recortar</button>
			<button id="button_crop_original" class="btn btn-default">Concluir</button>
		</div>
   </div>
   
</div>

</div>
<div id="Principal">
	<div id='SelecaoRecorte'></div>
</div>