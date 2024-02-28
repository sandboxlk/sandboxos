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
<script src="pages/insertandmanage/batch_upload_list_ajax.js"></script>

<div>
	<div class="col-12 grid-margin">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title mb-4 mt-4 mb-xl-4">Batch Upload</h4>
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
									<th>Company Name</th>
									<th>Batch</th>
									<th>course</th>
									<th></th>

								</tr>
							</thead>
							<tbody>

								<?php
								$result = mysqli_query($conn, "SELECT * FROM batch_upload ORDER BY CompanyName ASC");
								$ClientName = "";
								$i = 1;
								while ($row = mysqli_fetch_array($result)) {
								?>
									<tr class="border-bottom" id="<?php echo $row["CompanyName"]; ?>">
										<td>


											<a href="#editEmployeeModal" class="edit" data-toggle="modal">
												<i class="material-icons update" data-CompanyName_u="<?php echo $row["CompanyName"]; ?>" data-batch_u="<?php echo $row["batch"]; ?>" data-course_u="<?php echo $row["course"]; ?>" title="Edit"></i>
											</a>
											<a href="#deleteEmployeeModal" class="delete" data-course_id_d="<?php echo $row["CompanyName"]; ?>" data-toggle="modal"><i class="material-icons" title="Delete"></i></a>

										</td>
										<?php $Recordid = str_pad($row["CompanyName"], 5, '0', STR_PAD_LEFT); ?>
										<td><?php echo 'C' . $Recordid; ?></td>
										<td><?php echo $row["batch"]; ?></td>
										<td><?php echo $row["course"]; ?></td>



										<td>
											<!-- "Add Session Plans" button moved here -->
											<a href="#" class="btn btn-sm btn-primary add-session" data-toggle="modal" data-target="#addSessionPlansModal" data-courseid="<?php echo $row["CompanyName"]; ?>">Batch Upload</a>
											<!-- New "View Batch Upload" button -->
											<a href="path_to_pdf/<?php echo $row["pdf_filename"]; ?>" target="_blank" class="btn btn-sm btn-info view-pdf">View Batch Upload</a>

										</td>
									</tr>
								<?php
									$i++;
								}
								?>
							</tbody>
						</table>
					</div>



					<!-- Add Session Plans Modal HTML -->
					<div id="addSessionPlansModal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form id="session_plans_form" enctype="multipart/form-data">
									<div class="modal-header">
										<h4 class="modal-title">Batch Upload </h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<input type="hidden" id="course_id_s" name="course_id_s" class="form-control" required>
										<div class="form-group">
											<label>Upload batch (Max: 150MB)</label>
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
					<!-- Add Modal HTML -->
					<div id="addEmployeeModal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form id="user_form">
									<div class="modal-header">
										<h4 class="modal-title">Add Batch</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label>Company Name</label>
											<input type="text" id="coursename" name="coursename" class="form-control" autocomplete="off" required>
										</div>
										<div class="form-group">
											<label>Batch</label>
											<input type="text" id="duration" name="duration" class="form-control" autocomplete="off" required>
										</div>
										<div class="form-group">
											<label>Course</label>
											<input type="text" id="duration" name="duration" class="form-control" autocomplete="off" required>
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
										<h4 class="modal-title">Edit Batch</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<input type="hidden" id="course_id_u" name="clientid" class="form-control" required>
										<div class="modal-body">
											<div class="form-group">
												<label>Company Name</label>
												<input type="text" id="coursename_u" name="coursename_u" class="form-control" autocomplete="off" required>
											</div>
											<div class="form-group">
												<label>Batch</label>
												<input type="text" id="courseduration" name="courseduration" class="form-control" autocomplete="off" required>
											</div>
											<div class="form-group">
												<label>Course</label>
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
										<h4 class="modal-title">Delete Batch</h4>
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