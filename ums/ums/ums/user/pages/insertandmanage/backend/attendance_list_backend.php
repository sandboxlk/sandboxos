<?php
include '../../../../connection.php';
include '../../../../check.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$company_name_=$_POST['company'];
		$batch_=$_POST['batch'];
		$course_=$_POST['course'];
		$date_=$_POST['Date']; 
		$attendance_=$_POST['Attendance'];
		

		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `attendance` WHERE `batch` = '$batch_'";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Batch already exists."));
			return;
		}
		if (strlen($client_name_)>0){ 
	
				$sql = "INSERT INTO `attendance`( `company`, `batch`,`course`,`Date`,`Attendance`) 
				VALUES ('$company_name_','$batch_','$course_','$date_','$attendance_')";
				if (mysqli_query($conn, $sql)) {
					echo json_encode(array("statusCode"=>200));
				} 
				else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			
			mysqli_close($conn);
		}else{
			echo json_encode(array("statusCode" => 400, "message" => "Company name is required"));
			return;
		}
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
		$RegistrationID_=$_POST['id_u'];
		$company_Name_=$_POST['name_u'];
		$batch_=$_POST['batch_u'];
		$course_=$_POST['course_u'];
		$date_=$_POST['date_u']; 
		$attendance_=$_POST['Attendance_u'];
		
	
		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `attendance` WHERE `name_u` = '$company_Name_' AND `id_u` NOT IN($RegistrationID_)";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Company already exists."));
			return;
		}else{
			if (strlen($name)>0){ 
				
				$sql = "UPDATE `attendance` SET `company`='$company_Name_', `batch`='$batch_', `course`='$course_', `date`='$date_', `MarkAttendance`='$attendance_' WHERE 'RegistrationID'=$RegistrationID_";

					if (mysqli_query($conn, $sql)) {
						echo json_encode(array("statusCode" =>200));
					} 
					else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
					mysqli_close($conn);
				
			}else{
				echo json_encode(array("statusCode" => 400, "message" => "Company name is required"));
				return;
			}
		}
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$RegistrationID_=$_POST['id_u'];
		$sql = "DELETE FROM `attendance` WHERE RegistrationID=$RegistrationID_";

		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$RegistrationID_=$_POST['RegistrationID'];
		$sql = "DELETE FROM attendance WHERE id_u in ($RegistrationID_)";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

?>