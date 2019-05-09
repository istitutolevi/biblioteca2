$(document).ready(
  function() {
    var id = window.location.search.substr(1);
    var pagina = $("body").attr("page");
    if (id != null && id != "") {
      //IN CASO DI MODIFICA
      switch (pagina) {
        case "autori":
          $("button").html("Modifica Autore ID: " + id);
          var autore = {};
          autore.Id = id;
          autore.Nome = "";
          autore.Cognome = "";
          autore.NascitaDa = "";
          autore.NascitaA = "";
          autore.MorteDa = "";
          autore.MorteA = "";
          console.log(JSON.stringify(autore));
          $.ajax({
            type: "GET",
            url: "../../WebAPI/Autori/controller.php",
            dataType: "json",
            data: {
              autore: JSON.stringify(autore)
            },
            success: function(data) {
              console.log(data);
              $("#AutoreNome").val(data[0].Nome);
              $("#AutoreCognome").val(data[0].Cognome);
              $("#AutoreNascita").val(data[0].DataNascita.split(" ")[0]);
              $("#AutoreMorte").val(data[0].DataMorte.split(" ")[0]);
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(xhr.status);
              console.log(thrownError);
            }
          });
          $(".submitsearch").click(
            function() {
              var autore = {};
              autore.Id = id;
              autore.Nome = $("#AutoreNome").val();
              autore.Cognome = $("#AutoreCognome").val();
              autore.DataDiNascita = $("#AutoreNascita").val();
              autore.DataDiMorte = $("#AutoreNascita").val();
              console.log(JSON.stringify(autore));
              $.ajax({
                type: "POST",
                url: "../../WebAPI/Autori/controller.php",
                data: JSON.stringify(autore),
                dataType: "text",
                contentType: "application/json",
                success: function(data) {
                  console.log(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr.status);
                  console.log(thrownError);
                }
              });
            }
          );
          break;

        case "case":
          $("button").html("Modifica Casa ID: " + id);
          var casa = {};
          casa.Id = id;
          casa.Nome = "";
          casa.LuogoSede = "";
          console.log(JSON.stringify(casa));
          $.ajax({
            type: "GET",
            url: "../../WebAPI/CaseEditrici/controller.php",
            dataType: "json",
            data: {
              autore: JSON.stringify(casa)
            },
            success: function(data) {
              console.log(data);
              $("#CasaNome").val(data[0].Nome);
              $("#CasaLuogo").val(data[0].LuogoSede);
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(xhr.status);
              console.log(thrownError);
            }
          });
          $(".submitsearch").click(
            function() {
              var casa = {};
              casa.Id = id;
              casa.Nome = $("#CasaNome").val();
              casa.Cognome = $("#CasaLuogo").val();
              console.log(JSON.stringify(casa));
              $.ajax({
                type: "POST",
                url: "../../WebAPI/CaseEditrici/controller.php",
                data: JSON.stringify(casa),
                dataType: "text",
                contentType: "application/json",
                success: function(data) {
                  console.log(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr.status);
                  console.log(thrownError);
                }
              });
            }
          );
          break;

        case "generi":
          $("button").html("Modifica Casa ID: " + id);
          var genere = {};
          genere.Id = id;
          console.log(JSON.stringify(genere));
          $.ajax({
            type: "GET",
            url: "../../WebAPI/Generi/controller.php",
            dataType: "json",
            data: {
              autore: JSON.stringify(genere)
            },
            success: function(data) {
              console.log(data);
              $("#GenereId").val(data[0].Id);
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(xhr.status);
              console.log(thrownError);
            }
          });
          $(".submitsearch").click(
            function() {
              var genere = {};
              genere.Id = $("#GenereId").val();
              console.log(JSON.stringify(genere));
              $.ajax({
                type: "POST",
                url: "../../WebAPI/Generi/controller.php",
                data: JSON.stringify(genere),
                dataType: "text",
                contentType: "application/json",
                success: function(data) {
                  console.log(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr.status);
                  console.log(thrownError);
                }
              });
            }
          );
          break;

        default:
          break;
      }
    } else {
      //IN CASO DI INSERT
      $(".websearch").click(
        function() {
          $.ajax({
            type: "POST",
            url: "../../WebAPI/isbnGoogleAPI.php",
            data: $("#LibroISBN").val(),
            dataType: "json",
            contentType: "text",
            success: function(data) {
              console.log(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(xhr.status);
              console.log(thrownError);
            }
          });
        }
      );
      switch (pagina) {
        case "autori":
          $(".submitsearch").click(
            function() {
              var autore = {};
              autore.Id = "";
              autore.Nome = $("#AutoreNome").val();
              autore.Cognome = $("#AutoreCognome").val();
              autore.DataDiNascita = $("#AutoreNascita").val();
              autore.DataDiMorte = $("#AutoreNascita").val();
              console.log(JSON.stringify(autore));
              $.ajax({
                type: "PUT",
                url: "../../WebAPI/Autori/controller.php",
                data: JSON.stringify(autore),
                dataType: "text",
                contentType: "application/json",
                success: function(data) {
                  console.log(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr.status);
                  console.log(thrownError);
                }
              });
            }
          );
          break;

        case "generi":
          $(".submitsearch").click(
            function() {
              var genere = {};
              genere.Id = "";
              console.log(JSON.stringify(genere));
              $.ajax({
                type: "PUT",
                url: "../../WebAPI/Generi/controller.php",
                data: JSON.stringify(autore),
                dataType: "text",
                contentType: "application/json",
                success: function(data) {
                  console.log(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr.status);
                  console.log(thrownError);
                }
              });
            }
          );
          break;

        case "case":
          $(".submitsearch").click(
            function() {
              var casa = {};
              casa.Id = "";
              casa.Nome = $("#CasaNome").val();
              casa.LuogoSede = $("#CasaLuogo").val();
              console.log(JSON.stringify(casa));
              $.ajax({
                type: "PUT",
                url: "../../WebAPI/CaseEditrici/controller.php",
                data: JSON.stringify(casa),
                dataType: "text",
                contentType: "application/json",
                success: function(data) {
                  console.log(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr.status);
                  console.log(thrownError);
                }
              });
            }
          );
          break;

        default:
          break;

      }
    }
  }
);
