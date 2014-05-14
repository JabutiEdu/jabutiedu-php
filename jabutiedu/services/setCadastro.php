<?php 

include_once '../include/config.php';
include_once '../include/constantes.php';
include_once '../include/functions.php';
include_once '../include/database.php';
include_once '../include/sessao.php';


resetaSessao();

/*
nome
data_nascimento
email
instituicao
times
senha
senha_2
*/

$login = getFieldFromPage('login', $FIELD_TYPE_STRING);
$senha = getFieldFromPage('senha', $FIELD_TYPE_STRING);


$stmt = $conn->prepare("select id_pessoa, nome, id_nivel from pessoa where login = :login and senha = :senha;");

$stmt->bindParam("login", $login );
$stmt->bindParam("senha", $senha );

$stmt->execute();

if( $stmt->rowCount() > 0 ){
	
	while ($row = $stmt->fetch(PDO::FETCH_OBJ, PDO::FETCH_ORI_NEXT)){
		
		setaSessao( $row->id_pessoa, $row->nome, $row->id_nivel );
		
		echo '[{"result":"1"}]';
		exit;
		
		//$expira = time()+(3600*24*7);
		//setcookie("email", $usuario,  $expira);
		
			
		/*
		$stmt = $conn->prepare("insert into log (id_log_tipo, endereco_ip, agente, id_usuario, id_fase ) values (:log_tipo, :ip, :agente, :usuario, :fase );");
		$stmt->bindParam("log_tipo", $LOG_ACESSO_SUCESSO);
		$stmt->bindParam("ip", $ip );
		$stmt->bindParam("agente", $agente);
		$stmt->bindParam("usuario", $row->id_usuario);
		$stmt->bindParam("fase", $row->id_fase );
		$stmt->execute();
		*/
		
	}
	
	
	
} else {
	
	//loga o erro de login
	/*
	$stmt = $conn->prepare("insert into log (id_log_tipo, endereco_ip, agente, login, senha ) values (:log_tipo, :ip, :agente, :login, :senha );");
	$stmt->bindParam("log_tipo", $LOG_ACESSO_FALHA);
	$stmt->bindParam("ip", $ip );
	$stmt->bindParam("agente", $agente);
	$stmt->bindParam("login", $usuario );
	$stmt->bindParam("senha", $senha);
	$stmt->execute();
	*/ 
	
	echo '[{"result":"E-mail ou senha incorretos."}]';	
}

	
?>