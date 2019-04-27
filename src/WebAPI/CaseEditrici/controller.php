<?php
include 'casaEditrice.php';
require_once 'C:/xampp/htdocs/biblioteca2/src/WebAPI/Common/connection.php';



$jC= "{
  \"CasaEditrice\":{
  \"Id\":1,
	\"Nome\":\"Mondadori\",
	\"LuogoSede\":\"Milano\"

}
}

";


function Create($jsonCasaEditrice, $connector)
{

    $decode = json_decode($jsonCasaEditrice);


    $casaEditrice = new genere($decode->CasaEditrice->Id,$decode->CasaEditrice->Nome,$decode->CasaEditrice->LuogoSede);
    $query ="INSERT INTO CaseEditrici (Nome,LuogoSede) VALUE (:nome,:luogoSede)";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':nome',$casaEditrice->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':luogoSede',$casaEditrice->LuogoSede,PDO::PARAM_STR);




    if($stmt->execute()){
        $returnIdquery ="SELECT Id from CaseEditrici WHERE Nome=:nome && LuogoSede=:luogoSede LIMIT 1";
        $stmt = $connector->prepare($returnIdquery);

        $stmt->bindParam(':nome',$casaEditrice->Nome,PDO::PARAM_STR);
        $stmt->bindParam(':luogoSede',$casaEditrice->LuogoSede,PDO::PARAM_STR);
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


    $casaEditrice = new genere($decode->CasaEditrice->Id,$decode->CasaEditrice->Nome,$decode->CasaEditrice->LuogoSede);
    $query ="SELECT * FROM CaseEditrici WHERE Nome=:nome && LuogoSede=:luogoSede";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':nome',$casaEditrice->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':luogoSede',$casaEditrice->LuogoSede,PDO::PARAM_STR);



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


    $casaEditrice = new genere($decode->CasaEditrice->Id,$decode->CasaEditrice->Nome,$decode->CasaEditrice->LuogoSede);
    $query ="UPDATE CaseEditrici SET Nome=:nome, LuogoSede=:luogoSede WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$casaEditrice->Id,PDO::PARAM_INT);
    $stmt->bindParam(':nome',$casaEditrice->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':luogoSede',$casaEditrice->LuogoSede,PDO::PARAM_STR);




    if($stmt->execute()){
        $returnIdquery ="SELECT Id from CaseEditrici WHERE Nome=:nome && LuogoSede=:luogoSede LIMIT 1";
        $stmt = $connector->prepare($returnIdquery);

        $stmt->bindParam(':nome',$casaEditrice->Nome,PDO::PARAM_STR);
        $stmt->bindParam(':luogoSede',$casaEditrice->LuogoSede,PDO::PARAM_STR);
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
    $query ="DELETE FROM CaseEditrici WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$id);




    if($stmt->execute()){


        echo "Remove true";
        return true;
    }

    echo "Remove false";
    return false;


}

?>