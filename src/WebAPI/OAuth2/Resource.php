<?php
$access_token= $_GET['token'];
//$access_token= "05a70b00df17fb5d4a217526b20aa0e127afbf57";
try {
    $hostname = "localhost";
    $dbname = "my_oauth2_db";
    $user = "root";
    $pass = "";
    
    $db = new PDO ("mysql:host=$hostname;dbname=$dbname", $user, $pass);
}
catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die();
}
//phpinfo();
$sql = "SELECT `oauth_access_tokens`.client_id,`oauth_access_tokens`.expires FROM `oauth_access_tokens` WHERE `oauth_access_tokens`.access_token=:token";

$stmt = $db->prepare($sql);
$stmt->execute(['token' => $access_token]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows);
echo "<br>";
foreach($rows as $row){
echo $row['client_id'].'  '.$row['expires'];
}
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