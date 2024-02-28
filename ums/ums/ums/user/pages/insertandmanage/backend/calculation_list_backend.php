<?php
include '../../../../connection.php';
include '../../../../check.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$company_=$_POST['company'];
		$batch_=$_POST['batch'];
		$course_=$_POST['course'];
		$attendance_=$_POST['attendance(%)']; 
		$ModuleViseScores_=$_POST['ModuleViseScores'];
		$CourseScores_=$_POST['CourseScores'];
		$CourseRanking_=$_POST['CourseRanking'];
		$BatchRanking_=$_POST['BatchRanking'];
		

		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `calculations` WHERE `company` = '$company_'";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Company already exists."));
			return;
		}
		if (strlen($client_name_)>0){ 
	
				$sql = "INSERT INTO `calculations`( `company`, `batch`,`course`,`attendance(%)`,`ModuleViseScores`,`CourseScores`,`CourseRanking`,`BatchRanking`) 
				VALUES ('$company_','$batch_','$course_','$attendance_','$ModuleViseScores_','$CourseScores_','$CourseRanking_','$BatchRanking_')";
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
		$CalculationID=$_POST['CalculationID'];
		$company_=$_POST['company'];
		$batch_=$_POST['batch'];
		$course_=$_POST['course'];
		$attendance_=$_POST['attendance(%)']; 
		$ModuleViseScores_=$_POST['ModuleViseScores'];
		$CourseScores_=$_POST['CourseScores'];
		$CourseRanking_=$_POST['CourseRanking'];
		$BatchRanking_=$_POST['BatchRanking'];
		
		
	
		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `calculations` WHERE `company` = '$company_' AND `CalculationID` NOT IN($CalculationID)";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Company already exists."));
			return;
		}else{
			if (strlen($name)>0){ 
				
					$sql = "UPDATE `calculations` SET `company`='$company_',`batch`='$batch_',`course`='$course_',`attendance(%)`='$attendance_',`ModuleViseScores`='$ModuleViseScores_',`CourseScores`='$CourseScores_',`CourseRanking`='$CourseRanking_',`BatchRanking`='$BatchRanking_' WHERE CalculationID=$CalculationID";
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
		$CalculationID_=$_POST['CalculationID'];
		$sql = "DELETE FROM `calculations` WHERE CalculationID=$CalculationID ";
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
		$CalculationID_=$_POST['CalculationID'];
		$sql = "DELETE FROM calculations WHERE CalculationID in ($CalculationID)";
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