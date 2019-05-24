<?php
include 'Utente.php';
require_once '../Common/connection.php';


$method= $_SERVER['REQUEST_METHOD'];
$body= file_get_contents('php://input');

/*switch ($method) {
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
}*/
$Utente=[
    'Username' => 'nick7',
    'Password' => 'pass8',
    'Id' => '',
    'Nome' => 'Alefsdssandro',
    'Cognome' => 'Bonagdsvfdsg',
    'Telefono' => '333215225',
    'Mail' => 'kompass@gmail.com',
    'DataDiNascita' => '1/12/2000',
    'Documento' => 'abc',
    'NumeroDocumento' => '1245AAS',
    'CodiceFiscale' => 'BNNLSN01T00A04',
    'Indirizzo' => 'Monteveglio',
    'Localita' => 'Bologna',
    'Provincia' => 'BO',
    'CAP' => '40050',
    'LivelloUtente' => '1',
];
//echo json_encode($Utente);
//Create(json_encode($Utente),$conn);
//la create funziona ma non va bene: remember to change -> oauth2 client se è già presente inserisce lo stesso l'utente
function Create($jsonUtente, $connector)
{

    $decode = json_decode($jsonUtente);

    $username=$decode->Username;
    $password=$decode->Password;
    $utente = new utente($decode->Id,$decode->Nome,$decode->Cognome,$decode->Telefono,$decode->Mail,$decode->DataDiNascita,$decode->Documento,$decode->NumeroDocumento,$decode->CodiceFiscale,$decode->Indirizzo,$decode->Localita,$decode->Provincia,$decode->CAP,0,$decode->LivelloUtente);
   //echo $utente->Localita;
    $query ="INSERT INTO `utenti` ( `Nome`, `Cognome`, `Telefono`, `Mail`, `DataDiNascita`, `Documento`, `NumeroDocumento`, `CodiceFiscale`, `Indirizzo`, `Localita`, `Provincia`, `CAP`,`LivelloUtente`, `Disabilitato`) VALUES ( :nome, :cognome, :telefono, :mail, :datadinascita, :documento, :numerodocumento, :codicefiscale, :indirizzo, :localita, :provincia, :cap, :livelloutente, :disabilitato)";
    //echo $query;
//`Nome`, `Cognome`, `Telefono`, `Mail`, `DataDiNascita`, `Documento`, `NumeroDocumento`, `CodiceFiscale`, `Indirizzo`, `Località`, `Provincia`, `CAP`, `Disabilitato`, `LivelloUtente`
//:nome, :cognome, :telefono, :mail, :datadinascita, :documento, :numerodocumento, :codicefiscale, :indirizzo, :localita, :provincia, :cap, :disabilitato, :livelloutente
    $stmt = $connector->prepare($query);
    $stmt->bindParam(':nome',$utente->Nome,PDO::PARAM_STR);
    $stmt->bindParam(':cognome',$utente->Cognome,PDO::PARAM_STR);
    $stmt->bindParam(':telefono',$utente->Telefono,PDO::PARAM_STR);
    $stmt->bindParam(':mail',$utente->Mail,PDO::PARAM_STR);
    $stmt->bindParam(':datadinascita',$utente->DataDiNascita,PDO::PARAM_STR);
    $stmt->bindParam(':documento',$utente->Documento,PDO::PARAM_STR);
    $stmt->bindParam(':numerodocumento',$utente->NumeroDocumento,PDO::PARAM_STR);
    $stmt->bindParam(':codicefiscale',$utente->CodiceFiscale,PDO::PARAM_STR);
    $stmt->bindParam(':indirizzo',$utente->Indirizzo,PDO::PARAM_STR);
    $stmt->bindParam(':localita',$utente->Localita,PDO::PARAM_STR);
    $stmt->bindParam(':provincia',$utente->Provincia,PDO::PARAM_STR);
    $stmt->bindParam(':cap',$utente->CAP,PDO::PARAM_STR);
    $stmt->bindParam(':disabilitato',$utente->Disabilitato,PDO::PARAM_STR);
    $stmt->bindParam(':livelloutente',$utente->LivelloUtente,PDO::PARAM_STR);




    if($stmt->execute()){
        $returnIdquery ="SELECT Id from utenti WHERE Nome=:nome && Cognome=:cognome ";/*&& Telefono=:telefono && Mail=:mail && DataDiNascita=:datadinascita && CodiceFiscale=:codicefiscale && Indirizzo=:indirizzo && Localita=:localita && Provincia=:provincia && CAP=:cap && LivelloUtente=:livelloutente && Disabilitato=:disabilitato LIMIT 1*/

        $stmt = $connector->prepare($returnIdquery);

        $stmt->bindParam(':nome',$utente->Nome,PDO::PARAM_STR);
        $stmt->bindParam(':cognome',$utente->Cognome,PDO::PARAM_STR);
        /*$stmt->bindParam(':telefono',$utente->Telefono,PDO::PARAM_STR);
        $stmt->bindParam(':mail',$utente->Mail,PDO::PARAM_STR);
        $stmt->bindParam(':datadinascita',$utente->DataDiNascita,PDO::PARAM_STR);
        $stmt->bindParam(':codicefiscale',$utente->CodiceFiscale,PDO::PARAM_STR);
        $stmt->bindParam(':indirizzo',$utente->Indirizzo,PDO::PARAM_STR);
        $stmt->bindParam(':localita',$utente->Localita,PDO::PARAM_STR);
        $stmt->bindParam(':provincia',$utente->Provincia,PDO::PARAM_STR);
        $stmt->bindParam(':cap',$utente->CAP,PDO::PARAM_STR);
        $stmt->bindParam(':disabilitato',$utente->Disabilitato,PDO::PARAM_STR);
        $stmt->bindParam(':livelloutente',$utente->LivelloUtente,PDO::PARAM_STR);*/

        $stmt->execute();
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        AddToOauth2($element[0]['Id'],$username,$password,$connector);

        http_response_code(201);
        echo json_encode($element);
        return true;
    }

    http_response_code(503);
    echo json_encode(array("message" => "Impossibile creare un utente."));
    return false;

}
function AddToOauth2($idUtente,$username,$password,$connector){

    $query ="INSERT INTO oauth_clients (client_id, client_secret, user_id) VALUE (:username,:password,:id)";

    $stmtO = $connector->prepare($query);

    $stmtO->bindParam(':id',$idUtente,PDO::PARAM_STR);
    $stmtO->bindParam(':password',$password,PDO::PARAM_STR);
    $stmtO->bindParam(':username',$username,PDO::PARAM_STR);
    if($stmtO->execute()){
        return true;
    }
    http_response_code(503);
    echo json_encode(array("message" => "Impossibile creare un utente."));
    return false;

}
//Read da testare e da completare
//$User=['username' => 'nick7'];
//Read(json_encode($User),$conn);
function Read($jsonUtente, $connector)
{
    $decode = json_decode($jsonUtente);

    $username=$decode->username;
    //$utente = new utente($decode->Id,$decode->Nome,$decode->Cognome,$decode->Telefono,$decode->Mail,$decode->DataDiNascita,$decode->Documento,$decode->NumeroDocumento,$decode->CodiceFiscale,$decode->Indirizzo,$decode->Localita,$decode->Provincia,$decode->CAP,0,$decode->LivelloUtente);

    $query ="SELECT Utenti.*,oauth_clients.client_id FROM Utenti JOIN oauth_clients ON oauth_clients.user_id=Utenti.Id WHERE client_id LIKE :client_id";

    $stmt = $connector->prepare($query);

    $usernamesearch= $username."%";

    $stmt->bindParam(':client_id',$usernamesearch,PDO::PARAM_STR);




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
//Update da provare
//Update($);
function Update($jsonUtente, $connector)
{
    $decode = json_decode($jsonUtente);
    $ControlField=$decode->ControlField;
    if($ControlField==0)
    {
        $utente = new utente($decode->Id,$decode->Nome,$decode->Cognome,$decode->Telefono,$decode->Mail,$decode->DataDiNascita,$decode->Documento,$decode->NumeroDocumento,$decode->CodiceFiscale,$decode->Indirizzo,$decode->Localita,$decode->Provincia,$decode->CAP,0,$decode->LivelloUtente);
        $query ="UPDATE Utenti SET Nome=:nome, Cognome=:cognome, Telefono=:telefono, Mail=:mail, DataDiNascita=:datadinascita, Documento=:documento, NumeroDocumento=:numerodocumento, CodiceFiscale=:codicefiscale, Indirizzo=:indirizzo, Localita=:localita, Provincia=:provincia, CAP=:cap, Disabilitato=:disabilitato, LivelloUtente=:livelloutente WHERE Id=:id";
//UPDATE CaseEditrici SET Nome=:nome, LuogoSede=:luogoSede WHERE Id=:id
        $stmt = $connector->prepare($query);
        $stmt->bindParam(':nome',$utente->Nome,PDO::PARAM_STR);
        $stmt->bindParam(':cognome',$utente->Cognome,PDO::PARAM_STR);
        $stmt->bindParam(':telefono',$utente->Telefono,PDO::PARAM_STR);
        $stmt->bindParam(':mail',$utente->Mail,PDO::PARAM_STR);
        $stmt->bindParam(':datadinascita',$utente->DataDiNascita,PDO::PARAM_STR);
        $stmt->bindParam(':documento',$utente->Documento,PDO::PARAM_STR);
        $stmt->bindParam(':numerodocumento',$utente->NumeroDocumento,PDO::PARAM_STR);
        $stmt->bindParam(':codicefiscale',$utente->CodiceFiscale,PDO::PARAM_STR);
        $stmt->bindParam(':indirizzo',$utente->Indirizzo,PDO::PARAM_STR);
        $stmt->bindParam(':localita',$utente->Localita,PDO::PARAM_STR);
        $stmt->bindParam(':provincia',$utente->Provincia,PDO::PARAM_STR);
        $stmt->bindParam(':cap',$utente->CAP,PDO::PARAM_STR);
        $stmt->bindParam(':disabilitato',$utente->Disabilitato,PDO::PARAM_STR);
        $stmt->bindParam(':livelloutente',$utente->LivelloUtente,PDO::PARAM_STR);

        if($stmt->execute()){
            $returnIdquery ="SELECT Id from Utenti WHERE Nome=:nome && Cognome=:cognome LIMIT 1";
            $stmt = $connector->prepare($returnIdquery);

            $stmt->bindParam(':nome',$utente->Nome,PDO::PARAM_STR);
            $stmt->bindParam(':cognome',$utente->Cognome,PDO::PARAM_STR);

            $stmt->execute();
            $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

            http_response_code(200);
            echo json_encode($element);
            return true;
        }

        http_response_code(503);
        echo json_encode(array("message" => "Impossibile aggiornare un utente."));
        return false;


    }
    else
        {
            $username=$decode->Username;
            $password=$decode->Password;
            $client_id_old=$decode->OldClientId;
            if(UpdateToOauth2($username,$password,$client_id_old,$connector)){
                http_response_code(201);
                echo json_encode($User=['username' => $username]);
                return true;

            }

            http_response_code(503);
            echo json_encode(array("message" => "Impossibile creare un utente."));
            return false;

    }


}
function UpdateToOauth2($username,$password,$oldClientId,$connector)
{
    $query = "UPDATE oauth_clients SET client_id=:username, client_secret=:password WHERE client_id=:client_id";

    $stmtO = $connector->prepare($query);

    $stmtO->bindParam(':password',$password,PDO::PARAM_STR);
    $stmtO->bindParam(':username',$username,PDO::PARAM_STR);
    $stmtO->bindParam(':client_id',$$oldClientId,PDO::PARAM_STR);
    if($stmtO->execute()){
        return true;
    }
    http_response_code(503);
    echo json_encode(array("message" => "Impossibile creare un utente."));
    return false;

}
//delete da testare
function Delete($id , $connector)
{
    $query ="DELETE FROM Utenti WHERE Id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$id);




    if($stmt->execute()){

        DeleteFromOauth2($id,$connector);
        http_response_code(200);
        echo $id;
        return true;
    }

    http_response_code(503);
    echo json_encode(array("message" => "Impossibile cancellare un utente."));
    return false;
}
function DeleteFromOauth2($id,$connector){
    $query ="DELETE FROM oauth_clients WHERE user_id=:id";

    $stmt = $connector->prepare($query);

    $stmt->bindParam(':id',$id);




    if($stmt->execute()){


        http_response_code(200);
        echo $id;
        return true;
    }

    http_response_code(503);
    echo json_encode(array("message" => "Impossibile cancellare un utente."));
    return false;
}
?>
