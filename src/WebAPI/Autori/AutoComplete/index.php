/*[
  {
    "Value": "1",
    "Text": "Giovanni Verga"
  },
  {
    "Value": "2",
    "Text": "Alessandro Manzoni"
  },
  {
    "Value": "3",
    "Text": "Italo Svevo"
  }
]
*/
<?php

include'Common/connection.php';
$part= $_GET["text"];

$query= "SELECT autori.Id, autori.Nome, autori.Cognome FROM autori WHERE";

$stmt = $db->prepare($query);
$stmt->execute();
$element = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>