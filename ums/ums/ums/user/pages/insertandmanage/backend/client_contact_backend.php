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

    $insertContactQuery = "INSERT INTO client_contacts (company_id, contact_name, contact_designation, contact_number, contact_email)
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
?>

