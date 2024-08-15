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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="pages/insertandmanage/faculty_capacity_list_ajax.js"></script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Include Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
											<?php for ($i = 1; $i <= 30; $i++): ?>
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


<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="update_form">
				<div class="modal-header">                        
					<h4 class="modal-title">Edit Faculty Capacity</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="type" value="2"> <!-- This indicates an update operation -->
					<input type="hidden" name="capacity_id" id="capacity_id"> <!-- Hidden field for the ID -->

					<div class="form-group">
						<label>Calling Name</label>
						<input type="text" name="name" id="name_u" class="form-control" required>
					</div>

					<div class="form-group">
						<label>Type (Consulting / Training)</label>
						<select id="type1_u" name="Type1" class="form-control" required>
							<option value="Consulting">Consulting</option>
							<option value="Training">Training</option>
						</select>
					</div>

					<div class="form-group">
						<label>Year</label>
						<select id="year_u" name="year" class="form-control" required>
							<!-- Loop to generate year options -->
							<?php
							for ($i = 2023; $i <= 2050; $i++) {
								echo "<option value=\"$i\">$i</option>";
							}
							?>
						</select>
					</div>

					<!-- Loop for Days of the Week -->
					<?php
					$daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
					foreach ($daysOfWeek as $day) {
						echo "
                        <div class=\"form-group\">
                            <label>$day</label>
                            <select id=\"$day\" name=\"$day\" class=\"form-control\" required>
                                <option value=\"yes\">Yes</option>
                                <option value=\"no\">No</option>
                            </select>
                        </div>";
					}
					?>

					<div class="form-group">
						<label>Days per month</label>
						<select id="daysPerMonth_u" name="daysPerMonth" class="form-control" required>
							<?php for ($i = 1; $i <= 30; $i++): ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php endfor; ?>
						</select>
					</div>

					<div class="form-group">
						<label>Total Capacity</label>
						<input type="text" id="total_u" name="total" class="form-control" required>
					</div>

					<div class="form-group">
						<label>Utilized Capacity</label>
						<input type="text" id="Capacity_u" name="Capacity" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-info" id="update">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>

			
	<script>

$(document).on('click', '.delete', function(e) {
	var id = $(this).attr("data-id");
	if(confirm('Are you sure you want to delete this record?')) {
		$.ajax({
			url: 'pages/insertandmanage/backend/Faculty_capacity_list_backend.php',
			type: 'POST',
			data: { type: 3, facultyid: id },
			success: function(response){
				var responseData = JSON.parse(response);
				if(responseData.statusCode == 200){
					alert('Data deleted successfully!');
					location.reload();  
				} else {
					alert('Failed to delete data.');
				}
			},
			error: function(xhr, status, error){
				alert('An error occurred: ' + error);
				console.log(xhr.responseText);
			}
		});
	}
});

</script>
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