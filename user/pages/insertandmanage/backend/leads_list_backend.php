<?php
include '../../../../connection.php';
include '../../../../check.php';

if (count($_POST) > 0) {
    // Handle the insert type (type == 1)
    if (isset($_POST['type']) && $_POST['type'] == 1) {
        $salesStage_ = 'Pre Sales'; // Default sales stage
        $company_ = $_POST['company'];
        $date_ = $_POST['date'];
        $lead_ = $_POST['lead'];
        $confidetial_ = $_POST['Confidenselevel'];
        $categoryType_ = $_POST['ltype'];
        $leadtype_ = $_POST['leadtype'];
        $requirement_ = $_POST['requirement'];
        $estimatesv_ = $_POST['estimatesv'];
        $followup_ = $_POST['followup'];

        

        // Determine sales stage
        if (!empty($lost_)) {
            $SalesStage_ = 'Lost Lead';
            $Status_ = 'Inactive Lead';
        } elseif (isset($postSalesFollowUp_) && $postSalesFollowUp_ == 'Completed') {
            $SalesStage_ = 'Post Sales';
        } elseif (isset($programC_) && $programC_ == 'Completed') {
            $SalesStage_ = 'Program Completed';
        } elseif (isset($cof_) && $cof_ == 'Completed') {
            $SalesStage_ = 'Deployment';
        } elseif (isset($emailClient_) && $emailClient_ == 'Completed') {
            $SalesStage_ = 'Pre Sales';
            $Status_ = 'Active Lead';
        }

        // Construct SQL query
        $sql = "INSERT INTO `leads`(`salesStage`, `company`, `date`, `lead`, `confidenseLevel`, `categoryType`, `leadType`, `requirement`, `estimateSalesValue`, `followup`) 
                VALUES ('$salesStage_', '$company_', '$date_', '$lead_', '$confidetial_', '$categoryType_', '$leadtype_', '$requirement_', '$estimatesv_', '$followup_')";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo json_encode(array("statusCode" => 400, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
        }
        mysqli_close($conn);
    }

    // Handle the update type (type == 2)
    if (isset($_POST['type']) && $_POST['type'] == 2) {
        $lid_ = $_POST['id'];
        $Lead_ = $_POST['lead'];
        $SalesStage_ = 'Pre Sales'; // Default sales stage
        $Status_ = $_POST['Status'];
        $requirement_ = $_POST['requirement'];
        $sales_ = $_POST['sales'];
        $lost_ = $_POST['lost'];
        $action_ = $_POST['action'];

        $programC_ = $_POST['programC'];
        $cof_ = $_POST['cof'];
        $emailClient_ = $_POST['emailClient'];
        $postSalesFollowUp_ = $_POST['postSalesFollowUp'];


        // Check if the lost lead date is filled first
        if (!empty($lost_)) {
            $Status_ = 'Inactive Lead';
        } elseif (isset($_POST['followup']) && $_POST['followup'] == 'Completed') {
            $Status_ = 'Close Lead';
        } elseif (isset($_POST['email']) && $_POST['email'] == 'Completed') {
            $Status_ = 'Active Lead';
        }
        
        // Determine sales stage
        if (!empty($lost_)) {
            $SalesStage_ = 'Lost Lead';
            $Status_ = 'Inactive Lead';
        } elseif (isset($postSalesFollowUp_) && $postSalesFollowUp_ == 'Completed') {
            $SalesStage_ = 'Post Sales';
        } elseif (isset($programC_) && $programC_ == 'Completed') {
            $SalesStage_ = 'Program Completed';
        } elseif (isset($cof_) && $cof_ == 'Completed') {
            $SalesStage_ = 'Deployment';
        } elseif (isset($emailClient_) && $emailClient_ == 'Completed') {
            $SalesStage_ = 'Pre Sales';
            $Status_ = 'Active Lead';
        }

        
        // Determine Confidence Level
        $confidencelevel_ = 'confindeceLevelRating'; // Default confidence level
        

        $sql = "UPDATE `leads` SET `lead`='$Lead_', `salesStage`='$SalesStage_', `status`='$Status_', `requirement`='$requirement_', 
                `estimateSalesValue`='$sales_', `lostLeadDate`='$lost_', `followUp`='$action_', `confindeceLevelRating`='$confidencelevel_' 
                WHERE `clientID`=$lid_";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }

    // Handle the dynamic update for fields
    if (isset($_POST['id']) && isset($_POST['field']) && isset($_POST['value'])) {
        $id = $_POST['id'];
        $field = $_POST['field'];
        $value = $_POST['value'];

        $allowedFields = [
            'preliminaryBrochures' => 'preliminaryBrochures',
            'emailClient' => 'emailClient',
            'sheduleCM' => 'sheduleCM',
            'chemMeeting' => 'chemMeeting',
            'proposal' => 'proposal',
            'estimate' => 'estimate',
            'confirmation' => 'confirmation',
            'cof' => 'cof',
            'po' => 'po',
            'invoice' => 'invoice',
            'invoiceDT' => 'invoiceDT',
            'payment' => 'payment',
            'program' => 'program',
            'SurveyData' => 'SurveyData',
            'courseFacillitation' => 'courseFacillitation',
            'projectsAssessments' => 'projectsAssessments',
            'projects' => 'projects',
            'dataCertification' => 'dataCertification',
            'graduation' => 'graduation',
            'programCompleted' => 'programCompleted',
            'postSalesFollowUp' => 'postSalesFollowUp',
            'protofolioEmail' => 'protofolioEmail',
            'newBusinessMeeting' => 'newBusinessMeeting',
            'followUp' => 'followUp',
            'lostLeadDate' => 'lostLeadDate',
            'programC' => 'programC', 
            'strategicPriority' => 'strategicPriority', 
        'confidenceLevelRating' => 'confindeceLevelRating',
        'name' => 'name'// Ensure all fields are present
            
        ];

        // Check if the field is allowed to be updated
        if (array_key_exists($field, $allowedFields)) {
            $column = $allowedFields[$field];

            $sql = "UPDATE `leads` SET `$column` = ? WHERE `clientID` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $value, $id);

            if ($stmt->execute()) {
                echo json_encode(array("statusCode" => 200));
            } else {
                echo json_encode(array("statusCode" => 201, "error" => $stmt->error));
            }

            $stmt->close();
        } else {
            echo json_encode(array("statusCode" => 400, "error" => "Invalid field"));
        }

        $conn->close();
    }
} else {
    echo json_encode(array("statusCode" => 400, "error" => "No data provided"));
}
?>
