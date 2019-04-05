$(document).ready(
    function(){

        $("#iAutore").keyup(
            function(){
                var val = $("#iAutore").val();
                console.clear();
                console.log(val);
                    $.ajax(
                        {
                            type:"GET",
                            url:"../../../mockup/Autori/AutoComplete/?text=" + encodeURI(val),
                            dataType:"json",
                            success: function(data){
                              console.log(data);
                                var opzioni = new Array();
                                for(var i in data){
                                    var opzione = {};
                                    opzione.value = data[i].value;
                                    opzione.label = data[i].text;
                                    opzioni.push(opzione);
                                    console.log(opzioni);
                                }
                                $('#iAutore').autocomplete({
                                    source: opzioni,
                                    select: function (event, ui) {
                                        $("#iAutore").val(ui.item.value); // display the selected text
                                        $("#iAutoreHidden").val(ui.item.label); // save selected id to hidden input
                                    }
                                });

                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                alert(jqXHR +" "+ textStatus +" "+ errorThrown);
                            }
                        }

                    );

            }
        );

    }
);
