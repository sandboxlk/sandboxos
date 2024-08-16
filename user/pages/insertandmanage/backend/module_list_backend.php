<?php
include '../../../../connection.php';
include '../../../../check.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Handle Insert Operation
if (count($_POST) > 0 && isset($_POST['type']) && $_POST['type'] == 1) {
    $calling_name_ = $_POST['name'];
    $type1_ = $_POST['Type1'];    
    $daysPerMonth_ = $_POST['daysPerMonth'];
    $Monday_ = $_POST['Monday'];
    $Tuesday_ = $_POST['Tuesday'];
    $Wednesday_ = $_POST['Wednesday'];
    $Thursday_ = $_POST['Thursday'];
    $Friday_ = $_POST['Friday'];
    $Saturday_ = $_POST['Saturday'];
    $Sunday_ = $_POST['Sunday'];
    $Year_ = $_POST['year'];
    $total_ = $_POST['total']; 
    $capacity_ = $_POST['Capacity'];

    $sql = "INSERT INTO `faculty_capacity`(`callingName`, `type`, `daysPerMonth`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `year`, `TotalDaysPerYear`, `capacity`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssssssss", 
            $calling_name_, 
            $type1_, 
            $daysPerMonth_, 
            $Monday_, 
            $Tuesday_, 
            $Wednesday_, 
            $Thursday_, 
            $Friday_, 
            $Saturday_, 
            $Sunday_, 
            $Year_, 
            $total_, 
            $capacity_
        );

        if ($stmt->execute()) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo json_encode(array("statusCode" => 400, "message" => "Execute Error: " . $stmt->error));
        }

        $stmt->close();
    } else {
        echo json_encode(array("statusCode" => 500, "message" => "Prepare Error: " . $conn->error));
    }

    mysqli_close($conn);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
    if ($_POST['type'] == 2) {
        // Handle Update Operation
        $id = $_POST['capacity_id']; // Primary key
        $name = $_POST['name'];
        $type1 = $_POST['Type1'];
        $year = $_POST['year'];
        $daysPerMonth = $_POST['daysPerMonth'];
        $total = $_POST['total'];
        $capacity = $_POST['Capacity'];
        $monday = $_POST['Monday'];
        $tuesday = $_POST['Tuesday'];
        $wednesday = $_POST['Wednesday'];
        $thursday = $_POST['Thursday'];
        $friday = $_POST['Friday'];
        $saturday = $_POST['Saturday'];
        $sunday = $_POST['Sunday'];

        $sql = "UPDATE faculty_capacity SET 
                    callingName = ?, 
                    type = ?, 
                    year = ?, 
                    daysPerMonth = ?, 
                    TotalDaysPerYear = ?, 
                    capacity = ?, 
                    monday = ?, 
                    tuesday = ?, 
                    wednesday = ?, 
                    thursday = ?, 
                    friday = ?, 
                    saturday = ?, 
                    sunday = ?
                WHERE capacityID = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssisssssssssi", 
                $name, 
                $type1, 
                $year, 
                $daysPerMonth, 
                $total, 
                $capacity, 
                $monday, 
                $tuesday, 
                $wednesday, 
                $thursday, 
                $friday, 
                $saturday, 
                $sunday, 
                $id
            );

            if ($stmt->execute()) {
                echo json_encode(array("statusCode" => 200));
            } else {
                echo json_encode(array("statusCode" => 201, "error" => $stmt->error));
            }

            $stmt->close();
        } else {
            echo json_encode(array("statusCode" => 500, "error" => "Failed to prepare the SQL statement: " . $conn->error));
        }

        mysqli_close($conn);
    }
}

// Handle Delete Operation
if (count($_POST) > 0 && isset($_POST['type']) && $_POST['type'] == 3) {
    $fid_ = $_POST['facultyid'];
    $sql = "DELETE FROM faculty_capacity WHERE capacityID = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $fid_);
        if ($stmt->execute()) {
            echo json_encode(array("statusCode" => 200, "message" => "Deleted successfully"));
        } else {
            echo json_encode(array("statusCode" => 201, "error" => $stmt->error));
        }
        $stmt->close();
    } else {
        echo json_encode(array("statusCode" => 500, "error" => "Failed to prepare the SQL statement: " . $conn->error));
    }

    mysqli_close($conn);
}
?>
