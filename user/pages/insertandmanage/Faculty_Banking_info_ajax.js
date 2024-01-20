$(document).on('click','#btn-add',function(e) {
	
	var data = $("#user_form").serialize();
	$.ajax({
		data: data,
		type: "POST",
		url: "pages/insertandmanage/backend/Faculty_Banking_info_list_backend.php",
		success: function(dataResult){
			alert(dataResult);//sql error
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
	var bid=$(this).attr("data-bank_id_u");
	var name=$(this).attr("data-accountname_u");
	var number=$(this).attr("data-accountnumber_u");
	var bank=$(this).attr("data-bank_u");
	var branch=$(this).attr("data-branch_u");
	var swiftcode=$(this).attr("data-swiftcode_u");
	var bankcode=$(this).attr("data-bankcode_u");
	var branchcode=$(this).attr("data-branchcode_u");


	$('#bank_id_u').val(bid);
	$('#accountname_u').val(name);
	$('#accountnumber_u').val(number);
	$('#bank_u').val(bank);
	$('#branch_u').val(branch);
	$('#swiftcode_u').val(swiftcode);
	$('#bankcode_u').val(bankcode);
	$('#branchcode_u').val(branchcode);
	
});

//Update request
$(document).on('click','#update',function(e) {
	var data = $("#update_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "pages/insertandmanage/backend/Faculty_Banking_info_list_backend.php",
		success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				if(dataResult.statusCode==200){
					$('#editEmployeeModal').modal('hide');
					alert('Data updated successfully !'); 
					location.reload();						
				}
				else if(dataResult.statusCode==400){
				   alert(dataResult.message);
				}
		}
	});
});
$(document).on("click", ".delete", function() { 
	var id=$(this).attr("data-module_id_d");
	$('#id_d').val(id);
});
$(document).on("click", "#delete", function() { 
	$.ajax({
		url: "pages/insertandmanage/backend/Faculty_Banking_info_list_backend.php",
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
				url: "pages/insertandmanage/backend/Faculty_Banking_info_list_backend.php",
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
$(document).ready(function() {
    // Event handler for "Add Session Plans" button
    $('.add-session').click(function() {
        const courseID = $(this).data('courseid');
        $('#course_id_s').val(courseID); // Set the course ID in the modal form
    });

    // Event handler for session plans form submission
    $('#session_plans_form').submit(function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: "pages/insertandmanage/backend/Faculty_Banking_info_list_backend.php", // Update with the actual path to your PHP upload endpoint
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                // Handle success [showing a success message, etc.]
                console.log(data);
                $('#addSessionPlansModal').modal('hide');
            },
            error: function(err) {
                // Handle the error appropriately
                console.error("Error uploading the session plans:", err);
            }
        });
    });
});

$(document).on('click', '.view-session', function() {
    var courseId = $(this).data('courseid');
    $.ajax({
        url: 'pages/insertandmanage/backend/Faculty_Banking_info_list_backend.php',
        method: 'GET',
        data: { course_id: courseId },
        success: function(data) {
            var output = '';
            for (var i in data.files) {
                output += '<tr>';
                output += '<td>' + data.files[i].filename + '</td>';
                output += '<td><a href="' + data.files[i].path + '" target="_blank">View</a></td>';
                output += '</tr>';
            }
            $('#session-plans-table tbody').html(output);
            $('#session-name-display').text(courseId); // Displaying the course name or ID in the modal header
            $('#viewSessionPlansModal').modal('show');
        }
    });
});


