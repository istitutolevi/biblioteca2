$(document).ready(
  function(){

    if (localStorage.getItem("token") !== null) {
      $("#usernametext").html("Benvenuto, " + localStorage.getItem('username'));
      $("#username").remove();
      $("#password").remove();
      console.log(localStorage.getItem("token"));
    }


    $(".fa-user").click(
      function(){
        var user = $("#username").val();
        var pass = $("#password").val();

        $.ajax({
          type:"POST",
          url:"../WebApi/OAuth2/Token.php",
          data: {"grant_type":"client_credentials","client_id":user,"client_secret":pass},
          dataType: "json",
          success: function(ris) {
            var token = ris.access_token;
            console.log(token);
            localStorage.setItem('token', token);
            localStorage.setItem('username', $("#username").val());
            console.log(localStorage);
            var username = $("#username").val();
            $("#usernametext").html("Benvenuto, " + username);
            $("#username").remove();
            $("#password").remove();
          },
          error: function(ris){
            var error = ris.responseJSON.error_description;
            console.log(error);
          }
        });

      }
    );

  }
);
