$(document).on('click', '#btn-add', function (e) {

	var data = $("#user_form").serialize();
	$.ajax({
		data: data,
		type: "POST",
		url: "pages/insertandmanage/backend/module_list_backend.php",
		success: function (dataResult) {
			alert(dataResult);//sql error
			var dataResult = JSON.parse(dataResult);
			if (dataResult.statusCode == 200) {
				$('#addEmployeeModal').modal('hide');
				alert('Data added successfully !');
				location.reload();
			}
			if (dataResult.statusCode == 400) {
				alert(dataResult.message);
			}
		}
	});
	e.preventDefault();
});


$(document).on('click', '.update', function (e) {
	var mid = $(this).attr("data-module_id_u");
	var name = $(this).attr("data-modulename_u");
	var duration = $(this).attr("data-moduleduration_u");
	var desc = $(this).attr("data-moduledesc_u");
	var primaryFaculty = $(this).attr("data-primaryFaculty_u");
	var secondaryFaculty = $(this).attr("data-secondaryFaculty_u");
	var tertiaryFaculty = $(this).attr("data-tertiaryFaculty_u");
	var assessment = $(this).attr("data-assessmentcb_u");

	$('#module_id_u').val(mid);
	$('#modulename_u').val(name);
	$('#moduleduration_u').val(duration);
	$('#moduledesc_u').val(desc);
	$('#primaryFaculty_u').val(primaryFaculty);
	$('#secondaryFaculty_u').val(secondaryFaculty);
	$('#tertiaryFaculty_u').val(tertiaryFaculty);
	$('#assessmentcb_u').val(assessment);
	$('#assessmentcb_u').prop('checked', assessment == 'Yes');

	if (assessment == 'Yes') {
		$('#assessmentcb_u').prop('checked', true);
	} else {
		$('#assessmentcb_u').prop('checked', false);
	}

});

//Update request
$(document).on('click', '#update', function (e) {
	var data = $("#update_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "pages/insertandmanage/backend/module_list_backend.php",
		success: function (dataResult) {
			var dataResult = JSON.parse(dataResult);
			if (dataResult.statusCode == 200) {
				$('#editEmployeeModal').modal('hide');
				alert('Data updated successfully !');
				location.reload();
			}
			else if (dataResult.statusCode == 400) {
				alert(dataResult.message);
			}
		}
	});
});
$(document).on("click", ".delete", function () {
	var id = $(this).attr("data-module_id_d");
	$('#id_d').val(id);
});
$(document).on("click", "#delete", function () {
	$.ajax({
		url: "pages/insertandmanage/backend/module_list_backend.php",
		type: "POST",
		cache: false,
		data: {
			type: 3,
			id: $("#id_d").val()
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
				url: "pages/insertandmanage/backend/module_list_backend.php",
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
$(document).ready(function () {
	// Event handler for "Add Session Plans" button
	$('.add-session').click(function () {
		const courseID = $(this).data('courseid');
		$('#course_id_s').val(courseID); // Set the course ID in the modal form
	});

	// Event handler for session plans form submission
	$('#session_plans_form').submit(function (e) {
		e.preventDefault();

		const formData = new FormData(this);

		$.ajax({
			url: "pages/insertandmanage/backend/module_list_backend.php", // Update with the actual path to your PHP upload endpoint
			method: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function (data) {
				// Handle success [showing a success message, etc.]
				console.log(data);
				$('#addSessionPlansModal').modal('hide');
			},
			error: function (err) {
				// Handle the error appropriately
				console.error("Error uploading the session plans:", err);
			}
		});
	});
});

$(document).on('click', '.view-session', function () {
	var courseId = $(this).data('courseid');
	$.ajax({
		url: 'pages/insertandmanage/backend/module_list_backend.php"',
		method: 'GET',
		data: { course_id: courseId },
		success: function (data) {
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
// Event handler for "View Session Plans" button
$(document).on('click', '.view-contacts', function () {
	var moduleId = $(this).data('moduleid');

	$.ajax({
		url: 'pages/insertandmanage/backend/fetch_session_plans.php', // Updated PHP script path
		method: 'GET', // Change method to POST
		data: { moduleID: moduleId },
		dataType: 'json', // Expect JSON response
		success: function (data) {
			var output = '';

			if (data.length > 0) {
				for (var i = 0; i < data.length; i++) {
					output += '<tr>';
					output += '<td>' + data[i].fileName + '</td>';
					output += '<td><a href="pages/insertandmanage/backend/' + data[i].filePath + '" target="_blank">View</a></td>';
					output += '<td>' + data[i].date + '</td>';
					output += '</tr>';
				}
			} else {
				output = '<tr><td colspan="3">No session plans available</td></tr>';
			}

			$('#session-plans-table tbody').html(output);
			$('#session-name-display').text(moduleId);
			$('#viewSessionPlansModal').modal('show');
		},
		error: function (err) {
			// Handle the error appropriately
			console.error("Error fetching session plans:", err);
		}
	});
});



// Add this in your existing JavaScript code
$(document).ready(function () {
	// Other existing code...

	// // Submit the form using AJAX for file upload
	// $('#session_plans_form').submit(function(e) {
	//     e.preventDefault();

	//     $.ajax({
	//         url: 'path/to/upload_session_plans.php', // Replace with your server-side script
	//         type: 'POST',
	//         data: new FormData(this),
	//         contentType: false,
	//         cache: false,
	//         processData: false,
	//         success: function(response) {
	//             // Handle the response if needed
	//             console.log(response);

	//             // Update the uploaded files display
	//             updateUploadedFiles();
	//         },
	//         error: function(error) {
	//             console.error('Error uploading session plans:', error);
	//         }
	//     });
	// });

	// Function to update the display of uploaded files
	function updateUploadedFiles() {
		// Get the uploaded files and update the display
		$.ajax({
			url: 'path/to/get_uploaded_files.php', // Replace with your server-side script to get file names and details
			type: 'GET',
			success: function (response) {
				// Update the uploaded files display area
				$('.uploaded-files').html(response);
			},
			error: function (error) {
				console.error('Error getting uploaded files:', error);
			}
		});
	}

	// Initial update of uploaded files on document ready
	updateUploadedFiles();

	// Other existing code...
});




