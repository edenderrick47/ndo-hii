<?php ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>OrderNow - PHP Order form Installation Script</title>
<link href="style.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Arvo:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="logo-main"><img src="../img/logo-main.png" alt=""></div>
<?php
include("../common/config/config.php");
$flag=0;
if(defined('MYSQL_DB_HOST') || defined('MYSQL_DB_NAME') || defined('MYSQL_DB_USERNAME') || defined('MYSQL_DB_PASSWORD'))
{
// if database is connected go to site link
	if($_GET['step'] == '')
	{
		step_4();
	}
}
?>
<?php
$step = (isset($_GET['step']) && $_GET['step'] != '') ? $_GET['step'] : '';
switch($step){
  case '1':
  step_1();//Agree license
  break;
  case '2':
  step_2();//Version check
  break;
  case '3':
  step_3();//Create Database
  break;
  case '4':
  step_4();//Goto site
  break;
  default:
  step_1();
}
function step_1(){
 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agree'])){
  header('Location:index.php?step=2');
  exit;
 }
 else if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['agree'])){
  echo '<div class="error-msg"><span>You must agree to the license.</span></div>';
 }
?>
<div class="licence-agree"><h1>license agreement</h1>
 <p>By clicking the check box, you agree to the Terms & Conditions.</p>
 <form action="index.php?step=1" method="post">
 <p>
  <input type="checkbox" name="agree" />
  I agree to the license
 </p>
  <input type="submit" value="Continue" />
 </form>
</div>
<?php 
}
function step_2(){
  $pre_error ="";
  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] ==''){
   header('Location:index.php?step=3');
   exit;
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] != '')
   echo $_POST['pre_error'];
      
  if (phpversion() < '5.0') {
   $pre_error = 'You need to use PHP5 or above for our site!<br />';
  }
  if (ini_get('session.auto_start')) {
   $pre_error .= 'Our site will not work with session.auto_start enabled!<br />';
  }
  if (!extension_loaded('mysql')) {
   $pre_error .= 'MySQL extension needs to be loaded for our site to work!<br />';
  }
  if (!extension_loaded('gd')) {
   $pre_error .= 'GD extension needs to be loaded for our site to work!<br />';
  }
  if (!is_writable('../common/config/config.php')) {
   $pre_error .= 'config.php needs to be writable for our site to be installed!';
  }
  ?>
<div class="version-details">
  <table width="100%">
  <tr>
   <td>PHP Version:</td>
   <td><?php echo phpversion(); ?></td>
   <td><?php echo (phpversion() >= '5.0') ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  <tr>
   <td>Session Auto Start:</td>
   <td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
   <td><?php echo (!ini_get('session_auto_start')) ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  <tr>
   <td>MySQL:</td>
   <td><?php echo extension_loaded('mysql') ? 'On' : 'Off'; ?></td>
   <td><?php echo extension_loaded('mysql') ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  <tr>
   <td>GD:</td>
   <td><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></td>
   <td><?php echo extension_loaded('gd') ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  <tr>
   <td>config.php</td>
   <td><?php echo is_writable('../common/config/config.php') ? 'Writable' : 'Unwritable'; ?></td>
   <td><?php echo is_writable('../common/config/config.php') ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  </table>
  <form action="index.php?step=2" method="post">
   <input type="hidden" name="pre_error" id="pre_error" value="<?php echo $pre_error;?>" />
   <input type="submit" name="continue" value="Continue" />
  </form>
</div>
<?php
}
function step_3(){
   $sitename="";$database_host="";$database_name="";$table_prefix="";$database_username="";$database_password="";$username="";$admin_password="";$email="";
  if (isset($_POST['submit']) && $_POST['submit']=="Install!") {
   $sitename=isset($_POST['sitename'])?$_POST['sitename']:"";
   $email=isset($_POST['email'])?$_POST['email']:"";
   $database_host=isset($_POST['database_host'])?$_POST['database_host']:"";
   $database_name=isset($_POST['database_name'])?$_POST['database_name']:"";
   $table_prefix=isset($_POST['table_prefix'])?$_POST['table_prefix']:"";
   $database_username=isset($_POST['database_username'])?$_POST['database_username']:"";
   $database_password=isset($_POST['database_password'])?$_POST['database_password']:"";
   $username=isset($_POST['admin_name'])?$_POST['admin_name']:"";
   $admin_password=isset($_POST['admin_password'])?$_POST['admin_password']:"";
  
   define('PREFIX', $table_prefix);
  if (empty($username) || empty($admin_password) || empty($database_host) || empty($database_username) || empty($database_name)) {
   echo "<div class='error-msg'><span>All fields are required! Please re-enter.</span></div>";
  } 
  elseif(filter_var($email, FILTER_VALIDATE_EMAIL)==false)
  {
  echo "<div class='error-msg'><span>Enter a valid email ID.</span></div>";
  }
  else
  {
	  $connection = mysql_connect($database_host, $database_username, $database_password);
	  if($connection==false)
	  {
		echo "<div class='error-msg'>Could not connect to database. Check your username and password then try again.\n</div>";
	  }
	  else
	  {
		if(!mysql_select_db($database_name, $connection))
		{
		echo "<div class='error-msg'>Could not select database.\n</div>";
		}
		$f=fopen("../common/config/config.php","w");
		$database_inf=
		"<?php
		 define('MYSQL_DB_HOST', '".$database_host."');
		 define('MYSQL_DB_NAME', '".$database_name."');
		 define('MYSQL_DB_USERNAME', '".$database_username."');
		 define('MYSQL_DB_PASSWORD', '".$database_password."');
		 define('TABLE_PREFIX', '".$table_prefix."');
		 define('SITE_LINK', '');
		 ?>";
		if (fwrite($f,$database_inf)>0)
		{
		fclose($f);
		} 
		// include("../settings.php");
		include("tables.php");
		if(!empty($tableArray))
		{
		   for ($t = 0; $t < count($tableArray); $t++) 
		   {
				if(!empty($tableArray[$t]['table_create']))
				{
				 mysql_query($tableArray[$t]['table_create'], $connection);
				}
				if(!empty($tableArray[$t]['table_insert']))
				{
				 mysql_query($tableArray[$t]['table_insert'], $connection);
				}
		  }			
				mysql_query($query1, $connection);
				mysql_query($query2, $connection);
				mysql_query($query3, $connection);
				
				mysql_query("UPDATE `".PREFIX."administrator` SET Name='".$sitename."',email='".$email."',username='".$username."',password='".$admin_password."',order_mail_to='".$email."' ", $connection);
				mysql_close($connection);
		
		}
		header("Location:index.php?step=4");		
	  }
   }
}
?>
<div class="db-details">
<h1>Database Connection</h1>
  <form method="post" action="index.php?step=3">
  <p>
   <label for="database_name">Site Name</label>
   <input type="text" name="sitename" size="30" value="<?php echo $sitename; ?>">
 </p>
 <p>
   <label for="database_name">Database Name</label>
   <input type="text" name="database_name" size="30" value="<?php echo $database_name; ?>">
 </p>
  <p>
   <label for="database_name">Table Prefix</label>
   <input type="text" name="table_prefix" size="30" value="<?php echo $table_prefix; ?>_">
 </p>
  <p>
   <label for="database_host">Database Host</label>
   <input type="text" name="database_host" value='localhost' size="30">
 </p>
 <p>
   <label for="database_username">Database Username</label>
   <input type="text" name="database_username" size="30" value="<?php echo $database_username; ?>">
 </p>
 <p>
   <label for="database_password">Database Password</label>
   <input type="text" name="database_password" size="30" value="<?php echo $database_password; ?>">
  </p>
  <h3>Admin Details</h3>
  <p>
   <label for="username">Admin Username</label>
   <input type="text" name="admin_name" size="30" value="<?php echo $username; ?>">
 </p>
 <p>
   <label for="password">Admin Password</label>
   <input name="admin_password" type="password" size="30" maxlength="15" value="<?php echo $admin_password; ?>">
  </p>
   <p>
   <label for="database_name">Email</label>
   <input type="text" name="email" size="30" value="<?php echo $email; ?>">
 </p>
 <p>
 	<label>&nbsp;</label>
   <input type="submit" name="submit" value="Install!">
  </p>
  </form>
</div>
<?php
}
function step_4(){
	?>
 <p align="center"><a href="../">Site home page</a></p>
 <p align="center"><a href="../admin">Admin page</a></p>
<?php
}
?>
<div class="copy-right">&copy; 2016 OrderNow Responsive Order Form.</div>
</body>
</html>
<?php
ob_end_flush();?>