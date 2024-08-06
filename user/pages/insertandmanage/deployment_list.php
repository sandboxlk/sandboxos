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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Deployment </title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/customcss.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
        /* Style for the horizontal header */
        .horizontal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f0f0f0;
        }

        /* Style for the buttons */
        .horizontal-header button {
            margin-right: 10px;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        /* Style for the add activity button */
        .horizontal-header button:last-child {
            background-color: #008CBA;
        }

		 /* Style for the Lists container */
        .lists-container {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Style for the table */
        .lists-table {
            width: 100%;
            border-collapse: collapse;
        }

        .lists-table th,
        .lists-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .lists-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

		/* Style for the main containers */
        .main-container {
            display: flex;
            flex-direction: row;
            margin-top: 20px;
        }

        /* Style for the sub containers */
        .sub-container {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 0 10px;
            overflow-y: auto; /* Enable vertical scrollbar if content exceeds container height */
        }

        /* Style for the add task button */
        .add-task-btn {
            margin-top: 10px;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        /* Style for the add subtask button */
        .add-subtask-btn {
            margin-top: 5px;
            padding: 6px 12px;
            border: none;
            border-radius: 3px;
            background-color: #008CBA;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }
		/* Style for the main containers */
.sub-container {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 0 10px;
    overflow-y: auto; /* Enable vertical scrollbar if content exceeds container height */
}

/* Style for the add task button */
.add-task-btn {
    margin-top: 10px;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

    </style>
</head>
<body>

<!-- Horizontal Header -->
<div class="horizontal-header">
    <div>
        <button id="overviewBtn">Overview</button>
        <button id="boardBtn">Board</button>
        <button>Gantt</button>
        <button>Add Activity</button>
    </div>
</div>

<!-- Overview Container -->
<div id="overviewContainer" style="display: none;">
    <div class="lists-container">
        <h2><strong>Lists</strong></h2>
        <table class="lists-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Duration</th>
                    <th>Owner</th>
                    <th>Assigned Member</th>
                    <th>Status</th>
                    
                </tr>
            </thead>
            <tbody>
                <!-- Table rows will be dynamically populated here -->
            </tbody>
        </table>
    </div>
</div>

<!-- Board Containers -->
<div id="boardContainers" style="display: none;">
    <div class="sub-container" id="initiatedContainer">
        <h3>Initiated</h3>
        <button class="add-task-btn">+ New Task</button>
    </div>
    <div class="sub-container" id="ongoingContainer">
        <h3>Ongoing</h3>
        <button class="add-task-btn">+ New Task</button>
    </div>
    <div class="sub-container" id="completedContainer">
        <h3>Completed</h3> 
        <button class="add-task-btn">+ New Task</button>
    </div>
</div>

<script>
        let tasks = [];

        function renderGanttChart() {
            const ganttChart = document.getElementById('ganttChart');
            ganttChart.innerHTML = '<h2>Gantt Chart</h2>';

            tasks.forEach(task => {
                const taskElement = document.createElement('div');
                taskElement.textContent = `${task.name} (${task.start} to ${task.end})`;
                taskElement.style.padding = '5px';
                taskElement.style.border = '1px solid #ccc';
                ganttChart.appendChild(taskElement);
            });
        }

        function addTask(taskName) {
            const startDate = new Date().toISOString().slice(0, 10); // Today's date
            const endDate = new Date(Date.now() + 7 * 24 * 60 * 60 * 1000).toISOString().slice(0, 10); // One week from now

            const newTask = {
                name: taskName,
                start: startDate,
                end: endDate
            };

            tasks.push(newTask);
            renderGanttChart();
        }

        function searchTasks(keyword) {
            const filteredTasks = tasks.filter(task => task.name.toLowerCase().includes(keyword.toLowerCase()));
            renderGanttChart(filteredTasks);
        }

        document.getElementById('addTaskBtn').addEventListener('click', () => {
            const taskInput = document.getElementById('taskInput');
            const taskName = taskInput.value.trim();

            if (taskName) {
                addTask(taskName);
                taskInput.value = ''; // Clear input
            }
        });

        document.getElementById('searchInput').addEventListener('input', () => {
            const searchInput = document.getElementById('searchInput');
            const keyword = searchInput.value.trim();

            if (keyword) {
                searchTasks(keyword);
            } else {
                renderGanttChart();
            }
        });

        // Initialize the Gantt chart on page load
        renderGanttChart();
    </script>
    
<script>
    document.getElementById("overviewBtn").addEventListener("click", function() {
        // Hide board containers if they are visible
        document.getElementById("boardContainers").style.display = "none";

        // Show the overview container
        document.getElementById("overviewContainer").style.display = "block";
        
        // Here you can fetch and populate data into the table dynamically
        // For demonstration purposes, let's add some dummy data
        var tableBody = document.querySelector("#overviewContainer .lists-table tbody");
        tableBody.innerHTML = ""; // Clear existing table rows

        //dummy data
        var dummyData = [
            { name: "Task 1", startDate: "2024-04-01", endDate: "2024-04-05", duration: "5 days", owner: "Owner 1", assignedMember: "Member 1", status: "Initiated" },
            { name: "Task 2", startDate: "2024-04-03", endDate: "2024-04-10", duration: "7 days", owner: "Owner 2", assignedMember: "Member 2", status: "Ongoing" },
            { name: "Task 3", startDate: "2024-04-06", endDate: "2024-04-08", duration: "3 days", owner: "Owner 3", assignedMember: "Member 3", status: "Completed" }
            // Add more data as needed
        ];

        dummyData.forEach(function(data) {
            var row = document.createElement("tr");
            row.innerHTML = "<td>" + data.name + "</td>" +
                            "<td>" + data.startDate + "</td>" +
                            "<td>" + data.endDate + "</td>" +
                            "<td>" + data.duration + "</td>" +
                            "<td>" + data.owner + "</td>" +
                            "<td>" + data.assignedMember + "</td>" +
                            "<td>" + data.status + "</td>";
            tableBody.appendChild(row);456
        });
    });

    document.getElementById("boardBtn").addEventListener("click", function() {
        // Show the board containers
        document.getElementById("boardContainers").style.display = "flex";
        // Hide the overview container
        document.getElementById("overviewContainer").style.display = "none";
    });

	 // Function to create task element
	 function createTaskElement(task) {
        var taskElement = document.createElement("div");
        taskElement.textContent = task.name;
        taskElement.classList.add("task");
        var addSubtaskBtn = document.createElement("button");
        addSubtaskBtn.textContent = "+ Add Subtask";
        addSubtaskBtn.classList.add("add-subtask-btn");
        taskElement.appendChild(addSubtaskBtn);
        return taskElement;
    }

    // Function to add a new task
    function addNewTask(containerId) {
        var container = document.getElementById(containerId);
        var taskElement = createTaskElement({ name: "New Task", status: "" });
        container.appendChild(taskElement);
    }

    // Event listener for adding new tasks
    document.querySelectorAll(".sub-container .add-task-btn").forEach(function(button) {
        button.addEventListener("click", function() {
            var containerId = this.parentNode.id;
            addNewTask(containerId);
        });
    });
</script>

<!-- Gantt Chart Container -->
<div id="ganttChartContainer">
    <canvas id="ganttChartCanvas"></canvas>
</div>

<script>
// Dummy data for Gantt chart (replace with actual data)
const ganttData = [
    { task: 'Task 1', start: '2024-04-01', end: '2024-04-15' },
    { task: 'Task 2', start: '2024-04-10', end: '2024-05-05' },
    { task: 'Task 3', start: '2024-04-20', end: '2024-05-15' }
    // Add more tasks as needed...
];

// Function to convert date string to Date object
const parseDate = dateString => {
    const [year, month, day] = dateString.split('-');
    return new Date(year, month - 1, day);
};

// Generate chart using Chart.js
const ctx = document.getElementById('ganttChartCanvas').getContext('2d');
const ganttChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        datasets: [{
            label: 'Tasks',
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            data: ganttData.map(task => ({
                y: task.task,
                x: parseDate(task.start),
                xEnd: parseDate(task.end)
            }))
        }]
    },
    options: {
        scales: {
            xAxes: [{
                type: 'time',
                time: {
                    unit: 'week', // Display x-axis in weekly intervals
                    displayFormats: {
                        week: 'MMM DD' // Format for week labels
                    }
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Date'
                }
            }],
            yAxes: [{
                stacked: true,
                ticks: {
                    reverse: true
                }
            }]
        },
        tooltips: {
            callbacks: {
                title: (tooltipItems) => tooltipItems[0].yLabel,
                label: (tooltipItem, data) => {
                    const dataset = data.datasets[tooltipItem.datasetIndex];
                    const item = dataset.data[tooltipItem.index];
                    const startDate = item.x.toLocaleDateString();
                    const endDate = item.xEnd.toLocaleDateString();
                    return `Start: ${startDate} - End: ${endDate}`;
                }
            }
        }
    }
});
</script>
</body>
</html>