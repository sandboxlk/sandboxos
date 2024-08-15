//$(document).on('click','#btn-add',function(e) {

//var data = $("#user_form").serialize();
//$.ajax({
//data: data,
//type: "POST",
//url: "pages/insertandmanage/backend/Faculty_capacity_list_backend.php",

//success: function(dataResult){
//alert(dataResult);//sql error
//var dataResult = JSON.parse(dataResult);
//if(dataResult.statusCode==200){
//$('#addEmployeeModal').modal('hide');
//alert('Data added successfully !');
//location.reload();
//}
//if(dataResult.statusCode==400){
//   alert(dataResult.message);
//}
//}
//});
//e.preventDefault();
//});

$(document).ready(function () {
  // Populate the modal with the data from the clicked row
  $(document).on("click", ".update", function (e) {
    var id = $(this).attr("data-id");
    var name = $(this).attr("data-name");
    var type1 = $(this).attr("data-type1");
    var year = $(this).attr("data-year");
    var monday = $(this).attr("data-monday");
    var tuesday = $(this).attr("data-tuesday");
    var wednesday = $(this).attr("data-wednesday");
    var thursday = $(this).attr("data-thursday");
    var friday = $(this).attr("data-friday");
    var saturday = $(this).attr("data-saturday");
    var sunday = $(this).attr("data-sunday");
    var daysPerMonth = $(this).attr("data-dayspermonth");
    var total = $(this).attr("data-total_avalability");
    var capacity = $(this).attr("data-capacity");

    // Log data to ensure correct values are being assigned
    console.log("ID: ", id);
    console.log("Name: ", name);
    console.log("Type1: ", type1);
    console.log("Year: ", year);
    // Log other variables similarly...

    // Assign values to the form inputs
    $("#capacity_id").val(id);
    $("#name_u").val(name);
    $("#type1_u").val(type1);
    $("#year_u").val(year);
    $("#Monday").val(monday);
    $("#Tuesday").val(tuesday);
    $("#Wednesday").val(wednesday);
    $("#Thursday").val(thursday);
    $("#Friday").val(friday);
    $("#Saturday").val(saturday);
    $("#Sunday").val(sunday);
    $("#daysPerMonth_u").val(daysPerMonth);
    $("#total_u").val(total);
    $("#Capacity_u").val(capacity);

    // Show the modal
    $("#editEmployeeModal").modal("show");
  });

  // Handle the update action via AJAX
  $(document).on("click", "#update", function (e) {
    e.preventDefault(); // Prevent the default form submission
    var data = $("#update_form").serialize(); // Serialize the form data

    console.log(data); // Log the serialized data to ensure correct data is being sent

    $.ajax({
      url: "pages/insertandmanage/backend/Faculty_capacity_list_backend.php",
      type: "POST",
      data: data,
      success: function (response) {
        var responseData = JSON.parse(response);
        if (responseData.statusCode == 200) {
          alert("Data updated successfully!");
          location.reload();
        } else {
          alert("Failed to update data. " + (responseData.error || ""));
          console.error(responseData.error);
        }
      },
      error: function (xhr, status, error) {
        alert("An error occurred: " + error);
        console.log(xhr.responseText);
      },
    });
  });
});

$(document).on("click", ".delete", function (e) {
  var id = $(this).attr("data-id");
  if (confirm("Are you sure you want to delete this record?")) {
    $.ajax({
      url: "pages/insertandmanage/backend/Faculty_capacity_list_backend.php",
      type: "POST",
      data: { type: 3, facultyid: id },
      success: function (response) {
        var responseData = JSON.parse(response);
        if (responseData.statusCode == 200) {
          alert("Data deleted successfully!");
          location.reload();
        } else {
          alert("Failed to delete data.");
        }
      },
      error: function (xhr, status, error) {
        alert("An error occurred: " + error);
        console.log(xhr.responseText);
      },
    });
  }
});
