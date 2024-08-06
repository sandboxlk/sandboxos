<?php
include('../getcurrentuserdata.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
       /* Custom class to apply a blue background color */
.bg-blue {
    background-color: #1560bd !important; /* Blue color */
    color: #ffffff !important; /* White text */
}

/* Override styles for text color inside the blue background */
.bg-blue .menu-icon,
.bg-blue .menu-title,
.bg-blue .menu-arrow {
    color: #ffffff !important; /* White text for icons and titles */
}

/* Style for subcategories */
.sub-menu {
    background-color: #ffffff !important; /* White background color */
    border: 1px solid #191970 !important; /* Dark blue border */
    border-radius: 5px; /* Optional: rounded corners */
}

.sub-menu .nav-link {
    color: #191970 !important; /* Dark blue text */
    padding: 5px 10px; /* Optional: padding for better appearance */
}

.sub-menu .nav-link:hover {
    background-color: #ffffff !important; /* Dark blue background color on hover */
    color: #1560bd !important; /* White text on hover */
}

    </style>
</head>
<body>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link bg-blue" href="index.php?sub=home">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Home</span>
        
      </a>
    </li>

    <br>
    <li class="nav-item">
      <a class="nav-link bg-blue" href="index.php?sub=calender">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Calendar</span>
      </a>
    </li>

    <br>
    <!--<li class="nav-item">
      <a class="nav-link bg-blue" href="index.php?sub=my_calender">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">My Calendar</span>
      </a>
    </li>-->

   
    <li class="nav-item">
      <a class="nav-link bg-blue" href="index.php?sub=companies">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Clients</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link bg-blue" href="index.php?sub=Leads">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Active Leads</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link bg-blue" data-toggle="collapse" href="#faculty" aria-expanded="false" aria-controls="faculty">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Faculty</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="faculty">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?sub=personal information">Personal Information</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?sub=Banking Information">Banking Information</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?sub=Capacity">Capacity</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link bg-blue" href="index.php?sub=module">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Modules</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link bg-blue" href="index.php?sub=projects">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Courses</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link bg-blue" data-toggle="collapse" href="#studentRegistration" aria-expanded="false" aria-controls="studentRegistration">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Student Registration</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="studentRegistration">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?sub=createBatches">Create Batches</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
