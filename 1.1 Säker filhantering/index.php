<!--Gör en räknare som visar totala antalet besök av sidan. Värdet på antalet träffar ska lagras i en fil på serversidan och detta värde ska visas med mime-typen text/plain.s
Eftersom program på webbserversidan kan anropas av många webbklienter samtidigt så måste man göra programmet så att man undviker krockar i filhanteringen.
-->

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
// Visa antalet träffar
echo $hits[0];

?>

