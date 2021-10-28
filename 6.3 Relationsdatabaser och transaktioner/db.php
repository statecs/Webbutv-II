<?php
// Databasdetaljer
define('DB_HOST', 'localhost');
define('DB_NAME', 'uppgift6');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'admin');
define('DB_PASSWORD', '6sO3Oac88p');

// Skapa ny koppling till databas
$error = null;
try {
  $pdo = new PDO(
    "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME,
    DB_USER, DB_PASSWORD, [ 
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
  );
} catch (Exception $ex) { $error = $ex->getMessage(); }

?>