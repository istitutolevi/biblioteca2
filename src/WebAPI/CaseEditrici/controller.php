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
Create($jC,$conn);
function Create($jsonCasaEditrice, $connector)
{

    $decode = json_decode($jsonCasaEditrice);


    $casaEditrice = new casaEditrice($decode->CasaEditrice->Id,$decode->CasaEditrice->Nome,$decode->CasaEditrice->LuogoSede);
    $query ="INSERT INTO CaseEditrici (Nome,LuogoSede) VALUE (:nome,:luogoSede)";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':nome',$casaEditrice->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':luogoSede',$casaEditrice->LuogoSede,PDO::PARAM_STR);

    $stmt->execute();


    if($stmt->execute()){
        $returnIdquery ="SELECT Id from CaseEditrici WHERE Nome=:nome && LuogoSede=:luogoSede LIMIT 1";
        $stmt = $connector->prepare($returnIdquery);

        $stmt->bindParam(':nome',$casaEditrice->Nome,PDO::PARAM_STR);
        $stmt->bindParam(':luogoSede',$casaEditrice->LuogoSede,PDO::PARAM_STR);
        $stmt->execute();
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo $element;
        return true;
    }

    echo "Add false";
    return false;


}

function Read($jsonAutore, $connector)
{
    $decode = json_decode($jsonAutore);


    $casaEditrice = new casaEditrice($decode->Autore->Id,$decode->Autore->Nome,$decode->Autore->Cognome,$decode->Autore->DataDiNascita,$decode->Autore->DataDiMorte );
    $query ="SELECT * FROM CaseEditrici WHERE Nome=:nome && LuogoSede=:luogoSede";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':nome',$casaEditrice->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':luogoSede',$casaEditrice->LuogoSede,PDO::PARAM_STR);
    $stmt->execute();


    if($stmt->execute()){
        echo "Update true";
        return true;
    }

    echo "Update false";
    return false;



}

function Update($jsonAutore, $connector)
{

   //non so come farlo
}

function Delete($id , $connector)
{
    $query ="DELETE FROM CaseEditrici WHERE Id=:id";

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