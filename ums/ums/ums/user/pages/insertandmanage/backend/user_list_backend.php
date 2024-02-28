<?php
include '../../../../connection.php';
include '../../../../check.php';

if(count($_POST)>0){
	if ($_POST['type'] == 1) {
		$emp_id_ = $_POST['emp'];
		$firstname_ = $_POST['firstname'];
		$lastname_ = $_POST['lastname'];
		$phone1_ = $_POST['phone1'];
		$phone2_ = $_POST['phone2'];
		$gender_ = $_POST['gender'];
		$address_ = $_POST['address'];
		$desingnation_ = $_POST['desingnation'];
		$acountLevel_ = $_POST['acountLevel'];
		$uname_ = $_POST['username'];
		$pass_ = 12345678;//Default Password
		$email_ = $_POST['email'];
		$company_ID = 1;
		$division_ID = 1;
	
		// Validate EmpNo
		if (!is_numeric($emp_id_)) {
			echo json_encode(array("statusCode" => 400, "message" => "User ID should be a numeric value."));
			return;
		}
	
		// Validate if EmpNo already exists
		$sql_check_empno = "SELECT COUNT(*) AS count FROM `sys_users` WHERE `UserID` = '$emp_id_'";
		$result_check_empno = mysqli_query($conn, $sql_check_empno);
		$row_check_empno = mysqli_fetch_assoc($result_check_empno);
		if ($row_check_empno['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "User ID already exists."));
			return;
		}
	
		// Validate First Name
		if (strlen($firstname_) > 25 || !preg_match('/^[a-zA-Z ]+$/', $firstname_)) {
			echo json_encode(array("statusCode" => 400, "message" => "First name should be maximum 25 characters and contain only letters and spaces."));
			return;
		}
	
		// Validate Last Name
		if (strlen($lastname_) > 25 || !preg_match('/^[a-zA-Z ]+$/', $lastname_)) {
			echo json_encode(array("statusCode" => 400, "message" => "Last name should be maximum 25 characters and contain only letters and spaces."));
			return;
		}
	
		// Validate Phone 1
		if (!empty($phone2_) && !is_numeric($phone1_)) {
			echo json_encode(array("statusCode" => 400, "message" => "Phone 1 should be a numeric value."));
			return;
		}
	
		// Validate Phone 2
		if (!empty($phone2_) && !is_numeric($phone2_)) {
			echo json_encode(array("statusCode" => 400, "message" => "Phone 2 should be a numeric value."));
			return;
		}
	
		// Validate Phone numbers length
		if (strlen($phone1_) !== 10 || (strlen($phone2_) > 0 && strlen($phone2_) !== 10)) {
			echo json_encode(array("statusCode" => 400, "message" => "Phone numbers should be 10 digits."));
			return;
		}
	
		// Validate Address
		if (strlen($address_) > 50) {
			echo json_encode(array("statusCode" => 400, "message" => "Address should be maximum 50 characters."));
			return;
		}
	
		// Validate Designation
		if (strlen($desingnation_) > 25) {
			echo json_encode(array("statusCode" => 400, "message" => "Designation should be maximum 25 characters."));
			return;
		}
	
		// Validate Username
		if (empty($uname_) || strlen($uname_) > 10) {
			echo json_encode(array("statusCode" => 400, "message" => "Username should not be blank and should be maximum 10 characters."));
			return;
		}
	
		// Validate Password
		if (empty($pass_) || (strlen($pass_) < 8)) {
			echo json_encode(array("statusCode" => 400, "message" => "Password should not be blank and should be minimum 8 characters.". strlen($pass_)));
			return;
		}
	
		$pass_ = md5($pass_);
		$sql_user = "INSERT INTO `sys_users` (`UserID`, `FirstName`, `LastName`, `Gender`, `Designation`, `Phone1`, `Phone2`, `Address`, `Email`, `Username`, `Password`, `AccountLevel`) 
			VALUES ('$emp_id_', '$firstname_', '$lastname_','$gender_', '$desingnation_', '$phone1_', '$phone2_', '$address_', '$email_', '$uname_', '$pass_', '$acountLevel_')";
	
		if (mysqli_query($conn, $sql_user)) {
			echo json_encode(array("statusCode" => 200));
		} else {
			echo "Error: " . $sql_user . "<br>" . mysqli_error($conn);
		}
	}
	
}
if(count($_POST)>0){
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type']) && $_POST['type'] === 'geninfoupdate') {
			$first_name_ = $_POST['first_name'];
			$last_name_ = $_POST['last_name'];
			$gender_ = $_POST['gender'];
			$dob_ = $_POST['dob'];
			$address_ = $_POST['address'];
			$email_ = $_POST['email'];
			$phone1_ = $_POST['phone1'];
			$phone2_ = $_POST['phone2'];

			// Validation
			$errors = array();


			// Validate first name and last name (mandatory fields)
			if (empty($first_name_)) {
				$errors[] = "First name is required.";
			}
			if (empty($last_name_)) {
				$errors[] = "Last name is required.";
			}

			// Validate phone numbers (10 digits)
			if (!empty($phone1_) && !preg_match("/^\d{10}$/", $phone1_)) {
				$errors[] = "Invalid phone number (Phone 1).";
			}
			if (!empty($phone2_) && !preg_match("/^\d{10}$/", $phone2_)) {
				$errors[] = "Invalid phone number (Phone 2).";
			}
		
			// Validate address (maximum 150 characters)
			if (strlen($address_) > 50) {
				$errors[] = "Address should not exceed 150 characters.";
			}
		
			// Validate email address
			if(strlen($email_)>0){
				if (!filter_var($email_, FILTER_VALIDATE_EMAIL)) {
					$errors[] = "Invalid email address.";
				}
			}

			// Check if there are any validation errors
			if (!empty($errors)) {
				foreach ($errors as $error) {
					echo json_encode(array("statusCode" => 400, "message" =>  $error));
					return;
				}
				
			} else {
				$sql = "UPDATE `sys_users` SET `FirstName`='$first_name_', `LastName`='$last_name_', `Gender`='$gender_', `DOB`='$dob_', `Address`='$address_', `Email`='$email_', `Phone1`='$phone1_', `Phone2`='$phone2_' WHERE UserID =$user_id";
				if (mysqli_query($conn, $sql)) {
					echo json_encode(array("statusCode"=>200));
					session_destroy();
				} 
				else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
				mysqli_close($conn);
			}
	}
}

if(count($_POST)>0){
	//Update Users details from admin page
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type']) && $_POST['type'] === 'update_genaralinfo_type') {
		$empid_ = $_POST['empid'];
		$first_name_ = $_POST['first_name'];
		$last_name_ = $_POST['last_name'];
		$dob_ = $_POST['dob'];
		$desg_ = $_POST['desg'];
		$al_ = $_POST['al'];
		$curr_pass_e = $_POST['curr_pass_e'];
	
		// Validation
		$errors = array();
	
		// Validate first name and last name (mandatory fields)
		if (empty($first_name_)) {
			$errors[] = "First name is required.";
		}

		if (empty($last_name_)) {
			$errors[] = "Last name is required.";
		}
	
		// Validate current password (minimum characters of 8)
		if (strlen($curr_pass_e) < 8) {
			$errors[] = "Current password should be at least 8 characters.";
		}
	
		// Validate date of birth (age above 18)
		if (isset($dob_) && !empty($dob_)) {
			$minAge = 18; // Minimum age required
			$currentDate = new DateTime();
			$dateOfBirth = DateTime::createFromFormat('Y-m-d', $dob_);
			$age = $currentDate->diff($dateOfBirth)->y;

			if ($age < $minAge) {
				$errors[] = "Age must be above 18.";
			}
		}

	
		// Validate designation (maximum characters of 25)
		if (strlen($desg_) > 25) {
			$errors[] = "Designation should not exceed 25 characters.";
		}
	
		// Validate al_ (should be 1, 2, or 3)
		if (!in_array($al_, array(1, 2, 3))) {
			$errors[] = "Invalid value for Account Level.";
		}
	
		// Check if there are any validation errors
		if (!empty($errors)) {
			echo json_encode(array("statusCode" => 400, "message" => implode(" ", $errors)));
		} else {
			
	
			if($curr_pass_e=="12345678"){
				$curr_pass_e = md5($curr_pass_e);
				$sql = "UPDATE `sys_users` SET `Password`='$curr_pass_e',`FirstName`='$first_name_', `LastName`='$last_name_', `DOB`='$dob_', `AccountLevel`='$al_',`Designation`='$desg_' WHERE UserID =$empid_";
			}else{
				$sql = "UPDATE `sys_users` SET `FirstName`='$first_name_', `LastName`='$last_name_', `DOB`='$dob_', `AccountLevel`='$al_',`Designation`='$desg_' WHERE UserID =$empid_";
			}
			
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200));
			
			} 
			
			mysqli_close($conn);
		}
	}

}

if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$status=$_POST['status_req'];
		$sql = "UPDATE `sys_users` SET  `Status`='$status' WHERE UserID=$id";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
?>