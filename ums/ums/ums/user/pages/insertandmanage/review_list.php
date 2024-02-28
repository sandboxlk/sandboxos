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
	<script src="pages/insertandmanage/review_list_ajax.js"></script>
	
<div>
<div class="col-12 grid-margin">
<div class="card">
<div class="card-body">
<h4 class="card-title mb-4 mt-4 mb-xl-4">Potential Table</h4>
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
					<th>Student Name</th>
					<th>Company</th>
					<th>Batch</th>
          			<th>Assesment Type</th>
					<th>Consultant Review</th>
					<th>Supervisor Review</th>
				</tr>
			</thead>
			<tbody>
			
			<?php
			$result = mysqli_query($conn,"SELECT * FROM consultant_review ORDER BY StudentName ASC");
			$ClientName="";
				$i=1;
				while($row = mysqli_fetch_array($result)) {
				?>
				<tr class="border-bottom" id="<?php echo $row["StudentName"]; ?>">
				<td>
					<a href="#editEmployeeModal" class="edit" data-toggle="modal">
						<i class="material-icons update"
						data-StudentName_u="<?php echo $row["StudentName"]; ?>"
						data-company_u="<?php echo $row["company"]; ?>"
						data-batch_u="<?php echo $row["batch"]; ?>"
						data-AssessmentType_u="<?php echo $row["AssessmentType"]; ?>"
						data-ConsultantReview_u="<?php echo $row["ConsultantReview"]; ?>"
						data-SupervisorReview_u="<?php echo $row["SupervisorReview"]; ?>"
						title="Edit"></i>
					</a>
					<a href="#deleteEmployeeModal" class="delete" data-course_id_d="<?php echo $row["StudentName"]; ?>" data-toggle="modal"><i class="material-icons" title="Delete"></i></a>
				</td>
				<?php $Recordid = str_pad($row["StudentName"], 5, '0', STR_PAD_LEFT); ?>
				<td><?php echo 'C'.$Recordid; ?></td>
				<td><?php echo $row["company"]; ?></td>
				<td><?php echo $row["batch"]; ?></td>
				<td><?php echo $row["AssessmentType"]; ?></td>
				<td><?php echo $row["ConsultantReview"]; ?></td>
				<td><?php echo $row["SupervisorReview"]; ?></td>
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
					<h4 class="modal-title">Add Course</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Course Name</label>
						<input type="text" id="coursename" name="coursename" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Duration</label>
						<input type="text" id="duration" name="duration" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Modules</label>
						<input type="text" id="lecturer" name="lecturer" class="form-control" autocomplete="off" required>
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
					<h4 class="modal-title">Edit Course</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="course_id_u" name="clientid" class="form-control" required>	
					<div class="modal-body">					
						<div class="form-group">
							<label>Course Name</label>
							<input type="text" id="coursename_u" name="coursename_u" class="form-control" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label>Duration</label>
							<input type="text" id="courseduration" name="courseduration" class="form-control" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label>Lecturer</label>
							<input type="text" id="lecturername" name="lecturername" class="form-control" autocomplete="off" required>
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
