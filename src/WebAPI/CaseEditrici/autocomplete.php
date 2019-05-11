
<?php

include '../Common/connection.php';
$partName= $_GET["text"];



    $query = "SELECT Id AS value, Nome as text FROM CaseEditrici WHERE Nome LIKE :part LIMIT 10";
    $stmt = $conn->prepare($query);



    $stmt->execute(['part' => "%".$partName."%"]);
    $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($element);


?>
