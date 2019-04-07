<?php
include 'autore.php';
require_once 'C:/xampp/htdocs/biblioteca2/src/WebAPI/Common/connection.php';



$jA= "{
  \"Autore\":{
  \"Id\":1,
	\"Nome\":\"Alessandro\",
	\"Cognome\":\"Manzoni\",
  \"DataDiNascita\":\"1824-12-1\",
  \"DataDiMorte\":\"1872-6-10\"

}
}
";
Create($jA,$conn);
function Create($jsonAutore, $connector)
{

    $decode = json_decode($jsonAutore);


    $autore = new autore($decode->Autore->Id,$decode->Autore->Nome,$decode->Autore->Cognome,$decode->Autore->DataDiNascita,$decode->Autore->DataDiMorte );
    $query ="INSERT INTO AUTORI (Nome,Cognome,DataNascita,DataMorte) VALUE (:nome,:cognome,:dataN,:dataM)";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':nome',$autore->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':cognome',$autore->Cognome,PDO::PARAM_STR);
    $stmt->bindParam(':dataN',$autore->DataNascita,PDO::PARAM_STR);
    $stmt->bindParam(':dataM',$autore->DataMorte,PDO::PARAM_STR);
    $stmt->execute();


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

function Read()
{



}

function Update()
{



}

function Delete($id , $connector)
{



}

?>