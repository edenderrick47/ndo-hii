<?php

ob_start();

session_start();
error_reporting(E_ALL ^ E_NOTICE);
function includeFile($filepath)

{

	if(!file_exists($filepath))

	{

		echo "Unable to locate the file path:".$filepath;

	}

	else

	{

		include($filepath);	

	}

}

$commonFilePath="common/";

includeFile($commonFilePath."config/config.php");

//if(!array_key_exists('MYSQL_DB_HOST', get_defined_vars()) || !array_key_exists('MYSQL_DB_NAME', get_defined_vars()) || !array_key_exists('MYSQL_DB_USERNAME', get_defined_vars()) || !array_key_exists('MYSQL_DB_PASSWORD', get_defined_vars()) )
if(!defined('MYSQL_DB_HOST') || !defined('MYSQL_DB_NAME') || !defined('MYSQL_DB_USERNAME') || !defined('MYSQL_DB_PASSWORD'))
{
header("location: installation/");
}
if (phpversion() > '5.0') {
includeFile($commonFilePath."lib/class.mysqli.php");
}
else
{
includeFile($commonFilePath."lib/class.mysql.php");
}

includeFile($commonFilePath."lib/function.php");

includeFile($commonFilePath."lib/class.front.php");

includeFile($commonFilePath."lib/class.phpmailer.php");



$obj=new front();

$admindata=$obj->getAdminData();

if(!empty($admindata)){

$adminEmail=$admindata[0]['email'];

$show_price=$admindata[0]['show_price'];

$is_paypal=$admindata[0]['is_paypal'];

$currencyId=$admindata[0]['idCurrency'];

$paypal_link=$admindata[0]['paypal_link'];

$bottom_content=$admindata[0]['page_bottom_content'];
}

$currencydata=$obj->getCurrencyById($currencyId);

if(!empty($currencydata)){

$currency=$currencysymbol=$currencydata[0]['currrency_symbol'];

$currencycode=$currencydata[0]['currency_code'];

$paypal_businessmail=$admindata[0]['paypal_business_mail'];
}
function siteurl()
{
	if(isset($_SERVER['HTTPS'])){
		$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	}
	else{
		$protocol = 'http';
	}
	return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
$siteLink= siteurl();

?>