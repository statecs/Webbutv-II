<?php
header('Content-type: text/plain');

//Lagrar variabler tillsammans med nyckel
$variables = array(
	'$_REQUEST' => $_REQUEST, 
	'$_GET' => $_GET,
    '$_SERVER' => $_SERVER, 
	'$_ENV' => $_ENV,
    '$_POST' => $_POST, 
);

//Skriver ut värden
foreach ($variables as $varkey => $global) {
    foreach ($global as $key => $value) {
        echo  $key . ': ' . $value . "\n";
    }
} 

?>
