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
		// Set the next AUTO_INCREMENT value for your table
		$sql_reset_auto_increment = "ALTER TABLE `clients` AUTO_INCREMENT = 1";
		$conn->query($sql_reset_auto_increment);
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
		$id=$_POST['clientID'];
		$client_code_=$_POST['companyCode'];
		$client_name_=$_POST['clientName'];
		$address_=$_POST['address'];
		$Contactsname_=$_POST['contactsName'];
		$Designation_=$_POST['contactsDesignation'];
		$contact1_=$_POST['contact1'];
		$contact2_=$_POST['contact2'];
		$email_=$_POST['email'];

		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `clients` WHERE `clientName` = '$client_name_' AND `clientID` NOT IN($id)";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Company already exists."));
			return;
		}else{
			if (strlen($name)>0){ 
				
					$sql = "UPDATE `clients` SET `companyCode`='$client_code_',`clientName`='$client_name_',`address`='$address_',`contactsName`='$Contactsname_',`contactsDesignation`='$Designation_',`contact1`='$email_',`contact2`='$contact1_',`email`='$contact2_' WHERE clientID=$id";
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

if(count($_POST)>0){
	if($_POST['type']==5){
		$clientID = $_POST['company_id'];
		$contactName = $_POST['contact_name'];
		$contactDesignation = $_POST['contact_designation'];
		$contactNumber = $_POST['contact_number'];
		$contactEmail = $_POST['contact_email'];
	
		// SQL query to insert data into the 'contacts' table
		$sql = "INSERT INTO contacts (clientID, contactName, contactDesignation, contactNumber, contactEmail)
				VALUES ('$clientID', '$contactName', '$contactDesignation', '$contactNumber', '$contactEmail')";
	
		// Execute the query
		if (mysqli_query($conn, $sql)) {
			echo "Contact added successfully!";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}


if (isset($_GET['clientId'])) {
    $clientId = $_GET['clientId'];

    // SQL query to get contact details based on the client ID
    $sql = "SELECT * FROM contacts WHERE clientID = '$clientId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $contacts = array();

        // Fetch data from the result set
        while ($row = mysqli_fetch_assoc($result)) {
            $contacts[] = array(
                'contact_name' => $row['contactName'],
                'contact_designation' => $row['contactDesignation'],
                'contact_number' => $row['contactNumber'],
                'contact_email' => $row['contactEmail'],
            );
        }

        // Return the contact details as JSON
        echo json_encode($contacts);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
} else {
    echo "Invalid request. Client ID is not provided.";
}

?>

