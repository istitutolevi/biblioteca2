$(document).ready(
  function() {
    var id = window.location.search.substr(1);
    if (id != null && id != "") {
      var pagina = $("body").attr("page");

      switch (pagina) {
        case "autori":
        $("button").html("Modifica Autore ID: " + id);
        $.ajax({
          type: "GET",
          url: "../../../mockup/Autori/Modifica",
          data: {id:id},
          dataType: "json",
          success: function(data){
            $("#AutoreNome").val(data.Nome);
            $("#AutoreCognome").val(data.Cognome);
            $("#AutoreNascita").val(data.DataDiNascita);
            $("#AutoreMorte").val(data.DataDiMorte);
          }
        });
        break;

        case "case":
        $("button").html("Modifica Casa ID: " + id);
        $.ajax({
          type: "GET",
          url: "../../../mockup/CaseEditrici/Modifica",
          data: {id:id},
          dataType: "json",
          success: function(data){
            $("#CasaNome").val(data.Nome);
            $("#CasaLuogo").val(data.LuogoSede);
          }
        });
        break;

        case "generi":
        $("button").html("Modifica Genere ID: " + id);
        $.ajax({
          type: "GET",
          url: "../../../mockup/Generi/Modifica",
          data: {id:id},
          dataType: "json",
          success: function(data){
            $("#AutoreNome").val(data.Nome);
            $("#AutoreCognome").val(data.Cognome);
            $("#AutoreNascita").val(data.DataDiNascita);
            $("#AutoreMorte").val(data.DataDiMorte);
          }
        });
        break;

        case "libri":
        $("button").html("Modifica Libro ID: " + id);
        $.ajax({
          type: "GET",
          url: "../../../mockup/Libri/Modifica",
          data: {id:id},
          dataType: "json",
          success: function(data){
            $("#AutoreNome").val(data.Nome);
            $("#AutoreCognome").val(data.Cognome);
            $("#AutoreNascita").val(data.DataDiNascita);
            $("#AutoreMorte").val(data.DataDiMorte);
          }
        });
        break;

        default:
        break;
      }
    }
  }
);
