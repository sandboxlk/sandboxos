<?php
include '../../../../connection.php';
include '../../../../check.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$coursecode_=$_POST['coursecode'];
		$coursename_=$_POST['coursename'];
		$coursetype_=$_POST['coursetype'];
		$moduleNo_=$_POST['moduleNo'];
		$duration_=$_POST['duration'];
		$durdays_=$_POST['durdays'];
		$halfmoduleNo_=$_POST['moduleNoH'];
		$durationh_=$_POST['durationh'];
		$durdaysh_=$_POST['durdaysh'];
		$twohmodule_=$_POST['moduleNo2'];
		$duration2_=$_POST['duration2'];
		$durdays2_=$_POST['durdays2'];
 
		$sql_check_projects = "SELECT COUNT(*) AS count FROM `courses` WHERE `courseCode` = '$coursecode_'";
		$result_check_projects = mysqli_query($conn, $sql_check_projects);
		$row_check_projects = mysqli_fetch_assoc($result_check_projects);
		if ($row_check_projects['count'] > 0) {
				echo json_encode(array("statusCode" => 400, "message" => "Course already exists."));
				return;
		}
				if (strlen($coursecode_)>0){ 

					$sql = "INSERT INTO `courses`(`courseCode`,`CourseName`,`fmoduleNo`,`courseType`,`fduration(h)`,`fduration(days)`,`hModuleNo`,`hDuration(h)`,`hDuration(days)`,`tModuleNo`,`tDuration(h)`,`tDuration(days)`) 
					VALUES ('$coursecode_','$coursename_','$coursetype_','$moduleNo_','$duration_','$durdays_','$halfmoduleNo_','$durationh_','$durdaysh_','$twohmodule_','$duration2_','$durdays2_')";
					if (mysqli_query($conn, $sql)) { 
						echo json_encode(array("statusCode"=>200));
					} 
					else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
						return;
					}

					mysqli_close($conn);
				}else{
					echo json_encode(array("statusCode" => 400, "message" => "Course code Name is required."));
					
					return;
				}
		}
		
	}

if(count($_POST)>0){
	if($_POST['type']==2){
		$cid_=$_POST['course_id_u'];
		$coursecode_=$_POST['coursecode_u'];
		$coursename_=$_POST['coursename_u'];
		$modno_=$_POST['moduleno_u'];
		$mod_=$_POST['modulename_u'];
		$dur_=$_POST['courseduration_u'];
		$durdays_=$_POST['durationdays_u'];


		$sql = "UPDATE `courses` SET `coursecode_u`='$coursecode_',`coursename_u`='$coursename_',`moduleno_u`='$modno_',`modulename_u`='$mod_',`courseduration_u`='$dur_',`durationdays_u`='$durdays_' WHERE `course_id_u`='$cid_'";
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
		$cid_=$_POST['course_id_u'];
		$sql = "DELETE FROM `courses` WHERE course_id_u=$cid_";
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
		$cid_=$_POST['course_id_u'];
		$sql = "DELETE FROM courses WHERE course_id_u in ($cid_)";
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