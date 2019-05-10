($(document).ready(function() { 

 
   
   $("#btnInvia").click(function(){ 
									var user = $('#client_id').val();
									var psw = $('#client_secret').val();
                                    
                                     $.ajax({
                                     type: "POST",
                                     url: "Token.php",
                                     // data: [{"key":"grant_type","value":"client_credentials","type":"text","enabled":true},{"key":"client_id","value":"testclient","description":"","type":"text","enabled":true},{"key":"client_secret","value":"testpass","description":"","type":"text","enabled":true}],
									 data: {"grant_type":"client_credentials","client_id":user,"client_secret":psw},
									 dataType: "json",
                                     success: function(Ris) { //quando torna il token
									 var risultato=Ris.access_token;
									 $('#result').html(risultato);
									 window.localStorage = risultato;
															},
									error: function(Ris){
										var risultato=Ris.responseJSON.error_description;
										$('#result').html(risultato);
									}
											}
											  );
   }
   );
   }));
// data: {"grant_type":"client_credentials","type":"text","enabled":true},{"client_id":"testclient","description":"","type":"text","enabled":true},{"client_secret":"testpass","description":"","type":"text","enabled":true},