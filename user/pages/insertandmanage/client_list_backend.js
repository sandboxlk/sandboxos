$(document).on('submit', '#contact_form', function(e) {
    e.preventDefault(); // Prevent the default form submission
    
    var data = $(this).serialize();
    
    $.ajax({
        type: "POST",
        url: "pages/insertandmanage/backend/client_contact_backend.php",
        data: data,
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#addContactModal').modal('hide');
                alert('Contact added!');
                // Optionally, update the contacts table using JavaScript here
            } else if (dataResult.statusCode == 400) {
                alert(dataResult.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    }); 
});


// VIEW CONTACTS
$(document).on('click', '.view-contacts', function() {
    var clientID = $(this).data('clientid');
    var clientName = $(this).data('clientname');
    $('#client-name-display').text(clientName);
    
    // Fetch contacts for this client
    $.ajax({
        url: 'pages/insertandmanage/backend/client_contacts_backend.php',
        type: 'post',
        data: { client_id: clientID },
        dataType: 'json',
        success: function(response){
            // Populate the contacts table
            var contactsTable = $("#contacts-table tbody");
            contactsTable.empty(); // Clear previous data
            
            if(response.length > 0) {
                response.forEach(function(contact){
                    var row = `<tr>
                                <td>${contact.contactName}</td>
                                <td>${contact.contactDesignation}</td>
                                <td>${contact.contactNumber}</td>
                                <td>${contact.contactEmail}</td>
                               </tr>`;
                    contactsTable.append(row);
                });
            } else {
                // If no contacts, display a message
                var emptyRow = `<tr>
                                  <td colspan="4">No contacts available for this client.</td>
                               </tr>`;
                contactsTable.append(emptyRow);
            }
            
            // Show the modal
            $("#viewContactsModal").modal("show");
        }
    });
});








