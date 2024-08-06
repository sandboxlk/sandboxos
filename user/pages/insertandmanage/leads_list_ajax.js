$(document).on('click', '.update', function (e) {
	var cid = $(this).attr("data-id");
	//var cc = $(this).attr("data-client");
	var salesStage = $(this).attr("data-salesStage");
	//var date = $(this).attr("data-date");
	var lead = $(this).attr("data-lead");
	//var categorytype = $(this).attr("data-categoryType");
	//var leadtype = $(this).attr("data-leadtype");
	var requirement = $(this).attr("data-requirement");
	var sales = $(this).attr("data-estimatesv");
	var lost = $(this).attr("data-lostlead");
	//var perliminary = $(this).attr("data-perliminary");
	//var email = $(this).attr("data-email");
	//var shedulechem = $(this).attr("data-shedule");
	//var chemmeeting = $(this).attr("data-chemistry");
	//var proposal = $(this).attr("data-proposal");
	//var estimate = $(this).attr("data-estimate");
	//var confirmation = $(this).attr("data-confirmation");
	//var cof = $(this).attr("data-cof");
	//var po = $(this).attr("data-po");
	//var invoice = $(this).attr("data-invoice");
	//var invoiceDT = $(this).attr("data-invoiceDT");
	//var payment = $(this).attr("data-payment");
	//var program = $(this).attr("data-programs");
	//var preprogram = $(this).attr("data-preProgram");
	//var surveydata = $(this).attr("data-SurveyData");
	//var coursefacillitation = $(this).attr("data-courseFacillitation");
	//var projectsandassessments = $(this).attr("data-projectsAssessments");
	//var datacertification = $(this).attr("data-dataCertification");
	//var graduation = $(this).attr("data-graduation");
	//var programCompleted = $(this).attr("data-programCompleted");
	//var followup = $(this).attr("data-post");
	//var protofolio = $(this).attr("data-protofolio");
	//var business = $(this).attr("data-meeting");
	//var completion=$(this).attr("data-completion");
	var followupactions = $(this).attr("data-followup");
	//var confidenseLevel = $(this).attr("data-confidenseLevel");

	//var  salesStage = 'Pre Sales';
    //if (cof == 1 && program == 1) {
       // salesStage = 'Post Sales';
    //} else if (cof == 1) {
		//salesStage = 'Close Won';
    //} else if (program == 1) {
		//salesStage = 'Post Sales';
   // } else if (lost != '') {
		//salesStage = 'Lost Lead';
   // }

	$('#id_u').val(cid);
	//$('#client_u').val(cc);
	//$('#date_u').val(date);
	$('#salesStage_u').val(salesStage);
	$('#lead_u').val(lead);
	//$('#Categorytype_u').val(categorytype);
	//$('#ltype_u').val(leadtype);
	$('#requirement_u').val(requirement);
	$('#sales_u').val(sales);
	$('#lost_u').val(lost);
	//$('#perliminary_u').val(perliminary);
	//$('#email_u').val(email);
	//$('#shedulecm_u').val(shedulechem);
	//$('#chemmeeting_u').val(chemmeeting);
	//$('#proposal_u').val(proposal);
	//$('#estimate_u').val(estimate);
	//$('#confirmation_u').val(confirmation);
	//$('#cof_u').val(cof);
	//$('#po_u').val(po);
	//$('#invoice_u').val(invoice);
	//$('#invoiceDT_u').val(invoiceDT);
	//$('#payment_u').val(payment);
	//$('#program_u').val(program);
	//$('#preprogram_u').val(preprogram);
	//$('#SurveyData_u').val(surveydata);
	//$('#Coursefacilitation_u').val(coursefacillitation);
	//$('#projectsassessments_u').val(projectsandassessments);
	//$('#datacertification_u').val(datacertification);
	//$('#graduation_u').val(graduation);
	//$('#programC_u').val(programCompleted);
	//$('#followup_u').val(followup);
	//$('#protofolio_u').val(protofolio);
	//$('#business_u').val(business);
	$('#action_u').val(followupactions);
	//$('#confidencelevel_u').val(confidenseLevel);
});

$(document).on('click', '#update', function (e) {
	var data = $("#update_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "pages/insertandmanage/backend/leads_list_backend.php",
		success: function (dataResult) {
			console.log(dataResult)

			$('#editEmployeeModal').modal('hide');
			alert('Data updated successfully !');
			location.reload();

		}
	});
});

$(document).on("click", ".delete", function () {
	var id = $(this).attr("data-id_u");
	$('#id_u').val(id);

});
$(document).on("click", "#delete", function () {
	$.ajax({
		url: "pages/insertandmanage/backend/leads_list_backend.php",
		type: "POST",
		cache: false,
		data: {
			type: 3,
			id: $("#id_u").val()
		},
		success: function (dataResult) {
			$('#deleteEmployeeModal').modal('hide');
			location.reload();

		}
	});
});
$(document).on("click", "#delete_multiple", function () {
	var user = [];
	$(".user_checkbox:checked").each(function () {
		user.push($(this).data('user-id'));
	});
	if (user.length <= 0) {
		alert("Please select records.");
	}
	else {
		WRN_PROFILE_DELETE = "Are you sure you want to delete " + (user.length > 1 ? "these" : "this") + " row?";
		var checked = confirm(WRN_PROFILE_DELETE);
		if (checked == true) {
			var selected_values = user.join(",");
			console.log(selected_values);
			$.ajax({
				type: "POST",
				url: "pages/insertandmanage/backend/leads_list_backend.php",
				cache: false,
				data: {
					type: 4,
					id: selected_values
				},
				success: function (response) {
					var ids = response.split(",");
					for (var i = 0; i < ids.length; i++) {
						$("#" + ids[i]).remove();
					}
				}
			});
		}
	}
});
