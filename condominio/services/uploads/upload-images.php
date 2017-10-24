<?php
$pathAbsolute = realpath(dirname(dirname(dirname(dirname(__FILE__)))));

$img = $_POST ['imageData'];
$img = str_replace ( 'data:image/png;base64,', '', $img );
$img = str_replace ( ' ', '+', $img );
$data = base64_decode ( $img );
$file = uniqid () . '.png';
$fileCompleto = $pathAbsolute.$_POST ['folder'] . $file;

file_put_contents ( $fileCompleto, $data );

$res = array("arquivo" => $file);

echo json_encode($res);