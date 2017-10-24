<?php
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/ListaMoradoresRelatorio.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/MoradorDAO.class.php');

$moradorDAO = new MoradorDAO();
$lista = $moradorDAO->listarMoradoresPorTorre();
// Instanciation of inherited class
$pdf = new ListaMoradoresRelatorio();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4');
$pdf->SetFont('Courier','',12);

$header = array('Torre', 'Unid', 'Nome', 'Tipo', 'CPF', 'Dt. Nasc', 'Dt inicio', 'Profissão');
$pdf->montarTabela($header, $lista);


$pdf->Output();
?>