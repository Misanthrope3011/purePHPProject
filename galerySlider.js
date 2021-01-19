function retrieveImages() {
   return JSON.parse(sessionStorage.getItem('currentLoadedImages'));
}

function displayImages(imageStorage) { 
    for (var i = 0; i < imageStorage.length; i++) {
        $(".container").append('<img src="galeria_zdjecia/'+ imageStorage[i] +'" alt="zdjecie"> </img> <button class="deleteImage"> x </delete>');
    }
}

$(document).ready(function()
{
    var imageStorage = null;
    if(retrieveImages() != null) {        
        imageStorage = retrieveImages();
        displayImages(imageStorage);
    }

    $(".container").on('click', '.deleteImage', function() {
        imageStorage = retrieveImages();
        var index = $(".deleteImage").index(this);
        imageStorage.splice(index, 1);
        sessionStorage.setItem('currentLoadedImages',JSON.stringify(imageStorage));
        $(".container").empty();
        displayImages(retrieveImages());
    }); 
    
   var galeryList=JSON.parse(localStorage.getItem('galeryItem'));
   var filesInput = $("#image");
 
   /* 
   if(galeryList===null)
    galeryList=[];
    else

    for (var i=0; i<galeryList.length;i++)
    { 
        $(".galeria").append( ('<div class="inner"> <a href="galeriaSlider.html" alt="galeria"> <img src="'+ listOfImages[galeryList[i].currentIndex-1]+'" alt="zdjecie"> </a> <button class="delete"> X </button> <h3>' + galeryList[i].title +'</h3> </div>'));
    }
*/
   

    if(sessionStorage.getItem('currentLoadedImages' !== null)) {
        var files = retrieveImages();
        $("#show").append('<img src="galeria_zdjecia/'+ files[i] +'" alt="zdjecie"> </img> <button id = "delete" class="delete"> x </delete>');
    }
    
    var galeryList;
    if (retrieveImages() === null) {
        galeryList = [];
    } else {
        galeryList = retrieveImages();
    }

    filesInput.on("change", function(e) {
        
        $(".container").empty();
        var files = e.target.files;

        if (files.length > 0) {
            for (var i = 0; i < files.length; i++) {
                $(".container").append('<img src="galeria_zdjecia/'+ files[i].name +'" alt="zdjecie"> </img> <button id = "delete" class="delete"> x </delete>');
                galeryList.push(files[i].name);
            }
            sessionStorage.setItem('currentLoadedImages', JSON.stringify(galeryList));
            $(".container").empty();
            displayImages(galeryList);

    }
/*
         $.ajax({
            type : "post",
            url: "sample.php",
            data: {'files': files},
            success: function(response) {
            },
            error: function(request, status, error){
                alert("Nie można usunąć");
                }
            })
  */      
    });

/*    $('.galeria').on('click', '.delete', function()
    {
        for (var i=galeryList.length;i>$(".delete").index(this);i--)
        {
            galeryList[i+1]=galeryList[i];
        }

        listOfImages.splice(galeryList[$(".delete").index(this)].currentIndex-galeryList[$(".delete").index(this)].numberOfImagesInGalery, galeryList[$(".delete").index(this)].numberOfImagesInGalery);
        galeryList.splice(galeryList[0] , 1); 
        localStorage.setItem('galeryItem',JSON.stringify(galeryList));
        localStorage.setItem('images',JSON.stringify(listOfImages));
    });
*/
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
               alert(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }      
         });
        
    });
    

       /* $('.galeria').on('click', '.inner', function()
        {   
        
        }   
        */
   /*  
   if(listOfImages.length!=0)
    {
            if(getIndex!=0)
            {
                alert(galeryList[0].currentIndex + "    "+ galeryList[1].currentIndex);

             for (var i = galeryList[getIndex-1].currentIndex; i < galeryList[getIndex].currentIndex;i++)
                {
                    $("ul#galery").append('<li> <div class="content"> <img src='+listOfImages[i]+'> <h2> Zdjęcie'+((i%5)+1) +'</h2></div></li>');
                }
            }
            else
            {
                for (var i = 0; i < galeryList[0].currentIndex; i++)
                {            
                    $("ul#galery").append('<li> <div class="content"> <img src='+ listOfImages[i]+'> <h2> Zdjęcie'+((i%5)+1) +'</h2></div></li>');
                }
            }
    }
    */
});

