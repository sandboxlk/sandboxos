<?php
include('connection.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
//session_start();
$user_check=$_SESSION['username'];

$ses_sql = mysqli_query($db,"SELECT UserID,Username,AccountLevel,profileImg FROM sys_users WHERE Username='$user_check'");

$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$user_id =$row['UserID'];
$login_user=$row['Username'];
$AccountLevel=$row['AccountLevel'];
$current_date=date("d/m/Y");
$current_time=time();
$profileImg=$row["profileImg"];

//Account Level
$ses_sql_acl = mysqli_query($db,"SELECT AccountLevelName FROM account_levels WHERE AccountLevelID='$AccountLevel'");
$row_acl=mysqli_fetch_array($ses_sql_acl,MYSQLI_ASSOC);
$AccountLevel_txt=$row_acl['AccountLevelName'];

?>