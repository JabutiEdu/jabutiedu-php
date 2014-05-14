<?php 

include_once '../include/config.php';
include_once '../include/constantes.php';
include_once '../include/functions.php';
include_once '../include/database.php';
include_once '../include/sessao.php';


sess_reset();


$login = getFieldFromPage('login', $FIELD_TYPE_STRING);
$senha = getFieldFromPage('senha', $FIELD_TYPE_STRING);
$id_modulo = getFieldFromPage('id_modulo', $FIELD_TYPE_STRING);

$stmt = $conn->prepare("select id_pessoa, nome, id_pessoa_tipo, id_modulo from pessoa where login = :login and senha = :senha;");
$stmt->bindParam("login", $login );
$stmt->bindParam("senha", $senha );
$stmt->execute();

if( $stmt->rowCount() > 0 ){
	
	while ($row = $stmt->fetch(PDO::FETCH_OBJ, PDO::FETCH_ORI_NEXT)){
		
		sess_start();

		$SES_VAR['id_pessoa'] 			= $row->id_pessoa;
		$SES_VAR['nome_pessoa'] 	= utf8_encode(  $row->nome );
		$SES_VAR['id_pessoa_tipo']  = $row->id_pessoa_tipo;
		$SES_VAR['id_modulo'] 			= $id_modulo;
		
		echo '[{"result":"1"}]';

	    sess_close();
		
		exit;
	}
	
} else {
	
	echo '[{"result":"E-mail ou senha incorretos."}]';	
}

	
?>