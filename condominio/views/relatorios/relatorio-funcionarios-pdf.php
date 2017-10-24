<?php
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/entidades/ListaFuncionariosRelatorio.class.php');
include(realpath(dirname(dirname(dirname(__FILE__)))) . '/DAO/FuncionarioDAO.class.php');

$FuncionarioDAO = new FuncionarioDAO();
$lista = $FuncionarioDAO->listarFuncionariosJSON(null);
// Instanciation of inherited class
$pdf = new ListaFuncionariosRelatorio();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4');
$pdf->SetFont('Courier','',12);

$header = array('Cod.', 'Nome', 'CPF', 'Cargo', 'Empresa', 'Data de entrada', 'Data de saída');
$pdf->montarTabela($header, $lista);

$pdf->Output();
?>