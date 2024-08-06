<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$head_hostname = "localhost:3306";
$head_user = "root";//change
$head_password = "";//change
$head_database = "usermanagementsystem";//change

$dbConnection= $db = $conn = $con = mysqli_connect($head_hostname,$head_user,$head_password,$head_database);   //create connection

$con->set_charset("utf8");
if(mysqli_connect_errno())
{
 echo "Failed to connect to database".mysqli_connect_error();
}

//timesheet
$resultsPerPage=100;
?>
