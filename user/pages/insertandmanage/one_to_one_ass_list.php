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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="pages/insertandmanage/one_to_one_ass_list_ajax.js"></script>
	
<div>
<div class="col-12 grid-margin">
<div class="card">
<div class="card-body">
<h4 class="card-title mb-4 mt-4 mb-xl-4">1 to 1</h4>
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
					<th>Assessment ID</th>
					<th>Company</th>
					<th>Batch</th>
					<th>Student Name</th>
					<th>Comments</th>
					<th>Yes/No</th>
					<th>Date</th>
          			<th></th>
				</tr>
			</thead>
			<tbody>
			
			<?php
			$result = mysqli_query($conn,"SELECT * FROM one_to_one_assessment ORDER BY StudentID ASC");
			$ClientName="";
				$i=1;
				while($row = mysqli_fetch_array($result)) {
				?>
				<tr class="border-bottom" id="<?php echo $row["StudentID"]; ?>"> 
				<td>
					<a href="#editEmployeeModal" class="edit" data-toggle="modal">
						<i class="material-icons update"
						data-StudentID_u="<?php echo $row["StudentID"]; ?>"
						data-companyName_u="<?php echo $row["company"]; ?>"
						data-batchType_u="<?php echo $row["batch"]; ?>"
						data-StudentName_u="<?php echo $row["StudentName"]; ?>"
						data-commentsType_u="<?php echo $row["comments"]; ?>"
						data-yesnoType_u="<?php echo $row["yes/no"]; ?>"
						data-date_u="<?php echo $row["date"]; ?>"
						title="Edit"></i>
					</a>
					<a href="#deleteEmployeeModal" class="delete" data-Assessment_id_d="<?php echo $row["StudentID"]; ?>" data-toggle="modal"><i class="material-icons" title="Delete"></i></a>
				</td>
				<?php $Recordid = str_pad($row["StudentID"], 5, '0', STR_PAD_LEFT); ?>
				<td><?php echo 'C'.$Recordid; ?></td>
				<td><?php echo $row["company"]; ?></td>
				<td><?php echo $row["batch"]; ?></td>
				<td><?php echo $row["StudentName"]; ?></td>
				<td><?php echo $row["comments"]; ?></td>
				<td><?php echo $row["yes/no"]; ?></td>
				<td><?php echo $row["date"]; ?></td>
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
					<h4 class="modal-title">Add 1 To 1 Assessment</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">				
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

					<!--<div class="modal-body">-->					
						<div class="form-group">
						<label>Batch</label>
						<select class="form-control" id="batch" name="batch">
							<?php
							$sql="SELECT RegistrationID, StudentName FROM create_batches";	
							$result = mysqli_query($conn,$sql);

							if(mysqli_num_rows($result) >0){
							while($row = mysqli_fetch_assoc($result)){
							echo "<option value=" .$row["RegistrationID"]. ">" .$row["StudentName"]. "</option><br>";
							}
							}else{
							echo '<option value="0">No Batches</options>';
							}
							?>	
							</select>	
				
					</div>
				
					<div class="form-group">
						<label>Student Name</label>
						<input type="text" id="studentname" name="studentname" class="form-control" autocomplete="off" required>
					</div>
					
					<div class="form-group">
						<label>Comments</label>
						<input type="text" id="comments" name="comments" class="form-control" autocomplete="off" required>
					</div>
				
					<div class="form-group">
						<label>Yes/No</label>
						<input type="text" id="yes/no" name="yes/no" class="form-control" autocomplete="off" required>
					</div>

					<!--<div class="form-group">
						<label>Assessment Types</label>
						<select id="assessmentType" name="assessmentType" class="form-control" required>
        					<option value="personality">Personality</option>
        					<option value="180">180</option>
        					<option value="360">360</option>
							<option value="knowledge assessment">Knowledge Assessment</option>
							<option value="Culture Pulse">Culture Pulse</option>
							<option value="Compitency gap">Compitency gap</option>

       
    					</select>
					
					</div>-->
									
					<div class="form-group">
						<label>Date</label>
						<input type="Date" id="date" name="date" class="form-control" autocomplete="off" required>
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
					<h4 class="modal-title">Edit 1 To 1 Assessment</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_u" name="StudentID" class="form-control" required>	
					<div class="modal-body">					
						<div class="form-group">
							<label>Company</label>
							<input type="text" id="company_u" name="company_u" class="form-control" autocomplete="off" required>
						</div>
 
						<div class="form-group">
							<label>Batch</label>
							<input type="text" id="batch_u" name="batch_u" class="form-control" autocomplete="off" required>
						</div>

						<div class="form-group">
							<label>Student Name</label>
							<input type="text" id="StudentName_u" name="StudentName_u" class="form-control" autocomplete="off" required>
						</div>

						<div class="form-group">
							<label>Comments</label>
							<input type="text" id="comments_u" name="comments_u" class="form-control" autocomplete="off" required>
						</div>

						<div class="form-group">
							<label>Yes/No</label>
							<input type="text" id="yes/no_u" name="yesno_u" class="form-control" autocomplete="off" required>
						</div>

						<div class="form-group">
							<label>Date</label>
							<input type="Date" id="date_u" name="date_u" class="form-control" autocomplete="off" required>
						</div>

						<!--<div class="form-group">
							<label>Assessment Type</label>
							<select id="assessmentType_u" name="assessmentType_u" class="form-control" required>
        							<option value="Personality">Personality</option>
        							<option value="180">180</option>
        							<option value="360">360</option>
									<option value="knowledge assessment">Knowledge Assessment</option>
									<option value="Culture pulse">Culture Pulse</option>
									<option value="Compitency gap">Compitency Gap </option>
        
    						</select>
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
