function delete_data(id) {
    $.ajax({
        type : "post",
        url: "ajax/delete.php",
        data: {'id': id},
        success: function(response) {
        
        },
        error: function(request, status, error){
         
          }
    })
}

function delete_galery(id) {
   
    $.ajax({
        type : "post",
        url: "ajax/delete.php",
        data: {'galeryID': id},
        success: function(response) {
            location.reload();
        },
        error: function(request, status, error){
            alert(error);
          }
    })
}
function delete_comment(id) {
   
    $.ajax({
        type : "post",
        url: "ajax/delete.php",
        data: {'commentID': id},
        success: function(response) {
    
        },
        error: function(request, status, error){
            alert(error);
          }
    })
}

