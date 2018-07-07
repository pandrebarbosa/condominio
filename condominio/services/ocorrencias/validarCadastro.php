<?php
$resultado = '';
$co_ocorrencia = isset($_POST['co_ocorrencia']) ? $_POST['co_ocorrencia'] : '';
$co_unidade = isset($_POST['co_unidade']) ? $_POST['co_unidade'] : '';
$co_tipo_ocorrencia = isset($_POST['co_tipo_ocorrencia']) ? $_POST['co_tipo_ocorrencia'] : '';
$ds_titulo = isset($_POST['ds_titulo']) ? $_POST['ds_titulo'] : '';
$ds_ocorrencia = isset($_POST['ds_ocorrencia']) ? $_POST['ds_ocorrencia'] : '';
$dt_hr_ocorrencia = isset($_POST['dt_hr_ocorrencia']) ? toolBox::formataDataHora($_POST['dt_hr_ocorrencia'],"G") : '';

if( empty( $co_unidade )){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Unidade não identificada!");
	echo json_encode($resultado);
	exit;
}
if( empty( $co_tipo_ocorrencia )){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Tipo de ocorrência não identificado!");
	echo json_encode($resultado);
	exit;
}
if( empty( $ds_titulo )){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Título não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( empty( $ds_ocorrencia )){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Ocorrência não preenchida!");
	echo json_encode($resultado);
	exit;
}
if( empty( $dt_hr_ocorrencia )){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Data/hora não preenchida!");
	echo json_encode($resultado);
	exit;
}