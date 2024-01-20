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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="pages/insertandmanage/calculation_list_ajax.js"></script>
<div>


<div class="col-12 grid-margin">
<div class="card">
<div class="card-body">
<h4 class="card-title mb-4 mt-4 mb-xl-4">Calculations</h4>
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
					<th>Calculation ID</th>
					<th>Company</th>
					<th>Batch</th>
          			<th>Course</th>
					<th>Attendance(%)</th>
					<th>Module vise scores </th>
					<th>Course scores</th>
					<th>Course ranking</th>
					<th>Batch ranking</th>
				</tr>
			</thead>
			<tbody>
		
			<?php
			$result = mysqli_query($conn,"SELECT * FROM calculations ORDER BY CalculationID ASC");
				$i=1;
				while($row = mysqli_fetch_array($result)) {
				//AMC
				$today = date('Y-m-d');
				$clientid = $row["CalculationID"];	
			?>
			<tr class="border-bottom" id="<?php echo $row["CalculationID"]; ?>">
			<td>
					<a href="#editEmployeeModal" class="edit" data-toggle="modal">
						<i class="material-icons update" data-toggle="tooltip" 
						data-CalculationID="<?php echo $row["CalculationID"]; ?>"
						data-company="<?php echo $row["company"]; ?>"
						data-batch="<?php echo $row["batch"]; ?>"
						data-course="<?php echo $row["course"]; ?>"
						data-attendance(%)="<?php echo $row["attendance(%)"]; ?>"
						data-ModuleViseScores="<?php echo $row["ModuleViseScores"]; ?>"
						data-CourseScores="<?php echo $row["CourseScores"]; ?>"
						data-CourseRanking="<?php echo $row["CourseRanking"]; ?>"
						data-BatchRanking="<?php echo $row["BatchRanking"]; ?>"
						title="Edit"></i>
					</a>
					<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["CalculationID"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						title="Delete"></i></a>
				</td>
        		<?php $Recordid = str_pad($row["CalculationID"], 5, '0', STR_PAD_LEFT); ?>
				<td><?php echo "Reg";?><?php echo $Recordid; ?></td>
				<td><?php echo $row["company"]; ?></td>
				<td><?php echo $row["batch"]; ?></td>
				<td><?php echo $row["course"]; ?></td>
				<td><?php echo $row["attendance(%)"]; ?></td>
				<td><?php echo $row["ModuleViseScores"]; ?></td>
				<td><?php echo $row["CourseRanking"]; ?></td>
				<td><?php echo $row["BatchRanking"]; ?></td>
				
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
						<label>Student Name</label>
						<input type="text" id="name" name="name" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" id="email" name="email" class="form-control" autocomplete="off" required>
					</div>
          			<div class="form-group">
						<label>Company</label>
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
							echo '<option value="0">No Courseaa</option>';
							}

							mysqli_close($conn);
							?>
                        </select>
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
						<label>Client Name</label>
						<input type="text" id="name_u" name="name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" id="address_u" name="address" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" id="email_u" name="email" class="form-control" required>
					</div>
          			<div class="form-group">
						<label>Mobile No</label>
						<input type="text" id="contact1_u" name="contact1" class="form-control" autocomplete="off" required>
					</div>	
          			<div class="form-group">
						<label>Lan No</label>
						<input type="text" id="contact2_u" name="contact2" class="form-control" autocomplete="off" required>
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
