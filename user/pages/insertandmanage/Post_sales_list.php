<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../connection.php';
include '../check.php';
if (($AccountLevel == 2) || ($AccountLevel == 3)) {
	echo "You do not have permission to access this page.";
	exit;
}
$search = isset($_GET['search']) ? $_GET['search'] : '';

$result = mysqli_query($conn, "SELECT * FROM leads WHERE company LIKE '%$search%'");
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="path/to/your/custom-script.js"></script>
<!-- <script src="path/to/leads_list_ajax.js"></script>-->
<script src="pages/insertandmanage/leads_list_ajax.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
	$(document).on('click', '#addEmployeeModal #btn-add', function() {

		var data = $("#user_form").serialize();
		$.ajax({
			data: data,
			type: "POST",
			url: "pages/insertandmanage/backend/leads_list_backend.php",
			success: function(dataResult) {

				alert(dataResult);
				var dataResult = JSON.parse(dataResult);
				if (dataResult.statusCode == 200) {
					$('#addEmployeeModal').modal('hide');
					alert('Company added!');
					location.reload();
				}
				if (dataResult.statusCode == 400) {
					alert(dataResult.message);
					//alert('Please Select No Series.');
				}
			},

		});
	});


	$(document).ready(function() {
		// Add event listeners to filter input fields
		$('#client-filter').on('input', function() {
			filterTable('client', $(this).val());
		});

		$('#date-filter').on('change', function() {
			filterTable('date', $(this).val());
		});

		// Function to filter the table based on column and value
		function filterTable(column, value) {
			var $table = $('#leads-table');
			var $rows = $table.find('tbody tr');

			$rows.show(); // Show all rows initially

			if (value.trim() !== '') {
				// If the filter value is not empty, hide rows that don't match the filter
				$rows.filter(':not(:contains(' + value + '))').hide();
			}
		}

		// jQuery extension for case-insensitive :contains
		$.expr[":"].contains = $.expr.createPseudo(function(arg) {
			return function(elem) {
				return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
			};
		});
	});
</script>

<script>
	$(document).ready(function() {
		// Set default filter value to the last 7 days
		var defaultDate = new Date();
		defaultDate.setDate(defaultDate.getDate() - 7);
		var defaultDateString = defaultDate.toISOString().split('T')[0];

		// Set default values for filter inputs
		$('#lostlead').val(defaultDateString);
		$('#exampleInputName1').val('');

		// Add event listeners for the "Lost Lead Date" and client search input fields
		$('body').on('change', '#lostlead', applyHighlighting);
		$('body').on('input', '#exampleInputName1', applyHighlighting);

		function applyHighlighting() {
			// Remove the highlighting classes from all rows and cells
			$('tbody tr').removeClass('tr-highlight');
			$('tbody td').removeClass('green-cell');
			$('tbody td').removeClass('red-cell');

			// Filter rows based on the "Lost Lead Date" input
			var lostLeadDate = $('#lostlead').val();
			var clientSearch = $('#exampleInputName1').val().toUpperCase();

			$('tbody tr').each(function() {
				var row = $(this);
				var leadDate = row.find('td:eq(8)').text();
				var clientName = row.find('td:eq(2)').text().toUpperCase();

				if ((lostLeadDate === '' || leadDate === lostLeadDate) &&
					(clientSearch === '' || clientName.includes(clientSearch))) {
					row.addClass('tr-highlight');

					// Highlight specific cells based on your conditions
					highlightCell(row, 9);
					highlightCell(row, 10);
					// Add more cells as needed
				}
			});
		}

		function highlightCell(row, cellIndex) {
			var cellValue = row.find('td:eq(' + cellIndex + ')').text();
			var cellClass = (cellValue == 1) ? 'green-cell' : 'orange-cell';
			row.find('td:eq(' + cellIndex + ')').addClass(cellClass);
		}
	});
</script>

<script>
	$(document).ready(function() {
		// Add an event listener to the client filter input
		$("#clientFilter").on("keyup", function() {
			var filterValue = $(this).val().toLowerCase();
			filterTable("client", filterValue);
		});

		// Add an event listener to the date filter input
		$("#dateFilter").on("keyup", function() {
			var filterValue = $(this).val().toLowerCase();
			filterTable("date", filterValue);
		});

		// Existing code for filter icons (if any)...

		// Existing code for other functionality...
	});
</script>

<script>
	$(document).ready(function() {
		// Add an event listener to the client filter input
		$("#clientFilter").on("keyup", function() {
			var filterValue = $(this).val().toLowerCase();
			filterTable("client", filterValue);
		});

		// Add an event listener to the date filter input
		$("#dateFilter").on("keyup", function() {
			var filterValue = $(this).val().toLowerCase();
			filterTable("date", filterValue);
		});

		// Existing code for filter icons (if any)...

		// Existing code for other functionality...
	});
</script>

<script>
	function filterTable() {
		var input, filter, table, tr, td, i, txtValue;
		input = document.getElementById("clientFilter");
		filter = input.value.toUpperCase();
		table = document.getElementById("company"); // Replace 'yourTableId' with the id of your table
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0]; // Assuming client is in the first column (0 index)
			if (td) {
				txtValue = td.textContent || td.innerText;
				if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}
</script>

<style>
	body {
		font-family: Arial, sans-serif;
		background-color: #fffdfc;
		position: relative;
	}

	.container {
		width: 100%;
		max-width: 100px;
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

	@media screen and (max-width: 100px) {

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

	.label-danger {
		background-color: #d9534f;
		/* Red color */
	}

	.label-success {
		background-color: #5cb85c;
		/* Green color */
	}

	thead {
		position: sticky;
		top: 0;
		background-color: #f8f8f8;
		z-index: 1;
	}



	thead {
		position: sticky;
		top: 0;
		background-color: #f8f8f8;
		z-index: 1;
	}

	.red-cell {
		background-color: #d9534f;
		/* Red color */
	}

	.green-cell {
		background-color: #5cb85c;
		/* Green color */
	}

	/*.orange-cell {
	background-color: #FF6E00;  Orange color 
}*/

	.yellow-cell {
		background-color: #FFC300;
		/* or any other styling */
	}

	.orange-cell {
		background-color: #FF6E00;
		/* or any other styling for orange */
	}

	.purple-cell {
		background-color: #8c66ff;
		/* or any other styling for orange */
	}

	.blue-cell {
		background-color: #34a1eb;
		/* or any other styling for orange */
	}

	td.td-requirement {
		max-width: 400px;
		/* Set your preferred maximum width */
		word-wrap: break-word;
		white-space: normal;
	}

	.tr-highlight {
		background-color: #ffe6e6;
		/* Change this to the desired highlight color */
	}

	.filter-input {
		width: 80%;
		/* Adjust the width as needed */
		margin-top: 5px;
		margin-bottom: 5px;
	}

	td.td-notes {
		max-width: 400px;
		/* Set your preferred maximum width */
		word-wrap: break-word;
		white-space: normal;
	}

	td.td-followUp {
		max-width: 400px;
		/* Set your preferred maximum width */
		word-wrap: break-word;
		white-space: normal;
	}

	.red-row {
		background-color: #ff0000;
		/* Red color */
	}

	/*#client {
	   width:20px;
	   background:transparent; 
	   border:0px; 
	   padding:0px;
	   margin-left:8rem;
	}

	#clinet option{
		visibility:hidden;
	}*/

	
</style>
<div class="col-12 grid-margin">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title mb-4 mt-4 mb-xl-4">Post Leads</h4>
			<div class="row mb-3">
				<div class="col-md-12">
					<!-- <form method="get" action="../user/pages/insertandmanage/leads_list_search.php">
	<div class="input-group">
		<input type="text" class="form-control" name="search" placeholder="Search..." value="<?= $search ?>">
		<div class="input-group-append">
			<button type="submit" class="btn btn-outline-secondary">Search</button>
		</div>
	</div>
</form> -->

				</div>
			</div>
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
				<div class="table-responsive table-wrapper">
					<table class="table table-hover">
						
						<thead>
							<tr>
								<th></th>
								<th>CompanyID</th>
								<th>Sales Stage </th>
								<th>Client </th>
								<th>Date</th>
								<th>Lead</th>
								<th>Lead Type</th>
								<th>Requirement</th>
								<th>Estimate Sales Value</th>
								<th>Lost Lead Date</th>
								<th>Preliminary Brochures & LIT</th>
								<th>Email Client</th>
								<th>Shedule Chemistry Meeting</th>
								<th>Chemistry Meeting</th>
								<th>Proposal</th>
								<th>Estimate</th>
								<th>Confirmation</th>
								<th>COF</th>
								<th>PO</th>
								<th>Invoice</th>
								<th>Payment</th>
								<th>Payment Status</th>
								<th>Program</th>
								<th>Post Sales Follow Up</th>
								<th>Protofolio E-Mail</th>
								<th>New Business Meeting</th>
								<th>Completion Status</th>
								<th>Status</th>
								<th>Notes</th>
								<th>Follow up actions</th>
							</tr>
						</thead>

						<tbody>
							<?php
							// Function to calculate completion status
							function calculateCompletionStatus($data)
							{
								$completedCount = array_sum($data); // Sum of 1 values
								$totalCount = count($data); // Total count of values

								// Calculate percentage
								$percentage = ($totalCount > 0) ? round(($completedCount / $totalCount) * 100) : 0;

								return $percentage;
								echo $percentage;
							}

							?>
							<?php
							if (isset($_GET['search'])) {
								$result = mysqli_query($conn, "SELECT * FROM leads WHERE company LIKE '%$search%' ");
							}
							$result = mysqli_query($conn, "SELECT * FROM leads WHERE cof = 1");
							$i = 1;
							while ($row = mysqli_fetch_array($result)) {
								//AMC
								$today = date('Y-m-d');
								$clientid = $row["clientID"];
							?>

								<tr class="border-bottom" id="<?php echo $row["clientID"]; ?>">
								<tr class="<?php echo (!empty($row["lostLeadDate"])) ? 'red-row' : ''; ?>">
									<td>
										<a href="#editEmployeeModal" class="edit" data-toggle="modal">
											<i class="material-icons update" data-toggle="tooltip" data-id="<?php echo $row["clientID"]; ?>" data-client="<?php echo $row["company"]; ?>" data-date="<?php echo $row["date"]; ?>" data-lead="<?php echo $row["lead"]; ?>" data-leadtype="<?php echo $row["leadType"]; ?>" data-requirement="<?php echo $row["requirement"]; ?>" data-estimatesv="<?php echo $row["estimateSalesValue"]; ?>" data-lostlead="<?php echo $row["lostLeadDate"]; ?>" data-perliminary="<?php echo $row["preliminaryBrochures"]; ?>" data-email="<?php echo $row["emailClient"]; ?>" data-shedule="<?php echo $row["sheduleCM"]; ?>" data-chemistry="<?php echo $row["chemMeeting"]; ?>" data-proposal="<?php echo $row["proposal"]; ?>" data-estimate="<?php echo $row["estimate"]; ?>" data-confirmation="<?php echo $row["confirmation"]; ?>" data-cof="<?php echo $row["cof"]; ?>" data-po="<?php echo $row["po"]; ?>" data-invoice="<?php echo $row["invoice"]; ?>" data-payment="<?php echo $row["payment"]; ?>" data-paymentStatus="<?php echo $row["paymentStatus"]; ?>" data-programs="<?php echo $row["program"]; ?>" data-post="<?php echo $row["postSalesFollowUp"]; ?>" data-protofolio="<?php echo $row["protofolioEmail"]; ?>" data-meeting="<?php echo $row["newBusinessMeeting"]; ?>" data-completion="<?php echo $row["completionStatus"]; ?>" data-notes="<?php echo $row["notes"]; ?>" data-followup="<?php echo $row["followUp"]; ?>" title="Edit"></i>
										</a>
										<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["clientID"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete"></i></a>
									</td>
									<?php
									$Recordid = str_pad($row["clientID"], 5, '0', STR_PAD_LEFT);
									$salesStage = ($row["cof"] == 1) ? "Post Sales" : "Pre Sales";
									$cellColor = ($row["cof"] == 1) ? "purple-cell" : "blue-cell";
									?>
									<td><?php echo "C"; ?><?php echo $Recordid; ?></td>
									<td class="<?php echo $cellColor; ?>"><?php echo $salesStage; ?></td>
									<td><?php echo $row["company"]; ?>
									<td><?php echo $row["date"]; ?></td>
									<td><?php echo $row["lead"]; ?></td>
									<td><?php echo $row["leadType"]; ?></td>
									<td class="td-requirement"><?php echo $row["requirement"]; ?></td>
									<td><?php echo $row["estimateSalesValue"]; ?></td>



									<td class="<?php echo (!empty($row["lostLeadDate"])) ? 'red-cell' : ''; ?>">
										<?php echo $row["lostLeadDate"]; ?>
									</td>


									<td class="<?php echo ($row["preliminaryBrochures"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["preliminaryBrochures"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["preliminaryBrochures"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<!-- Email Client -->
									<td class="<?php echo ($row["emailClient"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["emailClient"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["emailClient"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<!-- Schedule CM -->
									<td class="<?php echo ($row["sheduleCM"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["sheduleCM"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["sheduleCM"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<!-- Chem Meeting -->
									<td class="<?php echo ($row["chemMeeting"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["chemMeeting"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["chemMeeting"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<!-- Proposal -->
									<td class="<?php echo ($row["proposal"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["proposal"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["proposal"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<!-- Estimate -->
									<td class="<?php echo ($row["estimate"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["estimate"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["estimate"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<!-- Confirmation -->
									<td class="<?php echo ($row["confirmation"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["confirmation"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["confirmation"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<!-- COF -->
									<td class="<?php echo ($row["cof"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["cof"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["cof"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<!-- PO -->
									<td class="<?php echo ($row["po"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["po"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["po"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<!-- Invoice -->
									<td class="<?php echo ($row["invoice"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["invoice"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["invoice"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<td class="<?php
												if ($row["payment"] == 1) {
													echo 'green-cell';
												} elseif ($row["payment"] == 0) {
													echo 'yellow-cell';
												} elseif ($row["payment"] == 0.5) {
													echo 'orange-cell';
												} else {
													// You can add a default class or leave it empty if none of the conditions match.
													// echo 'default-class';
												}
												?>">
										<?php if ($row["payment"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["payment"] == 0.5) : ?>
											<input type="checkbox" disabled>
										<?php elseif ($row["payment"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<td class="<?php
												$estimateSalesValue = $row["estimateSalesValue"];
												$payment = $row["payment"];

												// Check if variables are numeric before performing the calculation
												if (is_numeric($estimateSalesValue) && is_numeric($payment)) {
													$paymentStatus = $estimateSalesValue * $payment;

													if ($payment == 1) {
														echo 'green-cell';
														$statusText = 'Payment Completed';
													} elseif ($payment == 0) {
														echo 'yellow-cell';
														$statusText = 'Yet to Receive';
													} elseif ($payment == 0.5) {
														echo 'orange-cell';
														$statusText = '50% Paid';
													} else {
														// You can add a default class or leave it empty if none of the conditions match.
														// echo 'default-cell';
														$statusText = 'Unknown Status';
													}
												} else {
													// Handle the case where either $estimateSalesValue or $payment is not numeric
													echo 'error-cell';
													$statusText = 'Error: Non-numeric value encountered';
												}
												?>">
										<?php echo $statusText; ?>
									</td>

									<!-- Program -->
									<td class="<?php echo ($row["program"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["program"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["program"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<!-- Post Sales Follow-Up -->
									<td class="<?php echo ($row["postSalesFollowUp"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["postSalesFollowUp"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["postSalesFollowUp"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<!-- Portfolio Email -->
									<td class="<?php echo ($row["protofolioEmail"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["protofolioEmail"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["protofolioEmail"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>

									<!-- New Business Meeting -->
									<td class="<?php echo ($row["newBusinessMeeting"] == 1) ? 'green-cell' : 'yellow-cell'; ?>">
										<?php if ($row["newBusinessMeeting"] == 1) : ?>
											<input type="checkbox" checked disabled>
										<?php elseif ($row["newBusinessMeeting"] == 0) : ?>
											<input type="checkbox" disabled>
										<?php endif; ?>
									</td>
									<!-- Inside the loop where you display rows -->
									<!--<td><?php echo calculateCompletionStatus([$row["preliminaryBrochures"], $row["emailClient"], $row["sheduleCM"], $row["chemMeeting"], $row["proposal"], $row["estimate"], $row["confirmation"], $row["cof"], $row["po"], $row["invoice"], $row["payment"], $row["program"], $row["postSalesFollowUp"], $row["protofolioEmail"], $row["newBusinessMeeting"]]); ?>%</td>-->
									<!-- Inside the loop where you display rows -->
									<td><?php echo calculateCompletionStatus([$row["preliminaryBrochures"], $row["emailClient"], $row["sheduleCM"], $row["chemMeeting"], $row["proposal"], $row["estimate"], $row["confirmation"], $row["cof"], $row["po"], $row["invoice"], $row["payment"], $row["program"], $row["postSalesFollowUp"], $row["protofolioEmail"], $row["newBusinessMeeting"]]); ?>%</td>

									<!--<a href="index.php?sub=createBatches&companycompany=<?php echo urlencode($row["company"]); ?>" class="btn btn-warning btn-sm">Create Batches</a>-->

									<?php
									echo '<td>';
									if ($row['emailClient'] == 1) {
										echo '<span class="label label-success">Active</span>';
									} else {
										echo '<span class="label label-danger">Inactive</span>';
									}
									echo '</td>';
									?>

									<td class="td-notes"><?php echo $row["notes"]; ?></td>
									<td class="td-followUp"><?php echo $row["followUp"]; ?></td>

								</tr>
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

				<!-- Add Modal HTML -->
				<div id="addEmployeeModal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form id="user_form">
								<div class="modal-header">
									<h4 class="modal-title">Add New Lead</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>

								<div class="modal-body">
									<div class="form-group">
										<label>Client</label>
										<select class="form-control" id="company" name="company">
											<?php
											$sql = "SELECT clientName , clientName FROM clients";
											$result = mysqli_query($conn, $sql);

											if (mysqli_num_rows($result) > 0) {
												while ($row = mysqli_fetch_assoc($result)) {
													echo "<option value=" . $row["clientName"] . ">" . $row["clientName"] . "</option>";
												}
											} else {
												echo '<option value="0">No Clients</option>';
											}
											?>
										</select>
									</div>

									<!--<div class="modal-body">					
					<div class="form-group">
						<label>Client</label>
						<select class="form-control" id="client" name="client">
	                            <?php
								$sql = "SELECT clientID, company FROM leads";
								$result = mysqli_query($conn, $sql);

								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value=" . $row["clientID"] . ">" . $row["clientName"] . "</option><br>";
									}
								} else {
									echo '<option value="0">No Clients</option>';
								}
								?>
	                        </select>

						<input type="text" name="client" id="client" class="form-control" autocomplete="off" required>
					</div>-->

									<div class="form-group">
										<label>Date</label>
										<input type="date" name="date" id="date" class="form-control" autocomplete="off" required>
									</div>
									<div class="form-group">
										<label>Lead</label>
										<input type="text" id="lead" name="lead" class="form-control" autocomplete="off" required>
									</div>

									<div class="form-group">
										<label for="leadtype">Lead Type</label>
										<select id="leadtype" name="leadtype" class="form-control" autocomplete="off" required>
											<option value="PLDP">PLDP</option>
											<option value="Capacity Building">Capacity Building</option>
											<option value="EDP">EDP</option>
											<option value="CSP">CSP</option>
											<option value="OAR">OAR</option>
											<option value="Team Experiences">Team Experiences</option>
											<option value="Other">Other</option>
										</select>
									</div>
									<div class="form-group">
										<label>Requirement</label>
										<input type="text" id="requirement" name="requirement" class="form-control" autocomplete="off" required>
									</div>
									<div class="form-group">
										<label>Estimate Sales Value</label>
										<input type="text" id="estimatesv" name="estimatesv" class="form-control" autocomplete="off" required>
									</div>
									<div class="form-group">
										<label>Lost Lead Date</label>
										<input type="date" id="lostlead" name="lostlead" class="form-control" autocomplete="off" required>
									</div>
									<div class="form-group">
										<label>Preliminary Brochures & LIT</label>
										<select id="perliminary" name="perliminary" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>

									</div>
									<div class="form-group">
										<label>Email Client</label>
										<select id="email" name="email" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>
									</div>
									<div class="form-group">
										<label>Shedule Chemistry Meeting</label>
										<select id="shedule" name="shedule" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>
									</div>
									<div class="form-group">
										<label>Chemistry Meeting</label>
										<select id="chemistry" name="chemistry" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>
									</div>
									<div class="form-group">
										<label>Proposal</label>
										<select id="proposal" name="proposal" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>
									</div>
									<div class="form-group">
										<label>Estimate</label>
										<select id="estimate" name="estimate" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>
									</div>
									<div class="form-group">
										<label>Confirmation</label>
										<select id="confirmation" name="confirmation" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>
									</div>
									<div class="form-group">
										<label>COF</label>
										<select id="cof" name="cof" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>
									</div>
									<div class="form-group">
										<label>PO</label>
										<select id="po" name="po" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>
									</div>
									<div class="form-group">
										<label>Invoice</label>
										<select id="invoice" name="invoice" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>
									</div>
									<div class="form-group">
										<label>Payment</label>
										<select id="payment" name="payment" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
											<option value="0.5">0.5</option>
										</select>
									</div>
									<div class="form-group">
										<label>Program</label>
										<select id="programs" name="program" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>
									</div>
									<div class="form-group">
										<label>Post Sales Follow Up</label>
										<select id="post" name="post" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>
									</div>
									<div class="form-group">
										<label>Protofolio E-Mail</label>
										<select id="protofolio" name="protofolio" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>
									</div>
									<div class="form-group">
										<label>New Business Meeting</label>
										<select id="meeting" name="meeting" class="form-control" autocomplete="off" required>
											<option value="1">1</option>
											<option value="0">0</option>
										</select>
									</div>
									<input type="hidden" name="completion" value="<?php $percentage ?>">

									<div class="form-group">
										<label>Notes</label>
										<input type="text" id="notes" name="notes" class="form-control" autocomplete="off" required>
									</div>

									<div class="form-group">
										<label>Follow up actions</label>
										<input type="text" id="followup" name="followup" class="form-control" autocomplete="off" required>
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
			</DIV>

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
									<label>Client</label>
									<input type="text" id="client_u" name="client" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Date</label>
									<input type="date" id="date_u" name="date" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Lead</label>
									<input type="text" id="lead_u" name="lead" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="leadtype">Lead Type</label>
									<select id="leadtype_u" name="leadtype" class="form-control" autocomplete="off" required>
										<option value="PLDP">PLDP</option>
										<option value="Capacity Building">Capacity Building</option>
										<option value="EDP">EDP</option>
										<option value="CSP">CSP</option>
										<option value="OAR">OAR</option>
										<option value="Team Experiences">Team Experiences</option>
										<option value="Team Experiences">Other</option>
									</select>
								</div>
								<div class="form-group">
									<label>Requirement</label>
									<input type="text" id="requirement_u" name="requirement" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Estimate Sales Value</label>
									<input type="email" id="sales_u" name="sales" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Lost Lead Date</label>
									<input type="date" id="lost_u" name="lost" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label>Preliminary Brochures & LIT</label>
									<input type="text" id="perliminary_u" name="perliminary" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label>Email Client</label>
									<input type="text" id="email_u" name="email" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Shedule Chemistry Meeting</label>
									<input type="text" id="shedulecm_u" name="shedulecm" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Chemistry Meeting</label>
									<input type="text" id="chemmeeting_u" name="chemmeeting" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Proposal</label>
									<input type="text" id="proposal_u" name="proposal" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Estimate</label>
									<input type="text" id="estimate_u" name="estimate" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Confirmation</label>
									<input type="email" id="confirmation_u" name="confirmation" class="form-control" required>
								</div>
								<div class="form-group">
									<label>COF</label>
									<input type="text" id="cof_u" name="cof" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label>PO</label>
									<input type="text" id="po_u" name="po" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label>Invoice</label>
									<input type="text" id="invoice_u" name="invoice" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Payment</label>
									<input type="text" id="payment_u" name="payment" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Program</label>
									<input type="text" id="program_u" name="program" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Post Sales Follow Up</label>
									<input type="text" id="followup_u" name="followup" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Protofolio E-Mail</label>
									<input type="text" id="protofolio_u" name="protofolio" class="form-control" required>
								</div>
								<div class="form-group">
									<label>New Business Meeting</label>
									<input type="email" id="business_u" name="business" class="form-control" required>
								</div>
								<!--<div class="form-group">
						<label>Completion Status</label>
						<input type="text" id="completion_u" name="completion" class="form-control" autocomplete="off" required>
					</div>-->
								<div class="form-group">
									<label>Notes</label>
									<input type="text" id="notes_u" name="notes" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label>Follow up Action</label>
									<input type="text" id="action_u" name="action" class="form-control" autocomplete="off" required>
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