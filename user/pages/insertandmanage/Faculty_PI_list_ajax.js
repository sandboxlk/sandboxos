$(document).on('click','.update',function(e) {
	var facultyid=$(this).attr("data-id");
	var callingName=$(this).attr("data-name");
	var nic=$(this).attr("data-nic");
	var address=$(this).attr("data-address");
	var mobileNo1=$(this).attr("data-contact1");
	var mobileNo2=$(this).attr("data-contact2");
	var emergencyContact=$(this).attr("data-contact3");
	var designation=$(this).attr("data-Designation");
	var currentEmployee=$(this).attr("data-Employee");
	var facultyLevel=$(this).attr("data-faculty_level");
	var careersStartY=$(this).attr("data-Careerssy");
	var yoe=$(this).attr("data-Experience");
	var formalQualification=$(this).attr("data-Qualification");
	var expertiseArea1=$(this).attr("data-expertiseArea1");
	var expertiseArea2=$(this).attr("data-expertiseArea2");
	var expertiseArea3=$(this).attr("data-expertiseArea3");
	var expertiseArea4=$(this).attr("data-expertiseArea4");
	var type1=$(this).attr("data-type1");
	var weekends=$(this).attr("data-weekends");
	var dayspermonth=$(this).attr("data-dayspermonth");
	var availabaility=$(this).attr("data-total_avalability");
	var type2=$(this).attr("data-type2");
	var weekend2=$(this).attr("data-weekends2");
	var month=$(this).attr("data-daysPerMonth2");
	var daysperyear=$(this).attr("data-TotalDaysPerYear");
	var capacity=$(this).attr("data-capacity");

	$('#id_u').val(facultyid);
	$('#name_u').val(callingName); 
	$('#nic_u').val(nic); 
	$('#address_u').val(address);
	$('#contact1_u').val(mobileNo1);
	$('#contact2_u').val(mobileNo2);
	$('#contact3_u').val(emergencyContact);
	$('#Designation_u').val(designation);
	$('#Employee_u').val(currentEmployee);
	$('#faculty_level_u').val(facultyLevel);
	$('#Careerssy_u').val(careersStartY);
	$('#Experience_u').val(yoe);
	$('#Qualification_u').val(formalQualification);
	$('#ExpertiseArea1_u').val(expertiseArea1);
	$('#Expertise_u').val(expertiseArea2);
	$('#Expert_u').val(expertiseArea3);
	$('#faculty_u').val(expertiseArea4);
	$('#type1_u').val(type1);
	$('#weekends_u').val(weekends);
	$('#daysPerMonth_u').val(dayspermonth);
	$('#total_u').val(availabaility);
	$('#type2_u').val(type2);
	$('#weekends2_u').val(weekend2);
	$('#daysPerMonth2_u').val(month);
	$('#total2_u').val(daysperyear);
	$('#Capacity_u').val(capacity);
	
});

$(document).on('click','#update',function(e) {
	var data = $("#update_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "pages/insertandmanage/backend/Faculty_PI_list_backend.php",
		success: function(dataResult){
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
