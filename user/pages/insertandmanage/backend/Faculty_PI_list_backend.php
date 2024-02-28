<?php
include '../../../../connection.php';
include '../../../../check.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$calling_name_=$_POST['name'];
		$nic_=$_POST['nic'];
		$address_=$_POST['address'];
		$mobile1_=$_POST['contact1'];
		$mobile2_=$_POST['contact2']; 
		$emergency_contact_=$_POST['contact3'];   
		$designation_=$_POST['Designation'];
		$current_employee_=$_POST['Employee']; 
		$faculty_level_=$_POST['facultylevel']; 
		$career_start_year_=$_POST['Careerssy'];   
		$experience_=$_POST['Experience'];
		$qualification_=$_POST['Qualification']; 
		$expertise_area_1_=$_POST['ExpertiseArea1'];   
		$expertise_area_2_=$_POST['Expertise'];
		$expertise_area_3_=$_POST['Expert']; 
		$expertise_area_4_=$_POST['faculty'];
		$type1_=$_POST['Type1']; 
		$weekends_=$_POST['weekends'];   
		$daysPerMonth_=$_POST['daysPerMonth'];
		$total_=$_POST['total']; 
		$Type2_=$_POST['Type2'];
		$weekends2_=$_POST['weekends2']; 
		$daysPerMonth2_=$_POST['daysPerMonth2'];   
		$total2_=$_POST['total2'];
		$capacity_=$_POST['Capacity'];
 
		// Validate if Client already exists
		$sql_check_faculty = "SELECT COUNT(*) AS count FROM `faculty` WHERE `callingName` = '$calling_name_'";
		$result_check_faculty = mysqli_query($conn, $sql_check_faculty);
		$row_check_faculty = mysqli_fetch_assoc($result_check_faculty);
		// Set the next AUTO_INCREMENT value for your table
		$sql_reset_auto_increment = "ALTER TABLE `faculty` AUTO_INCREMENT = 1";
		$conn->query($sql_reset_auto_increment);
		if ($row_check_faculty['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Faculty already exists."));
			return;
		}
		if (strlen($calling_name_)>0){ 
	
				$sql = "INSERT INTO `faculty`(`callingName`,`nic`,`address`,`mobileNo1`,`mobileNo2`,`emergencyContact`,`designation`,`currentEmployee`,`facultyLevel`,`careersStartY`,`yoe`,`formalQualification`,`expertiseArea1`,`expertiseArea2`,`expertiseArea3`,`expertiseArea4`,`type`,`weekends`,`daysPerMonth`,`totalAvailability`,`type2`,`weekends2`,`daysPerMonth2`,`TotalDaysPerYear`,`capacity`) 
				VALUES ('$calling_name_','$nic_','$address_','$mobile1_','$mobile2_','$emergency_contact_','$designation_','$current_employee_','$faculty_level_','$career_start_year_','$experience_','$qualification_','$expertise_area_1_','$expertise_area_2_','$expertise_area_3_','$expertise_area_4_','$type1_','$weekends_','$daysPerMonth_','$total_','$Type2_','$weekends2_','$daysPerMonth2_','$total2_','$capacity_')";
				
				if (mysqli_query($conn, $sql)) {
					echo json_encode(array("statusCode" => 200));
				} else {
					echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
				}
	
				mysqli_close($conn);
			} else {
				echo json_encode(array("statusCode" => 400, "message" => "Faculty Name is required."));
			}
		}
	}

	if(count($_POST)>0){
		if($_POST['type']==2){
				$fid_=$_POST['id'];
				$name_=$_POST['name'];
				$nic_=$_POST['nic'];
				$address_=$_POST['address'];
				$contact1_=$_POST['contact1'];
				$contact2_=$_POST['contact2'];
				$contact3_=$_POST['contact3'];
				$designation_=$_POST['Designation'];
				$employee_=$_POST['Employee'];
				$facultylevel_=$_POST['facultylevel'];
				$carreer_=$_POST['Careerssy'];
				$experience_=$_POST['Experience'];
				$qualification_=$_POST['Qualification'];
				$expertise_area_1_=$_POST['ExpertiseArea1'];
				$expertise_area_2_=$_POST['Expertise'];
				$expertise_area_3_=$_POST['Expert'];
				$expertise_area_4_=$_POST['faculty'];
				$type1_=$_POST['Type1'];
				$weekends_=$_POST['weekends'];
				$dayspermonth_=$_POST['daysPerMonth'];
				$total_=$_POST['total'];
				$type2_=$_POST['Type2'];
				$weekends2_=$_POST['weekends2'];
				$dayspermonth2_=$_POST['daysPerMonth2'];
				$total2_=$_POST['total2'];
				$capacity_=$_POST['Capacity'];
	   
			   // validate if lead already exists
			   $sql_check_faculty = "SELECT COUNT(*) AS count FROM `faculty` WHERE `callingName`='$name_' AND 'facultyid ' NOT IN($fid_)";
			   $result_check_faculty = mysqli_query($conn, $sql_check_faculty);
			   $row_check_faculty = mysqli_fetch_assoc($result_check_faculty);
			   if ($row_check_faculty['count'] > 0) {
				   echo json_encode(array("statusCode" => 400, "message" => "Faculty already exists."));
				   return;
			   }else{
				   if (strlen($name_)>0){
	   
					   $sql = "UPDATE `faculty` SET `callingName`='$name_',`nic`='$nic_',`address`='$address_',`mobileNo1`='$contact1_',`mobileNo2`='$contact2_',`emergencyContact`='$contact3_',`designation`='$designation_',`currentEmployee`='$employee_',`facultyLevel`='$facultylevel_',`careersStartY`='$carreer_',`yoe`='$experience_',`formalQualification`='$qualification_',`expertiseArea1`='$expertise_area_1_',`expertiseArea2`='$expertise_area_2_',`expertiseArea3`='$expertise_area_3_',`expertiseArea4`='$expertise_area_4_',`type`='$type1_',`weekends`='$weekends_',`daysPerMonth`='$dayspermonth_',`totalAvailability`='$total_',`type2`='$type2_',`weekends2`='$weekends2_',`daysPerMonth2`='$dayspermonth2_',`TotalDaysPerYear`='$total2_',`capacity`='$capacity_' WHERE `facultyid`='$fid_'";
				if (mysqli_query($conn, $sql)) {
				   echo json_encode(array("statusCode"=>200));
				} 
				else {
					echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
					return;
				}
				mysqli_close($conn);
	   
				   }else{
					   echo json_encode(array("statusCode" => 400, "message" => "Faculty name is required"));
					   return;
				   }
			   }
		   }			
	   }



if(count($_POST)>0){
	if($_POST['type']==3){
		$fid_=$_POST['facultyid'];
		$sql = "DELETE FROM `faculty` WHERE facultyid=$fid_ ";
		if (mysqli_query($conn, $sql)) {
			echo $fid_;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}


