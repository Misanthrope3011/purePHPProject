$(document).ready(function()
{

  jQuery.validator.addMethod('correctCode', function(value,element)
  {
    return this.optional(element) || /([A-Z0-9]{2}-?){3}[A-Z0-9]{2}/.test(value);
  });
  

  jQuery.validator.addMethod('isUniqueEmail', function (value, element) {
  
    if(userList!=null)
   { 
    $.each(userList, function(i)
    {
      if(userList[i].email==$("#exampleInputEmail1").val())
      {
      value=0;
      return false;
      }
    });

  }
  return value!=0;
    }, 'Już istnieje użytkownik o takim email ');
      
    $("form[name='validate']").validate({   

      
      errorClass: "errorTrigger",
      validClass: "correctValue",

      highlight: function(element, errorClass, validClass) {
        $(element).addClass('errorTrigger').removeClass('correctValue');
        $(element).css("border-color","red");
     
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('errorTrigger').addClass('correctValue');
        $(element).css("border-color","green");
      },

      rules: {
        nameAndSurname:{
         minlength: 6,
         maxlength:20,
         required:true,
         pattern: "^[A-Za-z][A-Za-z0-9_!#$@#]{6,14}$",
         isUniqueUser: true 
      },
      acceptPolicy:
      {
        required:true
      },
        email: {
          isUniqueEmail: true,
          required: true,
          email: true,
        },
        code:
        {
        correctCode:true
        },
        password: {
          required: true,
          minlength: 6,
          maxlength:20,
          pattern: "^(?=.*?[A-Z])[a-zA-Z0-9]{6,20}$"
        }
      },
      
      // Specify validation error messages
      messages: {
        password: {
          required: "Hasło jest wymagane",
          minlength: "Hasło musi zawierac od 6 do 20 znakow",
          pattern: " Haslo moze sie skladac tylko z liter I cyfr oraz musi zawierać dużą literę"
        },
        code:
        {
          correctCode: "kod weryfikacyjny jest nieprawidłowy"
        },
        email: 
       {
        email: "Email jest nieprawidłowy",
        isUniqueEmail: "Email juz zapisany w bazie"
      },
        acceptPolicy: "Regulamin musi być zaakceptowany",
        nameAndSurname:
        {
         ifUniqueUser: "Nickname już istnieje",
          required:" To wymagane pole",
          pattern:"Nick musi zaczynac się od litery i może zawierac tylko _!#$@# znaki specjalne"
        }

      },

      invalidHandler: function(event, validator) {
        var errors = validator.numberOfInvalids();
        if (errors) {
          var message = errors == 1
            ? 'You missed 1 field. It has been highlighted'
            : 'You missed ' + errors + ' fields. They have been highlighted';
          
    //    $("#registerForm input:blank" ).css( "border-color", "red" );   
          $(".form-control.errorTrigger").css("border-color","red");
          $("div.error span").html(message);
          $("div.error").show();
        } else {
          $("div.error").hide();
        }
      },

      submitHandler: function(form) {
        form.submit();
      }
    });
});