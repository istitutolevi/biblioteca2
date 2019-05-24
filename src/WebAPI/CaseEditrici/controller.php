<?php
include 'casaEditrice.php';
require_once '../Common/connection.php';

$method= $_SERVER['REQUEST_METHOD'];
$body= file_get_contents('php://input');

switch ($method) {
    case "GET":
        Read($_GET["id"], $_GET["nome"], $_GET["luogoSede"],$conn);
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


function Create($jsonCasaEditrice, $connector)
{

    $decode = json_decode($jsonCasaEditrice);


    $casaEditrice = new casaEditrice($decode->Id,$decode->Nome,$decode->Luogo);
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

        http_response_code(201);
        echo json_encode($element);
        return true;
    }

    http_response_code(503);
    echo json_encode(array("message" => "Impossibile creare un casa editrice."));
    return false;


}

function Read($id, $nome, $luogoSede, $connector)
{



  if ($id == "") {
      $query ="SELECT * FROM CaseEditrici WHERE Nome LIKE :nome /*&& LuogoSede LIKE :luogosede*/";
      $stmt = $connector->prepare($query);

      $nomeSearch= $nome."%";
      //$luogoSearch= $luogo."%";

      $stmt->bindParam(':nome',$nomeSearch,PDO::PARAM_STR);
      //$stmt->bindParam(':luogosede',$luogoSearch,PDO::PARAM_STR);

    }
    else {
      $query ="SELECT * FROM CaseEditrici WHERE Id = :id";
      $stmt = $connector->prepare($query);

      $stmt->bindParam(':id',$id,PDO::PARAM_INT);

    }

  if($stmt->execute()){

      $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
      http_response_code(200);
      echo json_encode($element, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
      return true;

  }
  http_response_code(404);
  echo json_encode(
      array("message" => "No Casa trovata.")

  );
  return false;

}

function Update($jsonCasaEditrice, $connector)
{
    $decode = json_decode($jsonCasaEditrice);


    $casaEditrice = new casaEditrice($decode->Id,$decode->Nome,$decode->Luogo);
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

    $query ="DELETE FROM CaseEditrici WHERE Id=:id";

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
