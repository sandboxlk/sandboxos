          <!-- 

  <style>
.folder-container {
    display: inline-block;
    width: 170px;
    height: 110px;
    background-color: #e9e9e9;
    position: relative;
    margin: 20px;
    border-radius: 6px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
    vertical-align: top;
    overflow: hidden;
}

.folder-container:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.folder-flap {
    width: 100%;
    height: 30px;
    background-color: #d4d4d4;
    position: absolute;
    top: 0;
    left: 0;
}

.folder-label {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 14px;
    color: #333;
    font-weight: bold;
    width: 90%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-interaction-icon {
    position: absolute;
    bottom: 12px;
    right: 12px;
    width: 24px;
    height: 24px;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="black"/></svg>'); /* This is a user icon, replace if needed */
    background-size: contain;
}

.user-interaction-count {
    position: absolute;
    bottom: 8px;
    right: 40px; /* Adjust based on the icon's width */
    font-size: 12px;
    color: #333;
    font-weight: bold;
}



.folder-container {
    display: inline-block;
    width: 150px;  /* Adjusted for a wider appearance */
    height: 90px;  /* Adjusted for a wider appearance */
    background: linear-gradient(to bottom, #FFFFFF 20%, #e9e9e9 100%); /* Gradient for a professional look */
    position: relative;
    margin: 10px 20px;
    border: 1px solid #ccc; /* Subtle border */
    border-radius: 4px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* More natural shadow */
    cursor: pointer;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
    vertical-align: top;
    overflow: hidden; /* To clip the inner elements to folder shape */
}

.folder-container:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Increased shadow for hover effect */
}

.folder-flap {
    content: "";
    width: 100%;
    height: 25px;
    background: linear-gradient(to right, #b5b5b5 0%, #FFFFFF 30%, #FFFFFF 70%, #b5b5b5 100%); /* Gradient for flap for depth effect */
    position: absolute;
    top: 0;
    left: 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow under the flap */
}

.folder-label {
    position: absolute;
    bottom: 10px; /* Adjusted for better alignment */
    width: 100%;
    color: #333;  /* Dark text color */
    font-weight: bold; /* Bold text for emphasis */
    text-shadow: 0 1px 1px rgba(255, 255, 255, 0.8); /* Text shadow for a little depth */
}
</style>
 
 End of the CSS -->

         <?php
         include '../connection.php';
         if (session_status() !== PHP_SESSION_ACTIVE)
             session_start();
         $user_check = $_SESSION['username'];
         $sql_get_user_full = "SELECT UserID,FirstName,LastName,AccountLevel FROM sys_users WHERE Username='$user_check'";
         $resultuser_full = mysqli_query($conn, $sql_get_user_full);
         if (mysqli_num_rows($resultuser_full) > 0) {
             while ($rowuser_full = mysqli_fetch_assoc($resultuser_full)) {
                 $currentuser = $rowuser_full["UserID"];
                 $UserFullName = $rowuser_full["FirstName"] . " " . $rowuser_full["LastName"];
                 $AccountLevel = $rowuser_full["AccountLevel"];
             }
         }
         ?>
<style>
        #user-report iframe {
            width: 100%; /* Set iframe width to 100% of its container */
            height: calc(100vh - 100px); /* Set iframe height to 100% of viewport height minus 100px for padding/margins */
            border: none; /* Remove iframe border */
        }
    </style>
</head>
<body>
    <div id='user-report'>
        <!--<iframe title="user" src="https://app.powerbi.com/reportEmbed?reportId=c5acaa45-9dc8-49aa-acb2-9bd5478d91e5&autoAuth=true&ctid=06c840c0-ab57-4de0-b93e-5a65a7c3c8c4" frameborder="0" allowFullScreen="true"></iframe>
            <iframe title="SANDBOXOS new" src="https://app.powerbi.com/reportEmbed?reportId=ac3b9a39-9c55-4551-8faa-4950c51312e3&autoAuth=true&ctid=06c840c0-ab57-4de0-b93e-5a65a7c3c8c4" frameborder="0" allowFullScreen="true"></iframe>
                <iframe title="localums" src="https://app.powerbi.com/view?r=eyJrIjoiOGQxMzkwOGItZDhjNS00ZTJmLWE2NzktNzEyMDA3ZWMxZTg3IiwidCI6IjA2Yzg0MGMwLWFiNTctNGRlMC1iOTNlLTVhNjVhN2MzYzhjNCJ9" frameborder="0" allowFullScreen="true"></iframe>-->
                    <iframe title="newestos" width="600" height="373.5" src="https://app.powerbi.com/view?r=eyJrIjoiZTYzOWRlZDMtNmY5NS00MGEwLWI2NTctOTNmZjE5ZjY5MTlmIiwidCI6IjA2Yzg0MGMwLWFiNTctNGRlMC1iOTNlLTVhNjVhN2MzYzhjNCIsImMiOjEwfQ%3D%3D" frameborder="0" allowFullScreen="true"></iframe>
                    <a href="https://app.powerbi.com/reportEmbed?reportId=a798f594-9420-468f-8022-0a2ab858c8cb&autoAuth=true&ctid=06c840c0-ab57-4de0-b93e-5a65a7c3c8c4">Link Text</a>
                    
                   <br>
                    <a href=https://app.powerbi.com/reportEmbed?reportId=8bc5382e-c81a-4939-8b54-74aef3f86354&autoAuth=true&ctid=06c840c0-ab57-4de0-b93e-5a65a7c3c8c4>Link Text</a>

  <!--                  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard</title>

    <style>
        .col-custom {
            flex: 0 0 14.2857%;
            max-width: 14.2857%;
            padding: 0 7px;
        }
    </style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-doughnutlabel/dist/chartjs-plugin-doughnutlabel.js"></script>


</head>

<body>
<div class="container-fluid">
    <div class="row">
        
    //Sidebar 
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            Leads
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Existing Lead
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Meeting
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Pre Sales
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Calendar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Report
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Post Sales
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Home
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        

        <!-- Main Dashboard 
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>
            <div class="row mb-3">
    <!-- First box 
    <div class="col-custom">
        <div class="card mb-3 shadow">
            <div class="card-body text-center">
                <i class="bi bi-person-circle" style="font-size: 2rem; color: #007BFF;"></i>
                <h2>10</h2>
                <p class="card-text"> Leads</p>
            </div>
        </div>
    </div>
    <div class="col-custom">
        <div class="card mb-3 shadow">
            <div class="card-body text-center">
                <i class="bi bi-person-circle" style="font-size: 2rem; color: #007BFF;"></i>
                <h2>10</h2>
                <p class="card-text"> Open Leads</p>
            </div>
        </div>
    </div>
    <div class="col-custom">
        <div class="card mb-3 shadow">
            <div class="card-body text-center">
                <i class="bi bi-person-circle" style="font-size: 2rem; color: #007BFF;"></i>
                <h2>10</h2>
                <p class="card-text"> Processing </p>
            </div>
        </div>
    </div>
    <div class="col-custom">
        <div class="card mb-4 shadow">
            <div class="card-body text-center">
                <i class="bi bi-person-circle" style="font-size: 3rem; color: #007BFF;"></i>
                <h2>10</h2>
                <p class="card-text"> Delayed Lead</p>
            </div>
        </div>
    </div>
    <div class="col-custom">
        <div class="card mb-4 shadow">
            <div class="card-body text-center">
                <i class="bi bi-person-circle" style="font-size: 3rem; color: #007BFF;"></i>
                <h2>10</h2>
                <p class="card-text"> Close  won</p>
            </div>
        </div>
    </div>
    <div class="col-custom">
        <div class="card mb-4 shadow">
            <div class="card-body text-center">
                <i class="bi bi-person-circle" style="font-size: 3rem; color: #007BFF;"></i>
                <h2>10</h2>
                <p class="card-text"> Close lost</p>
            </div>
        </div>
    </div>
    <div class="col-custom">
        <div class="card mb-4 shadow">
            <div class="card-body text-center">
                <i class="bi bi-person-circle" style="font-size: 3rem; color: #007BFF;"></i>
                <h2>20</h2>
                <p class="card-text"> Estimate value</p>
            </div>
        </div>
    </div>


    <div class="row mb-5">
    <div class="col-lg-5 mb-8">
        <!-- On-going projects input box 
        <h5>Ongoing Projects</h5>
        <textarea class="form-control mb-2" rows="4" placeholder="Type ongoing projects here..."></textarea>
        
        <!-- To-do things input box 
        <h5>To Do List</h5>
        <textarea class="form-control" rows="4" placeholder="Type to-do list here..."></textarea>
    </div>

    <div class="col-lg-4 mb-3">
    <h5>Issue Status</h5>
    <canvas id="pieChart2"></canvas>
</div>

<div class="col-lg-4 mb-3">
    <h5>Estimate value</h5>
    <canvas id="clusteredColumnLineChart"></canvas>
</div>

<div class="row mb-5">
    <div class="col-lg-4 mb-4">
        <!-- Bar Chart 
        <h5>Bar Chart</h5>
        <canvas id="barChart"></canvas>
    </div>

    <div class="col-lg-4 mb-4">
        <!-- Line Chart 
        <h5>Line Chart</h5>
        <canvas id="lineChart"></canvas>
    </div>

    <div class="col-lg-4 mb-4">
        <!-- Pie Chart 
        <h5>Pie Chart</h5>
        <canvas id="pieChart"></canvas>
    </div>
</div>

      </div>
      </main>
        
<!-- Include Bootstrap JS 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
<script>
    var ctx2 = document.getElementById('pieChart2').getContext('2d');
    var pieChart2 = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Re-open', 'In-progress', 'open', 'Closed', 'TO-Do'],
            datasets: [{
                data: [15, 25, 40, 50, 10],
                backgroundColor: ['#0f054d', '#b83a04', '#a8a6a5', '#299145', '#fab802'],
                hoverBackgroundColor: ['#0f054d', '#b83a04', '#a8a6a5', '#299145', '#fab802']
            }]
        },
        options: {
            plugins: {
                doughnutlabel: {
                    labels: [
                        {
                            text: 'TOTAL',
                            font: {
                                size: 20
                            }
                        },
                        {
                            text: '80',
                            font: {
                                size: 50
                            }
                        }
                    ]
                }
            }
        }
    });

    var ctxColumnLine = document.getElementById('clusteredColumnLineChart').getContext('2d');
var clusteredColumnLineChart = new Chart(ctxColumnLine, {
    type: 'bar',
    data: {
        labels: ['q1', 'q2', 'q3', 'q4'],
        datasets: [{
            label: 'Dataset 1',
            data: [10, 20, 30],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
            yAxisID: 'y-axis-1',
        }, 
        {
            type: 'line',
            label: 'Dataset 2',
            data: [15, 25, 35, 10],
            borderColor: ['#FFC0CB'],
            fill: false,
            yAxisID: 'y-axis-2',
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Bar Chart
var ctxBar = document.getElementById('barChart').getContext('2d');
var barChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: ['Data 1', 'Data 2', 'Data 3'],
        datasets: [{
            label: 'Sample Data',
            data: [10, 20, 30],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
        }]
    }
});

// Line Chart
var ctxLine = document.getElementById('lineChart').getContext('2d');
var lineChart = new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: ['Data 1', 'Data 2', 'Data 3'],
        datasets: [{
            label: 'Sample Data',
            data: [30, 28, 10],
            borderColor: ['#FF6384'],
            fill: false
        }]
    }
});

// Pie Chart
var ctxPie = document.getElementById('pieChart').getContext('2d');
var pieChart = new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: ['Data 1', 'Data 2', 'Data 3'],
        datasets: [{
            data: [10, 20, 30],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
        }]
    }
});


</script>

</body>



</html>







        <!-- content-wrapper ends -->

        <!-- Bootstrap CSS 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

Google Charts 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div class="container mt-5">
    <h3>Leads Progress</h3>
    <div id="leadsGanttChart" style="height: 200px;"></div>
</div>

<div class="container mt-5">
    <h3>Project Progress</h3>
    <div id="projectsGanttChart" style="height: 200px;"></div>
</div>
<script>
google.charts.load('current', {'packages':['gantt']});
google.charts.setOnLoadCallback(drawLeadsChart);
google.charts.setOnLoadCallback(drawProjectsChart);

function drawLeadsChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Task ID');
    data.addColumn('string', 'Task Name');
    data.addColumn('date', 'Start Date');
    data.addColumn('date', 'End Date');
    data.addColumn('number', 'Duration');
    data.addColumn('number', 'Percent Complete');
    data.addColumn('string', 'Dependencies');

    data.addRows([
        // Sample data for visualization (replace with actual data later)
        ['Lead1', 'Waiting for Approval', new Date(2023, 5, 1), new Date(2023, 5, 3), null, 100, null],
        ['Lead2', 'Approved', new Date(2023, 5, 3), new Date(2023, 5, 5), null, 50, null],
        ['Lead3', 'Denied', new Date(2023, 5, 2), new Date(2023, 5, 3), null, 0, null],
        //... Add more leads as required
    ]);

    var chart = new google.visualization.Gantt(document.getElementById('leadsGanttChart'));
    chart.draw(data, {});
}

function drawProjectsChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Task ID');
    data.addColumn('string', 'Task Name');
    data.addColumn('date', 'Start Date');
    data.addColumn('date', 'End Date');
    data.addColumn('number', 'Duration');
    data.addColumn('number', 'Percent Complete');
    data.addColumn('string', 'Dependencies');

    data.addRows([
        // Sample data for visualization
        ['Project1', 'Design Phase', new Date(2023, 5, 1), new Date(2023, 5, 5), null, 100, null],
        ['Project1.1', 'Development Phase', new Date(2023, 5, 6), new Date(2023, 5, 15), null, 50, 'Project1'],
        ['Project2', 'Requirement Gathering', new Date(2023, 5, 2), new Date(2023, 5, 3), null, 0, null],
        //... Add more projects/phases as required
    ]);

    var chart = new google.visualization.Gantt(document.getElementById('projectsGanttChart'));
    chart.draw(data, {});
}
</script> 


     Folders Section Starts 

 Folders Section Starts 
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Services</h4>
            <div class="row">
                 Folder 1 
                <div class="col-md-2 text-center">
                    <a href="path_to_folder_content_1.php" class="folder-container">
                        <div class="folder-flap"></div>
                        <div class="folder-label">PLDP</div>
                        <div class="user-interaction-icon"></div>
                        <div class="user-interaction-count">10</div>  Replace 10 with actual user count 
                    </a>
                </div>
                <div class="col-md-2 text-center">
                    <a href="path_to_folder_content_1.php" class="folder-container">
                        <div class="folder-flap"></div>
                        <div class="folder-label">EDP</div>
                        <div class="user-interaction-icon"></div>
                        <div class="user-interaction-count">10</div>  Replace 10 with actual user count 
                    </a>
                </div>
                <div class="col-md-2 text-center">
                    <a href="path_to_folder_content_1.php" class="folder-container">
                        <div class="folder-flap"></div>
                        <div class="folder-label">Consulting</div>
                        <div class="user-interaction-icon"></div>
                        <div class="user-interaction-count"></div>  Replace 10 with actual user count
                    </a>
                </div>
                <div class="col-md-2 text-center">
                    <a href="path_to_folder_content_1.php" class="folder-container">
                        <div class="folder-flap"></div>
                        <div class="folder-label">Trainning <p> Programmes</div><br>
                        <div class="user-interaction-icon"></div>
                        <div class="user-interaction-count">10</div> 
                    </a>
                </div>
                <div class="col-md-2 text-center">
                    <a href="path_to_folder_content_1.php" class="folder-container">
                        <div class="folder-flap"></div>
                        <div class="folder-label">Assessments</div>
                        <div class="user-interaction-icon"></div>
                        <div class="user-interaction-count"></div> 
                    </a>
                </div>
                <div class="col-md-2 text-center">
                    <a href="path_to_folder_content_1.php" class="folder-container">
                        <div class="folder-flap"></div>
                        <div class="folder-label">Experiences/<p>Activation</div>
                        <div class="user-interaction-icon"></div>
                        <div class="user-interaction-count">10</div>  
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>-->



