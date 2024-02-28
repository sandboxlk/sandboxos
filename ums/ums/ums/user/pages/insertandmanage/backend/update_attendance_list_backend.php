<?php
include '../../../../connection.php';
include '../../../../check.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$CompanyName_=$_POST['CompanyName'];
		$batch_=$_POST['batch'];
		$module_=$_POST['module']; 
		$PersonalityTest_=$_POST['PersonalityTest'];
		$A180_=$_POST['180'];
		$A360_=$_POST['360'];
		$KnowledgeAssessment_=$_POST['KnowledgeAssessment'];
		$CulturePulse_=$_POST['CulturePulse'];
		$CompitencyGap_=$_POST['CompitencyGap'];

		$sql_check_projects = "SELECT COUNT(*) AS count FROM `update_attendance` WHERE `CompanyName` = '$CompanyName_'";
		$result_check_projects = mysqli_query($conn, $sql_check_projects);
		$row_check_projects = mysqli_fetch_assoc($result_check_projects);
		if ($row_check_projects['count'] > 0) {
				echo json_encode(array("statusCode" => 400, "message" => "Company already exists."));
				return;
		}else{
				if (strlen($coursename_)>0){ 
					$sql = "INSERT INTO `update_attendance`(`CompanyName`,`batch`,`module`,`PersonalityTest`,`180`,`360`,`KnowledgeAssessment`,`CulturePulse`,`CompitencyGap`) 
					VALUES ('$CompanyName_','$batch_','$module_','$PersonalityTest_','$A180_','$A360_','$KnowledgeAssessment_','$CulturePulse_','$CompitencyGap_')";
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
		$id_=$_POST['id'];
		$CompanyName_=$_POST['CompanyName'];
		$batch_=$_POST['batch'];
		$module_=$_POST['module']; 
		$PersonalityTest_=$_POST['PersonalityTest'];
		$A180_=$_POST['180'];
		$A360_=$_POST['360'];
		$KnowledgeAssessment_=$_POST['KnowledgeAssessment'];
		$CulturePulse_=$_POST['CulturePulse'];
		$CompitencyGap_=$_POST['CompitencyGap'];
		


		$sql = "UPDATE `update_attendance` SET `CompanyName`='$CompanyName_',`batch`='$batch_',`module`='$module_',`PersonalityTest`='$PersonalityTest_',`180`='$A180',`360`='$A360',`KnowledgeAssessment`='$KnowledgeAssessment_',`CulturePulse`='$CulturePulse_',`CompitencyGap`='$CompitencyGap_' WHERE `ID`='$id_'";
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
		$id=$_POST['id'];
		$sql = "DELETE FROM `update_attendance` WHERE ID=$id";
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
		$sql = "DELETE FROM update_attendance WHERE ID in ($id)";
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