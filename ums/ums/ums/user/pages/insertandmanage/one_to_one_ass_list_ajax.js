$(document).on('click','#btn-add',function(e) {
    var data = $("#user_form").serialize();
    $.ajax({
        data: data,
        type: "POST",
        url: "pages/insertandmanage/backend/one_to_one_ass_list_backend.php",
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

$(document).on('click','.update',function(e) {
    var company=$(this).attr("data-company_u");
    var batch=$(this).attr("data-batch_u");
    var stuname=$(this).attr("data-StudentName_u");  
    var comments=$(this).attr("data-comments_u");
    var yesno=$(this).attr("data-yes/no_u");
    var date=$(this).attr("data-date_u");
    
    
    $('#course_id_u').val(company);
    $('#company_u').val(batch);
    $('#batch_u').val(stuname);
    $('#StudentName_u').val(comments);
    $('#comments_u').val(yesno);
    $('#yes/no_u').val(date);
    $('#date_u').val(date);
});

$(document).on('click','#update',function(e) {
    var data = $("#update_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "pages/insertandmanage/backend/one_to_one_ass_list_backend.php",
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
        url: "pages/insertandmanage/backend/one_to_one_ass_list_backend.php",
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
                url: "pages/insertandmanage/backend/one_to_one_ass_list_backend.php",
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
