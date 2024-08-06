<?php
include '../../../../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["moduleID"])) {
        $moduleID = $_GET["moduleID"];

        // Query your database to fetch session plans for the specified ModuleID
        $sql = "SELECT `FilePath` FROM `module_files` WHERE `ModuleID` = ?";

        // Log SQL query
        error_log("SQL Query: " . $sql);

        $stmt = $conn->prepare($sql);

        // Add error handling
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("i", $moduleID);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($filePath);

        $sessionPlans = array();
        while ($stmt->fetch()) {
            $sessionPlans[] = array(
                'fileName' => basename($filePath),
                'filePath' => $filePath,
                
            );
        }

        $stmt->close();

        // Return the session plans data in JSON format
        echo json_encode($sessionPlans);
    } else {
        echo json_encode(array("error" => "Invalid request. Missing moduleID."));
    }
} else {
    echo json_encode(array("error" => "Invalid request method."));
}
?>
