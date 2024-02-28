<?php
include '../../../../connection.php';
include '../../../../check.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$accont_name_=$_POST['accountName'];
		$account_number_=$_POST['accountNumber'];
		$bank_=$_POST['bank'];
		$branch_=$_POST['branch'];
		$swift_code_=$_POST['swiftCode'];
		$bank_code_=$_POST['bankCode'];
		$branch_code_=$_POST['branchCode']; 
		
 
		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `banking` WHERE `accountName` = '$accont_name_'";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Account Name already exists."));
			return;
		}
		if (strlen($client_name_)>0){ 
	
				$sql = "INSERT INTO `banking`( `accountName`, `accountNumber`, `bank`, `branch`, `swiftCode`, `bankCode`, `branchCode`) 
				VALUES ('$accont_name_','$account_number_','$bank_','$branch_','$swift_code_','$bank_code_','$branch_code_')";
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
		$id=$_POST['bank_id_u'];
		$client_code_=$_POST['accountname_u'];
		$client_name_=$_POST['accountnumber_u'];
		$address_=$_POST['bank_u'];
		$Contactsname_=$_POST['branch_u'];
		$Designation_=$_POST['swiftcode_u'];
		$email_=$_POST['bankcode_u'];
		$contact1_=$_POST['branchcode_u'];
		

		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `banking` WHERE `accountName` = '$name' AND `bankID` NOT IN($id)";
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
		$sql = "DELETE FROM `banking` WHERE clientID=$id ";
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
		$sql = "DELETE FROM banking WHERE clientID in ($id)";
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

