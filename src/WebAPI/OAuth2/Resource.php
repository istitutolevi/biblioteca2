<?php
$access_token= $_GET['token'];
//$access_token= "05a70b00df17fb5d4a217526b20aa0e127afbf57";
try {
    $hostname = "localhost";
    $dbname = "biblioteca";
    $user = "root";
    $pass = "";

    $db = new PDO ("mysql:host=$hostname;dbname=$dbname", $user, $pass);
}
catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die();
}
//phpinfo();
$sql = "SELECT `utenti`.Nome,`utenti`.Cognome,`utenti`.Mail,`utenti`.LivelloUtente FROM `oauth_access_tokens` JOIN `utenti` ON `utenti`.Id = `oauth_access_tokens`.user_id  WHERE `oauth_access_tokens`.access_token=:token";

$stmt = $db->prepare($sql);
$stmt->execute(['token' => $access_token]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows[0]);
//echo "<br>";
//foreach($rows as $row){
//echo $row['client_id'].'  '.$row['expires'];
//}
/*while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo '
' . $row['access_token'] . ' ' . $row['client_id'] . '
';
}
foreach($contatti as $value)
{
	echo "ciao";
	?>
	<div value="<?=$value['access_token']?>"><?=$value['access_token']?></div>
<?php
}*/
?>
