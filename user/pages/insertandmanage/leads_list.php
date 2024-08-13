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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

    /* Existing CSS code 

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
    }*/
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

    @media screen and (max-width: 720px) {

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
        background-color: #afd9b5;
        /* Green color */
    }
    .grey-cell {
    background-color: #d8d8cf;
    }

    /*.orange-cell {
    background-color: #FF6E00;  Orange color 
}*/

    .yellow-cell {
        background-color: #ffde89;
        /* or any other styling */
    }

    .orange-cell {
        background-color: #F7be91;
        /* or any other styling for orange */
    }

    .purple-cell {
        background-color: #c6b7c8;
        /* or any other styling for orange */
    }
    .greeen-cell {
        background-color: #c6f0c2;
        /* or any other styling for orange */
    }

    .blue-cell {
        background-color: #b2cafe;
        /* or any other styling for orange */
    }
    .light-green-cell{
        background-color: #92bf8f;
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

    .table-wrapper {
        /* Default maximum height */
        max-height: 720px;
    }

    /* Media query for laptops and PCs */
    @media (max-width: 100px) {
        .table-wrapper {
            /* Adjust maximum height for laptops and PCs */
            max-height: auto;
            /* Remove the maximum height restriction */
            /*overflow-y: none;  Enable vertical scrolling if needed */
        }
    }

    .table thead th {
        position: sticky;
        top: 0;
        background-color: #ffff;
        /* Background color of the sticky header */
    }

    .fit-to-screen {
        width: auto;
        /* Set width to 100% of the table width */
        white-space: nowrap;
    }

    .red-cell {
        background-color: red;
    }

    .confidence-low {
        color: #001a50;
        font-weight: bold;
    }

    .confidence-discussion {
        color: #b0b003;
        font-weight: bold;
    }

    .confidence-pending {
        color: #cc9b1f;
        font-weight: bold;
    }

    .confidence-certain {
        color: lightgreen;
        font-weight: bold;
    }

    .confidence-confirmed {
        color: #64a460;
        font-weight: bold;
    }

    .confidence-invoice-only {
        color: #cc1f1f;
        font-weight: bold;
    }

    
.filter-icon {
            cursor: pointer;
            display: inline-block;
            width: 8px;
            height: 10px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16"><path d="M6 10.5V14l4-3.5V10.5l4-4V3H2v3.5l4 4zM2 2h12a1 1 0 0 1 .8 1.6L9.2 9.6a.5.5 0 0 0-.2.4v2.5L6 11.5V10a.5.5 0 0 0-.2-.4L1.2 3.6A1 1 0 0 1 2 2z"/></svg>') no-repeat center center;
            background-size: contain;
        }	
        
        .modal-header, .modal-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            margin: 0;
        }

        .close {
            font-size: 1.4rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        
#viewActionPointModal .modal-body {
    font-family: Arial, sans-serif;
}

#printHeader, #printFooter {
    text-align: center;
    margin-bottom: 20px;
}

#printFooter {
    position: fixed;
    bottom: 0;
    width: 100%;
}

@media print {
    body * {
        visibility: hidden;
    }
    #printableArea, #printableArea * {
        visibility: visible;
    }
    #printableArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
}
/* Ensure all columns in the client table have the same width, enable word wrapping, specify font size, and adjust header font size and row height */
.table-fixed {
    table-layout: fixed;
    width: 100%;
}

.table-fixed th,
.table-fixed td {
    width: 190px; /* Adjust the width as needed */
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal; /* Allow text to wrap in table cells */
    word-wrap: break-word; /* Ensure long words break and wrap to the next line */
    font-size: 11px; /* Specify font size for table content */
}

.table-fixed th {
    font-size: 7px; /* Specify header font size */
    background-color: #f8f8f8;
    word-wrap: break-word; /* Prevent text wrapping in the header */
    height: 20px; /* Adjust header row height */
    font-weight: normal; /* Remove bold from header */
}

/* Specific styles for each header */

/* Sales Stage */
.table-fixed th:nth-child(2) {
    width: 100px;
}

/* Client */
.table-fixed th:nth-child(3) {
    width: 120px;
    position: sticky; /* Ensure the fixed column is sticky */
    left: 0;
    background-color: #fff;
    z-index: 5;
}

/* Lead */
.table-fixed th:nth-child(4) {
    width: 150px;
}

/* account owner */
.table-fixed th:nth-child(5) {
    width: 150px;
}
/* strategic priority */
.table-fixed th:nth-child(6) {
    width: 150px;
}

/* date */
.table-fixed th:nth-child(7) {
    width: 100px;
}

/*date  */
.table-fixed th:nth-child(8) {
    width: 100px;
}

/* Estimate Sales Value */
.table-fixed th:nth-child(9) {
    width: 200px;
}

/* Lead Status*/
.table-fixed th:nth-child(10) {
    width: 100px;
}

/* Confidence Level Rating */
.table-fixed th:nth-child(11) {
    width: 110px;
}

/* Latest Action Point  */
.table-fixed th:nth-child(12) {
    width: 120px;
}

/* Engagement Completion Status  */
.table-fixed th:nth-child(13) {
    width: 220px;
}

/* Marketing Status */
.table-fixed th:nth-child(14) {
    width: 120px;
}

/* Lead Type  */
.table-fixed th:nth-child(15) {
    width: 100px;
}
/* Category Type  */
.table-fixed th:nth-child(16) {
    width: 105px;
}
/* Lost Lead Date  */
.table-fixed th:nth-child(17) {
    width: 105px;
}
/* Style for table cells */
.table-fixed td {
    padding: 8px;
    text-align: center; /* Center align table cell text */
    height: 60px; /* Adjust row height */
}
/* Specific widths for each header */
.table-fixed th:nth-child(15) { width: 100px; } /* Category Type */
.table-fixed th:nth-child(16) { width: 100px; } /* lost lead date */
.table-fixed th:nth-child(17) { width: 100px; } /* Schedule Chemistry Meeting */
.table-fixed th:nth-child(18) { width: 150px; } /* Chemistry Meeting */
.table-fixed th:nth-child(19) { width: 150px; } /* Proposal */
.table-fixed th:nth-child(20) { width: 150px; } /* Estimate */
.table-fixed th:nth-child(21) { width: 150px; } /* Confirmation */
.table-fixed th:nth-child(22) { width: 150px; }  /* COF */
.table-fixed th:nth-child(23) { width: 150px; }  /* PO */
.table-fixed th:nth-child(24) { width: 150px; } /* Invoice */
.table-fixed th:nth-child(25) { width: 150px; } /* Invoice Date */
.table-fixed th:nth-child(26) { width: 150px; } /* Payment */
.table-fixed th:nth-child(27) { width: 150px; } /* Payment Status */
.table-fixed th:nth-child(28) { width: 150px; } /* Program */
.table-fixed th:nth-child(29) { width: 150px; } /* Program Completed */
.table-fixed th:nth-child(30) { width: 150px; } /* Post Sales Follow Up */
.table-fixed th:nth-child(31) { width: 150px; } /* Marketing E-Mail */
.table-fixed th:nth-child(32) { width: 150px; } /* New Business Meeting */

/* Make the first column (edit/delete) smaller */
.table-fixed th:first-child,
.table-fixed td:first-child {
    width: 100px; /* Adjust the width for the first column */
}

.table-fixed td {
    padding: 8px;
    text-align: center;
    height: 60px; /* Adjust row height */
}


/* Fixed column styles */
.table-wrapper .fixed-column {
    position: sticky;
    left: 0;
    background-color: #fff;
    z-index: 5;
}
/* The download button has a green color */
table .download-btn {
    background-color: #2b77f0;
}

table .download-btn:hover {
    background-color: #000000;
}

.tick-action-point i.material-icons {
    font-size: 24px;
    color: Blue;
    cursor: pointer;
}
.td-name[contenteditable="true"]:focus {
    outline: none; /* Remove the default focus outline */
}

.td-name[contenteditable="true"] {
    border: none; /* Remove any borders */
    padding: 0; /* Remove padding if any */
}

.d-flex {
    display: flex;
}

.justify-content-between {
    justify-content: space-between;
}

.align-items-center {
    align-items: center;
}

.ml-2 {
    margin-left: 8px; /* Space between buttons */
}

.mb-3 {
    margin-bottom: 1rem; /* Adjust as needed */
}

.card-title {
    margin-bottom: 0; /* Remove margin below the title */
}

.card-body {
    height: 100px; /* Ensure enough height to align items vertically */
}




</style>

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3" style="height: 100px;">
                <h4 class="card-title mb-0">Active Leads</h4>
                <div>
                    <button id="refreshButton" class="btn btn-primary btn-sm ml-2">Refresh</button>
                    <a href="#addEmployeeModal" class="btn btn-info btn-sm ml-2" data-toggle="modal"><span>Add New</span></a>
                </div>
            </div>
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
    <div class="d-flex justify-content-end">
       <!-- <button id="refreshButton" class="btn btn-primary btn-sm ml-2">Refresh</button>
        <a href="#addEmployeeModal" class="btn btn-info btn-sm ml-2" data-toggle="modal"><span>Add New</span></a>-->
    </div>
</div>


<script>
document.getElementById('refreshButton').addEventListener('click', function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'pages/insertandmanage/backend/leads_list_backend.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(xhr.responseText);  // Log the response to see what's coming from the server
            try {
                var responseData = JSON.parse(xhr.responseText);
                if (Array.isArray(responseData)) {
                    updateTable(responseData);
                    alert('Refreshed successfully');
                } else {
                    console.error('Error: Expected an array but got:', responseData);
                }
            } catch (e) {
                console.error('Error parsing JSON:', e, xhr.responseText);
            }
        } else {
            console.error('Error fetching data.');
        }
    };
    xhr.onerror = function() {
        console.error('Network error');
    };
    xhr.send();
});



function updateTable(data) {
    data.forEach(function(rowData) {
        var row = document.querySelector(`tr[data-id="${rowData.clientID}"]`);
        if (row) {
            row.querySelector('[data-field="name"]').textContent = rowData.name;
            row.querySelector('[data-field="strategicPriority"]').textContent = rowData.strategicPriority;
            row.querySelector('[data-field="confindeceLevelRating"]').textContent = rowData.confindeceLevelRating;
            row.querySelector('[data-field="preliminaryBrochures"]').textContent = rowData.preliminaryBrochures;
            row.querySelector('[data-field="emailClient"]').textContent = rowData.emailClient;
            row.querySelector('[data-field="sheduleCM"]').textContent = rowData.sheduleCM;
            row.querySelector('[data-field="chemMeeting"]').textContent = rowData.chemMeeting;
            row.querySelector('[data-field="proposal"]').textContent = rowData.proposal;
            row.querySelector('[data-field="estimate"]').textContent = rowData.estimate;
            row.querySelector('[data-field="confirmation"]').textContent = rowData.confirmation;
            row.querySelector('[data-field="cof"]').textContent = rowData.cof;
            row.querySelector('[data-field="po"]').textContent = rowData.po;
            row.querySelector('[data-field="invoice"]').textContent = rowData.invoice;
            row.querySelector('[data-field="invoiceDT"]').textContent = rowData.invoiceDT;
            row.querySelector('[data-field="payment"]').textContent = rowData.payment;
            row.querySelector('[data-field="program"]').textContent = rowData.program;
            row.querySelector('[data-field="SurveyData"]').textContent = rowData.SurveyData;
            row.querySelector('[data-field="courseFacillitation"]').textContent = rowData.courseFacillitation;
            row.querySelector('[data-field="projectsAssessments"]').textContent = rowData.projectsAssessments;
            row.querySelector('[data-field="projects"]').textContent = rowData.projects;
            row.querySelector('[data-field="dataCertification"]').textContent = rowData.dataCertification;
            row.querySelector('[data-field="graduation"]').textContent = rowData.graduation;
            row.querySelector('[data-field="programCompleted"]').textContent = rowData.programCompleted;
            row.querySelector('[data-field="postSalesFollowUp"]').textContent = rowData.postSalesFollowUp;
            row.querySelector('[data-field="protofolioEmail"]').textContent = rowData.protofolioEmail;
            row.querySelector('[data-field="newBusinessMeeting"]').textContent = rowData.newBusinessMeeting;
        }
    });
}
</script>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-wrapper">
                    <table class="table table-hover Lead-table table-fixed">
                        <thead>
                            <tr>
                                <th class="fixed-column"></th>
                                <th style="display: none;">CompanyID</th>
                                <th>Leads Stage
                                    <span class="filter-icon" onclick="showDropdown(this, 2)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th class="fixed-column">Client
                                    <span class="filter-icon" onclick="showDropdown(this, 3)"></span>
                                    <div class="dropdown-content">
                                    <a href="#" onclick="sortTable('asc')">Sort A-Z</a>
                                    <br>
                                    <a href="#" onclick="sortTable('desc')">Sort Z-A</a>
                                    </div>
                                </th>
                                <th>Lead
                                    <span class="filter-icon" onclick="showDropdown(this, 4)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Account Owner
                                    <span class="filter-icon" onclick="showDropdown(this, 5)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Strategic Priority
                                    <span class="filter-icon" onclick="showDropdown(this, 6)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Date
                                    <span class="filter-icon" onclick="showDropdown(this, 7)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Requirement
                                    <span class="filter-icon" onclick="showDropdown(this, 8)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Estimate Sales Value
                                    <span class="filter-icon" onclick="showDropdown(this, 9)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Lead Status
                                    <span class="filter-icon" onclick="showDropdown(this, 10)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                
                                <th>Confidence Level Rating
                                    <span class="filter-icon" onclick="showDropdown(this, 11)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                
                                <th>Latest Action Point
                                    <span class="filter-icon" onclick="showDropdown(this, 12)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Engagement Completion Status
                                    <span class="filter-icon" onclick="showDropdown(this, 13)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Marketing Status
                                    <span class="filter-icon" onclick="showDropdown(this, 14)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Lead Type
                                    <span class="filter-icon" onclick="showDropdown(this, 15)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Category Type
                                    <span class="filter-icon" onclick="showDropdown(this, 16)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Lost Lead Date
                                    <span class="filter-icon" onclick="showDropdown(this, 17)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Preliminary Brochures & LIT
                                    <span class="filter-icon" onclick="showDropdown(this, 18)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Email Client
                                    <span class="filter-icon" onclick="showDropdown(this, 18)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Shedule Chemistry Meeting
                                    <span class="filter-icon" onclick="showDropdown(this, 19)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Chemistry Meeting
                                    <span class="filter-icon" onclick="showDropdown(this, 20)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Proposal
                                    <span class="filter-icon" onclick="showDropdown(this, 21)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Estimate
                                    <span class="filter-icon" onclick="showDropdown(this, 22)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Confirmation
                                    <span class="filter-icon" onclick="showDropdown(this, 23)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>COF
                                    <span class="filter-icon" onclick="showDropdown(this, 24)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>PO
                                    <span class="filter-icon" onclick="showDropdown(this, 25)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Invoice
                                    <span class="filter-icon" onclick="showDropdown(this, 26)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Invoice Date
                                    <span class="filter-icon" onclick="showDropdown(this, 27)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Payment
                                    <span class="filter-icon" onclick="showDropdown(this, 28)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                
                                <th>Pre Program
                                    <span class="filter-icon" onclick="showDropdown(this, 29)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                
                                <th>Survey and Data
                                    <span class="filter-icon" onclick="showDropdown(this, 30)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Course and facilitation
                                    <span class="filter-icon" onclick="showDropdown(this, 31)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Assessments
                                    <span class="filter-icon" onclick="showDropdown(this, 32)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Projects
                                    <span class="filter-icon" onclick="showDropdown(this, 32)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Data and Certification
                                    <span class="filter-icon" onclick="showDropdown(this, 33)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Graduation
                                    <span class="filter-icon" onclick="showDropdown(this, 34)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Program Completed
                                    <span class="filter-icon" onclick="showDropdown(this, 35)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Post Sales Follow Up
                                    <span class="filter-icon" onclick="showDropdown(this, 36)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>Marketing E-Mail
                                    <span class="filter-icon" onclick="showDropdown(this, 37)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                                <th>New Business Meeting
                                    <span class="filter-icon" onclick="showDropdown(this, 38)"></span>
                                    <div class="dropdown-content"></div>
                                </th>
                            </tr>
                        </thead>

                        <tfoot>
            <tr>
                <td colspan="11">
                    <button id="downloadTable" class="download-btn">Download</button>
                </td>
            </tr>
        </tfoot>

                        <tbody>
                        
                        <?php
                        function calculatecompletionStatus($row)
                        {
                            // Define stages and their corresponding weights
                            $stages = [
                                'preliminaryBrochures' => 20 / 10,
                                'emailClient' => 20 / 10,
                                'sheduleCM' => 20 / 10,
                                'chemMeeting' => 20 / 10,
                                'proposal' => 20 / 10,
                                'estimate' => 20 / 10,
                                'confirmation' => 20 / 10,
                                'cof' => 20 / 10,
                                'po' => 20 / 10,
                                'invoice' => 20 / 10,
                                'payment' => 20 / 10,
                                'program' => 10 / 2,
                                'SurveyData' => 10 / 2,
                                'courseFacillitation' => 30 / 2,
                                'projectsAssessments' => 30 / 2,
                                'projects' => 30,
                                'dataCertification' => 10 / 3,
                                'graduation' => 10 / 3,
                                'programCompleted' => 10 / 3
                            ];

                            // Calculate the completion percentage
                            $completionPercentage = 0;
                            foreach ($stages as $stage => $weight) {
                                if ($row[$stage] === 'Completed') {
                                    $completionPercentage += $weight;
                                }
                            }

                            return round($completionPercentage);
                        }
                        ?>
                        <?php
                        // Function to calculate completion status
                        function calculatemarketingStatus($data)
                        {
                            // Count the number of 'Completed' statuses
                            $completedCount = 0;
                            foreach ($data as $status) {
                                if ($status === 'Completed') {
                                    $completedCount++;
                                }
                            }

                            $totalCount = count($data); // Total count of values
                        
                            // Calculate percentage
                            $percentage = ($totalCount > 0) ? round(($completedCount / $totalCount) * 100) : 0;

                            return $percentage;
                        }
                        ?>
                            <?php
                            if (isset($_GET['search'])) {
                                $result = mysqli_query($conn, "SELECT * FROM leads WHERE company LIKE '%$search%'");
                            }
                            $result = mysqli_query($conn, "SELECT * FROM leads WHERE company LIKE '%$search%'");


                            $query = "SELECT *,
                            CASE
                                WHEN lostLeadDate != '' THEN 'Lost Lead'
                                WHEN postSalesFollowUp = 'Completed' AND programCompleted = 'In Progress' THEN 'Pending Completion'
                                WHEN postSalesFollowUp = 'Completed' THEN 'Post Sales Completed'
                                WHEN programCompleted = 'Completed' THEN 'Program Completed'
                                WHEN cof = 'Completed' THEN 'Program In Progress'
                                WHEN emailClient = 'Completed' THEN 'Pre Sales'
                                ELSE 'Pre Sales'
                            END AS salesStage,
                            CASE
                                WHEN lostLeadDate != '' THEN 6
                                WHEN postSalesFollowUp = 'Completed' AND programCompleted = 'In Progress' THEN 5
                                WHEN postSalesFollowUp = 'Completed' THEN 4
                                WHEN programCompleted = 'Completed' THEN 3
                                WHEN cof = 'Completed' THEN 2
                                WHEN emailClient = 'Completed' THEN 1
                                ELSE 1
                            END AS salesStageOrder
                            FROM leads
                            WHERE company LIKE '%$search%'
                            ORDER BY salesStageOrder ASC, clientID DESC";

                            // Execute the query
                            $result = mysqli_query($conn, $query);

                            // Check for query execution errors
                            if (!$result) {
                                die("Error executing query: " . mysqli_error($conn));
                            }

                            // Process the result set
                            while ($row = mysqli_fetch_array($result)) {
                                $Recordid = str_pad($row["clientID"], 5, '0', STR_PAD_LEFT);

                                // Determine sales stage and cell color
                                $salesStage = '';
                                $cellColor = '';

                                switch ($row['salesStage']) {
                                    case 'Pre Sales':
                                        $salesStage = 'Pre Sales';
                                        $cellColor = 'blue-cell';
                                        break;
                                    case 'Program In Progress':
                                        $salesStage = 'Program In Progress';
                                        $cellColor = 'light-green-cell';
                                        break;
                                    case 'Program Completed':
                                        $salesStage = 'Program Completed';
                                        $cellColor = 'green-cell';
                                        break;
                                    case 'Pending Completion':
                                        $salesStage = 'Pending Completion';
                                        $cellColor = 'orange-cell';
                                        break;
                                    case 'Post Sales Completed':
                                        $salesStage = 'Post Sales Completed';
                                        $cellColor = 'purple-cell';
                                        break;
                                    case 'Lost Lead':
                                        $salesStage = 'Lost Lead';
                                        $cellColor = 'red-cell';
                                        break;
                                    default:
                                        $salesStage = 'Pre Sales';
                                        $cellColor = 'blue-cell';
                                        break;
                                }

                                ?>
                                    <tr class="border-bottom" id="<?php echo $row["clientID"]; ?>">
                                    <tr class="<?php echo (!empty($row["lostLeadDate"])) ? 'red-row' : ''; ?>">
                                        <td>
                                            <a href="#editEmployeeModal" class="edit" data-toggle="modal">
                                                <i class="material-icons update" data-toggle="tooltip" 
                                                data-id="<?php echo $row["clientID"]; ?>" 
                                                data-salesStage="<?php echo $row["salesStage"]; ?>" 
                                                data-client="<?php echo $row["company"]; ?>" 
                                                data-lead="<?php echo $row["lead"]; ?>" 
                                                data-name="<?php echo $row["name"]; ?>" 
                                                data-strategicPriority="<?php echo $row["strategicPriority"]; ?>" 
                                                data-date="<?php echo $row["date"]; ?>" 
                                                data-requirement="<?php echo $row["requirement"]; ?>"
                                                data-estimatesv="<?php echo $row["estimateSalesValue"]; ?>" 
                                                data-status="<?php echo $row["status"]; ?>"
                                                data-completion="<?php echo $row["completionStatus"]; ?>"
                                                data-marketingstatus="<?php echo $row["marketingStatus"]; ?>"
                                                data-followup="<?php echo $row["followUp"]; ?>"  
                                                data-confidenseLevelRating="<?php echo $row["confindeceLevelRating"]; ?>"
                                                data-leadtype="<?php echo $row["leadType"]; ?>" 
                                                data-categoryType="<?php echo $row["categoryType"]; ?>" 
                                                data-lostlead="<?php echo $row["lostLeadDate"]; ?>" 
                                                data-perliminary="<?php echo $row["preliminaryBrochures"]; ?>" 
                                                data-email="<?php echo $row["emailClient"]; ?>" 
                                                data-shedule="<?php echo $row["sheduleCM"]; ?>" 
                                                data-chemistry="<?php echo $row["chemMeeting"]; ?>" 
                                                data-proposal="<?php echo $row["proposal"]; ?>" 
                                                data-estimate="<?php echo $row["estimate"]; ?>" 
                                                data-confirmation="<?php echo $row["confirmation"]; ?>" 
                                                data-cof="<?php echo $row["cof"]; ?>" 
                                                data-po="<?php echo $row["po"]; ?>" 
                                                data-invoice="<?php echo $row["invoice"]; ?>" 
                                                data-invoiceDT="<?php echo $row["invoiceDT"]; ?>"
                                                data-payment="<?php echo $row["payment"]; ?>" 
                                                data-programs="<?php echo $row["program"]; ?>"
                                                data-SurveyData="<?php echo $row["SurveyData"]; ?>"
                                                data-courseFacillitation="<?php echo $row["courseFacillitation"]; ?>"
                                                data-projectsAssessments="<?php echo $row["projectsAssessments"]; ?>"
                                                data-projects="<?php echo $row["projects"]; ?>"
                                                data-dataCertification="<?php echo $row["dataCertification"]; ?>"
                                                data-graduation="<?php echo $row["graduation"]; ?>" 
                                                data-programCompleted="<?php echo $row["programCompleted"]; ?>" 
                                                data-post="<?php echo $row["postSalesFollowUp"]; ?>" 
                                                data-protofolio="<?php echo $row["protofolioEmail"]; ?>" 
                                                data-meeting="<?php echo $row["newBusinessMeeting"]; ?>" 
                                                 title="Edit Active Leads"></i>


                                            </a>
                                            <!-- Tick Action Point Button -->
    <a href="#editActionPointModal" class="tick-action-point" data-id="<?php echo $row['clientID']; ?>" data-toggle="modal">
        <i class="material-icons" data-toggle="tooltip" title="Add Action Point">check</i>
    </a>
    <!-- View Action Point Button -->
    <a href="#viewActionPointModal" class="view-action-point" data-id="<?php echo $row["clientID"]; ?>" data-toggle="modal">
        <i class="material-icons" data-toggle="tooltip" title="View Activity Log">visibility</i>
    </a>
                                            <span class="hidden-id" data-id="<?php echo $row["clientID"]; ?>" style="display:none;"></span>
                                        </td>
                                        <?php


                                        ?>
                                        <td style="display: none;"><?php echo "C" . str_pad($row["clientID"], 5, '0', STR_PAD_LEFT); ?></td>
                                    
                                        <td class="<?php echo $cellColor; ?>"><?php echo $salesStage; ?></td>
                                        <td  class="fixed-column company-column"><?php echo $row["company"]; ?>
                                        <td class="td-lead"><?php echo $row["lead"]; ?></td>
                                        <td class="td-name" contenteditable="true" data-id="<?php echo $row["clientID"]; ?>"><?php echo htmlspecialchars($row["name"]); ?></td>
                                        <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load saved names from localStorage
        loadSavedNames();

        document.querySelectorAll('.td-name').forEach(function(cell) {
            cell.addEventListener('blur', function() {
                var clientId = this.getAttribute('data-id');
                var name = this.textContent.trim();

                // Save to localStorage
                saveNameToLocalStorage(clientId, name);

                // Send AJAX request to update name in the backend
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'pages/insertandmanage/backend/leads_list_backend.php', true); // Ensure the correct path
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status !== 200) {
                        console.error('Error updating name:', xhr.responseText);
                    }
                };
                xhr.send('id=' + clientId + '&field=name&value=' + encodeURIComponent(name));
            });
        });
    });

    function saveNameToLocalStorage(clientId, name) {
        var data = localStorage.getItem('names') ? JSON.parse(localStorage.getItem('names')) : {};
        data[clientId] = name;
        localStorage.setItem('names', JSON.stringify(data));
    }

    function loadSavedNames() {
        var data = localStorage.getItem('names') ? JSON.parse(localStorage.getItem('names')) : {};
        Object.keys(data).forEach(function(clientId) {
            var cell = document.querySelector('.td-name[data-id="' + clientId + '"]');
            if (cell) {
                cell.textContent = data[clientId];
            }
        });
    }
    </script>

                                        <td class="td-strategicPriority">
        <select class="strategicPriorityDropdown" data-id="<?php echo $row["clientID"]; ?>">
            <option value="1" <?php if ($row["strategicPriority"] == 1)
                echo 'selected'; ?>>1</option>
            <option value="2" <?php if ($row["strategicPriority"] == 2)
                echo 'selected'; ?>>2</option>
            <option value="3" <?php if ($row["strategicPriority"] == 3)
                echo 'selected'; ?>>3</option>
            <option value="4" <?php if ($row["strategicPriority"] == 4)
                echo 'selected'; ?>>4</option>
            <option value="5" <?php if ($row["strategicPriority"] == 5)
                echo 'selected'; ?>>5</option>
        </select>
    </td>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load saved priorities from localStorage
        loadSavedPriorities();

        document.querySelectorAll('.strategicPriorityDropdown').forEach(function(dropdown) {
            dropdown.addEventListener('change', function() {
                var clientId = this.getAttribute('data-id');
                var strategicPriority = this.value;

                // Save to localStorage
                saveToLocalStorage(clientId, strategicPriority);

                // Send AJAX request to update strategicPriority in the backend
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'pages/insertandmanage/backend/leads_list_backend.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status !== 200) {
                        console.error('Error updating Strategic Priority:', xhr.responseText);
                    }
                };
                xhr.send('id=' + clientId + '&field=strategicPriority&value=' + strategicPriority);
            });
        });
    });

    function saveToLocalStorage(clientId, strategicPriority) {
        var data = localStorage.getItem('strategicPriorities') ? JSON.parse(localStorage.getItem('strategicPriorities')) : {};
        data[clientId] = strategicPriority;
        localStorage.setItem('strategicPriorities', JSON.stringify(data));
    }

    function loadSavedPriorities() {
        var data = localStorage.getItem('strategicPriorities') ? JSON.parse(localStorage.getItem('strategicPriorities')) : {};
        Object.keys(data).forEach(function(clientId) {
            var dropdown = document.querySelector('.strategicPriorityDropdown[data-id="' + clientId + '"]');
            if (dropdown) {
                dropdown.value = data[clientId];
            }
        });
    }
    </script>
                                        <td ><?php echo $row["date"]; ?></td>
                                        <td class="td-requirement"><?php echo $row["requirement"]; ?></td>
                                        <td ><?php echo $row["estimateSalesValue"]; ?></td>
                                        <?php
                                        echo '<td style="background-color:';
                                        if ($row['lostLeadDate'] != '') {
                                            echo '#ff9690; color: Black;">Inactive Lead';
                                        } elseif ($row['postSalesFollowUp'] == 'Completed') {
                                            echo '#73ad70; color: Black;">Close Lead';
                                        } elseif ($row['emailClient'] == 'Completed') {
                                            echo '#afd9b5; color: Black;">Active Lead';
                                        } else {
                                            echo '#ff9690; color: Black;">Inactive Lead';
                                        }
                                        echo '</td>';
                                        ?>

    
    
    <td>
        <select class="confidenceLevelDropdown" data-id="<?php echo $row["clientID"]; ?>">
            <option value="1" <?php if ($row["confindeceLevelRating"] == 1)
                echo 'selected'; ?>>1</option>
            <option value="2" <?php if ($row["confindeceLevelRating"] == 2)
                echo 'selected'; ?>>2</option>
            <option value="3" <?php if ($row["confindeceLevelRating"] == 3)
                echo 'selected'; ?>>3</option>
            <option value="4" <?php if ($row["confindeceLevelRating"] == 4)
                echo 'selected'; ?>>4</option>
            <option value="5" <?php if ($row["confindeceLevelRating"] == 5)
                echo 'selected'; ?>>5</option>
        </select>
    </td>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load saved confidence levels from localStorage
        loadSavedConfidenceLevels();

        document.querySelectorAll('.confidenceLevelDropdown').forEach(function(dropdown) {
            dropdown.addEventListener('change', function() {
                var clientId = this.getAttribute('data-id');
                var confidenceLevelRating = this.value;

                // Save to localStorage
                saveConfidenceLevelToLocalStorage(clientId, confidenceLevelRating);

                // Send AJAX request to update confidenceLevelRating in the backend
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'pages/insertandmanage/backend/leads_list_backend.php', true); // Ensure the correct path
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status !== 200) {
                        console.error('Error updating Confidence Level Rating:', xhr.responseText);
                    }
                };
                xhr.send('id=' + clientId + '&field=confidenceLevelRating&value=' + confidenceLevelRating);
            });
        });
    });

    function saveConfidenceLevelToLocalStorage(clientId, confidenceLevelRating) {
        var data = localStorage.getItem('confidenceLevels') ? JSON.parse(localStorage.getItem('confidenceLevels')) : {};
        data[clientId] = confidenceLevelRating;
        localStorage.setItem('confidenceLevels', JSON.stringify(data));
    }

    function loadSavedConfidenceLevels() {
        var data = localStorage.getItem('confidenceLevels') ? JSON.parse(localStorage.getItem('confidenceLevels')) : {};
        Object.keys(data).forEach(function(clientId) {
            var dropdown = document.querySelector('.confidenceLevelDropdown[data-id="' + clientId + '"]');
            if (dropdown) {
                dropdown.value = data[clientId];
            }
        });
    }
    </script>
                                            <td class="td-followUp"><?php echo $row["followUp"]; ?></td>
                                        
                                            <td><?php echo calculatecompletionStatus($row); ?>%</td>
    <td><?php echo calculatemarketingStatus([$row["postSalesFollowUp"], $row["protofolioEmail"], $row["newBusinessMeeting"]]); ?>%</td>


                                    
    <?php
    // Example PHP script to set selected values
    $selectedLType = '';
    $selectedCategoryType = '';

    // Assuming $row contains data retrieved from the database
    $selectedLType = isset($row["leadType"]) ? $row["leadType"] : '';
    $selectedCategoryType = isset($row["categoryType"]) ? $row["categoryType"] : '';
    ?>
                                        <td><?php echo $row["categoryType"]; ?></td>
                                        <td><?php echo $row["leadType"]; ?></td>
                                        <td class="<?php echo (!empty($row["lostLeadDate"])) ? 'red-cell' : ''; ?>">
                                            <?php echo $row["lostLeadDate"]; ?>
                                        </td>

                                    


      <!-- Preliminary Brochures -->
      <td class="<?php
      switch ($row["preliminaryBrochures"]) {
          case 'Not Initiated':
              echo 'yellow-cell preliminary';
              break;
          case 'Not Applicable':
              echo 'grey-cell preliminary';
              break;
          case 'In Progress':
              echo 'orange-cell preliminary';
              break;
          case 'Completed':
              echo 'green-cell preliminary';
              break;
          default:
              echo 'yellow-cell preliminary'; // Default to yellow for 'Not Initiated'
      }
      ?>" data-field="preliminaryBrochures" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="preliminaryBrochures" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["preliminaryBrochures"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["preliminaryBrochures"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["preliminaryBrochures"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["preliminaryBrochures"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>
    <script>
    function updateStage(cell, select) {
        const stage = select.value;
        const id = cell.getAttribute('data-id');
        const field = select.getAttribute('data-field');

        let className = '';
        switch(stage) {
            case 'Not Initiated':
                className = 'yellow-cell';
                break;
            case 'Not Applicable':
                className = 'grey-cell';
                break;
            case 'In Progress':
                className = 'orange-cell';
                break;
            case 'Completed':
                className = 'green-cell';
                break;
            default:
                className = 'yellow-cell'; // Default to yellow for 'Not Initiated'
        }

        cell.className = className;

        // Save to localStorage
        saveStageToLocalStorage(id, field, stage);
    }

    function saveStageToLocalStorage(id, field, value) {
        let data = localStorage.getItem('tableData') ? JSON.parse(localStorage.getItem('tableData')) : {};
        if (!data[id]) data[id] = {};
        data[id][field] = value;
        localStorage.setItem('tableData', JSON.stringify(data));
    }

    function loadStagesFromLocalStorage() {
        let data = localStorage.getItem('tableData') ? JSON.parse(localStorage.getItem('tableData')) : {};
        Object.keys(data).forEach(id => {
            Object.keys(data[id]).forEach(field => {
                const cell = document.querySelector(`td[data-id='${id}'][data-field='${field}']`);
                if (cell) {
                    const select = cell.querySelector('select');
                    if (select) {
                        select.value = data[id][field];
                        updateStage(cell, select); // Update the cell color
                    }
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = document.querySelectorAll('.dropdown select');
        dropdowns.forEach(function (dropdown) {
            dropdown.addEventListener('change', function () {
                const cell = this.closest('td');
                updateStage(cell, this);
            });
        });

        loadStagesFromLocalStorage(); // Load saved stages from localStorage on page load
    });

    </script>


        <!-- Email Client -->
        <td class="<?php
        switch ($row["emailClient"]) {
            case 'Not Initiated':
                echo 'yellow-cell email';
                break;
            case 'Not Applicable':
                echo 'grey-cell email';
                break;
            case 'In Progress':
                echo 'orange-cell email';
                break;
            case 'Completed':
                echo 'green-cell email';
                break;
            default:
                echo 'yellow-cell email'; // Default to yellow for 'Not Initiated'
        }
        ?>" data-field="emailClient" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="emailClient" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["emailClient"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["emailClient"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["emailClient"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["emailClient"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>
    
        <!-- Schedule CM -->
        <td class="<?php
        switch ($row["sheduleCM"]) {
            case 'Not Initiated':
                echo 'yellow-cell shedulecm';
                break;
            case 'Not Applicable':
                echo 'grey-cell shedulecm';
                break;
            case 'In Progress':
                echo 'orange-cell shedulecm';
                break;
            case 'Completed':
                echo 'green-cell shedulecm';
                break;
            default:
                echo 'yellow-cell shedulecm'; // Default to yellow for 'Not Initiated'
        }
        ?>" data-field="sheduleCM" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="sheduleCM" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["sheduleCM"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["sheduleCM"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["sheduleCM"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["sheduleCM"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- Chem Meeting -->
        <td class="<?php
        switch ($row["chemMeeting"]) {
            case 'Not Initiated':
                echo 'yellow-cell chemmeeting';
                break;
            case 'Not Applicable':
                echo 'grey-cell chemmeeting';
                break;
            case 'In Progress':
                echo 'orange-cell chemmeeting';
                break;
            case 'Completed':
                echo 'green-cell chemmeeting';
                break;
            default:
                echo 'yellow-cell chemmeeting'; // Default to yellow for 'Not Initiated'
        }
        ?>" data-field="chemMeeting" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="chemMeeting" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["chemMeeting"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["chemMeeting"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["chemMeeting"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["chemMeeting"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- Proposal -->
        <td class="<?php
        switch ($row["proposal"]) {
            case 'Not Initiated':
                echo 'yellow-cell proposal';
                break;
            case 'Not Applicable':
                echo 'grey-cell proposal';
                break;
            case 'In Progress':
                echo 'orange-cell proposal';
                break;
            case 'Completed':
                echo 'green-cell proposal';
                break;
            default:
                echo 'yellow-cell proposal'; // Default to yellow for 'Not Initiated'
        }
        ?>" data-field="proposal" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="proposal" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["proposal"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["proposal"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["proposal"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["proposal"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- Estimate -->
        <td class="<?php
        switch ($row["estimate"]) {
            case 'Not Initiated':
                echo 'yellow-cell estimate';
                break;
            case 'Not Applicable':
                echo 'grey-cell estimate';
                break;
            case 'In Progress':
                echo 'orange-cell estimate';
                break;
            case 'Completed':
                echo 'green-cell estimate';
                break;
            default:
                echo 'yellow-cell estimate'; // Default to yellow for 'Not Initiated'
        }
        ?>" data-field="estimate" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="estimate" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["estimate"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["estimate"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["estimate"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["estimate"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- Confirmation -->
        <td class="<?php
        switch ($row["confirmation"]) {
            case 'Not Initiated':
                echo 'yellow-cell confirmation';
                break;
            case 'Not Applicable':
                echo 'grey-cell confirmation';
                break;
            case 'In Progress':
                echo 'orange-cell confirmation';
                break;
            case 'Completed':
                echo 'green-cell confirmation';
                break;
            default:
                echo 'yellow-cell confirmation'; // Default to yellow for 'Not Initiated'
        }
        ?>" data-field="confirmation" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="confirmation" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["confirmation"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["confirmation"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["confirmation"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["confirmation"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- COF -->
        <td class="<?php
        switch ($row["cof"]) {
            case 'Not Initiated':
                echo 'yellow-cell cof';
                break;
            case 'Not Applicable':
                echo 'grey-cell cof';
                break;
            case 'In Progress':
                echo 'orange-cell cof';
                break;
            case 'Completed':
                echo 'green-cell cof';
                break;
            default:
                echo 'yellow-cell cof'; // Default to yellow for 'Not Initiated'
        }
        ?>" data-field="cof" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="cof" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["cof"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["cof"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["cof"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["cof"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- PO -->
        <td class="<?php
        switch ($row["po"]) {
            case 'Not Initiated':
                echo 'yellow-cell po';
                break;
            case 'Not Applicable':
                echo 'grey-cell po';
                break;
            case 'In Progress':
                echo 'orange-cell po';
                break;
            case 'Completed':
                echo 'green-cell po';
                break;
            default:
                echo 'yellow-cell po'; // Default to yellow for 'Not Initiated'
        }
        ?>" data-field="po" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="po" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["po"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["po"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["po"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["po"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- Invoice -->
        <td class="<?php
        switch ($row["invoice"]) {
            case 'Not Initiated':
                echo 'yellow-cell invoice';
                break;
            case 'Not Applicable':
                echo 'grey-cell invoice';
                break;
            case 'In Progress':
                echo 'orange-cell invoice';
                break;
            case 'Completed':
                echo 'green-cell invoice';
                break;
            default:
                echo 'yellow-cell invoice'; // Default to yellow for 'Not Initiated'
        }
        ?>" data-field="invoice" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="invoice" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["invoice"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["invoice"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["invoice"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["invoice"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- Invoice Date -->
    <td class="<?php echo (!empty($row["invoiceDT"])) ? 'yellow-cell' : 'green-cell'; ?>" data-field="invoiceDT" data-id="<?php echo $row["clientID"]; ?>">
        <input type="date" value="<?php echo htmlspecialchars($row["invoiceDT"]); ?>" onchange="updateDateField(this)" />
        </td>

        <!-- Payment -->
    <td class="<?php
    switch ($row["payment"]) {
        case 'Fully Paid':
            echo 'green-cell payment';
            break;
        case 'Not Paid':
            echo 'yellow-cell payment';
            break;
        case 'Part Paid':
            echo 'orange-cell payment';
            break;
        default:
            echo 'yellow-cell payment'; // Default to yellow for 'Not Paid'
    }
    ?>" data-field="payment" data-id="<?php echo $row["clientID"]; ?>">
        <div class="dropdown">
            <select data-field="payment" onchange="updateStage(this.parentElement.parentElement, this)">
                <option value="Not Paid" <?php echo $row["payment"] == 'Not Paid' ? 'selected' : ''; ?>>Not Paid</option>
                <option value="Part Paid" <?php echo $row["payment"] == 'Part Paid' ? 'selected' : ''; ?>>Part Paid</option>
                <option value="Fully Paid" <?php echo $row["payment"] == 'Fully Paid' ? 'selected' : ''; ?>>Fully Paid</option>
            </select>
        </div>
    </td>

        <!-- Program -->
        <td class="<?php
        switch ($row["program"]) {
            case 'Not Initiated':
                echo 'yellow-cell';
                break;
            case 'Not Applicable':
                echo 'grey-cell';
                break;
            case 'In Progress':
                echo 'orange-cell';
                break;
            case 'Completed':
                echo 'green-cell';
                break;
            default:
                echo 'yellow-cell';
        }
        ?>" data-field="program" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="program" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["program"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["program"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["program"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["program"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>


        <!-- Survey and Data -->
        <td class="<?php
        switch ($row["SurveyData"]) {
            case 'Not Initiated':
                echo 'yellow-cell';
                break;
            case 'Not Applicable':
                echo 'grey-cell';
                break;
            case 'In Progress':
                echo 'orange-cell';
                break;
            case 'Completed':
                echo 'green-cell';
                break;
            default:
                echo 'yellow-cell';
        }
        ?>" data-field="SurveyData" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="SurveyData" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["SurveyData"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["SurveyData"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["SurveyData"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["SurveyData"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- Course and Facilitation -->
        <td class="<?php
        switch ($row["courseFacillitation"]) {
            case 'Not Initiated':
                echo 'yellow-cell';
                break;
            case 'Not Applicable':
                echo 'grey-cell';
                break;
            case 'In Progress':
                echo 'orange-cell';
                break;
            case 'Completed':
                echo 'green-cell';
                break;
            default:
                echo 'yellow-cell';
        }
        ?>" data-field="courseFacillitation" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="courseFacillitation" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["courseFacillitation"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["courseFacillitation"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["courseFacillitation"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["courseFacillitation"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!--  Assessments -->
        <td class="<?php
        switch ($row["projectsAssessments"]) {
            case 'Not Initiated':
                echo 'yellow-cell';
                break;
            case 'Not Applicable':
                echo 'grey-cell';
                break;
            case 'In Progress':
                echo 'orange-cell';
                break;
            case 'Completed':
                echo 'green-cell';
                break;
            default:
                echo 'yellow-cell';
        }
        ?>" data-field="projectsAssessments" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="projectsAssessments" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["projectsAssessments"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["projectsAssessments"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["projectsAssessments"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["projectsAssessments"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- Projects  -->
        <td class="<?php
        switch ($row["projects"]) {
            case 'Not Initiated':
                echo 'yellow-cell';
                break;
            case 'Not Applicable':
                echo 'grey-cell';
                break;
            case 'In Progress':
                echo 'orange-cell';
                break;
            case 'Completed':
                echo 'green-cell';
                break;
            default:
                echo 'yellow-cell';
        }
        ?>" data-field="projects" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="projects" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["projects"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["projects"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["projects"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["projects"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- Data and Certification -->
        <td class="<?php
        switch ($row["dataCertification"]) {
            case 'Not Initiated':
                echo 'yellow-cell';
                break;
            case 'Not Applicable':
                echo 'grey-cell';
                break;
            case 'In Progress':
                echo 'orange-cell';
                break;
            case 'Completed':
                echo 'green-cell';
                break;
            default:
                echo 'yellow-cell';
        }
        ?>" data-field="dataCertification" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="dataCertification" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["dataCertification"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["dataCertification"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["dataCertification"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["dataCertification"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- Graduation -->
        <td class="<?php
        switch ($row["graduation"]) {
            case 'Not Initiated':
                echo 'yellow-cell';
                break;
            case 'Not Applicable':
                echo 'grey-cell';
                break;
            case 'In Progress':
                echo 'orange-cell';
                break;
            case 'Completed':
                echo 'green-cell';
                break;
            default:
                echo 'yellow-cell';
        }
        ?>" data-field="graduation" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="graduation" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["graduation"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["graduation"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["graduation"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["graduation"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- Program Completed -->
        <td class="<?php
        switch ($row["programCompleted"]) {
            case 'Not Initiated':
                echo 'yellow-cell';
                break;
            case 'Not Applicable':
                echo 'grey-cell';
                break;
            case 'In Progress':
                echo 'orange-cell';
                break;
            case 'Completed':
                echo 'green-cell';
                break;
            default:
                echo 'yellow-cell';
        }
        ?>" data-field="programCompleted" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="programCompleted" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["programCompleted"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["programCompleted"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["programCompleted"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["programCompleted"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- Post Sales Follow-Up -->
        <td class="<?php
        switch ($row["postSalesFollowUp"]) {
            case 'Not Initiated':
                echo 'yellow-cell';
                break;
            case 'Not Applicable':
                echo 'grey-cell';
                break;
            case 'In Progress':
                echo 'orange-cell';
                break;
            case 'Completed':
                echo 'green-cell';
                break;
            default:
                echo 'yellow-cell';
        }
        ?>" data-field="postSalesFollowUp" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="postSalesFollowUp" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["postSalesFollowUp"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["postSalesFollowUp"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["postSalesFollowUp"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["postSalesFollowUp"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- Portfolio Email -->
        <td class="<?php
        switch ($row["protofolioEmail"]) {
            case 'Not Initiated':
                echo 'yellow-cell';
                break;
            case 'Not Applicable':
                echo 'grey-cell';
                break;
            case 'In Progress':
                echo 'orange-cell';
                break;
            case 'Completed':
                echo 'green-cell';
                break;
            default:
                echo 'yellow-cell';
        }
        ?>" data-field="protofolioEmail" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="protofolioEmail" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["protofolioEmail"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["protofolioEmail"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["protofolioEmail"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["protofolioEmail"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

        <!-- New Business Meeting -->
        <td class="<?php
        switch ($row["newBusinessMeeting"]) {
            case 'Not Initiated':
                echo 'yellow-cell';
                break;
            case 'Not Applicable':
                echo 'grey-cell';
                break;
            case 'In Progress':
                echo 'orange-cell';
                break;
            case 'Completed':
                echo 'green-cell';
                break;
            default:
                echo 'yellow-cell';
        }
        ?>" data-field="newBusinessMeeting" data-id="<?php echo $row["clientID"]; ?>">
            <div class="dropdown">
                <select data-field="newBusinessMeeting" onchange="updateStage(this.parentElement.parentElement, this)">
                    <option value="Not Initiated" <?php echo $row["newBusinessMeeting"] == 'Not Initiated' ? 'selected' : ''; ?>>Not Initiated</option>
                    <option value="Not Applicable" <?php echo $row["newBusinessMeeting"] == 'Not Applicable' ? 'selected' : ''; ?>>Not Applicable</option>
                    <option value="In Progress" <?php echo $row["newBusinessMeeting"] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $row["newBusinessMeeting"] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
        </td>

    </tr>
    <script>
    function updateStage(cell, select) {
        const stage = select.value;
        const id = cell.getAttribute('data-id');
        const field = select.getAttribute('data-field');

        let className = '';
        switch(stage) {
            case 'Not Initiated':
            case 'Not Paid':
                className = 'yellow-cell';
                break;
            case 'Not Applicable':
                className = 'grey-cell';
                break;
            case 'In Progress':
            case 'Part Paid':
                className = 'orange-cell';
                break;
            case 'Completed':
            case 'Fully Paid':
                className = 'green-cell';
                break;
            default:
                className = 'yellow-cell'; // Default to yellow for 'Not Initiated' or 'Not Paid'
        }

        cell.className = className + ' ' + field; // Ensure field class is appended for custom styles

        // Save to localStorage
        saveToLocalStorage(id, field, stage);

        // Send AJAX request to update the database
        fetch('pages/insertandmanage/backend/leads_list_backend.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                id: id,
                field: field,
                value: stage
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.statusCode == 200){
                console.log("Data updated successfully");
            } else {
                console.error("Failed to update data");
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function updateDateField(input) {
        const date = input.value;
        const id = input.closest('tr').getAttribute('data-id');
        const field = input.getAttribute('data-field');

        const cell = input.parentElement;
        if (date) {
            cell.className = 'green-cell';
            // Save to localStorage only if the date is filled
            saveToLocalStorage(id, field, date);

            // Send AJAX request to update the database
            fetch('pages/insertandmanage/backend/leads_list_backend.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    id: id,
                    field: field,
                    value: date
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.statusCode == 200){
                    console.log("Data updated successfully");
                } else {
                    console.error("Failed to update data");
                }
            })
            .catch(error => console.error('Error:', error));
        } else {
            cell.className = 'yellow-cell';
            // Remove from localStorage if the date is cleared
            removeFromLocalStorage(id, field);

            // Send AJAX request to update the database
            fetch('pages/insertandmanage/backend/leads_list_backend.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    id: id,
                    field: field,
                    value: ''
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.statusCode == 200){
                    console.log("Data updated successfully");
                } else {
                    console.error("Failed to update data");
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function saveToLocalStorage(id, field, value) {
        const data = JSON.parse(localStorage.getItem('tableData')) || {};
        if (!data[id]) {
            data[id] = {};
        }
        data[id][field] = value;
        localStorage.setItem('tableData', JSON.stringify(data));
    }

    function removeFromLocalStorage(id, field) {
        const data = JSON.parse(localStorage.getItem('tableData')) || {};
        if (data[id]) {
            delete data[id][field];
            if (Object.keys(data[id]).length === 0) {
                delete data[id];
            }
            localStorage.setItem('tableData', JSON.stringify(data));
        }
    }

    function loadFromLocalStorage() {
        const data = JSON.parse(localStorage.getItem('tableData')) || {};
        Object.keys(data).forEach(id => {
            const row = document.querySelector(`tr[data-id="${id}"]`);
            if (row) {
                Object.keys(data[id]).forEach(field => {
                    const cell = row.querySelector(`td[data-field="${field}"]`);
                    if (cell) {
                        const value = data[id][field];
                        if (field === 'invoiceDT') {
                            const input = cell.querySelector('input[type="date"]');
                            if (input) {
                                input.value = value;
                                cell.className = value ? 'green-cell' : 'yellow-cell';
                            }
                        } else {
                            const select = cell.querySelector('select');
                            if (select) {
                                select.value = value;
                                switch(value) {
                                    case 'Not Initiated':
                                    case 'Not Paid':
                                        cell.className = 'yellow-cell';
                                        break;
                                    case 'Not Applicable':
                                        cell.className = 'grey-cell';
                                        break;
                                    case 'In Progress':
                                    case 'Part Paid':
                                        cell.className = 'orange-cell';
                                        break;
                                    case 'Completed':
                                    case 'Fully Paid':
                                        cell.className = 'green-cell';
                                        break;
                                    default:
                                        cell.className = 'yellow-cell'; // Default to yellow for 'Not Initiated' or 'Not Paid'
                                }
                                cell.className += ` ${field}`; // Ensure field class is appended for custom styles
                            }
                        }
                    }
                });
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        loadFromLocalStorage();

        const dropdowns = document.querySelectorAll('.dropdown select');
        dropdowns.forEach(function (dropdown) {
            dropdown.addEventListener('change', function () {
                const cell = this.closest('td');
                updateStage(cell, this);
            });
        });

        const dateInputs = document.querySelectorAll('input[type="date"]');
        dateInputs.forEach(function (input) {
            input.addEventListener('change', function () {
                updateDateField(this);
            });
        });
    });
    </script>




    <!--<script>
function updateStage(cell, select) {
    const stage = select.value;
    const id = cell.getAttribute('data-id');
    const field = select.getAttribute('data-field');

    let className = '';
    switch(stage) {
        case 'Not Initiated':
            className = 'yellow-cell';
            break;
        case 'Not Applicable':
            className = 'grey-cell';
            break;
        case 'In Progress':
            className = 'orange-cell';
            break;
        case 'Completed':
            className = 'green-cell';
            break;
        default:
            className = 'yellow-cell'; // Default to yellow for 'Not Initiated'
    }

    cell.className = className;

    // Send AJAX request to update the database
    fetch('leads_list_backend.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            id: id,
            field: field,
            value: stage
        })
    })
    .then(response => response.text())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
}

function updateDateField(input) {
    const date = input.value;
    const id = input.closest('tr').getAttribute('data-id');
    const field = input.getAttribute('data-field');

    const cell = input.parentElement;
    cell.className = date ? 'green-cell' : 'yellow-cell';

    // Send AJAX request to update the database
    fetch('leads_list_backend.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            id: id,
            field: field,
            value: date
        })
    })
    .then(response => response.text())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', function () {
    const dropdowns = document.querySelectorAll('.dropdown select');
    dropdowns.forEach(function (dropdown) {
        dropdown.addEventListener('change', function () {
            const cell = this.closest('td');
            updateStage(cell, this);
        });
    });

    const dateInputs = document.querySelectorAll('input[type="date"]');
    dateInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            updateDateField(this);
        });
    });
});
</script>-->
                                        <!--<a href="index.php?sub=createBatches&companycompany=<?php echo urlencode($row["company"]); ?>" class="btn btn-warning btn-sm">Create Batches</a>-->
                                    </tr>
                                    </td>
                                    </td>
                                    </td>
                                    </tr>
                                <?php

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

                                <input type="hidden" id="salesStage" name="salesStage" class="form-control" autocomplete="off" required>

                                <div class="modal-body">
                                <div class="form-group">
                                    <label>Client</label>
        <select class="form-control" id="company" name="company">
            <?php
            $sql = "SELECT clientName FROM clients ORDER BY clientName ASC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=\"" . htmlspecialchars($row["clientName"], ENT_QUOTES, 'UTF-8') . "\">" . htmlspecialchars($row["clientName"], ENT_QUOTES, 'UTF-8') . "</option>";
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



                                    <input type="hidden" id="Confidenselevel" name="Confidenselevel" class="form-control" autocomplete="off" required>


                                    <div class="form-group">
                                        <label for="ltype">Lead Type</label>
                                        <select id="ltype" name="ltype" class="form-control" autocomplete="off" required>
                                            <option value="Consulting">Consulting</option>
                                            <option value="Training">Training</option>
                                            <option value="People analytics">People Analytics</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="leadtype">Category Type</label>
                                        <select id="leadtype" name="leadtype" class="form-control" autocomplete="off" required>
                                            <option value="PLDP">PLDP</option>
                                            <option value="Capacity Building">Capacity Building</option>
                                            <option value="EDP">EDP</option>
                                            <option value="CSP">CSP</option>
                                            <option value="OAR">OAR</option>
                                            <option value="Team Experiences">Team Experiences</option>
                                            <option value="Strategy">Strategy</option>
                                            <option value="HR">HR</option>
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
                                    
                                    
                                    <input type="hidden" name="completion" value="<?php $percentage ?>">


                                    <div class="form-group">
                                        <label>Action Point</label>
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
                                <h4 class="modal-title">Edit Active Lead</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="id_u" name="id" class="form-control" required>

                                
    

                                <!--<div class="form-group">
                                    <label>Client</label>
        <select class="form-control" id="client_u" name="client">
            <?php
            $sql = "SELECT clientName FROM clients ORDER BY clientName ASC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=\"" . htmlspecialchars($row["clientName"], ENT_QUOTES, 'UTF-8') . "\">" . htmlspecialchars($row["clientName"], ENT_QUOTES, 'UTF-8') . "</option>";
                }
            } else {
                echo '<option value="0">No Clients</option>';
            }
            ?>
        </select>
                                    </div>-->
                                <!--<div class="form-group">
                                    <label>Date</label>
                                    <input type="date" id="date_u" name="date" class="form-control" required>
                                </div>-->
                                <div class="form-group">
                                    <label>Lead</label>
                                    <input type="text" id="lead_u" name="lead" class="form-control" required>
                                </div>

                                <input type="hidden" id="salesStage_u" name="salesStage" class="form-control" required>

                                <input type="hidden" id="status_u" name="Status" class="form-control" required>

                                <input type="hidden" id="completionstatus_u" name="completionstatus" class="form-control" required>	

                                <input type="hidden" id="confidencelevel_u" name="confidencelevel" class="form-control" required>
                                
                                <div class="form-group">
                                    <label>Action Point</label>
                                    <textarea id="action_u" name="action" class="form-control" autocomplete="off" required></textarea>
                                </div>

                                <div class="form-group">
                                        <label for="ltype">Lead Type</label>
                                        <select id="ltype" name="ltype" class="form-control" autocomplete="off" required>
                                            <option value="Consulting">Consulting</option>
                                            <option value="Training">Training</option>
                                            <option value="People analytics">People Analytics</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="leadtype">Category Type</label>
                                        <select id="leadtype" name="leadtype" class="form-control" autocomplete="off" required>
                                            <option value="PLDP">PLDP</option>
                                            <option value="Capacity Building">Capacity Building</option>
                                            <option value="EDP">EDP</option>
                                            <option value="CSP">CSP</option>
                                            <option value="OAR">OAR</option>
                                            <option value="Team Experiences">Team Experiences</option>
                                            <option value="Strategy">Strategy</option>
                                            <option value="HR">HR</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                <div class="form-group">
                                    <label>Requirement</label>
                                    <textarea id="requirement_u" name="requirement" class="form-control" autocomplete="off" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Estimate Sales Value</label>
                                    <input type="text" id="sales_u" name="sales" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Lost Lead Date</label>
                                    <input type="date" id="lost_u" name="lost" class="form-control"  required>
                                </div>

                                <!--<div class="form-group">
                                    <label>Preliminary Brochures & LIT</label>
                                    <select id="perliminary_u" name="perliminary" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Email Client</label>
                                    <select id="email_u" name="email" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                            
                                <div class="form-group">
                                    <label>Shedule Chemistry Meeting</label>
                                    <select id="shedulecm_u" name="shedulecm" class="form-control" required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Chemistry Meeting</label>
                                    <select id="chemmeeting_u" name="chemmeeting" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                            </select>
                                </div>
                                <div class="form-group">
                                    <label>Proposal</label>
                                    <select id="proposal_u" name="proposal" class="form-control" required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                            </select>
                                </div>
                                <div class="form-group">
                                    <label>Estimate</label>
                                    <select id="estimate_u" name="estimate" class="form-control" required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                            </select>
                                </div>
                                <div class="form-group">
                                    <label>Confirmation</label>
                                    <select id="confirmation_u" name="confirmation" class="form-control" required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>COF</label>
                                    <select id="cof_u" name="cof" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>PO</label>
                                    <select id="po_u" name="po" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Invoice</label>
                                    <select id="invoice_u" name="invoice" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Invoice Date</label>
                                    <input type="date" id="invoiceDT_u" name="invoiceDT" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Payment</label>
                                    <select id="payment_u" name="payment" class="form-control" required>
                                        <option value="Not paid">Not paid</option>
                                        <option value="Part Paid">Part Paid</option>
                                        <option value="Fully Paid">Fully Paid</option>
                                        </select>
                                </div>-->
                                <!--<input type="hidden" id="paymentStatus_u" name="paymentStatus" class="form-control" required>-->
                                <!--<div class="form-group">
                                    <label>Program</label>
                                    <select id="program_u" name="program" class="form-control"  required>
                                        <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Pre Program</label>
                                    <select id="preprogram_u" name="preprogram" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Survey and Data</label>
                                    <select id="SurveyData_u" name="SurveyData" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Course and facilitation</label>
                                    <select id="Coursefacilitation_u" name="Coursefacilitation" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Projects and Assessments</label>
                                    <select id="projectsassessments_u" name="projectsassessments" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Data and Certification</label>
                                    <select id="datacertification_u" name="datacertification" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Graduation</label>
                                    <select id="graduation_u" name="graduation" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Program Completed</label>
                                    <select id="programC_u" name="programC" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Post Sales Follow Up</label>
                                    <select id="followup_u" name="followup" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Marketing E-Mail</label>
                                    <select id="protofolio_u" name="protofolio" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>New Business Meeting</label>
                                    <select id="business_u" name="business" class="form-control"  required>
                                    <option value="Not Initiated">Not Initiated</option>
                                        <option value="Not Applicable">Not Applicable</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        </select>
                                </div>-->

                                <div class="modal-footer">
                                    <input type="hidden" value="2" name="type">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="button" class="btn btn-info" id="update">Update</button>
                                </div>
            </form>
        </div>
    </div>
</div>
</div>

        <!-- Edit Action Point Modal -->
<div id="editActionPointModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editActionPointForm" method="post" action="Save_action_point_backend.php">
                <div class="modal-header">                        
                    <h4 class="modal-title">Add Action Point</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" class="form-control" id="currentDate" name="date" readonly>
                    </div>
                    <!--<div class="form-group">
                        <label>Client Name</label>
                        <input type="text" class="form-control" id="company" name="company" required readonly>
                    </div>-->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Action Points</label>
                        <div id="actionPointsContainer">
                            <textarea class="form-control actionPoint" name="actionPoint[]" required></textarea>
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" id="addActionPoint">Add Action Point</button>
                    </div>
                    <input type="hidden" id="actionPointId" name="clientID">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to set the current date in the form
    function setCurrentDate() {
        const currentDate = new Date().toISOString().substring(0, 10);
        document.getElementById('currentDate').value = currentDate;
    }

    // Function to fetch company name based on clientID
    function fetchcompany(clientID) {
        return $.ajax({
            url: 'leads_list.php',
            type: 'GET',
            data: { company: company }
        });
    }

    // Show event for the Edit Action Point modal
    $('#editActionPointModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget); // Button that triggered the modal
        const actionPointId = button.data('id'); // Extract action point ID from data-* attributes
        const modal = $(this);

        // Fetch data related to the action point ID and populate the fields
        setCurrentDate();
        fetchcompany(actionPointId).done(function(data) {
            modal.find('.modal-body #company').val(data.clientName);
            modal.find('.modal-body #actionPointId').val(actionPointId);
        }).fail(function() {
            alert('Error fetching client data');
        });
    });

    // Add action point
    $('#addActionPoint').on('click', function() {
        $('#actionPointsContainer').append('<textarea class="form-control actionPoint mt-2" name="actionPoint[]" required></textarea>');
    });

    // Submit event for the form
    $('#editActionPointForm').on('submit', function(event) {
        // Here you can handle form submission, e.g., send data via AJAX
        alert('Action point saved!');
        $('#editActionPointModal').modal('hide');
    });
});
</script>


<!-- View Action Point Modal -->
<div id="viewActionPointModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">                        
                <h4 class="modal-title">View Action Log</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" id="printableArea">
                <div id="printHeader">
                    <h2 id="clientName"></h2>
                </div>
                <div id="actionPoints">
                    <div class="form-group">
                        <label>Date :</label>
                        <p id="viewDate" class="form-control-static"></p>
                    </div>
                    <div class="form-group">
                        <label>Name :</label>
                        <p id="viewName" class="form-control-static"></p>
                    </div>
                    <div class="form-group">
                        <label>Action Points :</label>
                        <ul id="viewActionPoints" class="form-control-static"></ul>
                    </div>
                </div>
                <div id="printFooter">
                    <p>All Right Reserved. Sandbox Consultancy Services(PVT)LTD</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="printDiv()">Print</button>
                <button type="button" class="btn btn-primary" onclick="downloadWord()">Download as Word</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to fetch action point data for the client
    function fetchActionPoint(clientID) {
        return $.ajax({
            url: 'fetch_action_point_backend.php',
            type: 'GET',
            data: { clientID: clientID }
        });
    }

    // Show event for the View Action Point modal
    $('#viewActionPointModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget); // Button that triggered the modal
        const clientID = button.data('id'); // Extract client ID from data-* attributes
        const modal = $(this);

        fetchActionPoint(clientID).done(function(data) {
            modal.find('#clientName').text(data.name);
            modal.find('#viewDate').text(data.date);

            // Clear existing action points and append new ones
            const actionPointsList = modal.find('#viewActionPoints');
            actionPointsList.empty();
            data.actionPoints.forEach(function(actionPoint) {
                actionPointsList.append('<li>' + actionPoint + '</li>');
            });
        }).fail(function() {
            alert('Error fetching action point data');
        });
    });

    // Function to print the div
    window.printDiv = function() {
        window.print();
    }

    // Function to download as Word document
    window.downloadWord = function() {
        const header = document.getElementById('clientName').innerText;
        const date = document.getElementById('viewDate').innerText;
        const actionPoints = document.getElementById('viewActionPoints').innerHTML;
        const footer = document.getElementById('printFooter').innerText;

        const content = `
            <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        .header, .footer { text-align: center; margin-bottom: 20px; }
                        .footer { position: fixed; bottom: 0; width: 100%; }
                        ul { list-style-type: disc; }
                    </style>
                </head>
                <body>
                    <div class="header"><h2>${header}</h2></div>
                    <div class="content">
                        <p><strong>Date:</strong> ${date}</p>
                        <p><strong>Action Points:</strong></p>
                        <ul>${actionPoints}</ul>
                    </div>
                    <div class="footer"><p>${footer}</p></div>
                </body>
            </html>
        `;

        const blob = new Blob(['\ufeff', content], {
            type: 'application/msword'
        });

        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'ActionPoint.doc';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function showDropdown(button, columnIndex) {
        const dropdown = button.nextElementSibling;
        if (dropdown.style.display === 'block') {
            dropdown.style.display = 'none';
        } else {
            document.querySelectorAll('.dropdown-content').forEach(dd => dd.style.display = 'none');
            dropdown.style.display = 'block';
        }
    }

    function sortTable(order, columnIndex) {
        const table = document.querySelector('.Lead-table tbody');
        const rows = Array.from(table.rows);

        rows.sort((a, b) => {
            const cellA = a.cells[columnIndex].innerText.toLowerCase();
            const cellB = b.cells[columnIndex].innerText.toLowerCase();

            if (order === 'asc') {
                return cellA.localeCompare(cellB);
            } else {
                return cellB.localeCompare(cellA);
            }
        });

        rows.forEach(row => table.appendChild(row));
    }

    function filterTable(columnIndex, value) {
        const table = document.querySelector('.Lead-table tbody');
        table.querySelectorAll('tr').forEach(row => {
            const cell = row.cells[columnIndex];
            if (value === "All" || (cell && cell.innerText === value)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    document.addEventListener('click', event => {
        if (!event.target.matches('.filter-icon')) {
            document.querySelectorAll('.dropdown-content').forEach(dropdown => {
                dropdown.style.display = 'none';
            });
        }
    });
});
</script>


            <!--<script> for sorting with the data added in the table
function showDropdown(button, columnIndex) {
    const dropdown = button.nextElementSibling;
    if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
    } else {
        document.querySelectorAll('.dropdown-content').forEach(dd => dd.style.display = 'none');
        dropdown.style.display = 'block';
        populateDropdown(dropdown, columnIndex);
    }
}

function filterTable(columnIndex, value) {
    const table = document.querySelector('.Lead-table tbody');
    table.querySelectorAll('tr').forEach(row => {
        const cell = row.cells[columnIndex];
        if (value === "All" || (cell && cell.innerText === value)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function populateDropdown(dropdown, columnIndex) {
    if (dropdown.innerHTML !== '') return;

    const uniqueValues = new Set();
    document.querySelectorAll(`.Lead-table tbody tr`).forEach(row => {
        const cell = row.cells[columnIndex];
        if (cell) uniqueValues.add(cell.innerText.trim());
    });

    const allOption = document.createElement('a');
    allOption.href = '#';
    allOption.onclick = () => {
        filterTable(columnIndex, "All");
        return false;
    };
    allOption.innerText = "All";
    dropdown.appendChild(allOption);

    uniqueValues.forEach(value => {
        const a = document.createElement('a');
        a.href = '#';
        a.onclick = () => {
            filterTable(columnIndex, value);
            return false;
        };
        a.innerText = value;
        dropdown.appendChild(a);
    });
}

document.addEventListener('click', event => {
    if (!event.target.matches('.filter-icon')) {
        document.querySelectorAll('.dropdown-content').forEach(dropdown => {
            dropdown.style.display = 'none';
        });
    }
});
</script>-->

        <script>
    document.getElementById('downloadTable').addEventListener('click', function() {
        // Get the table
        var table = document.getElementById('dataTable');
        // Create an empty array to store the CSV data
        var rows = [];
        // Loop through each row in the table
        for (var i = 0; i < table.rows.length; i++) {
            var row = [];
            // Loop through each cell in the row
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                // Push the cell's text content to the row array
                row.push(table.rows[i].cells[j].innerText);
            }
            // Join the row array into a CSV formatted string and push it to the rows array
            rows.push(row.join(','));
        }
        // Join the rows array into a CSV formatted string
        var csv = rows.join('\n');
        // Create a blob with the CSV data
        var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        // Create a temporary link element
        var link = document.createElement('a');
        // Set the link's href attribute to a URL created with the blob
        link.href = window.URL.createObjectURL(blob);
        // Set the link's download attribute to the desired file name
        link.download = 'lead_table_data.csv';
        // Append the link to the document
        document.body.appendChild(link);
        // Programmatically click the link to trigger the download
        link.click();
        // Remove the link from the document
        document.body.removeChild(link);
        });

        
    document.addEventListener('DOMContentLoaded', function() {
    // Place the downloadTable function here
    document.getElementById('downloadTable').addEventListener('click', function() {
        var table = document.querySelector('.table');
        var rows = [];
        for (var i = 0; i < table.rows.length; i++) {
            var row = [];
            for (var j = 1; j < table.rows[i].cells.length; j++) {
                row.push(table.rows[i].cells[j].innerText);
            }
            rows.push(row.join(','));
        }
        var csv = rows.join('\n');
        var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        var link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = 'lead_table_data.csv';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
});


</script>