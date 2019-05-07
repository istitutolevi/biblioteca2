<?php
include 'BindingAutore.php';
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

function Create($jsonAutore, $connector)
{

    $decode = json_decode($jsonAutore);


    $autore = new viewAutore($decode->Autore->Id,$decode->Autore->Nome,$decode->Autore->Cognome,$decode->Autore->DataDiNascita,$decode->Autore->DataDiMorte );
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

        echo $element;
        return true;
    }

    echo -1;
    return false;


}

function Read($jsonAutore, $connector)
{
    $decode = json_decode($jsonAutore);


    $autore = new bindingAutore($decode->Id,$decode->Nome,$decode->Cognome,$decode->NascitaDa,
                                $decode->NascitaA,$decode->MorteDa, $decode->MorteA );
    $query ="SELECT * FROM Autori WHERE Nome LIKE :nome && Cognome LIKE :cognome && (BETWEEN :dataNDA && :dataNA) && (BETWEEN :dataMDA && :dataMA)";

    $stmt = $connector->prepare($query);

    $nome= "%".$autore->Nome."%";
    $cognome= "%".$autore->Cognome."%";

    $stmt->bindParam(':nome',$nome,PDO::PARAM_STR);
    $stmt->bindParam(':cognome',$cognome,PDO::PARAM_STR);
    $stmt->bindParam(':dataNDa',$autore->NascitaDa,PDO::PARAM_STR);
    $stmt->bindParam(':dataNA',$autore->NascitaA,PDO::PARAM_STR);
    $stmt->bindParam(':dataMDa',$autore->MorteDa,PDO::PARAM_STR);
    $stmt->bindParam(':dataMA',$autore->MorteA,PDO::PARAM_STR);
    $stmt->execute();


    if($stmt->execute()){

        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($element);
        return true;
    }

    echo "Read false ";
    return false;



}

function Update($jsonAutore, $connector)
{

    $decode = json_decode($jsonAutore);


    $autore = new viewAutore($decode->Autore->Id,$decode->Autore->Nome,$decode->Autore->Cognome,$decode->Autore->DataDiNascita,$decode->Autore->DataDiMorte );
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

        echo $element;
        return true;
    }

    echo "Add false";
    return false;

}

function Delete($id , $connector)
{
    $query ="DELETE FROM autori WHERE Id=:id";

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