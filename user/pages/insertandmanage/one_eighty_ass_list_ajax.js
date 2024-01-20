$(document).on('click','#btn-add',function(e) {
    var data = $("#user_form").serialize();
    $.ajax({
        data: data,
        type: "POST",
        url: "pages/insertandmanage/backend/assessment_list_backend.php",
        success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){
                $('#addEmployeeModal').modal('hide');
                alert('Data added successfully !'); 
                location.reload();                        
            }
            else if(dataResult.statusCode==400){
               alert(dataResult.message);
            }
        }
    });
    e.preventDefault(); 
});

$(document).ready(function() {
    if (!Modernizr.inputtypes.date) {
        $('input[type=date]').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    }
});


$(document).on('click','.update',function(e) {
    var aid=$(this).attr("data-AssessmentID_u");
    var an=$(this).attr("data-AssessmentName_u");
    var at=$(this).attr("data-AssessmentType_u");
    
    $('#course_id_u').val(aid);
    $('#coursename_u').val(an);
    $('#assessmentType_u').val(at);
});

$(document).on('click','#update',function(e) {
    var data = $("#update_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "pages/insertandmanage/backend/assessment_list_backend.php",
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
    var id=$(this).attr("data-Assessment_id_d");
    $('#id_d').val(id);
});

$(document).on("click", "#delete", function() { 
    $.ajax({
        url: "pages/insertandmanage/backend/assessment_list_backend.php",
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
            $.ajax({
                type: "POST",
                url: "pages/insertandmanage/backend/assessment_list_backend.php",
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
