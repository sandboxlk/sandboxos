//$(document).on('click','#btn-add',function(e) {
//	var data = $("#user_form").serialize();
//	$.ajax({
//		data: data,
//		type: "POST",
//		url: "pages/insertandmanage/backend/Faculty_PI_list_backend.php",
//		success: function(dataResult){
//			var dataResult = JSON.parse(dataResult);
//			if(dataResult.statusCode==200){
//				$('#addEmployeeModal').modal('hide');
//				alert('Company added!'); 
//				location.reload();						
//			}
//			if(dataResult.statusCode==400){
///				alert(dataResult.message);
	//		    //alert('Please Select No Series.');
	//		}
	//	}, 
		
	//});
//});

$(document).on('click', '#btn-add', function (e) {
    var data = $("#user_form").serialize();
    $.ajax({
        data: data,
        type: "POST",
        url: "pages/insertandmanage/backend/Faculty_PI_list_backend.php",
        success: function (dataResult) {
            console.log('Server Response:', dataResult);
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#addEmployeeModal').modal('hide');
                alert('Faculty added successfully!');
                loadAndDisplayData();
            } else if (dataResult.statusCode == 400) {
                alert(dataResult.message);
            }
        },
        error: function (xhr, status, error) {
            console.log('Error:', status, error);
            alert('Error during the AJAX request.');
        }
    });
});

$(document).on('click', '#update', function (e) {
    var data = $("#update_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "pages/insertandmanage/backend/Faculty_PI_list_backend.php",
        success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#editEmployeeModal').modal('hide');
                alert('Faculty updated!');
                location.reload();
            } else if (dataResult.statusCode == 400) {
                alert(dataResult.message);
            }
        },
        error: function (xhr, status, error) {
            console.log('Error:', status, error);
            alert('Error during the AJAX request.');
        }
    });
});+


    
// Automatic calculation of total days
$(document).on('change', '#daysPerMonth', function () {
    var daysPerMonth = $(this).val();
    $.ajax({
        url: "pages/insertandmanage/backend/Faculty_PI_list_backend.php",
        type: 'post',
        data: { 'daysPerMonth': daysPerMonth },
        success: function (response) {
            // Assuming the response is the calculated totalDays
            console.log('Total Days per Year:', response);
            // You can update the totalDays field in your form here
        }
    });
});

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
	var expertiseArea1=$(this).attr("data-faculty_level1");
	var expertiseArea2=$(this).attr("data-faculty_level2");
	var expertiseArea3=$(this).attr("data-faculty_level3");
	var expertiseArea4=$(this).attr("data-faculty_level4");

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
	$('#faculty_level1_u').val(expertiseArea1);
	$('#faculty_level2_u').val(expertiseArea2);
	$('#faculty_level3_u').val(expertiseArea3);
	$('#faculty_level4_u').val(expertiseArea4);
	

	// Manually trigger the modal
	$('#editEmployeeModal').modal('show');
});

$(document).on('click','#update',function(e) {
	var data = $("#update_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "pages/insertandmanage/backend/Faculty_PI_list_backend.php",
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

	$('#deleteEmployeeModal').modal('show');

	
});
$(document).on("click", "#delete", function() { 
	$.ajax({
		url: "pages/insertandmanage/backend/Faculty_PI_list_backend.php",
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
				url: "pages/insertandmanage/backend/Faculty_PI_list_backend.php",
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

// ADD CONTACT
//$(document).on('click', '#btn-add-contact', function(e) {
   // var data = $("#contact_form").serialize();
    //$.ajax({
       // data: data,
       // type: "POST",
       // url: "pages/insertandmanage/backend/client_contact_backend.php", // assuming this is your backend file to add new contact
        //success: function(dataResult){
           // var dataResult = JSON.parse(dataResult);
            //if(dataResult.statusCode == 200){
                //$('#addContactModal').modal('hide');
                //alert('Contact added successfully!');
                //location.reload();
           // } else if (dataResult.statusCode == 400){
               // alert(dataResult.message);
           // }
      // }
    //});
//});

// POPULATING COMPANY NAME FOR ADD CONTACT MODAL
//$(document).on('click', 'a[data-toggle="modal"]', function() {
    //var clientID = $(this).data('clientid');
    //var clientName = $(this).data('clientname');
    //$('#company_id').val(clientID);
    //$('#companyName').text(clientName);
//});

// VIEW CONTACTS
//$(document).on('click', '.view-contacts', function() {
    //var clientID = $(this).data('clientid');
    //var clientName = $(this).data('clientname');
    //$('#client-name-display').text(clientName);
    
    // Fetch contacts for this client
    //$.ajax({
        //url: 'pages/insertandmanage/backend/client_contacts_backend.php', // your backend file to fetch contacts for a client
        //type: 'post',
        //data: { client_id: clientID },
        //dataType: 'json',
        //success: function(response){
            // Populate the contacts table
            //var contactsTable = $("#contacts-table tbody");
            //contactsTable.empty(); // Clear previous data
            //response.forEach(function(contact){
                //var row = `<tr>
                            //<td>${contact.name}</td>
                            //<td>${contact.contact_no}</td>
                            //<td>${contact.email}</td>
                           //</tr>`;
                //contactsTable.append(row);
           //});
       // }
    //});
//});

