<?php
include '../../../../connection.php';
include '../../../../check.php';

if (count($_POST) > 0) {
	if ($_POST['type'] == 1) {
		$Company_ = $_POST['company'];
		$CompanyName_ = $_POST['company'];
		$course_ = $_POST['course'];
		$year_ = $_POST['year'];
		$batch_ = $_POST['batch'];
		$modulefaculty_ = $_POST['modulefac'];
		$budget_ = $_POST['budget'];
		$StartDate_ = $_POST['StartDate'];
		$EndDate_ = $_POST['EndDate'];


		if (strlen($CompanyName_) > 0)
			$sql = "INSERT INTO `create_batches`(`client`,`clientName`, `batchName`, `budgetParticipant`,`moduleFaculty`, `year` , `course` , `StartDate` , `EndDate`) 
            VALUES ('$Company_','$CompanyName_', '$batch_', '$budget_', '$modulefaculty_', '$year_', '$course_', '$StartDate_', '$EndDate_')";

		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode" => 200));
		} else {
			echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	} else {
		echo json_encode(array("statusCode" => 400, "message" => "Company name is required"));
		return;

	}
}



if (isset($_GET['batch_id'])) {
	$batchId = mysqli_real_escape_string($conn, $_GET['batch_id']);
	$query = "SELECT company, lead FROM leads WHERE batchName = '$batchId' LIMIT 1";
	$result = mysqli_query($conn, $query);

	if ($result && mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		echo json_encode($row);
	} else {
		echo json_encode(['company' => 'Not Found', 'lead' => 'Not Found']);
	}
}




if (count($_POST) > 0) {
	if ($_POST['type'] == 2) {
		$id_u = $_POST['id'];
		$company_u_ = $_POST['company'];
		$batch_u_ = $_POST['batch'];
		$budget_u_ = $_POST['participant'];
		$year_u_ = $_POST['year'];
		$course_ = $_POST['course'];
		$StartDate_ = $_POST['Startdate'];
		$EndDate_ = $_POST['enddate'];

		// Validate if Client already exists
		$sql_check_client = "SELECT COUNT(*) AS count FROM `create_batches` WHERE `client` = '$company_u_' AND `RegistrationID` NOT IN($id_u)";
		$result_check_client = mysqli_query($conn, $sql_check_client);
		$row_check_client = mysqli_fetch_assoc($result_check_client);
		if ($row_check_client['count'] > 0) {
			echo json_encode(array("statusCode" => 400, "message" => "Company already exists."));
			return;
		} else {
			if (strlen($company_u_) > 0) {

				$sql = "UPDATE `create_batches` SET `client`='$company_u_',`batchName`='$batch_u_',`budgetParticipant`='$budget_u_',`year`='$year_u_',`course`='$course_',`StartDate`='$StartDate_',`EndDate`='$EndDate_'  WHERE `RegistrationID`=$id_u";
				if (mysqli_query($conn, $sql)) {
					echo json_encode(array("statusCode" => 200));
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
				mysqli_close($conn);

			} else {
				echo json_encode(array("statusCode" => 400, "message" => "Company name is required"));
				return;
			}
		}
	}
}

if (count($_POST) > 0) {
	if ($_POST['type'] == 3) {
		$id = $_POST['id'];
		$sql = "DELETE FROM `create_batches` WHERE `RegistrationID`=$id";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

// Function to update the utilized capacities of the faculty
function updateFacultyCapacities($conn, $modulefaculty_, $StartDate_, $EndDate_)
{
	// Split the module faculty string into an array
	$moduleFaculties = explode('<br>', $modulefaculty_);

	foreach ($moduleFaculties as $moduleFaculty) {
		if (trim($moduleFaculty) === '') {
			continue;
		}

		// Assuming the format "ModuleName - FacultyName"
		list($moduleName, $facultyName) = explode(' - ', $moduleFaculty);
		$duration = calculateDurationInDays($StartDate_, $EndDate_);

		// Update the faculty's utilized capacity
		updateFacultyCapacity($conn, trim($facultyName), $duration);
	}
}

// Function to calculate duration in days
function calculateDurationInDays($startDate, $endDate)
{
	$start = new DateTime($startDate);
	$end = new DateTime($endDate);
	$interval = $start->diff($end);
	return $interval->days + 1; // +1 to include the start date
}

// Function to update the utilized capacity in the faculty table
function updateFacultyCapacity($conn, $facultyName, $duration)
{
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
		$updateStmt->bind_param("is", $duration, $facultyName);

		if (!$updateStmt->execute()) {
			error_log("Error updating faculty capacity: " . $updateStmt->error);
		}
		$updateStmt->close();
	} else {
		error_log("Faculty not found: " . $facultyName);
	}
	$stmt->close();
}
?>