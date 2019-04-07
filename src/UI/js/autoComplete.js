$(document).ready(
    function(){

        $("#LibroAutore").keyup(
            function(){
                var val = $("#LibroAutore").val();
                console.clear();
                    $.ajax(
                        {
                            type:"GET",
                            url:"../../../mockup/Autori/AutoComplete/?text=" + encodeURI(val),
                            dataType:"json",
                            success: function(data){
                                var opzioni = new Array();
                                for(var i in data){
                                    var opzione = {};
                                    opzione.label = data[i].text;
                                    opzione.value = data[i].value;
                                    opzioni.push(opzione);
                                }
                                $('#LibroAutore').autocomplete({
                                    source: opzioni,
                                    select: function (event, ui) {
                                        $("#LibroAutore").val(ui.item.label);
                                        $("#LibroAutoreHidden").val(ui.item.value);
                                        return false;
                                    },
                                    focus: function(event, ui) {
                                      event.preventDefault();
                                      $("#LibroAutore").val(ui.item.label);
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

        $("#LibroGenere").keyup(
            function(){
                var val = $("#LibroGenere").val();
                console.clear();
                    $.ajax(
                        {
                            type:"GET",
                            url:"../../../mockup/Generi/AutoComplete/?text=" + encodeURI(val),
                            dataType:"json",
                            success: function(data){
                                var opzioni = new Array();
                                for(var i in data){
                                    var opzione = {};
                                    opzione.label = data[i].text;
                                    opzione.value = data[i].value;
                                    opzioni.push(opzione);
                                }
                                $('#LibroGenere').autocomplete({
                                    source: opzioni,
                                    select: function (event, ui) {
                                        $("#LibroGenere").val(ui.item.label);
                                        $("#LibroGenereHidden").val(ui.item.value);
                                        return false;
                                    },
                                    focus: function(event, ui) {
                                      event.preventDefault();
                                      $("#LibroGenere").val(ui.item.label);
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

        $("#LibroCasaEditrice").keyup(
            function(){
                var val = $("#LibroCasaEditrice").val();
                console.clear();
                    $.ajax(
                        {
                            type:"GET",
                            url:"../../../mockup/CaseEditrici/AutoComplete/?text=" + encodeURI(val),
                            dataType:"json",
                            success: function(data){
                                var opzioni = new Array();
                                for(var i in data){
                                    var opzione = {};
                                    opzione.label = data[i].text;
                                    opzione.value = data[i].value;
                                    opzioni.push(opzione);
                                }
                                $('#LibroCasaEditrice').autocomplete({
                                    source: opzioni,
                                    select: function (event, ui) {
                                        $("#LibroCasaEditrice").val(ui.item.label);
                                        $("#LibroCasaEditriceHidden").val(ui.item.value);
                                        return false;
                                    },
                                    focus: function(event, ui) {
                                      event.preventDefault();
                                      $("#LibroCasaEditrice").val(ui.item.label);
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
