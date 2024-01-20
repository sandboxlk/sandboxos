$(document).on('click','#btn-add',function(e) {
	var data = $("#user_form").serialize();
	$.ajax({
		data: data,
		type: "POST",
		url: "pages/insertandmanage/backend/user_list_backend.php",
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			if(dataResult.statusCode==200){
				$('#addEmployeeModal').modal('hide');
				alert('Data added successfully !'); 
				location.reload();						
			}
			if(dataResult.statusCode==400){
			   alert(dataResult.message);
			}
		},
		
	});
	e.preventDefault();
});


$(document).on('click','.update',function(e) {
	var empno = $(this).attr("data-empno");
	var first_name = $(this).attr("data-first_name");
	var last_name = $(this).attr("data-last_name");
	var dob_u = $(this).attr("data-dob");
	var Username = $(this).attr("data-Username");
	var pass = $(this).attr("data-Password");
	var Designation = $(this).attr("data-Designation");
	var Accountlevel = $(this).attr("data-Accountlevel");

	$('#empid').val(empno);
	$('#first_name').val(first_name);
	$('#last_name').val(last_name);
	$('#desg').val(Designation);
	$('#al').val(Accountlevel);
	$('#un').val(Username);
	$('#curr_pass_e').val(pass);
	document.getElementById('dob').value = dob_u;

});

$(document).on("click", ".delete", function() { 
	var empid=$(this).attr("data-empid");
	var currentstatus=$(this).attr("data-curr_status");
	var currentuser=$(this).attr("data-curr_user");

	$('#id_change').val(empid);
	$('#req_user').text(currentuser);
	if(currentstatus=="active"){
		$('#new_status').text("In-Active");
		$('#status_req').val("Inactive");
	}else{
		$('#new_status').text("Active");
		$('#status_req').val("active");
	}
});
$(document).on("click", "#delete", function() { 
	$.ajax({
		url: "pages/insertandmanage/backend/user_list_backend.php",
		type: "POST",
		cache: false,
		data:{
			type:3,
			id: $("#id_change").val(),
			status_req: $("#status_req").val()
		},
		success: function(dataResult){
				$('#statusModal').modal('hide');
				location.reload();
		
		}
	});
});
