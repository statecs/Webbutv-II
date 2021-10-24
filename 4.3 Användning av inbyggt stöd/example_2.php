<?php
session_start();

header('Content-type: text/plain');
echo "\n";

//Skriver ut nycklar med värde som skickas in (_GET)
foreach($_GET as $key => $value){
	echo $key . " = " . $value . "\n";
}
//Skriver ut session-id
echo "session-id = " . $_SESSION["session-id"];

?>
