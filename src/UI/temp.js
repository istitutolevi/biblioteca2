$("#generisubmit").click(
  function() {
    console.log("ok");
    var genere = {};
    genere.Id = $("#GenereId").val();
    $.ajax({
      type: "GET",
      url: "../WebAPI/Generi/controller.php",
      dataType: "json",
      data: {
        genere: JSON.stringify(genere)
      },
      success: function(data) {
        $("main").html("<table></table>");
        $.each(data, function(index, element) {
          $("table").append("<tr>" + "<td>" + element.Id + "</td>" + "<td>" + "<button class=\"modifica\" numero=\"" + element.Id + "\">Modifica</button>" + "<td>" + "<button class=\"elimina\" numero=\"" + element.Id + "\">Elimina</button>" + "</tr>");
        });
        $(".modifica").click(function() {
          console.log("modifica: " + $(this).attr('numero'));
          var idmod = $(this).attr('numero');
          $("main").html("<div id=\"content\"></div>");
          $("#content").append(editGeneri);
          $("button").html("Modifica Casa ID: " + idmod);
          var genere = {};
          genere.Id = idmod;
          console.log(JSON.stringify(genere));
          $.ajax({
            type: "GET",
            url: "../WebAPI/Generi/controller.php",
            dataType: "json",
            data: {
              genere: JSON.stringify(genere)
            },
            success: function(data) {
              console.log(data);
              $("#GenereId").val(data[0].Id);
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(xhr.status);
              console.log(thrownError);
            }
          });
          $(".submitsearch").click(
            function() {
              var genere = {};
              genere.Id = idmod;
              console.log(JSON.stringify(genere));
              $.ajax({
                type: "POST",
                url: "../WebAPI/Generi/controller.php",
                data: JSON.stringify(genere),
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
              url: "../WebAPI/Generi/controller.php?id=" + $(this).attr('numero'),
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
