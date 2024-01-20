<?php
include('connection.php');

$user_check=$_SESSION['username'];

$ses_sql = mysqli_query($db,"SELECT UserID,Username,FirstName,LastName,AccountLevel FROM sys_users WHERE Username='$user_check'");

$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$user_id =$row['UserID'];
$firstname_user =$row['FirstName'];
$lastname_user =$row['LastName'];
$login_user=$row['Username'];
$AccountLevel=$row['AccountLevel'];
$current_date=date("d/m/Y");
$current_time=time();

if(!isset($user_check))
{
header("Location: ../index.php");
}
?>