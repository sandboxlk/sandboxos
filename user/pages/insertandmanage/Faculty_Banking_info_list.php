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
<div>
<div class="col-12 grid-margin">
<div class="card">
<div class="card-body">
<h4 class="card-title mb-4 mt-4 mb-xl-4">Banking Details</h4>
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
					<th>Bank ID</th>
					<th>Account Name</th>
					<th>Account Number</th>
					<th>Bank</th>
          			<th>Branch</th>
					<th>Swift Code</th>
					<th>Bank Code</th>
					<th>Branch Code</th>
					
				</tr>
			</thead>
			<tbody>
			
			<?php
			$result = mysqli_query($conn,"SELECT * FROM banking ORDER BY bankID  ASC");
			$ClientName="";
				$i=1;
				while($row = mysqli_fetch_array($result)) {
				?>
				<tr class="border-bottom" id="<?php echo $row["bankID"]; ?>">
				<td>
					<a href="#editEmployeeModal" class="edit" data-toggle="modal">
						<i class="material-icons update"
						data-bank_id_u="<?php echo $row["bankID"]; ?>"
						data-accountname_u="<?php echo $row["accountName"]; ?>"
						data-accountnumber_u="<?php echo $row["accountNumber"]; ?>"
						data-bank_u="<?php echo $row["bank"]; ?>"
						data-branch_u="<?php echo $row["branch"]; ?>" 
						data-swiftcode_u="<?php echo $row["swiftCode"]; ?>"
						data-bankcode_u="<?php echo $row["bankCode"]; ?>"
						data-branchcode_u="<?php echo $row["branchCode"]; ?>"
					
						title="Edit"></i>
					</a>
					<a href="#deleteEmployeeModal" class="delete" data-bank_id_u="<?php echo $row["bankID"];?>" data-toggle="modal"><i class="material-icons" title="Delete"></i></a>
					
				</td>
				<?php $Recordid = str_pad($row["bankID"], 5, '0', STR_PAD_LEFT); ?>
				<td><?php echo 'C'.$Recordid; ?></td>
				<td><?php echo $row["accountName"]; ?></td>
				<td><?php echo $row["accountNumber"]; ?></td>
				<td><?php echo $row["bank"]; ?></td>
				<td><?php echo $row["branch"]; ?></td>
				<td><?php echo $row["swiftCode"]; ?></td>
				<td><?php echo $row["bankCode"]; ?></td>
				<td><?php echo $row["branchCode"]; ?></td>
				<td>
    <!--<input type="checkbox" <?php echo ($row["Assessment"] == 'Yes') ? 'checked' : ''; ?> disabled />-->
</td>

				<td>
                    <!-- "Add Session Plans" button moved here 
                    <a href="#" class="btn btn-sm btn-primary add-session" data-toggle="modal" data-target="#addSessionPlansModal" data-ModuleID="<?php echo $row["ModuleID"]; ?>">Add Session Plans</a>
                    <a href="#viewContactsModal" class="btn btn-secondary btn-sm view-contacts" data-toggle="modal" data-ModuleID="<?php echo $row["ModuleID"]; ?>" data-clientname="<?php echo $row["ModuleName"]; ?>">View Session Plans</a>-->
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
                    <h4 class="modal-title">Add Session Plans</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="course_id_s" name="course_id_s" class="form-control" required>
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
					<h4 class="modal-title">Add Banking Details</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Account Name</label> 
						<input type="text" id="Account_Name" name="Module_Name" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Account Number</label>
						<input type="text" id="Account_Number" name="Account_Number" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Bank</label> 
						<input type="text" id="Bank" name="Bank" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Branch</label>
						<input type="text" id="Branch" name="Branch" class="form-control" autocomplete="off" required>
					</div>	
					<div class="form-group">
    						<label>Swift code</label>
    						<input type="text" id="swift_code" name="Swift_Code" class="form-control" autocomplete="off" required>
						</div>
					<div class="form-group">
    						<label>Bank code</label>
							<select id="Bank_code" name="Bank_code" class="form-control" required>
							<option value="Visiting Lecturer">7852 Alliance Finance Company PLC</option>
							<option value="Junior Lecturer">7463 Amana Bank PLC</option>
							<option value="Senior Lecturer">7472 Axis Bank</option>
							<option value="Visiting Lecturer">7010 Bank of Ceylon</option>
							<option value="Junior Lecturer">7481 Cargills Bank Limited</option>
							<option value="Senior Lecturer">8004 Central Bank of Sri Lanka</option>
							<option value="Visiting Lecturer">7825 Central Finance PLC</option>
							<option value="Junior Lecturer">7047 Citi Bank</option>
							<option value="Senior Lecturer">7746 Citizen Development Business Finance PLC</option>
							<option value="Visiting Lecturer">7056 Commercial Bank PLC</option>
							<option value="Junior Lecturer">7870 Commercial Credit & Finance PLC</option>
							<option value="Senior Lecturer">7807 Commercial Leasing and Finance</option>
							<option value="Visiting Lecturer">7205 Deutsche Bank</option>
							<option value="Junior Lecturer">7454 DFCC Bank PLC</option>
							<option value="Senior Lecturer">7074 Habib Bank Ltd</option>
							<option value="Visiting Lecturer">7083 Hatton National Bank PLC</option>
							<option value="Junior Lecturer">7737 HDFC Bank</option>
							<option value="Senior Lecturer">7092 Hongkong Shanghai Bank</option>
							<option value="Visiting Lecturer">7384 ICICI Bank Ltd</option>
							<option value="Junior Lecturer">7108 Indian Bank</option>
							<option value="Senior Lecturer">7117 Indian Overseas Bank</option>
							<option value="Visiting Lecturer">7834 Kanrich Finance Limited</option>
							<option value="Junior Lecturer">7861 Lanka Orix Finance PLC</option>
							<option value="Senior Lecturer">7773 LB Finance PLC</option>
							<option value="Senior Lecturer">7269 MCB Bank Ltd</option>
							<option value="Visiting Lecturer">7913 Mercantile Investment and Finance PLC</option>
							<option value="Junior Lecturer">7898 Merchant Bank of Sri Lanka & Finance PLC</option>
							<option value="Senior Lecturer">7214 National Development Bank PLC</option>
							<option value="Visiting Lecturer">7719 National Savings Bank</option>
							<option value="Junior Lecturer">7162 Nations Trust Bank PLC</option>
							<option value="Senior Lecturer">7311 Pan Asia Banking Corporation PLC</option>
							<option value="Senior Lecturer">7135 Peoples Bank</option>
							<option value="Visiting Lecturer">7922 People's Leasing & Finance PLC</option>
							<option value="Junior Lecturer">7296 Public Bank</option>
							<option value="Senior Lecturer">7755 Regional Development Bank</option>
							<option value="Visiting Lecturer">7278 Sampath Bank PLC</option>
							<option value="Junior Lecturer">7728 Sanasa Development Bank</option>
							<option value="Senior Lecturer">7782 Senkadagala Finance PLC</option>
							<option value="Senior Lecturer">7287 Seylan Bank PLC</option>
							<option value="Visiting Lecturer">7038 Standard Chartered Bank</option>
							<option value="Junior Lecturer">7144 State Bank of India</option>
							<option value="Senior Lecturer">7764 State Mortgage & Investment Bank</option>
							<option value="Visiting Lecturer">7302 Union Bank of Colombo PLC</option>
							<option value="Junior Lecturer">7816 Vallibel Finance PLC</option>
						</select>
				</div>
				<div class="form-group">
    						<label>Branch code</label>
    						<input type="text" id="Branch_code" name="branch_code" class="form-control" autocomplete="off" required>
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
					<h4 class="modal-title">Edit Banking Details</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="bank_id_u" name="bankid" class="form-control" required>	
					<div class="modal-body">					
						<div class="form-group">
							<label>Account Name</label>
							<input type="text" id="accountname_u" name="accountname" class="form-control" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label>Account Number</label>
							<input type="text" id="accountnumber_u" name="accountnumber" class="form-control" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label>Bank</label>
							<input type="text" id="bank_u" name="bank" class="form-control" autocomplete="off" required>
						</div>	
						<div class="form-group">
							<label>Branch</label>
							<input type="text" id="branch_u" name="branch" class="form-control" autocomplete="off" required>
						</div>	
						<div class="form-group">
							<label>Swift Code</label>
							<input type="text" id="swiftcode_u" name="swiftcode" class="form-control" autocomplete="off" required>
						</div>	
						<div class="form-group">
							<label>Bank Code</label>
							<input type="text" id="bankcode_u" name="bankcode" class="form-control" autocomplete="off" required>
						</div>	
						<div class="form-group">
							<label>Branch Code</label>
							<input type="text" id="branchcode_u" name="branchcode" class="form-control" autocomplete="off" required>
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
