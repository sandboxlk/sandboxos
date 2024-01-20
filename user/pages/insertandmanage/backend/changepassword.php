<?php
include '../../../../connection.php';
include '../../../../check.php';

$ses_sql = mysqli_query($db,"SELECT UserID,Username,AccountLevel,Password FROM sys_users WHERE Username='$login_user'");
$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$Password_DB =$row['Password'];

if(count($_POST)>0){
	if($_POST['type']==2){
		$EMPNo=$user_id;
		$curesntpassfromuser_withouMD5 = $_POST['c_pass'];
		$current_password_fromuser = md5($curesntpassfromuser_withouMD5);
		$new_password_fromuser =$_POST['n_pass'];
		$re_enter_new_password_fromuser =$_POST['rn_pass'];

			if(strlen($curesntpassfromuser_withouMD5)>0 && strlen($new_password_fromuser)>0 && strlen($re_enter_new_password_fromuser)>0){
				if($Password_DB==$current_password_fromuser){
					if($new_password_fromuser==$re_enter_new_password_fromuser){	
						if (strlen($new_password_fromuser)>=8){
							$finalpassword = md5($new_password_fromuser);
							if($Password_DB!=$finalpassword){
									$sql = "UPDATE `sys_users` SET `Password`='$finalpassword' WHERE UserID=$user_id";
									if (mysqli_query($conn, $sql)) {
										echo json_encode(array("statusCode"=>200));
										session_destroy();
									} 
									else {
										echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
										return;
									}
									mysqli_close($conn);
							}else{
								echo json_encode(array("statusCode" => 400, "message" => "Current System password and New password cannot be same. Try different password.!"));
								return;
							}
						}else{
							echo json_encode(array("statusCode" => 400, "message" => "Password must be minimum 8 characters!"));
							return;
						}
					}else{
						echo json_encode(array("statusCode" => 400, "message" => "New password and re-entered password did not matched. Please try again.!"));
						return;
					}

				}else{
					echo json_encode(array("statusCode" => 400, "message" => "Current password did not matched. Please try again.!"));
					return;
				}
			}else{
				echo json_encode(array("statusCode" => 400, "message" => "Please fill all the fields.!"));
				return;
			}
	}
}

?>