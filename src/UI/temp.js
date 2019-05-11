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
          var idmod = $(this).attr('numero');
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
              casa.Luogo = $("#CasaLuogo").val();
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
        });
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

$("#casesubmit").click(
  function() {
    var casa = {};
    casa.Id = $("#CasaId").val();
    casa.Nome = $("#CasaNome").val();
    casa.Luogo = $("#CasaLuogo").val();
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
        $("main").html("<table class=\"casetable\"></table>");
        $.each(data, function(index, element) {
          $("table").append("<tr>" + "<td>" + element.Id + "</td>" + "<td>" + element.Nome + "</td>" + "<td>" + element.LuogoSede + "</td>" + "<td>" + "<button class=\"modifica\" numero=\"" + element.Id + "\">Modifica</button>" + "<td>" + "<button class=\"elimina\" numero=\"" + element.Id + "\">Elimina</button>" + "</tr>");
        });
        $(".modifica").click(
          function() {
            console.log("modifica: " + $(this).attr('numero'));
            var idmod = $(this).attr('numero');
            $("main").html("<div id=\"content\"></div>");
            $("#content").append(editCase);
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
                $("#CasaLuogo").val(data[0].Luogo);
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
                casa.Nome = $("#CasaBome").val();
                casa.Luogo = $("#CasaLuogo").val();
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
