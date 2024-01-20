<?php
include '../../../../connection.php';
include '../../../../check.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$StudentName_=$_POST['name'];
		$email_=$_POST['email'];
		$company_=$_POST['company'];
		$course_=$_POST['course'];
		$PrimaryField_=$_POST['PrimaryField'];
		$calculatedField_=$_POST['calculatedField'];

		$sql_check_projects = "SELECT COUNT(*) AS count FROM `mannual registration` WHERE `StudentName` = '$StudentName_'";
		$result_check_projects = mysqli_query($conn, $sql_check_projects);
		$row_check_projects = mysqli_fetch_assoc($result_check_projects);
		if ($row_check_projects['count'] > 0) {
				echo json_encode(array("statusCode" => 400, "message" => "Student name already exists."));
				return;
		}else{
				if (strlen($StudentName_)>0){ 
					$sql = "INSERT INTO `mannual registration`(`StudentName`,`email`,`company`,`course`,`PrimaryField`,`calculatedField`) 
					VALUES ('$StudentName_','$email_','$company_','$course_','$PrimaryField_','$calculatedField_')";
					if (mysqli_query($conn, $sql)) {
						echo json_encode(array("statusCode"=>200));
					} 
					else {
						echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
						return;
					}
					mysqli_close($conn);
				}else{
					echo json_encode(array("statusCode" => 400, "message" => "Course Name is required."));
					return;
				}
		}
		
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
		$RegistrationID_=$_POST['RegistrationID'];
		$StudentName_=$_POST['StudentName'];
		$email_=$_POST['email'];
		$company_=$_POST['company'];
		$course_=$_POST['course'];
		$PrimaryField_=$_POST['PrimaryField'];
		$calculatedField_=$_POST['calculatedField'];


		$sql = "UPDATE `mannual registration` SET `StudentName`='$StudentName_',`email`='$email_',`company`='$company_',`course`='$course_',`PrimaryField`='$PrimaryField_',`calculatedField`='$calculatedField_', WHERE `RegistrationID`='$RegistrationID_'";
		if (mysqli_query($conn, $sql)) {
		    echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
			return;
		}
		mysqli_close($conn);		
		
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$RegistrationID_=$_POST['RegistrationID'];
		$sql = "DELETE FROM `mannual registration` WHERE RegistrationID=$RegistrationID_";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
			return;
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM mannual registration WHERE RegistrationID in ($RegistrationID_)";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
			return;
		}
		mysqli_close($conn);
	}
}

?>