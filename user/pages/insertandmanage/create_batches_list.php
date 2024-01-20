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
	<link rel="stylesheet" href="css/customcss.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="pages/insertandmanage/create_batches_list_ajax.js"></script>
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
    max-width: 8000px;
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
					<th>Reg ID</th>
          			<th>Client</th>
					<th>Course</th>
					<th>Year</th>
					<th>Batch Name</th>
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
			
			$i = 1;
			while ($row = mysqli_fetch_array($result)) {
				// ... your code here ...
			//}
			
			//$result = mysqli_query($conn,"SELECT * FROM create_batches ORDER BY StudentName ASC");
				//$i=1;
				//    while($row = mysqli_fetch_array($result)) {
				//AMC
				$today = date('Y-m-d');
				$clientid = $row["RegistrationID"];	
			?>
			<tr class="border-bottom" id="<?php echo $row["RegistrationID"]; ?>">
			<td>
					<a href="#editEmployeeModal" class="edit" data-toggle="modal">
						<i class="material-icons update" data-toggle="tooltip" 
						data-id="<?php echo $row["RegistrationID"]; ?>"
						data-company="<?php echo $row["client"]; ?>"
						data-course="<?php echo $row["course"]; ?>"
						data-year="<?php echo $row["year"]; ?>"
						data-batch="<?php echo $row["batchName"]; ?>"
						data-budget="<?php echo $row["budgetParticipant"]; ?>"
						data-StartDate="<?php echo $row["StartDate"]; ?>"
						data-EndDate="<?php echo $row["EndDate"]; ?>"
						title="Edit"></i>
					</a>
					<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["RegistrationID"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						title="Delete"></i></a>
				</td>
        		<?php $Recordid = str_pad($row["RegistrationID"], 5, '0', STR_PAD_LEFT); ?>
				<td><?php echo "Reg";?><?php echo $Recordid; ?></td>
				<td><?php echo $row["client"]; ?></td>
				<td><?php echo $row["course"]; ?></td>
				<td><?php echo $row["year"]; ?></td>
				<td><?php echo $row["batchName"]; ?></td>
				<td><?php echo $row["budgetParticipant"]; ?></td>
				<td><?php echo $row["StartDate"]; ?></td>
				<td><?php echo $row["EndDate"]; ?></td>
				
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
					<h4 class="modal-title">Add new batch</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
				<div class="form-group">
						<label>Client</label>
						<select class="form-control" id="company" name="company">
							<?php
							$sql = "SELECT clientID, clientName FROM clients";
							$result = mysqli_query($conn, $sql);

							if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) {
								echo "<option value=" . $row["clientID"]. ">" . $row["clientName"]. "</option><br>";
							}
							} else {
							echo '<option value="0">No Clients</option>';
							}
							?>
                        </select>
					</div>
					<div class="form-group">
						<label>Course</label>
						<select class="form-control" id="course" name="course">
							<?php
							$sql_ = "SELECT courseID, CourseName FROM courses";
							$result_ = mysqli_query($conn, $sql_);

							if (mysqli_num_rows($result_) > 0) {
							while($rowc = mysqli_fetch_assoc($result_)) {
								echo "<option value=" . $rowc["courseID"]. ">" . $rowc["CourseName"]. "</option><br>";
							}
							} else {
							echo '<option value="0">No Course</option>';
							}

							mysqli_close($conn);
							?> 
                        </select>
					</div>
					<div class="form-group">
						<label>Year</label>
						<input type="text" id="year" name="year" class="form-control" autocomplete="off" required>
					</div>
					
					<div class="form-group">
						<label>Batch Name</label>
						<input type="text" id="batch" name="batch" class="form-control" autocomplete="off" required oninput="this.value = this.value.toUpperCase()">
					</div>
					
					<div class="form-group">
    					<label for="Budget Participants">Budget Participants</label>
    						<select id="budget" name="budget" class="form-control" autocomplete="off" required>
        					<?php
        						// Loop to generate options from 25 to 100
        					for ($i = 25; $i <= 100; $i++) {
            				echo "<option value=\"$i\">$i</option>";
        					}
        					?>
    						</select>
					</div>
					<div class="form-group">
						<label>Start Date</label>
						<input type="text" id="StartDate" name="Start Date" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>End Date</label>
						<input type="text" id="EndDate" name="End Date" class="form-control" autocomplete="off" required>
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
						<input type="text" id="year_u" name="course" class="form-control" autocomplete="off" required>
					</div>	
					<div class="form-group">
						<label>Batch Name</label>
						<input type="text" id="batch_u" name="batch" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Budget Participants</label>
						<input type="email" id="budget_u" name="email" class="form-control" required>
					</div>
          			<div class="form-group">
						<label>Start Date</label>
						<input type="Date" id="stardate_u" name="Start date" class="form-control datepicker" required>
					</div>
					<div class="form-group">
						<label>End Date</label>
						<input type="Date" id="enddate_u" name="end date" class="form-control datepicker" required>
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
