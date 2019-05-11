<?php
include 'Genere.php';
require_once '../Common/connection.php';


$method= $_SERVER['REQUEST_METHOD'];
$body= file_get_contents('php://input');

switch ($method) {
    case "GET":
       Read($_GET["genere"],$conn);

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


function Create($jsonGenere, $connector)
{

    $decode = json_decode($jsonGenere);


    $genere = new genere($decode->Id);
    $query ="INSERT INTO Generi (Id) VALUE (:id)";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$genere->Id,PDO::PARAM_STR);





    if($stmt->execute()){
        $returnIdquery ="SELECT Id from Generi WHERE Id=:id LIMIT 1";
        $stmt = $connector->prepare($returnIdquery);

        $stmt->bindParam(':id',$genere->Id,PDO::PARAM_STR);

        $stmt->execute();
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        http_response_code(201);
        echo json_encode($element);
        return true;
    }

    http_response_code(503);
    echo json_encode(array("message" => "Impossibile creare un genere."));
    return false;

}

function Read($jsonGenere, $connector)
{
    $decode = json_decode($jsonGenere);


    $genere = new genere($decode->Id);
    $query ="SELECT * FROM Generi WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$genere->Id,PDO::PARAM_STR);




    if($stmt->execute()){

        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        http_response_code(200);
        echo json_encode($element);
        return true;
    }
    http_response_code(404);
    echo json_encode(
        array("message" => "No genere trovato.")
    );
    return false;


}

function Update($jsonGenere, $connector)
{
    $decode = json_decode($jsonGenere);


    $genere = new genere($decode->Id);
    $query ="UPDATE Generi SET Id=:id WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$genere->Id,PDO::PARAM_INT);





    if($stmt->execute()){
        $returnIdquery ="SELECT Id from Generi WHERE Id=:id LIMIT 1";
        $stmt = $connector->prepare($returnIdquery);

        $stmt->bindParam(':nome',$genere->Id,PDO::PARAM_STR);

        $stmt->execute();
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        http_response_code(200);
        echo json_encode($element);
        return true;
    }

    http_response_code(503);
    echo json_encode(array("message" => "Impossibile aggiornare un genere."));
    return false;

}

function Delete($id , $connector)
{
    $query ="DELETE FROM Generi WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$id);




    if($stmt->execute()){


        http_response_code(200);
        echo $id;
        return true;
    }

    http_response_code(503);
    echo json_encode(array("message" => "Impossibile cancellare un genere."));
    return false;
}

?>
