<?php
include '../../../../connection.php';
include '../../../../check.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$calling_name_=$_POST['name'];
		$nic_=$_POST['nic'];
		$address_=$_POST['address'];
		$contact1_=$_POST['contact1'];
		$contact2_=$_POST['contact2']; 
		$contact3_=$_POST['contact3']; 
		$designation_=$_POST['Designation'];   
		$employee_=$_POST['Employee'];
		$faculty_level_=$_POST['faculty_level']; 
		$career_start_year_=$_POST['Careerssy']; 
		$experience_=$_POST['Experience'];   
		$qualification_=$_POST['Qualification'];
		$faculty_level_1=$_POST['faculty_level1']; 
		$faculty_level_2_=$_POST['faculty_level2'];   
		$faculty_level_3_=$_POST['faculty_level3'];
		$faculty_level_4_=$_POST['faculty_level4']; 
		$weekends_=$_POST['weekends']; 
		$daysPerMonth_=$_POST['daysPerMonth'];   
		$total_=$_POST['total'];
 
		// Validate if Client already exists
		$sql_check_Faculty_PI_list = "SELECT COUNT(*) AS count FROM `faculty` WHERE `callingName` = '$calling_name_'";
		$result_check_Faculty_PI_list = mysqli_query($conn, $sql_check_Faculty_PI_list);
		$row_check_Faculty_PI_list = mysqli_fetch_assoc($result_check_Faculty_PI_list);
		if ($row_check_Faculty_PI_list['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Faculty already exists."));
			return;
		}
		if (strlen($calling_name_)>0){ 
	
				$sql = "INSERT INTO `faculty`( `callingName`,`nic`, `address`,`mobileNo1`,`mobileNo2`,`emergencyContact`,`designation`,`currentEmployee`,`facultyLevel`,`careersStartY`,`yoe`,`expertiseArea1`,`expertiseArea2`,`expertiseArea3`,`expertiseArea4`,`formalQualification`,`capacity`) 
				VALUES ('$calling_name_','$nic_','$address_','$contact1_','$contact2_','$contact3_','$designation_','$employee_','$faculty_level_','$career_start_year_','$experience_','$qualification_','$faculty_level_1','$faculty_level_2_','$faculty_level_3_','$faculty_level_4_','$weekends_','$daysPerMonth_','$total_')";
				if (mysqli_query($conn, $sql)) {
					echo json_encode(array("statusCode"=>200));
				} 
				else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			
			mysqli_close($conn);
		}else{
			echo json_encode(array("statusCode" => 400, "message" => "Faculty name is required"));
			return;
		}
	}
}

//if (isset($_POST['type']) && $_POST['type'] == 1) {
    //$callingName = $_POST['name'];
    //$nic = $_POST['nic'];
    //$address = $_POST['address'];
    //$mobileNo1 = $_POST['contact1'];
//$mobileNo2 = $_POST['contact2'];
    //$emergencyContact = $_POST['contact3'];
    //$designation = $_POST['Designation'];
    //$currentEmployee = $_POST['Employee'];
    //$facultyLevel = $_POST['faculty_level'];
    //$careersStartY = $_POST['Careerssy'];
    //$yoe = $_POST['Experience'];
    //$expertiseArea1 = $_POST['faculty_level1'];
    //$expertiseArea2 = $_POST['faculty_level2'];
    //$expertiseArea3 = $_POST['faculty_level3'];
    //$expertiseArea4 = $_POST['faculty_level4'];
    //$formalQualification = $_POST['Qualification'];
    //$capacity = $_POST['contact2'];
	//$weekends = $_POST['weekends'];
    //$daysPerMonth = $_POST['daysPerMonth'];
	//$daysPerMonth = isset($_POST['daysPerMonth']) ? intval($_POST['daysPerMonth']) : 0;
    //$totalDays = $daysPerMonth * 12;

    // Append $totalDays to your SQL query
    //$sql .= ", `totalDays` = '$totalDays'";
	

    // Validate if Faculty name already exists
    //$sql_check_faculty = "SELECT COUNT(*) AS count FROM `faculty` WHERE `callingName` = '$callingName'";
    //$result_check_faculty = mysqli_query($conn, $sql_check_faculty);
    //$row_check_faculty = mysqli_fetch_assoc($result_check_faculty);

    //if ($row_check_faculty['count'] > 0) {
        //echo json_encode(array("statusCode" => 400, "message" => "Faculty name already exists."));
   // } else {
       // $sql = "INSERT INTO `faculty` (`callingName`, `nic`, `address`, `mobileNo1`, `mobileNo2`, `emergencyContact`, `designation`, `currentEmployee`, `facultyLevel`, `careersStartY`, `yoe`, `expertiseArea1`, `expertiseArea2`, `expertiseArea3`, `expertiseArea4`, `formalQualification`, `capacity`, `weekends`, `daysPerMonth`, `totalDays`) 
                //VALUES ('$callingName','$nic','$address','$mobileNo1','$mobileNo2','$emergencyContact','$designation','$currentEmployee','$facultyLevel','$careersStartY','$yoe','$expertiseArea1','$expertiseArea2','$expertiseArea3','$expertiseArea4','$formalQualification','$capacity','$weekends','$daysPerMonth','$totalDays')";

        //if (mysqli_query($conn, $sql)) {
          //  echo json_encode(array("statusCode" => 200, "message" => "Faculty added successfully."));
       // } else {
         //   echo json_encode(array("statusCode" => 400, "message" => "Error inserting faculty: " . mysqli_error($conn)));
       // }
    //}
    //mysqli_close($conn);
//}


if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id_u'];
		$client_code_=$_POST['code_u'];
		$client_name_=$_POST['name_u'];
		$address_=$_POST['address_u'];
		$Contactsname_=$_POST['contacts_u'];
		$Designation_=$_POST['designation_u'];
		$email_=$_POST['email_u'];
		$contact1_=$_POST['contact1_u'];
		$contact2_=$_POST['contact2_u'];

		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `clients` WHERE `clientName` = '$name' AND `clientID` NOT IN($id)";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Company already exists."));
			return;
		}else{
			if (strlen($name)>0){ 
				
					$sql = "UPDATE `clients` SET `code_u`='$client_code_',`name_u`='$client_name_',`address_u`='$address_',`contacts_u`='$Contactsname_',`designation_u`='$Designation_',`email_u`='$email_',`contact1_u`='$contact1_',`contact2_u`='$contact2_' WHERE clientID=$id";
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
		$sql = "DELETE FROM `clients` WHERE clientID=$id ";
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
		$id=$_POST['id'];
		$sql = "DELETE FROM clients WHERE clientID in ($id)";
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

