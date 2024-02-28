//$(document).on('click','#btn-add',function(e) {
//	e.preventDefault();
//	var data = $("#user_form").serialize();
//	$.ajax({
//		data: data,
//		type: "POST",
//		url: "pages/insertandmanage/backend/create_batches_list_backend.php",
//		success: function (dataResult){
//			var dataResult = JSON.parse(dataResult);
//			if(dataResult.statusCode==200){   
//				$('#addEmployeeModal').modal('hide');
//				alert('Registration Completed!'); 
//				location.reload();						
//			}
//			if(dataResult.statusCode==400){
//				alert(dataResult.message);
//			    //alert('Please Select No Series.');
//			}
//		},
//		
//	}); 
//}); 

$(document).on('click', '#btn-add', function (e) {
	e.preventDefault();
	var data = $("#user_form").serialize();
	$.ajax({
		data: data,
		type: "POST",
		url: "pages/insertandmanage/backend/create_batches_list_backend.php",
		success: function (dataResult) {
			var dataResult = JSON.parse(dataResult);
			if (dataResult.statusCode == 200) {
				$('#addEmployeeModal').modal('hide');
				alert('Batch created successfully!');
				console.log(dataResult.message); // Log success message to console
				location.reload();
			}
			if (dataResult.statusCode == 400) {
				alert(dataResult.message);
				console.error(dataResult.message); // Log error message to console
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error:", status, error);
		},
	});
});

// ... Your other JavaScript code for updating...

$(document).ready(function () {
	var input = document.createElement('input');
	input.setAttribute('type', 'date');
	if (input.type !== 'date') {
		$('.datepicker').datepicker({
			dateFormat: 'yy-mm-dd'
		});
	}
});




$(document).on('click', '.update', function (e) {
	var id = $(this).attr("data-id");
	var company = $(this).attr("data-company");
	var batch = $(this).attr("data-batch");
	var budget = $(this).attr("data-budget");
	var year = $(this).attr("data-year");
	var date = $(this).attr("data-date");
	var course = $(this).attr("data-course");
	var StartDate = $(this).attr("data-StartDate");
	var EndDate = $(this).attr("data-EndDate");

	$('#id_u').val(id);
	$('#company_u').val(company);
	$('#batch_u').val(batch);
	$('#budget_u').val(budget);
	$('#year_u').val(year);
	$('#date_u').val(date);
	$('#course_u').val(course);
	$('#stardate_u').val(StartDate);
	$('#enddate_u').val(EndDate);
});

$(document).on('click', '#update', function (e) {
	var data = $("#update_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "pages/insertandmanage/backend/create_batches_list_backend.php",
		success: function (dataResult) {
			console.log(dataResult)

			$('#editEmployeeModal').modal('hide');
			alert('Data updated successfully !');
			location.reload();

		}
	});
});

$(document).on("click", ".delete", function () {
	var id = $(this).attr("data-id");
	$('#id_d').val(id);

});
$(document).on("click", "#delete", function () {
	$.ajax({
		url: "pages/insertandmanage/backend/create_batches_list_backend.php",

		type: "POST",
		cache: false,
		data: {
			type: 3,
			id: $("#id_d").val()
		},
		success: function (dataResult) {
			$('#deleteEmployeeModal').modal('hide');
			location.reload();
			$("#" + dataResult).remove();

		}
	});
});

$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip();
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function () {
		if (this.checked) {
			checkbox.each(function () {
				this.checked = true;
			});
		} else {
			checkbox.each(function () {
				this.checked = false;
			});
		}
	});
	checkbox.click(function () {
		if (!this.checked) {
			$("#selectAll").prop("checked", false);
		}
	});
});