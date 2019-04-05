<?php
$jA= "{
  \"Autore\":{
  \"Id\":1,
	\"Nome\":\"Luigi\",
	\"Cognome\":\"Pirandello\",
  \"DataDiNascita\":\"1867-10-15\",
  \"DataDiMorte\":\"1936-12-10\"

}
}
";
    $decode = json_decode($jA);

    echo $decode->Autore->Nome;
    //$autore = new autore();
