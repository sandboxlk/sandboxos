$(document).on('click','#btn-add',function(e) {
	var data = $("#user_form").serialize();
	$.ajax({
		data: data,
		type: "POST",
		url: "pages/insertandmanage/backend/update_attendance_list_backend.php",
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			if(dataResult.statusCode==200){
				$('#addEmployeeModal').modal('hide');
				alert('Registration Completed!');  
				location.reload();						
			}
			if(dataResult.statusCode==400){
				alert(dataResult.message);
			    //alert('Please Select No Series.');
			}
		}, 
		
	});
});


$(document).on('click','.update',function(e) {
	var id=$(this).attr("data-id");
	var name=$(this).attr("data-name");
	var address=$(this).attr("data-address");
	var email=$(this).attr("data-email");
	var contact1=$(this).attr("data-contact1");
	var contact2=$(this).attr("data-contact2");

	$('#id_u').val(id);
	$('#name_u').val(name);
	$('#address_u').val(address);
	$('#email_u').val(email);
	$('#contact1_u').val(contact1);
	$('#contact2_u').val(contact2);
});

$(document).on('click','#update',function(e) {
	var data = $("#update_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "pages/insertandmanage/backend/update_attendance_list_backend.php",
		success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				if(dataResult.statusCode==200){
					$('#editEmployeeModal').modal('hide');
					alert('Company updated !'); 
					location.reload();						
				}
				if(dataResult.statusCode==400){
				   alert(dataResult.message);
				}
		}
	});
});
$(document).on("click", ".delete", function() { 
	var id=$(this).attr("data-id");
	$('#id_d').val(id);
	
});
$(document).on("click", "#delete", function() { 
	$.ajax({
		url: "pages/insertandmanage/backend/update_attendance_list_backend.php",
		type: "POST",
		cache: false,
		data:{
			type:3,
			id: $("#id_d").val()
		},
		success: function(dataResult){
				$('#deleteEmployeeModal').modal('hide');
				location.reload();	
				$("#"+dataResult).remove();
		
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
				url: "pages/insertandmanage/backend/update_attendance_list_backend.php",
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