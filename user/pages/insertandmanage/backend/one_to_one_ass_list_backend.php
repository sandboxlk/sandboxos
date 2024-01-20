<?php
include '../../../../connection.php';
include '../../../../check.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$AssessmentCompany_=$_POST['company']; 
		$AssessmentBatch_=$_POST['batch'];
		$AssessmentStudentname_=$_POST['studentname'];
		$AssessmentComments_=$_POST['comments'];
		$AssessmentYesno_=$_POST['yes/no'];
		$AssessmentDate_=$_POST['date'];
		
		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `one_to_one_assessment` WHERE `company` = '$AssessmentCompany_'";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Company already exists."));
			return;
		}
		if (strlen($client_name_)>0){ 
	
				$sql = "INSERT INTO `one_to_one_assessment`( `company`, `batch`,`studentname`,`comments`,`yes/no`,`date`) 
				VALUES ('$AssessmentCompany_','$AssessmentBatch_','$AssessmentStudentname_','$AssessmentComments_','$AssessmentYesno_','$AssessmentDate_')";
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
		$StudentID=$_POST['id_u'];
		$company_u=$_POST['company_u'];
		$batch_u=$_POST['batch_u'];
		$StudentName_u=$_POST['StudentName_u'];
		$comments_u=$_POST['comments_u'];
		$yesno_u=$_POST['yes/no_u'];
		$date_u=$_POST['date_u'];
		
	
		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `one_to_one_assessment` WHERE `company_u` = '$company_u' AND `id_u` NOT IN($StudentID)";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Assessment already exists."));
			return;
		}else{
			if (strlen($name)>0){ 
				
					$sql = "UPDATE `one_to_one_assessment` SET `company_u`='$company_u',`batch_u`='$batch_u',`StudentName_u`='$StudentName_u',`comments_u`='$comments_u',`yes/no_u`='$yesno_u',`date_u`='$date_u' WHERE id_u=$StudentID";
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
		$StudentID=$_POST['id_u'];
		$sql = "DELETE FROM `one_to_one_assessment` WHERE id_u=$StudentID ";
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
		$StudentID=$_POST['id_u'];
		$sql = "DELETE FROM one_to_one_assessment WHERE id_u in ($StudentID)";
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