
<?php

include '../Common/connection.php';
$partName= $_GET["text"];



    $query = "SELECT Id AS text FROM Generi WHERE Id LIKE :part LIMIT 20";
    $stmt = $conn->prepare($query);



    $stmt->execute(['part' => "%".$partName."%"]);
    $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($element);


?>
