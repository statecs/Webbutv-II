<?php
    // Spara formulär när du skickar
    if(!empty($_GET['id'])){
      
      //Php fil för att koppla upp dig mot databasen
      include "db.php";
      //Läser in värden från databasen och tabellen gallery
      $stmt = $pdo->query("SELECT * FROM gallery WHERE id = {$_GET['id']}");
      $row = $stmt->fetch();

      header("Content-type: " . $row['imageType']);
      echo $row['image'];

    } 
?>