//$.each(data, function(index, element) {
  //$("table").append("<tr>" + "<td>" + element.Id + "</td>" + "<td>" + element.Nome + "</td>" + "<td>" + element.LuogoSede + "</td>" + "<td>" + "<button class=\"modifica\" numero=\"" + element.Id + "\">" + "<td>" + "<button class=\"elimina\" numero=\"" + element.Id + "\">Elimina</button>" + "</tr>");
//});
$(document).ready(
  function(){

    $(".websearch").click(
      function(){
        var isbn = $("#LibroISBN").val();
        $.ajax({
          type: "POST",
          url: "../WebAPI/isbnGoogleAPI.php",
          data: JSON.stringify(isbn),
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
