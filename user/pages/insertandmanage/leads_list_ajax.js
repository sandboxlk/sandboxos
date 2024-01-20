// $(document).on('click','#addEmployeeModal #btn-add',function() {
// 	alert('1');
// 	var data = $("#user_form").serialize();
// 	$.ajax({
// 		data: data,
// 		type: "POST",
// 		url: "pages\insertandmanage\backend\leads_list_backend.php",
// 		success: function(dataResult){
// 			alert('2');
// 			alert(dataResult);
// 			var dataResult = JSON.parse(dataResult);
// 			if(dataResult.statusCode==200){
// 				$('#addEmployeeModal').modal('hide');
// 				alert('Company added!'); 
// 				location.reload();						
// 			}
// 			if(dataResult.statusCode==400){
// 				alert(dataResult.message);
// 			    //alert('Please Select No Series.');
// 			}
// 		}, 
		
// 	});
// });


 
$(document).on('click','.update',function(e) {
	var cid=$(this).attr("data-id_u");
	var cc=$(this).attr("data-client_u");
	var date=$(this).attr("data-date_u");
	var lead=$(this).attr("data-lead_u");
	var leadtype=$(this).attr("data-leadtype_u");
	var requirement=$(this).attr("data-requirement_u");
	var sales=$(this).attr("data-sales_u");
	var lost=$(this).attr("data-lost_u");
	var perliminary=$(this).attr("data-perliminary_u");
	var email=$(this).attr("data-email_u");
	var shedulechem=$(this).attr("data-shedulecm_u");
	var chemmeeting=$(this).attr("data-chemmeeting_u");
	var proposal=$(this).attr("data-proposal_u");
	var estimate=$(this).attr("data-estimate_u");
	var confirmation=$(this).attr("data-confirmation_u");
	var cof=$(this).attr("data-cof_u");
	var po=$(this).attr("data-po_u");
	var invoice=$(this).attr("data-invoice_u");
	var payment=$(this).attr("data-payment_u");
	var program=$(this).attr("data-program_u");
	var followup=$(this).attr("data-followup_u");
	var protofolio=$(this).attr("data-protofolio_u");
	var business=$(this).attr("data-business_u");
	var completion=$(this).attr("data-completion_u");
	var notes=$(this).attr("data-notes_u");
	var followupactions=$(this).attr("data-action_u");
	

	$('#id_u').val(cid);
	$('#client_u').val(cc);
	$('#date_u').val(date);
	$('#lead_u').val(lead);
	$('#leadtype_u').val(leadtype);
	$('#requirement_u').val(requirement);
	$('#sales_u').val(sales);
	$('#lost_u').val(lost);
	$('#perliminary_u').val(perliminary);
	$('#email_u').val(email);
	$('#shedulecm_u').val(shedulechem);
	$('#chemmeeting_u').val(chemmeeting);
	$('#proposal_u').val(proposal);
	$('#estimate_u').val(estimate);
	$('#confirmation_u').val(confirmation);
	$('#cof_u').val(cof);
	$('#po_u').val(po);
	$('#invoice_u').val(invoice);
	$('#payment_u').val(payment);
	$('#program_u').val(program);
	$('#followup_u').val(followup);
	$('#protofolio_u').val(protofolio);
	$('#business_u').val(business);
	$('#completion_u').val(completion);
	$('#notes_u').val(notes);
	$('#completion_u').val(followupactions);
});

$(document).on('click','#update',function(e) {
	var data = $("#update_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "pages/insertandmanage/backend/leads_list_backend.php",
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
	var id=$(this).attr("data-id_u");
	$('#id_u').val(id);
	
});
$(document).on("click", "#delete", function() { 
	$.ajax({
		url: "pages/insertandmanage/backend/leads_list_backend.php",
		type: "POST",
		cache: false,
		data:{
			type:3,
			id: $("#id_u").val()
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
				url: "pages/insertandmanage/backend/leads_list_backend.php",
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
