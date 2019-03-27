$(document).ready(
  function(){

    $("#iAutore").keyup(
      function(){
        var val = $("#iAutore").val();

        if (val != "") {
          $.ajax(
            {
              type:"GET",
              url:"../api/Autori/AutoComplete/?text=" + encodeURI(val),
              dataType:"json",
              success: function(data){
                $("#Autore").html("");
                for(var i in data){
                  $("#Autore").append("<option value=\""+ data[i].Text +"\"></option>");
                }
              },
              error: function(jqXHR, textStatus, errorThrown){
                alert(jqXHR +" "+ textStatus +" "+ errorThrown);
              }
            }

          );
        }
        else {
          $("#Autore").html("");
        }

      }
    );

    $("#iGenere").keyup(
      function(){
        var val = $("#iGenere").val();

        if (val != "") {
          $.ajax(
            {
              type:"GET",
              url:"../api/Generi/AutoComplete/?text=" + encodeURI(val),
              dataType:"json",
              success: function(data){
                $("#Genere").html("");
                for(var i in data){
                  $("#Genere").append("<option value=\""+ data[i].Text +"\"></option>");
                }
              },
              error: function(jqXHR, textStatus, errorThrown){
                alert(jqXHR +" "+ textStatus +" "+ errorThrown);
              }
            }

          );
        }
        else {
          $("#Genere").html("");
        }

      }
    );

    $("#iCasaEditrice").keyup(
      function(){
        var val = $("#iCasaEditrice").val();

        if (val != "") {
          $.ajax(
            {
              type:"GET",
              url:"../api/CaseEditrici/AutoComplete/?text=" + encodeURI(val),
              dataType:"json",
              success: function(data){
                $("#CasaEditrice").html("");
                for(var i in data){
                  $("#CasaEditrice").append("<option value=\""+ data[i].Text +"\"></option>");
                }
              },
              error: function(jqXHR, textStatus, errorThrown){
                alert(jqXHR +" "+ textStatus +" "+ errorThrown);
              }
            }

          );
        }
        else {
          $("#CasaEditrice").html("");
        }

      }
    );

  }
);
