<?php 

include_once '../include/config.php';
include_once '../include/constantes.php';
include_once '../include/functions.php';
include_once '../include/database.php';
include_once '../include/sessao.php';


$id_instituicao = getFieldFromPage('id_instituicao', $FIELD_TYPE_STRING);
$retorno = Array();

$stmt = $conn->prepare("select id_modulo, descricao from modulo order by descricao;");
$stmt->execute();

if( $stmt->rowCount() > 0 ){

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){

			 $retorno[] = array_map("utf8_encode", $row);

	}

}


echo json_encode( $retorno );
	
?>