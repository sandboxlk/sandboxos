<?php
include '../../connection.php';
include '../../check.php';

if ($AccountLevel == 2 || $AccountLevel == 3) {
    $response = array("statusCode" => 400, "message" => "You do not have permission to access this page.");
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have sanitized your input data
    $company_id = $_POST['company_id'];
    $contact_name = $_POST['contact_name'];
    $contact_designation = $_POST['contact_designation'];
    $contact_number = $_POST['contact_number'];
    $contact_email = $_POST['contact_email'];

    // Add your validation logic here if needed

    $insertContactQuery = "INSERT INTO contacts (contactID , contactName, contactDesignation, contactNumber, contactEmail)
                           VALUES ('$company_id', '$contact_name', '$contact_designation', '$contact_number', '$contact_email')";

    if (mysqli_query($conn, $insertContactQuery)) {
        $response = array("statusCode" => 200, "message" => "Contact added successfully!");
    } else {
        $response = array("statusCode" => 400, "message" => "Error adding contact: " . mysqli_error($conn));
    }

    echo json_encode($response);
} else {
    $response = array("statusCode" => 400, "message" => "Invalid request method.");
    echo json_encode($response);
}



if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Fetch all contacts from the database
    $selectContactsQuery = "SELECT * FROM contacts";
    $result = mysqli_query($conn, $selectContactsQuery);

    // Check if any contacts are found
    if (mysqli_num_rows($result) > 0) {
        $contacts = array();

        // Fetch and store contacts data
        while ($row = mysqli_fetch_assoc($result)) {
            $contacts[] = array(
                "contactID"     => $row['contactID'],
                "contactName"   => $row['contactName'],
                "contactDesignation" => $row['contactDesignation'],
                "contactNumber" => $row['contactNumber'],
                "contactEmail" => $row['contactEmail']
            );
        }

        // Return contacts data as JSON response
        $response = array("statusCode" => 200, "contacts" => $contacts);
        echo json_encode($response);
    } else {
        $response = array("statusCode" => 404, "message" => "No contacts found.");
        echo json_encode($response);
    }
} else {
    $response = array("statusCode" => 400, "message" => "Invalid request method.");
    echo json_encode($response);
}

mysqli_close($conn);
?>





