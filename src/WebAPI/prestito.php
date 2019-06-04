<?php

require_once 'Common/connection.php';
//$body= json_decode(file_get_contents('php://input')); //--> da decommentare nella versione non beta
$LibroUtente=[
    'idLibro' => '1',
    'idUtente' => '1',
    'inizioPrestito' => date ("d-m-Y H:i:s", mktime(12,13,7,1,1,2019)),
    'finePrestito' =>  date ("d-m-Y H:i:s", mktime(12,13,7,3,1,2019))
];
//Create($body,$conn);//--> da decommentare nella versione non beta
Create(json_encode($LibroUtente),$conn);
function Create($jsonLibroUtente, $connector)
{

    $decode = json_decode($jsonLibroUtente);
    $idLibro=$decode->idLibro;
    $idUtente=$decode->idUtente;
    $DataInizioPrestito=$decode->inizioPrestito;
    $DataFinePrestitoPrevista=$decode->finePrestito;
    $query ="INSERT INTO LIBRIUTENTI (IdUtente,IdLibro,DataInizioPrestito) VALUE (:idutente,:idlibro,:dataI)";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':idutente',$idUtente,PDO::PARAM_STR);
    $stmt->bindParam(':idlibro',$idLibro,PDO::PARAM_STR);
    $stmt->bindParam(':dataI',$DataInizioPrestito,PDO::PARAM_STR);



    if($stmt->execute()){
        $returnIdquery ="SELECT @@identity";
        $stmt = $connector->prepare($returnIdquery);

        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

function UpdateLibri($connector,$idutente,$idlibro,$dataInizioPrestito,$dataFinePrestitoPrevista)
{
    $query ="UPDATE Libri SET IdUtentePrestito=:utente,Stato='N', DataInizioPrestito=:dataI, DataFinePrestitoPrevista=:dataF WHERE Id=:id";
    $stmt = $connector->prepare($query);

    $stmt->bindParam(':dataI',$dataInizioPrestito,PDO::PARAM_INT);
    $stmt->bindParam(':dataF',$dataFinePrestitoPrevista,PDO::PARAM_STR);
    $stmt->bindParam(':utente',$idutente,PDO::PARAM_STR);
    $stmt->bindParam(':id',$idlibro,PDO::PARAM_STR);
    return $stmt->execute();
}