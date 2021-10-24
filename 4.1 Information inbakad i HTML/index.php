<?php

//Läser in ett html-dokument och lägger till värdet som skickades in vid markeringen
$html = file_get_contents("template.html");
if (!empty($_GET)) {
    // no data passed by get
    $html = str_replace('---session-id---', $_GET['session'], $html);
    echo $html;
} else {
    $_GET['session'] = rand();
    $html = str_replace('---session-id---', $_GET['session'], $html);
    echo $html;
}


?>
