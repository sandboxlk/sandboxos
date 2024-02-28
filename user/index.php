<?php
//include("./errorsandwarnings.php");
include("../connection.php");
include('../login.php'); // Include Login Script
require 'pages/page_management.php';
$pagemngt = new PageManagement();
$today_date=date("Y-m-d");

if (isset($_GET['sub'])){
  $sub_get=$_GET['sub'];
}else{
  $sub_get = "";
}

if ((isset($_SESSION['username']) == '')) 
{
	header('Location: ../index.php');
}else{
    $currentUser = $_SESSION['username'];
    $sql_get_user_full = "SELECT FirstName,LastName,AccountLevel,profileImg FROM sys_users WHERE Username='$currentUser'";
    $resultuser_full = mysqli_query($conn, $sql_get_user_full);
    if (mysqli_num_rows($resultuser_full) > 0) {
        while($rowuser_full = mysqli_fetch_assoc($resultuser_full)) {
            $UserFullName =$rowuser_full["FirstName"] ." ". $rowuser_full["LastName"];
            $profileImg=$rowuser_full["profileImg"];
			if ($rowuser_full["AccountLevel"] == 1) {
        
				$TypeSys ="<span class='btn-success px-2'>Administrator</span>";
			}else if ($rowuser_full["AccountLevel"] == 2) {
				$TypeSys ="<span class='btn-warning px-2'>Functional Consultant</span>";
			}elseif ($rowuser_full["AccountLevel"] == 3) {
				$TypeSys ="<span class='btn-info px-2'>Technical Consultant</span>";
			}else{
				$TypeSys=$Error_InvalidAccountType;
			}
			
        }
    } else {
        header('Location: ../index.php');
    }
}

$search = isset($_GET['search']) ? $_GET['search'] : '';

$result = mysqli_query($conn, "SELECT * FROM leads WHERE company LIKE '%$search%'");
$result = mysqli_query($conn, "SELECT * FROM clients WHERE clientName LIKE '%$search%'");

?>

<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Welcome to User Management System | Home</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-1" href="index.html"><img src="images/topl_Genaral/logo.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/topl_Genaral/toplmini.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <form method="get" action="index.php">
              <input type="hidden" name="sub" value="Leads">

	<div class="input-group">
		<input type="text" class="form-control" name="search" placeholder="Search..." value="<?= $search ?>">
		<div class="input-group-append">
			<button type="submit" class="btn btn-outline-secondary">Search</button>
		</div>
	</div>
</form>            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <?php
										if($profileImg!=""){
											echo '<img src="data:image/jpg;charset=utf8;base64,'.base64_encode($profileImg).'" alt="profile" />';
										}else{
											echo '<img src="images/faces/face28.jpg" alt="profile">';
										}
							?>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-user text-primary"></i>
                <?php echo $UserFullName;?> &nbsp;<?php  $currentUser;?>  <h6 class="font-weight-normal mb-0"><?php echo $TypeSys;?></h6>
              </a>
              <a href="index.php?sub=settings" target="_self" class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a href="../logout.php" class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>	  
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <!-- <div id="settings-trigger"><i class="ti-settings"></i></div>  SETTINGD BUTON CD COMMENTED-->
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Angelo</p>
              <p class="text-gray mb-0 ">Call Menaka Mayadunne</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
            <!-- Notification -->
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php include 'pages/sidebar/sidebar_topl.php'?>
      <!--  partial:partials/_sidebar.html end -->
      <!-- partial -->
     <div class="main-panel">
        <div class="content-wrapper<Removethis>">
        
          <?php 
          if ($sub_get=="companies") {
            $pagemngt->client();
          }else
          if ($sub_get=="projects") {
            $pagemngt->projects();
          }
          if ($sub_get=="module") {
            $pagemngt->module();
          }
          if ($sub_get=="assessments") {
            $pagemngt->assessment_list();
          }
        
          if ($sub_get=="attendance") {
            $pagemngt->attendance_list();
          }

          if ($sub_get=="supervisor review") {
            $pagemngt->supervisor_review_list();
          }

          if ($sub_get=="Leads") {
            $pagemngt->leads_list();
          }

          if ($sub_get=="consultant review") {
            $pagemngt->consultant_review_list();
          }
          if ($sub_get=="reviews") {
            $pagemngt->review_list();
          }
          if ($sub_get=="Calculations") {
            $pagemngt->calculations_list();
          }
          if ($sub_get=="personal information") {
            $pagemngt->Faculty_PI_list();
          }
          if ($sub_get=="Banking Information") {
            $pagemngt->Faculty_Banking_info_list();
          }
          if ($sub_get=="Declarations") {
            $pagemngt->decl_commit_list();
          }
          if ($sub_get=="studentRegistration") {
            $pagemngt->student_reg();
          }
          if (($sub_get=="home") || (!isset($_GET['sub'])) && (!isset($_GET['ticket']))) {
            $pagemngt->dashboard();
          }
          if (($sub_get=="calender") || (!isset($_GET['sub'])) && (!isset($_GET['ticket']))) {
            $pagemngt->calender();
          }
          if ($sub_get=="one to one page") {
            $pagemngt->one_to_one_ass_list();
          }
          if ($sub_get=="one eighty") {
            $pagemngt->one_eighty_ass_list();
          }
          if ($sub_get=="personal test") {
            $pagemngt->personal_test_ass_list();
          }
          if ($sub_get=="createBatches") {
            $pagemngt->create_batches_list();
          }
          if ($sub_get=="manualRegistration") {
            $pagemngt->manual_registration_list();
          }
          if ($sub_get=="batchUpload") {
            $pagemngt->batch_upload_list();
          }
          if ($sub_get=="updateAttendance") {
            $pagemngt->Update_attendance_list();
          }
          if ($sub_get=="assessmentResults") {
            $pagemngt->Assessment_results_list();
          }
          
          if ($sub_get=="tktupdate"){
            $pagemngt->tktupdate();
          }
          if ($sub_get=="settings") {
            $pagemngt->usersettings();
          }
          ?>
       
      
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

