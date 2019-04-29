$(document).ready(
  function(){

    $("#librisubmit").click(
      function(){
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
          data: {libro:libro},
          dataType: "json",
          success: function(data){
            $("body").html("<table></table>");
            $.each(data,function(index,element){
              $("table").append("<tr>"+"<td>" + element.Id + "</td>"+"<td>" + element.Nome + "</td>"+"<td>" + element.LuogoSede + "</td>"+"</tr>");
            });
          }
        });
      }
    );

    $("#autorisubmit").click(
      function(){
        var autore = {};
        autore.Id = $("#AutoreId").val();
        autore.Nome = $("#AutoreNome").val();
        autore.Cognome = $("#AutoreCognome").val();
        autore.NascitaDa = $("#AutoreNascitaDa").val();
        autore.NascitaA = $("#AutoreNascitaA").val();
        autore.MorteDa = $("#AutoreMorteDa").val();
        autore.MorteA = $("#AutoreMorteA").val();
        $.ajax({
          type: "GET",
          url: "../../../mockup/Autori/Ricerca",
          data: {autore:autore},
          dataType: "json",
          success: function(data){
            $("body").html("<table></table>");
            $.each(data,function(index,element){
              $("table").append("<tr>"+"<td>" + element.Id + "</td>"+"<td>" + element.Nome + "</td>"+"<td>" + element.Cognome + "</td>"+"<td>" + element.DataDiNascita + "</td>"+"<td>" + element.DataDiMorte + "</td>"+"</tr>");
            });
          }
        });
      }
    );

    $("#generisubmit").click(
      function(){
        var genere = {};
        genere.Id = $("#GenereId").val();
        $.ajax({
          type: "GET",
          url: "../../../mockup/Generi/Ricerca",
          data: {genere:genere},
          dataType: "json",
          success: function(data){
            $("body").html("<table></table>");
            $.each(data,function(index,element){
              $("table").append("<tr>"+"<td>" + element.Id + "</td>"+"</tr>");
            });
          }
        });
      }
    );

    $("#casesubmit").click(
      function(){
        var casa = {};
        casa.Id = $("#CasaId").val();
        casa.Nome = $("#CasaNome").val();
        casa.Luogo = $("#CasaLuogo").val();
        $.ajax({
          type: "GET",
          url: "../../../mockup/CaseEditrici/Ricerca",
          data: {casa:casa},
          dataType: "json",
          success: function(data){
            $("body").html("<table></table>");
            $.each(data,function(index,element){
              $("table").append("<tr>"+"<td>" + element.Id + "</td>"+"<td>" + element.Nome + "</td>"+"<td>" + element.LuogoSede + "</td>"+"</tr>");
            });
          }
        });

      }
    );

  }
);
