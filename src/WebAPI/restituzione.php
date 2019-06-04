<?php
/**
 * Created by PhpStorm.
 * User: 7204
 * Date: 31/05/2019
 * Time: 10:24
 */
require_once 'Common/connection.php';
//$body= json_decode(file_get_contents('php://input')); --> da decommentare nella versione non beta
$LibroUtente=[
    'idLibro' => '1',
    'finePrestito' =>  date ("H:i:s d-m-Y ", mktime(12,13,7,3,1,2019))
];
//Create($body,$conn);--> da decommentare nella versione non beta
Create(json_encode($LibroUtente),$conn);
function Create($jsonLibroUtente, $connector)
{

    $decode = json_decode($jsonLibroUtente);
    $idLibro=$decode->idLibro;
    $idUtente=$decode->idUtente;
    $DataInizioPrestito=$decode->inizioPrestito;
    $DataFinePrestitoPrevista=$decode->finePrestito;
    $query ="SELECT LibriUtenti.IdUtenti,LibriUtenti.IdLibro FROM Libri";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':idutente',$idUtente,PDO::PARAM_STR);
    $stmt->bindParam(':idlibro',$idLibro,PDO::PARAM_STR);
    $stmt->bindParam(':dataI',$DataInizioPrestito,PDO::PARAM_STR);



    if($stmt->execute()){
        $libroutente = $stmt->fetchAll(PDO::FETCH_ASSOC);
        UpdateLibri($connector,$libroutente);
        $returnIdquery ="SELECT @@identity";
        $stmt = $connector->prepare($returnIdquery);
        if(UpdateLibri($connector,$idUtente,$idLibro,$DataInizioPrestito,$DataFinePrestitoPrevista));
        {
            http_response_code(201);
            echo json_encode($element);
            return true;
        }
    }

    http_response_code(503);
    echo json_encode(array("message" => "Impossibile creare un autore."));
    return false;


}

function UpdateLibri($connector,$idutente,$libroutente)
{
    $query ="UPDATE Libri SET IdUtentePrestito=NULL,Stato='Y', DataInizioPrestito=NULL, DataFinePrestitoPrevista=NULL WHERE Id=:id";
    $stmt = $connector->prepare($query);

    $stmt->bindParam(':utente',$idutente,PDO::PARAM_STR);
    $stmt->bindParam(':id',$libroutente['IdLibro'],PDO::PARAM_STR);
    return $stmt->execute();
}