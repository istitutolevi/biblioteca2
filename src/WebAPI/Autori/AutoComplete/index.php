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

include 'connection.php';
$partName= "manz";



    $query = "SELECT Id, Nome, Cognome FROM Autori WHERE Cognome + ' ' + Nome LIKE :part LIMIT 50";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':part', $partName, PDO::PARAM_STR);
    $stmt->execute();
    $element = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>