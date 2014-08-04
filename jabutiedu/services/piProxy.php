<?php 


include_once '../include/config.php';
include_once '../include/constantes.php';
include_once '../include/functions.php';
include_once '../include/database.php';
include_once '../include/sessao.php';


$comando = getFieldFromPage('comando');

$comando = "sudo python interpreter.py ".$comando;

$comando = escapeshellcmd($comando);

echo $comando."<br>\n\r";

echo exec( $comando );

$retorno = Array();

$retorno['resultado'] = "ok";


//echo json_encode( $retorno );


	
?>
