<?php
error_reporting(E_ALL);
define("ROOT", $_SERVER['DOCUMENT_ROOT']."/juzzsports/");
define("SERVER_ROOT", $_SERVER['SERVER_ADDR']."/juzzsports/");

if(!defined('ROOT'))
    define("ROOT", $_SERVER['DOCUMENT_ROOT']."/juzzsports/");



if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
    $protocol = 'http://';
} else {
    $protocol = 'https://';
}
//$protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF'])
define('BASE_URL',$protocol . $_SERVER['SERVER_NAME']."/juzzsports/") ;


function pr($arr)
{
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

 define("IMAGE_MISSING","missing.png");
 date_default_timezone_set('Etc/UTC');
 define("CART_CHECKOUT_SUBJECT","Juzzsports Cart Order %d");


define('CART_CHECKOUT_BODY',"You have Process your order for Products %s");

?>