<?php

// Lägg till sökvägen till filen counter.txt.
$counter = ("counter.txt");
//Sätt antalet besök till det aktuella värdet.
$hits = file($counter);
// Öka värdet med 1 för de aktuella träffarna
$hits[0] ++;
//Öppnar filen och håller räkningen så att vi kan skriva till den.
$fp = fopen($counter , "w");
// Ersätt värdet i filen med det nya värdet $hits
fputs($fp , "$hits[0]");
// Stänger filen
fclose($fp);

//Ersätter tempstring med siffervärdet
$html = file_get_contents("index.html");
$html = str_replace('---$hits---', $hits[0], $html);

//Skriver ut html-elementen
echo $html;
?>