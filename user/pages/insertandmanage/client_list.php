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
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="pages/insertandmanage/client_list_ajax.js"></script>
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
<div class="col-12 grid-margin">
<div class="card">
<div class="card-body">
<h4 class="card-title mb-4 mt-4 mb-xl-4">Client</h4>
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
					<th>CompanyID</th>
					<th>Company Code</th>
					<th>Company Name</th>
					<th>Address</th>
					<th>Contacts Name </th>
					<th>Contacts Designation</th>
          			<th>Contacts Email</th>
					<th>Mobile No</th>
          			<th>Land No</th>		
					<th></th>	
				</tr>
			</thead> 
			<tbody>
		  
			<?php
			$result = mysqli_query($conn,"SELECT * FROM clients ORDER BY clientName ASC");
				$i=1;
				while($row = mysqli_fetch_array($result)) {
				//AMC
				$today = date('Y-m-d');
				$clientid = $row["clientID"];	
			?>
			<tr class="border-bottom" id="<?php echo $row["clientID"]; ?>">
			<td>
    					<a href="#editEmployeeModal" class="edit" data-toggle="modal">
						<i class="material-icons update" data-toggle="tooltip" 
						data-id="<?php echo $row["clientID"]; ?>"
						data-code="<?php echo $row["companyCode"]; ?>"
						data-name="<?php echo $row["clientName"]; ?>"
						data-address="<?php echo $row["address"]; ?>"
						data-Contactsname="<?php echo $row["contactsName"]; ?>"
						data-Designation="<?php echo $row["contactsDesignation"]; ?>" 
						data-email="<?php echo $row["email"]; ?>"
						data-contact1="<?php echo $row["contact1"]; ?>"
            			data-contact2="<?php echo $row["contact2"]; ?>"
						title="Edit"></i>
					</a>
					<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["clientID"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						title="Delete"></i></a>
				</td>
        		<?php $Recordid = str_pad($row["clientID"], 5, '0', STR_PAD_LEFT); ?>
				<td><?php echo "C";?><?php echo $Recordid; ?></td>
				<td><?php echo $row["companyCode"]; ?></td>
				<td><?php echo $row["clientName"]; ?></td>
				<td><?php echo $row["address"]; ?></td> 
				<td><?php echo $row["contactsName"]; ?></td>
				<td><?php echo $row["contactsDesignation"]; ?></td>
				<td><?php echo $row["email"]; ?></td>
				<td><?php echo $row["contact1"]; ?></td>
				<td><?php echo $row["contact2"]; ?></td>
				
	<td>
    <a href="#addContactModal" class="btn btn-primary btn-sm" data-toggle="modal" data-clientid="<?php echo $row["clientID"]; ?>" data-clientname="<?php echo $row["clientName"]; ?>">Add Contact</a>
    <a href="#viewContactsModal" class="btn btn-secondary btn-sm view-contacts" data-toggle="modal" data-clientid="<?php echo $row["clientID"]; ?>" data-clientname="<?php echo $row["clientName"]; ?>">View Contacts</a>
	<!-- Add the new button for redirecting to modules page -->
	<a href="index.php?sub=createBatches&clientname=<?php echo urlencode($row["clientName"]); ?>" class="btn btn-warning btn-sm">View Batches</a>
</td>
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
	

<!-- Add Modal HTML - Primary Contact-->
<div id="addContactModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Contacts for <span id="companyName"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="contact_form">
                    <input type="hidden" id="company_id" name="company_id">
                    <div class="form-group">
                        <label>Contact Name</label>
                        <input type="text" class="form-control" name="contact_name" required>
                    </div>
					<div class="form-group">
    <label>Contact Designation</label>
    <input type="text" class="form-control" name="contact_designation" required>
</div>
<div class="form-group">
    <label>Contact Number</label>
    <input type="text" class="form-control" name="contact_number" required>
</div>

                    <div class="form-group">
                        <label>Contact Email</label>
                        <input type="email" class="form-control" name="contact_email" required>
                    </div>
                
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" class="btn btn-success">Add Contact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Contacts Modal HTML -->
<div id="viewContactsModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">						
				<h4 class="modal-title">Primary Contacts for <span id="client-name-display"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
				<div class="table-responsive">  <!-- Added this wrapper -->
					<table id="contacts-table" class="table table-hover">
						<thead>
							<tr> 
								<th>Contact Name</th>
								<th>Contact Designation</th>
								<th>Contact Number</th>
								<th>Contact Email</th>
								
							</tr>
						</thead>
						<tbody>
							<!-- Contacts data will be populated here using JavaScript -->
						</tbody>
					</table>
				</div> <!-- End of wrapper -->
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
					<h4 class="modal-title">Add New Client</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Company Code</label>
						<input type="text" id="code" name="code" class="form-control" autocomplete="off" required oninput="this.value = this.value.toUpperCase()">
					</div>
									
					<div class="form-group">
						<label>Company Name</label>
						<input type="text" id="name" name="name" class="form-control" autocomplete="off" required>
						
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" id="address" name="address" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Contacts Name</label>
						<input type="text" id="Contactsname" name="Contactsname" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Contacts Designation</label>
						<input type="text" id="Designation" name="Designation" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Contacts Email</label>
						<input type="text" id="email" name="email" class="form-control" autocomplete="off" required>
					</div>
          			<div class="form-group">
						<label>Mobile No</label>
						<input type="text" id="contact1" name="contact1" class="form-control" autocomplete="off" required>
					</div>	
          			<div class="form-group">
						<label>Land No</label>
						<input type="text" id="contact2" name="contact2" class="form-control" autocomplete="off" required>
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
					<h4 class="modal-title">Edit Company</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_u" name="id" class="form-control" required>					
					<div class="form-group">
						<label>Company Code</label>
						<input type="text" id="code_u" name="code" class="form-control" required>
					</div>					
					<div class="form-group">
						<label>Company Name</label>
						<input type="text" id="name_u" name="name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" id="address_u" name="address" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Contacts Name</label>
						<input type="text" id="contacts_u" name="Contactsname" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Contacts Designation</label>
						<input type="text" id="designation_u" name="Designation" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Contacts Email</label>
						<input type="email" id="email_u" name="email" class="form-control" required>
					</div>
          			<div class="form-group">
						<label>Mobile No</label>
						<input type="text" id="contact1_u" name="contact1" class="form-control" autocomplete="off" required>
					</div>	
          			<div class="form-group">
						<label>Land No</label>
						<input type="text" id="contact2_u" name="contact2" class="form-control" autocomplete="off" required>
					
					

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
					<h4 class="modal-title">Delete Company</h4>
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



