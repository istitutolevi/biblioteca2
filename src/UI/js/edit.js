$(document).ready(
  function() {
    var id = window.location.search.substr(1);
    var pagina = $("body").attr("page");
    if (id != null && id != "") {
      //IN CASO DI MODIFICA
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
        $(".submitsearch").click(
          function() {
            var Autore = {};
            Autore.Id = id;
            Autore.Nome = $("#AutoreNome").val();
            Autore.Cognome = $("#AutoreCognome").val();
            Autore.DataDiNascita = $("#AutoreNascita").val();
            Autore.DataDiMorte = $("#AutoreNascita").val();
            console.log(JSON.stringify(Autore));
            $.ajax({
              type: "POST",
              url: "../../WebAPI/Autori/controller.php",
              data: {Autore:Autore},
              dataType: "json",
              success:function() {
                console.log("fatto");
              },
              error: function(jqXHR, textStatus, errorThrown){
                  alert(jqXHR +" "+ textStatus +" "+ errorThrown);
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
          data: {id:id},
          dataType: "json",
          success: function(data){
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
              data: {CasaEditrice:CasaEditrice},
              dataType: "json",
              success:function() {
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
          data: {id:id},
          dataType: "json",
          success: function(data){
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
          data: {id:id},
          dataType: "json",
          success: function(data){
            //DA FARE
          }
        });
        break;

        default:
        break;
      }
    }
    else {
      //IN CASO DI INSERT
      switch (pagina) {
        case "autori":
        $(".submitsearch").click(
          function() {
            var Autore = {};
            Autore.Nome = $("#AutoreNome").val();
            Autore.Cognome = $("#AutoreCognome").val();
            Autore.DataDiNascita = $("#AutoreNascita").val();
            Autore.DataDiMorte = $("#AutoreNascita").val();
            console.log(JSON.stringify(Autore));
            $.ajax({
              type: "PUT",
              url: "../../WebAPI/Autori/controller.php",
              data: {Autore:Autore},
              dataType: "json",
              success:function() {
                console.log("fatto");
              },
              error: function(jqXHR, textStatus, errorThrown){
                  alert(jqXHR +" "+ textStatus +" "+ errorThrown);
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
              data: {CasaEditrice:CasaEditrice},
              dataType: "json",
              success:function() {
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
