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
      }
    );

    $("#generisubmit").click(
      function(){
        var genere = {};
        genere.Id = $("#GenereId").val();
      }
    );

    $("#casesubmit").click(
      function(){
        var casa = {};
        casa.Id = $("#CasaId").val();
        casa.Nome = $("#CasaNome").val();
        casa.Luogo = $("#CasaLuogo").val();
        $.ajax({
          type : "GET",
          url : "../../../mockup/CaseEditrici/Ricerca/index.php",
          data : {casa:casa},
          dataType : "JSON",
          success : function(data){
            console.log(data);
          },
          error : function(a , b , c){
            console.log(a + "-" + b + "-" + c);
          }
        });
      }
    );

  }
);
