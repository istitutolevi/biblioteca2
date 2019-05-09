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
            data: {autore:JSON.stringify(autore)},
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
          $.ajax({
            type: "GET",
            url: "../../../mockup/CaseEditrici/Modifica",
            data: {
              id: id
            },
            dataType: "json",
            success: function(data) {
              $("#CasaNome").val(data.Nome);
              $("#CasaLuogo").val(data.LuogoSede);
            }
          });
          $(".submitsearch").click(
            function() {
              var CasaEditrice = {};
              CasaEditrice.Id = id;
              CasaEditrice.Nome = $("#CasaNome").val();
              CasaEditrice.LuogoSede = $("#CasaLuogo").val();
              console.log(JSON.stringify(CasaEditrice));
              $.ajax({
                type: "POST",
                url: "",
                data: {
                  CasaEditrice: CasaEditrice
                },
                dataType: "json",
                success: function() {
                  console.log("fatto");
                }
              });
            }
          );
          break;

        case "generi":
          $("button").html("Modifica Genere ID: " + id);
          $.ajax({
            type: "GET",
            url: "../../../mockup/Generi/Modifica",
            data: {
              id: id
            },
            dataType: "json",
            success: function(data) {
              //DA NON FARE
            }
          });
          $(".submitsearch").click(
            function() {
              //DA NON FARE
            }
          );
          break;

        case "libri":
          $("button").html("Modifica Libro ID: " + id);
          $.ajax({
            type: "GET",
            url: "../../../mockup/Libri/Modifica",
            data: {
              id: id
            },
            dataType: "json",
            success: function(data) {
              //DA FARE
            }
          });
          break;

        default:
          break;
      }
    } else {
      //IN CASO DI INSERT
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
              var CasaEditrice = {};
              CasaEditrice.Nome = $("#CasaNome").val();
              CasaEditrice.LuogoSede = $("#CasaLuogo").val();
              console.log(JSON.stringify(CasaEditrice));
              $.ajax({
                type: "POST",
                url: "",
                data: {
                  CasaEditrice: CasaEditrice
                },
                dataType: "json",
                success: function() {
                  console.log("fatto");
                }
              });
            }
          );
          break;

        case "case":
          break;

        case "libri":
          break;

        default:
          break;

      }
    }
  }
);
