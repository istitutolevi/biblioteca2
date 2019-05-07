<?php
include 'casaEditrice.php';
require_once '../Common/connection.php';

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


function Create($jsonCasaEditrice, $connector)
{

    $decode = json_decode($jsonCasaEditrice);


    $casaEditrice = new casaEditrice($decode->CasaEditrice->Id,$decode->CasaEditrice->Nome,$decode->CasaEditrice->Luogo);
    $query ="INSERT INTO CaseEditrici (Nome,LuogoSede) VALUE (:nome,:luogoSede)";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':nome',$casaEditrice->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':luogoSede',$casaEditrice->Luogo,PDO::PARAM_STR);




    if($stmt->execute()){
        $returnIdquery ="SELECT Id from CaseEditrici WHERE Nome=:nome && LuogoSede=:luogoSede LIMIT 1";
        $stmt = $connector->prepare($returnIdquery);

        $stmt->bindParam(':nome',$casaEditrice->Nome,PDO::PARAM_STR);
        $stmt->bindParam(':luogoSede',$casaEditrice->Luogo,PDO::PARAM_STR);
        $stmt->execute();
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($element);
        return true;
    }

    echo "Add false";
    return false;


}

function Read($jsonCasaEditrice, $connector)
{
    $decode = json_decode($jsonCasaEditrice);


    $casaEditrice = new casaEditrice($decode->CasaEditrice->Id,$decode->CasaEditrice->Nome,$decode->CasaEditrice->Luogo);
    $query ="SELECT * FROM CaseEditrici WHERE Nome=:nome && LuogoSede=:luogoSede";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':nome',$casaEditrice->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':luogoSede',$casaEditrice->Luogo,PDO::PARAM_STR);



    if($stmt->execute()){

        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($element);
        return true;
    }

    echo "Read false";
    return false;



}

function Update($jsonCasaEditrice, $connector)
{
    $decode = json_decode($jsonCasaEditrice);


    $casaEditrice = new casaEditrice($decode->CasaEditrice->Id,$decode->CasaEditrice->Nome,$decode->CasaEditrice->Luogo);
    $query ="UPDATE CaseEditrici SET Nome=:nome, LuogoSede=:luogoSede WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$casaEditrice->Id,PDO::PARAM_INT);
    $stmt->bindParam(':nome',$casaEditrice->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':luogoSede',$casaEditrice->Luogo,PDO::PARAM_STR);




    if($stmt->execute()){
        $returnIdquery ="SELECT Id from CaseEditrici WHERE Nome=:nome && LuogoSede=:luogoSede LIMIT 1";
        $stmt = $connector->prepare($returnIdquery);

        $stmt->bindParam(':nome',$casaEditrice->Nome,PDO::PARAM_STR);
        $stmt->bindParam(':luogoSede',$casaEditrice->Luogo,PDO::PARAM_STR);
        $stmt->execute();
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($element);
        return true;
    }

    echo "Add false";
    return false;


}

function Delete($id , $connector)
{
    $idDelete= json_decode($id);
    $query ="DELETE FROM CaseEditrici WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$idDelete);




    if($stmt->execute()){


        echo "Remove true";
        return true;
    }

    echo "Remove false";
    return false;


}

?>
