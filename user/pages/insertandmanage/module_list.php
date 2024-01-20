<?php
include '../connection.php';
include '../check.php';
if (($AccountLevel == 2) || ($AccountLevel== 3)){
    echo "You do not have permission to access this page.";
    exit;
	echo json_encode(['success' => true]);
	
}



?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Data</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/customcss.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="pages/insertandmanage/module_ajax.js"></script>


<style>

body {
    font-family: Arial, sans-serif;
    background-color: #fffdfc;
    position: relative;
}

.container {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    background-color: white;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
    max-width: 800px;
    margin: 20px auto;
    border-collapse: collapse;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #f8f8f8;
    font-weight: bold;
}

@media screen and (max-width: 600px) {
    table, thead, tbody, th, td, tr {
        display: block;
    }

    thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }

    tr { margin: 0 0 1rem 0; }

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



/* The download button has a green color */
table .download-btn {
    background-color: #4CAF50;
}

table .download-btn:hover {
    background-color: #45a049;
}

/* The delete button has a red color */
table .delete-btn {
    background-color: #f44336;
}

table .delete-btn:hover {
    background-color: #da190b;
}

</style>
<body>
<div class="col-12 grid-margin">
<div class="card">
<div class="card-body">
<h4 class="card-title mb-4 mt-4 mb-xl-4">Module</h4>
<p id="success"></p>
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-md-6">    		
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
					<th>Module ID</th>
					<th>Module Name</th>
                    <th>Module Type</th>
					<th>Duration</th>
					<th>Description</th>
          			<th>Primary Faculty</th>
					<th>Secondary Faculty</th>
					<th>Tertiary Faculty</th>
					<th>Assessments</th>
					<th></th>
					
				</tr>
			</thead>
			<tbody>
			
			<?php
			$result = mysqli_query($conn,"SELECT * FROM module ORDER BY ModuleID ASC");
			$ClientName="";
				$i=1;
				while($row = mysqli_fetch_array($result)) {
				?>
				<tr class="border-bottom" id="<?php echo $row["ModuleID"]; ?>">
				<td>
					<a href="#editEmployeeModal" class="edit" data-toggle="modal">
						<i class="material-icons update"
						data-ModuleID_u="<?php echo $row["ModuleID"]; ?>"
						data-ModuleName_u="<?php echo $row["ModuleName"]; ?>"
                        data-moduletype_u="<?php echo $row["moduleType"]; ?>"
						data-duration_u="<?php echo $row["duration"]; ?>"
						data-description_u="<?php echo $row["description"]; ?>"
						data-primaryFaculty_u="<?php echo $row["primaryFaculty"]; ?>"
						data-secondaryFaculty_u="<?php echo $row["secondaryFaculty"]; ?>"
						data-tertiaryFaculty_u="<?php echo $row["tertiaryFaculty"]; ?>" 
						data-assessmentcb_u="<?php echo $row["Assessment"]; ?>"
					
						title="Edit"></i>
					</a>
					<a href="#deleteEmployeeModal" class="delete" data-module_id_d="<?php echo $row["ModuleID"];?>" data-toggle="modal"><i class="material-icons" title="Delete"></i></a>
					
				</td>
				<?php $Recordid = str_pad($row["ModuleID"], 5, '0', STR_PAD_LEFT); ?>
				<td><?php echo 'C'.$Recordid; ?></td>
				<td><?php echo $row["ModuleName"]; ?></td>
                <td><?php echo $row["moduleType"]; ?></td>
				<td><?php echo $row["duration"]; ?></td>
				<td><?php echo $row["description"]; ?></td>
				<td><?php echo $row["primaryFaculty"]; ?></td>
				<td><?php echo $row["secondaryFaculty"]; ?></td>
				<td><?php echo $row["tertiaryFaculty"]; ?></td>
				<!-- Inside your form -->
				<td><input type="text" id="hiddenModuleID" name="hiddenModuleID" value="<?php echo $row["ModuleID"]; ?>"></td>

				<td>
    				<select disabled>
        				<option value="yes" <?php echo ($row["Assessment"] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
        				<option value="no" <?php echo ($row["Assessment"] == 'No') ? 'selected' : ''; ?>>No</option>
    				</select>
				</td>

				<td>
                    <!-- "Add Session Plans" button moved here -->
                    <a href="#" class="btn btn-sm btn-primary add-session"
   data-toggle="modal"
   data-target="#addSessionPlansModal"
   data-ModuleID="<?php echo $row["ModuleID"]; ?>"
   onclick="showModuleID(<?php echo $row['ModuleID']; ?>)">
   Add Session Plans
</a>

                    <a href="#viewContactsModal" class="btn btn-secondary btn-sm view-contacts" data-toggle="modal" data-ModuleID="<?php echo $row["ModuleID"]; ?>" data-clientname="<?php echo $row["ModuleName"]; ?>">View Session Plans</a>
				</td>
			</tr>
			<?php

			$i++;
				}
			?>

<div id="addSessionPlansModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="session_plans_form" enctype="multipart/form-data">
                <div class="modal-header">						
                    <h4 class="modal-title">Add Session Plans</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="moduleId" name="moduleId" class="form-control" required>
                    <div class="form-group">
                        <label>Upload Session Plans (Max: 150MB)</label>
                        <input type="file" name="session_plans[]" accept=".pdf, .xlsx, .xls" multiple required>
                    </div>
                    <!-- Here you can display the uploaded files, and have options to download or delete them -->
                    <div class="uploaded-files">
                        <!-- Files will be displayed here with JavaScript after uploading -->
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
			</tbody>
		</table>
    </div>
		


<!-- Add Session Plans Modal HTML 
<div id="addSessionPlansModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="session_plans_form" enctype="multipart/form-data">
                <div class="modal-header">						
                    <h4 class="modal-title">Add Session Plans</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="course_id_s" name="course_id_s" class="form-control" required>
                    <div class="form-group">
                        <label>Upload Session Plans (Max: 150MB)</label>
                        <input type="file" name="session_plans[]" accept=".pdf, .xlsx, .xls" multiple required>
                    </div>
                    <!-- Here you can display the uploaded files, and have options to download or delete them 
                    <div class="uploaded-files">
                        <!-- Files will be displayed here with JavaScript after uploading 
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div-->


<!-- Add Session Plans Modal HTML -->


<!-- View Session Plans Modal HTML -->
<div id="viewSessionPlansModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">						
				<h4 class="modal-title">View Session Plans for <span id="session-name-display"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
				<div class="table-responsive">
					<table id="session-plans-table" class="table table-hover">
						<thead>
							<tr>
								<th>File Name</th>
								<th>Actions</th>
								<th> Date</th>
							</tr>
						</thead>
						<tbody>
							<!-- Session plans data will be populated here using JavaScript -->
						</tbody>
					</table>
				</div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Close">
            </div>
        </div>
    </div>
</div>



<!-- Add Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="user_form">
				<div class="modal-header">						
					<h4 class="modal-title">Add module</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Module Name</label> 
						<input type="text" id="Module_Name" name="Module_Name" class="form-control" autocomplete="off" required>
					</div>
                    <div class="form-group">
    						<label for="duration">Module Type</label>
    						<select id="Module_Type" name="Module_Type" class="form-control" autocomplete="off" required>
        							<option value="Trainning">Training</option>
        							<option value="Consulting">Consulting</option>
        							
   							</select>
						</div>
					<div class="form-group">
    						<label for="duration">Duration</label>
    						<select id="duration" name="duration" class="form-control" autocomplete="off" required>
        							<option value="2h">2 hours</option>
        							<option value="4h">4 hours</option>
        							<option value="8h">8 hours</option>
   							</select>
						</div>
					<div class="form-group">
						<label>Description</label> 
						<input type="text" id="description" name="description" class="form-control" autocomplete="off" required>
					</div>

					<div class="form-group">
					<label for="facultyType">Primary Faculty</label>
    					<select id="primary" name="faculty" class="form-control" autocomplete="off" required>
								<option value="Angelo de Silva">Angelo de Silva</option>
           						<option value="tilak">Tilak Rahulan</option>
            					<option value="Chandana Pathirage">Chandana Pathirage</option>
            					<option value="Angelo de Silva">Rukshan De Silva</option>
            					<option value="Mendaka">Mendaka Hettithantri</option>
            					<option value="Chandana Pathirage">Thilani Ariyaratne</option>
    					</select>
					</div>

					<div class="form-group">
					<label for="facultyType">Secondary Faculty</label>
    					<select id="secondary" name="Sfaculty" class="form-control" autocomplete="off" required>
								<option value="Angelo de Silva">Angelo de Silva</option>
           						<option value="tilak">Tilak Rahulan</option>
            					<option value="Chandana Pathirage">Chandana Pathirage</option>
            					<option value="Angelo de Silva">Rukshan De Silva</option>
            					<option value="Mendaka">Mendaka Hettithantri</option>
            					<option value="Chandana Pathirage">Thilani Ariyaratne</option>
    					</select>
					</div>

					<div class="form-group">
					<label for="facultyType">Tertiary Faculty</label>
    					<select id="Tertiary" name="Tfaculty" class="form-control" autocomplete="off" required>
								<option value="Angelo de Silva">Angelo de Silva</option>
           						<option value="tilak">Tilak Rahulan</option>
            					<option value="Chandana Pathirage">Chandana Pathirage</option>
            					<option value="Angelo de Silva">Rukshan De Silva</option>
            					<option value="Mendaka">Mendaka Hettithantri</option>
            					<option value="Chandana Pathirage">Thilani Ariyaratne</option>
    					</select>
					</div>

					<div class="form-group">
    					<label for="assessmentSelect">Assessment</label>
    							<select id="assessmentSelect" name="assessmentSelect">
        							<option value="yes">Yes</option>
        							<option value="no">No</option>
    							</select>
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



<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="update_form">
				<div class="modal-header">						
					<h4 class="modal-title">Edit Module</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="module_id_u" name="moduleid" class="form-control" required>	
					<div class="modal-body">					
						<div class="form-group">
							<label>Module Name</label>
							<input type="text" id="modulename_u" name="modulename" class="form-control" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label>Module type</label>
							<input type="text" id="moduletype_u" name="moduletype" class="form-control" autocomplete="off" required>
						</div>
						<div class="form-group">
    						<label for="moduleduration_u">Duration</label>
    						<select id="moduleduration_u" name="moduleduration" class="form-control" autocomplete="off" required>
        							<option value="2h">2 hours</option>
        							<option value="4h">4 hours</option>
        							<option value="8h">8 hours</option>
    								</select>
						</div>

						<div class="form-group">
							<label>Description</label>
							<input type="text" id="moduledesc_u" name="moduledesc" class="form-control" autocomplete="off" required>
						</div>	
						<div class="form-group">
							<label>Primary Faculty</label>
							<input type="text" id="primaryFaculty_u" name="primaryFaculty" class="form-control" autocomplete="off" required>
						</div>	
						<div class="form-group">
							<label>Secondary Faculty</label>
							<input type="text" id="secondaryFaculty_u" name="secondaryFaculty" class="form-control" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label>Tertiary Faculty </label>
							<input type="text" id="tertiaryFaculty_u" name="tertiaryFaculty" class="form-control" autocomplete="off" required>
						</div>
						<div class="form-group">
    					<label for="assessmentSelect">Assessment</label>
    							<select id="assessmentSelect" name="assessmentSelect">
        							<option value="yes">Yes</option>
        							<option value="no">No</option>
    							</select>
					</div>
    		        </div>
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
					<h4 class="modal-title">Delete Project</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_d" name="id" class="form-control">					
					<p>Are you sure you want to delete this project record?</p>
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

<script>
    function showModuleID(moduleID) {
        // Set the ModuleID in the hidden input
        document.getElementById('moduleId').value = moduleID;

        // Display the ModuleID in an alert (optional)
        alert("Clicked on Add Session Plans for Module ID: " + moduleID);
    }
</script>




			

</body>

