<?php
include 'BindingAutore.php';
include 'ViewAutore.php';
include '../Common/connection.php';


$method= $_SERVER['REQUEST_METHOD'];
$body= file_get_contents('php://input');
echo($body);

switch ($method) {
    case "GET":
        Read($_GET["autore"],$conn);
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

function Create($jsonAutore, $connector)
{

    $decode = json_decode($jsonAutore);


    $autore = new viewAutore($decode->Id,$decode->Nome,$decode->Cognome,$decode->DataDiNascita,$decode->DataDiMorte );
    $query ="INSERT INTO AUTORI (Nome,Cognome,DataNascita,DataMorte) VALUE (:nome,:cognome,:dataN,:dataM)";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':nome',$autore->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':cognome',$autore->Cognome,PDO::PARAM_STR);
    $stmt->bindParam(':dataN',$autore->DataNascita,PDO::PARAM_STR);
    $stmt->bindParam(':dataM',$autore->DataMorte,PDO::PARAM_STR);



    if($stmt->execute()){
        $returnIdquery ="SELECT Id from Autori WHERE Nome=:nome && Cognome=:cognome && DataNascita=:dataN && DataMorte=:dataM LIMIT 1";
        $stmt = $connector->prepare($returnIdquery);

        $stmt->bindParam(':nome',$autore->Nome,PDO::PARAM_STR);
        $stmt->bindParam(':cognome',$autore->Cognome,PDO::PARAM_STR);
        $stmt->bindParam(':dataN',$autore->DataNascita,PDO::PARAM_STR);
        $stmt->bindParam(':dataM',$autore->DataMorte,PDO::PARAM_STR);
        $stmt->execute();
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        http_response_code(201);
        echo json_encode($element);
    }

    http_response_code(503);
    echo json_encode(array("message" => "Impossibile creare un autore."));


}

function Read($jsonAutore, $connector)
{
    $decode = json_decode($jsonAutore, true);

    $autore = new bindingAutore($decode->Id,$decode->Nome,$decode->Cognome,$decode->NascitaDa,
                                $decode->NascitaA,$decode->MorteDa, $decode->MorteA );

    $query ="SELECT * FROM Autori WHERE Nome LIKE :nome /*&& Cognome LIKE :cognome || DataNascita BETWEEN :dataNDA AND :dataNA || DataMorte BETWEEN :dataMDA AND :dataMA*/";

    $stmt = $connector->prepare($query);

    $nome= $autore->Nome."%";
    //$cognome= "%".$autore->Cognome."%";
    //
    $stmt->bindParam(':nome',$nome,PDO::PARAM_STR);
    //$stmt->bindParam(':cognome',$cognome,PDO::PARAM_STR);
    //$stmt->bindParam(':dataNDA',$autore->NascitaDa,PDO::PARAM_STR);
    //$stmt->bindParam(':dataNA',$autore->NascitaA,PDO::PARAM_STR);
    //$stmt->bindParam(':dataMDA',$autore->MorteDa,PDO::PARAM_STR);
    //$stmt->bindParam(':dataMA',$autore->MorteA,PDO::PARAM_STR);



    if($stmt->execute()){

        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
        http_response_code(200);
        echo json_encode($element);

    }
    //http_response_code(404);
    //echo json_encode(
        //array("message" => "No autore trovato.")
    //);



}

function Update($jsonAutore, $connector)
{

    $decode = json_decode($jsonAutore);


    $autore = new viewAutore($decode->Id,$decode->Nome,$decode->Cognome,$decode->DataDiNascita,$decode->DataDiMorte );
    $query ="UPDATE Autori SET Nome=:nome, Cognome=:cognome, DataNascita=:dataN, DataMorte=:dataM WHERE Id=:id";
    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$autore->Id,PDO::PARAM_INT);
    $stmt->bindParam(':nome',$autore->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':cognome',$autore->Cognome,PDO::PARAM_STR);
    $stmt->bindParam(':dataN',$autore->DataNascita,PDO::PARAM_STR);
    $stmt->bindParam(':dataM',$autore->DataMorte,PDO::PARAM_STR);




    if($stmt->execute()){
        $returnIdquery ="SELECT Id from Autori WHERE Nome=:nome && Cognome=:cognome && DataNascita=:dataN && DataMorte=:dataM LIMIT 1";
        $stmt = $connector->prepare($returnIdquery);

        $stmt->bindParam(':nome',$autore->Nome,PDO::PARAM_STR);
        $stmt->bindParam(':cognome',$autore->Cognome,PDO::PARAM_STR);
        $stmt->bindParam(':dataN',$autore->DataNascita,PDO::PARAM_STR);
        $stmt->bindParam(':dataM',$autore->DataMorte,PDO::PARAM_STR);
        $stmt->execute();
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        http_response_code(200);
        echo json_encode($element);

    }

    http_response_code(503);
    echo json_encode(array("message" => "Impossibile aggiornare un genere."));

}

function Delete($id , $connector)
{
    $query ="DELETE FROM autori WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$id);

    if($stmt->execute()){


        http_response_code(200);
        echo 1;
    }

    //http_response_code(503);
    //echo json_encode(array("message" => "Impossibile cancellare un autore."));


}

?>
