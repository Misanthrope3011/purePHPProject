function delete_data(id) {
    $.ajax({
        type : "post",
        url: "ajax/delete.php",
        data: {'id': id},
        success: function(response) {
            location.reload();
        },
        error: function(request, status, error){
            alert(error);
          }
    })
}

/*
function edit_data(id) {
    $.ajax({
        type : "post",
        url: "create.php", 
        data: {'id': id},
        success: function(response) {
        },
        error: function(request, status, error){
            alert("Nie można usunąć");
          }
    })
}
*/
