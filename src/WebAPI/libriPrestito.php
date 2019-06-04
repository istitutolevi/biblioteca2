<?php

require_once 'Common/connection.php';


$query= "SELECT Libri.Titolo, CONCAT(Autore.Cognome,' ',Autore.Nome) AS text FROM Libri JOIN AUTORI ON Libri.IdAutore = Autore.Id WHERE Libri.Stato = 'Y'";
$stmt = $connector->prepare($query);

if($stmt->execute()){

    $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
    http_response_code(200);
    echo json_encode($element, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    return true;

    }
 else {

     http_response_code(404);
     echo json_encode(
         array("message" => "ERROR!"));

 }



