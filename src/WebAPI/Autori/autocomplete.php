
<?php

include 'C:/xampp/htdocs/biblioteca2/src/WebAPI/Common/connection.php';
$partName= $_GET["text"];



    $query = "SELECT Id AS value, CONCAT(Cognome,' ',Nome) AS text FROM Autori WHERE CONCAT(Cognome,' ',Nome) LIKE :part LIMIT 50";
    $stmt = $conn->prepare($query);



    $stmt->execute(['part' => "%".$partName."%"]);
    $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($element);


?>
