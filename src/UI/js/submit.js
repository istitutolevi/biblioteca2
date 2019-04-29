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
          url: "../../../mockup/Libri.php",
          data: {libro:libro},
          dataType: "json",
          success: function(data){
            $.each(data,function(index,element){

            });
          }
        });
        console.log(libro);
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
        console.log(autore);
      }
    );

    $("#generisubmit").click(
      function(){
        var genere = {};
        genere.Id = $("#GenereId").val();
        console.log(genere);
      }
    );

    $("#casesubmit").click(
      function(){
        var casa = {};
        casa.Id = $("#CasaId").val();
        casa.Nome = $("#CasaNome").val();
        casa.Luogo = $("#CasaLuogo").val();
        console.log(casa);
        $.ajax({
          type: "GET",
          url: "../../../mockup/CaseEditrici/Ricerca",
          data: {casa:casa},
          dataType: "json",
          success: function(data){
            $("body").html("");
            $.each(data,function(index,element){

            });
          }
        });

      }
    );

  }
);
