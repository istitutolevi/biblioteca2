<?php
include 'Libro.php';
require_once '../Common/connection.php';

$method= $_SERVER['REQUEST_METHOD'];
$body= file_get_contents('php://input');

switch ($method) {
    case "GET":
        Read($_GET["id"], $_GET["isbn"], $_GET["codice"], $_GET["titolo"],$_GET["idGenere"],
             $_GET["annoPubblicazioneDa"], $_GET["annoPubblicazioneA"], $_GET["idCasaEditrice"],
             $_GET["scaffale"], $_GET["armadio"], $_GET["autori"],$conn);
        break;
    case "POST":
        Update($body,$conn);
        break;
    case "PUT":
        Create($body,$conn);
        break;
    case "DELETE":
        Delete($_GET["id"], $conn);
        break;
    default:
        echo "Not Method Found";
        break;
}


function Create($jsonLibro, $connector)
{
    //modified by Bonantini

    $decode = json_decode($jsonLibro);


    // warning: qui mettere libro = decode
    $libro = new libro($decode->Id,$decode->Titolo,$decode->ISBN,$decode->Codice,$decode->IdCasaEditrice,$decode->AnnoPubblicazione,$decode->CollocazioneLuogo,$decode->Libro->CollocazioneArmadio,$decode->CollocazioneScaffale,$decode->Stato,$decode->IdUtentePrestito,$decode->DataInizioPrestito,$decode->DataFinePrestitoPrevista,$decode->IdGenere);
    $query ="INSERT INTO Libri (Id,Titolo,ISBN,Codice,IdCasaEditrice,AnnoPubblicazione,CollocazioneLuogo,CollocazioneArmadio,CollocazioneScaffale,Stato,IdUtentePrestito,DataInizioPrestito,DataFinePrestitoPrevista,IdGenere) VALUE (:id,:titolo,:isbn,:codice,:idCasaEditrice,:annoPubblicazione,:collocazioneLuogo,:collocazioneArmadio,:collocazioneScaffale,:stato,:idUtentePrestito,:dataInizioPrestito,:dataFinePrestitoPrevista,:idGenere)";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$libro->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':titolo',$libro->Titolo,PDO::PARAM_STR);
    $stmt->bindParam(':isbn',$libro->ISBN,PDO::PARAM_STR);
    $stmt->bindParam(':codice',$libro->Codice,PDO::PARAM_STR);
    $stmt->bindParam(':idCasaEditrice',$libro->IdCasaEditrice,PDO::PARAM_STR);
    $stmt->bindParam(':annoPubblicazione',$libro->AnnoPubblicazione,PDO::PARAM_STR);
    $stmt->bindParam(':collocazioneLuogo',$libro->CollocazioneLuogo,PDO::PARAM_STR);
    $stmt->bindParam(':collocazioneArmadio',$libro->CollocazioneArmadio,PDO::PARAM_STR);
    $stmt->bindParam(':collocazioneScaffale',$libro->CollocazioneScaffale,PDO::PARAM_STR);
    $stmt->bindParam(':stato',$libro->Stato,PDO::PARAM_STR);
    $stmt->bindParam(':idUtentePrestito',$libro->IdUtentePrestito,PDO::PARAM_STR);
    $stmt->bindParam(':dataInizioPrestito',$libro->DataInizioPresito,PDO::PARAM_STR);
    $stmt->bindParam(':dataFinePrestitoPrevista',$libro->DataFinePrestitoPrevista,PDO::PARAM_STR);
    $stmt->bindParam(':idGenere',$libro->IdGenere,PDO::PARAM_STR);

    if($stmt->execute()){
        $returnIdquery ="SELECT LAST_INSERT_ID()";
        $stmt = $connector->prepare($returnIdquery);

        $stmt->execute();
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $query = "INSERT INTO LibriAutori (IdLibro, IdAutore) VALUES (:IdLibro, :IdAutore)";
        foreach ($decode->Autori as $autore) {
          $stmt = $connector->prepare($query);

          $stmt->bindParam(':IdLibro',$element,PDO::PARAM_INT);
          $stmt->bindParam(':IdAutore',$autore->Id,PDO::PARAM_INT);

          if (!$stmt->execute())
          {
            http_response_code(503);
            return false;
          }

        }

        http_response_code(201);
        echo json_encode($element);
        return true;
    }

    http_response_code(503);
    echo json_encode(array("message" => "Impossibile creare un libro."));
    return false;

}


function Read($id, $isbn,$codice, $titolo,$idGenere,
             $annoPubblicazioneDa, $annoPubblicazioneA, $idCasaEditrice,
             $scaffale, $armadio,$arrayAutori, $connector)
{

    $query ="SELECT Libri.*,Autori.*
    FROM Libri
    JOIN LibriAutori ON Libri.Id=LibriAutori.IdLibro
    JOIN Autori ON Autori.Id=LibriAutori.IdAutori
    WHERE Libri.id=:id
    OR (Libri.Titolo LIKE :titolo
    AND Libri.ISBN LIKE :isbn
    AND Libri.Codice LIKE :codice
    AND Libri.IdCas = :idCasaEditrice
    AND Libri.Anno BETWEEN :annoDa AND :annoA
    AND Libri.CollocazioneArmadio LIKE :collocazioneArmadio
    AND Libri.CollocazioneScaffale LIKE :collocazioneScaffale
    AND Libri.IdGenere = :idGenere";

    $autori = json_decode($arrayAutori,true);

    for($i =0; $i< count($autori); $i++)
    {

        $query." AND LibriAutori.Id = :idAutore".$i;

    }
    $query.")";


    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$id,PDO::PARAM_INT);
    $stmt->bindParam(':titolo',$titolo,PDO::PARAM_STR);
    $stmt->bindParam(':isbn',$isbn,PDO::PARAM_STR);
    $stmt->bindParam(':codice',$codice,PDO::PARAM_INT);
    $stmt->bindParam(':idCasaEditrice',$idCasaEditrice,PDO::PARAM_STR);
    $stmt->bindParam(':annoDa',$annoPubblicazioneDa,PDO::PARAM_INT);
    $stmt->bindParam(':annoA',$annoPubblicazioneA,PDO::PARAM_INT);
    $stmt->bindParam(':collocazioneArmadio',$armadio,PDO::PARAM_INT);
    $stmt->bindParam(':collocazioneScaffale',$scaffale,PDO::PARAM_INT);
    $stmt->bindParam(':idGenere',$id,PDO::PARAM_STR);

    for($i =0; $i< count($autori); $i++)
    {
        $bindAutore= ':idAutore'.$i;

        $stmt->bindParam($bindAutore,$autori[$i]->Id,PDO::PARAM_INT);

    }


    if($stmt->execute()){

        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
        http_response_code(200);
        echo json_encode($element);
        return true;
    }
    http_response_code(404);
    echo json_encode(
        array("message" => "No libro trovato.")
    );
    return false;
}

function Update($jsonLibro, $connector)
{
   //modified by Bonantini
    $decode = json_decode($jsonLibro);


    $libro = new libro($decode->Id,$decode->Titolo,$decode->ISBN,$decode->Codice,$decode->IdCasaEditrice,$decode->AnnoPubblicazione,$decode->CollocazioneLuogo,$decode->CollocazioneArmadio,$decode->CollocazioneScaffale,$decode->Stato,$decode->IdUtentePrestito,$decode->DataInizioPrestito,$decode->DataFinePrestitoPrevista,$decode->IdGenere);
    $query ="UPDATE Libri SET Titolo=:titolo,ISBN=:isbn,Codice=:codice,IdCasaEditrice=:idCasaEditrice,AnnoPubblicazione=:annoPubblicazione,CollocazioneLuogo=:collocazioneLuogo,CollocazioneArmadio=:collocazioneArmadio,CollocazioneScaffale=:collocazioneScaffale,Stato=:stato,IdUtentePrestito=:idUtentePrestito,DataInizioPrestito=:dataInizioPrestito,DataFinePrestitoPrevista=:dataFinePrestitoPrevista,IdGenere=:idGenere WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$libro->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':titolo',$libro->Titolo,PDO::PARAM_STR);
    $stmt->bindParam(':isbn',$libro->ISBN,PDO::PARAM_STR);
    $stmt->bindParam(':codice',$libro->Codice,PDO::PARAM_STR);
    $stmt->bindParam(':idCasaEditrice',$libro->IdCasaEditrice,PDO::PARAM_STR);
    $stmt->bindParam(':annoPubblicazione',$libro->AnnoPubblicazione,PDO::PARAM_STR);
    $stmt->bindParam(':collocazioneLuogo',$libro->CollocazioneLuogo,PDO::PARAM_STR);
    $stmt->bindParam(':collocazioneArmadio',$libro->CollocazioneArmadio,PDO::PARAM_STR);
    $stmt->bindParam(':collocazioneScaffale',$libro->CollocazioneScaffale,PDO::PARAM_STR);
    $stmt->bindParam(':stato',$libro->Stato,PDO::PARAM_STR);
    $stmt->bindParam(':idUtentePrestito',$libro->IdUtentePrestito,PDO::PARAM_STR);
    $stmt->bindParam(':dataInizioPrestito',$libro->DataInizioPresito,PDO::PARAM_STR);
    $stmt->bindParam(':dataFinePrestitoPrevista',$libro->DataFinePrestitoPrevista,PDO::PARAM_STR);
    $stmt->bindParam(':idGenere',$libro->IdGenere,PDO::PARAM_STR);
    $stmt->bindParam(':luogoSede',$libro->LuogoSede,PDO::PARAM_STR);




    if($stmt->execute()){
        $returnIdquery ="SELECT Id from Libri WHERE Titolo=:titolo && ISBN=:isbn && IdCasaEditrice=:idCasaEditrice && AnnoPubblicazione=:annoPubblicazione && CollocazioneLuogo=:collocazioneLuogo && CollocazioneArmadio=:collocazioneArmadio && CollocazioneScaffale=:collocazioneScaffale && IdGenere=:idGenere LIMIT 1";
        $stmt = $connector->prepare($returnIdquery);

        $stmt->bindParam(':titolo',$libro->Titolo,PDO::PARAM_STR);
        $stmt->bindParam(':isbn',$libro->ISBN,PDO::PARAM_STR);
        $stmt->bindParam(':idCasaEditrice',$libro->IdCasaEditrice,PDO::PARAM_STR);
        $stmt->bindParam(':annoPubblicazione',$libro->AnnoPubblicazione,PDO::PARAM_STR);
        $stmt->bindParam(':collocazioneLuogo',$libro->CollocazioneLuogo,PDO::PARAM_STR);
        $stmt->bindParam(':collocazioneArmadio',$libro->CollocazioneArmadio,PDO::PARAM_STR);
        $stmt->bindParam(':collocazioneScaffale',$libro->CollocazioneScaffale,PDO::PARAM_STR);
        $stmt->bindParam(':idGenere',$libro->IdGenere,PDO::PARAM_STR);
        $stmt->execute();
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        http_response_code(200);
        echo json_encode($element);
        return true;
    }

    http_response_code(503);
    echo json_encode(array("message" => "Impossibile aggiornare un libro."));
    return false;

    //non so come farlo
}

function Delete($id , $connector)
{
    //modified by Bonantini
    $query ="DELETE FROM Libri WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$id);

    $stmt->execute();


    if($stmt->execute()){

        http_response_code(200);
        echo $id;
        return true;
    }

    http_response_code(503);
    echo json_encode(array("message" => "Impossibile cancellare un libro."));
    return false;

}

?>
