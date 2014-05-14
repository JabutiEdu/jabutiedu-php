<?php 
require_once("../include/functions.php");
checaSessao();


$senha = md5( getFieldFromPage('senha_atual',$FIELD_TYPE_STRING) );
$nova_senha = md5( getFieldFromPage('nova_senha',$FIELD_TYPE_STRING) );
$confirma_senha = md5( getFieldFromPage('confirma_senha',$FIELD_TYPE_STRING) );



$stmt = $conn->prepare("select id_usuario, id_tipo, nome, id_fase, primeiro_acesso from usuario where id_usuario = :usuario and senha = :senha and estado = 1");
$stmt->bindParam("usuario", $id_usuario );
$stmt->bindParam("senha", $senha );
$stmt->execute();

if( $stmt->rowCount() > 0 ){
	
		$primeiro_acesso = 0;
		
		$stmt = $conn->prepare("update usuario set primeiro_acesso = 0, senha = :senha where id_usuario = :usuario;");
		$stmt->bindParam("usuario", $id_usuario);
		$stmt->bindValue("senha", $nova_senha );
		$stmt->execute();
		
		echo '[{"result":"1"}]';	
	
} else {
	
	//o cara errou a senha atual	
	echo '[{"result":"0"}]';	
}

	
?>