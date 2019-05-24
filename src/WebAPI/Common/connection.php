<?php
/**
 * Created by PhpStorm.
 * User: Mattia John
 * Date: 29/03/2019
 * Time: 09:48
 */

$servername = "localhost";
$username = "root";
$password = "";
$db = "biblioteca";

// Check connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db;L charset=UTF8", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
    die();
}


?>
