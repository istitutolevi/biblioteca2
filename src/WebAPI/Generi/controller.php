<?php
include 'Genere.php';
require_once 'C:/xampp/htdocs/biblioteca2/src/WebAPI/Common/connection.php';



$jC= "{
  \"Genere\":{
  \"Id\":\"Fantasy\",
	

}
}

";


function Create($jsonGenere, $connector)
{

    $decode = json_decode($jsonGenere);


    $genere = new genere($decode->Genere->Id);
    $query ="INSERT INTO Generi (Id) VALUE (:id)";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$genere->Id,PDO::PARAM_STR);





    if($stmt->execute()){
        $returnIdquery ="SELECT Id from Generi WHERE Id=:id LIMIT 1";
        $stmt = $connector->prepare($returnIdquery);

        $stmt->bindParam(':id',$genere->Id,PDO::PARAM_STR);

        $stmt->execute();
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($element);
        return true;
    }

    echo -1;
    return false;


}

function Read($jsonGenere, $connector)
{
    $decode = json_decode($jsonGenere);


    $genere = new genere($decode->Genere->Id);
    $query ="SELECT * FROM Generi WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$genere->Id,PDO::PARAM_STR);




    if($stmt->execute()){

        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($element);
        return true;
    }

    echo -1;
    return false;



}

function Update($jsonGenere, $connector)
{
    $decode = json_decode($jsonGenere);


    $genere = new genere($decode->Genere->Id);
    $query ="UPDATE Generi SET Id=:id WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$genere->Id,PDO::PARAM_INT);





    if($stmt->execute()){
        $returnIdquery ="SELECT Id from Generi WHERE Id=:id LIMIT 1";
        $stmt = $connector->prepare($returnIdquery);

        $stmt->bindParam(':nome',$genere->Id,PDO::PARAM_STR);

        $stmt->execute();
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($element);
        return true;
    }

    echo -1;
    return false;


}

function Delete($id , $connector)
{
    $query ="DELETE FROM Generi WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$id);




    if($stmt->execute()){


        echo 1;
        return true;
    }

    echo -1;
    return false;


}

?>