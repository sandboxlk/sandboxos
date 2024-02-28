<?php
include '../../../../connection.php';
include '../../../../check.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$client_code_=$_POST['code'];
		$client_name_=$_POST['name'];
		$email_=$_POST['email'];
		$address_=$_POST['address'];
		$Contactsname_=$_POST['Contactsname']; 
		$Designation_=$_POST['Designation']; 
		$contact1_=$_POST['contact1'];   
		$contact2_=$_POST['contact2'];
 
		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `clients` WHERE `companyCode` = '$client_code_'";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Company already exists."));
			return;
		}
		if (strlen($client_name_)>0){ 
	
				$sql = "INSERT INTO `clients`( `companyCode`,`clientName`, `email`,`address`,`contactsName`,`contactsDesignation`,`contact1`,`contact2`) 
				VALUES ('$client_code_','$client_name_','$email_','$address_','$Contactsname_','$Designation_','$contact1_','$contact2_')";
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

