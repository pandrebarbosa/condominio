<form role="form" name="frm-ocorrencias" id="frm-ocorrencias">
	<div class="row">

		<div class="col-md-12">									
			<div class="row">
				<div class="col-md-3">
					<label for="exampleInputEmail1">Tipo de morador</label>
					<select id="co_tipo_ocorrencia" name="co_tipo_ocorrencia" class="form-control">
					<?php
					$res_tocorrencia = $banco->seleciona ( "tb_tipo_ocorrencia", "*", "", "", "", "", FALSE );
					if (is_array ( $res_tocorrencia )) {
						foreach ( $res_tocorrencia as $tocorrencia ) {?>
					  <option value="<?php echo $tocorrencia['co_tipo_ocorrencia'] ?>" id="co_tipo_ocorrencia<?php echo $tocorrencia['co_tipo_ocorrencia'] ?>"><?php echo $tocorrencia['ds_tipo_ocorrencia'] ?></option>
					<?php } } ?>
					</select>
				</div>										
				<div class="col-md-6">
					<label for="exampleInputEmail1">Titulo</label>
					<input type="text" class="form-control" id="ds_titulo" name="ds_titulo" placeholder="Título da ocorrência">
				</div>
				<div class='col-sm-3'>
		            <div class="form-group">
		            <label for="exampleInputEmail1">Data/hora da ocorrência</label>
		                <div class='input-group date datetimepicker' id='datetimepicker'>
		                    <input type='text' id="dt_hr_ocorrencia" value="<?php echo date("d/m/Y H:i")?>" class="form-control" />
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                </div>
		            </div>
		        </div>									
			</div><!-- Fecha div row -->
			<p></p>
			<div class="row">
				<div class="col-md-12">
					<label for="exampleInputEmail1">Descrição da ocorrência</label>
					<textarea class="form-control" rows="4" id="ds_ocorrencia" name="ds_ocorrencia"></textarea>
				</div>										
			</div>
			<p></p>									
		</div><!-- Fecha div col-md-12 -->
		
	</div>
	<!-- Fim div row -->

	<div class="panel-footer text-right">
		<button type="button" class="btn btn-primary" id="btn-salvar-ocorrencia">Gravar</button>
		<button type="reset" class="btn btn-default" id="btn-reset-ocorrencia">Cancelar</button>
	</div>
	<!-- Fim div panel-footer -->
	<input type="hidden" id="co_ocorrencia">	
</form>