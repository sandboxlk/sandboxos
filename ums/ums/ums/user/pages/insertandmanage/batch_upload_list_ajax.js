$(document).on('click','#btn-add',function(e) {
	var data = $("#user_form").serialize();
	$.ajax({
		data: data,
		type: "POST",
		url: "pages/insertandmanage/backend/batch_upload_list_backend.php",
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
		}
	}); 
	e.preventDefault();
});


$(document).on('click','.update',function(e) {
	var cid=$(this).attr("data-courseID_u");
	var cn=$(this).attr("data-CourseName_u");
	var cd=$(this).attr("data-duration_u");
	var cl=$(this).attr("data-lecturer_u");

	$('#course_id_u').val(cid);
	$('#coursename_u').val(cn);
	$('#courseduration').val(cd);
	$('#lecturername').val(cl);
});

$(document).on('click','#update',function(e) {
	var data = $("#update_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "pages/insertandmanage/backend/batch_upload_list_backend.php",
		success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				if(dataResult.statusCode==200){
					$('#editEmployeeModal').modal('hide');
					alert('Data updated successfully !'); 
					location.reload();						
				}
				if(dataResult.statusCode==400){
				   alert(dataResult.message);
				}
		}
	});
});
$(document).on("click", ".delete", function() { 
	var id=$(this).attr("data-course_id_d");
	$('#id_d').val(id);
	
});
$(document).on("click", "#delete", function() { 
	$.ajax({
		url: "pages/insertandmanage/backend/batch_upload_list_backend.php",
		type: "POST",
		cache: false,
		data:{
			type:3,
			id: $("#id_d").val()
		},
		success: function(dataResult){
				$('#deleteEmployeeModal').modal('hide');
				location.reload();
		
		}
	});
});
$(document).on("click", "#delete_multiple", function() {
	var user = [];
	$(".user_checkbox:checked").each(function() {
		user.push($(this).data('user-id'));
	});
	if(user.length <=0) {
		alert("Please select records."); 
	} 
	else { 
		WRN_PROFILE_DELETE = "Are you sure you want to delete "+(user.length>1?"these":"this")+" row?";
		var checked = confirm(WRN_PROFILE_DELETE);
		if(checked == true) {
			var selected_values = user.join(",");
			console.log(selected_values);
			$.ajax({
				type: "POST",
				url: "pages/insertandmanage/backend/batch_upload_list_backend.php",
				cache:false,
				data:{
					type: 4,						
					id : selected_values
				},
				success: function(response) {
					var ids = response.split(",");
					for (var i=0; i < ids.length; i++ ) {	
						$("#"+ids[i]).remove(); 
					}	
				} 
			}); 
		}  
	} 
});
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

$(document).ready(function(){
    // Event handler for "Add Session Plans" button
    $('.add-session').click(function(){
        const courseID = $(this).data('courseid');
        $('#course_id_s').val(courseID); // Set the course ID in the modal form
        $('#addSessionPlansModal').modal('show'); // Show the modal
    });
    
    // Event handler for session plans form submission
    $('#session_plans_form').submit(function(e){
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: 'path_to_your_upload_endpoint.php', // should Update with the actual path to my PHP upload endpoint
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                // Handle success [showing a success message]
                console.log(data);
                $('#addSessionPlansModal').modal('hide');
            }
        });
    });
});
