<?php
include '../../../../connection.php';
include '../../../../check.php';

if (count($_POST) > 0) {
	$type = $_POST['type'];

	// Add New Module
	if ($type == 1) {
		$moduleName = $_POST['Module_Name'];
		$moduleType = $_POST['Module_Type'];
		$duration = $_POST['duration'];
		$description = $_POST['description'];
		$primaryFaculty = $_POST['faculty'];
		$assessment = $_POST['assessmentSelect'];

		if (!empty($moduleName)) {
			$sql = "INSERT INTO module (ModuleName, moduleType, duration, description, primaryFaculty, Assessment) 
                    VALUES (?, ?, ?, ?, ?, ?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ssssss", $moduleName, $moduleType, $duration, $description, $primaryFaculty, $assessment);

			if ($stmt->execute()) {
				// Update the utilized capacity for the faculty
				updateFacultyCapacity($conn, $primaryFaculty, $duration);

				echo json_encode(array("statusCode" => 200));
			} else {
				echo json_encode(array("statusCode" => 400, "message" => "Error: " . $stmt->error));
			}
			$stmt->close();
		} else {
			echo json_encode(array("statusCode" => 400, "message" => "Module name is required."));
		}

		$conn->close();
	}

	// Update Module
	elseif ($type == 2) {
		$moduleID = $_POST['moduleid'];
		$moduleName = $_POST['modulename'];
		$moduleType = $_POST['moduletype'];
		$duration = $_POST['moduleduration'];
		$description = $_POST['moduledesc'];
		$primaryFaculty = $_POST['primaryFaculty'];
		$assessment = $_POST['assessmentSelect'];

		$sql = "UPDATE module SET ModuleName=?, moduleType=?, duration=?, description=?, primaryFaculty=?, Assessment=? WHERE ModuleID=?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ssssssi", $moduleName, $moduleType, $duration, $description, $primaryFaculty, $assessment, $moduleID);

		if ($stmt->execute()) {
			echo json_encode(array("statusCode" => 200));
		} else {
			echo json_encode(array("statusCode" => 400, "message" => "Error: " . $stmt->error));
		}
		$stmt->close();
		$conn->close();
	}

	// Delete Module
	elseif ($type == 3) {
		$moduleID = $_POST['id'];
		$sql = "DELETE FROM module WHERE ModuleID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $moduleID);

		if ($stmt->execute()) {
			echo json_encode(array("statusCode" => 200, "message" => "Deleted successfully"));
		} else {
			echo json_encode(array("statusCode" => 400, "message" => "Error: " . $stmt->error));
		}
		$stmt->close();
		$conn->close();
	}
}

// Function to update the utilized capacity in the faculty table
function updateFacultyCapacity($conn, $facultyName, $duration)
{
	// Convert duration to days or any required unit
	$durationInDays = convertDurationToDays($duration);

	// Check if the faculty is already in the faculty table
	$checkQuery = "SELECT capacity FROM faculty_capacity WHERE callingName = ?";
	$stmt = $conn->prepare($checkQuery);
	$stmt->bind_param("s", $facultyName);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		// Faculty exists, update the utilized capacity
		$updateQuery = "UPDATE faculty_capacity SET capacity = capacity + ? WHERE callingName = ?";
		$updateStmt = $conn->prepare($updateQuery);
		$updateStmt->bind_param("is", $durationInDays, $facultyName);

		if (!$updateStmt->execute()) {
			error_log("Error updating faculty capacity: " . $updateStmt->error);
		}
		$updateStmt->close();
	} else {
		// Handle the case where the faculty does not exist, if needed
		// This can be logging an error or adding the faculty, depending on your use case
		error_log("Faculty not found: " . $facultyName);
	}
	$stmt->close();
}

// Function to convert the module duration to days
function convertDurationToDays($duration)
{
	// Here you should convert the duration string to the number of days
	// Assuming duration is something like '1h', '2h', '4h', '8h', '1 week'
	switch ($duration) {
		case '1h':
		case '2h':
		case '4h':
		case '8h':
			return 1;  // All hours count as 1 day in this example
		case '1 week':
			return 7;
		default:
			return 1;  // Default to 1 day if format is unrecognized
	}
}
?>
