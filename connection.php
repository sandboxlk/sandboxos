<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

error_reporting(E_ALL ^ E_DEPRECATED);
$head_hostname = "usermanagementsystem.cvayquw8s8jm.us-east-1.rds.amazonaws.com";
$head_user = "admin";//change
$head_password = "Sandbox2024";//change
$head_database = "ums";//change

$dbConnection= $db = $conn = $con = mysqli_connect($head_hostname,$head_user,$head_password,$head_database);   //create connection

$con->set_charset("utf8");
if(mysqli_connect_errno())
{
 echo "Failed to connect to database".mysqli_connect_error();
}

//timesheet
$resultsPerPage=10;
?>
