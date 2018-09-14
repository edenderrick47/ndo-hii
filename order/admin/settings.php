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



$commonFilePath="../common/";

includeFile($commonFilePath."config/config.php");

if(!defined('MYSQL_DB_HOST') || !defined('MYSQL_DB_NAME') || !defined('MYSQL_DB_USERNAME') || !defined('MYSQL_DB_PASSWORD'))
{
header("location: ../installation/");
}
if (phpversion() > '5.0') {
includeFile($commonFilePath."lib/class.mysqli.php");
}
else
{
includeFile($commonFilePath."lib/class.mysql.php");
}

includeFile($commonFilePath."lib/function.php");

includeFile("lib/admin.php");

includeFile("lib/class.functions.php");



includeFile("lib/class.category.php");

includeFile("lib/class.product.php");

includeFile("lib/class.options.php");

includeFile("lib/class.coupons.php");

includeFile("lib/class.currency.php");

includeFile("lib/class.template.php");



$adminObj=new admin();

$obj= new Functions();

$catObj=new category();

$prodObj=new product();

$optObj=new options();

$couponObj=new coupons();

$curObj=new currency();

$tempObj=new template();



$isLogged = $adminObj->isLogged();

if($isLogged==false && curPageName() != 'login.php')
{
header("location:login.php");
}

/*if( (curPageName() == 'login.php') && ($isLogged === true) ){

	header("location:index.php");

}

if( (curPageName() == 'index.php') && ($isLogged === false) ){

	header("location:login.php");

}
*/
$siteLink= "../admin";

?>