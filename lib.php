<?php

/*header("Content-Type: text/html; charset=utf-8");
ini_set  ( "mbstring.internal_encoding","utf-8");
/*iconv_set_encoding("internal_encoding", "utf-8");
iconv_set_encoding("output_encoding", "utf-8");
iconv_set_encoding("input_encoding", "utf-8");*/

error_reporting(E_ALL);
ini_set('display_errors', '1');

$configfiles=array(
"config.php",
"contacts.php"
);

foreach ($configfiles as $config){
	require_once($config);
}

if (Config::$showErrors){
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
} else {
	error_reporting(E_NONE);
	ini_set('display_errors', '0');
}

$libdir="lib/";
$libfiles=array(
"base.php",
"classPerson.php",
"classSMS.php"
);
foreach ($libfiles as $lib){
	require_once($libdir.$lib);
}


