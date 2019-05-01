<?php

$isbn= '9788804671657';
$url = "https://www.googleapis.com/books/v1/volumes?q=isbn:".$isbn;
// to check your proxy
$proxy = '192.168.152.1:808';

// create curl resource
$ch = curl_init();

// set options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_PROXY, $proxy); // da mettere a commento se non si utilizza il proxy
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

// $output contains the output string
$output = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);
$json = json_decode($output,true);

//creazione variabili informazioni libro
$titolo = $json['items']['0']['volumeInfo']['title'];
$genere = $json['items']['0']['volumeInfo']['subtitle'];
$autore = $json['items']['0']['volumeInfo']['authors'][0];
$casaEditrice = $json['items']['0']['volumeInfo']['publisher'];
$dataPubblicazione = $json['items']['0']['volumeInfo']['publishedDate'];
$descrizione = $json['items']['0']['volumeInfo']['description'];
$pagine = $json['items']['0']['volumeInfo']['pageCount'];

//array con tutte le informazioni del libro
$libro = [
    'titolo' => "$titolo",
    'libro' => "$genere",
    'autore' => "$autore",
    'CasaEditrice' => "$casaEditrice",
    'dataPubblicazione' => "$dataPubblicazione",
    'Descrizione' => "$descrizione",
    'Pagine' => "$pagine"
];
echo json_encode($libro);


?>
