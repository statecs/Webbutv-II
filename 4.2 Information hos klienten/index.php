<?php

//Skapa session-id som sedan sparas i en kaka
$cookie = "session-id";
$cookie_value = rand();
//Sätter tidslängden till 3h
setcookie($cookie, $cookie_value, time() + (3600 * 3), "/"); 

$html = file_get_contents("template.html");
$html = str_replace('---session-id---', $cookie_value, $html);
echo $html;

?>
