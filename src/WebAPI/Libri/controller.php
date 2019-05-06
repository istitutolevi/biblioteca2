<?php
include 'Libro.php';
require_once 'C:/xampp/htdocs/biblioteca2/src/WebAPI/Common/connection.php';

$method= $_SERVER['REQUEST_METHOD'];
$body= file_get_contents('php://input');

switch ($method) {
    case "GET":
        Read($body,$conn);
        break;
    case "POST":
        Update($body,$conn);
        break;
    case "PUT":
        Create($body,$conn);
        break;
    case "DELETE":
        Delete($body, $conn);
        break;
    default:
        echo "Not Method Found";
        break;
}


function Create($jsonLibro, $connector)
{
    //modified by Bonantini
    //  $Id;
    //  $Titolo;
    //  $ISBN;
    //  $Codice;
    //  $IdCasaEditrice;
    //  $AnnoPubblicazione;
    //  $CollocazioneLuogo;
    //  $CollocazioneArmadio;
    //  $CollocazioneScaffale;
    //  $Stato;
    //  $IdUtentePrestito;
    //  $DataInizioPresito;
    //  $DataFinePrestitoPrevista;
    //  $IdGenere;

    $decode = json_decode($jsonLibro);


    $libro = new libro($decode->Libro->Id,$decode->Libro->Titolo,$decode->Libro->ISBN,$decode->Libro->Codice,$decode->Libro->IdCasaEditrice,$decode->Libro->AnnoPubblicazione,$decode->Libro->CollocazioneLuogo,$decode->Libro->CollocazioneArmadio,$decode->Libro->CollocazioneScaffale,$decode->Libro->Stato,$decode->Libro->IdUtentePrestito,$decode->Libro->DataInizioPrestito,$decode->Libro->DataFinePrestitoPrevista,$decode->Libro->IdGenere);
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

    $stmt->execute();


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

        echo $element;
        return true;
    }

    echo "Add false";
    return false;


}

//ballestrazzi
function Read($jsonBindingLibro, $connector)
{
    //modified by Bonantini





    $query ="SELECT Libri.*,Autori.* FROM Libri JOIN LibriAutori ON :id=LibriAutori.IdLibro JOIN Autori ON Autori.Id=LibriAutori.IdAutori WHERE Libri.id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$id,PDO::PARAM_STR);



    if($stmt->execute()){

        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($element);
        return true;
    }

    echo "Read false";
    return false;




}

function Update($jsonLibro, $connector)
{
   //modified by Bonantini
    $decode = json_decode($jsonLibro);


    $libro = new libro($decode->Libro->Id,$decode->Libro->Titolo,$decode->Libro->ISBN,$decode->Libro->Codice,$decode->Libro->IdCasaEditrice,$decode->Libro->AnnoPubblicazione,$decode->Libro->CollocazioneLuogo,$decode->Libro->CollocazioneArmadio,$decode->Libro->CollocazioneScaffale,$decode->Libro->Stato,$decode->Libro->IdUtentePrestito,$decode->Libro->DataInizioPrestito,$decode->Libro->DataFinePrestitoPrevista,$decode->Libro->IdGenere);
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

        echo json_encode($element);
        return true;
    }

    echo "Add false";
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


        echo "Remove true";
        return true;
    }

    echo "Remove false";
    return false;


}

?>