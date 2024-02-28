<?php
include '../../../../connection.php';
include '../../../../check.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['profile_pic'])) {


	// Get file info 
	$fileName = basename($_FILES["profile_pic"]["name"]); 
	$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
	
	// Allow certain file formats 
	$allowTypes = array('jpg','png','jpeg','gif'); 

	if(in_array($fileType, $allowTypes)){ 
		$image = $_FILES['profile_pic']['tmp_name']; 
		$imgContent = addslashes(file_get_contents($image)); 
	
		$updateImage= "UPDATE sys_users SET profileImg='$imgContent' WHERE UserID=$user_id";

		if ($conn->query($updateImage) === TRUE) {
			$status = 'success'; 
			$statusMsg = "File uploaded successfully."; 
			echo json_encode(array("statusCode"=>200));
		}else{ 
			$statusMsg = "File upload failed, please try again."; 
			echo json_encode(array("success" => false, "message" => "Error uploading image."));
		}  
	}else{ 
		$statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
		echo json_encode(array("success" => false, "message" => "Error uploading image."));
	}

  } else {
    echo json_encode(array("success" => false, "message" => "No image file received."));
  }
}
?>

