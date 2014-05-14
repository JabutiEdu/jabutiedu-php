<?php
	include_once '../include/sessao.php';
	
	sess_start();
	
	//echo $SES_VAR['dado_qualquer'];
	
	//$SES_VAR['dado_qualquer'] = "teste de dados";
	
	var_dump(  $SES_VAR );
	
	sess_close();
	
	
?>