<?php
include '../../../../connection.php';
include '../../../../check.php';

if (count($_POST) > 0) {
    if ($_POST['type'] == 1) {
        $CompanyName_ = $_POST['company'];
        $course_ = $_POST['course'];
        $year_ = $_POST['year'];
        $batch_ = $_POST['batch'];
        $budget_ = $_POST['budget']; 
        $StartDate_ = $_POST['StartDate'];
        $EndDate_ = $_POST['EndDate'];

        // Validate if Client already exists 
        //$sql_check_create_batches = "SELECT COUNT(*) AS count FROM `create_batches` WHERE `client` = '$CompanyName_'";
        //$result_check_create_batches = mysqli_query($conn, $sql_check_create_batches);
        //$row_check_create_batches = mysqli_fetch_assoc($result_check_create_batches);
        //if ($row_check_create_batches['count'] > 0) {
           // echo json_encode(array("statusCode" => 400, "message" => "Student name already exists."));
           // return;
       // }
        if (strlen($CompanyName_) > 0) {
            $sql = "INSERT INTO `create_batches`(`client`, `batchName`, `budgetParticipant`, `year`,  `course` , `StartDate` , `EndDate`) 
            VALUES ('$CompanyName_', '$batch_', '$budget_', '$year_', '$course_', '$StartDate_', '$EndDate_')";

            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode" => 200));
            } else {
				echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
                //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        } else {
            echo json_encode(array("statusCode" => 400, "message" => "Company name is required"));
            return;
			
        }
    }
}


if(count($_POST)>0){
	if($_POST['type']==2){
		$id_u=$_POST['id'];
		$company_u_=$_POST['company'];
		$batch_u_=$_POST['batch'];
		$budget_u_=$_POST['participant'];
		$year_u_=$_POST['year'];
		$course_=$_POST['course']; 
		$StartDate_=$_POST['Startdate'];
		$EndDate_=$_POST['enddate'];
	
		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `create_batches` WHERE `client` = '$company_u_' AND `RegistrationID` NOT IN($id_u)";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Company already exists."));
			return;
		}else{
			if (strlen($company_u_)>0){ 
				
					$sql = "UPDATE `create_batches` SET `client`='$company_u_',`batchName`='$batch_u_',`budgetParticipant`='$budget_u_',`year`='$year_u_',`course`='$course_',`StartDate`='$StartDate_',`EndDate`='$EndDate_'  WHERE `RegistrationID`=$id_u";
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
		$id=$_POST['id'];
		$sql = "DELETE FROM `create_batches` WHERE `RegistrationID`=$id";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}