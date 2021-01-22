function retrieveImages() {
   return JSON.parse(sessionStorage.getItem('currentLoadedImages'));
}

function displayImages(galeryList) { 
    for (var i = 0; i < galeryList.length; i++) {
        $(".container").append('<img src="galeria_zdjecia/'+ galeryList[i] +'" alt="zdjecie"> </img> <button class="deleteImage"> x </delete>');
    }
}

$(document).ready(function()
{
   
    var galeryList = null;
    if(retrieveImages() != null) {      
        $(".container").empty(); 
        galeryList = retrieveImages();
        displayImages(galeryList);
    } else {
        galeryList = [];
    }

    $(".container").on('click', '.deleteImage', function() {
        galeryList = retrieveImages();
        var index = $(".deleteImage").index(this);
        galeryList.splice(index, 1);
        sessionStorage.setItem('currentLoadedImages',JSON.stringify(galeryList));
        $(".container").empty();
        displayImages(retrieveImages());
    }); 
    
   var filesInput = $("#image");
 


    if(sessionStorage.getItem('currentLoadedImages' !== null)) {
        var files = retrieveImages();
        $("#show").append('<img src="galeria_zdjecia/'+ files[i] +'" alt="zdjecie"> </img> <button id = "delete" class="delete"> x </delete>');
    }
    


    filesInput.on("change", function(e) {

        $(".container").empty();
        var files = e.target.files;
        if (files.length > 0) {
            for (var i = 0; i < files.length; i++) {
                $(".container").append('<img src="galeria_zdjecia/'+ files[i].name +'" alt="zdjecie"> </img> <button id = "delete" class="delete"> x </delete>');
                galeryList.push(files[i].name);
                console.log(i + " " + files[i].name);
            }
            sessionStorage.setItem('currentLoadedImages', JSON.stringify(galeryList));
            $(".container").empty();
            displayImages(galeryList);

    }
    });

    $(window).on('popstate', function() {
        sessionStorage.removeItem('currentLoadedImages');
    });

    $("#createNew").click(function () {
        var serializedData = retrieveImages();
        var titleOfGalery = $("#titleForGalery").val();
        sessionStorage.removeItem('currentLoadedImages');  
     
        $.ajax({
            type: "POST",
            url: "ajax/insertion.php",         
            data:{images: serializedData,
                titleOfGalery: titleOfGalery},
            success: function(data) {
                location.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
            }      
         });
        
    });

});

