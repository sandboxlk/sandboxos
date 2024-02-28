<?php
include '../../../../connection.php';
include '../../../../check.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$AssessmentName_=$_POST['AssessmentName'];
		$AssessmentType_=$_POST['AssessmentType'];
	

		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `assessment` WHERE `AssessmentName` = '$AssessmentName_'";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Assessment already exists."));
			return;
		}
		if (strlen($client_name_)>0){ 
	
				$sql = "INSERT INTO `assessment`( `clientName`, `AssessmentType`) 
				VALUES ('$$AssessmentName_','$AssessmentType_')";
				if (mysqli_query($conn, $sql)) {
					echo json_encode(array("statusCode"=>200));
				} 
				else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			
			mysqli_close($conn);
		}else{
			echo json_encode(array("statusCode" => 400, "message" => "Assessment name is required"));
			return;
		}
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
		$AssessmentID=$_POST['AssessmentID'];
		$AssessmentName=$_POST['AssessmentName'];
		$AssessmentType=$_POST['AssessmentType'];
		
	
		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `assessment` WHERE `AssessmentName` = '$AssessmentName' AND `AssessmentID` NOT IN($AssessmentID)";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Assessment already exists."));
			return;
		}else{
			if (strlen($name)>0){ 
				
					$sql = "UPDATE `assessment` SET `AssessmentName`='$AssessmentName',`AssessmentType`='$AssessmentType' WHERE AssessmentID=$AssessmentID";
					if (mysqli_query($conn, $sql)) {
						echo json_encode(array("statusCode" =>200));
					} 
					else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
					mysqli_close($conn);
				
			}else{
				echo json_encode(array("statusCode" => 400, "message" => "Assessment name is required"));
				return;
			}
		}
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$AssessmentID=$_POST['AssessmentID'];
		$sql = "DELETE FROM `assessment` WHERE AssessmentID=$AssessmentID ";
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
		$AssessmentID=$_POST['AssessmentID'];
		$sql = "DELETE FROM assessment WHERE AssessmentID in ($AssessmentID)";
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