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
	<script src="pages/insertandmanage/Faculty_PI_list_ajax.js"></script>


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
</style>
<div class="col-12 grid-margin">
<div class="card">
<div class="card-body">
<h4 class="card-title mb-4 mt-4 mb-xl-4">Faculty Personal Details</h4>
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
					<th>Faculty ID</th>
					<th>Calling  Name</th>
					<th>NIC</th>
          			<th>Address</th>
					<th>Mobile No 1</th>
          			<th>Mobile No 2</th>
					<th>Emergency Contact</th>
					<th>Designation</th>
					<th>Current Employee</th>
					<th>Faculty Level</th>
					<th>Careers Start Year</th>
					<th>Years of Experience</th>
					<th>Formal Qualification</th>
					<th>Your Expertise Area 1</th>
					<th>Your Expertise Area 2</th>
					<th>Your Expertise Area 3</th>
					<th>Your Expertise Area 4</th>
					<th>Weekends</th>
					<th>Days per month</th>
					<th>Total days per year</th>
					<th></th>	
				</tr>
			</thead>
			<tbody>

			<?php
			$result = mysqli_query($conn,"SELECT * FROM faculty ORDER BY callingName ASC");
				$i=1;
				while($row = mysqli_fetch_array($result)) {
				//AMC
				$today = date('Y-m-d');
				$clientid = $row["facultyid"];	
			?>
			<tr class="border-bottom" id="<?php echo $row["facultyid"]; ?>">
			<td>
    					<a href="#editEmployeeModal" class="edit" data-toggle="modal">
						<i class="material-icons update" data-toggle="tooltip" 
						data-id="<?php echo $row["facultyid"]; ?>"
						data-name="<?php echo $row["callingName"]; ?>"
						data-nic="<?php echo $row["nic"]; ?>"
						data-address="<?php echo $row["address"]; ?>"
						data-contact1="<?php echo $row["mobileNo1"]; ?>"
            			data-contact2="<?php echo $row["mobileNo2"]; ?>"
						data-contact3="<?php echo $row["emergencyContact"]; ?>"
            			data-Designation="<?php echo $row["designation"]; ?>"
						data-Employee="<?php echo $row["currentEmployee"]; ?>"
            			data-faculty_level="<?php echo $row["facultyLevel"]; ?>"
						data-Careerssy="<?php echo $row["careersStartY"]; ?>"
            			data-Experience="<?php echo $row["yoe"]; ?>"
						data-Qualification="<?php echo $row["formalQualification"]; ?>"
						data-faculty_level1="<?php echo $row["expertiseArea1"]; ?>"
            			data-faculty_level2="<?php echo $row["expertiseArea2"]; ?>"
						data-faculty_level3="<?php echo $row["expertiseArea3"]; ?>"
            			data-faculty_level4="<?php echo $row["expertiseArea4"]; ?>"
						data-contact2="<?php echo $row["capacity"]; ?>"
						title="Edit"></i>
						</a>
					<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["facultyid"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						title="Delete"></i></a>
				</td>
			
				<?php $Recordid = str_pad($row["facultyid"], 5, '0', STR_PAD_LEFT); ?>
				<td><?php echo "C";?><?php echo $Recordid; ?></td>
				<td><?php echo $row["callingName"]; ?></td>
				<td><?php echo $row["nic"]; ?></td> 
				<td><?php echo $row["address"]; ?></td>
				<td><?php echo $row["mobileNo1"]; ?></td>
				<td><?php echo $row["mobileNo2"]; ?></td>
				<td><?php echo $row["emergencyContact"]; ?></td>
				<td><?php echo $row["designation"]; ?></td> 
				<td><?php echo $row["currentEmployee"]; ?></td>
				<td><?php echo $row["facultyLevel"]; ?></td>
				<td><?php echo $row["careersStartY"]; ?></td>
				<td><?php echo $row["yoe"]; ?></td>
				<td><?php echo $row["formalQualification"]; ?></td> 
				<td><?php echo $row["expertiseArea1"]; ?></td>
				<td><?php echo $row["expertiseArea2"]; ?></td>
				<td><?php echo $row["expertiseArea3"]; ?></td>
				<td><?php echo $row["expertiseArea4"]; ?></td>
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
						<input type="text" id="name" name="name" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>NIC</label>
						<input type="text" id="nic" name="nic" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" id="address" name="address" class="form-control" autocomplete="off" required>
					</div>
          			<div class="form-group">
						<label>Mobile No 1</label>
						<input type="text" id="contact1" name="contact1" class="form-control" autocomplete="off" required>
					</div>	
					<div class="form-group">
						<label>Mobile No 2</label>
						<input type="text" id="contact2" name="contact2" class="form-control" autocomplete="off" required>
					</div>	
          			<div class="form-group">
						<label>Emergency Contact</label>
						<input type="text" id="contact3" name="contact3" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Designation</label>
						<input type="text" id="Designation" name="Designation" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Current Employee</label>
						<input type="text" id="Employee" name="Employee" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Faculty Level</label>
						<select id="faculty_level" name="faculty_level" class="form-control" required>
							<option value="Visiting Lecturer">Visiting Lecturer</option>
							<option value="Junior Lecturer">Junior Lecturer</option>
							<option value="Senior Lecturer">Senior Lecturer</option>
						</select>
						</div>

						<div class="form-group">
						<label>Careers Start Year</label>
						<input type="text" id="Careerssy" name="Careerssy" class="form-control" autocomplete="off" required>
					</div>

					<div class="form-group">
						<label>Years of Experience</label>
						<input type="text" id="Experience" name="Experience" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Formal Qualification</label>
						<input type="text" id="Qualification" name="Qualification" class="form-control" autocomplete="off" required>
					</div>

						<div class="form-group">
						<label>Your Expertise Area 1</label>
						<select id="faculty_level1" name="faculty_level1" class="form-control" required>
							<option value="accounting">Accounting</option>
							<option value="Business Coaching">Business Coaching</option>
							<option value="Senior Lecturer">Business English</option>
							<option value="Visiting Lecturer">Business strategy</option>
							<option value="Junior Lecturer">Corporate Communication</option>
							<option value="Senior Lecturer">Creative Thinking</option>
							<option value="Visiting Lecturer">Customer Service</option>
							<option value="Junior Lecturer">Design Thinking</option>
							<option value="Senior Lecturer">Entrepreneurial Thinking</option>
							<option value="Visiting Lecturer">Finance</option>
							<option value="Junior Lecturer">Inspirational Speaking</option>
							<option value="Senior Lecturer">Leadership Development</option>
							<option value="Visiting Lecturer">Life Coaching</option>
							<option value="Junior Lecturer">Management Consulting</option>
							<option value="Senior Lecturer">Management Finance</option>
							<option value="Visiting Lecturer">Marketing & Sales</option>
							<option value="Junior Lecturer">Motivational Leadership</option>
							<option value="Senior Lecturer">Negotiation</option>
							<option value="Visiting Lecturer">Organisational Design</option>
							<option value="Junior Lecturer">Organizational Psychology</option>
							<option value="Senior Lecturer">Presence & Confidence</option>
							<option value="Visiting Lecturer">Professional Coaching</option>
							<option value="Junior Lecturer">Project Management</option>
							<option value="Senior Lecturer">Supply Chain</option>
							<option value="Visiting Lecturer">Technical Skills</option>
							<option value="Junior Lecturer">Women Empowerment</option>
							<option value="Senior Lecturer">Voice Training</option>
							<option value="Visiting Lecturer">Other</option>
						</select>						
					</div>

					<div class="form-group">
						<label>Your Expertise Area 2</label>
						<select id="faculty_level2" name="faculty_level2" class="form-control" required>
							<option value="Visiting Lecturer">Accounting</option>
							<option value="Junior Lecturer">Business Coaching</option>
							<option value="Senior Lecturer">Business English</option>
							<option value="Visiting Lecturer">Business strategy</option>
							<option value="Junior Lecturer">Corporate Communication</option>
							<option value="Senior Lecturer">Creative Thinking</option>
							<option value="Visiting Lecturer">Customer Service</option>
							<option value="Junior Lecturer">Design Thinking</option>
							<option value="Senior Lecturer">Entrepreneurial Thinking</option>
							<option value="Visiting Lecturer">Finance</option>
							<option value="Junior Lecturer">Inspirational Speaking</option>
							<option value="Senior Lecturer">Leadership Development</option>
							<option value="Visiting Lecturer">Life Coaching</option>
							<option value="Junior Lecturer">Management Consulting</option>
							<option value="Senior Lecturer">Management Finance</option>
							<option value="Visiting Lecturer">Marketing & Sales</option>
							<option value="Junior Lecturer">Motivational Leadership</option>
							<option value="Senior Lecturer">Negotiation</option>
							<option value="Visiting Lecturer">Organisational Design</option>
							<option value="Junior Lecturer">Organizational Psychology</option>
							<option value="Senior Lecturer">Presence & Confidence</option>
							<option value="Visiting Lecturer">Professional Coaching</option>
							<option value="Junior Lecturer">Project Management</option>
							<option value="Senior Lecturer">Supply Chain</option>
							<option value="Visiting Lecturer">Technical Skills</option>
							<option value="Junior Lecturer">Women Empowerment</option>
							<option value="Senior Lecturer">Voice Training</option>
							<option value="Visiting Lecturer">Other</option>
						</select>						
					</div>

					<div class="form-group">
						<label>Your Expertise Area 3</label>
						<select id="faculty_level3" name="faculty_level3" class="form-control" required>
							<option value="Visiting Lecturer">Accounting</option>
							<option value="Junior Lecturer">Business Coaching</option>
							<option value="Senior Lecturer">Business English</option>
							<option value="Visiting Lecturer">Business strategy</option>
							<option value="Junior Lecturer">Corporate Communication</option>
							<option value="Senior Lecturer">Creative Thinking</option>
							<option value="Visiting Lecturer">Customer Service</option>
							<option value="Junior Lecturer">Design Thinking</option>
							<option value="Senior Lecturer">Entrepreneurial Thinking</option>
							<option value="Visiting Lecturer">Finance</option>
							<option value="Junior Lecturer">Inspirational Speaking</option>
							<option value="Senior Lecturer">Leadership Development</option>
							<option value="Visiting Lecturer">Life Coaching</option>
							<option value="Junior Lecturer">Management Consulting</option>
							<option value="Senior Lecturer">Management Finance</option>
							<option value="Visiting Lecturer">Marketing & Sales</option>
							<option value="Junior Lecturer">Motivational Leadership</option>
							<option value="Senior Lecturer">Negotiation</option>
							<option value="Visiting Lecturer">Organisational Design</option>
							<option value="Junior Lecturer">Organizational Psychology</option>
							<option value="Senior Lecturer">Presence & Confidence</option>
							<option value="Visiting Lecturer">Professional Coaching</option>
							<option value="Junior Lecturer">Project Management</option>
							<option value="Senior Lecturer">Supply Chain</option>
							<option value="Visiting Lecturer">Technical Skills</option>
							<option value="Junior Lecturer">Women Empowerment</option>
							<option value="Senior Lecturer">Voice Training</option>
							<option value="Visiting Lecturer">Other</option>
						</select>						
					</div>
					<div class="form-group">
						<label>Your Expertise Area 4</label>
						<select id="faculty_level4" name="faculty_level4" class="form-control" required>
							<option value="Visiting Lecturer">Accounting</option>
							<option value="Junior Lecturer">Business Coaching</option>
							<option value="Senior Lecturer">Business English</option>
							<option value="Visiting Lecturer">Business strategy</option>
							<option value="Junior Lecturer">Corporate Communication</option>
							<option value="Senior Lecturer">Creative Thinking</option>
							<option value="Visiting Lecturer">Customer Service</option>
							<option value="Junior Lecturer">Design Thinking</option>
							<option value="Senior Lecturer">Entrepreneurial Thinking</option>
							<option value="Visiting Lecturer">Finance</option>
							<option value="Junior Lecturer">Inspirational Speaking</option>
							<option value="Senior Lecturer">Leadership Development</option>
							<option value="Visiting Lecturer">Life Coaching</option>
							<option value="Junior Lecturer">Management Consulting</option>
							<option value="Senior Lecturer">Management Finance</option>
							<option value="Visiting Lecturer">Marketing & Sales</option>
							<option value="Junior Lecturer">Motivational Leadership</option>
							<option value="Senior Lecturer">Negotiation</option>
							<option value="Visiting Lecturer">Organisational Design</option>
							<option value="Junior Lecturer">Organizational Psychology</option>
							<option value="Senior Lecturer">Presence & Confidence</option>
							<option value="Visiting Lecturer">Professional Coaching</option>
							<option value="Junior Lecturer">Project Management</option>
							<option value="Senior Lecturer">Supply Chain</option>
							<option value="Visiting Lecturer">Technical Skills</option>
							<option value="Junior Lecturer">Women Empowerment</option>
							<option value="Senior Lecturer">Voice Training</option>
							<option value="Visiting Lecturer">Other</option>
						</select>						
		</div>
            <div class="form-group">
                <label>Weekends</label>
                <select id="weekends" name="weekends" class="form-control" required>
                    <option value="yes">Weekends Yes</option>
                    <option value="no">Weekends No</option>
                </select>
            </div>
       

    <div class="form-group">
        <label>Days per month</label>
        <select id="daysPerMonth" name="daysPerMonth" class="form-control" required>
            <!-- Loop to generate options from 1 to 30 -->
            <?php for ($i = 1; $i <= 30; $i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
    </div>

					<div class="form-group">
						<label>Total days per year</label>
						<input type="text" id="total" name="total" class="form-control" autocomplete="off" required>
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



