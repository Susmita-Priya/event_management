<?php
session_start();
error_reporting(0);
include(__DIR__ . '/config/db.php');
function check_login()
{
	if(strlen($_SESSION['odmsaid'])==0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="login.php";		
		$_SESSION["id"]="";
		header("Location: http://$host$uri/$extra");
	}
}
?>