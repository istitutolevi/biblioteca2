<?php
include 'autore.php';
require 'C:/xampp/htdocs/biblioteca2/src/WebAPI/Common/connection.php';

$jA= "{
  \"Autore\":{
  \"Id\":1,
	\"Nome\":\"Luigi\",
	\"Cognome\":\"Pirandello\",
  \"DataDiNascita\":\"1867-10-15\",
  \"DataDiMorte\":\"1936-12-10\"

}
}
";
Create($jA);
function Create($jsonAutore)
{

    $decode = json_decode($jsonAutore);


    $autore = new autore($decode->Autore->Id,$decode->Autore->Nome,$decode->Autore->Cognome,$decode->Autore->DataDiNascita,$decode->Autore->DataDiMorte );

    $query ="INSERT INTO AUTORI (Id,Nome,Cognome,DataNascita,DataMorte) VALUE (:id,:nome,:cognome,:dataN,:dataM)";
    $stmt->bindParam(':id',$autore->Id,PDO::PARAM_INT);
    $stmt->bindParam(':nome',$autore->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':cognome',$autore->Cognome,PDO::PARAM_STR);
    $stmt->bindParam(':dataN',$autore->DataNascita,PDO::PARAM_STR);
    $stmt->bindParam(':dataM',$autore->DataMorte,PDO::PARAM_STR);
    $stmt->execute();


    $stmt = $conn->prepare($query);



    // bind values
    /*$stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":category_id", $this->category_id);
    $stmt->bindParam(":created", $this->created);*/

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;


}

function Read()
{



}

function Update()
{



}

function Delete()
{



}

?>