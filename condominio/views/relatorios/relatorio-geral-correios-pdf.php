<?php
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/ListaCorreiosGeralRelatorio.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/CorreioDAO.class.php');

$CorreioDAO = new CorreioDAO();

$lista = $CorreioDAO->listarRelatorioGeralCorrespondenciasJSON();
if(!$lista){
	echo "Não há resultados";
	exit;
}
// Instanciation of inherited class
$pdf = new ListaCorreiosGeralRelatorio();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4');
$pdf->SetFont('Courier','',12);

$header = array('Entrada', 'Item', 'Unidade', 'Resp. recebimento', 'Retirada', 'Observação');
$pdf->montarTabela($header, $lista);

$pdf->Output();
?>