<?php

$crypt_key = "lsjeflmicjq&*@%&$*%=9=109240-8964643547m708.y89p,ym8uomt7m";


function decryptString ($string )
{
	GLOBAL $crypt_key;
	$s = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($crypt_key), base64_decode(strtr($string, '-_,', '+/=')), MCRYPT_MODE_CBC, md5(md5($crypt_key))), "\0");
	return $s;
}

function encryptString ($string )
{
	GLOBAL $crypt_key;
	$s = strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($crypt_key), $string, MCRYPT_MODE_CBC, md5(md5($crypt_key)))), '+/=', '-_,');
	return $s;
}


function decryptStringArray ($stringArray )
{
	GLOBAL $crypt_key;
	$s = unserialize(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($crypt_key), base64_decode(strtr($stringArray, '-_,', '+/=')), MCRYPT_MODE_CBC, md5(md5($crypt_key))), "\0"));
	return $s;
}

function encryptStringArray ($stringArray )
{
	GLOBAL $crypt_key;
	$s = strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($crypt_key), serialize($stringArray), MCRYPT_MODE_CBC, md5(md5($crypt_key)))), '+/=', '-_,');
	return $s;
}


?>