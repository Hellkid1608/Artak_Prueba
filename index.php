<?php
  session_start();
  include ("class/display.php");
  include ("class/settings.php");
  include ("class/db_functions.php");
	include ("class/security_functions.php");
  $dbf     = new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database);
	//$security = new security($dbf, "Admin");
	/*if(!$security -> isLoggedIn($dbf))
  {
		header("Location: ./login.php");
		exit();
	}*/
$Display = new Display ($dbf -> conn/*, $security*/);

  echo $Display -> Index_Page();
 ?>
