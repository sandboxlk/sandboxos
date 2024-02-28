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
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/customcss.css">
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="pages/insertandmanage/course_list_ajax.js"></script>

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
</style>
<div class="col-12 grid-margin">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title mb-4 mt-4 mb-xl-4">Courses</h4>
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
								<th>Course ID</th>
								<th>Course Code</th>
								<th>Course Name</th>
								<th>Course Type</th>
								<th>Module No</th>
								<th>Duration(h)</th>
								<th>Duration(Days)</th>

							</tr>
						</thead>
						<tbody>

							<?php
							$result = mysqli_query($conn, "SELECT * FROM courses ORDER BY courseID ASC");
							$ClientName = "";
							$i = 1;
							while ($row = mysqli_fetch_array($result)) {
							?>
								<tr class="border-bottom" id="<?php echo $row["courseID"]; ?>">
									<td>
										<a href="#editEmployeeModal" class="edit" data-toggle="modal">
											<i class="material-icons update" data-courseID_u="<?php echo $row["courseID"]; ?>" data-coursecode_u="<?php echo $row["courseCode"]; ?>" data-coursename_u="<?php echo $row["CourseName"]; ?>" data-coursename_u="<?php echo $row["CourseName"]; ?>" data-moduleno_u="<?php echo $row["moduleNo"]; ?>" data-courseduration_u="<?php echo $row["duration(h)"]; ?>" data-durationdays_u="<?php echo $row["duration(days)"]; ?>" title="Edit"></i>
										</a>
										<a href="#deleteEmployeeModal" class="delete" data-course_id_d="<?php echo $row["courseID"]; ?>" data-toggle="modal"><i class="material-icons" title="Delete"></i></a>
									</td>
									<?php $Recordid = str_pad($row["courseID"], 5, '0', STR_PAD_LEFT); ?>
									<td><?php echo 'C' . $Recordid; ?></td>
									<td><?php echo $row["courseCode"]; ?></td>
									<td><?php echo $row["CourseName"]; ?></td>
									<td><?php echo $row["CourseName"]; ?></td>
									<td><?php echo $row["moduleNo"]; ?></td>
									<td><?php echo $row["duration(h)"]; ?></td>
									<td><?php echo $row["duration(days)"]; ?></td>
								</tr>
							<?php
								$i++;
							}
							?>
						</tbody>
					</table>
				</div>

			</div>
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
					<h4 class="modal-title">Add Course</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Course Code</label>
						<input type="text" id="coursecode" name="coursecode" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Course Name</label>
						<input type="text" id="coursename" name="coursename" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label for="coursetype">Course Type</label>
						<select id="coursetype" name="coursetype" class="form-control" autocomplete="off" required>
							<option value="PLDP">PLDP</option>
							<option value="Capacity Building">Capacity Building</option>
							<option value="EDP">EDP</option>
							<option value="CSP">CSP</option>
							<option value="OAR">OAR</option>
							<option value="Team Experiences">Team Experiences</option>
						</select>
					</div>

					<div class="form-group">
						<label>Module No</label>
						<select id="moduleNo" name="moduleNo" class="form-control" autocomplete="off" onchange="calculateDurationDays()" required>
							<?php
							// Loop to generate options from 1 to 24
							for ($i = 1; $i <= 24; $i++) {
								echo "<option value=\"$i\">$i</option>";
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label>Duration(h)</label>
						<input type="text" id="duration" name="duration" class="form-control" autocomplete="off" oninput="calculateDurationDays()" required>
					</div>

					<div class="form-group">
						<label>Duration(days)</label>
						<input type="text" id="durdays" name="durdays" class="form-control" autocomplete="off" readonly>
						<span id="calculatedDurationDays"></span>
					</div>

					<!-- Add this JavaScript code at the bottom of your HTML, before the closing </script> tag -->

					<script>
						function calculateDurationDays() {
							// Get the values from the "Module No" and "Duration(h)" fields
							var moduleNo = document.getElementById("moduleNo").value;
							var durationHours = document.getElementById("duration").value;

							// Perform the calculation
							var durationDays = (moduleNo * 8) + parseFloat(durationHours); // assuming durationHours is a decimal value

							// Update the "Duration(days)" field and the <span> element
							document.getElementById("durdays").value = durationDays;
							document.getElementById("calculatedDurationDays").innerText = "Calculated Duration in Days: " + durationDays;
						}
					</script>



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
					<h4 class="modal-title">Edit Course</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="course_id_u" name="courseid" class="form-control" required>
					<div class="modal-body">
						<div class="form-group">
							<label>Course Code</label>
							<input type="text" id="coursecode_u" name="coursecode_u" class="form-control" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label>Course Name</label>
							<input type="text" id="coursename_u" name="coursename_u" class="form-control" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label>Course Type</label>
							<input type="text" id="coursetype_u" name="coursetype_u" class="form-control" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label>Module No</label>
							<input type="text" id="moduleno_u" name="moduleno_u" class="form-control" autocomplete="off" required>
						</div>
						<!--<div class="form-group">
							<label>Module Name</label>
							<input type="text" id="modulename_u" name="modulename_u" class="form-control" autocomplete="off" required>
						</div>
						<div class="form-group">
    					<label for="modulename">Module Name</label>
    					<select id="modulename_u" name="modulename_u" class="form-control" autocomplete="off" required>
        					<option value="Course1">Managing people 1</option>
        					<option value="Course2">Managing people 2</option>
        					<option value="Course3">Leadership Productivity</option>
							<option value="Course4">Change Management</option>
							<option value="Course5">Coaching Leadership</option>
							<option value="Course6">Finance</option>
							<option value="Course7">Leadership Presence</option>
							<option value="Course8">Entrepreneurial Mindset </option>
							<option value="Course9">Inspirational Leadership & Managing People</option>
							<option value="Course10">Managing pProductivity Projects and Tems</option>
							<option value="Course11">Decision Making & Critical Thinking</option>
							<option value="Course12">Negotiation & Communication Skills</option>
							<option value="Course13">Developing People</option>
							<option value="Course14">Transitioning & Productivity</option>
							<option value="Course15">Emotional Intelligence & Design Thinking & Service Experience</option>
							<option value="Course16">Productivity P1 & P2</option>
							<option value="Course17">Support Service Cluster Workshop</option>
							<option value="Course18">Goal Cenric Teams Alignment Workshop Cap Off Session</option>
							
        
    					</select>
					</div>-->
						<div class="form-group">
							<label>Duration(h)</label>
							<input type="text" id="courseduration_u" name="courseduration" class="form-control" autocomplete="off" required>
						</div>
						<!--<div class="form-group">
							<label>Duration(days)</label>
							<input type="text" id="durationdays_u" name="durationdays_u" class="form-control" autocomplete="off" required>
						</div>-->

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