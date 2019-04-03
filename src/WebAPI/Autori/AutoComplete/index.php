
<?php

include 'connection.php';
$partName= "Manz";



    $query = "SELECT Id AS value, CONCAT(Cognome,' ',Nome) AS text FROM Autori WHERE CONCAT(Cognome,' ',Nome) LIKE '%".":part"."%' LIMIT 50";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(':part', $partName, PDO::PARAM_STR);

    $stmt->execute();
    $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($element);


?>