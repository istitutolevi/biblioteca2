$(document).ready(
  function() {

    $("#librisubmit").click(
      function() {
        var libro = {};
        libro.Id = $("#LibroId").val();
        libro.Isbn = $("#LibroISBN").val();
        libro.Codice = $("#LibroCodice").val();
        libro.Titolo = $("#LibroTitolo").val();
        libro.Autore = $("#LibroAutoreHidden").val();
        libro.Genere = $("#LibroGenereHidden").val();
        libro.AnnoDa = $("#LibroAnnoDa").val();
        libro.AnnoA = $("#LibroAnnoA").val();
        libro.CasaEditrice = $("#LibroCasaEditriceHidden").val();
        libro.Scaffale = $("#LibroScaffale").val();
        libro.Armadio = $("#LibroArmadio").val();
        $.ajax({
          type: "GET",
          url: "../../../mockup/Libri/Ricerca",
          data: {
            libro: libro
          },
          dataType: "json",
          success: function(data) {
            $("body").html("<table></table>");
            $.each(data, function(index, element) {
              $("table").append("<tr>" + "<td>" + element.Id + "</td>" + "<td>" + element.Nome + "</td>" + "<td>" + element.LuogoSede + "</td>" + "<td>" + "<button class=\"modifica\" numero=\"" + element.Id + "\">" + "<td>" + "<button class=\"elimina\" numero=\"" + element.Id + "\">Elimina</button>" + "</tr>");
            });
            $(".modifica").click(
              function() {
                console.log("modifica: " + $(this).attr('numero'));
                window.location.replace("../Modifica/editlibri.html?" + $(this).attr('numero'));
              }
            );
            $(".elimina").click(
              function() {
                $(this).parent().parent().remove();
                console.log($(this).attr('numero'));
                $.ajax({
                  type: "DELETE",
                  url: "",
                  dataType: "json",
                  data: {
                    id: $(this).attr('numero')
                  },
                  success: function() {

                  }
                });
              }
            );
          }
        });
      }
    );

    $("#autorisubmit").click(
      function() {
        var autore = {};
        autore.Id = $("#AutoreId").val();
        autore.Nome = $("#AutoreNome").val();
        autore.Cognome = $("#AutoreCognome").val();
        autore.NascitaDa = $("#AutoreNascitaDa").val();
        autore.NascitaA = $("#AutoreNascitaA").val();
        autore.MorteDa = $("#AutoreMorteDa").val();
        autore.MorteA = $("#AutoreMorteA").val();
        console.log(JSON.stringify(autore));
        $.ajax({
          type: "GET",
          url: "../../WebAPI/Autori/controller.php?autore=" + encodeURI(JSON.stringify(autore)),
          success: function(data) {
            console.log(data);
            $("body").html("<table></table>");
            $.each(data, function(index, element) {
              $("table").append("<tr id=\"" + element.Id + "\">" + "<td>" + element.Id + "</td>" + "<td>" + element.Nome + "</td>" + "<td>" + element.Cognome + "</td>" + "<td>" + element.DataNascita + "</td>" + "<td>" + element.DataMorte + "</td>" + "<td>" + "<button class=\"modifica\" numero=\"" + element.Id + "\">Modifica</button>" + "<td>" + "<button class=\"elimina\" numero=\"" + element.Id + "\">Elimina</button>" + "</tr>");
            });
            $(".modifica").click(
              function() {
                console.log("modifica: " + $(this).attr('numero'));
                window.location.replace("../Modifica/editautori.html?" + $(this).attr('numero'));
              }
            );
            $(".elimina").click(
              function() {
                $(this).parent().parent().remove();
                console.log($(this).attr('numero'));
                $.ajax({
                  type: "DELETE",
                  url: "../../WebAPI/Autori/controller.php?id=" + encodeURI($(this).attr('numero')),
                  dataType: "json",
                  success: function() {

                  }
                });
              }
            );
          },
          error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
          }
        });
      }
    );

    $("#generisubmit").click(
      function() {
        var genere = {};
        genere.Id = $("#GenereId").val();
        $.ajax({
          type: "GET",
          url: "../../../mockup/Generi/Ricerca",
          data: {
            genere: genere
          },
          dataType: "json",
          success: function(data) {
            $("body").html("<table></table>");
            $.each(data, function(index, element) {
              $("table").append("<tr>" + "<td>" + element.Id + "</td>" + "<td>" + "<button class=\"modifica\" numero=\"" + element.Id + "\">Modifica</button>" + "<td>" + "<button class=\"elimina\" numero=\"" + element.Id + "\">Elimina</button>" + "</tr>");
            });
            $(".modifica").click(
              function() {
                console.log("modifica: " + $(this).attr('numero'));
                window.location.replace("../Modifica/editgeneri.html?" + $(this).attr('numero'));
              }
            );
            $(".elimina").click(
              function() {
                $(this).parent().parent().remove();
                console.log($(this).attr('numero'));
                $.ajax({
                  type: "DELETE",
                  url: "",
                  dataType: "json",
                  data: {
                    id: $(this).attr('numero')
                  },
                  success: function() {

                  }
                });
              }
            );
          }
        });
      }
    );

    $("#casesubmit").click(
      function() {
        var casa = {};
        casa.Id = $("#CasaId").val();
        casa.Nome = $("#CasaNome").val();
        casa.Luogo = $("#CasaLuogo").val();
        $.ajax({
          type: "GET",
          url: "../../../mockup/CaseEditrici/Ricerca",
          data: {
            casa: casa
          },
          dataType: "json",
          success: function(data) {
            $("body").html("<table></table>");
            $.each(data, function(index, element) {
              $("table").append("<tr>" + "<td>" + element.Id + "</td>" + "<td>" + element.Nome + "</td>" + "<td>" + element.LuogoSede + "</td>" + "<td>" + "<button class=\"modifica\" numero=\"" + element.Id + "\">Modifica</button>" + "<td>" + "<button class=\"elimina\" numero=\"" + element.Id + "\">Elimina</button>" + "</tr>");
            });
            $(".modifica").click(
              function() {
                console.log("modifica: " + $(this).attr('numero'));
                window.location.replace("../Modifica/editcase.html?" + $(this).attr('numero'));
              }
            );
            $(".elimina").click(
              function() {
                $(this).parent().parent().remove();
                console.log($(this).attr('numero'));
                $.ajax({
                  type: "DELETE",
                  url: "",
                  dataType: "json",
                  data: {
                    id: $(this).attr('numero')
                  },
                  success: function() {

                  }
                });
              }
            );
          }
        });

      }
    );

  }
);
