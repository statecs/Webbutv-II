<?php
header('Content-type: text/plain');
echo "\n";

//Skriver ut nycklar med värde som skickas in (_POST)
foreach($_POST as $key => $value){
	echo $key . " = " . $value . "\n";
  }

?>
