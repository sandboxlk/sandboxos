	    <?php
        include('../getcurrentuserdata.php');
      ?>
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link bg-warning text-dark" href="index.php?sub=home">
              <i class="icon-grid menu-icon text-dark"></i>
              <span class="menu-title text-dark">Home</span>
            </a>
          </li>
        
          <br>
          <li class="nav-item">
            <a class="nav-link bg-warning text-dark" href="index.php?sub=calender">
              <i class="icon-grid menu-icon text-dark"></i>
              <span class="menu-title text-dark">Calender</span>
            </a>
          </li>
      
          <br>
          <li class="nav-item">
          <a class="nav-link bg-warning text-dark" href="index.php?sub=companies">
                <i class="icon-grid menu-icon text-dark"></i>
                <span class="menu-title text-dark">Clients</span>
            </a>
        </li>

        <li class="nav-item">
          <a class="nav-link bg-warning text-dark" href="index.php?sub=Leads">
                <i class="icon-grid menu-icon text-dark"></i>
                <span class="menu-title text-dark">Leads</span>
            </a>
        </li>
        
            <li class="nav-item">
            <a class="nav-link bg-warning" data-toggle="collapse" href="#faculty" aria-expanded="false" aria-controls="faculty">
            <i class="icon-layout menu-icon text-dark"></i>
            
            <span class="menu-title text-dark">Faculty</span>
            <i class="menu-arrow text-dark"></i>
            </a>
            <div class="collapse" id="studentRegistration">
                <ul class="nav flex-column sub-menu bg-dark">
                    <li class="nav-item"> <a class="nav-link" href="index.php?sub=personal information">Personal Information</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index.php?sub=Banking Information">Banking Information</a></li>
                    <!--<li class="nav-item"> <a class="nav-link" href="index.php?sub=Declarations">Declarations & Commitments</a></li>--> 
                </ul>
            </div>
            </li>

        <li class="nav-item">
            <a class="nav-link bg-warning text-dark" href="index.php?sub=module">
                <i class="icon-grid menu-icon text-dark"></i>   
                <span class="menu-title text-dark">Modules</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link bg-warning text-dark" href="index.php?sub=projects">
                <i class="icon-grid menu-icon text-dark"></i>
                <span class="menu-title text-dark">Courses</span>
            </a>
        </li>
        <!--<li class="nav-item">
            <a class="nav-link bg-warning text-dark" href="index.php?sub=assessments">
                <i class="icon-grid menu-icon text-dark"></i>
                <span class="menu-title text-dark">Assessments</span>
            </a>
    </li> -->

        <?php
        if ($AccountLevel == 1) {

            
            
            
            // Student Registration with submenus
            echo '<li class="nav-item">
            <a class="nav-link bg-warning" data-toggle="collapse" href="#studentRegistration" aria-expanded="false" aria-controls="studentRegistration">
            <i class="icon-layout menu-icon text-dark"></i>
            
            <span class="menu-title text-dark">Student Registration</span>
            <i class="menu-arrow text-dark"></i>
            </a>
            <div class="collapse" id="studentRegistration">
                <ul class="nav flex-column sub-menu bg-dark">
                    <li class="nav-item"> <a class="nav-link" href="index.php?sub=createBatches">Create Batches</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index.php?sub=manualRegistration">Manual Registration</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index.php?sub=batchUpload">Batch Upload</a></li>
                </ul>
            </div>
            </li>';

            // Assessments with submenus
            echo '<li class="nav-item">
            <a class="nav-link bg-warning" data-toggle="collapse" href="#assessments" aria-expanded="false" aria-controls="assessments">
            <i class="icon-layout menu-icon text-dark"></i>
            
            <span class="menu-title text-dark">Assessments</span>
            <i class="menu-arrow text-dark"></i>
            </a>
            <div class="collapse" id="studentRegistration">
                <ul class="nav flex-column sub-menu bg-dark">
                    <li class="nav-item"> <a class="nav-link" href="index.php?sub=one to one page">1 To 1</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index.php?sub=one eighty">180</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index.php?sub=personal test">Personality Test</a></li>
                </ul>
            </div>
            </li>';

            // Record Updating with submenus
            echo '<li class="nav-item">
            <a class="nav-link bg-warning" data-toggle="collapse" href="#recordUpdating" aria-expanded="false" aria-controls="recordUpdating">
            <i class="icon-grid menu-icon text-dark"></i>
            <span class="menu-title text-dark">Record Updating</span>
            <i class="menu-arrow text-dark"></i>
            </a>
            <div class="collapse" id="recordUpdating">
                <ul class="nav flex-column sub-menu bg-dark">
                    <li class="nav-item"> <a class="nav-link" href="index.php?sub=updateAttendance">Update Attendance</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index.php?sub=assessmentResults">Assessment Results</a></li>
                    
                </ul>
            </div>
            </li>';

            // Attendance
            echo '<li class="nav-item">
            <a class="nav-link bg-warning text-dark" href="index.php?sub=attendance">
            <i class="icon-grid menu-icon text-dark"></i>
                <span class="menu-title text-dark">Attendance</span>
            </a>
            </li>';

            // Supervisor Review
            echo '<li class="nav-item">
            <a class="nav-link bg-warning text-dark" href="index.php?sub=supervisor review">
            <i class="icon-grid menu-icon text-dark"></i>
                <span class="menu-title text-dark">Supervisor Review</span>
            </a>
            </li>';

            // Consultant Review
            echo '<li class="nav-item">
            <a class="nav-link bg-warning text-dark" href="index.php?sub=consultant review">
            <i class="icon-grid menu-icon text-dark"></i>
                <span class="menu-title text-dark">Consultant Review</span>
            </a>
            </li>';

            // potential table
            echo '<li class="nav-item">
            <a class="nav-link bg-warning text-dark" href="index.php?sub=reviews">
            <i class="icon-grid menu-icon text-dark"></i>
                <span class="menu-title text-dark">Potential Table</span>
            </a>
            </li>';

            // Calculations
            echo '<li class="nav-item">
            <a class="nav-link bg-warning text-dark" href="index.php?sub=Calculations">
            <i class="icon-grid menu-icon text-dark"></i>
                <span class="menu-title text-dark">Calculations</span>
            </a>
            </li>';
        }
        ?>
    </ul>
      </nav>

