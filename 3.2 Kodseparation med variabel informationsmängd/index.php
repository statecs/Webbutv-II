<?php

//Lagrar variabler tillsammans med nyckel
$variables = array(
	'$_REQUEST' => $_REQUEST, 
	'$_GET' => $_GET,
    '$_SERVER' => $_SERVER, 
	'$_ENV' => $_ENV,
    '$_POST' => $_POST, 
);

//Läser in HTML
$html = file_get_contents("template.html");

//Använder metoden explode för att dela upp HTML-koden i tre delar
$html_pieces = explode('<!--===xxx===-->',$html);

//Lagrar den del av htmlen som ska ersättas dvs tabell-delen
$html_string = $html_pieces[1];

//Rensar den del som ska skrivas om;
$html_pieces[1] = "";

//Ersätter den del som där varje klobalvärde ska in
foreach ($variables as $varkey => $global) {
    foreach ($global as $key => $value) {
		$temp_string = $html_string;
		$temp_string = str_replace('---name---', $key, $temp_string);
		$temp_string = str_replace('---value---', $value, $temp_string);
        $html_pieces[1] = $html_pieces[1] . $temp_string;
    }
}

//Skriver ut html-elementen
for ($x = 0; $x <= 2; $x++) {
    echo $html_pieces[$x];
} 

?>
