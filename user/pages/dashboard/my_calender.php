<?php
include '../connection.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$user_check = $_SESSION['username'];
$sql_get_user_full = "SELECT UserID, FirstName, LastName, AccountLevel FROM sys_users WHERE Username='$user_check'";
$resultuser_full = mysqli_query($conn, $sql_get_user_full);
if (mysqli_num_rows($resultuser_full) > 0) {
    while ($rowuser_full = mysqli_fetch_assoc($resultuser_full)) {
        $currentuser = $rowuser_full["UserID"];
        $UserFullName = $rowuser_full["FirstName"] . " " . $rowuser_full["LastName"];
        $AccountLevel = $rowuser_full["AccountLevel"];
    }
} else {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <!-- Custom Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .calendar-container {
            max-width: 900px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="calendar-container">
        <div id="calendar"></div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <!-- Initialize Calendar with Sample Data -->
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: '2019-12-12',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                    {
                        title: 'Company Audit',
                        start: '2019-12-09',
                        color: '#f39c12' // orange
                    },
                    {
                        title: 'Meeting with California clients',
                        start: '2019-12-11',
                        end: '2019-12-13',
                        color: '#8e44ad' // purple
                    },
                    {
                        title: 'Birthday: Jan',
                        start: '2019-12-03',
                        color: '#3498db' // blue
                    },
                    {
                        title: 'Birthday: Mat',
                        start: '2019-12-27',
                        color: '#1abc9c' // green
                    },
                    {
                        title: 'Merry Christmas',
                        start: '2019-12-25',
                        color: '#e74c3c' // red
                    },
                    {
                        title: 'Monthly Reports',
                        start: '2019-12-20',
                        color: '#f1c40f' // yellow
                    }
                ]
            });

            // Debug: Check if FullCalendar is initialized
            console.log("FullCalendar initialized");
        });
    </script>
</body>
</html>
