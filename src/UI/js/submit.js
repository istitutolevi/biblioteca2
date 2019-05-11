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
        if ($("#AutoreNascitaDa").val() == "") {
          autore.NascitaDa = "0001-01-01"
        }
        if ($("#AutoreNascitaA").val() == "") {
          autore.NascitaA = "9999-01-01"
        }
        if ($("#AutoreMorteDa").val() == "") {
          autore.MorteDa = "0001-01-01"
        }
        if ($("#AutoreMorteA").val() == "") {
          autore.MorteA = "9999-01-01"
        }
        console.log(JSON.stringify(autore));
        $.ajax({
          type: "GET",
          url: "../WebAPI/Autori/controller.php",
          dataType: "json",
          data: {
            autore: JSON.stringify(autore)
          },
          success: function(data) {
            console.log(data);
            $("main").html("<table class=\"autoritable\"></table>");
            $.each(data, function(index, element) {
              $("table").append("<tr id=\"" + element.Id + "\">" + "<td>" + element.Id + "</td>" + "<td>" + element.Nome + "</td>" + "<td>" + element.Cognome + "</td>" + "<td>" + element.DataNascita + "</td>" + "<td>" + element.DataMorte + "</td>" + "<td>" + "<button class=\"modifica\" numero=\"" + element.Id + "\">Modifica</button>" + "<td>" + "<button class=\"elimina\" numero=\"" + element.Id + "\">Elimina</button>" + "</tr>");
            });
            $(".modifica").click(
              function() {
                console.log("modifica: " + $(this).attr('numero'));
                var idmod=$(this).attr('numero');
                $("main").html("<div id=\"content\"></div>");
                $("#content").append(editAutori);
                $("button").html("Modifica Autore ID: " + idmod);
                var autore = {};
                autore.Id = idmod;
                autore.Nome = "";
                autore.Cognome = "";
                autore.NascitaDa = "";
                autore.NascitaA = "";
                autore.MorteDa = "";
                autore.MorteA = "";
                console.log(JSON.stringify(autore));
                $.ajax({
                  type: "GET",
                  url: "../WebAPI/Autori/controller.php",
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
                    autore.Id = idmod;
                    autore.Nome = $("#AutoreNome").val();
                    autore.Cognome = $("#AutoreCognome").val();
                    autore.DataDiNascita = $("#AutoreNascita").val();
                    autore.DataDiMorte = $("#AutoreNascita").val();
                    console.log(JSON.stringify(autore));
                    $.ajax({
                      type: "POST",
                      url: "../WebAPI/Autori/controller.php",
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
              }
            );
            $(".elimina").click(
              function() {
                $(this).parent().parent().remove();
                console.log($(this).attr('numero'));
                $.ajax({
                  type: "DELETE",
                  url: "../WebAPI/Autori/controller.php?id=" + $(this).attr('numero'),
                  success: function() {
                    console.log("eliminato");
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
          url: "../../WebAPI/Generi/controller.php",
          dataType: "json",
          data: {
            genere: JSON.stringify(genere)
          },
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
                  url: "../../WebAPI/Generi/controller.php?id=" + $(this).attr('numero'),
                  success: function() {
                    console.log("eliminato");
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
        console.log("ok");
        var casa = {};
        casa.Id = $("#CasaId").val();
        casa.Nome = $("#CasaNome").val();
        casa.Luogo = $("#CasaLuogo").val();
        $.ajax({
          type: "GET",
          url: "../WebAPI/CaseEditrici/controller.php",
          dataType: "json",
          data: {
            casaEditrice: JSON.stringify(casa)
          },
          success: function(data) {
            $("main").html("<table></table>");
            $.each(data, function(index, element) {
              $("table").append("<tr>" + "<td>" + element.Id + "</td>" + "<td>" + element.Nome + "</td>" + "<td>" + element.LuogoSede + "</td>" + "<td>" + "<button class=\"modifica\" numero=\"" + element.Id + "\">Modifica</button>" + "<td>" + "<button class=\"elimina\" numero=\"" + element.Id + "\">Elimina</button>" + "</tr>");
            });
            $(".modifica").click(function() {
                console.log("modifica: " + $(this).attr('numero'));
                var idmod=$(this).attr('numero');
                $("main").html("<div id=\"content\"></div>");
                $("#content").append(editAutori);
                $("button").html("Modifica Casa ID: " + idmod);
                var casa = {};
                casa.Id = idmod;
                casa.Nome = "";
                casa.Luogo = "";
                console.log(JSON.stringify(casa));
                $.ajax({
                  type: "GET",
                  url: "../WebAPI/CaseEditrici/controller.php",
                  dataType: "json",
                  data: {
                    casaEditrice: JSON.stringify(casa)
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
                    casa.Id = idmod;
                    casa.Nome = $("#CasaNome").val();
                    casa.LuogoSede = $("#CasaLuogo").val();
                    console.log(JSON.stringify(casa));
                    $.ajax({
                      type: "POST",
                      url: "../WebAPI/CaseEditrici/controller.php",
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
              }
            );
            $(".elimina").click(
              function() {
                $(this).parent().parent().remove();
                console.log($(this).attr('numero'));
                $.ajax({
                  type: "DELETE",
                  url: "../WebAPI/CaseEditrici/controller.php?id=" + $(this).attr('numero'),
                  success: function() {
                    console.log("eliminato");
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
  }
);
