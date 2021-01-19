
function createPopup(title, bodyText) {
  $(".modal-title").text(title);
  $(".modal-body").text(bodyText);
  $('#myModal').modal('show');
}

/*
function invalid ()
{
    window.open("rejestracja.html");
}

$(document).ready(function()
{

    $('#myModal').modal('hide');

    var getPage;
    var userList=JSON.parse(localStorage.getItem('dataUser'));
    var currentUser=JSON.parse(sessionStorage.getItem('currentUser'));

    if(currentUser != null)
    $("#userDisplayData").append((currentUser.name + "  " + currentUser.age + '<br/>' + '<button id="logOut"> Wyloguj </button> '  ));

  /*  function displayList()
    { 
        $("#articleContainer").empty();

        for (var i = temp; i < temp + numberOfItemsOnPage && i < (retrieveItem.length); i++)
        {
          $("#articleContainer").append(' <div class="post"><h3>'+ retrieveItem[i].title +' </h3>    <b> ' + retrieveItem[i].intro + '</b> <br/> <div id="imageGrid"> '+ retrieveItem[i].content +'   <img src="' + retrieveItem[i].image + '" alt="header">   </div>   <button class="delete"> x </button> <button class="edit"> E </button>    </div>  ');   
        }
   
    }
   
    
    if(sessionStorage.getItem('pageNumber')===null)
    { 
        getPage = 0;  
  }
     else
    {  
    getPage = parseInt(sessionStorage.getItem('pageNumber'));
    }

    var numberOfItemsOnPage=4;
    var replaceContent,numberOfPages;
    var retrieveItem = JSON.parse(localStorage.getItem('article'));

    var indexOfEdited = sessionStorage.getItem('indexOfEdited');
    var temp=getPage * numberOfItemsOnPage;


    if(indexOfEdited!=null)
    {
            $("#setTitle").prop("value", (retrieveItem[parseInt(parseInt(indexOfEdited) + parseInt(temp))].title));
            $('#articleIntro').prop("value", (retrieveItem[parseInt(parseInt(indexOfEdited) + parseInt(temp))].intro));
            $('#articleContent').prop("value", (retrieveItem[parseInt(parseInt(indexOfEdited) + parseInt(temp)) ].content));
            $('#image').prop("placeholder", (retrieveItem[parseInt(parseInt(indexOfEdited) + parseInt(temp))].image) );
            $("#sendArticle2").text("edytuj");
    }   

    if(retrieveItem===null)
    retrieveItem=[];

    var deleteIndex;
    

        for(var i = 1; (i< retrieveItem.length / (numberOfItemsOnPage + 1));i++)
        {
            $("#link").append('<a href="index.php?page='+ i + '" alt="strona">' + i +'</a>' );
        }
    
    $(".post").css("background-color", "white"); 

  

        displayList();
    
    
     numberOfPages=Math.ceil(retrieveItem.length%2);

     $('#articleContainer').on('click', '.delete', function()
     {   
      var temp=($(".delete").index(this));
      retrieveItem.splice(temp,1);
      localStorage.setItem('article', JSON.stringify(retrieveItem));

      displayList();
      
    });

    $('#userDisplayData').on('click', '#logOut', function()
    {   
     sessionStorage.removeItem('currentUser');
    location.reload();
   });

    $('#articleContainer').on('click', '.edit', function()
     {      
   
    sessionStorage.setItem('indexOfEdited', ($(".edit").index(this)));
    $(location).prop('href', 'create.html');
    });
     
    $('#link').on('click', 'a', function(e)
    {   
     getPage=($(this).closest("a").index());
     JSON.stringify(sessionStorage.setItem('pageNumber', getPage));
    });      $("#btn1").click(function(){
        $("h2").hide();
    });

    function displaySuccessModal() {}
    

$("#formSubmit").click(function(e)
{

if($("form[name='validate']").valid())
{
        user.email=$("#exampleInputEmail1").val();
        user.name=$("#nameAndSurname").val();
        user.age=$("#ageInputId").val();
        user.password=$("#exampleInputPassword1").val();
        user.hobby="";

        var unique=true;

        if($("#exampleCheck1").is(":checked"))
        {
         
           user.hobby+=$("#exampleCheck1").val() + " ";
        }
        if($("#exampleCheck2").is(":checked"))
        {
           user.hobby+=$("#exampleCheck2").val()  + " ";
        }
        if($("#exampleCheck3").is(":checked"))
        {
           user.hobby+=$("#exampleCheck3").val() + " ";
        }

        if (userList===null)
        userList=[];

        userList.unshift(user);
        localStorage.setItem('dataUser',JSON.stringify(userList));   
      }
      else
        e.preventDefault();
 
    });

   

    $("#sendArticle2").click(function(e)
    {
        retrieveItem = JSON.parse(localStorage.getItem('article'));

        var article={};
  
     
        if(indexOfEdited!=null)
        {
            retrieveItem[parseInt(parseInt(indexOfEdited) + parseInt(temp))].title=$('#setTitle').val();
            retrieveItem[parseInt(parseInt(indexOfEdited) + parseInt(temp))].intro=$('#articleIntro').val();
            retrieveItem[parseInt(parseInt(indexOfEdited) + parseInt(temp))].content=$('#articleContent').val();
         
           if($("#image").val()!="")
            {
            retrieveItem[parseInt(parseInt(indexOfEdited) + parseInt(temp))].image="photos/"+$("#image").prop('files')[0].name ;
            }
          sessionStorage.removeItem('indexOfEdited');
        }
        else
        {
            article.title = $('#setTitle').val();
            article.intro= $("#articleIntro").val();
            article.content=$('#articleContent').val();
            article.image="photos/" + $("#image").prop('files')[0].name;
        
            retrieveItem.push(article); 
        }
        
        localStorage.setItem('article', JSON.stringify(retrieveItem));   
        $(location).attr('href', 'index.html');

    });

    var user={};

   $("#logIn").click(function(e)
    {
        e.preventDefault();
        var tempName = $("#username").val();
        var tempPassword = $("#password").val();
        
      $.each(userList,function(i)
        {   
            if(tempName == userList[i].name && tempPassword == userList[i].password)
               { 
                sessionStorage.setItem('currentUser',JSON.stringify(userList[i]));
                return false;
               }

        });

        if(JSON.parse(sessionStorage.getItem('currentUser')===null))
       {
        $("#password, #username").css("border-color", "red");
        $(".modal-body").text( "Blędne dane lub użytkownik nie istnieje");
        $(".modal-footer .btn").addClass('btn-danger').removeClass('.btn btn-secondary, .btn btn-success');
       }
       else
       {
        $("#password, #username").css("border-color", "greenyelow");
        $(".modal-body").text( "Zalogowano pomyślnie");
        $(".modal-footer .btn").addClass('.btn-success').removeClass('.btn btn-secondary, .btn btn-danger');
       }

    $('#myModal').modal('show');


      });   
    */
  
    /*
    $(document).on('click','#editAddArticleButton',function(){
        $this.val("hide"); //OR  $this.val("Hide") //if you are using input type="button"
    });
});
*/




