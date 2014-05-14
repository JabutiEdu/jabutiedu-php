<?php

//Arquivo: Sessao.php
//Módulo de persistência de sessão
//**************************************

include_once 'config.php';
include_once 'database.php';
include_once 'cypher.php';

$user_agent = $_SERVER[ 'HTTP_USER_AGENT' ];
$remote_addr = $_SERVER[ 'REMOTE_ADDR' ];

//Data de expiração da sessão - 1 x 30 dias x 24 horas x 3600 segundos
$expired_date = 1 * 30 * 24 * 3600 ;  

srand((double)microtime()*1000000);

//aqui ficam os dados da sessão - id_sessao e os dados do usuario
$SES_VAR = array();

//Essa é a chave do cookie de sessão... deve ser algo aleatório...
$chave_cookie_sessao = "LIN)(&XI@&!OHasda@&";

if( isset( $_COOKIE[ $chave_cookie_sessao ] ) )
	$SESSID = decryptString( $_COOKIE[ $chave_cookie_sessao ] );

/*
function arrayToGlobal( $arr ){
	GLOBAL $SES_VAR;
	//var_dump( $arr );

	while (list($key,$val)=each($arr) )
	{
		//pega da variavel global e não do $sess_var
		GLOBAL ${$key};
		${$key} = $val;

		$SES_VAR[$key] = $val;
	}
}
*/

function copyArrayData($from, &$to ){
	
	while (list($key,$val)=each($from) )
	{
		$to[$key] = $val;
	}
}

function generate_SID()
{
	GLOBAL $remote_addr;
	return md5(rand(0,32000) . $remote_addr . rand(0,32000));
}

function setaCookieSessao(){
	
	Global $SESSID, $expired_date, $chave_cookie_sessao;
	
	//setcookie("CookieTeste", $value);
	//setcookie("CookieTeste", $value, time()+3600);  /* expira em 1 hora */
	//setcookie("CookieTeste", $value, time()+3600, "/~rasmus/", ".example.com", 1);
	setcookie( $chave_cookie_sessao ,  encryptString( $SESSID ), time()+$expired_date*3600,"/");
		
}

//{"HTTP_HOST":"localhost","HTTP_USER_AGENT":"Mozilla\/5.0 (X11; Ubuntu; Linux x86_64; rv:25.0) Gecko\/20100101 Firefox\/25.0","HTTP_ACCEPT":"text\/html,application\/xhtml+xml,application\/xml;q=0.9,*\/*;q=0.8","HTTP_ACCEPT_LANGUAGE":"en-US,en;q=0.5","HTTP_ACCEPT_ENCODING":"gzip, deflate","HTTP_REFERER":"http:\/\/localhost\/","HTTP_COOKIE":"email=daniel%40opcode.com.br; __utmz=111872281.1382360221.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); sGgfdj623u3=9aMGOQ1gyfkmOcR5kg0uCHcQeqqgtffS0xgToKcgAkU%2C; PHPSESSID=7snjp1mfka4d5d7i3n4pc2b6f1","HTTP_CONNECTION":"keep-alive","PATH":"\/usr\/local\/bin:\/usr\/bin:\/bin","SERVER_SIGNATURE":"<address>Apache\/2.2.22 (Ubuntu) Server at localhost Port 80<\/address>\n","SERVER_SOFTWARE":"Apache\/2.2.22 (Ubuntu)","SERVER_NAME":"localhost","SERVER_ADDR":"127.0.0.1","SERVER_PORT":"80","REMOTE_ADDR":"127.0.0.1","DOCUMENT_ROOT":"\/home\/phantor\/workspaces\/workspace-php","SERVER_ADMIN":"webmaster@localhost","SCRIPT_FILENAME":"\/home\/phantor\/workspaces\/workspace-php\/vetu\/index.php","REMOTE_PORT":"45997","GATEWAY_INTERFACE":"CGI\/1.1","SERVER_PROTOCOL":"HTTP\/1.1","REQUEST_METHOD":"GET","QUERY_STRING":"","REQUEST_URI":"\/vetu\/","SCRIPT_NAME":"\/vetu\/index.php","PHP_SELF":"\/vetu\/index.php","REQUEST_TIME":1386200464}


function criaNovaSessao(){
	
	global $SESSID, $chave_cookie_sessao, $SES_VAR, $conn, $expired_date, $user_agent, $remote_addr;
	
	$SESSID = generate_SID();
	
	$SES_VAR = array();
	$SES_VAR['id_sessao'] =  $SESSID;
	

	$dados = array();
	$dados['id_sessao'] = $SESSID;
	$dados['estado'] = 1;
	$dados['data_expira'] = date('Y-m-d H:i:s', time() + $expired_date );
	$dados['user_agent'] = $user_agent;
	$dados['remote_ip'] = $remote_addr;
	
	executeInsert($conn, "sessao", $dados);
	
	setaCookieSessao();
}


function sess_start()
{
	global $SESSID, $chave_cookie_sessao, $SES_VAR, $conn, $expired_date, $user_agent, $remote_addr;
	
	if (!$SESSID) {
		criaNovaSessao();
		return;
	}
				
	//checa no banco de dados se a sessão existe
	$sql = "select id_sessao, data_expira, data_ultimo_acesso, estado, dados_sessao from sessao where id_sessao = :id_sessao and estado = 1";
	$stmt = $conn->prepare( $sql );
	$stmt->bindParam("id_sessao", $SESSID );
	$stmt->execute();
	
	if( $stmt->rowCount() > 0 ){
	
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){
			
			//se a sessão expirou, cai fora...
			if ( time() > strtotime( $row['data_expira'] ) )
			{
				//deleta a sessao no banco (estado = 9)
				criaNovaSessao();
				return;
			}
			
			$SES_VAR = array();
			$SES_VAR['id_sessao'] = $SESSID;

			//arrayToGlobal(  $row ); antes decupava a sessão em globais...
			//agora parseia o jason em um array e devolve
			$dados_sessao = json_decode( $row['dados_sessao']   );
		   	
			if( count( $dados_sessao ) > 0   )			{
				copyArrayData($dados_sessao  , $SES_VAR);
			}
		
		}
	
	} else { //se a sessão ainda não está no banco de dados, não faz nada
		
		//cria uma nova sessão
		criaNovaSessao();
		
	}
}


/*
 * 
 *	Fecha a sessão e atualiza os dados. 
 * IMPORTANTE - se não executar isso, a sessão não pe persistida 
 * 
 */
function sess_close()
{
			global $SESSID, $SES_VAR, $conn, $user_agent, $_SERVER, $remote_addr;

			$dados = array();
			$dados_sessao = array();
			$condicao = array();
			
			while (list($key,$val)=each($SES_VAR) )
			{
				$val = $SES_VAR[ $key ];
			
				if( $key == "id_sessao") {
					$condicao['id_sessao'] = $val;
					
				} else if( $key == "data_ultimo_acesso") {
						$timestamp = time(); // Salva o timestamp atual numa variável
						$dados['data_ultimo_acesso'] = date('Y-m-d H:i:s', $timestamp);

				}	else if( $key == "data_expira") {
						$timestamp = time(); // Salva o timestamp atual numa variável
						//$dados['data_ultimo_acesso	'] = date('Y-m-d H:i:s', $timestamp);
						
				} else {
					$dados_sessao[ $key ] = $val;
					
				}
				
			}
			
			$dados['dados_sessao'] = json_encode(   $dados_sessao );
			$dados['user_agent'] = $user_agent;
			$dados['remote_ip'] = $remote_addr;
			
		    executeUpdate(  $conn  , "sessao", $dados, $condicao);

		    //Executa o log dos dados para tracking da sessão. Comentar essa parte para performance
		    /*
		    $dados = array();
		    $dados['id_sessao'] = $SES_VAR["id_sessao" ];
		    $dados['dados_enviados'] = json_encode( $_POST );
		    executeInsert($conn, "sessao_log", $dados);
			 */
}

function sess_reset() {
	GLOBAL $chave_cookie_sessao, $SES_VAR, $conn ;
	
	unset($_COOKIE[$chave_cookie_sessao]);
	setcookie($chave_cookie_sessao, NULL, -1); 
	
	//echo $SES_VAR['id_sessao'];
	
	
	if ( isset($SES_VAR['id_sessao'])  ){
	
		//desativa a sessão no banco de dados
		$dados= array();
		$dados['estado'] = 9;
	
		$condicao= array();
		$condicao['id_sessao'] = $SES_VAR['id_sessao'];
	
		executeUpdate( $conn, "sessao", $dados, $condicao);

		//echo "resetou";
		
	}
}


function checa_sessao_usuario_logado(){
	
	GLOBAL $SES_VAR;
		
	if( !isset( $SES_VAR['id_pessoa'] ) ){
		sess_reset();
	  	header('Location: index.php');
	}
		
	if( $SES_VAR['id_pessoa'] == 0 ) {
		sess_reset();
		header('Location: index.php');
	}

		
}


function checa_sessao_permite_servico(){
	
	GLOBAL $SES_VAR;
	
	if( !isset( $SES_VAR['id_pessoa'] ) ){
		sess_reset();
	  	//header('Location: index.php');
	}
		
	if( $SES_VAR['id_pessoa'] == 0 ) {
		sess_reset();
		//header('Location: index.php');
	}
	
	return true;
}



	
?>	