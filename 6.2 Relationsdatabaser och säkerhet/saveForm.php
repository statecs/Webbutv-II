<?php

include "db.php";

// Lagra värderna i databasen med strip_tags() samt förhindrar SQL-injection
if (is_null($error)) {
  try {
    $stmt = $pdo->prepare("INSERT INTO `usercomments` (`time`, `name`, `email`, `homepage`, `comment`  ) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([date('Y-m-d'), strip_tags($_POST['name']), strip_tags($_POST['email']), strip_tags($_POST['homepage']), strip_tags($_POST['comment'])]);
  } catch (Exception $ex) { $error = $ex->getMessage(); }
}

// Returnerar resultat
echo is_null($error) ? "OK" : $error ;