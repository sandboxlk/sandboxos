<?php
include '../../../../connection.php';
include '../../../../check.php';

//Module insert
if(count($_POST)>0){
	if($_POST['type']==1){
		$ModuleName_=$_POST['Module_Name'];
		$ModuleType_ = isset($_POST['Module_Type']) && $_POST['Module_Type'] == 'on' ? 'Training' : 'Consulting'; 
		//$ModuleType_=$_POST['Module_Type'];
		$duration_=$_POST['duration'];
		$primaryFaculty_=$_POST['faculty'];
		$secondaryFaculty_=$_POST['Sfaculty']; 
		$tertiaryFaculty_=$_POST['Tfaculty'];
		$description_=$_POST['description'];
		//$description_=$_POST['assessmentcb'];
		$Assessment_ = isset($_POST['assessmentSelect']) && $_POST['assessmentSelect'] == 'on' ? 'Yes' : 'No';  // Check if checkbox is checked
	
		// Validate if Client already exists
		$sql_check_module_list = "SELECT COUNT(*) AS count FROM `module` WHERE `ModuleName` = '$ModuleName_'";
		$result_check_module_list = mysqli_query($conn, $sql_check_module_list);
		$row_check_module_list = mysqli_fetch_assoc($result_check_module_list);
		if ($row_check_module_list['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Module already exists."));
			return;
		}
		if (strlen($ModuleName_)>0){ 
	
				$sql = "INSERT INTO `module`( `ModuleName`, `moduleType`, `duration`,`primaryFaculty`,`secondaryFaculty`,`tertiaryFaculty`,`description`,`Assessment`) 
				VALUES ('$ModuleName_','$ModuleType_','$duration_','$primaryFaculty_','$secondaryFaculty_','$tertiaryFaculty_','$description_','$Assessment_')";
				if (mysqli_query($conn, $sql)) {
					echo json_encode(array("statusCode"=>200, "message" => "Module already exists."));
				} 
				else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			
			mysqli_close($conn);
		}else{
			echo json_encode(array("statusCode" => 400, "message" => "Module name is required"));
			return;
		}
	} 
}

if(count($_POST)>0){
	if($_POST['type']==2){
		$ModuleID_=$_POST['module_id_u'];
		$ModuleName_=$_POST['modulename_u'];
		$duration_=$_POST['moduleduration_u'];
		$description_=$_POST['moduledesc_u'];
		$primaryFaculty_=$_POST['primaryFaculty_u'];
		$secondaryFaculty_=$_POST['secondaryFaculty_u'];
		$tertiaryFaculty_=$_POST['tertiaryFaculty_u'];
		$assessment_=$_POST['assessmentcb_u'];
	
		// Validate if Client already exist
		$sql_check_client = "SELECT COUNT(*) AS count FROM `module` WHERE `modulename_u` = '$ModuleName_' AND `module_id_u` NOT IN($ModuleID_)";
		$result_check_client = mysqli_query($conn, $sql_check_module);
		$row_check_client = mysqli_fetch_assoc($result_check_module);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Module already exists."));
			return;
		}else{
			if (strlen($name)>0){ 
				
					$sql = "UPDATE `module` SET `modulename_u`='$ModuleName_',`moduleduration_u`='$duration_',`lecturername_u`='$lecturer_',`moduledesc_u`='$description_',`assessmentcb_u`='$description_' WHERE module_id_u=$ModuleID_";
					if (mysqli_query($conn, $sql)) {
						echo json_encode(array("statusCode" =>200));
					} 
					else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
					mysqli_close($conn);
				
			}else{
				echo json_encode(array("statusCode" => 400, "message" => "Module name is required"));
				return;
			}
		}
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `module` WHERE `ModuleID`=$id";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set
    if (isset($_POST["moduleId"]) && isset($_FILES["session_plans"])) {
        // Get the ModuleID from the form
        $moduleID = $_POST["moduleId"];

        // Handle file upload
        $uploadDirectory = "uploads/"; // Replace with your desired upload directory

        // Check if files are selected
        if (isset($_FILES["session_plans"]["name"][0])) {
            // Process file uploads
            $uploadedFiles = [];
            foreach ($_FILES["session_plans"]["name"] as $index => $fileName) {
                $targetFilePath = $uploadDirectory . basename($fileName);
                if (move_uploaded_file($_FILES["session_plans"]["tmp_name"][$index], $targetFilePath)) {
                    $uploadedFiles[] = $targetFilePath;
                } else {
                    echo "Error uploading file: " . $_FILES["session_plans"]["error"][$index];
                }
            }

            // Update the file field in the database for the specified ModuleID
            $sql = "UPDATE `module` SET `file` = ? WHERE `ModuleID` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $targetFilePath, $moduleID);

            if ($stmt->execute()) {
                echo "File field updated successfully";
            } else {
                echo "Error updating file field: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "No files selected for upload";
        }
    } else {
        echo "Missing required form fields";
    }
}







// $response = array();
// $type = $_POST['type'];

// switch($type) {
//     case 1: // Insert a new module
// 		$ModuleName = $_POST['ModuleName'];
// 		$duration = $_POST['duration'];
// 		$description = $_POST['description'];
// 		$lecturer = $_POST['lecturer'];
	
// 		$stmt = $conn->prepare("INSERT INTO module (ModuleName, duration, description, lecturer) VALUES (?, ?, ?, ?)");
// 		$stmt->bind_param("ssss", $ModuleName, $duration, $description, $lecturer); // "ssss" means 4 strings. Adjust as necessary.
	
// 		if($stmt->execute()) {
// 			$response['statusCode'] = 200;
// 			$response['message'] = "Module added successfully!";
// 		} else {
// 			$response['statusCode'] = 400;
// 			$response['message'] = "Error: " . $stmt->error;
// 		}
// 		$stmt->close();
// 		break;
	

//     case 2: // Update a module
       
//         $coursename = $_POST['ModuleName'];
//         $duration = $_POST['duration'];
//         $description = $_POST['description'];
//         $lecturer = $_POST['lecturer'];
        
//         $update = "UPDATE module SET ModuleName='$ModuleName', duration='$duration', description='$description', lecturer='$lecturer' WHERE ModuleID='$moduleId'";
        
//         if(mysqli_query($conn, $update)) {
//             $response['statusCode'] = 200;
//             $response['message'] = "Module updated successfully!";
//         } else {
//             $response['statusCode'] = 400;
//             $response['message'] = "Error: " . mysqli_error($conn);
//         }
//         break;

//     case 3: // Delete a module
//         $moduleId = $_POST['id'];
        
//         $delete = "DELETE FROM module WHERE ModuleID='$moduleId'";
        
//         if(mysqli_query($conn, $delete)) {
//             $response['statusCode'] = 200;
//             $response['message'] = "Module deleted successfully!";
//         } else {
//             $response['statusCode'] = 400;
//             $response['message'] = "Error: " . mysqli_error($conn);
//         }
//         break;

//     case 4: // Delete multiple modules
//         $ids = $_POST['id'];
//         $delete = "DELETE FROM module WHERE ModuleID IN ($ids)";
        
//         if(mysqli_query($conn, $delete)) {
//             $response['statusCode'] = 200;
//             $response['message'] = "Modules deleted successfully!";
//         } else {
//             $response['statusCode'] = 400;
//             $response['message'] = "Error: " . mysqli_error($conn);
//         }
//         break;

//     // You can add more cases if needed
// }

// // Sending JSON encoded data as a response
// echo json_encode($response);
?>
