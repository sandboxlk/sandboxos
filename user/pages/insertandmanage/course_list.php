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
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="pages/insertandmanage/course_list_ajax.js"></script>
<style>
	/* <uniquifier>: Use a unique and descriptive class name
<weight>: Use a value from 100 to 900*/

.inter-uniquifier> {
  font-family: "Inter", sans-serif;
  font-optical-sizing: auto;
  font-weight: <weight>;
  font-style: normal;
  font-variation-settings:
    "slnt" 0;
}
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
								<th style="display: none;">Course ID</th>
								<th>Course Name</th>
								<th>Course Code</th>
								<th>Course Category</th>
								<th>No of Full Day Modules</th>
								<th>Duration(h)</th>
								<th>Duration(Days)</th>
								<th>No of Half Day Modules</th>
								<th>Duration(h)</th>
								<th>Duration(Days)</th>
								<th>No of 2h Modules</th>
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
											<i class="material-icons update" 
											data-courseID_u="<?php echo $row["courseID"]; ?>" 
											data-coursename_u="<?php echo $row["CourseName"]; ?>"
											data-coursecode_u="<?php echo $row["courseCode"]; ?>"  
											data-coursetype_u="<?php echo $row["fmoduleNo"]; ?>" 
											data-moduleno_u="<?php echo $row["courseType"]; ?>" 
											data-courseduration_u="<?php echo $row["fduration(h)"]; ?>" 
											data-durationdays_u="<?php echo $row["fduration(days)"]; ?>" 
											data-moduleno_u="<?php echo $row["hModuleNo"]; ?>" 
											data-courseduration_u="<?php echo $row["hDuration(h)"]; ?>" 
											data-durationdays_u="<?php echo $row["hDuration(days)"]; ?>"
											data-moduleno_u="<?php echo $row["tModuleNo"]; ?>" 
											data-courseduration_u="<?php echo $row["tDuration(h)"]; ?>" 
											data-durationdays_u="<?php echo $row["tDuration(days)"]; ?>"title="Edit"></i>
										</a>
										<a href="#deleteEmployeeModal" class="delete" data-course_id_d="<?php echo $row["courseID"]; ?>" data-toggle="modal"><i class="material-icons" title="Delete"></i></a>
									</td>
									<td style="display: none;"><?php $Recordid = str_pad($row["courseID"], 5, '0', STR_PAD_LEFT); ?>
									<td><?php echo $row["CourseName"]; ?></td>
									<td><?php echo $row["courseCode"]; ?></td>
									<td><?php echo $row["fmoduleNo"]; ?></td>
									<td><?php echo $row["courseType"]; ?></td>
									<td><?php echo $row["fduration(h)"]; ?></td>
									<td><?php echo $row["fduration(days)"]; ?></td>
									<td><?php echo $row["hModuleNo"]; ?></td>
									<td><?php echo $row["hDuration(h)"]; ?></td>
									<td><?php echo $row["hDuration(days)"]; ?></td>
									<td><?php echo $row["tModuleNo"]; ?></td>
									<td><?php echo $row["tDuration(h)"]; ?></td>
									<td><?php echo $row["tDuration(days)"]; ?></td>
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
						<label>Course Name</label>
						<input type="text" id="coursename" name="coursename" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Course Code</label>
						<input type="text" id="coursecode" name="coursecode" class="form-control" autocomplete="off" required >
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
						<label for="coursetype">Course Category</label>
						<select id="coursetype" name="coursetype" class="form-control" autocomplete="off" required>
							<option value="PLDP">PLDP</option>
							<option value="CSP">CSP</option>
							<option value="Strategy">Strategy</option>
							<option value="Assessments">Assessments</option>
							<option value="Custom">Custom</option>
							<option value="Cap Building">Cap Building</option>
						</select>
					</div>
					<script>
    function generateCourseCode() {
        const courseName = document.getElementById('coursename').value;
        const year = document.getElementById('year').value;
        const courseType = document.getElementById('coursetype').value;

        if (courseName && year && courseType) {
            const shortCourseName = courseName.substring(0, 3).toUpperCase();
            const shortYear = year.slice(-2);
            const shortCourseType = courseType.substring(0, 3).toUpperCase();
            const courseCode = `SBCC-FY${shortYear}-${shortCourseType}-501`;
            document.getElementById('coursecode').value = courseCode;
        }
    }

    document.getElementById('coursename').addEventListener('input', generateCourseCode);
    document.getElementById('year').addEventListener('change', generateCourseCode);
    document.getElementById('coursetype').addEventListener('change', generateCourseCode);
</script>

					<script>
        document.getElementById('year').addEventListener('input', generateCourseCode);
        document.getElementById('coursetype').addEventListener('change', generateCourseCode);

        function generateCourseCode() {
            const year = document.getElementById('year').value.trim();
            const courseType = document.getElementById('coursetype').value;

            if (year === "" || courseType === "") {
                return;  // Do nothing if either field is empty
            }

            const shortYear = year.slice(2);  // Get the last two digits of the year
            const shortCourseType = courseType.substring(0, 3).toUpperCase();

            fetch(`getNextCourseNumber.php?year=${year}&courseType=${shortCourseType}`)
                .then(response => response.json())
                .then(data => {
                    const nextNumber = data.nextNumber;
                    const courseCode = `SBCC-FY${shortYear}-${shortCourseType}-${nextNumber}`;
                    document.getElementById('coursecode').value = courseCode;
                })
                .catch(error => console.error('Error fetching next course number:', error));
        }

        function calculateDurationFullDay() {
            const moduleNo = document.getElementById('moduleNo').value;
            const duration = document.getElementById('duration').value;
            if (moduleNo && duration) {
                document.getElementById('durdays').value = (parseInt(moduleNo) * parseInt(duration)) / 24;
            }
        }

        function calculateDurationHalfDay() {
            const moduleNoH = document.getElementById('moduleNoH').value;
            const durationh = document.getElementById('durationh').value;
            if (moduleNoH && durationh) {
                document.getElementById('durdaysh').value = (parseInt(moduleNoH) * parseInt(durationh)) / 12;
            }
        }

        function calculateDuration2hour() {
            const moduleNo2 = document.getElementById('moduleNo2').value;
            const duration2 = document.getElementById('duration2').value;
            if (moduleNo2 && duration2) {
                document.getElementById('durdays2').value = (parseInt(moduleNo2) * parseInt(duration2)) / 2;
            }
        }
    </script>
					<div class="form-group">
    <label>Full day Modules</label>
    <select id="moduleNo" name="moduleNo" class="form-control" autocomplete="off" onchange="calculateDurationFullDay()" required>
        <?php
        // Loop to generate options from 1 to 24 for full day modules
        for ($i = 0; $i <= 24; $i++) {
            echo "<option value=\"$i\">$i</option>";
        }
        ?>
    </select>
</div>

<div class="form-group">
    <label>Duration (h)</label>
    <input type="text" id="duration" name="duration" class="form-control" autocomplete="off" oninput="calculateDurationFullDay()" required>
</div>

<div class="form-group">
    <label>Duration (days)</label>
    <input type="text" id="durdays" name="durdays" class="form-control" autocomplete="off" readonly>
</div>

<div class="form-group">
    <label>Half day Modules</label>
    <select id="moduleNoH" name="moduleNoH" class="form-control" autocomplete="off" onchange="calculateDurationHalfDay()" required>
        <?php
        // Loop to generate options from 1 to 24 for half day modules
        for ($i = 0; $i <= 24; $i++) {
            echo "<option value=\"$i\">$i</option>";
        }
        ?>
    </select>
</div>

<div class="form-group">
    <label>Duration (h)</label>
    <input type="text" id="durationh" name="durationh" class="form-control" autocomplete="off" oninput="calculateDurationHalfDay()" required>
</div>

<div class="form-group">
    <label>Duration (days)</label>
    <input type="text" id="durdaysh" name="durdaysh" class="form-control" autocomplete="off" readonly>
</div>
<!--2h module-->
<div class="form-group">
    <label> 2h Programmes </label>
    <select id="moduleNo2" name="moduleNo2" class="form-control" autocomplete="off" onchange="calculateDuration2hour()" required>
        <?php
        // Loop to generate options from 1 to 24 for half day modules
        for ($i = 0; $i <= 24; $i++) {
            echo "<option value=\"$i\">$i</option>";
        }
        ?>
    </select>
</div>

<div class="form-group">
    <label>Duration (h)</label>
    <input type="text" id="duration2" name="duration2" class="form-control" autocomplete="off" oninput="calculateDurationHalfDay()" required>
</div>

<div class="form-group">
    <label>Duration (days)</label>
    <input type="text" id="durdays2" name="durdays2" class="form-control" autocomplete="off" readonly>
</div>

<script>
    
//full days
    function calculateDurationFullDay() {

        // Retrieve the selected number of full day modules
        var moduleNo = parseInt(document.getElementById('moduleNo').value);
        
        // Calculate duration in hours for full day modules
        var durationHours = moduleNo * 8;
        document.getElementById('duration').value = isNaN(durationHours) ? '' : durationHours;

        // Retrieve the entered duration in hours for full day modules
        var enteredHours = parseInt(document.getElementById('duration').value);

        // Calculate duration in days for full day modules
        var durationDays = isNaN(enteredHours) ? '' : enteredHours / 8;
        document.getElementById('durdays').value = isNaN(durationDays) ? '' : durationDays;
    }
//half days
    function calculateDurationHalfDay() {
        // Retrieve the selected number of half day modules
        var moduleNoH = parseInt(document.getElementById('moduleNoH').value);
        
        // Calculate duration in hours for half day modules (assuming 4 hours per module)
        var durationHoursH = moduleNoH * 4;
        document.getElementById('durationh').value = isNaN(durationHoursH) ? '' : durationHoursH;

        // Retrieve the entered duration in hours for half day modules
        var enteredHoursH = parseInt(document.getElementById('durationh').value);

        // Calculate duration in days for half day modules
        var durationDaysH = isNaN(enteredHoursH) ? '' : enteredHoursH / 4;
        document.getElementById('durdaysh').value = isNaN(durationDaysH) ? '' : durationDaysH;
    }
//2h days 
	function calculateDuration2hour() {
		// Retrieve the selected number of half day modules
        var moduleNo2 = parseInt(document.getElementById('moduleNo2').value);
		 // Calculate duration in hours for half day modules (assuming 4 hours per module)
        var durationHours2 = moduleNo2 * 2; // Each 2h programme is 2 hours
        document.getElementById('duration2').value = isNaN(durationHours2) ? '' : durationHours2;
		// Retrieve the entered duration in hours for half day modules
        var enteredHours2 = parseInt(document.getElementById('duration2').value);
		// Calculate duration in days for half day modules
        var durationDays2 = isNaN(enteredHours2) ? '' : enteredHours2 / 2;
        document.getElementById('durdays2').value = isNaN(durationDays2) ? '' : durationDays2;
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