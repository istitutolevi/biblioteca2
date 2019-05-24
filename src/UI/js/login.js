$(document).ready(
  function(){
    $("#ricercamenu").show();
    $("#editmenu").hide();
    $("main").html("<div id=\"content\"></div>");
    var utente;
    var logged = false;
    console.log(localStorage);
    if (localStorage.getItem("token") !== null) {
      $("#usernametext").html("Benvenuto, " + localStorage.getItem('username'));
      $("#username").remove();
      $("#password").remove();
      logged = true;
      $.ajax(
        {
          type:"GET",
          url:"../WebApi/OAuth2/Resource.php",
          data: {token: localStorage.getItem("token")},
          dataType: "json",
          success: function(user){
            utente = user;
            switch (utente.LivelloUtente) {
              case "0":
              $("#ricercamenu").show();
              $("#editmenu").show();
              break;

              case "1":
              $("#ricercamenu").show();
              $("#editmenu").hide();
              break;

              default:
              break;
            }
          }
        }
      );
      console.log(localStorage.getItem("token"));
    }


    $(".fa-user").click(
      function(){
        if (logged == false) {
          logged = true;
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
              $("#usernamec").html("");
              $("#passwordc").html("");
              $("main").html("<div id=\"content\"></div>");
              $.ajax(
                {
                  type:"GET",
                  url:"../WebApi/OAuth2/Resource.php",
                  data: {token: token},
                  dataType: "json",
                  success: function(user){
                    utente = user;
                    switch (utente.LivelloUtente) {
                      case "0":
                      $("#ricercamenu").show();
                      $("#editmenu").show();
                      break;

                      case "1":
                      $("#ricercamenu").show();
                      $("#editmenu").hide();
                      break;

                      default:
                      break;
                    }
                  }
                }
              );
            },
            error: function(ris){
              var error = ris.responseJSON.error_description;
              console.log(error);
            }
          });
        }
        else {
          utente = null;
          $("#ricercamenu").show();
          $("#editmenu").hide();
          $("main").html("<div id=\"content\"></div>");
          logged = false;
          localStorage.clear();
          $("#usernametext").html("");
          $("#usernamec").html("<input type=\"text\" id=\"username\" placeholder=\"username\"></input>");
          $("#passwordc").html("<input type=\"password\" id=\"password\" placeholder=\"password\"></input>");
        }
      }
    );

  }
);
