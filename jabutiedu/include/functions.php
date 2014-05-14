<?php


$ip = $_SERVER['REMOTE_ADDR'];
$agente = $_SERVER['HTTP_USER_AGENT'];
$currentPage = str_replace(".php","",basename($_SERVER['PHP_SELF']));


function gera_log($servico, $dados){

	global $caminho_absoluto;
	global $caminho_log;
	global $cmd;
	global $caminho_services;

	$script = $caminho_services."log.php ";
	$log 	= " > ".$caminho_log."log.txt 2>&1 &";
	$args	= $servico." \"".addcslashes( $dados, "\\\'\"&\n\r<>" )."\"";


	//$args	= escapeshellarg( $args );
	//$log = "";

	//echo ($cmd.$script.$args.$log);
	//echo "<br>\n";

	//var_dump( $dados );
	//echo " - ";
	//var_dump( json_decode($dados) );

	//echo "<br>";
	$out = "";

	//echo ($cmd.$script.$args.$log);

	exec($cmd.$script.$args.$log, $out);

	//echo "<br> terminou";
}

function executaProcesso($script_php, $parametros){

	global $caminho_absoluto;
	global $caminho_log;
	global $cmd;

	$script = $caminho_absoluto.$script_php." ";
	$log 	= " > ".$caminho_log.$script_php.".txt 2>&1 &";
	$args	= " \"".addcslashes( $parametros, "\\\'\"&\n\r<>" )."\"";
	//$log = "";
	//$args = "";


	//echo ($cmd.$script.$args.$log);
	//echo "<br>\n";

	//var_dump( $dados );
	//echo " - ";
	//var_dump( json_decode($dados) );

	//echo $cmd.$script.$args.$log;
	//$log = "";
	
	exec($cmd.$script.$args.$log);
}


function exec_enabled() {
	$disabled = explode(', ', ini_get('disable_functions'));
	return !in_array('exec', $disabled);
}


/* creates a compressed zip file */
function create_zip($files = array(),$destination = '', $overwrite = false, $files_inside = array()) {
	$count = 0;
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = array();
				 $valid_files[ count($valid_files) - 1]['original'] = $file;
				 if( count($files_inside) > 0  )
				 	$valid_files[ count($valid_files) - 1]['destino'] = $files_inside[$count];
				 else
				 	$valid_files[ count($valid_files) - 1]['destino'] = $file;
				 $count++;				 
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file['original'], $file['destino']);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

		//close the zip -- done!
		$zip->close();

		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}


function getFieldFromPage( $field, $type = 5){

	global $FIELD_TYPE_INT;
	global $FIELD_TYPE_NUMBER;
	global $FIELD_TYPE_JSON;
	global $FIELD_TYPE_STRING;
	global $FIELD_TYPE_TEXT;

	$data = "";
	$data_verified = null;

	if( isset($_GET[$field]) )
		$data = $_GET[$field];

	if( isset($_POST[$field]) )
		$data = $_POST[$field];


	if( $type == $FIELD_TYPE_INT )	{			//Inteiros
		$data_verified = intval( $data );

	} else 	if( $type == $FIELD_TYPE_NUMBER )	{	//decimais
		$data_verified = floatval( $data );

	} else 	if( $type == $FIELD_TYPE_STRING )	{	//string

		$data_verified = strval( $data );

		//corta na primeira palavra
		$txt = explode(" ", $data_verified);
		$data_verified = $txt[0];
		//Limpa a query
		$data_verified = cleanQuery( $data_verified );

		//Caso tenha algum sinal, invalida o dado
		$pos = strpos($data_verified, "=");
		if ($pos > 0)
			return null;

		$pos = strpos($data_verified, ">");
		if ($pos > 0)
			return null;
			
		$pos = strpos($data_verified, "<");
		if ($pos > 0)
			return null;

	} else 	if( $type == $FIELD_TYPE_TEXT )	{	//texto

		$data_verified = strval( $data );

		//tratamento para caracteres especiais
		$data_verified = cleanQuery( $data_verified );

	} else 	if( $type == $FIELD_TYPE_JSON )	{	//JSON

		$data_verified = json_decode( $data );

		//if( !$data_verified )
		//	$data_verified = "";
	}

	return $data_verified;
}



?>
