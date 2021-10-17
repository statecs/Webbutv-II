<?php

// Generera ett slumpmässigt nummer
// från 100-9999
$captcha = rand(100, 9999);

// Generera en 50x24 stor captcha-bild.
$im = imagecreatetruecolor(50, 24);

// Blå färg
$bg = imagecolorallocate($im, 22, 86, 165);

// Vit färg
$fg = imagecolorallocate($im, 255, 255, 255);

// Ge bilden en blå bakgrund
imagefill($im, 0, 0, $bg);

// Skriv ut captcha-texten i bilden.
// med slumpmässig position och storlek
imagestring($im, rand(1, 7), rand(1, 7),
			rand(1, 7), $captcha, $fg);

// PHP-filen kommer att återges som en bild.
header('Content-type: image/png');

// Få tillgång till nuvarande URL
$url = $_SERVER['REQUEST_URI'];

// klientstyrd omladdning av sidan, varje 5 sekunder
header("Refresh: 5; URL=$url");

// Slutligen skrivs captcha ut som
// PNG-bild i webbläsaren
imagepng($im);

// Frigör minne
imagedestroy($im);
?>
