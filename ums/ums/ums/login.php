<?php
	session_start();
	include("connection.php");
	include("user/validations.php");
	$error = ""; //Variable for storing our errors.
	if(isset($_POST["submit"]))
	{
		if(empty($_POST["usr_username"]) || empty($_POST["usr_password"]))
		{
			$error = "Both fields are required.";
		}else
		{
			// Define $username and $password
			$username=$_POST['usr_username'];
			$password=$_POST['usr_password'];
			// Here, you should perform additional validation and sanitization of the input
			$username = filter_var($username, FILTER_SANITIZE_STRING);
			$password = filter_var($password, FILTER_SANITIZE_STRING);

			// To protect from MySQL injection
			$usernameError = validateUsername($username);
			$passwordError = validatePassword($password);
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysqli_real_escape_string($db, $username);
			$password = mysqli_real_escape_string($db, $password);
			$password = md5($password);
			
			//Check username and password from database
			$sql="SELECT UserID,FirstName,LastName,Status FROM sys_users WHERE Username='$username' and Password='$password'";
			$result=mysqli_query($db,$sql);
			
			if($usernameError==null){ 
				if($passwordError==null){
					if (mysqli_num_rows($result) == 1) {
						$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
						$Status_ = $row["Status"];
						if($Status_=="active"){
							$UserFullName = $row["FullName"];
							$UserID = $row["UserID"];
							$accLevel = $row["AccountLevel"];
							$_SESSION['username'] = $username; // Initializing Session
							$_SESSION['empno'] = $UserID;
							header("location: user/index.php"); // Redirecting To Other Page
						} else {
							$error = "Sorry. Your account is disabled. Please contact your Head of Department";
						}	

						
					}else
					{
						$error = "Incorrect username or password.";
					}
				}else{
					$error = $passwordError;
				}
			}else{
				$error = $usernameError;
			}

		}
	}

?>