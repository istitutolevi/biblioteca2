$(document).ready(
  function(){

    $("#librisubmit").click(
      function(){
        var Libro = {};
        Libro.Id = $("#LibroId").val();
        Libro.Isbn = $("#LibroISBN").val();
        Libro.Codice = $("#LibroCodice").val();
        Libro.Titolo = $("#LibroTitolo").val();
        Libro.Autore = $("#LibroAutoreHidden").val();
        Libro.Genere = $("#LibroGenereHidden").val();
        Libro.AnnoDa = $("#LibroAnnoDa").val();
        Libro.AnnoA = $("#LibroAnnoA").val();
        Libro.CasaEditrice = $("#LibroCasaEditriceHidden").val();
        Libro.Scaffale = $("#LibroScaffale").val();
        Libro.Armadio = $("#LibroArmadio").val();
        console.log(Libro);
      }
    );

    $("#autorisubmit").click(
      function(){
        var Autore = {};
        Autore.Id = $("#AutoreId").val();
        Autore.Nome = $("#AutoreNome").val();
        Autore.Cognome = $("#AutoreCognome").val();
        Autore.NascitaDa = $("#AutoreNascitaDa").val();
        Autore.NascitaA = $("#AutoreNascitaA").val();
        Autore.MorteDa = $("#AutoreMorteDa").val();
        Autore.MorteA = $("#AutoreMorteA").val();
        console.log(Autore);
      }
    );

    $("#generisubmit").click(
      function(){
        var Genere = {};
        Genere.Id = $("#GenereId").val();
        console.log(Genere);
      }
    );

    $("#casesubmit").click(
      function(){
        var Casa = {};
        Casa.Id = $("#CasaId").val();
        Casa.Nome = $("#CasaNome").val();
        Casa.Luogo = $("#CasaLuogo").val();
        console.log(Casa);
      }
    );

  }
);
