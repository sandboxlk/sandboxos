<?php
include '../../connection.php';
include '../../check.php';

if ($AccountLevel == 2 || $AccountLevel == 3) {
    $response = array("statusCode" => 400, "message" => "You do not have permission to access this page.");
    echo json_encode($response);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $date = $_POST['date'];
    $name = $_POST['name'];
    $clientID = $_POST['clientID'];
    $actionPoints = $_POST['actionPoint'];

    
    // Save action points in the database
    foreach ($actionPoints as $actionPoint) {
        $sql = "INSERT INTO action_points (clientID, date, name, actionPoint) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isss', $clientID, $date, $name, $actionPoint);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    echo json_encode(['message' => 'Action point saved successfully']);
} else {
    echo json_encode(['message' => 'Invalid request method']);
}
?>






