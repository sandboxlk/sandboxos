<?php
include "../../../../connection.php";
include "../../../../check.php";
if (count($_POST) > 0) {
    if ($_POST["type"] == 1) {
        $CompanyName_ = $_POST["CompanyName"];
        $batch_ = $_POST["batch"];
        $module_ = $_POST["module"];
        $PersonalityTest_ = $_POST["PersonalityTest"];
        $A180_ = $_POST["180"];
        $A360_ = $_POST["360"];
        $KnowledgeAssessment_ = $_POST["KnowledgeAssessment"];
        $CulturePulse_ = $_POST["CulturePulse"];
        $CompitencyGap_ = $_POST["CompitencyGap"];
        $rating_ = $_POST["rating"];
        $percent_ = $_POST["percent"];
        $number_ = $_POST["number"];

        // Validate if Client already exists
        $sql_check_client = "SELECT COUNT(*) AS count FROM `assessment_results` WHERE `CompanyName` = '$CompanyName_'";
        $result_check_client = mysqli_query($conn, $sql_check_client);
        $row_check_client = mysqli_fetch_assoc($result_check_client);
        if ($row_check_client["count"] > 0) {
            echo json_encode([
                "statusCode" => 400,
                "message" => "Company already exists.",
            ]);
            return;
        }
        if (strlen($client_name_) > 0) {
            $sql = "INSERT INTO `assessment_results`(`CompanyName`,`batch`,`module`,`PersonalityTest`,`180`,`360`,`KnowledgeAssessment`,`CulturePulse`,`CompitencyGap`,`rating`,`percent`,`number`)
				VALUES ('$CompanyName_','$batch_','$module_','$PersonalityTest_','$A180_','$A360_','$KnowledgeAssessment_','$CulturePulse_','$CompitencyGap_','$rating_','$percent_','$number_')";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(["statusCode" => 200]);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        } else {
            echo json_encode([
                "statusCode" => 400,
                "message" => "Company name is required",
            ]);
            return;
        }
    }
}
if (count($_POST) > 0) {
    if ($_POST["type"] == 2) {
        $id = $_POST["id"];
        $CompanyName_ = $_POST["CompanyName"];
        $batch_ = $_POST["batch"];
        $module_ = $_POST["module"];
        $PersonalityTest_ = $_POST["PersonalityTest"];
        $A180_ = $_POST["180"];
        $A360_ = $_POST["360"];
        $KnowledgeAssessment_ = $_POST["KnowledgeAssessment"];
        $CulturePulse_ = $_POST["CulturePulse"];
        $CompitencyGap_ = $_POST["CompitencyGap"];
        $rating_ = $_POST["rating"];
        $percent_ = $_POST["percent"];
        $number_ = $_POST["number"];

        // Validate if Client already exists
        $sql_check_client = "SELECT COUNT(*) AS count FROM `assessment_results` WHERE `CompanyName` = '$CompanyName_' AND `ID` NOT IN($id)";
        $result_check_client = mysqli_query($conn, $sql_check_client);
        $row_check_client = mysqli_fetch_assoc($result_check_client);
        if ($row_check_client["count"] > 0) {
            echo json_encode([
                "statusCode" => 400,
                "message" => "Company already exists.",
            ]);
            return;
        } else {
            if (strlen($name) > 0) {
                $sql = "UPDATE `assessment_results` SET `CompanyName`='$CompanyName_',`batch`='$batch_',`module`='$module_',`PersonalityTest`='$PersonalityTest_',`180`='$A180',`360`='$A360',`KnowledgeAssessment`='$KnowledgeAssessment_',`CulturePulse`='$CulturePulse_',`CompitencyGap`='$CompitencyGap_',`rating`='$rating_',`percent`='$percent_',`number`='$number_'WHERE `ID`='$id_'";
                if (mysqli_query($conn, $sql)) {
                    echo json_encode(["statusCode" => 200]);
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_close($conn);
            } else {
                echo json_encode([
                    "statusCode" => 400,
                    "message" => "Company name is required",
                ]);
                return;
            }
        }
    }
}
if (count($_POST) > 0) {
    if ($_POST["type"] == 3) {
        $id = $_POST["id"];
        $sql = "DELETE FROM `assessment_results` WHERE ID=$id ";
        if (mysqli_query($conn, $sql)) {
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
if (count($_POST) > 0) {
    if ($_POST["type"] == 4) {
        $id = $_POST["id"];
        $sql = "DELETE FROM assessment_results WHERE ID in ($id)";
        if (mysqli_query($conn, $sql)) {
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}

?>
