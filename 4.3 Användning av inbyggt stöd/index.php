<?php

session_start();
//Om session redan existerar genererar ny
if(isset($_SESSION['session-id'])) {
    unset($_SESSION['session-id']);
    session_regenerate_id();
} 
//Sätter $_SESSION till session_id
$_SESSION['session-id'] = session_id();
$html = file_get_contents("template.html");
$html = str_replace('---session-id---', $_SESSION["session-id"], $html);
echo $html;

?>
