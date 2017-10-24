<?php
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/ListaCorreiosDiarioRelatorio.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/CorreioDAO.class.php');

$CorreioDAO = new CorreioDAO();

$data = isset($_GET["data"]) ? toolBox::formataData($_GET["data"],"G") : NULL;

$lista = $CorreioDAO->listarEntradaCorrespondenciaDiariaJSON($data);
if(!$lista){
	echo "Não há resultados";
	exit;
}
// Instanciation of inherited class
$pdf = new ListaCorreiosDiarioRelatorio();
$pdf->setDataRelatorio($data);
$pdf->AliasNbPages();
$pdf->AddPage('L','A4');
$pdf->SetFont('Courier','',12);

$header = array('Unidade', 'Item', 'Resp. recebimento', 'Data', 'Assinatura');
$pdf->montarTabela($header, $lista);

$pdf->Output();
?>