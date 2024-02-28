<?php
include '../../../../connection.php';
include '../../../../check.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$StudentName_=$_POST['StudentName'];
		$company_=$_POST['company'];
		$batch_=$_POST['batch'];
		$AssessmentType_=$_POST['AssessmentType'];
		$ConsultantReview_=$_POST['ConsultantReview'];
		$SupervisorReview_=$_POST['SupervisorReview'];

		$sql_check_projects = "SELECT COUNT(*) AS count FROM `consultant_review` WHERE `StudentName` = '$coursename_'";
		$result_check_projects = mysqli_query($conn, $sql_check_projects);
		$row_check_projects = mysqli_fetch_assoc($result_check_projects);
		if ($row_check_projects['count'] > 0) {
				echo json_encode(array("statusCode" => 400, "message" => "Course already exists."));
				return;
		}else{
				if (strlen($coursename_)>0){ 
					$sql = "INSERT INTO `consultant_review`(`CourseName`,`duration`,`lecturer`) 
					VALUES ('$coursename_','$dur_','$lec_')";
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
		$cid_=$_POST['clientid'];
		$coursename_=$_POST['coursename_u'];
		$dur_=$_POST['courseduration'];
		$lec_=$_POST['lecturername'];


		$sql = "UPDATE `consultant_review` SET `CourseName`='$coursename_',`duration`='$dur_',`lecturer`='$lec_' WHERE `ID`='$id_'";
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
		$sql = "DELETE FROM `consultant_review` WHERE ID=$id";
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
		$sql = "DELETE FROM consultant_review WHERE ID in ($id)";
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