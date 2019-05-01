<?php
include 'BindingAutore.php';
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


    $autore = new bindingAutore($decode->Autore->Id,$decode->Autore->Nome,$decode->Autore->Cognome,$decode->Autore->DataDiNascitaDa,
                                $decode->Autore->DataDiNascitaA,$decode->Autore->DataDiMorteDa, $decode->Autore->DataDiMorteA );
    $query ="SELECT * FROM Autori WHERE Nome=:nome && Cognome=:cognome && (BETWEEN :dataNDA && :dataNA) && (BETWEEN :dataMDA && :dataMA)";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':nome',$autore->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':cognome',$autore->Cognome,PDO::PARAM_STR);
    $stmt->bindParam(':dataNDa',$autore->DataNascitaDa,PDO::PARAM_STR);
    $stmt->bindParam(':dataNA',$autore->DataNascitaA,PDO::PARAM_STR);
    $stmt->bindParam(':dataMDa',$autore->DataMorteDa,PDO::PARAM_STR);
    $stmt->bindParam(':dataMA',$autore->DataMorteA,PDO::PARAM_STR);
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