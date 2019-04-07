$(document).ready(
    function(){

        $("#iAutore").keyup(
            function(){
                var val = $("#iAutore").val();
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
                                $('#iAutore').autocomplete({
                                    source: opzioni,
                                    select: function (event, ui) {
                                        $("#iAutore").val(ui.item.label);
                                        $("#iAutoreHidden").val(ui.item.value);
                                        return false;
                                    },
                                    focus: function(event, ui) {
                                      event.preventDefault();
                                      $("#iAutore").val(ui.item.label);
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

        $("#iGenere").keyup(
            function(){
                var val = $("#iGenere").val();
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
                                $('#iGenere').autocomplete({
                                    source: opzioni,
                                    select: function (event, ui) {
                                        $("#iGenere").val(ui.item.label);
                                        $("#iGenereHidden").val(ui.item.value);
                                        return false;
                                    },
                                    focus: function(event, ui) {
                                      event.preventDefault();
                                      $("#iGenere").val(ui.item.label);
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

        $("#iCasaEditrice").keyup(
            function(){
                var val = $("#iCasaEditrice").val();
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
                                $('#iCasaEditrice').autocomplete({
                                    source: opzioni,
                                    select: function (event, ui) {
                                        $("#iCasaEditrice").val(ui.item.label);
                                        $("#iCasaEditriceHidden").val(ui.item.value);
                                        return false;
                                    },
                                    focus: function(event, ui) {
                                      event.preventDefault();
                                      $("#iCasaEditrice").val(ui.item.label);
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
