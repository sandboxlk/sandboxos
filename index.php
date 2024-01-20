<?php
include('login.php');
if ((isset($_SESSION['username']) != '')) 
{
	header('Location: user/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>User Management System</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="user/vendors/feather/feather.css">
  <link rel="stylesheet" href="user/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="user/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="user/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="user/images/favicon.PNG" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper bg-white d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-5 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-2">
              <div class="text-center">
                <img src="user/images/logo.PNG" alt="logo" width="20%">
              </div>
              <br>
              <br>
              <h4 class="text-center">User Management System</h4>
              <br>
              <form class="pt-3" method="post" action="">
                <div class="form-group">
                  <input type="text" class="form-control form-control-sm border border-warning rounded"  name="usr_username" id="exampleInputEmail1" placeholder="Username" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-sm border border-warning rounded" name="usr_password" id="exampleInputPassword1" placeholder="Password" autocomplete="off" required>
                </div>
                <div class="mt-3">
                <button type="submit" name="submit" class="btn btn-block btn-warning btn-sm font-weight-bold auth-form-btn">Login</button>
              </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>          
              </form>
			  <p style="color:red;text-align: center; font-size:14px;"><?php echo $error;?></p>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="user/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="user/js/off-canvas.js"></script>
  <script src="user/js/hoverable-collapse.js"></script>
  <script src="user/js/template.js"></script>
  <script src="user/js/settings.js"></script>
  <script src="user/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
