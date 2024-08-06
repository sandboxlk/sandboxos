<?php
include '../connection.php';
include '../check.php';
if (($AccountLevel == 2) || ($AccountLevel == 3)) {
	echo "You do not have permission to access this page.";
	exit;
}
?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Data</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="css/customcss.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="styles.css">

<style>
	body {
		font-family: Arial, sans-serif;
		background-color: #fffdfc;
		position: relative;
	}

	.container {
		width: 100%;
		max-width: 8000px;
		margin: 0 auto;
		background-color: white;
		padding: 20px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		border-radius: 8px;
	}

	h1 {
		text-align: center;
		color: #333;
	}



	input[type="file"] {
		margin-bottom: 20px;
	}

	button {
		padding: 10px 20px;
		background-color: #050505;
		color: white;
		border: none;
		border-radius: 5px;
		cursor: pointer;
	}



	/* Existing CSS code */

	table {
		width: 100%;
		max-width: 8000px;
		margin: 20px auto;
		border-collapse: collapse;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}

	th,
	td {
		border: 1px solid #ddd;
		padding: 8px;
		text-align: center;
	}

	th {
		background-color: #f8f8f8;
		font-weight: bold;
	}

	@media screen and (max-width: 600px) {

		table,
		thead,
		tbody,
		th,
		td,
		tr {
			display: block;
		}

		thead tr {
			position: absolute;
			top: -9999px;
			left: -9999px;
		}

		tr {
			margin: 0 0 1rem 0;
		}

		tr:nth-child(odd) {
			background: #f8f8f8;
		}

		td {
			border: none;
			border-bottom: 1px solid #eee;
			position: relative;
			padding-left: 50%;
		}

		td:before {
			position: absolute;
			top: 6px;
			left: 6px;
			width: 45%;
			padding-right: 10px;
			white-space: nowrap;
			content: attr(data-column);

			color: #000;
			font-weight: bold;
		}
	}

	/* Other CSS */

	table button {
		padding: 6px 10px;
		background-color: #050505;
		color: white;
		border: none;
		border-radius: 5px;
		cursor: pointer;
		margin: 2px;
		font-size: 0.8em;
	}
    .module-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .module-checkbox {
        margin-right: 10px;
    }

    .module-details {
        margin-left: 10px;
    }

    .date-picker-container {
    display: flex;
    align-items: center;
    margin-bottom: 10px; /* Optional: add spacing between date pickers */
}

.date-picker-label {
    width: 100px; /* Adjust width as needed for consistent alignment */
    margin-right: 10px;
    text-align: right; /* Right align the text */
}

.date-picker, .date-pick {
    flex: 1; /* Make input fields take the remaining space */
    margin-left: 10px;
}
.table-responsive {
    overflow-x: auto;
}

.table-fixed {
    table-layout: fixed;
    width: 100%;
}

.table-fixed th,
.table-fixed td {
    width: 200px; /* Adjust the width as needed */
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal; /* Allow text to wrap in table cells */
    word-wrap: break-word; /* Ensure long words break and wrap to the next line */
    font-size: 11px; /* Specify font size for table content */
}

.table-fixed th {
    font-size: 8px; /* Specify header font size */
    background-color: #f8f8f8;
    white-space: nowrap; /* Prevent text wrapping in the header */
    height: 20px; /* Adjust header row height */
    font-weight: normal; /* Remove bold from header */
}

/* Make the first column (edit/delete) smaller */
.table-fixed th:first-child,
.table-fixed td:first-child {
    width: 75px; /* Adjust the width for the first column */
}

.table-fixed td {
    padding: 8px;
    text-align: center;
    height: 20px; /* Adjust row height */
}

/* Left-align content in the "Modules and Assigned Faculty" column */
.table-fixed th:nth-child(7),
.table-fixed td:nth-child(7) {
    text-align: left;
}

.module-entry {
    margin-bottom: 10px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

.module-entry span {
    display: inline-block;
    vertical-align: middle;
}

.module-name,
.faculty-name,
.start-date-label,
.start-date,
.end-date-label,
.end-date {
    margin-right: 5px;
}

.module-name {
    width: 200px; /* Adjust width as needed */
}

.faculty-name {
    width: 150px; /* Adjust width as needed */
}

.start-date-label,
.end-date-label {
    font-weight: bold;
}

.start-date,
.end-date {
    width: 100px; /* Adjust width as needed */
}

<style>
    #modulefac {
        text-align: left; /* Ensure the content is left-aligned */
        white-space: pre-wrap; /* Ensure spaces and line breaks are preserved */
        font-family: Arial, sans-serif; /* Optional: Set a font */
        padding: 10px; /* Optional: Add some padding */
        border: 1px solid #ddd; /* Optional: Add a border */
        background-color: #f9f9f9; /* Optional: Add a background color */
    }
</style>
<div>

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4 mt-4 mb-xl-4">Create Batches</h4>
            <p id="success"></p>
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Search bar can be added here if needed -->
                        </div>
                        <div class="col-md-6">
                            <div class="justify-content-between">
                                <a href="#addEmployeeModal" class="btn btn-info btn-sm float-right" data-toggle="modal"><span>Add New</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="display: none;">Reg ID</th>
                                <th>Client</th>
                                <th>Batch ID</th>
                                <th>Year</th>
                                <th>Course</th>
                                <th>Modules and Assigned Faculty</th>
                                <th>Budget Participants</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
						<tbody>
                                <?php
                               $result = mysqli_query($conn, "SELECT * FROM create_batches ORDER BY client ASC");
                               if (!$result) {
                                   die("Query failed: " . mysqli_error($conn));
                               }
                               while ($row = mysqli_fetch_array($result)) {
                                   $Recordid = str_pad($row["RegistrationID"], 5, '0', STR_PAD_LEFT);
                               ?>
                               <tr class="border-bottom" id="<?php echo $row["RegistrationID"]; ?>">
                                   <td>
                                       <a href="#editEmployeeModal" class="edit" data-toggle="modal">
                                           <i class="material-icons update" data-toggle="tooltip"
                                           data-id="<?php echo $row["RegistrationID"]; ?>"
                                           data-Lead="<?php echo $row["clientName"]; ?>"
                                           data-Lead="<?php echo $row["lead"]; ?>"
                                           data-batchName="<?php echo $row["batchName"]; ?>"
                                           data-year="<?php echo $row["year"]; ?>"
                                           data-course="<?php echo $row["course"]; ?>"
                                           data-modulefaculty="<?php echo $row["moduleFaculty"]; ?>"
                                           data-budget="<?php echo $row["budgetParticipant"]; ?>"
                                           data-StartDate="<?php echo $row["StartDate"]; ?>"
                                           data-EndDate="<?php echo $row["EndDate"]; ?>" title="Edit"></i>
                                       </a>
                                       <a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["RegistrationID"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete"></i></a>
                                   </td>
                                   <td style="display: none;"> <?php $Recordid = str_pad($row["RegistrationID"], 5, '0', STR_PAD_LEFT); ?>
                                  
                                   <td><?php echo $row["clientName"]; ?></td>
                                   <td><?php echo $row["batchName"]; ?></td>
                                   
                            
                                   <td><?php echo $row["year"]; ?></td>
                                   <td><?php echo $row["course"]; ?></td>
                                   <td><?php echo $row["moduleFaculty"]; ?></td>
                                   
                                   <td><?php echo $row["budgetParticipant"]; ?></td>
                                   <td><?php echo $row["StartDate"]; ?></td>
                                   <td><?php echo $row["EndDate"]; ?></td>
                               </tr>
                               <?php
                               }
                               ?>
                           </tbody>
                       </table>
                   </div>
                   
                   


               <!-- Add Modal -->
<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="user_form" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Batch</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                <label>Client</label>
                        <select class="form-control" id="company" name="company" required>
                            <!-- Populate client options here -->
                            <?php
                            $sql_clients = "SELECT companyCode FROM clients";
                            $result_clients = mysqli_query($conn, $sql_clients);
                            if (mysqli_num_rows($result_clients) > 0) {
                                while ($row = mysqli_fetch_assoc($result_clients)) {
                                    echo "<option value='" . htmlspecialchars($row["companyCode"], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row["companyCode"], ENT_QUOTES, 'UTF-8') . "</option>";
                                }
                            } else {
                                echo '<option value="0">No Clients</option>';
                            }
                            ?>
                        </select>
                    </div>
                   
                    <div class="form-group">
                        <label>Course</label>
                        <select class="form-control" id="course" name="course" required>
                            <!-- Populate course options here -->
                            <?php
                            $sql_courses = "SELECT CourseName FROM courses";
                            $result_courses = mysqli_query($conn, $sql_courses);
                            if (mysqli_num_rows($result_courses) > 0) {
                                while ($row = mysqli_fetch_assoc($result_courses)) {
                                    echo "<option value='" . htmlspecialchars($row["CourseName"], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row["CourseName"], ENT_QUOTES, 'UTF-8') . "</option>";
                                }
                            } else {
                                echo '<option value="0">No Courses</option>';
                            }
                            ?>
                        </select>
                    </div>
                   
                    <div class="form-group">
                                        <label>Select Modules</label>
                                        <input type="hidden" id="modulefac" name="modulefac" class="form-control" autocomplete="off" required>
                                        <?php
                                        $sql_modules = "SELECT ModuleName, PrimaryFaculty FROM module";
                                        $result_modules = mysqli_query($conn, $sql_modules);
                                        if (mysqli_num_rows($result_modules) > 0) {
                                            while ($rowm = mysqli_fetch_assoc($result_modules)) {
                                                echo "<div class='module-container'>";
                                                echo "<input type='checkbox' class='module-checkbox' name='moduleFaculty[]' value='" . htmlspecialchars($rowm["ModuleName"], ENT_QUOTES, 'UTF-8') . " - " . htmlspecialchars($rowm["PrimaryFaculty"], ENT_QUOTES, 'UTF-8') . "'/>";
                                                echo "<div class='module-details'>";
                                                echo "<label>" . htmlspecialchars($rowm["ModuleName"], ENT_QUOTES, 'UTF-8') . " - " . htmlspecialchars($rowm["PrimaryFaculty"], ENT_QUOTES, 'UTF-8') . "</label>";
                                                echo "<div>";
                                                echo "<label class='date-picker-label' for='start-date-" . htmlspecialchars($rowm["ModuleName"], ENT_QUOTES, 'UTF-8') . "'>Start Date</label>";
                                                echo "<input type='date' id='start-date-" . htmlspecialchars($rowm["ModuleName"], ENT_QUOTES, 'UTF-8') . "' class='date-picker start-date' name='moduleStartDates[]' placeholder='Start Date'/>";
                                                echo "</div>";
                                                echo "<div>";
                                                echo "<label class='date-picker-label' for='end-date-" . htmlspecialchars($rowm["ModuleName"], ENT_QUOTES, 'UTF-8') . "'>End Date</label>";
                                                echo "<input type='date' id='end-date-" . htmlspecialchars($rowm["ModuleName"], ENT_QUOTES, 'UTF-8') . "' class='date-picker end-date' name='moduleEndDates[]' placeholder='End Date'/>";
                                                echo "</div>";
                                                echo "</div>";
                                                echo "</div>";
                                            }
                                        } else {
                                            echo '<p>No modules available.</p>';
                                        }
                                        ?>
                   
                    <div class="form-group">
                        <label>Batch</label>
                        <select id="batchno" name="batchno" class="form-control" required>
                            <?php
                            for ($i = 1; $i <= 50; $i++) {
                                echo "<option value=\"Batch $i\">Batch $i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <select id="year" name="year" class="form-control" autocomplete="off" required>
                            <?php
                            for ($i = 2023; $i <= 2050; $i++) {
                                echo "<option value=\"$i\">$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Budget Participants">Budget Participants</label>
                        <select id="budget" name="budget" class="form-control" autocomplete="off" required>
                            <?php
                            for ($i = 25; $i <= 100; $i++) {
                                echo "<option value=\"$i\">$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" id="StartDate" name="StartDate" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" id="EndDate" name="EndDate" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label>Batch ID</label>
                        <input type="text" id="batch" name="batch" class="form-control" autocomplete="off" required>
                    </div>
               
            
                <div class="modal-footer">
                    <input type="hidden" value="1" name="type">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="button" class="btn btn-success" id="btn-add">Insert</button>
                </div>
            </form>
        </div>
    </div>
</div>



                   <script>

$(document).ready(function() {
    $('#company, #year, #batchno, #course, #budget, #StartDate').on('change', updateBatchName);
    $(document).on('change', '.module-checkbox', function() {
        updateSelectedModulesTable();
    });
    $(document).on('change', '.start-date', function() {
        var startDate = $(this).val();
        var endDateInput = $(this).closest('.module-details').find('.end-date');
        endDateInput.val(startDate);
        updateSelectedModulesTable();
    });
    $(document).on('change', '.end-date', function() {
        updateSelectedModulesTable();
    });

    function updateBatchName() {
        var client = $('#company').val();
        var year = $('#year').val();
        var batchNo = $('#batchno').val();
        var course = $('#course').val();
        var budget = $('#budget').val();
        var startDate = $('#StartDate').val();

        if (client && year && batchNo && course && budget && startDate) {
            var month = new Date(startDate).toLocaleString('default', { month: '2-digit' });
            var shortYear = year.slice(-2);
            var batchNumber = 'B' + batchNo.replace('Batch ', '');
            var batchName = `SBBI-${month}-${shortYear}-${course}-${budget}-${batchNumber}`;
            $('#batch').val(batchName);
        }
    }

    function updateSelectedModulesTable() {
        var modulesContent = ""; 
        var index = 1;
        $('.module-checkbox:checked').each(function() {
            var moduleDetails = $(this).siblings('.module-details');
            var moduleName = $(this).val().split(' - ')[0];
            var primaryFaculty = $(this).val().split(' - ')[1];
            var startDate = moduleDetails.find('.start-date').val();
            var endDate = moduleDetails.find('.end-date').val();
            modulesContent += index + ". " + moduleName + " - " + primaryFaculty + "<br>" +
                "    Start Date: " + startDate + " - End Date: " + endDate + "<br><br>";
            index++;
        });
        $('#modulefac').val(modulesContent);
    }
});


                   </script>

					<!-- Edit Modal HTML -->
					<div id="editEmployeeModal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form id="update_form">
									<div class="modal-header">
										<h4 class="modal-title">Edit Registration informations</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<input type="hidden" id="id_u" name="id" class="form-control" required>
										<div class="form-group">
											<label>Client</label>
											<input type="text" id="company_u" name="company" class="form-control" required>
										</div>

										<div class="form-group">
											<label>Course</label>
											<input type="text" id="course_u" name="course" class="form-control" autocomplete="off" required>
										</div>
										<div class="form-group">
											<label>Year</label>
											<input type="text" id="year_u" name="year" class="form-control" autocomplete="off" required>
										</div>
										<div class="form-group">
											<label>Batch Name</label>
											<input type="text" id="batch_u" name="batch" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Budget Participants</label>
											<input type="email" id="budget_u" name="participant" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Start Date</label>
											<input type="Date" id="stardate_u" name="Startdate" class="form-control datepicker" required>
										</div>
										<div class="form-group">
											<label>End Date</label>
											<input type="Date" id="enddate_u" name="enddate" class="form-control datepicker" required>
										</div>
									</div>
									<div class="modal-footer">
										<input type="hidden" value="2" name="type">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
										<button type="button" class="btn btn-info" id="update">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- Delete Modal HTML -->
					<div id="deleteEmployeeModal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form>
									<div class="modal-header">
										<h4 class="modal-title">Delete Registration Record</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<input type="hidden" id="id_d" name="id" class="form-control">
										<p>Are you sure you want to delete this Record?</p>
										<p class="text-warning"><small>This action cannot be undone.</small></p>
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
										<button type="button" class="btn btn-danger" id="delete">Delete</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="pages/insertandmanage/create_batches_list_ajax.js"></script>