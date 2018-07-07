<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

include('validarCadastro.php');

$banco = new banco();

if( empty($co_ocorrencia) ){
	$banco->insere("tb_ocorrencia","co_unidade,co_tipo_ocorrencia,ds_titulo,ds_ocorrencia,dt_hr_ocorrencia,st_ativo,dt_hr_registro", "$co_unidade,$co_tipo_ocorrencia,'$ds_titulo','$ds_ocorrencia','$dt_hr_ocorrencia',TRUE,NOW()",FALSE);
	$resultado =  array("tipo" => "success", "msg" => "Inclusão salva com sucesso.");
}else{
	$banco->altera("tb_ocorrencia","ds_titulo='$ds_titulo',co_tipo_ocorrencia='$co_tipo_ocorrencia',ds_ocorrencia='$ds_ocorrencia',dt_hr_ocorrencia='$dt_hr_ocorrencia',st_ativo=TRUE,dt_hr_registro=NOW()","co_ocorrencia=".$co_ocorrencia." AND co_unidade=".$co_unidade,FALSE);
	$resultado =  array("tipo" => "success", "msg" => "Alteração salva com sucesso.");	
}
echo json_encode($resultado);
exit;
