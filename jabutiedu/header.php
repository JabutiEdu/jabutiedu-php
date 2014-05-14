<!doctype html>
<?php 

	include_once 'include/config.php';
	include_once 'include/constantes.php';
	include_once 'include/functions.php';
		

?>
<html>
<head>

<meta charset="utf-8">
<meta name="author" content="Projeto Jaboti" />
<meta name="keywords" content="educação robótica" />
<meta name="robots" content="all" />

<link rel="icon" type="image/png" href="icon.png" />

<!-- CSS -->
<link rel="stylesheet" media="screen" type="text/css" href="css/fonts.css" />
<link rel="stylesheet" media="screen" type="text/css" href="css/geral.css" />

<?php
	if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod')) {
		echo('<link rel="stylesheet" media="screen" href="css/ios.css" type="text/css" />' . "\n");
	}
?>

<!-- JS -->
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery.watermark.min.js"></script>

<?php
	

if($currentPage=="index"){

	//echo('<script type="text/javascript" src="js/index.js"></script>' . "\n");
	
}
?>

<?php include_once 'include/analytics.php'; ?>

</head>
<body onload="">
