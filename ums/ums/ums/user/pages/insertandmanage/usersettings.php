<?php
include '../connection.php';
include '../check.php';

$comId=$user_id;
$result = mysqli_query($conn,"SELECT UserID,Username,DOB, FirstName, LastName, profileImg, Gender, Designation, Phone1, Phone2, Address, Email, AccountLevel FROM sys_users WHERE UserID=$comId");
while($row = mysqli_fetch_array($result)) {
	$EMPNo = $row["UserID"];
	$FirstName = $row["FirstName"];
	$LastName = $row["LastName"];
	$Phone1 = $row["Phone1"];
	$Phone2 = $row["Phone2"];
	$Gender = $row["Gender"];
	$Address = $row["Address"];
	$Email = $row["Email"];
	$dob = $row["DOB"];
	$Designation = $row["Designation"];
	$AccountLevel = $row["AccountLevel"];
	$Username = $row["Username"];
	$profileImg = $row["profileImg"];
	
}
?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Profile</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="pages/insertandmanage/user_list_ajax.js"></script>
	<script>
	//Change Password
	$(document).on('click','#update',function(e) {
		var data = $("#update_form").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "pages/insertandmanage/backend/changepassword.php",
			success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if (dataResult.statusCode == 200) {
						$('#changepassword').modal('hide');
						alert('Password updated successfully!');
						location.reload();
					} 
					if (dataResult.statusCode == 400) {
						alert(dataResult.message);
					} 
			}
		});
	});
	$(document).on('click','#update_geninfo',function(e) {
		var data = $("#update_genaralinfo").serialize();
		$.ajax({
			data: data,
			type: "post",
			url: "pages/insertandmanage/backend/user_list_backend.php",
			success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if (dataResult.statusCode == 200) {
						$('#changepassword').modal('hide');
						alert('Genaral Informations updated!');
						location.reload();
					}
					if (dataResult.statusCode == 400) {
						alert(dataResult.message);
					} 
			}
		});
	});
	</script>


	<!-- plugins:css -->
	<link rel="stylesheet" href="../../vendors/feather/feather.css">
	<link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
	<link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
	<!-- endinject -->
	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="../../vendors/select2/select2.min.css">
	<link rel="stylesheet" href="../../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
	<!-- End plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
	<!-- endinject -->
	<link rel="shortcut icon" href="../../images/favicon.png" />

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $(document).on("change", ".uploadProfileInput", function () {
      var triggerInput = this;
      var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
      var holder = $(this).closest(".pic-holder");
      var wrapper = $(this).closest(".profile-pic-wrapper");
      $(wrapper).find('[role="alert"]').remove();
      triggerInput.blur();
      var files = !!this.files ? this.files : [];
      if (!files.length || !window.FileReader) {
        return;
      }
      if (/^image/.test(files[0].type)) {
        // only image file
        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(files[0]); // read the local file

        reader.onloadend = function () {
          $(holder).addClass("uploadInProgress");
          $(holder).find(".pic").attr("src", this.result);
          $(holder).append(
            '<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
          );

          var formData = new FormData();
          formData.append('profile_pic', files[0]);

          $.ajax({
            url: 'pages/insertandmanage/backend/profile_image_upload.php', // The URL to handle the image upload on the server
            type: 'POST',
            data: formData,
            processData: false, // Important! Don't process the data
            contentType: false, // Important! Don't set contentType
            success: function(response) {
			 
			  var response = JSON.parse(response);
              $(holder).removeClass("uploadInProgress");
              $(holder).find(".upload-loader").remove();

			  if(response.statusCode==200){
                $(wrapper).append(
                  '<div class="snackbar show" role="alert"><i class="fa fa-check-circle text-success"></i> Profile image updated successfully</div>'
                );
              } 
			  
			  if(response.statusCode==400){
                $(holder).find(".pic").attr("src", currentImg);
                $(wrapper).append(
                  '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i>There is an error while uploading! Please try again later.</div>'
                );
              }

              // Clear input after upload
              $(triggerInput).val("");

              setTimeout(() => {
                $(wrapper).find('[role="alert"]').remove();
              }, 3000);
            },
            error: function(xhr, status, error) {
              // Handle errors here (if needed)
              console.error('Error uploading image: ' + error);
              $(holder).removeClass("uploadInProgress");
              $(holder).find(".upload-loader").remove();
              $(holder).find(".pic").attr("src", currentImg);
              $(wrapper).append(
                '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> There is an error while uploading! Please try again later.</div>'
              );

              // Clear input after upload
              $(triggerInput).val("");

              setTimeout(() => {
                $(wrapper).find('[role="alert"]').remove();
              }, 3000);
            }
          });

        };
      } else {
        $(wrapper).append(
          '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose a valid image.</div>'
        );
        setTimeout(() => {
          $(wrapper).find('[role="alert"]').remove();
        }, 3000);
      }
    });
  });
</script>

<style>
.profile-pic-wrapper {
  height: 250pxvh;
  width: 100%;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.pic-holder {
  text-align: center;
  position: relative;
  border-radius: 50%;
  width: 150px;
  height: 150px;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
}

.pic-holder .pic {
  width: 100%;
  -o-object-fit: cover;
  object-fit: cover;
  -o-object-position: center;
  object-position: center;
}

.pic-holder .upload-file-block,
.pic-holder .upload-loader {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: rgba(90, 92, 105, 0.7);
  color: #f8f9fc;
  font-size: 12px;
  font-weight: 600;
  opacity: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
}

.pic-holder .upload-file-block {
  cursor: pointer;
}

.pic-holder:hover .upload-file-block,
.uploadProfileInput:focus ~ .upload-file-block {
  opacity: 1;
}

.pic-holder.uploadInProgress .upload-file-block {
  display: none;
}

.pic-holder.uploadInProgress .upload-loader {
  opacity: 1;
}

/* Snackbar css */
.snackbar {
  visibility: hidden;
  min-width: 250px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 14px;
  transform: translateX(-50%);
}

.snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {
    bottom: 0;
    opacity: 0;
  }
  to {
    bottom: 30px;
    opacity: 1;
  }
}

@keyframes fadein {
  from {
    bottom: 0;
    opacity: 0;
  }
  to {
    bottom: 30px;
    opacity: 1;
  }
}

@-webkit-keyframes fadeout {
  from {
    bottom: 30px;
    opacity: 1;
  }
  to {
    bottom: 0;
    opacity: 0;
  }
}

@keyframes fadeout {
  from {
    bottom: 30px;
    opacity: 1;
  }
  to {
    bottom: 0;
    opacity: 0;
  }
}

</style>

<div class="col-12 grid-margin">
<div class="card">
<div class="card-body">
<h4 class="card-title mb-4 mt-4 mb-xl-4"><?php echo $FirstName.' '. $LastName;?></h4>
<p id="success"></p>
<div class="col-12 grid-margin">
                <form class="form-sample" id="update_genaralinfo">
					<div class="row">
                      <div class="col-md-4">
					  <p class="card-description">Account Type : <?php echo $AccountLevel_txt;?></p>
						<p class="card-description">Designation : <?php echo $Designation;?></p>
						<p class="card-description">Username : <?php echo $Username;?></p>
						<a href="#changepassword" class="btn btn-primary btn-sm float-left" data-toggle="modal"><span>Change password</span></a>	
					</div>  
                    </div>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<div class="profile-pic-wrapper">
									<div class="pic-holder">
										<?php
										if($profileImg!=""){
											echo '<img  id="profilePic" class="pic" src="data:image/jpg;charset=utf8;base64,'.base64_encode($profileImg).'"/>';
										}else{
											echo '<img id="profilePic" class="pic" src="images/Nophoto.png">';
										}
										?>
										<Input class="uploadProfileInput" type="file" name="profile_pic" id="newProfilePhoto" accept="image/*" style="opacity: 0;" />
										<label for="newProfilePhoto" class="upload-file-block">
										<div class="text-center">
											<div class="mb-2">
											<i class="fa fa-camera fa-2x"></i>
											</div>
											<div class="text-uppercase">
											Update <br /> Profile Photo
											</div>
										</div>
										</label>
									</div>		
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">First Name</label>
								<div class="col-sm-9">
									<input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $FirstName; ?>" />
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Last Name</label>
								<div class="col-sm-9">
									<input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $LastName; ?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Gender</label>
								<div class="col-sm-9">
									<select id="gender" name="gender" class="form-control">
										<?php
										if ($Gender == "Male") {
											echo '<option value="Male" selected>Male</option>';
											echo '<option value="Female">Female</option>';
										} else if ($Gender == "Female") {
											echo '<option value="Male">Male</option>';
											echo '<option value="Female" selected>Female</option>';
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Date of Birth</label>
								<div class="col-sm-9">
									<input type="date" id="dob" name="dob" class="form-control" value="<?php echo $Email; ?>" />
									<script>
										<?php $currentDate = $dob; ?>
										document.getElementById('dob').value = '<?php echo $currentDate; ?>';
									</script>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Address</label>
								<div class="col-sm-9">
									<input type="text" id="address" name="address" class="form-control" value="<?php echo $Address; ?>" />
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Email</label>
								<div class="col-sm-9">
									<input type="email" id="email" name="email" class="form-control" value="<?php echo $Email; ?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Contact Number 1</label>
                          <div class="col-sm-9">
						  	<input type="text" class="form-control" id="phone1" name="phone1" value="<?php echo $Phone1;?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Contact Number 2</label>
                          <div class="col-sm-9">
						  <input type="text" class="form-control" id="phone2" name="phone2" value="<?php echo $Phone2;?>"/>
                          </div>
                        </div>
                      </div>
                    </div>
					<input type="hidden" value="geninfoupdate" name="type">
					<button type="button" class="btn btn-primary btn-sm" id="update_geninfo">Update</button>
				</form>
            </div>
		</div>
	</div>
</div>

<!-- Edit Modal HTML -->
<div id="changepassword" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="update_form">
				<div class="modal-header">						
					<h4 class="modal-title">Change Password</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
					<div class="modal-body">
					<input type="hidden" id="id_u" name="id" class="form-control" required>					
					<div class="form-group">
					<label>Current Password</label>
						<input type="password" id="c_pass" name="c_pass" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>New Password</label>
						<input type="password" id="n_pass" name="n_pass" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label>Re-Enter New Password</label>
						<input type="password" id="rn_pass" name="rn_pass" class="form-control" autocomplete="off" required>
					</div>		
				</div>
				<div class="modal-footer">
				<input type="hidden" value="2" name="type">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-info" id="update">Change Password</button>
				</div>
			</form>
		</div>
	</div>
</div>