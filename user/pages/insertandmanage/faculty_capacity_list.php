<?php
include '../connection.php';
include '../check.php';
if (($AccountLevel == 2) || ($AccountLevel== 3)){
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="pages/insertandmanage/faculty_capacity_list_ajax.js"></script>
	<script>
	$(document).on('click','#btn-add',function(e) {
	
	var data = $("#user_form").serialize();
	$.ajax({
		data: data,
		type: "POST",
		url: "pages/insertandmanage/backend/Faculty_capacity_list_backend.php",
		
		success: function(dataResult){
			alert(dataResult);//sql error
			var dataResult = JSON.parse(dataResult);
			if(dataResult.statusCode==200){
				$('#addEmployeeModal').modal('hide');
				alert('Data added successfully !'); 
				location.reload();						
			}
			if(dataResult.statusCode==400){
			   alert(dataResult.message);
			}
		}
	}); 
	e.preventDefault();
});
 
</script>
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
		max-width: 800px;
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
			<h4 class="card-title mb-4 mt-4 mb-xl-4">Faculty Capacity</h4>
			<p id="success"></p>
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-md-6">
							<!-- <input type="text" class="form-control" id="exampleInputName1" placeholder="Search Client No or Name" name="name"> -->
						</div>
						<div class="col-md-6">
							<div class="justify-content-between">
								<!-- <a href="JavaScript:void(0);" class="btn btn-danger btn-sm float-right" id="delete_multiple"><span>Delete</span></a>			 -->
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
								<th style="display: none;">Capacity ID</th>
								<th>Calling Name</th>
								<th>Type (Consulting / Training)</th>
								<th>Year</th>
								<th>Monday</th>
								<th>Tuesday</th>
								<th>Wednesday</th>
								<th>Thursday</th>
								<th>Friday</th>
								<th>Saturday</th>
								<th>Sunday</th>
								<th>Days per month</th>
								<th>Total Capacity</th>
								<th>Utilized Capacity</th>
								
							</tr>
						</thead>
						<tbody>

						<?php
							$result = mysqli_query($conn, "SELECT * FROM  faculty_capacity ORDER BY callingName ASC");
							$i = 1;
							while ($row = mysqli_fetch_array($result)) {
								//AMC
								$today = date('Y-m-d');
								$clientid = $row["capacityId"];
							?>
								<tr class="border-bottom" id="<?php echo $row["capacityId"]; ?>">
									<td>
									<a href="#editFacultyModal" class="edit" data-toggle="modal">
										<!--<a href="#editEmployeeModal" class="edit" data-toggle="modal">-->
										<i class="material-icons update" data-toggle="tooltip"
											data-id="<?php echo $row["capacityId"]; ?>" 
											data-name="<?php echo $row["callingName"]; ?>"
											data-type1="<?php echo $row["type"]; ?>" 
											data-year="<?php echo $row["year"]; ?>"
											data-monday="<?php echo $row["monday"]; ?>" 
											data-tuesday="<?php echo $row["tuesday"]; ?>" 
											data-wednesday="<?php echo $row["wednesday"]; ?>" 
											data-thursday="<?php echo $row["thursday"]; ?>" 
											data-friday="<?php echo $row["friday"]; ?>" 
											data-saturday="<?php echo $row["saturday"]; ?>" 
											data-sunday="<?php echo $row["sunday"]; ?>" 
											data-dayspermonth="<?php echo $row["daysPerMonth"]; ?>" 
											data-total_avalability="<?php echo $row["TotalDaysPerYear"]; ?>" 
											data-capacity="<?php echo $row["capacity"]; ?>" title="Edit"></i>
										</a>
										<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["capacityId"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete"></i></a>
									</td>

									<td style="display: none;"> <?php $Recordid = str_pad($row["capacityId"], 5, '0', STR_PAD_LEFT); ?>
									
									<td><?php echo $row["callingName"]; ?></td>
									<td><?php echo $row["type"]; ?></td>
									<td><?php echo $row["year"]; ?></td>
									
									<td>
        <input type="checkbox" <?php echo ($row["monday"] == 'yes') ? 'checked' : ''; ?> disabled>
    </td>
    <td>
        <input type="checkbox" <?php echo ($row["tuesday"] == 'yes') ? 'checked' : ''; ?> disabled>
    </td>
    <td>
        <input type="checkbox" <?php echo ($row["wednesday"] == 'yes') ? 'checked' : ''; ?> disabled>
    </td>
    <td>
        <input type="checkbox" <?php echo ($row["thursday"] == 'yes') ? 'checked' : ''; ?> disabled>
    </td>
    <td>
        <input type="checkbox" <?php echo ($row["friday"] == 'yes') ? 'checked' : ''; ?> disabled>
    </td>
    <td>
        <input type="checkbox" <?php echo ($row["saturday"] == 'yes') ? 'checked' : ''; ?> disabled>
    </td>
    <td>
        <input type="checkbox" <?php echo ($row["sunday"] == 'yes') ? 'checked' : ''; ?> disabled>
    </td>
								
									<td><?php echo $row["daysPerMonth"]; ?></td>
									<td><?php echo $row["TotalDaysPerYear"]; ?></td>
									<td><?php echo $row["capacity"]; ?></td>
									<td>
									</td>
									</td>
								</tr>
							<?php
								$i++;
							}
							?>
						</tbody>
					</table>
				</div>

<!-- Add Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form id="user_form">
								<div class="modal-header">
									<h4 class="modal-title">Add New Faculty</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
									  <label>Calling Name</label>
										<select class="form-control" id="name" name="name">
											<?php
											$sql = "SELECT callingName , callingName FROM   faculty";
											$result = mysqli_query($conn, $sql);

											if (mysqli_num_rows($result) > 0) {
												while ($row = mysqli_fetch_assoc($result)) {
													echo "<option value=" . $row["callingName"] . ">" . $row["callingName"] . "</option>";
												}
											} else {
												echo '<option value="0">No Clients</option>';
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Type (Consulting / Training)</label>
										<select id="type1" name="Type1" class="form-control" required>
											<option value="Consulting">Consulting</option>
											<option value="training">Training</option>
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

									   <?php
                    $daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
                    foreach ($daysOfWeek as $day) {
                        echo "
                        <div class=\"form-group\">
                            <label>$day</label>
                            <select id=\"$day\" name=\"$day\" class=\"form-control\" autocomplete=\"off\" required>
                                <option value=\"yes\">Yes</option>
                                <option value=\"no\">No</option>
                            </select>
                        </div>";
                    }
                    ?>				<div class="form-group">
										<label>Days per month</label>
										<select id="daysPerMonth" name="daysPerMonth" class="form-control" required onchange="calculateTotal('total', 'daysPerMonth', 'Capacity')">
											<!-- Loop to generate options from 1 to 30 -->
											<?php for ($i = 1; $i <= 30; $i++) : ?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php endfor; ?>
										</select>
									</div>

									<div class="form-group">
										<label>Total Capacity</label>
										<input type="text" id="total" name="total" class="form-control" autocomplete="off" required>
											</div>

									<div class="form-group">
										<label>Utilized Capacity</label>
										<input type="text" id="Capacity" name="Capacity" class="form-control" autocomplete="off" required>
									</div>


									<script>
        $(document).ready(function() {
            $('#daysPerMonth').on('change', calculateCapacity);
            $(document).on('change', '.module-checkbox, .start-date, .end-date', calculateCapacity);

            function calculateCapacity() {
                var daysPerMonth = parseInt($('#daysPerMonth').val());
                var totalDaysPerYear = daysPerMonth * 12;

                // Calculate utilized days for each faculty
                var facultyUtilization = {};

                $('.module-checkbox:checked').each(function() {
                    var moduleDetails = $(this).siblings('.module-details');
                    var startDate = new Date(moduleDetails.find('.start-date').val());
                    var endDate = new Date(moduleDetails.find('.end-date').val());
                    var facultyName = $(this).val().split(' - ')[1];

                    if (!isNaN(startDate) && !isNaN(endDate)) {
                        var diffTime = Math.abs(endDate - startDate);
                        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                        if (facultyUtilization[facultyName]) {
                            facultyUtilization[facultyName] += diffDays;
                        } else {
                            facultyUtilization[facultyName] = diffDays;
                        }
                    }
                });

                // Display total and utilized capacity
                $('#total').val(totalDaysPerYear);
                
                // For demonstration, just show the utilization of a specific faculty member (e.g., "Faculty 1")
                var specificFaculty = "Faculty 1"; // Change this to the specific faculty you want to display
                $('#Capacity').val(facultyUtilization[specificFaculty] || 0);
                
                // You may also want to dynamically display utilization for all faculty members
                // e.g., update a table or list with facultyUtilization data
            }
        });
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


















<!--<div>
<div class="col-12 grid-margin">
<div class="card">
<div class="card-body">
<h4 class="card-title mb-4 mt-4 mb-xl-4">Declarations & Commitments</h4>
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
					<th>Duration</th>
					<th>Description</th>
          			
					
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
						data-duration_u="<?php echo $row["duration"]; ?>"
						data-description_u="<?php echo $row["description"]; ?>"
						data-lecturer_u="<?php echo $row["lecturer"]; ?>" 
						data-assessmentcb_u="<?php echo $row["Assessment"]; ?>"
					
						title="Edit"></i>
					</a>
					<a href="#deleteEmployeeModal" class="delete" data-module_id_d="<?php echo $row["ModuleID"];?>" data-toggle="modal"><i class="material-icons" title="Delete"></i></a>
					
				</td>
				<?php $Recordid = str_pad($row["ModuleID"], 5, '0', STR_PAD_LEFT); ?>
				<td><?php echo 'C'.$Recordid; ?></td>
				<td><?php echo $row["ModuleName"]; ?></td>
				<td><?php echo $row["duration"]; ?></td>
				<td><?php echo $row["description"]; ?></td>
				<td><?php echo $row["lecturer"]; ?></td>
				<td>
    
</td>

				<td>-->
                    <!-- "Add Session Plans" button moved here 
                    <a href="#" class="btn btn-sm btn-primary add-session" data-toggle="modal" data-target="#addSessionPlansModal" data-ModuleID="<?php echo $row["ModuleID"]; ?>">Add Session Plans</a>
                    <a href="#viewContactsModal" class="btn btn-secondary btn-sm view-contacts" data-toggle="modal" data-ModuleID="<?php echo $row["ModuleID"]; ?>" data-clientname="<?php echo $row["ModuleName"]; ?>">View Session Plans</a>
				</td>
			</tr>
			<?php
			$i++;
				}
			?>
			</tbody>
		</table>
    </div>-->
		


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
</div>-->

<!-- View Session Plans Modal HTML 
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
							<!-- Session plans data will be populated here using JavaScript 
						</tbody>
					</table>
				</div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Close">
            </div>
        </div>
    </div>
</div>-->



<!-- Add Modal HTML 
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog" style="max-width: 50%;">
		<div class="modal-content">
			<form id="user_form">
				<div class="modal-header">						
					<h4 class="modal-title">Add Declarations & Commitments</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label><b>Your availability to conduct programs</b></label> 
						<p>Time is what we market, so in order to market your skill set we need to know how much time you can commit per month to delivering them. Select the most viable options for you for both in person and online sessions.</p>
						<table>
							<tr>
								<th></th>
								<th>Once a month</th>
								<th>Twice a month</th>
								<th>Thrice a month</th>
								<th>Weekly</th>
							</tr>
							<?php
								$availabilityOptions = array("Weekends ", "Weekdays - Full day ", "Weekday evenings -After 4PM ", "Weekday Mornings - Half Day");

								foreach ($availabilityOptions as $option) {
									echo "<tr>";
									echo "<td>$option</td>";
									echo "<td><input type='checkbox' name='Once a month[]' value='$option'></td>";
									echo "<td><input type='checkbox' name='Twice a month[]' value='$option'></td>";
									echo "<td><input type='checkbox' name='Thrice a month[]' value='$option'></td>";
									echo "<td><input type='checkbox' name='Weekly[]' value='$option'></td>";
									echo "</tr>";
								}
							?>
						</table>
					</div>
					</div>

<style>
	
    .linear-scale {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px; /* Adjust as needed */
    }

    .linear-scale label {
        text-align: center;
        width: 100px; /* Adjust as needed */
        margin: 0;
    }

	.linear-scale label:nth-child(1) { 
        margin-right: 5 px; /* Adjust as needed */
    }

    .linear-scale label:nth-child(2) {
        margin-right: 15px; /* Adjust as needed */
    }

    .linear-scale label:nth-child(3) {
        margin-right: 25px; /* Adjust as needed */
    }

    .linear-scale label:nth-child(4) {
        margin-right: 15px; /* Adjust as needed */
    }

    .linear-scale label:nth-child(5) {
        margin-right: 5px; /* Adjust as needed */
    }

    .modal-body {
        margin-bottom: 20px; /* Adjust as needed */
    }

    .form-check {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-right: 0; /* Adjust as needed */
    }

    .form-check-label {
        margin-right: 10px; /* Adjust as needed */
    }

    /* Added styles to vertically align checkboxes in the middle */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        text-align: center;
        padding: 5px;
    }

    table td input {
        margin: auto;
        display: block;
    }

	.linear-scale-numbers {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0 5%; /* Adjust as needed */
    }

	.linear-scale-numbers {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        margin: 0 5%;
                        /* Adjust as needed */
                    }
</style>

   
                
<!--<div class="modal-body">
<div class="form-group">
    <label><b>How experienced are you with online training delivery using Teams, Zoom, and other online learning platforms?</b></label>

    <div class="linear-scale">
        <label>1</label>
        <label>2</label>
        <label>3</label>
        <label>4</label>
        <label>5</label>
    </div>
	
    <div class="linear-scale">
        <span class="experience-label">Not at all experienced</span>
        <input type="radio" name="experience" value="1">
        <input type="radio" name="experience" value="2">
        <input type="radio" name="experience" value="3">
        <input type="radio" name="experience" value="4">
        <input type="radio" name="experience" value="5">
        <span class="experience-label">Extremely experienced</span>
    </div>
</div>
				</div>
<div class="modal-body"> 
<div class="form-group">
    <label><b>Declaration</b></label>
    <p>
        I agree to maintain the highest standards of quality and work at all times, be a supportive and available colleague to my fellow faculty, and be a fully participative and responsive team member to the Sandbox team. I agree that all deliverables expected from me towards a program will be delivered on time & that I will contribute to my fullest ability in continuing to develop and innovate content together as a team.
    </p>

	<div class="form-check">
        <input type="radio" class="form-check-input" id="yesRadio" name="declaration" value="yes" required>
           <label class="form-check-label" for="yesRadio">Yes</label>
    </div>

    <div class="form-check">
        <input type="radio" class="form-check-input" id="noRadio" name="declaration" value="no" required>
           <label class="form-check-label" for="noRadio">No</label>
    </div>
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
				</div> -->



<!-- Edit Modal HTML 
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
							<label>Duration</label>
							<input type="text" id="moduleduration_u" name="moduleduration" class="form-control" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label>Description</label>
							<input type="text" id="moduledesc_u" name="moduledesc" class="form-control" autocomplete="off" required>
						</div>	
						<div class="form-group">
							<label>Lecturer</label>
							<input type="text" id="lecturername_u" name="lecturername" class="form-control" autocomplete="off" required>
						</div>	
						<div class="form-group">
    						<label>Assessment (Yes/No)</label>
    						<input type="hidden" name="assessmentcb" value="off">
							<input type="checkbox" id="assessmentcb_u" name="assessmentcb" value="on">

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
</div>-->
<!-- Delete Modal HTML 
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
</div>-->
