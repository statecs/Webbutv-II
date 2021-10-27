<?php

require 'vendor/autoload.php';  
// Creating Connection  
$con = new MongoDB\Client("mongodb://localhost:27017");  
// Creating Database  
$db = $con->nosql;  
// Creating Document  
$collection = $db->logging;  
// Insering Record  
$collection->insertOne( [ 'data' => 'log', 'TID' => $now->format('Y-m-d H:i:s'), 'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'], 'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT']  ] );  
// Fetching Record  
$record = $collection->find( [ 'data' =>'log'] );  

foreach ($record as $logging) {  
    echo $logging['TID'], ' <br> ', $logging['REMOTE_ADDR']."<br>", $logging['HTTP_USER_AGENT']."<br>";  
}  

?>
