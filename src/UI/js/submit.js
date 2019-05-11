
            $.each(data, function(index, element) {
              $("table").append("<tr>" + "<td>" + element.Id + "</td>" + "<td>" + element.Nome + "</td>" + "<td>" + element.LuogoSede + "</td>" + "<td>" + "<button class=\"modifica\" numero=\"" + element.Id + "\">" + "<td>" + "<button class=\"elimina\" numero=\"" + element.Id + "\">Elimina</button>" + "</tr>");
            });
