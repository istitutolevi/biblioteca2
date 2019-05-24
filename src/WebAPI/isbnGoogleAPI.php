<?php

$isbn= "9788893675253";//file_get_contents('php://input');
echo $isbn;
$url = "https://www.googleapis.com/books/v1/volumes?q=isbn:".$isbn;
// to check your proxy
$proxy = '192.168.153.1:808';

// create curl resource
$ch = curl_init();

// set options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_PROXY, $proxy); // da mettere a commento se non si utilizza il proxy
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// $output contains the output string
$output = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);
$json = json_decode($output,true);
$libro = $json['items']['0']['volumeInfo'];
echo json_encode($libro);

?>
